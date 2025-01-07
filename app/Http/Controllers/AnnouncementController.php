<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function getRecentAnnouncements()
    {
        return Announcement::latest()->take(3)->get();
    }

    public function create()
    {
        return view('announcement.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);
        Announcement::create([
            'author_id' => auth()->id(),
            'title' => $validated['title'],
            'description' => $validated['description'],
        ]);
        return redirect()->route('announcement.index');
    }

    public function index()
    {
        $announcements = Announcement::latest()->paginate(5);
        return view('announcement.index', compact('announcements'));
    }

    public function edit($id)
    {
        $announcement = Announcement::findOrFail($id);
        return view('announcement.edit', compact('announcement'));
    }

    public function update(Request $request, $id)
    {
        $announcement = Announcement::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $announcement->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
        ]);

        return redirect()->route('announcement.index')->with('success', 'Announcement updated successfully.');
    }

    public function destroy($id)
    {
        $announcement = Announcement::findOrFail($id);
        $announcement->delete();

        return redirect()->route('announcement.index')->with('success', 'Announcement deleted successfully.');
    }
}
