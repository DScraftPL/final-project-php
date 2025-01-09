@extends('layouts.app')

@section('content')
    <div class="max-w-md mx-auto">
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-2xl font-bold mb-6">Register</h2>
            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    @error('name')
                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

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

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                    <input type="password" name="password_confirmation" required
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                </div>

                <div class="flex items-center justify-between">
                    <a href="{{ route('login') }}" class="text-sm text-blue-600 hover:text-blue-800">Already registered?</a>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                        Register
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
