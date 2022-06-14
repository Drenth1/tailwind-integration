<?php

namespace Drenth1\TailwindIntegration\Utilities;

use Illuminate\Filesystem\Filesystem;

class AssetMover
{
    /**
     * Copy an asset file.
     * 
     * @param string $source
     * @param string $destination
     * @return void
     */
    public static function moveAsset(string $source, string $destination) : void
    {
        if((new Filesystem)->isFile($source)) 
        {
            copy($source, $destination);
        }
    }

    /**
     * Copy an asset directory.
     * 
     * @param string $source
     * @param string $destination
     * @return void
     */
    public static function moveAssetDirectory(string $source, string $destination) : void
    {
        if((new Filesystem)->isDirectory($source)) 
        {
            (new Filesystem)->copyDirectory($source, $destination);
        }
    }
}