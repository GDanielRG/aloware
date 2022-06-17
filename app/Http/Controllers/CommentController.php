<?php

namespace App\Http\Controllers;

use App\Actions\CreateCommentAction;
use App\DataTransferObjects\CommentData;
use App\Http\Requests\CommentStoreRequest;

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
    public function store(CommentStoreRequest $request, CreateCommentAction $createCommentAction)
    {
        $commentData = CommentData::fromRequest($request);

        ($createCommentAction)($commentData);

        return redirect()->route('home');
    }
}
