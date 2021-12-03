@component('mail::message')
    # Introduction

    The body of your message.
    {{ json_encode($reset) }}

    @component('mail::button', ['url' => env('FRONT_URL').'/auth/reset?hash='.$reset->token])
        Button Text
    @endcomponent

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
