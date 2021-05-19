@component('mail::message')
# Verifikasi Email

Silahkan klik button ini untuk verifikasi email.

@component('mail::button', [
	'url' => route('verify.email', [
		'token' => $data['token'],
        'email' => $data['email']
	])
])
Verifikasi
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
