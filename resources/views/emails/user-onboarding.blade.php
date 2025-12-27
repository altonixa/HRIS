@component('mail::message')
# Welcome to Altonixa HRIS

Dear {{ $user->name }},

You have been granted access to the **Altonixa Human Resource Information System**.

Here are your login details:

- **Portal URL**: [{{ config('app.url') }}/login]({{ config('app.url') }}/login)
- **Username**: {{ $user->email }}
@if($tempPassword)
- **Temporary Password**: `{{ $tempPassword }}`
@endif

@component('mail::button', ['url' => config('app.url').'/login'])
Access Your Portal
@endcomponent

**Important:**
@if($tempPassword)
For security reasons, you will be required to change your password immediately upon your first login.
@endif
Please do not share these credentials with anyone.

If you have any issues accessing the system, please contact your System Administrator.

Best regards,<br>
{{ config('app.name') }} Security Team
@endcomponent
