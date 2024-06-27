<x-app-layout>
    <x-slot name='extra_head'>
        {{ $extra_head ?? '' }}
    </x-slot>
    
    <main class="Admin">
        @include('partials.aside')

        <div class="admin_content">
            @include('partials.messages')
        
            <section {{ $attributes->merge(['class' => '']) }}>
                {{ $slot }}
            </section>
        </div>
    </main>

    @isset($javascript)
        {{ $javascript }}
        <script src="{{ asset('assets/js/custom.js') }}"></script>
    @else
        <script src="{{ asset('assets/js/jquery.js') }}"></script>
        <script src="{{ asset('assets/js/custom.js') }}"></script>
    @endisset
</x-app-layout>