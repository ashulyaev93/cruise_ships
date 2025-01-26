<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ship;
use App\Models\ShipGallery;
use Illuminate\Http\Request;

class ShipGalleryController extends Controller
{
    public function index()
    {
        $gallery = ShipGallery::paginate(10);
        return view('admin.gallery.index', compact('gallery'));
    }

    public function create()
    {
        $ships = Ship::all();
        return view('admin.gallery.create', compact('ships'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'ship_id' => 'required|exists:ships,id',
            'title' => 'required|string|max:255',
            'url' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'ordering' => 'nullable|integer',
        ]);

        $imagePath = $request->file('url')->store('images/gallery', 'public');

        $validated['url'] = $imagePath;

        ShipGallery::create($validated);

        return redirect()->route('gallery.index')->with('success', 'Изображение успешно добавлено.');
    }

    public function show(ShipGallery $image)
    {
        return view('admin.gallery.show', compact('image'));
    }

    public function destroy(ShipGallery $image)
    {
        $ship = $image->ship;

        $image->delete();

        return redirect()->route('ships.edit', $ship)->with('success', 'Изображение удалено');
    }
}
