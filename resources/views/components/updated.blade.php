<p class="text-muted">
    {{ empty(trim($slot)) ? __("Added")  : $slot }} {{ Carbon\Carbon::parse($date)->diffForHumans() }}
    @if(isset($name))
        {{__("by")}} {{ $name }}
    @endif
</p>