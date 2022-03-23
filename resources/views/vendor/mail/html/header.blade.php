<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="{{ asset('images/earners-logo.png') }}" class="logo" alt="Earner view Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
