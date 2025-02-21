<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if (isset($validated['description'])) {
            $request->user()->description = $validated['description'];
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function description(Request $request)
    {
        $validated = $request->validate([
            'description' => 'nullable|string|max:5000',
        ]);

        $user = auth()->user();
        if ($user->description == $validated['description']) {
            return redirect()->back()->with('success', 'Description has not changed...');
        }
        $user->description = $validated['description'] ?? null;
        $user->save();

        return redirect()->back()->with('success', 'Description updated successfully!');
    }

    public function updateProfilePicture(Request $request)
    {
        $validated = $request->validate([
            'image_id' => 'required|integer|min:1|max:5',
        ]);

        $user = auth()->user();
        $user->image_id = $validated['image_id'];
        $user->save();

        return redirect()->back()->with('success', 'Profile picture updated successfully!');
    }

    public function toggleBlock($id)
    {
        $user = User::findOrFail($id);
        if ($user->is_admin) {
            return redirect()->back()->with('status', 'User is an admin!');
        }
        $user->is_blocked = !$user->is_blocked;
        $user->save();
        return redirect()->back()->with('status', 'User block status updated successfully!');
    }
}
