@extends('layouts.app')

@section('content')
    <div class="space-y-6">
        <div class="bg-white p-6 rounded-lg shadow">
            <h1 class="text-2xl font-bold mb-2">Welcome!</h1>
            <p class="text-gray-600">Welcome to the SFP, where you can pretend to chat!</p>
        </div>

        @guest
            <div class="bg-yellow-50 p-6 rounded-lg shadow">
                <h2 class="text-xl font-semibold text-yellow-800">Please log in to see the posts</h2>
            </div>
        @else
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-xl font-semibold mb-4">Latest Forum Posts</h2>

                <div class="space-y-4">
                    @foreach ($posts as $post)
                        <div class="border-b pb-4 last:border-b-0">
                            <div class="flex items-start justify-between">
                                <div class="space-y-2">
                                    <a href="/user/{{$post->author->name}}"
                                       class="text-blue-600 hover:text-blue-800 font-medium">
                                        {{ $post->author->name }}
                                    </a>
                                    <p class="text-gray-800">{{ $post->content }}</p>
                                    <div class="text-sm text-gray-600">
                                        Posted on: {{ $post->created_at->format('M d, Y H:i') }} |
                                        <a href="/forum/{{$post->id}}"
                                           class="text-blue-600 hover:text-blue-800">
                                            Reply
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endguest
    </div>
@endsection
