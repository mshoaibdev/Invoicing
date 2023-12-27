<x-mail::message>

Dear {{ $estimate->customer->name }},

Thank you for considering {{ config('app.name') }} for your {{ $estimate->title }}. We are excited to work with you and provide you with a high-quality solution that meets your needs.

Based on our initial discussions, we have prepared an estimate for the project. Please find the details below:

## Estimtate Details

**Estimate Title:** {{ $estimate->title }}

**Estimate Description:** {{ $estimate->note }}

**Estimated Cost:** ${{ $estimate->total }}

We believe that this estimate accurately reflects the scope of the project and the work required to complete it. However, please note that this is an estimate and the final cost may vary depending on any changes or additions to the project scope.

If you have any questions or concerns about the estimate, please do not hesitate to contact us. We are happy to discuss any aspect of the project with you and provide you with additional information or clarification.

Thank you again for considering {{ config('app.name') }} for your {{ $estimate->title }} project. We look forward to the opportunity to work with you.

Best regards,

{{ $estimate->createdBy->name }}
{{ config('app.name') }}


</x-mail::message>
