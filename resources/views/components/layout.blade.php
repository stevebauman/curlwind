<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Curlwind | Tailwind Utility Generator</title>

    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <!-- General Meta Tags -->
    <meta name="description" content="A no-build Tailwind utility class generator.">

    <!-- Facebook OG Tags -->
    <meta property="og:title" content="Curlwind" />
    <meta property="og:description" content="A no-build Tailwind utility class generator." />
    <meta property="og:image" content="{{ asset('og_facebook.png') }}" />
    <meta property="og:url" content="https://curlwind.com" />
    <meta property="og:type" content="website" />

    <!-- Twitter Card Tags -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="Curlwind" />
    <meta name="twitter:description" content="A no-build Tailwind utility class generator." />
    <meta name="twitter:image" content="{{ asset('og_twitter.png') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <link rel="stylesheet" href="{{
            route('cdn', [
                'classes' => implode(',', [
                    'p-*:md',
                    'py-*',
                    'pt-*',
                    'm-*',
                    'px-5',
                    'my-8',
                    'mt-*',
                    'w-*',
                    'h-*',
                    'w-fit',
                    'top-*',
                    'grid',
                    'flex',
                    'gap-*',
                    'left-*',
                    'shrink-0',
                    'font-*',
                    'text-*:md',
                    'mx-auto',
                    'max-w-*',
                    'relative',
                    'border',
                    'items-*',
                    'border-*',
                    'border-l-2',
                    'overflow-*',
                    'bg-slate-*',
                    'tracking-*',
                    'rounded-xl',
                    'rounded-full',
                    'text-slate-*',
                    'min-h-screen',
                    'antialiased',
                    'place-items-*',
                    'justify-center',
                    'underline:hover',
                    'border-slate-*',
                ]),
            ])
        }}" />

    <style>
        .torchlight.has-focus-lines .line:not(.line-focus) {
            transition: filter 0.35s, opacity 0.35s;
            filter: blur(.095rem);
            opacity: .65;
        }

        .torchlight.has-focus-lines:hover .line:not(.line-focus) {
            filter: blur(0px);
            opacity: 1;
        }
    </style>
</head>

<body class="antialiased bg-slate-900 min-h-screen">
{{ $slot }}
</body>
