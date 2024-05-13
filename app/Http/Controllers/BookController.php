<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookStoreRequest;
use App\Http\Traits\ApiResponseTrait;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $authors =Cache::remember('Book',60,function(){
          return  Book::all();
        });

        return $this->apiResponse('success',$authors,'authors show done',Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BookStoreRequest $request)
    {
        try {
            DB::beginTransaction();
       $book=Book::create([
        'name' => $request->name,
        'description' => $request->description,
       ]);
       
       DB::commit();
            return response()->json([
                'status' => 'success',
                'book' => $book
            ]);
    }catch (\Throwable $th) {
        DB::rollBack();
        return response()->json([
            'status' => $th,
        ]);
    }
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        $book=Book::with('authors')->find($book->id);

        return $this->apiResponse('success',$book,'book show done',Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BookStoreRequest $request, Book $book)
    {
        try {
            DB::beginTransaction();
        $newData= [];
        if (isset($request->name))  {
            $newData['name'] =  $request->name;
        }
        if (isset($request->description))  {
            $newData['description'] =  $request->description;
        }
        $book->update([$newData]);

        DB::commit();
        return response()->json([
            'status' => 'success',
            'book' => $book
        ]);
    }catch (\Throwable $th) {
        DB::rollBack();
        return response()->json([
            'status' => 'error',
        ]);
    }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book->delete();

        return $this->apiResponse('success',$book,'book delete Successfully',Response::HTTP_OK);
    }
}
