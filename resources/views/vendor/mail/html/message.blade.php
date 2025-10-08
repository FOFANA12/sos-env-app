<x-mail::layout>
    {{-- Header --}}
    <x-slot:header>
        <x-mail::header :url="config('app.url')">
            {{ config('app.name') }}
        </x-mail::header>
    </x-slot:header>

    {{-- Body --}}
    {!! $slot !!}

    {{-- Subcopy --}}
    <x-slot:subcopy>
        <x-mail::subcopy> </x-mail::subcopy>
    </x-slot:subcopy>

    {{-- Footer --}}
    <x-slot:footer>
        <x-mail::footer>
            © {{ date('Y') }} {{ config('app.name') }}. {{ __('app/mail.footer.rights_reserved') }}
        </x-mail::footer>
    </x-slot:footer>
</x-mail::layout>
