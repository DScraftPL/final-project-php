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
                        @if(auth()->check() && auth()->user()->is_admin)
                            <form action="{{ route('forum.destroy', ['postId' => $post->id]) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">
                                    Delete Post
                                </button>
                            </form>
                        @endif
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
