<?php

namespace App\Http\Controllers;

use App\Models\ForumReply;
use Illuminate\Http\Request;

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

    public function destroy($replyId)
    {
        $reply = ForumReply::findOrFail($replyId);
        $reply->delete();

        return back()->with('success', 'Reply deleted successfully.');
    }

    public function edit($id)
    {
        $reply = ForumReply::findOrFail($id);

        if ($reply->author_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('forum.edit-reply', compact('reply'));
    }

    public function update(Request $request, $id)
    {
        $reply = ForumReply::findOrFail($id);

        if ($reply->author_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'content' => 'required|string|max:255',
        ]);

        $reply->update([
            'content' => $validated['content']
        ]);

        return redirect()->route('forum.show', $reply->post_id)
            ->with('success', 'Reply updated successfully.');
    }
}
