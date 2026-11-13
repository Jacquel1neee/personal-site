<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        // 我们目前只有一条 Profile 数据
        $profile = Profile::first();
        return view('admin.profile.edit', compact('profile'));
    }

    public function update(Request $request)
    {
        $profile = Profile::first();

        $validated = $request->validate([
            'name_zh' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'birthday' => 'required|date',
            'city_zh' => 'required|string|max:255',
            'city_en' => 'required|string|max:255',
            'slogan_zh' => 'nullable|string|max:255',
            'slogan_en' => 'nullable|string|max:255',
            'mbti' => 'nullable|string|max:10',
            'about_zh' => 'nullable|string',
            'about_en' => 'nullable|string',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // 处理头像上传
        if ($request->hasFile('avatar')) {
            // 删掉旧头像
            if ($profile->avatar_path && Storage::disk('public')->exists($profile->avatar_path)) {
                Storage::disk('public')->delete($profile->avatar_path);
            }
            // 存新头像
            $path = $request->file('avatar')->store('avatars', 'public');
            $validated['avatar_path'] = $path;
        }

        $profile->update($validated);

        return redirect()->route('admin.profile.edit')->with('success', 'Profile updated successfully.');
    }
}