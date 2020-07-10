<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Message;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessagesInboxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $messages = Message::whereHas('recipients', function ($query) {
            $query->where('recipient_id', auth()->user()->id);
            $query->whereNull('deleted_at');
        })->latest()->get();

        return view('admin.messages.index', [
            'messages' => $messages,
            'folder' => 'inbox'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.messages.create', [
            'message' => new Message(),
            'users' => User::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'recipients' => 'required',
            'subject' => 'required',
            'body' => 'required',
        ]);

        $message = Message::create([
           'sender_id' => Auth::user()->id,
           'subject' => $request['subject'],
           'body' => $request['body'],
       ]);

        foreach ($request['recipients'] as $recipient_id) {

            $message->recipients()->create(['recipient_id' => $recipient_id]);
        }

        return redirect()->route('admin.messages.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Message $message
     */
    public function show(Message $message)
    {
        $message_recipient = $message->whereHas('recipients', function ($query) use ($message) {
            $query->where('message_id', $message->id);
            $query->where('recipient_id', auth()->user()->id);
        })->first();

        if($message_recipient)
            $message_recipient->recipients()->update(['read_at' => Carbon::now()]);

        return view('admin.messages.show', [
            'message' => $message,
            'users' => User::all()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit(Message $message)
    {
        return view('admin.messages.edit', [
            'users' => User::all(),
            'message' => $message
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Message $message
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Message $message)
    {
        $message_recipient = $message->whereHas('recipients', function ($query) use ($message) {
            $query->where('message_id', $message->id);
            $query->where('recipient_id', auth()->user()->id);
        })->first();

        if(is_null($message_recipient->recipients[0]->read_at)) {

            $message_recipient->recipients()->update(['read_at' => Carbon::now()]);
            $result = 'Message mark as read';
        } else {
            $message_recipient->recipients()->update(['read_at' => null]);
            $result = 'Message mark as unread';
        }

        return back()->with('flash', $result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Message $message
     */
    public function destroy(Message $message)
    {
        $message_recipient = $message->whereHas('recipients', function ($query) use ($message) {
            $query->where('message_id', $message->id);
            $query->where('recipient_id', auth()->user()->id);
        })->first();

        $message_recipient->recipients()->delete();

        //return back()->with('flash', 'Mensaje eliminado correctamente');
        return redirect()->route('admin.messages.index')->with('flash', 'Message delete successfully');
    }
}
