@component('mail::message')
# You have new application from: {{ $name }}

{{ $text }}

You cant contact this applicant via email: [{{ $email }}](mailto:{{ $email }})

@component('mail::button', ['url' => $pathToCV])
Download resume
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
