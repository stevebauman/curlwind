@props([
    'title',
    'number',
    'example',
    'language',
    'description',
    'end' => false,
])

<div {{ $attributes->merge(['class' => 'relative mx-auto w-full max-w-3xl px-5']) }}>
    <div>
        <div class="flex items-center gap-5 font-semibold">
            <div class="grid h-10 w-10 place-items-center rounded-full bg-slate-600 text-white text-lg shadow border-t border-slate-500">
                {{ $number }}
            </div>

            <div class="text-2xl text-white">{{ $title }}</div>
        </div>

        <div class="flex items-stretch gap-5">
            <div @class([
                'shrink-0 relative left-5 top-1 mt-3 w-10',
                'border-l-2 border-dashed border-slate-600' => !$end ?? true
            ])></div>

            <div class="w-full overflow-hidden">
                <div class="text-lg font-medium text-slate-400">
                    {{ $description }}
                </div>

                <pre class="bg-slate-800 border border-slate-600 rounded-xl my-8 p-4 overflow-auto"><x-torchlight-code :language="$language" :contents="$example" /></pre>
            </div>
        </div>
    </div>
</div>
