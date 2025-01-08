@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-xl font-semibold mb-4">Create a New Forum Post</h2>
            <form action="{{ route('forum.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="content" class="block text-sm font-medium text-gray-700">Post Content</label>
                    <textarea
                        id="content"
                        name="content"
                        rows="6"
                        required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                    ></textarea>
                </div>
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                    Create Post
                </button>
            </form>
        </div>
    </div>
@endsection
