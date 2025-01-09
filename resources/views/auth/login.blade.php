@extends('layouts.app')

@section('content')
    <div class="max-w-md mx-auto">
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-2xl font-bold mb-6">Login</h2>
            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    @error('email')
                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" name="password" required
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    @error('password')
                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex items-center">
                    <input type="checkbox" name="remember" id="remember" class="rounded border-gray-300 text-blue-600">
                    <label for="remember" class="ml-2 text-sm text-gray-600">Remember me</label>
                </div>

                <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                    Log in
                </button>
            </form>
        </div>
    </div>
@endsection
