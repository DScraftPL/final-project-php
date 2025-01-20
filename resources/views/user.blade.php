@extends('layouts.app')

@section('content')
    @if ($user)
        <div class="space-y-6">
            <div class="bg-white p-6 rounded-lg shadow">
                <h1 class="text-2xl font-bold mb-4">User Profile
                @if (auth()->user()->is_blocked)
                    <span class="bg-red-500 text-white text-sm font-medium px-2.5 py-0.5 rounded-full">
                        Blocked
                    </span>
                @endif
                </h1>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-3">
                        <div>
                            <span class="text-gray-600">Username:</span>
                            <span class="font-medium ml-2">{{ $user->name }}</span>
                        </div>
                        <div>
                            <span class="text-gray-600">Member since:</span>
                            <span class="font-medium ml-2">{{ $user->created_at->format('M d, Y') }}</span>
                        </div>
                    </div>
                    <div class="space-y-3">
                        <div>
                            <span class="text-gray-600">Total Posts:</span>
                            <span class="font-medium ml-2">{{ $user->posts()->count() }}</span>
                        </div>
                        <div>
                            <span class="text-gray-600">Total Replies:</span>
                            <span class="font-medium ml-2">{{ $user->replies()->count() }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-xl font-semibold mb-4">Description</h2>
                @if($user->description)
                    <h3>{{$user->description}}</h3>
                @else
                    <h3>No description</h3>
                @endif
            </div>
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-xl font-semibold mb-4">User Posts</h2>
                @if($user->posts->count() > 0)
                    <div class="space-y-4">
                        @foreach($user->posts as $post)
                            <div class="border-b last:border-0 pb-4">
                                <div class="flex justify-between items-start">
                                    <div class="space-y-2">
                                        <div class="flex items-center space-x-2">
                                            <a href="/user/{{$post->author->name}}" class="text-blue-600 hover:text-blue-800 font-medium">
                                                {{ $post->author->name }}
                                            </a>
                                            <span class="text-gray-500 text-sm">
                                                {{ $post->created_at->format('M d, Y H:i') }}
                                            </span>
                                        </div>
                                        <p class="text-gray-800">{{ $post->content }}</p>
                                        <div>
                                            <a href="/forum/{{$post->id}}"
                                               class="text-blue-600 hover:text-blue-800 text-sm">
                                                View Discussion →
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-600">No posts yet.</p>
                @endif
            </div>
        </div>
    @else
        <div class="bg-white p-6 rounded-lg shadow">
            <div class="text-center py-8">
                <h2 class="text-xl font-semibold text-gray-800">User not found</h2>
                <p class="text-gray-600 mt-2">The requested user profile could not be found.</p>
            </div>
        </div>
    @endif
@endsection
