@extends('layouts.app')

@section('content')
    <h2 class="text-xl font-semibold mb-4">Welcome!</h2>
    <p class="text-gray-700">Welcome to the SFP, where you can pretend to chat!</p>
    <h2>Posts:</h2>
    @guest
        <h2>please log in to see the posts</h2>
    @else
        <div class="container space-y-2">
            <h2>Latest Forum Posts:</h2>
            <div class="container">
                @foreach ($posts as $post)
                    <div class="card mb-3">
                        <div class="card-body">
                            <a
                                href="/user/{{$post->author->name}}"
                                class="hover:bold"
                            >{{ $post->author->name }}</a>
                            <p>{{ $post->content }}</p>
                            <p><small>Posted on: {{ $post->created_at->format('Y-m-d H:i') }} <a
                                        href="/forum/{{$post->id}}">reply</a></small></p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endguest
@endsection
