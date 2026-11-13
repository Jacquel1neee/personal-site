<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::orderBy('sort_order')->get();
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title_zh' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'custom_category' => 'nullable|string|max:255', // 新增：自定义分类
            'description_zh' => 'nullable|string',
            'description_en' => 'nullable|string',
            'github_url' => 'nullable|url|max:255',
            'live_url' => 'nullable|url|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        // 如果选了 Other，就用 custom_category 替换
        if ($validated['category'] === 'Other') {
            $validated['category'] = $validated['custom_category'] ?? 'Other';
        }

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('projects', 'public');
            $validated['image_path'] = $path;
        }

        $maxOrder = Project::max('sort_order') ?? 0;
        $validated['sort_order'] = $maxOrder + 1;

        Project::create($validated);

        return redirect()->route('admin.projects.index')->with('success', __('admin.proj_success_added'));
    }

    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title_zh' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'custom_category' => 'nullable|string|max:255', // 新增
            'description_zh' => 'nullable|string',
            'description_en' => 'nullable|string',
            'github_url' => 'nullable|url|max:255',
            'live_url' => 'nullable|url|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        // 如果选了 Other，就用 custom_category 替换
        if ($validated['category'] === 'Other') {
            $validated['category'] = $validated['custom_category'] ?? 'Other';
        }

        if ($request->hasFile('image')) {
            if ($project->image_path && Storage::disk('public')->exists($project->image_path)) {
                Storage::disk('public')->delete($project->image_path);
            }
            $path = $request->file('image')->store('projects', 'public');
            $validated['image_path'] = $path;
        }

        $project->update($validated);

        return redirect()->route('admin.projects.index')->with('success', __('admin.proj_success_updated'));
    }

    public function destroy(Project $project)
    {
        if ($project->image_path && Storage::disk('public')->exists($project->image_path)) {
            Storage::disk('public')->delete($project->image_path);
        }
        $project->delete();
        return redirect()->route('admin.projects.index')->with('success', __('admin.proj_success_deleted'));
    }
}