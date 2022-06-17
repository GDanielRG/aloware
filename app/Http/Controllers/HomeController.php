<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Inertia\Inertia;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        return Inertia::render('Home', [
            'comments' => Comment::with('comments')
                ->rootOnly()
                ->orderBy('created_at')
                ->get()
        ]);
    }
}
