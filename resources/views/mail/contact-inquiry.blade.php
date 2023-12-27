<x-mail::message>

New Contact Inquiry

Name: {{ $formData['name'] }} <br/>
Email: {{ $formData['email'] }} <br/>
Phone: {{ $formData['phone'] }} <br/>
Message: {{ $formData['message'] }}<br/>

Date: {{ date('Y-m-d') }}

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
