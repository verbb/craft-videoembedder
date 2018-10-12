<?php
/**
 * Video Embedder plugin for Craft CMS 3.x
 *
 * Craft plugin to generate an embed URL from a YouTube or Vimeo URL.
 *
 * @link      http://github.com/mikestecker
 * @copyright Copyright (c) 2017 Mike Stecker
 */

namespace mikestecker\videoembedder\assetbundles\videofield;

use craft\web\AssetBundle;
use craft\web\assets\cp\CpAsset;

class VideoFieldAsset extends AssetBundle
{
    // Public Methods
    // =========================================================================

    /**
     * Initializes the bundle.
     */
    public function init()
    {
        // define the path that your publishable resources live
        $this->sourcePath = "@mikestecker/videoembedder/assetbundles/videofield/dist";

        // define the dependencies
        $this->depends = [
            CpAsset::class,
        ];

        // define the relative path to CSS/JS files that should be registered with the page
        // when this asset bundle is registered
        $this->js = [
            'js/Video.js',
        ];

        $this->css = [
            'css/Video.css',
        ];

        parent::init();
    }
}
