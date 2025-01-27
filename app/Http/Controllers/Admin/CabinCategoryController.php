<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Http\Controllers\Controller;
use App\Models\CabinCategory;
use Illuminate\Http\Request;

class CabinCategoryController extends Controller
{
    use HasFactory;

    public function index()
    {
        $cabins = CabinCategory::with('ship')->paginate(10);
        return view('admin.cabins.index', compact('cabins'));
    }

    public function edit(CabinCategory $cabin)
    {
        return view('admin.cabins.edit', compact('cabin'));
    }

    public function update(Request $request, CabinCategory $cabin)
    {
        $validated = $request->validate([
            'vendor_code' => 'required|string|max:50',
            'title' => 'required|string|max:255',
            'type' => 'required|in:Inside,Ocean view,Balcony,Suite',
            'description' => 'nullable',
            'photos' => 'nullable|string',
            'ordering' => 'integer|nullable',
            'state' => 'integer|nullable'
        ]);

        $cabin->update($validated);

        return redirect()->route('cabins.index', $cabin->ship_id)
            ->with('success', 'Категория каюты обновлена');
    }
}

