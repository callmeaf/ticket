<x-mail::message>
    # {{ __('callmeaf-ticket::admin_v1.mail.status_changed.title', ['ref_code' => $ref_code]) }}

    {{ __('callmeaf-ticket::admin_v1.mail.status_changed.body', ['title' => $title,'status_text' => $status_text]) }}

    @component('mail::button', ['url' => $url])
        {{ __('callmeaf-ticket::admin_v1.mail.status_changed.button') }}
    @endcomponent

    {{__('callmeaf-ticket::admin_v1.mail.status_changed.footer')}}

    {{ config('app.name') }}
</x-mail::message>
