<x-dashboard>
    <!-- Layout container -->
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <livewire:receipt-account />

        <!-- / Content -->

    </div>
    <!-- Content wrapper -->

    @push('css')
    @livewireStyles
    @endpush

    @push('js')
    @livewireScripts
    @endpush
</x-dashboard>

