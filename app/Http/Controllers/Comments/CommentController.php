<?php

namespace App\Http\Controllers\Comments;

use App\Actions\CreateCommentAction;
use App\DataTransferObjects\CommentData;
use App\Http\Controllers\Controller;
use App\Http\Requests\CommentStoreRequest;
use App\Models\Comment;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $request
     * @param  \App\Actions\Appointments\CreateCommentAction  $createCommentAction
     * @return \Inertia\Response
     */
    public function store(CommentStoreRequest $request, Comment $comment, CreateCommentAction $createCommentAction)
    {
        $commentData = CommentData::fromRequest($request);

        ($createCommentAction)($commentData, $comment);

        return redirect()->route('home');
    }
}
