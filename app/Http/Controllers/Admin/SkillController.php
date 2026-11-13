<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function index(Request $request)
    {
        $query = Skill::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $skills = $query->orderBy('category')->orderBy('sort_order')->get();
        $categories = Skill::select('category')->distinct()->pluck('category');

        // 如果是 AJAX 请求，只返回表格部分的 HTML
        if ($request->ajax()) {
            return view('admin.skills.partials.table', compact('skills'))->render();
        }

        return view('admin.skills.index', compact('skills', 'categories'));
    }

    public function create()
    {
        $categories = Skill::select('category')->distinct()->pluck('category');
        return view('admin.skills.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'remark' => 'nullable|string|max:255',
        ]);

        // 如果选了 Other，就把 remark 当成 category 存
        if ($validated['category'] === 'Other') {
            $validated['category'] = $validated['remark'] ?? 'Other';
        }

        // 自动计算 sort_order
        $maxOrder = Skill::where('category', $validated['category'])->max('sort_order') ?? 0;
        $validated['sort_order'] = $maxOrder + 1;

        Skill::create($validated);

        return redirect()->route('admin.skills.index')->with('success', 'Skill added successfully.');
    }

    public function edit(Skill $skill)
    {
        $categories = Skill::select('category')->distinct()->pluck('category');
        return view('admin.skills.edit', compact('skill', 'categories'));
    }

    public function update(Request $request, Skill $skill)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'remark' => 'nullable|string|max:255',
        ]);

        if ($validated['category'] === 'Other') {
            $validated['category'] = $validated['remark'] ?? 'Other';
        }

        // 如果分类变了，重新计算 sort_order
        if ($skill->category !== $validated['category']) {
            $maxOrder = Skill::where('category', $validated['category'])->max('sort_order') ?? 0;
            $validated['sort_order'] = $maxOrder + 1;
        }

        $skill->update($validated);

        return redirect()->route('admin.skills.index')->with('success', 'Skill updated successfully.');
    }

    public function destroy(Skill $skill)
    {
        $skill->delete();
        return redirect()->route('admin.skills.index')->with('success', 'Skill deleted successfully.');
    }
}