@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto space-y-6">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold">Announcements</h1>
            @if(auth()->check() && auth()->user()->is_admin)
                <a href="{{ route('announcement.create') }}"
                   class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                    Create New Announcement
                </a>
            @endif
        </div>

        <div class="space-y-4">
            @foreach($announcements as $announcement)
                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="flex justify-between items-start">
                        <div class="space-y-2">
                            <h2 class="text-xl font-semibold">{{ $announcement->title }}</h2>
                            <p class="text-gray-600 text-sm">Posted on: {{ $announcement->created_at->format('M d, Y') }}</p>
                            <p class="text-gray-800 mt-2">{{ $announcement->description }}</p>
                        </div>
                        @if(auth()->check() && auth()->user()->is_admin)
                            <div class="flex space-x-2">
                                <a href="{{ route('announcement.edit', $announcement->id) }}"
                                   class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded">
                                    Edit
                                </a>
                                <form action="{{ route('announcement.destroy', $announcement->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Are you sure you want to delete this announcement?');"
                                      class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-4">
            {{ $announcements->links() }}
        </div>
    </div>
@endsection
