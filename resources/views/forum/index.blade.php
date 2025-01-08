@extends('layouts.app')

@section('content')
    <div class="space-y-6">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold">Forum Posts</h1>
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

        <div class="space-y-4">
            @foreach ($posts as $post)
                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="space-y-3">
                        <div class="flex justify-between items-start">
                            <a href="/user/{{$post->author->name}}"
                               class="text-blue-600 hover:text-blue-800 font-medium">
                                {{ $post->author->name }}
                            </a>
                            @if(auth()->check() && auth()->user()->is_admin)
                                <form action="{{ route('forum.destroy', ['postId' => $post->id]) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">
                                        Delete Post
                                    </button>
                                </form>
                            @endif
                        </div>
                        <p class="text-gray-800">{{ $post->content }}</p>
                        <div class="flex justify-between items-center text-sm text-gray-600">
                            <span>Posted on: {{ $post->created_at->format('M d, Y H:i') }}</span>
                            <a href="/forum/{{$post->id}}"
                               class="text-blue-600 hover:text-blue-800">
                                View Replies
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-4">
            {!! $posts->appends(['number_of_posts' => $numberOfPosts])->links() !!}
        </div>
    </div>
@endsection
