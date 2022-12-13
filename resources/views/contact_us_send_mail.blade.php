@component('mail::message')
    {{ $subject }}
    <br /><br />
    {{ $messages }}
@endcomponent
