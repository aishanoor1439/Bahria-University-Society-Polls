<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Models\Society;
use Illuminate\Http\Request;

class AdminPositionController extends Controller
{
    public function store(Request $request, Society $society)
    {
        $request->validate([
            'position_name' => 'required|string|max:255',
        ]);

        $society->positions()->create($request->only('position_name'));

        return redirect()->route('societies.show', $society->society_id)
            ->with('success', 'Position added successfully.');
    }

    public function update(Request $request, Society $society, Position $position)
    {
        $request->validate([
            'position_name' => 'required|string|max:255',
        ]);

        $position->update($request->only('position_name'));

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