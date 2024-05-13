<?php

namespace App\Http\Controllers;

use App\Http\Traits\ApiResponseTrait;
use App\Models\Book;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {
        $Comment=Comment::all();
        return $this->apiResponse('success',$Comment,'comment done',Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $book= Book::where('id',$request->book_id)->first();

        $book->comments()->create([
            'comment'=>$request->comment,
        ]);

        return $this->apiResponse('success',$book,'comment done',Response::HTTP_OK);
    }

    public function show(Comment $Comment)
    {
        $Comment=Comment::with('comments')->find($Comment->id);

        return $this->apiResponse('success',$Comment,'comment show done',Response::HTTP_OK);

    }

    public function update(Request $request,Comment $comment)
    { 
        try {
            DB::beginTransaction();
        $newData= [];
        if (isset($request->comment))  {
            $newData['comment'] =  $request->comment;
        }
        $comment->update([$newData]);

        DB::commit();
        return $this->apiResponse('success',$comment,'comment updated Successfully',Response::HTTP_OK);
        }catch (\Throwable $th) {
        DB::rollBack();
        return $this->apiResponse('false',$comment,'comment updated not Succeeded',Response::HTTP_BAD_REQUEST);
       
         }
    }
    
    public function destroy(Comment $comment)
    {
        $comment->delete();

        return $this->apiResponse('success',$comment,'comment delete Successfully',Response::HTTP_OK);
    }

}