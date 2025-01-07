@extends('layouts.app')

@section('content')
    <div class="space-y-6">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold">Dashboard</h1>
            <form action="{{ route('logout') }}" method="post" class="inline">
                @csrf
                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">
                    Logout
                </button>
            </form>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-xl font-semibold mb-4">Your Statistics</h2>
                <div class="space-y-2">
                    <p>Username: {{ Auth::user()->name }}</p>
                    <p>Email: {{ Auth::user()->email }}</p>
                    <p>Total Posts: {{ Auth::user()->posts->count() }}</p>
                    <p>Total Replies: {{ Auth::user()->replies->count() }}</p>
                </div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-xl font-semibold mb-4">Account Actions</h2>
                <div class="space-y-4">
                    <form action="{{ route('password.update') }}" method="post" class="space-y-4">
                        @csrf
                        @method('put')
                        <div>
                            <label for="current_password" class="block text-sm font-medium text-gray-700">Current
                                Password</label>
                            <input type="password" name="current_password" id="current_password" required
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700">New Password</label>
                            <input type="password" name="password" id="password" required
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm
                                New Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" required
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                            Update Password
                        </button>
                    </form>
                    <div class="mt-6 border-t pt-6">
                        <h3 class="text-lg font-medium text-red-600 mb-4">Delete Account</h3>
                        <form action="{{ route('profile.destroy') }}" method="post"
                              onsubmit="return confirm('Are you sure you want to delete your account? This action cannot be undone.');">
                            @csrf
                            @method('delete')

                            <div class="mb-4">
                                <label for="password_deletion" class="block text-sm font-medium text-gray-700">
                                    Please enter your password to confirm account deletion
                                </label>
                                <input type="password" name="password" id="password_deletion" required
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                @error('password', 'userDeletion')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">
                                Delete Account
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-xl font-semibold mb-4">Your Posts</h2>
            @if(Auth::user()->posts->count() > 0)
                <div class="space-y-4">
                    @foreach(Auth::user()->posts as $post)
                        <div class="border-b pb-4">
                            <h3 class="text-lg font-medium">
                                <a href="{{ route('forum.show', $post->id) }}"
                                   class="text-blue-600 hover:text-blue-800">
                                    {{ $post->title }}
                                </a>
                            </h3>
                            <p class="text-gray-600 text-sm">Posted on: {{ $post->created_at->format('M d, Y') }}</p>
                            <p class="text-gray-800 mt-2">{{ Str::limit($post->content, 150) }}</p>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-600">You haven't created any posts yet.</p>
            @endif
        </div>
    </div>
@endsection
