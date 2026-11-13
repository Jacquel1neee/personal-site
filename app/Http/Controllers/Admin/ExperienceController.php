<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    public function index()
    {
        $experiences = Experience::orderBy('sort_order')->get();
        return view('admin.experiences.index', compact('experiences'));
    }

    public function create()
    {
        return view('admin.experiences.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_zh' => 'required|string|max:255',
            'company_en' => 'required|string|max:255',
            'role_zh' => 'required|string|max:255',
            'role_en' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'description_zh' => 'nullable|string',
            'description_en' => 'nullable|string',
            'is_current' => 'nullable|boolean',
        ]);

        // 如果勾选了“至今”，清空结束时间
        if ($request->has('is_current') && $request->is_current == 1) {
            $validated['end_date'] = null;
        }

        // 自动计算排序（按开始时间倒序）
        $maxOrder = Experience::max('sort_order') ?? 0;
        $validated['sort_order'] = $maxOrder + 1;

        Experience::create($validated);

        return redirect()->route('admin.experiences.index')->with('success', __('admin.exp_success_added'));
    }

    public function edit(Experience $experience)
    {
        return view('admin.experiences.edit', compact('experience'));
    }

    public function update(Request $request, Experience $experience)
    {
        $validated = $request->validate([
            'company_zh' => 'required|string|max:255',
            'company_en' => 'required|string|max:255',
            'role_zh' => 'required|string|max:255',
            'role_en' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'description_zh' => 'nullable|string',
            'description_en' => 'nullable|string',
            'is_current' => 'nullable|boolean',
        ]);

        if ($request->has('is_current') && $request->is_current == 1) {
            $validated['end_date'] = null;
        }

        $experience->update($validated);

        return redirect()->route('admin.experiences.index')->with('success', __('admin.exp_success_updated'));
    }

    public function destroy(Experience $experience)
    {
        $experience->delete();
        return redirect()->route('admin.experiences.index')->with('success', __('admin.exp_success_deleted'));
    }
}