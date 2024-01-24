<?php

namespace App\Http\Controllers;

use App\Http\Requests\GenerateRequest;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Process;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class GenerateController extends Controller
{
    /**
     * Generate a new Tailwind stylesheet.
     */
    public function __invoke(GenerateRequest $request): StreamedResponse
    {
        $prefix = $request->input('prefix') ?? null;

        $plugins = Arr::sort($request->input('plugins'));
        $classes = Arr::sort($request->input('classes'));

        $filename = md5(implode(array_merge($classes, $plugins, [
            $preflight = $request->boolean('preflight', true),
            $minify = $request->boolean('minify', true),
        ])));

        $js = storage_path("js/$filename.js");
        $css = storage_path("css/$filename.css");

        if (file_exists($css) && $request->boolean('cache', true)) {
            return $this->response($css);
        }

        Storage::disk('js')->put(
            "$filename.js",
            $this->generateTailwindConfig($prefix, $classes, $plugins, $preflight)
        );

        $binary = match (PHP_OS_FAMILY) {
            'Darwin' => './tailwindcss-macos-x64',
            'Linux' => './tailwindcss-linux-x64',
            default => throw new Exception('Unsupported OS'),
        };

        // Generate the CSS file
        Process::timeout(30)
            ->path(base_path('bin'))
            ->run(array_filter([
                $binary,
                '-i',
                resource_path('css/app.css'),
                '-c',
                $js,
                '-o',
                $css,
                $minify ? '--minify' : null,
            ]))->throw();

        return $this->response($css);
    }

    /**
     * Return a streamed response.
     */
    protected function response(string $css): StreamedResponse
    {
        return response()->stream(fn () => readfile($css), 200, [
            'Content-Type' => 'text/css',
        ]);
    }

    /**
     * Generate a new Tailwind config file.
     */
    protected function generateTailwindConfig(?string $prefix, array $classes, array $plugins = [], bool $preflight = true): string
    {
        $patterns = array_map(function (string $pattern) {
            [$matcher, $variants] = array_pad(explode(':', $pattern), 2, null);

            $regex = str($matcher)
                ->replace('*', '[a-z0-9]+')
                ->replace('-', '\\-')
                ->replace('/', '\\/')
                ->tap(fn ($regex) => json_encode($regex))
                ->replaceFirst('"', '')
                ->replaceLast('"', '');

            $variants = json_encode($variants ? explode('|', $variants) : []);

            return <<<JAVASCRIPT
            { "pattern": new RegExp("^$regex$"), "variants": $variants }
            JAVASCRIPT;
        }, $classes);

        $safelist = implode(",\n", $patterns);

        $plugins = implode(",\n", array_map(fn (string $plugin) => (
            "require('@tailwindcss/$plugin')"
        ), $plugins));

        $preflight = $preflight ? 'true' : 'false';

        return <<<JAVASCRIPT
        module.exports = {
            prefix: "$prefix",
            plugins: [$plugins],
            safelist: [$safelist],
            corePlugins: {
                preflight: $preflight,
            }
        };
        JAVASCRIPT;
    }
}
