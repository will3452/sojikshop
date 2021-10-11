<?php

namespace App\Observers;

use App\Models\User;
use App\Mail\VerifyEmail;
use Illuminate\Support\Facades\Mail;

class UserObserver
{
    public function created(User $user)
    {
        Mail::to($user)->send(new VerifyEmail());
    }
}
