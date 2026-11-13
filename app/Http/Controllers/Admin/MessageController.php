<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::orderBy('created_at', 'desc')->get();
        return view('admin.messages.index', compact('messages'));
    }

    public function toggleRead(Message $message)
    {
        $message->update(['is_read' => !$message->is_read]);
        
        $msg = $message->is_read ? __('admin.msg_success_read') : __('admin.msg_success_unread');
        return redirect()->back()->with('success', $msg);
    }

    public function destroy(Message $message)
    {
        $message->delete();
        return redirect()->route('admin.messages.index')->with('success', __('admin.msg_success_deleted'));
    }
}