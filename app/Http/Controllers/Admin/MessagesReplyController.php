<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Message;
use Illuminate\Http\Request;

class MessagesReplyController extends Controller
{
    public function update(Request $request, Message $message)
    {
        $this->validate($request, [
            'sender_id' => 'required',
            'subject' => 'required',
            'body' => 'required'
        ]);

        $new_message = Message::create([
            'message_id' => $message->id,
            'sender_id' => auth()->user()->id,
            'subject' => 'Re: ' . $request['subject'],
            'body' =>
                $request['body'] .
                '<p>-----<smal> Send: ' . $message->created_at->format("d/m/Y") . ' to ' . $message->created_at->format("H:i:s") . '</smal>-----</p>'
                . $message->body
        ]);

        foreach ($request['sender_id'] as $recipient_id) {
            $new_message->recipients()->create(['recipient_id' => $recipient_id]);
        }

        return redirect()->route('admin.messages.index')->with('flash', 'Message send successfully');
    }
}
