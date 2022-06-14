# 🎨 tailwind-integration

This package allows you to easily integrate TailwindCSS in your Laravel package. It allows you to have Tailwind styled views
and components without the need to publish them to the main Laravel project. The only published files are the CSS and JS assets.

## 🛠️ Installation

Tailwind integration can be installed through Composer.

```
$ composer require drenth1/tailwind-integration
```

## ✋ Usage

Create an artisan command in your package that extends the `IntegrateCommand` of Tailwind integration. Set the vendor and name of your package.

```php
<?php

namespace Vendor\Package\Console;

use Drenth1\TailwindIntegration\Console\IntegrateCommand;

class MyCommand extends IntegrateCommand
{
    /**
     * The package to integrate with.
     * 
     * @var string
     */
    protected static string $parent_package = 'vendor/package';
}
```

By default, Tailwind integration moves the following folders and files (if they exist) to the main project resources folder.

```
vendor/yourpackage/resources/fonts => resources/fonts
vendor/yourpackage/resources/css => resources/css
vendor/yourpackage/resources/js => resources/js

vendor/yourpackage/resources/tailwind.config.js => tailwind.config.js
vendor/yourpackage/resources/webpack.config.js => webpack.config.js
```

If you require specific behaviour, you may overwrite the `handle()` function and make use of the `AssetMover` utility class.

```php
// Gets the path to your package in the vendor folder.
$dir = self::packageDir();

AssetMover::moveAsset($dir . '/resources/css/app.css', $destination);
AssetMover::moveAssetDirectory($dir . '/resources/js', $destination);
```

You can run the command by using artisan.

```
php artisan tailwind:integrate
```