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
                    <p>Username: {{ Auth::user()->name }}
                        @if (auth()->user()->is_blocked)
                            <span class="bg-red-500 text-white text-sm font-medium px-2.5 py-0.5 rounded-full">
                                Blocked
                            </span>
                        @endif
                    </p>                    

                    <p>Email: {{ Auth::user()->email }}</p>
                    <p>Total Posts: {{ Auth::user()->posts->count() }}</p>
                    <p>Total Replies: {{ Auth::user()->replies->count() }}</p>

                    <form action="{{ route('user.description') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="description">Description</label>
                            <div>
                                <textarea
                                    id="description"
                                    name="description"
                                    rows="6"
                                    required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                                >{{ old('content',auth()->user()->description) }}</textarea>
                            </div>
                        </div>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Update Description</button>
                    </form>
                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">{{ session('success') }}</div>
                    @endif
                </div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-xl font-semibold mb-4">Account Actions</h2>
                <div class="space-y-4">
                    @if(session('password_status'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                            {{ session('password_status') }}
                        </div>
                    @endif

                    @if($errors->updatePassword->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                            <ul class="list-disc list-inside">
                                @foreach($errors->updatePassword->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('password.update') }}" method="post" class="space-y-4">
                        @csrf
                        @method('put')
                        <div>
                            <label for="current_password" class="block text-sm font-medium text-gray-700">Current Password</label>
                            <input type="password" name="current_password" id="current_password" required
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700">New Password</label>
                            <input type="password" name="password" id="password" required
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm New Password</label>
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
            <h2 class="text-xl font-semibold mb-4">Profile Picture</h2>
            <form action="{{ route('user.profile-picture') }}" method="POST" class="space-y-4">
                @csrf
                <div class="grid grid-cols-5 gap-4">
                    @foreach(App\Constants\ProfilePictures::IMAGES as $id => $path)
                        <div class="flex flex-col items-center space-y-2">
                            <label class="cursor-pointer">
                                <input type="radio"
                                       name="image_id"
                                       value="{{ $id }}"
                                       {{ Auth::user()->image_id == $id ? 'checked' : '' }}
                                       class="hidden peer">
                                <img src="{{ $path }}"
                                     alt="Profile Picture {{ $id }}"
                                     class="w-16 h-16 rounded-full border-2 border-transparent peer-checked:border-blue-500">
                            </label>
                        </div>
                    @endforeach
                </div>
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                    Update Profile Picture
                </button>
            </form>
        </div>
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-xl font-semibold mb-4">Your Posts</h2>
            @if(Auth::user()->posts->count() > 0)
                <div class="space-y-4">
                    @foreach(Auth::user()->posts as $post)
                        <div class="border-b pb-4">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="text-lg font-medium">
                                        <a href="{{ route('forum.show', $post->id) }}"
                                           class="text-blue-600 hover:text-blue-800">
                                            {{ $post->title }}
                                        </a>
                                    </h3>
                                    <p class="text-gray-600 text-sm">
                                        Posted on: {{ $post->created_at->format('M d, Y') }}
                                        @if($post->created_at != $post->updated_at)
                                            <span class="italic">(edited {{ $post->updated_at->format('M d, Y H:i') }})</span>
                                        @endif
                                    </p>
                                </div>
                                <div class="flex space-x-2">
                                    <a href="{{ route('forum.edit', $post->id) }}"
                                       class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm">
                                        Edit
                                    </a>
                                </div>
                            </div>
                            <p class="text-gray-800 mt-2">{{ Str::limit($post->content, 150) }}</p>
                            <div class="mt-2">
                                <a href="{{ route('forum.show', $post->id) }}"
                                   class="text-blue-600 hover:text-blue-800 text-sm">
                                    View Discussion →
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-600">You haven't created any posts yet.</p>
            @endif
        </div>
    </div>
@endsection
