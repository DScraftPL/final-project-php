<?php

namespace App\Http\Controllers;

use App\Models\ForumPost;
use Illuminate\Http\Request;

class ForumPostController extends Controller
{
    public function create()
    {
        return view('forum.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'content' => 'required|string|max:255',
        ]);
        ForumPost::create([
            'author_id' => auth()->id(),
            'content' => $validated['content'],
        ]);
        return redirect()->route('forum.index');
    }

    public function index(Request $request)
    {
        $numberOfPosts = $request->get('number_of_posts', 3);
        $posts = ForumPost::paginate($numberOfPosts);
        return view('forum.index', compact('posts', 'numberOfPosts'));
    }

    public function show($postId, Request $request)
    {
        $post = ForumPost::with('replies.author')->findOrFail($postId);
        $numberOfReplies = $request->get('number_of_replies', 3);
        $replies = $post->replies()->latest()->paginate($numberOfReplies);
        return view('forum.show', compact('post', 'replies', 'numberOfReplies'));
    }

    public function home()
    {
        $numberOfPosts = 3;
        $posts = ForumPost::limit($numberOfPosts)->latest()->get();
        return view('home', compact('posts'));
    }

    public function destroy($postId)
    {
        $post = ForumPost::with('replies')->findOrFail($postId);
        $post->replies()->delete();
        $post->delete();
        return redirect()->route('forum.index')->with('success', 'Post and all associated replies deleted successfully.');
    }
}
