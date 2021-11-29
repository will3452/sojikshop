<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Message;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function showMessage(User $user)
    {
        $messages = Message::where([
            'sender_id' => $user->id,
            'receiver_id' => auth()->user()->id,
        ])->orWhere([
            'sender_id' => auth()->user()->id,
            'receiver_id' => $user->id,
        ])->get();

        return view('chat', compact('messages', 'user'));
    }

    public function postMessage()
    {
        $data = request()->validate([
            'receiver_id' => 'required',
            'content' => 'required',
        ]);

        Message::create($data);
        return back();
    }
}
