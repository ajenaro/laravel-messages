<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Message;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class MessagesTrashController extends Controller
{
    public function index()
    {
        $messages = Message::whereHas('recipients', function (Builder $query) {
            $query->where('recipient_id', auth()->user()->id);
            $query->onlyTrashed();
        })->latest()->get();

        return view('admin.messages.index', [
            'messages' => $messages,
            'folder' => 'trash'
        ]);
    }

    public function update(Message $message)
    {
        $message_trash = $message->whereHas('recipients', function (Builder $query) use ($message) {
            $query->where('message_id', $message->id);
            $query->where('recipient_id', auth()->user()->id);
            $query->onlyTrashed();
        })->first();

        $message_trash->recipients()->restore();

        return back()->with('flash', 'Message restored');
    }
}
