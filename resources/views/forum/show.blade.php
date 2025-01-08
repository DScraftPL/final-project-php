@extends('layouts.app')

@section('content')
    <div class="space-y-6">
        <div class="bg-white p-6 rounded-lg shadow">
            <div class="space-y-3">
                <p class="text-xl text-gray-800">{{ $post->content }}</p>
                <a href="/user/{{ $post->author->name }}" class="text-blue-600 hover:text-blue-800 font-medium">
                    Posted by: {{ $post->author->name }}
                </a>
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
                                    <p class="text-sm text-gray-600">Replied by: {{ $reply->author->name }}</p>
                                </div>
                                @if(auth()->check() && auth()->user()->is_admin)
                                    <form action="{{ route('reply.destroy', ['replyId' => $reply->id]) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">
                                            Delete Reply
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            <div class="mt-4">
                {!! $replies->appends(['number_of_replies' => $numberOfReplies])->links() !!}
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-xl font-semibold mb-4">Add Reply</h2>
            <form action="{{ route('replies.store') }}" method="POST" class="space-y-4">
                @csrf
                <input type="hidden" name="post_id" value="{{ $post->id }}">
                <div>
                    <textarea name="content" placeholder="Write your reply..." rows="4"
                              class="w-full rounded-md border-gray-300 shadow-sm"></textarea>
                </div>
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                    Submit Reply
                </button>
            </form>
        </div>
    </div>
@endsection
