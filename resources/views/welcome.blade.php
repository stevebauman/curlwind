<x-layout>
    <div class="pt-32 w-full max-w-7xl mx-auto">
        <div class="flex justify-center">
            <a href="https://github.com/stevebauman/curlwind" target="_blank">
                <img src="{{ asset('logo.svg') }}" class="w-52 mr-4" alt="Curlwind Logo" />
            </a>
        </div>

        <div class="p-2 pt-8 md:p-16">
            <h1 class="font-extrabold text-4xl md:text-5xl text-center text-white">
                No-build Tailwind.
            </h1>

            <h2 class="pt-2 font-extrabold text-3xl text-balance md:text-4xl text-center text-white">
                Get the CSS utilities you want. Nothing you don't.
            </h2>

            <h3 class="text-center text-slate-400 font-medium text-xl pt-8 text-balance">
                Curlwind allows you to generate Tailwind stylesheets on demand to get only the CSS utilities you need. Generated stylesheets are cached indefinitely so your site stays <i>fast</i>.
            </h3>

            <div class="flex justify-center pt-10">
                <a
                    target="_blank"
                    href="https://github.com/stevebauman/curlwind"
                    class="flex items-center p-2 bg-slate-800 text-white font-semibold rounded-xl shadow-sm hover:bg-slate-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-600">
                    <svg viewBox="0 0 16 16" fill="currentColor" class="w-5 h-5 mr-2" aria-hidden="true">
                        <path d="M8 0C3.58 0 0 3.58 0 8c0 3.54
                        2.29 6.53 5.47 7.59.4.07.55-.17.55-.38
                        0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01
                        1.08.58 1.23.82.72 1.21 1.87.87
                        2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95
                        0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.13
                        0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68
                        0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82
                        .44 1.11.16 1.93.08 2.13.51.56.82
                        1.28.82 2.15 0 3.07-1.87
                        3.75-3.65 3.95.29.25.54.73.54 1.47 0 1.06-.01
                        1.92-.01 2.18 0 .21.15.46.55.38A8.013
                        8.013 0 0 0 16 8c0-4.42-3.58-8-8-8z"></path>
                    </svg>

                    <span class="pl-2">View on GitHub</span>
                </a>
            </div>

            <x-step
                number="1"
                class="pt-16"
                language="html"
                title="Insert Link"
                description="Add the stylesheet tag to your site's head tag."
                example="examples/insert-tag.html"
            />

            <x-step
                number="2"
                class="pt-6"
                language="html"
                title="Attach Classes"
                description="Attach the 'classes' query parameter to URL receive a stylesheet with only the classes you need. Use wildcards to match multiple classes."
                example="examples/attach-parameters.html"
            />

            <x-step
                end
                number="3"
                class="pt-6"
                language="css"
                title="Receive Stylesheet"
                description="The generated stylesheet will contain only the classes you need."
                example="examples/receive-stylesheet.css"
            />

            <x-step
                end
                number="+"
                class="pt-6"
                language="html"
                title="Generate Variants"
                description="Insert a colon (:) after the class name to generate variants."
                example="examples/additional-parameters.html"
            />

            <x-step
                end
                number="+"
                class="pt-6"
                language="html"
                title="Exclude Preflight"
                description="Generate stylesheets without Tailwind's Preflight CSS."
                example="examples/exclude-preflight.html"
            />

            <x-step
                end
                number="+"
                class="pt-6"
                language="html"
                title="Prefixed Utilities"
                description="Generate utility classes with a prefix."
                example="examples/prefixed-utilities.html"
            />

            <x-step
                end
                number="+"
                class="pt-6"
                language="html"
                title="Unminified CSS"
                description="Generate stylesheets unminified."
                example="examples/unminified-css.html"
            />

            <x-step
                end
                number="+"
                class="pt-6"
                language="html"
                title="Enable Plugins"
                description="Generate stylesheets with built-in Tailwind plugins enabled."
                example="examples/enable-plugins.html"
            />
        </div>
    </div>

    <div class="py-12">
        <div class="text-center text-white">
            Made with ❤️ by <a href="https://twitter.com/ste_bau" target="_blank" class="text-slate-200 hover:underline">Steve Bauman</a>
        </div>

        <div class="pt-6 text-center text-white">
            Code styled beautifully using <a href="https://torchlight.dev" target="_blank" class="text-slate-200 hover:underline">Torchlight</a> by <a href="https://twitter.com/aarondfrancis" target="_blank" class="text-slate-200 hover:underline">Aaron Francis</a>
        </div>
    </div>
</x-layout>
