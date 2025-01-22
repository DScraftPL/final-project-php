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
            'attachment' => 'nullable|file'
        ]);
        $filepath = null;
        $filename = null;
        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $filename = $file->getClientOriginalName();
            $filepath = $file->store('attachments', 'public');
        }
        /*
        \Log::info('File Path:', ['file_path' => $filepath]);
        \Log::info('File Name:', ['file_name' => $filename]);
        \Log::info('Validated Content:', ['content' => $validated['content']]);
        */
        ForumPost::create([
            'author_id' => auth()->id(),
            'content' => $validated['content'],
            'file_path' => $filepath,
            'file_name'=> $filename,
        ]);
        return redirect()->route('forum.index');
    }

    public function index(Request $request)
    {
        $validated = $request->validate([
            'number_of_posts' => 'nullable|in:3,5,10',
        ]);
        $numberOfPosts = $validated['number_of_posts'] ?? 3;
        $posts = ForumPost::paginate($numberOfPosts);
        return view('forum.index', compact('posts', 'numberOfPosts'));
    }

    public function show($postId, Request $request)
    {
        $post = ForumPost::with('replies.author')->findOrFail($postId);
        $validated = $request->validate([
            'number_of_replies' => 'nullable|in:3,5,10',
        ]);
        $numberOfReplies = $validated['number_of_replies'] ?? 3;
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

        return redirect()->route('forum.index')->with('success', 'Post and all replies deleted successfully.');
    }

    public function edit($id)
    {
        $post = ForumPost::findOrFail($id);

        if ($post->author_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('forum.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $post = ForumPost::findOrFail($id);

        if ($post->author_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'content' => 'required|string|max:255',
        ]);

        $post->update([
            'content' => $validated['content']
        ]);

        return redirect()->route('forum.show', $post->id)->with('success', 'Post updated successfully.');
    }

    public function search(Request $request)
    {
        $validated = $request->validate([
            'query' => 'required|string|min:1',
        ]);

        $posts = ForumPost::where('content', 'LIKE', "%{$validated['query']}%")->latest()->paginate(3);

        return view('forum.search', [
            'posts' => $posts,
            'searchQuery' => $validated['query']
        ]);
    }
}
