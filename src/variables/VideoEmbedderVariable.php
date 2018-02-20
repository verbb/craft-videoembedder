<?php
/**
 * Video Embedder plugin for Craft CMS 3.x
 *
 * Craft plugin to generate an embed URL from a YouTube or Vimeo URL.
 *
 * @link      http://github.com/mikestecker
 * @copyright Copyright (c) 2017 Mike Stecker
 */

namespace mikestecker\videoembedder\variables;

use mikestecker\videoembedder\VideoEmbedder;

use Craft;
use craft\helpers\Template;

/**
 * @author    Mike Stecker
 * @package   VideoEmbedder
 * @since     1.0.0
 */
class VideoEmbedderVariable
{
    // Public Methods
    // =========================================================================

    /**
     * Take a url and return the embed code
     *
     * @param string $url
     * @return string
     */
    public function embed($url, $params = [])
    {
        return Template::raw(VideoEmbedder::$plugin->service->embed($url, $params));
    }

    /**
     * Take a url and return the embed url
     *
     * @param string $url
     * @return string
     */
    public function getEmbedUrl($url, $params = [])
    {
        return Template::raw(VideoEmbedder::$plugin->service->getEmbedUrl($url, $params));
    }

    /**
     * Retrieves the thumbnail from a youtube or vimeo video
     * @param - $url: the url of the "player"
     * @return - string
     * @todo - do some real world testing. 
     * 
    **/
    public function getVideoThumbnail($url) {
        return Template::raw(VideoEmbedder::$plugin->service->getVideoThumbnail($url));
    }

}
