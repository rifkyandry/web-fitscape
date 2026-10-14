<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function index()
    {
        $announcements = Announcement::orderBy('created_at', 'desc')->get();
        return view('admin.announcements.index', compact('announcements'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:200',
            'body'  => 'required|string',
            'type'  => 'required|in:info,promo,warning',
        ]);

        Announcement::create([
            'title'        => $request->title,
            'body'         => $request->body,
            'type'         => $request->type,
            'is_active'    => true,
            'published_at' => now(),
        ]);

        return back()->with('success', 'Pengumuman berhasil dibuat!');
    }

    public function destroy(Announcement $announcement)
    {
        $announcement->delete();
        return back()->with('success', 'Pengumuman dihapus.');
    }

    public function toggle(Announcement $announcement)
    {
        $announcement->update(['is_active' => !$announcement->is_active]);
        return back()->with('success', 'Status pengumuman diperbarui.');
    }
}