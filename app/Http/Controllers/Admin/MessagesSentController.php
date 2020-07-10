<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Message;
use Illuminate\Http\Request;

class MessagesSentController extends Controller
{
    public function index()
    {
        $messages = auth()->user()->messages()->latest()->get();

        return view('admin.messages.index', [
            'messages' => $messages,
            'folder' => 'sent'
        ]);
    }
}
