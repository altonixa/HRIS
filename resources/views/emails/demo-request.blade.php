<x-mail::message>
# New Demo Request Received

A potential client has requested a demo of the Altonixa HRIS.

**Details:**
- **Name:** {{ $lead->name }}
- **Email:** {{ $lead->email }}
- **Organization:** {{ $lead->organization ?? 'N/A' }}
- **WhatsApp Number:** {{ $lead->whatsapp_number }}

**Message:**
{{ $lead->message ?? 'No message provided.' }}

<x-mail::button :url="'https://wa.me/' . preg_replace('/[^0-9]/', '', $lead->whatsapp_number)">
Contact on WhatsApp
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
