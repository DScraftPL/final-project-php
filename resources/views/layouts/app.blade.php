<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Forum Project</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 flex flex-col min-h-screen">

<header class="bg-blue-600 text-white py-4 ">
    <div class="flex flex-row mx-8">
        <div class="container mx-auto">
            <h1 class="text-2xl font-bold">Welcome to Simple Forum Project</h1>
            @guest
                <a href="{{ route('login') }}" class="text-white hover:underline mr-4">Login</a>
                <a href="{{ route('register') }}" class="text-white hover:underline">Register</a>
            @else
                <span class="mr-4">Hello, {{ Auth::user()->name }}!</span>
                <form action="{{ route('dashboard') }}" class="inline">
                    @csrf
                    <button type="submit" class="text-white hover:underline">Dashboard</button>
                </form>
            @endguest
        </div>
        <div>
            <a href="/" class="text-white hover:underline mr-4">Home</a>
            <a href="/about" class="text-white hover:underline mr-4">About</a>
            <a href="/forum" class="text-white hover:underline mr-4">Forum</a>
        </div>
    </div>
</header>

<main class="container mx-auto py-8 flex-grow">
    <div class="flex flex-row justify-between space-x-4 h-full">
        <div class="border p-4 rounded-lg shadow-lg flex-grow h-full">
            @yield('content')
        </div>
        <div class="h-full space-y-4">
            @guest
            @else
                <div class="border p-4 rounded-lg shadow-lg">
                    <a href="/forum/create"><h1>Create Post</h1></a>
                </div>
            @endguest
            <div class="border p-4 rounded-lg shadow-lg">
                <h1>Announcements</h1>
                <ul>
                    <li>witam</li>
                    <li>tu wiacker</li>
                    <li>heheheheheh</li>
                </ul>
            </div>
        </div>
    </div>
</main>

<footer class="bg-gray-800 text-white py-4 mt-8">
    <div class="container mx-auto text-center">
        <p>&copy;{{ date('Y') }} Simple Corporation, Kacper Wiącek. All rights reserved.</p>
    </div>
</footer>

</body>
</html>
