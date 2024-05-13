<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthorStoreRequest;
use App\Http\Traits\ApiResponseTrait;
use App\Models\Author;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthorController extends Controller
{
    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $authors =Author::all();
        return $this->apiResponse('success',$authors,'authors show done',Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AuthorStoreRequest $request)
    {
        $authors=[];
        try {
            DB::beginTransaction();
       $authors=Author::create([
        'name' => $request->name,
       ]);
       
       DB::commit();
       return $this->apiResponse('success',$authors,'authors created successfully',Response::HTTP_OK);

    }catch (\Throwable $th) {
        DB::rollBack();
        return $this->apiResponse('false',$authors,'author add not Succeeded',Response::HTTP_BAD_REQUEST);

    }
    }

    /**
     * Display the specified resource.
     */
    public function show(Author $author)
    {
        $author=Author::with('books')->find($author->id);

        return $this->apiResponse('success',$author,'author show done',Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AuthorStoreRequest $request, Author $author)
    {
        try {
            DB::beginTransaction();
        $newData= [];
        if (isset($request->name))  {
            $newData['name'] =  $request->name;
        }
        $author->update([$newData]);

        DB::commit();
        return response()->json([
            'status' => 'success',
            'author' => $author
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
    public function destroy(Author $author)
    {
        $author->delete();

        return $this->apiResponse('success',$author,'author delete Successfully',Response::HTTP_OK);
    }
}
