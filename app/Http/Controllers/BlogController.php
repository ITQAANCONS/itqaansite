<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;

class BlogController extends Controller
{
    public function index()
    {
        return view('pages.blog', [
            'posts' => BlogPost::published()->latestFirst()->paginate(9),
        ]);
    }

    public function show(string $locale, string $slug)
    {
        $post = BlogPost::published()->where('slug', $slug)->first();
        abort_if(! $post, 404);

        $post->increment('views');

        $related = BlogPost::published()->latestFirst()
            ->where('id', '!=', $post->id)
            ->take(3)->get();

        return view('pages.post', compact('post', 'related'));
    }
}
