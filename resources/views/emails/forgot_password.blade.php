@component('mail::message')
hi, {{$user->name}}.Forgot password?
<p> It happens</p>
@component('mail::button',['url'=>url('reset/'.$user->remember_token)])
reset your password
@endcomponent
Thanks, <br>
{{config('app.name')}}
@endcomponent
