<x-mail::message>

Hi {{ $user['first_name'] }} {{ $user['last_name'] }},

Your account has been created. Please use the following credentials to login.

**Email:** {{ $user['email'] }}

**Password:** {{ $user['password'] }}

<x-mail::button :url="url('/')">
Login
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
