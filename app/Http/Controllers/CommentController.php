<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class CommentController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function getData()
    {
        $model = Comment::all();        

        return response()
            ->json([
                'model' => $model,                
            ]);
    }

    public function store(Request $request)
    {
        
        $comment = new Comment([
          'text' => $request->get('text')
        ]);
        $comment->save();

        return response()->json($comment);
    }

    public function edit(Request $request, $id)
    {
        $comment = Comment::find($id);
        $comment->text = $request->get('text');
        $comment->save();

        return response()->json($comment);
    }

    public function destroy($id)
    {
      $comment = Comment::find($id);
      $comment->delete();

      return response()->json('Successfully Deleted');
    }
}
