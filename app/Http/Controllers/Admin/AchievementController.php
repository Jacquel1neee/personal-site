<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Achievement;
use Illuminate\Http\Request;

class AchievementController extends Controller
{
    public function index()
    {
        $achievements = Achievement::orderBy('sort_order', 'desc')->get();
        return view('admin.achievements.index', compact('achievements'));
    }

    public function create()
    {
        return view('admin.achievements.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title_zh' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'issuer_zh' => 'required|string|max:255',
            'issuer_en' => 'required|string|max:255',
            'year' => 'required|string|max:10',
        ]);

        $maxOrder = Achievement::max('sort_order') ?? 0;
        $validated['sort_order'] = $maxOrder + 1;

        Achievement::create($validated);

        return redirect()->route('admin.achievements.index')->with('success', __('admin.ach_success_added'));
    }

    public function edit(Achievement $achievement)
    {
        return view('admin.achievements.edit', compact('achievement'));
    }

    public function update(Request $request, Achievement $achievement)
    {
        $validated = $request->validate([
            'title_zh' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'issuer_zh' => 'required|string|max:255',
            'issuer_en' => 'required|string|max:255',
            'year' => 'required|string|max:10',
            'type' => 'required|string|max:50', 
            'custom_type' => 'nullable|string|max:50', 
        ]);

        if ($validated['type'] === 'Other') {
            $validated['type'] = $validated['custom_type'] ?? 'Other';
        }

        $achievement->update($validated);

        return redirect()->route('admin.achievements.index')->with('success', __('admin.ach_success_updated'));
    }

    public function destroy(Achievement $achievement)
    {
        $achievement->delete();
        return redirect()->route('admin.achievements.index')->with('success', __('admin.ach_success_deleted'));
    }
}