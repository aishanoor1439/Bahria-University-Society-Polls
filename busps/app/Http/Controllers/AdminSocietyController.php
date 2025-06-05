<?php
// app/Http/Controllers/SocietyController.php

namespace App\Http\Controllers;

use App\Models\Society;
use Illuminate\Http\Request;

class AdminSocietyController extends Controller
{
    public function index()
    {
        $societies = Society::all();
        return view('admin.societies.index', compact('societies'));
    }

    public function create()
    {
        return view('admin.societies.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'society_name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Society::create($request->all());

        return redirect()->route('societies.index')
            ->with('success', 'Society created successfully.');
    }

    public function show(Society $society)
    {
        $positions = $society->positions;
        return view('admin.societies.show', compact('society', 'positions'));
    }

    public function edit(Society $society)
    {
        return view('admin.societies.edit', compact('society'));
    }

    public function update(Request $request, Society $society)
    {
        $request->validate([
            'society_name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $society->update($request->all());

        return redirect()->route('societies.index')
            ->with('success', 'Society updated successfully');
    }

    public function destroy(Society $society)
    {
        $society->delete();

        return redirect()->route('societies.index')
            ->with('success', 'Society deleted successfully');
    }
}
