<div class="rounded-lg border bg-card text-card-foreground shadow-sm">
    @if (isset($title))
        <div class="flex flex-col space-y-1.5 p-6">
            <h3 class="text-2xl font-semibold whitespace-nowrap leading-none tracking-tight">{{ $title }}</h3>
        </div>
    @endif
    <div class="p-6">
        {{ $slot }}
    </div>
</div>
