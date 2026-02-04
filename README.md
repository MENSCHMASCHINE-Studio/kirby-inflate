# Kirby Collection Inflate Plugin

This plugin provides the helper function `inflate()` on all Kirby Collections such as `$pages`, `$files`, `$blocks`, or `$users` to increase the collections size to a desired amount.

This is helpful  to give a better indication of your pages layout once more content will be  added or to work on things like pagination without having to manually create large amounts of dummy content. 

It works by adding a collections to itself until the desired amount is reached.

## Installation

Copy this repository into your pages plugin folder `site/plugins/inflate/`

## Usage

```php
// Inflates the children collection to 500 items
<?php foreach ($page->children()->inflate(500) as $article): ?>
    <a href="<?=$article->url()?>"><?=$article->title()?></a>
<?php endforeach;?>

// Shuffle to prevent repetitive layouts
<?php foreach ($page->children()->inflate(500, true) as $article): ?>
    <a href="<?=$article->url()?>"><?=$article->title()?></a>
<?php endforeach;?>

// With no arguments provided, inflate() will inflate to 50 items
<?php foreach ($page->children()->inflate() as $article): ?>
    <a href="<?=$article->url()?>"><?=$article->title()?></a>
<?php endforeach;?>

```

If the collection is as large or larger than the requested size, it will not be modified or shrunken down.



## Debug / Production
As this is intended for development use only it will only be active in environments where `debug => true` unless configured otherwise. To activate `inflate()` in environments where `debug = false` set:

```php 
// site/config.php

return [
    'debug' => false,

    // Will activate inflate() in non-debug environments
    'MMS.inflate' => [
        'inProduction' => true 
    ]
]

```



