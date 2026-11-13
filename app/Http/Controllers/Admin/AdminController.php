<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use App\Models\Project;
use App\Models\Experience;
use App\Models\Message;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'skills' => Skill::count(),
            'projects' => Project::count(),
            'experiences' => Experience::count(),
            'messages' => Message::count(),
            'unread_messages' => Message::where('is_read', false)->count(),
        ];

        // 获取最新 3 条留言
        $recent_messages = Message::orderBy('created_at', 'desc')->take(3)->get();

        return view('admin.dashboard', compact('stats', 'recent_messages'));
    }
}