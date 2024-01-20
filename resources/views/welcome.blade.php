<x-layout>
    <div class="pt-32 w-full max-w-7xl mx-auto">
        <div class="flex justify-center">
            <a href="https://github.com/stevebauman/curlwind" target="_blank">
                <img src="logo.svg" class="w-52 mr-4" alt="Curlwind Logo" />
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
                description="Generate Stylesheets without Tailwind's Preflight CSS."
                example="examples/exclude-preflight.html"
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
