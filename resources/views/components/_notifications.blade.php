<!-- Notifications -->
<x-alert-container>
    @if (session('info'))
        <x-alert type="info" title="{{ session('info') }}" message=""></x-alert>
    @endif
    @if (session('warning'))
        <x-alert type="warning" title="{{ session('warning') }}" message=""></x-alert>
    @endif
    @if (session('error'))
        <x-alert type="error" title="{{ session('error') }}" message=""></x-alert>
    @endif
    @if (session('success'))
        <x-alert type="success" title="{{ session('success') }}" message=""></x-alert>
    @endif
</x-alert-container>
<!-- Notifications -->
