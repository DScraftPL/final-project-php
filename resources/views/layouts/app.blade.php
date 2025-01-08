<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Forum Project</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 flex flex-col min-h-screen">
<header class="bg-blue-600 text-white py-4 shadow-lg">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold">Simple Forum Project</h1>
                <div class="mt-2 space-x-4">
                    @guest
                        <a href="{{ route('login') }}" class="text-white hover:text-blue-100">Login</a>
                        <a href="{{ route('register') }}" class="text-white hover:text-blue-100">Register</a>
                    @else
                        <span class="text-blue-100">Hello, {{ Auth::user()->name }}!</span>
                        <a href="/dashboard" class="text-white hover:text-blue-100 ml-4">Dashboard</a>
                        @if(auth()->user()->is_admin)
                            <a href="/admin" class="bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600 ml-4">Admin</a>
                        @endif
                    @endguest
                </div>
            </div>
            <nav class="space-x-6">
                <a href="/" class="text-white hover:text-blue-100">Home</a>
                <a href="/about" class="text-white hover:text-blue-100">About</a>
                <a href="/forum" class="text-white hover:text-blue-100">Forum</a>
            </nav>
        </div>
    </div>
</header>

<main class="container mx-auto py-8 px-4 flex-grow">
    <div class="flex flex-col md:flex-row gap-6">
        <div class="flex-grow">
            <div class="bg-white rounded-lg shadow-lg p-6">
                @yield('content')
            </div>
        </div>

        <div class="md:w-64 space-y-6">
            @guest
            @else
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <a href="/forum/create"
                       class="block w-full bg-blue-500 text-white text-center px-4 py-2 rounded hover:bg-blue-600">
                        Create New Post
                    </a>
                </div>
            @endguest

            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h2 class="text-xl font-semibold mb-4">
                    <a href="/announcement" class="hover:text-blue-600">Announcements</a>
                </h2>
                <ul class="space-y-3">
                    @php
                        $recentAnnouncements = (new \App\Http\Controllers\AnnouncementController)->getRecentAnnouncements();
                    @endphp
                    @foreach($recentAnnouncements as $announcement)
                        <li>
                            <h3 class="font-medium text-gray-800 hover:text-blue-600">
                                {{ $announcement->title }}
                            </h3>
                        </li>
                    @endforeach
                    @if($recentAnnouncements->isEmpty())
                        <li class="text-gray-600">No announcements yet</li>
                    @endif
                    @if(auth()->check() && auth()->user()->is_admin)
                        <li class="pt-4 border-t mt-4">
                            <a href="{{ route('announcement.create') }}"
                               class="text-blue-600 hover:text-blue-800">
                                Create Announcement →
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</main>

<footer class="bg-gray-800 text-white py-6 mt-8">
    <div class="container mx-auto px-4 text-center">
        <p>&copy; {{ date('Y') }} Simple Corporation, Kacper Wiącek. All rights reserved.</p>
    </div>
</footer>
</body>
</html>
