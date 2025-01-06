@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="font-bold">Forum Posts</h1>
        <div class="flex flex-col flex-wrap">
            @foreach ($posts as $post)
                <div class="card mb-3">
                    <div class="card-body">
                        <a
                            class="hover:bold"
                            href="/user/{{$post->author->name}}"
                        ><p>{{ $post->author->name }}</p></a>
                        <p>{{ $post->content }}</p>
                        <p><small>Posted on: {{ $post->created_at->format('Y-m-d H:i') }}</small> <a
                                href="/forum/{{$post->id}}"
                                class="hover:font-bold"
                            >replies</a></p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
