@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="https://laravel.com/img/notification-logo.png" class="logo" alt="Laravel Logo">
@else
{{-- {{ $slot }} --}}
<img src="https://pbs.twimg.com/profile_images/1598950341881610240/ZrMwOhPC.jpg" class="logo" alt="Ahqaff Logo">
{{-- <img src="/storage/imagePublic/ahqaff.jpg" class="logo" alt="Ahqaff Logo" width="200" height="200"> --}}

@endif
</a>
</td>
</tr>
