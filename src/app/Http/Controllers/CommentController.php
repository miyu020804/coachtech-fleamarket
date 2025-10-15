<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Item;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(CommentRequest
    $request, Item $item)
    {
        $data =
            $request->validated();
        Comment::create([
            'item_id' => $item->id,
            'user_id' => \Auth()->id(),
            'body' => $request->input('body'),
        ]);

        return back();
    }
}
