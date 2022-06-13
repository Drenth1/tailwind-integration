<?php

namespace Drenth1\TailwindIntegration\Utilities;

class NodePackageManager
{
    /**
     * Add new node dependencies.
     * 
     * @param array $packages
     * @return void
     */
    public static function addNodePackages(array $addons)
    {
        $this->updateNodeDependencies(function ($packages) {
            return $addons + $packages;
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