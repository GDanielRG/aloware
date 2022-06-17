<?php

namespace App\Actions;

use App\Models\Comment;

class EnsureParentCommentIsThreeLevelsDeepMaxAction
{
    public function __invoke(Comment $comment): Comment
    {
        // Max depth of nested comments is 3. 
        // It can be incresed by prepending additional optional (Don't forget to add the '?') 'comment' relations.
        $parentComment = $comment->comment?->comment;

        if ($parentComment) {
            return $comment->comment;
        }

        return $comment;
    }
}
