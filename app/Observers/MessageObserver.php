<?php

namespace App\Observers;

use App\Models\Message;

class MessageObserver
{
    public function creating(Message $message)
    {
        $message->sender_id = auth()->user()->id;
    }
}
