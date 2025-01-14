@extends('layouts.app')

@section('content')
    <div class="space-y-6">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold">Forum Posts</h1>
            <div class="flex items-center space-x-4">
                @auth
                    <a href="{{ route('forum.create') }}"
                       class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md">
                        Create Post
                    </a>
                @endauth
                <form method="GET" action="{{ route('forum.index') }}" class="flex items-center space-x-2">
                    <label for="number_of_posts" class="text-sm text-gray-600">Posts per page:</label>
                    <select name="number_of_posts" id="number_of_posts" onchange="this.form.submit()"
                            class="rounded-md border-gray-300 shadow-sm">
                        <option value="3" {{ $numberOfPosts == 3 ? 'selected' : '' }}>3</option>
                        <option value="5" {{ $numberOfPosts == 5 ? 'selected' : '' }}>5</option>
                        <option value="10" {{ $numberOfPosts == 10 ? 'selected' : '' }}>10</option>
                    </select>
                </form>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <div class="space-y-4">
            @foreach ($posts as $post)
                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="space-y-3">
                        <div class="flex justify-between items-start">
                                <div class="flex items-center space-x-3">
                                    <img src="{{ App\Constants\ProfilePictures::getImagePath($post->author->image_id) }}"
                                         alt="Profile Picture"
                                         class="w-8 h-8 rounded-full">
                                    <a href="/user/{{$post->author->name}}"
                                       class="text-blue-600 hover:text-blue-800 font-medium">
                                        {{ $post->author->name }}
                                    </a>
                                </div>
                            <div class="flex space-x-2">
                                @auth
                                    @if(auth()->id() === $post->author_id)
                                        <a href="{{ route('forum.edit', $post->id) }}"
                                           class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm">
                                            Edit
                                        </a>
                                    @endif
                                    @if(auth()->user()->is_admin)
                                        <form action="{{ route('forum.destroy', ['postId' => $post->id]) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit"
                                                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm"
                                                    onclick="return confirm('Are you sure you want to delete this post?')">
                                                Delete Post
                                            </button>
                                        </form>
                                    @endif
                                @endauth
                            </div>
                        </div>
                        <p class="text-gray-800">{{ $post->content }}</p>
                        <div class="flex justify-between items-center text-sm text-gray-600">
                            <div class="space-x-4">
                                <span>Posted on: {{ $post->created_at->format('M d, Y H:i') }}</span>
                                @if($post->created_at != $post->updated_at)
                                    <span class="italic">(edited {{ $post->updated_at->format('M d, Y H:i') }})</span>
                                @endif
                            </div>
                            <div class="flex items-center space-x-4">
                                <span>{{ $post->replies->count() }} {{ Str::plural('reply', $post->replies->count()) }}</span>
                                <a href="{{ route('forum.show', $post->id) }}"
                                   class="text-blue-600 hover:text-blue-800">
                                    View Discussion →
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if($posts->isEmpty())
            <div class="bg-white p-6 rounded-lg shadow text-center">
                <p class="text-gray-600">No posts found.</p>
            </div>
        @endif

        <div class="mt-4">
            {{ $posts->appends(['number_of_posts' => $numberOfPosts])->links() }}
        </div>
    </div>
@endsection
