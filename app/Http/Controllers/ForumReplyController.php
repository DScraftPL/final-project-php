<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ForumReply;

class ForumReplyController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'post_id' => 'required|exists:forum_posts,id',
            'content' => 'required|string|max:255',
        ]);

        ForumReply::create([
            'author_id' => auth()->id(),
            'post_id' => $validated['post_id'],
            'content' => $validated['content'],
        ]);

        return redirect()->route('forum.show', $validated['post_id'])->with('success', 'Reply posted successfully!');
    }

    public function show($id)
    {
        $post = ForumPost::with('replies')->findOrFail($id);
        return view('forum.show', compact('post'));
    }
}
