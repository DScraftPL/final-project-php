@extends('layouts.app')

@section('content')
    <div class="space-y-8">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold">Admin Dashboard</h1>
                <p class="text-gray-600">Welcome, {{ auth()->user()->name }}!</p>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-blue-50 p-6 rounded-lg shadow">
                <h3 class="text-lg font-semibold mb-2">Total Users</h3>
                <p class="text-3xl font-bold">{{ \App\Models\User::count() }}</p>
            </div>
            <div class="bg-green-50 p-6 rounded-lg shadow">
                <h3 class="text-lg font-semibold mb-2">Total Forum Posts</h3>
                <p class="text-3xl font-bold">{{ \App\Models\ForumPost::count() }}</p>
            </div>
            <div class="bg-purple-50 p-6 rounded-lg shadow">
                <h3 class="text-lg font-semibold mb-2">Total Forum Replies</h3>
                <p class="text-3xl font-bold">{{ \App\Models\ForumReply::count() }}</p>
            </div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-xl font-semibold mb-4">User Management</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Name
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Email
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Posts
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Replies
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Joined
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @foreach(\App\Models\User::with(['posts', 'replies'])->get() as $user)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $user->name }}
                                @if($user->is_admin)
                                    <span class="ml-2 px-2 py-1 text-xs bg-red-100 text-red-800 rounded">Admin</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $user->email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $user->posts->count() }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $user->replies->count() }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $user->created_at->format('M d, Y') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <a href="/user/{{ $user->name }}" class="text-blue-600 hover:text-blue-900">View
                                    Profile</a>
                                    @if($user->is_admin)
                                    @else 
                                        <form action="{{ route('user.toggleBlock', ['id' => $user->id]) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            <button type="submit" class="ml-2 px-2 py-1 text-sm rounded 
                                            {{ $user->is_blocked ? 'bg-red-500 text-white hover:bg-red-600' : 'bg-green-500 text-white hover:bg-green-600' }}">
                                                    {{ $user->is_blocked ? 'Unblock' : 'Block' }}
                                            </button>
                                        </form>
                                    @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold">Your Announcements</h2>
                <a href="{{ route('announcement.create') }}"
                   class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                    Create New Announcement
                </a>
            </div>
            @if(auth()->user()->announcements->count() > 0)
                <div class="space-y-4">
                    @foreach(auth()->user()->announcements as $announcement)
                        <div class="border-b pb-4">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="text-lg font-medium">{{ $announcement->title }}</h3>
                                    <p class="text-gray-600 text-sm">Posted
                                        on: {{ $announcement->created_at->format('M d, Y') }}</p>
                                    <p class="text-gray-800 mt-2">{{ Str::limit($announcement->content, 150) }}</p>
                                </div>
                                <div class="flex space-x-2">
                                    <a href="{{ route('announcement.edit', $announcement->id) }}"
                                       class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded">
                                        Edit
                                    </a>
                                    <form action="{{ route('announcement.destroy', $announcement->id) }}" method="POST"
                                          onsubmit="return confirm('Are you sure you want to delete this announcement?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-600">You haven't created any announcements yet.</p>
            @endif
        </div>
    </div>
@endsection
