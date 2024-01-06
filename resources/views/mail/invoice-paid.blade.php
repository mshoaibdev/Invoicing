@component('mail::layout')
{{-- Header --}}
@slot('header')
    @component('mail::header', ['url' => ''])
    @if($invoice->company->logo_url)
        <img class="header-logo" src="{{$invoice->company->logo_url}}" alt="{{$invoice->company->name}}" style="height: 90px">
    @else
        {{$$invoice->company->name}}
    @endif
    @endcomponent
@endslot


{{-- Body --}}

@component('mail::panel')
    
Hi {{$invoice->customer->name}},<br>
Your invoice has been paid.<br>


**Invoice Details**<br>

Invoice Number: {{$invoice->invoice_id}}<br>
Invoice Date: {{$invoice->invoice_date}}<br>
Due Date: {{$invoice->due_date}}<br>
Amount: {{$invoice->total}}<br>
Paid Date: {{ date('Y-m-d') }}<br>
Payment Method: {{$invoice->paymentMethod->name}}<br>

@endcomponent



{{-- Footer --}}
@slot('footer')
    @component('mail::footer')
        Powered by <a class="footer-link" href="#">Secure Invoice CRM</a>
    @endcomponent
@endslot
@endcomponent
