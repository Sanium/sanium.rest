@component('mail::message')
# The user has canceled his application for this position:

[{{ $offer_name }}]({{ route('welcome', "#/details/$offer_id") }})

You can contact this applicant via email: [{{ $email }}](mailto:{{ $email }})

Thanks,<br>
{{ config('app.name') }}
@endcomponent
