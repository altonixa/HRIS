<x-mail::message>
# Hello {{ $name }},

Thank you for your interest in Altonixa HRIS. You can now access the live demo environment.

<x-mail::panel>
### Access Credentials

**Admin Portal:**
- **URL:** {{ url('/login') }}
- **Email:** admin@altonixa.com
- **Password:** demo1234

**HR Manager Portal:**
- **Email:** hr@altonixa.com
- **Password:** hrdemo1234
</x-mail::panel>

<x-mail::button :url="url('/login')">
Login to HRIS Demo
</x-mail::button>

Please note that this is a shared public demo environment. Data is reset every 24 hours.

Thanks,<br>
The Altonixa Team
</x-mail::message>
