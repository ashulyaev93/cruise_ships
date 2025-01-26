<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ship;
use Illuminate\Http\Request;

class ShipController extends Controller
{
    public function index()
    {
        $ships = Ship::paginate(10);
        return view('admin.ships.index', compact('ships'));
    }

    public function edit(Ship $ship)
    {
        $cabinCategories = $ship->cabinCategories;
        $gallery = $ship->gallery;
        return view('admin.ships.edit', compact('ship', 'cabinCategories', 'gallery'));
    }

    public function update(Request $request, Ship $ship)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'spec' => 'nullable|string',
            'description' => 'nullable|string',
            'ordering' => 'integer|nullable',
            'state' => 'integer|nullable'
        ]);

        $ship->update($validated);
        return redirect()->route('ships.edit', $ship)->with('success', 'Корабль обновлен');
    }
}

