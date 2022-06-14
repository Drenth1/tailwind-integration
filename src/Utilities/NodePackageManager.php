<?php

namespace Drenth1\TailwindIntegration\Utilities;

class NodePackageManager
{
    /**
     * Add new node dependencies.
     * 
     * @return void
     */
    public static function add()
    {
        self::updateNodeDependencies(function ($packages) {
            return [
                '@tailwindcss/forms' => '^0.4.0',
                'autoprefixer' => '^10.4.2',
                'postcss' => '^8.4.6',
                'tailwindcss' => '^3.1.0',
            ] + $packages;
        });
    }

    /**
     * Update the node packages file.
     *
     * @param callable $callback
     * @param bool $dev
     * @return void
     */
    private static function updateNodeDependencies(callable $callback, $dev = true)
    {
        if (!file_exists(base_path('package.json'))) {
            return;
        }

        $configurationKey = $dev ? 'devDependencies' : 'dependencies';

        $packages = json_decode(file_get_contents(base_path('package.json')), true);

        $packages[$configurationKey] = $callback(
            array_key_exists($configurationKey, $packages) ? $packages[$configurationKey] : [],
            $configurationKey
        );

        ksort($packages[$configurationKey]);

        file_put_contents(
            base_path('package.json'),
            json_encode($packages, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT).PHP_EOL
        );
    }
}