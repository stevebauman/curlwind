<?php

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use function Pest\Laravel\artisan;

test('it returns valid CSS content type', function () {
    $this->get(route('cdn'))->assertHeader('Content-Type', 'text/css; charset=UTF-8');
});

test('it returns error when given invalid characters', function (string $classes) {
    $this->get(route('cdn', ['classes' => $classes]))->assertUnprocessable();
})->with([
    '&',
    '$',
    '%',
    '^',
    '@',
    '(',
    ')',
    '_',
    '#',
    '"',
    "'",
    '!',
    '[',
    ']',
    '{',
    '}',
    '\\',
    '=',
]);

test('it only allows specific characters', function (string $classes) {
    $this->get(route('cdn', ['classes' => $classes]))->assertSuccessful();
})->with([
    '-',
    'a',
    '/',
    '-*-',
]);

test('it generates preflight by default', function () {
    $response = $this->get(route('cdn'))
        ->assertSuccessful()
        ->streamedContent();

    expect(Str::is('* tailwindcss v*.*.*', $response))->toBeTrue();
});


test('it omits preflight when disabled', function () {
    $response = $this->get(route('cdn', ['preflight' => false]))
        ->assertSuccessful()
        ->streamedContent();

    expect(Str::is('* tailwindcss v*.*.*', $response))->toBeFalse();
});

test('it caches js and css', function () {
    artisan('cache:wipe');

    expect(Storage::disk('js')->allFiles())->toHaveCount(1);
    expect(Storage::disk('css')->allFiles())->toHaveCount(1);

    $this->get(route('cdn'))->assertSuccessful();

    expect(Storage::disk('js')->allFiles())->toHaveCount(2);
    expect(Storage::disk('css')->allFiles())->toHaveCount(2);
});

test('it can generate tailwind utilities unminified', function () {
    $content = $this->get(route('cdn', ['minify' => false, 'classes' => 'p-0']))
        ->assertSuccessful()
        ->streamedContent();

    expect($content)->toContain(<<<CSS
    .p-0 {
      padding: 0px;
    }
    CSS);
});

test('it can generate multiple tailwind utilities', function () {
    $content = $this->get(route('cdn', ['classes' => 'p-0,m-0']))
        ->assertSuccessful()
        ->streamedContent();

    expect($content)->toContain('.p-0{padding:0}');
    expect($content)->toContain('.m-0{margin:0}');
});

test('it can generate tailwind utilities with forward slashes', function () {
    $content = $this->get(route('cdn', ['classes' => 'w-1/3']))
        ->assertSuccessful()
        ->streamedContent();

    expect($content)->toContain('.w-1\\/3{width:33.333333%}');
});

test('it can generate tailwind utilities with an asterisk to match multiple', function () {
    $content = $this->get(route('cdn', ['classes' => 'w-*/*']))
        ->assertSuccessful()
        ->streamedContent();

    $classes = [
        'w-1\/2',
        'w-1\/3',
        'w-2\/3',
        'w-1\/4',
        'w-2\/4',
        'w-3\/4',
        'w-1\/5',
        'w-2\/5',
        'w-3\/5',
        'w-4\/5',
        'w-1\/6',
        'w-2\/6',
        'w-3\/6',
        'w-4\/6',
        'w-5\/6',
        'w-1\/12',
        'w-2\/12',
        'w-3\/12',
        'w-4\/12',
        'w-5\/12',
        'w-6\/12',
        'w-7\/12',
        'w-8\/12',
        'w-9\/12',
        'w-10\/12',
        'w-11\/12',
    ];

    foreach ($classes as $class) {
        expect($content)->toContain(".$class");
    }
});

test('it can generate tailwind utilities with an asterisk to match multiple with variants', function () {
    $content = $this->get(route('cdn', ['classes' => 'w-0:sm|md|hover']))
        ->assertSuccessful()
        ->streamedContent();

    expect($content)->toContain("w-0:hover");
    expect($content)->toContain("sm\:w-0");
    expect($content)->toContain("md\:w-0");
});


test('it can generate tailwind utility with variant having hyphen', function () {
    $content = $this->get(route('cdn', ['classes' => 'p-0:group-hover']))
        ->assertSuccessful()
        ->streamedContent();

    expect($content)->toContain("group-hover\:p-0");
});

test('it can generate with built-in plugins', function (string $plugin, string $classes, string $expected) {
    $content = $this->get(route('cdn', ['classes' => $classes, 'plugins' => $plugin]))
        ->assertSuccessful()
        ->streamedContent();

    expect($content)->toContain($expected);
})->with([
    ['forms', '', 'select'],
    ['typography', 'prose', '.prose'],
    ['aspect-ratio', 'aspect-w-16', '.aspect-w-16'],
    ['container-queries', 'container', '.container'],
]);
