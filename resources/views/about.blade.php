@extends('layouts.app')

@section('content')
    <div class="space-y-6">
        <div class="bg-white p-6 rounded-lg shadow">
            <h1 class="text-2xl font-bold mb-4">Hello There!</h1>
            <div class="space-y-4">
                <p class="text-gray-600">
                    I made this website for university project. Tech used is Laravel 11 + Blade, using Laravel Breeze template.
                </p>

                <div>
                    <h2 class="text-xl font-semibold mb-3">Website Features</h2>
                    <p class="text-gray-600 mb-4">Website is a simple forum that supports:</p>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <ul class="space-y-3">
                            <li class="flex items-start">
                                <span class="text-blue-500 mr-2">•</span>
                                <span>User Management: Creating new users, Deleting users, Changing user password</span>
                            </li>
                            <li class="flex items-start">
                                <span class="text-blue-500 mr-2">•</span>
                                <span>Forum Features: Creating new posts, Deleting posts, Replying to posts</span>
                            </li>
                            <li class="flex items-start">
                                <span class="text-blue-500 mr-2">•</span>
                                <span>User's profile page</span>
                            </li>
                            <li class="flex items-start">
                                <span class="text-blue-500 mr-2">•</span>
                                <span>Admin's dashboard for managing the website</span>
                            </li>
                            <li class="flex items-start">
                                <span class="text-blue-500 mr-2">•</span>
                                <span>Global announcements page</span>
                            </li>
                            <li class="flex items-start">
                                <span class="text-red-500 mr-2">•</span>
                                <span>To Do: Profile Picture, user can edit posts, admin to block people</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
