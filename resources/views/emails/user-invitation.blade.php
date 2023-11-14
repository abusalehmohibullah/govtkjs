@component('mail::message')

{{ __('You have been invited to join') . config(' app.name'). ($invitation->designation ? __(' as :designation!', ['designation' => $invitation->designation]) : '') }}


{{ __('You may accept this invitation by clicking the button below:') }}

@component('mail::button', ['url' => $acceptUrl])
{{ __('Accept Invitation') }}
@endcomponent

{{ __('If you did not expect to receive this invitation, you may discard this email.') }}

{{-- Subcopy --}}
@isset($acceptUrl)
@slot('subcopy')
@lang(
    "If you're having trouble clicking the \":actionText\" button, copy and paste the URL below into your web browser:",
    [
        'actionText' => __('Accept Invitation'),
    ]
) [{{ $acceptUrl }}]({{ $acceptUrl }})
@endslot
@endisset

@endcomponent
