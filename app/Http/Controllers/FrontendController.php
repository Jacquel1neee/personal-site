<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Skill;
use App\Models\Project;
use App\Models\Experience;
use App\Models\Hobby;
use App\Models\SocialLink;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $profile = Profile::first();
        // 首页只展示前 6 个技能和前 3 个项目
        $skills = Skill::orderBy('sort_order')->take(6)->get();
        $projects = Project::orderBy('sort_order')->take(3)->get();
        $socialLinks = SocialLink::orderBy('sort_order')->get();

        return view('frontend.home', compact('profile', 'skills', 'projects', 'socialLinks'));
    }

    public function about()
    {
        $profile = Profile::first();
        $experiences = Experience::orderBy('sort_order', 'desc')->get();
        $hobbies = Hobby::orderBy('sort_order')->get();
        return view('frontend.about', compact('profile', 'experiences', 'hobbies'));
    }

    public function projects()
    {
        $projects = Project::orderBy('sort_order')->get();
        // 获取所有不同的项目分类
        $categories = Project::select('category')->distinct()->pluck('category');
        return view('frontend.projects', compact('projects', 'categories'));
    }

    public function contact()
    {
        $profile = Profile::first();
        $socialLinks = SocialLink::orderBy('sort_order')->get();
        return view('frontend.contact', compact('profile', 'socialLinks'));
    }

    public function submitContact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'content' => 'required|string|max:5000',
        ]);

        \App\Models\Message::create($validated);

        return redirect()->back()->with('success', __('frontend.contact_success'));
    }
}