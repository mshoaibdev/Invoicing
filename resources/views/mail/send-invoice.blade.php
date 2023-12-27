<x-mail::message>


Dear {{ $invoice->customer->name }},

Thank you for your recent order with {{ config('app.name') }}. We are pleased to provide you with the invoice for your order #{{ $invoice->invoice_number }}.

Please find the attached invoice for your reference. If you have any questions or concerns about the invoice, please do not hesitate to contact us.

We appreciate your business and look forward to serving you again in the future.

Best regards,


Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
