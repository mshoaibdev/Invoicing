@component('mail::layout')
{{-- Header --}}
@slot('header')
    @component('mail::header', ['url' => ''])
    @if($invoice->company->logo_url)
        <img class="header-logo" src="{{$invoice->company->logo_url}}" alt="{{$invoice->company->name}}" style="height: 90px">
    @else
        {{$invoice->company->name}}
    @endif
    @endcomponent
@endslot

{!! $body !!}

{{-- Subcopy --}}
@slot('subcopy')
    @component('mail::subcopy')
       
        @component('mail::button', ['url' => $invoice->invoice_link])
                View Invoice
            @endcomponent
    @endcomponent
@endslot

{{-- Footer --}}
@slot('footer')
    @component('mail::footer')
        Powered by <a class="footer-link" href="#">Secure Invoice CRM</a>
    @endcomponent
@endslot
@endcomponent
