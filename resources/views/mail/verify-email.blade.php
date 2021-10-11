@component('mail::message')
# Verification Code

Your Verification Code :

**{{auth()->user()->pins()->latest()->first()->code}}**

Please Don't share to other/s.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
