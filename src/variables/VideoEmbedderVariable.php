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

/**
 * Video Embedder Variable
 *
 * Craft allows plugins to provide their own template variables, accessible from
 * the {{ craft }} global variable (e.g. {{ craft.videoEmbedder }}).
 *
 * https://craftcms.com/docs/plugins/variables
 *
 * @author    Mike Stecker
 * @package   VideoEmbedder
 * @since     1.0.0
 */
class VideoEmbedderVariable
{
    // Public Methods
    // =========================================================================

    /**
     * Take a youtube or vimeo url and return the embed url
     *
     * @param string $url
     * @return string
     */
    public function getEmbedUrl($url)
    {
        if ($this->_isYoutube($url)) {
            $url_parts = parse_url($url);
            parse_str($url_parts['query'], $segments);

            return '//www.youtube.com/embed/' . $segments['v'];
        } else if ($this->_isShortYoutube($url)) {
            $url_parts = parse_url($url);

            return '//www.youtube.com/embed' . $url_parts['path'];
        } else if ($this->_isVimeo($url)) {
            $url_parts = parse_url($url);
            $segments = explode('/', $url_parts['path']);

            return '//player.vimeo.com/video/' . $segments[1] . '?player_id=video&api=1';
        }
    }

    /**
     * Retrieves the thumbnail from a youtube or vimeo video
     * @param - $src: the url of the "player"
     * @return - string
     * @todo - do some real world testing. 
     * 
    **/
    public function getVideoThumbnail($url) {
        if ($this->_isYoutube($url)) {
            $url_parts = parse_url($url);
            parse_str($url_parts['query'], $segments);

            return '//img.youtube.com/vi/' . $segments['v'] . '/0.jpg';
        } else if ($this->_isShortYoutube($url)) {
            $url_parts = parse_url($url);

            return '//img.youtube.com/vi/' . $url_parts['path'] . '/0.jpg';
        } else if ($this->_isVimeo($url)) {
            $url_parts = parse_url($url);
            $segments = explode('/', $url_parts['path']);

            $ch = curl_init('http://vimeo.com/api/v2/video/'.$segments[1].'.php');
            curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 1);
            $a = curl_exec($ch);
            $hash = unserialize($a);
            return $hash[0]["thumbnail_large"];
            // http://vimeo.com/api/v2/video/9696328.xml
        }
    }


    /**
     * Determine whether the url is a youtube or vimeo url
     * @param string $url
     * @return boolean
     */
    public function isVideoUrl($url)
    {
        return ($this->_isYoutube($url) || $this->_isVimeo($url));
    }


    /**
     * Is the url a youtube url
     * @param string $url
     * @return boolean
     */
    private function _isYoutube($url)
    {
        return strripos($url, 'youtube.com') !== FALSE;
    }

    /**
     * Is the url a youtube short url
     * @param string $url
     * @return boolean
     */
    private function _isShortYoutube($url)
    {
        return strripos($url, 'youtu.be') !== FALSE;
    }


    /**
     * Is the url a vimeo url
     * @param string $url
     * @return boolean
     */
    private function _isVimeo($url)
    {
        return strripos($url, 'vimeo.com') !== FALSE;
    }
}
