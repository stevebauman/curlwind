<p align="center"><a href="https://curlwind.com" target="_blank"><img src="https://cd.curlwind.com/logo-dark.svg" width="400" alt="Curlwind Logo Logo"></a></p>

<p align="center">
Dynamically generate Tailwind CSS utility stylesheets. 
</p>

<hr/>

<p align="center">
    <a href="https://github.com/stevebauman/curlwind/actions"><img src="https://img.shields.io/github/actions/workflow/status/stevebauman/curlwind/run-tests.yml?branch=master&style=flat-square"></a>
</p>

## Usage

### Insert Tag

Add the stylesheet tag to your site's head tag:

```html
<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="https://cdn.curlwind.com">
    </head>

    <body>
        <!-- ... -->
    </body>
</html>
```

### Attach Classes

Attach the `classes` query parameter to URL receive a stylesheet with only the classes you need.

Use commas and wildcards to match multiple classes:

```html
<link rel="stylesheet" href="https://cdn.curlwind.com?classes=p-*,m-*">
```

### Receive Stylesheet

The generated stylesheet will contain only the classes you need:

```css
/* output.css */
 
.p-0 {
    padding: 0px;
}
 
.p-1 {
    padding: 0.25rem;
}
 
/* ... */
 
.m-0 {
    margin: 0px;
}
 
.m-1 {
    margin: 0.25rem;
}
 
/* ... */
```

### Options

### Generate Variants

Insert a colon (:) after the class name to generate variants:

```html
<link rel="stylesheet" href="https://cdn.curlwind.com?classes=p-*:sm|md,m-*:hover">
```

### Exclude Preflight

Generate stylesheets without Tailwind's Preflight CSS:

```html
<link rel="stylesheet" href="https://cdn.curlwind.com?preflight=0">
```

### Prefixed Utilities

Generate utility classes with a prefix:

```html
<link rel="stylesheet" href="https://cdn.curlwind.com?prefix=tw">
```

### Unminified CSS

Generate stylesheets unminified:

```html
<link rel="stylesheet" href="https://cdn.curlwind.com?minify=0">
```

### Enable Plugins

Generate stylesheets with built-in Tailwind plugins enabled.

```html
<link rel="stylesheet" href="https://cdn.curlwind.com?plugins=forms,typography,aspect-ratio,container-queries">
```
