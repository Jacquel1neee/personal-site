<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hobby;
use Illuminate\Http\Request;

class HobbyController extends Controller
{
    public function index()
    {
        $hobbies = Hobby::orderBy('sort_order')->get();
        return view('admin.hobbies.index', compact('hobbies'));
    }

    public function create()
    {
        return view('admin.hobbies.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name_zh' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'icon' => 'nullable|string|max:50',
            'description_zh' => 'nullable|string',
            'description_en' => 'nullable|string',
        ]);

        $maxOrder = Hobby::max('sort_order') ?? 0;
        $validated['sort_order'] = $maxOrder + 1;

        Hobby::create($validated);

        return redirect()->route('admin.hobbies.index')->with('success', __('admin.hobby_success_added'));
    }

    public function edit(Hobby $hobby)
    {
        return view('admin.hobbies.edit', compact('hobby'));
    }

    public function update(Request $request, Hobby $hobby)
    {
        $validated = $request->validate([
            'name_zh' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'icon' => 'nullable|string|max:50',
            'description_zh' => 'nullable|string',
            'description_en' => 'nullable|string',
        ]);

        $hobby->update($validated);

        return redirect()->route('admin.hobbies.index')->with('success', __('admin.hobby_success_updated'));
    }

    public function destroy(Hobby $hobby)
    {
        $hobby->delete();
        return redirect()->route('admin.hobbies.index')->with('success', __('admin.hobby_success_deleted'));
    }
}