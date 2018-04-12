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

    /**
     * Retrieves the title of the embed url
     * @param - $url: the url of the "player"
     * @return - string
     * @todo - do some real world testing. 
     * 
    **/
    public function getTitle($url) {
        return Template::raw(VideoEmbedder::$plugin->service->getInfo($url)->title);
    }

    /**
     * Retrieves the description of the embed from url
     * @param - $url: the url of the "player"
     * @return - string
     * @todo - do some real world testing. 
     * 
    **/
    public function getDescription($url) {
        return Template::raw(VideoEmbedder::$plugin->service->getInfo($url)->description);
    }

    /**
     * Retrieves the type of embed from url
     * @param - $url: the url of the "player"
     * @return - string
     * @todo - do some real world testing. 
     * 
    **/
    public function getType($url) {
        return Template::raw(VideoEmbedder::$plugin->service->getInfo($url)->type);
    }

    /**
     * Retrieves the aspect ratio of embed url
     * @param - $url: the url of the "player"
     * @return - string
     * @todo - do some real world testing. 
     * 
    **/
    public function getAspectRatio($url) {
        return Template::raw(VideoEmbedder::$plugin->service->getInfo($url)->aspectRatio);
    }

    /**
     * Retrieves the provider of the embed url
     * @param - $url: the url of the "player"
     * @return - string
     * @todo - do some real world testing. 
     * 
    **/
    public function getProviderName($url) {
        return Template::raw(VideoEmbedder::$plugin->service->getInfo($url)->providerName);
    }

    /**
     * Retrieves video ID
     * @param - $url: the url of the "player"
     * @return - string
     * @todo - do some real world testing. 
     * 
    **/
    public function getVideoId($url) {
        return Template::raw(VideoEmbedder::$plugin->service->getVideoId($url));
    }

}
