@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Create a Announcement</h2>
        <form action="{{ route('announcement.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="title">Post Text</label>
                <input id="title" name="title" type="text" class="form-control" required/>
            </div>
            <div class="form-group">
                <label for="description">Post Text</label>
                <textarea id="description" name="description" class="form-control" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Post</button>
        </form>
    </div>
@endsection
