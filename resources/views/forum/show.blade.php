@extends('layouts.app')

@section('content')
    <h1>{{ $post->content }}</h1>
    <a
        class="hover:bold"
        href="/user/{{ $post->author->name }}"
    ><p>Posted by: {{ $post->author->name }}</p></a>

    @if ($replies->isEmpty())
        <p>No replies yet. Be the first to reply!</p>
    @else
        <h2>Replies:</h2>
        @foreach ($replies as $reply)
            <div>
                <p>{{ $reply->content }}</p>
                <small>Replied by: {{ $reply->author->name }}</small>
            </div>
        @endforeach
        <form method="GET" action="{{ route('forum.show', $post->id) }}">
            <label for="number_of_replies">Number of replies:</label>
            <select name="number_of_replies" id="number_of_replies" onchange="this.form.submit()">
                <option value="3" {{ $numberOfReplies == 3 ? 'selected' : '' }}>3</option>
                <option value="5" {{ $numberOfReplies == 5 ? 'selected' : '' }}>5</option>
                <option value="10" {{ $numberOfReplies == 10 ? 'selected' : '' }}>10</option>
            </select>
        </form>
        <div class="pagination">
            {!! $replies->appends(['number_of_replies' => $numberOfReplies])->links() !!}
        </div>
    @endif
    <form action="{{ route('replies.store') }}" method="POST">
        @csrf
        <input type="hidden" name="post_id" value="{{ $post->id }}">
        <textarea name="content" placeholder="Write your reply..."></textarea>
        <button type="submit">Submit Reply</button>
    </form>
@endsection
