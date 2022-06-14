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
    protected string $parent_package;

    /**
     * Execute the console command.
     * 
     * @return void
     */
    public function handle()
    {
        $this->info('Running Tailwind integration.');
        
        $dir = $this->packageDir();

        NodePackageManager::add();

        AssetMover::moveAsset($dir . '/resources/tailwind.config.js', base_path('tailwind.config.js'));
        AssetMover::moveAsset($dir . '/resources/webpack.mix.js', base_path('webpack.mix.js'));

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
    protected function packageDir()
    {
        return base_path('vendor/') . $this->parent_package;
    }
}