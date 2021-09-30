@component('mail::message')
# Password Reset Link

Hello, {{$user->name}} please click "Reset Password" button, for you to reset your password!

@component('mail::button', ['url' => $link])
Reset Password
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
