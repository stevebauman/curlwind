@props(['title', 'code', 'exception'])

<x-layout>
    <div class="text-white flex items-center justify-center min-h-screen">
        <div class="text-center">
            <div class="flex justify-center">
                <img src="logo.svg" class="w-52 mr-4" alt="Curlwind Logo" />
            </div>

            <div class="pt-16">
                <h1 class="text-white text-4xl font-semibold">{{ $code }} - {{ $title  }}</h1>
            </div>

            @if($exception)
            <div class="pt-8 font-semibold text-slate-300">
                {{ $exception->getMessage() }}
            </div>
            @endif
        </div>
    </div>
</x-layout>
