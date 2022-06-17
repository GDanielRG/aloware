<?php

namespace App\Actions;

use App\DataTransferObjects\CommentData;
use App\Models\Comment;

class CreateCommentAction
{
    private EnsureParentCommentIsThreeLevelsDeepMaxAction $EnsureParentCommentIsThreeLevelsDeepMaxAction;

    public function __construct(EnsureParentCommentIsThreeLevelsDeepMaxAction $EnsureParentCommentIsThreeLevelsDeepMaxAction)
    {
        $this->EnsureParentCommentIsThreeLevelsDeepMaxAction = $EnsureParentCommentIsThreeLevelsDeepMaxAction;
    }

    public function __invoke(CommentData $commentData, Comment $parentComment = null): Comment
    {
        if ($parentComment) {
            $parentComment = ($this->EnsureParentCommentIsThreeLevelsDeepMaxAction)($parentComment);
        }

        $comment = Comment::create([
            'user_name' => $commentData->userName,
            'content' => $commentData->comment,
            'comment_id' => $parentComment?->id,
        ]);

        return $comment;
    }
}
