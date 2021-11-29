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
        ])->latest()->get();

        return view('chat', compact('messages'));
    }
}
