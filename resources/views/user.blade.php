@extends('layouts.app')

@section('content')
    @if ($user)
        <h1>User Details:</h1>
        {{--        <p><strong>ID:</strong> {{ $user->id }}</p>--}}
        <p><strong>Name:</strong> {{ $user->name }}</p>
        {{--        <p><strong>Email:</strong> {{ $user->email }}</p>--}}
        <p><strong>Created At:</strong> {{ $user->created_at }}</p>
        <p><strong>Number of Posts:</strong> {{ $user->posts()->count() }}</p>
        <p><strong>Number of Replies:</strong> {{ $user->replies()->count() }}</p>
        <h1>User Posts:</h1>
        @foreach($user->posts as $post)
            <div class="card mb-3">
                <div class="card-body">
                    <a href="/user/{{$post->author->name}}"><p>{{ $post->author->name }}</p></a>
                    <p>{{ $post->content }}</p>
                    <p><small>Posted on: {{ $post->created_at->format('Y-m-d H:i') }}</small> <a
                            href="/forum/{{$post->id}}"
                            class="hover:font-bold"
                        >replies</a></p>
                </div>
            </div>
        @endforeach
    @else
        <p>User not found.</p>
    @endif
@endsection
