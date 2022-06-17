<?php

namespace App\DataTransferObjects;

use Illuminate\Http\Request;
use Spatie\DataTransferObject\DataTransferObject;

class CommentData extends DataTransferObject
{
    public string $userName;

    public string $comment;

    public static function fromRequest(Request $request): CommentData
    {
        return new self([
            'userName' => $request->input('user_name'),
            'comment' => $request->input('comment'),
        ]);
    }
}
