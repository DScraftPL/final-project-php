@extends('layouts.app')

@section('content')
    @foreach($announcements as $announcement)
        <div>
            <h2 class="text-xl font-semibold">{{ $announcement->title }}</h2>
            @if(auth()->check() && auth()->user()->is_admin)
                <a href="{{ route('announcement.edit', $announcement->id) }}"
                   class="text-blue-600 hover:underline">
                    Edit
                </a>
                <form action="{{ route('announcement.destroy', $announcement->id) }}"
                      method="POST"
                      onsubmit="return confirm('Are you sure you want to delete this announcement?');"
                      class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="text-red-600 hover:underline">
                        Delete
                    </button>
                </form>
            @endif
            <p class="mt-2">{{ $announcement->description }}</p>
        </div>
    @endforeach
    <div class="mt-4">
        {{ $announcements->links() }}
    </div>
@endsection
