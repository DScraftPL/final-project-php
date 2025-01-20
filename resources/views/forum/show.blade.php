@extends('layouts.app')

@section('content')
    <div class="space-y-6">
        <div class="bg-white p-6 rounded-lg shadow">
            <div class="space-y-3">
                <div class="flex justify-between items-start">
                    <div class="space-y-3">
                        <p class="text-xl text-gray-800">{{ $post->content }}</p>
                        <div>
                            <div class="flex items-center space-x-3">
                                <img src="{{ App\Constants\ProfilePictures::getImagePath($post->author->image_id) }}"
                                     alt="Profile Picture"
                                     class="w-8 h-8 rounded-full">
                                <a href="/user/{{ $post->author->name }}" class="text-blue-600 hover:text-blue-800 font-medium">
                                    Posted by: {{ $post->author->name }}
                                </a>
                            </div>
                            <span class="text-sm text-gray-600 ml-2">
                                {{ $post->created_at->format('M d, Y H:i') }}
                                @if($post->created_at != $post->updated_at)
                                    <span class="italic">(edited {{ $post->updated_at->format('M d, Y H:i') }})</span>
                                @endif
                            </span>
                        </div>
                    </div>
                    @auth
                        @if(auth()->id() === $post->author_id)
                            <a href="{{ route('forum.edit', $post->id) }}"
                               class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm">
                                Edit Post
                            </a>
                        @endif
                    @endauth
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold">Replies</h2>
                <form method="GET" action="{{ route('forum.show', $post->id) }}" class="flex items-center space-x-2">
                    <label for="number_of_replies" class="text-sm text-gray-600">Replies per page:</label>
                    <select name="number_of_replies" id="number_of_replies" onchange="this.form.submit()"
                            class="rounded-md border-gray-300 shadow-sm">
                        <option value="3" {{ $numberOfReplies == 3 ? 'selected' : '' }}>3</option>
                        <option value="5" {{ $numberOfReplies == 5 ? 'selected' : '' }}>5</option>
                        <option value="10" {{ $numberOfReplies == 10 ? 'selected' : '' }}>10</option>
                    </select>
                </form>
            </div>

            @if ($replies->isEmpty())
                <p class="text-gray-600">No replies yet. Be the first to reply!</p>
            @else
                <div class="space-y-4">
                    @foreach ($replies as $reply)
                        <div class="border-b last:border-b-0 pb-4">
                            <div class="flex justify-between items-start">
                                <div class="space-y-2">
                                    <p class="text-gray-800">{{ $reply->content }}</p>
                                    <div class="flex items-center space-x-2 text-sm">
                                        <div class="flex items-center space-x-2 text-sm">
                                            <img src="{{ App\Constants\ProfilePictures::getImagePath($reply->author->image_id) }}"
                                                 alt="Profile Picture"
                                                 class="w-6 h-6 rounded-full">
                                            <a href="/user/{{ $reply->author->name }}" class="text-blue-600 hover:text-blue-800">
                                                {{ $reply->author->name }}
                                            </a>
                                        </div>
                                        <span class="text-gray-600">
                                            {{ $reply->created_at->format('M d, Y H:i') }}
                                            @if($reply->created_at != $reply->updated_at)
                                                <span class="italic">(edited {{ $reply->updated_at->format('M d, Y H:i') }})</span>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <div class="flex space-x-2">
                                    @auth
                                        @if(auth()->id() === $reply->author_id)
                                            <a href="{{ route('reply.edit', $reply->id) }}"
                                               class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm">
                                                Edit
                                            </a>
                                        @endif
                                        @if(auth()->user()->is_admin)
                                            <form action="{{ route('reply.destroy', ['replyId' => $reply->id]) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit"
                                                        class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm"
                                                        onclick="return confirm('Are you sure you want to delete this reply?')">
                                                    Delete
                                                </button>
                                            </form>
                                        @endif
                                    @endauth
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            <div class="mt-4">
                {!! $replies->appends(['number_of_replies' => $numberOfReplies])->links() !!}
            </div>
        </div>

        @auth
            @if(auth()->user()->is_blocked)
            <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-xl font-semibold mb-4">User cannot reply</h2>
            </div>
            @else
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-xl font-semibold mb-4">Add Reply</h2>
                <form action="{{ route('replies.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                    <div>
                        <textarea name="content"
                                  placeholder="Write your reply..."
                                  rows="4"
                                  class="w-full rounded-md border-gray-300 shadow-sm"
                                  required></textarea>
                    </div>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                        Submit Reply
                    </button>
                </form>
            </div>
            @endif
        @else
            <div class="bg-white p-6 rounded-lg shadow text-center">
                <p class="text-gray-600">Please <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-800">login</a> to reply.</p>
            </div>
        @endauth
    </div>
@endsection
