<?php

namespace App\Http\Controllers;

use App\Models\Ruko;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class RukoController extends Controller
{
    // User endpoints
    public function index(Request $request)
    {
        $query = Ruko::query();

        if ($request->filled('search')) {
            $search = '%' . $request->search . '%';
            $query->where(function ($q) use ($search) {
                $q->where('name', 'ilike', $search)
                  ->orWhere('address', 'ilike', $search);
            });
        }

        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // Available ones first, then rented
        $rukos = $query->orderByRaw("CASE WHEN status = 'available' THEN 0 ELSE 1 END")->get();

        return view('katalog', compact('rukos'));
    }

    public function show(Ruko $ruko)
    {
        return view('detail_ruko', compact('ruko'));
    }

    public function edit(Ruko $ruko)
    {
        return view('admin.ruko.edit', compact('ruko'));
    }

    // Admin endpoints
    public function adminIndex()
    {
        $rukos = Ruko::all();
        return view('admin.ruko.index', compact('rukos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'price' => 'required|numeric',
            'photos.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        $photoPaths = [];
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('ruko_photos', 'public');
                $photoPaths[] = $path;
            }
        }

        Ruko::create([
            'name' => $request->name,
            'address' => $request->address,
            'price' => $request->price,
            'status' => 'available',
            'photos' => $photoPaths,
        ]);

        return redirect()->route('admin.ruko.index')->with('success', 'Ruko berhasil ditambahkan.');
    }

    public function update(Request $request, Ruko $ruko)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'price' => 'required|numeric',
            'status' => 'required|in:available,booked,rented',
            'photos.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        $photoPaths = $ruko->photos ?? [];
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('ruko_photos', 'public');
                $photoPaths[] = $path;
            }
        }

        $ruko->update([
            'name' => $request->name,
            'address' => $request->address,
            'price' => $request->price,
            'status' => $request->status,
            'photos' => $photoPaths,
        ]);

        return redirect()->route('admin.ruko.index')->with('success', 'Ruko berhasil diupdate.');
    }

    public function destroy(Ruko $ruko)
    {
        if ($ruko->photos) {
            foreach ($ruko->photos as $photo) {
                if (!Str::startsWith($photo, 'http')) {
                    Storage::disk('public')->delete($photo);
                }
            }
        }
        $ruko->delete();
        return redirect()->route('admin.ruko.index')->with('success', 'Ruko berhasil dihapus.');
    }
}
