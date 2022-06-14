<?php

namespace Drenth1\TailwindIntegration\Console;

use Illuminate\Console\Command;
use Drenth1\TailwindIntegration\Utilities\AssetMover;
use Drenth1\TailwindIntegration\Utilities\NodePackageManager;

class IntegrateCommand extends Command
{
    /**
     * The name and signature of the console command.
     * 
     * @var string
     */
    protected $signature = 'tailwind:integrate';

    /**
     * The console command description.
     * 
     * @var string
     */
    protected $description = 'Set up the Tailwind resources';

    /**
     * The package to integrate with.
     * 
     * @var string
     */
    protected static string $parent_package = 'drenth1/tailwind-integration';

    /**
     * Execute the console command.
     * 
     * @return void
     */
    public function handle()
    {
        $this->info('Running Tailwind integration.');
        
        $dir = self::packageDir();

        NodePackageManager::add();

        AssetMover::moveAsset($dir . '/resources/tailwind.config.js', base_path('tailwind.config.js'));
        AssetMover::moveAsset($dir . '/resources/webpack.config.js', base_path('webpack.config.js'));

        AssetMover::moveAssetDirectory($dir . '/resources/css', resource_path('css'));
        AssetMover::moveAssetDirectory($dir . '/resources/js', resource_path('js'));
        AssetMover::moveAssetDirectory($dir . '/resources/fonts', resource_path('fonts'));

        $this->info('Tailwind integration complete, please run "npm install && npm run dev"');
    }

    /**
     * Get the directory to the package to integrate with.
     * 
     * @return string
     */
    protected static function packageDir()
    {
        return base_path('vendor/') . self::$parent_package;
    }
}