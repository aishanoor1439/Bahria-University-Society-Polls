<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Election;
use App\Models\Society;

class AdminElectionController extends Controller
{
    public function index()
    {
        $elections = Election::with('society')->latest()->get();
        return view('admin.elections.index', compact('elections'));
    }

    public function create()
    {
        $societies = Society::all();
        return view('admin.elections.create', compact('societies'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'society_id' => 'required|exists:societies,society_id',
            'election_name' => 'required|string|max:50',
            'election_year' => 'required|digits:4|integer|min:2025|max:2030' . (date('Y') + 1),
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        Election::create($validated);

        return redirect()->route('admin.elections.index')
            ->with('success', 'Election created successfully');
    }

    public function show(string $id)
    {
        // Implement if needed
    }

    public function edit(string $id)
    {
        $election = Election::findOrFail($id);
        $societies = Society::all();
        return view('admin.elections.edit', compact('election', 'societies'));
    }

    public function update(Request $request, string $id)
    {
        $election = Election::findOrFail($id);
        
        $validated = $request->validate([
            'society_id' => 'required|exists:societies,society_id',
            'election_name' => 'required|string|max:255',
            'election_year' => 'required|digits:4|integer|min:1900|max:' . (date('Y') + 1),
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        $election->update($validated);

        return redirect()->route('admin.elections.index')
            ->with('success', 'Election updated successfully');
    }

    public function destroy(string $id)
    {
        $election = Election::findOrFail($id);
        $election->delete();
        
        return redirect()->route('admin.elections.index')
            ->with('success', 'Election deleted successfully');
    }

    public function toggleActive(Election $election)
    {
        $election->update(['is_active' => !$election->is_active]);
        return back()->with('success', 'Election status updated');
    }
}