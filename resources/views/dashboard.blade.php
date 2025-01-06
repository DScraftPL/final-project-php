@extends('layouts.app')

@section('content')
    <h1>You are logged in!</h1>
    <?php
    $currentUser = Auth::user();
    $userName = $currentUser->name;
    echo $userName.'<br />';
    ?>
    <form action="{{ route('logout') }}" method="post" class="inline">
        @csrf
        <button type="submit" class="text-black hover:underline">Logout</button>
    </form>
@endsection
