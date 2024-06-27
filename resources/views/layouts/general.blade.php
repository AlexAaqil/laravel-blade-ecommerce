<x-app-layout>
    @include('partials.navbar')

    
    <main {{ $attributes->merge(['class' => '']) }}>
        @include('partials.messages')
        
        {{ $slot }}
    </main>

    @include('partials.footer')

    @isset($javascript)
        {{ $javascript }}
        <script src="{{ asset('assets/js/custom.js') }}"></script>
    @else
        <script src="{{ asset('assets/js/jquery.js') }}"></script>
        <script src="{{ asset('assets/js/custom.js') }}"></script>
    @endisset
</x-app-layout>