@component('mail::message')
# OTP for Login

Your OTP is: {{ $otp }}

This OTP is valid for a short period. Please do not share it with anyone.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
