@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Create a New Forum Post</h2>
        <form action="{{ route('forum.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="content">Post Text</label>
                <textarea id="content" name="content" class="form-control" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Post</button>
        </form>
    </div>
@endsection
