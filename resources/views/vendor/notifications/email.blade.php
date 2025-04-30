{{-- resources/views/vendor/notifications/email.blade.php --}}
<x-mail::message>

<!-- Logo Desa -->
<div style="text-align:center; margin-bottom:1rem;">
  <img src="{{ $message->embed(public_path('images/Logo_Kabupaten_kuningan.png')) }}"
       alt="Logo Desa Winduherang"
       width="72"
       style="display:inline-block; margin:auto;">
</div>

{{-- Greeting --}}
@if (! empty($greeting))
# {{ $greeting }}
@else
@if ($level === 'error')
# Whoops!
@else
# Hello from Winduherang!
@endif
@endif

{{-- Intro --}}
@foreach ($introLines as $line)
{{ $line }}

@endforeach

{{-- Action Button --}}
@isset($actionText)
@php
    // force green button for our village
    $color = 'success';
@endphp
<x-mail::button :url="$actionUrl" :color="$color">
{{ $actionText }}
</x-mail::button>
@endisset

{{-- Outro --}}
@foreach ($outroLines as $line)
{{ $line }}

@endforeach

{{-- Desa Footer Motto --}}
<div style="text-align:center; margin-top:2rem; font-style:italic; color:#047857;">
  Rapih • Winangun • Kerta Raharja
</div>

{{-- Salutation --}}
@if (! empty($salutation))
{{ $salutation }}
@else
Regards,<br>
Desa Winduherang
@endif

{{-- Subcopy --}}
@isset($actionText)
<x-slot name="subcopy">
If you’re having trouble clicking the "{{ $actionText }}" button, copy and paste the URL below into your web browser:

[{{ $displayableActionUrl }}]({{ $actionUrl }})
</x-slot>
@endisset

</x-mail::message>