<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function getAll()
    {
        $comments = Comment::all();
        if ($comments->count() > 0)
        {
            return response()->json($comments);
        } else
        {
            return response()->json(["message" => "No comments found."], 404);
        }
    }

    public function getById($id)
    {
        $comment = Comment::find($id);

        if ($comment)
        {
            $result = [
                'message' => 'Comment retrieved successfully.',
                'comment' => $comment
            ];
            return response()->json($result);
        } else
        {
            $result = [
                'message' => 'Comment not found.',
                'comment' => $comment,
            ];
            return response()->json($result, 404);
        }
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'content' => 'required|string|min:150|max:550',
            'user_id' => 'required|integer',
            'company_id' => 'required|integer',
            'rating' => 'required|integer|min:1|max:10',
        ]);
        $comment = Comment::create($validatedData);
        $result = [
            'message' => 'Comment created successfully.',
            'comment' => $comment
        ];
        return response()->json($result);
    }

    public function update($id)
    {
        $comment = Comment::find($id);
        $validatedData = request()->validate([
            'content' => 'string|min:150|max:550',
            'user_id' => 'integer',
            'company_id' => 'integer',
            'rating' => 'integer|min:1|max:10',
        ]);

        if ($comment)
        {
            $comment->update($validatedData);
            $result = [
                'message' => 'Comment updated successfully.',
                'comment' => $comment
            ];
            return response()->json($result);
        } else
        {
            return response()->json(["message" => "Comment not found."], 404);
        }
    }
    public function destroy($id)
    {
        $comment = Comment::find($id);

        if ($comment)
        {
            $comment->delete();
            $result = [
                'message' => 'Comment deleted successfully.',
                'comment' => $comment
            ];
            return response()->json($result);
        } else
        {
            return response()->json(["message" => "Comment not found."], 404);
        }
    }
}
