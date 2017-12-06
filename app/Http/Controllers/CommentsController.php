<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Issue;

class CommentsController extends Controller
{
    public function store(Issue $issue)
    {
        $comment = Comment::create([
            'body' => request('body'),
            'user_id' => auth()->id(),
        ]);

        /*$issue->comments()->attach($comment->id);*/

        // Or jus following
        $issue->addComment($comment);

        return back();
    }
}
