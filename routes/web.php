<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ForumPostController;
use App\Http\Controllers\ForumReplyController;
use App\Models\User;

Route::get('/', [ForumPostController::class, 'home'])->name('forum_posts.index');

Route::get('/about', function () {
    return view('about');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/user/{userName}', function($userName) {
    $user = User::where('name', 'LIKE', "%$userName%") -> first();
    return view('user', ['user' => $user]);
});

Route::get('/comments', [CommentController::class, 'index']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/forum', [ForumPostController::class, 'index'])->name('forum.index');
    Route::get('/forum/create', [ForumPostController::class, 'create'])->name('forum.create');
    Route::post('/forum', [ForumPostController::class, 'store'])->name('forum.store');
    Route::post('/replies', [ForumReplyController::class, 'store'])->name('replies.store');
    Route::get('/forum/{id}', [ForumPostController::class, 'show'])->name('forum.show');
});

require __DIR__.'/auth.php';
