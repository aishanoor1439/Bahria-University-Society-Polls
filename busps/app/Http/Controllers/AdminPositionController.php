<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Models\Society;
use Illuminate\Http\Request;

class AdminPositionController extends Controller
{

    public function create(Society $society)
    {
        return view('admin.societies.positions.create', [
            'society' => $society
        ]);
    }

    public function store(Request $request, Society $society)
    {
        $validated = $request->validate([
            'position_name' => 'required|string|max:50',
        ]);

        $society->positions()->create($validated);

        return redirect()->route('societies.show', $society->society_id)
            ->with('success', 'Position created successfully');
    }

    public function edit(Society $society, Position $position)
    {
        return view('admin.societies.positions.edit', [
            'society' => $society,
            'position' => $position
        ]);
    }

    public function update(Request $request, Society $society, Position $position)
    {
        $validated = $request->validate([
            'position_name' => 'required|string|max:50',
        ]);

        $position->update($validated);

        return redirect()->route('societies.show', $society->society_id)
            ->with('success', 'Position updated successfully');
    }

    public function destroy(Society $society, Position $position)
    {
        $position->delete();

        return redirect()->route('societies.show', $society->society_id)
            ->with('success', 'Position deleted successfully');
    }
}
