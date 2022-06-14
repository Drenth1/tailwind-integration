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
     * Execute the console command.
     * 
     * @return void
     */
    public function handle()
    {
        $this->info('Running Tailwind integration.');

        NodePackageManager::add();

        AssetMover::moveAsset(__DIR__.'/../../resources/tailwind.config.js', base_path('tailwind.config.js'));
        AssetMover::moveAsset(__DIR__.'/../../resources/webpack.config.js', base_path('webpack.config.js'));

        AssetMover::moveAssetDirectory(__DIR__.'/../../resources/css', resource_path('css'));
        AssetMover::moveAssetDirectory(__DIR__.'/../../resources/js', resource_path('js'));
        AssetMover::moveAssetDirectory(__DIR__.'/../../resources/fonts', resource_path('fonts'));

        $this->info('Tailwind integration complete, please run "npm install && npm run dev"');
    }
}