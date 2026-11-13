<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SocialLink;
use Illuminate\Http\Request;

class SocialLinkController extends Controller
{
    public function index()
    {
        $links = SocialLink::orderBy('sort_order')->get();
        return view('admin.social-links.index', compact('links'));
    }

    public function create()
    {
        return view('admin.social-links.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'platform' => 'required|string|max:255',
            'url' => 'required|string|max:255', // 允许 mailto: 等非标准 URL
            'icon' => 'nullable|string|max:50',
        ]);

        $maxOrder = SocialLink::max('sort_order') ?? 0;
        $validated['sort_order'] = $maxOrder + 1;

        SocialLink::create($validated);

        return redirect()->route('admin.social-links.index')->with('success', __('admin.social_success_added'));
    }

    public function edit(SocialLink $socialLink)
    {
        return view('admin.social-links.edit', ['link' => $socialLink]);
    }

    public function update(Request $request, SocialLink $socialLink)
    {
        $validated = $request->validate([
            'platform' => 'required|string|max:255',
            'url' => 'required|string|max:255',
            'icon' => 'nullable|string|max:50',
        ]);

        $socialLink->update($validated);

        return redirect()->route('admin.social-links.index')->with('success', __('admin.social_success_updated'));
    }

    public function destroy(SocialLink $socialLink)
    {
        $socialLink->delete();
        return redirect()->route('admin.social-links.index')->with('success', __('admin.social_success_deleted'));
    }
}