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
                <form method="GET" action="{{ route('forum.index', $post->id) }}">
                    <label for="number_of_posts">Number of replies:</label>
                    <select name="number_of_posts" id="number_of_posts" onchange="this.form.submit()">
                        <option value="3" {{ $numberOfPosts == 3 ? 'selected' : '' }}>3</option>
                        <option value="5" {{ $numberOfPosts == 5 ? 'selected' : '' }}>5</option>
                        <option value="10" {{ $numberOfPosts == 10 ? 'selected' : '' }}>10</option>
                    </select>
                </form>
                <div class="pagination">
                    {!! $posts->appends(['number_of_posts' => $numberOfPosts])->links() !!}
                </div>
        </div>
    </div>
@endsection
