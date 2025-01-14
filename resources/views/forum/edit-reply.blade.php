@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-lg font-medium text-gray-900">
                Edit Reply
            </h2>

            <form method="POST" action="{{ route('reply.update', $reply->id) }}" class="mt-6 space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label for="content" class="sr-only">Content</label>
                    <textarea
                        name="content"
                        id="content"
                        class="block w-full border-gray-300 rounded-md shadow-sm"
                        rows="3"
                    >{{ old('content', $reply->content) }}</textarea>
                    @error('content')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex items-center gap-4">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md">
                        Update Reply
                    </button>
                    <a href="{{ route('forum.show', $reply->post_id) }}" class="text-gray-600 hover:text-gray-900">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
