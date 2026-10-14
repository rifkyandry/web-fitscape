<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MembershipPackage;
use Illuminate\Http\Request;

class MembershipController extends Controller
{
    public function index()
    {
        $packages = MembershipPackage::latest()->get();
        return view('admin.memberships.index', compact('packages'));
    }

    public function create()
    {
        return view('admin.memberships.create');
    }

   public function store(Request $request)
{
    $request->validate([
        'name'             => 'required|string|max:255',
        'description'      => 'nullable|string',
        'price'            => 'required|numeric|min:0',
        'duration_months'  => 'required|integer|min:1|max:24',
    ]);

    MembershipPackage::create([
        'name'          => $request->name,
        'description'   => $request->description,
        'price'         => $request->price,
        'duration_days' => $request->duration_months * 30,
        'color'         => '#6B7280',
        'is_active'     => true,
    ]);

    return redirect()->route('admin.memberships.index')
                     ->with('success', 'Paket berhasil ditambahkan!');
}

    public function edit(MembershipPackage $membership)
    {
        return view('admin.memberships.edit', compact('membership'));
    }

    
public function update(Request $request, MembershipPackage $membership)
{
    $request->validate([
        'name'             => 'required|string|max:255',
        'description'      => 'nullable|string',
        'price'            => 'required|numeric|min:0',
        'duration_months'  => 'required|integer|min:1|max:24',
    ]);

    $membership->update([
        'name'          => $request->name,
        'description'   => $request->description,
        'price'         => $request->price,
        'duration_days' => $request->duration_months * 30,
    ]);

    return redirect()->route('admin.memberships.index')
                     ->with('success', 'Paket berhasil diperbarui!');
}

    public function destroy(MembershipPackage $membership)
    {
        $membership->delete();
        return redirect()->route('admin.memberships.index')
                         ->with('success', 'Paket berhasil dihapus!');
    }
}