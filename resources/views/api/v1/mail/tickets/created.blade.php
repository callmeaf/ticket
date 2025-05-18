<x-mail::message>
# {{ __('callmeaf-ticket::api_v1.mail.created.title', ['ref_code' => $ref_code]) }}

{{ __('callmeaf-ticket::api_v1.mail.created.body', ['title' => $title]) }}

@component('mail::button', ['url' => $url])
{{ __('callmeaf-ticket::api_v1.mail.created.button') }}
@endcomponent

{{__('callmeaf-ticket::api_v1.mail.created.footer')}}

{{ config('app.name') }}
</x-mail::message>
