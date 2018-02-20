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

use DOMDocument;
use Embed\Embed;

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
     * Take a youtube or vimeo url and return the embed code
     *
     * @param string $url
     * @return string
     */
    public function embed( $url, array $options = array() )
    {
        $code = $this->getInfo($url)->code;
        $url_parts = parse_url($url);

        // check if theree are any options passed along
        if (!empty($options)) {
            
            // looks like there are, now let's only do this for YouTube and Vimeo
            if($this->getInfo($url)->type == 'video' && ($url_parts['host'] == 'youtube.com' || $url_parts['host'] == 'www.youtube.com' || $url_parts['host'] == 'vimeo.com' || $url_parts['host'] == 'www.vimeo.com'))
            {

                // for videos add autoplay check if the embed gets the code

                // create an easy html parser to verify the iframe and add autoplay for video types
                $dom = new DOMDocument;

                // set error level so that the html parser doesn't raise exceptions on warnings
                $internalErrors = libxml_use_internal_errors(true);

                $dom->loadHTML($code);

                // Restore error level
                libxml_use_internal_errors($internalErrors);

                // get the iframe
                $frame = $dom->getElementsByTagName('iframe')->item(0);

                //get the src from iframe
                $src = $frame->getAttribute('src');


                // check if url has any other parameters to properly add the parameter
                if (strpos($src,'?') !== false) {
                    $src .= "&";
                } else {
                    $src .= "?";
                }
                
                $parameters = '';
                foreach ($options as $k=>$v) {
                    if ($parameters !== null) {
                        $parameters .= '&';
                    }
                    $parameters .= "{$k}={$v}";
                }

                $src .= $parameters;

                // set the new src with all the parameters
                $frame->setAttribute('src', $src);

                // replace old iframe html with new one
                return Template::raw( htmlspecialchars_decode($dom->saveHTML($frame)) );
            }
            else
            {
                // Not YouTube or Vimeo, just output the code
                return Template::raw($code);
            }
        }
        else
        {
            // No options passed, just output the code
            return Template::raw($code);
        }

    }



    /**
     * Take a youtube or vimeo url and return the embed url
     *
     * @param string $url
     * @return string
     */
    public function getEmbedUrl($url, array $options = array() )
    {
        $code = $this->getInfo($url)->code;
        $url_parts = parse_url($url);

        // looks like there are, now let's only do this for YouTube and Vimeo
        if($this->getInfo($url)->type == 'video' && ($url_parts['host'] == 'youtube.com' || $url_parts['host'] == 'www.youtube.com' || $url_parts['host'] == 'vimeo.com' || $url_parts['host'] == 'www.vimeo.com'))
        {
            // check if theree are any options passed along
            if (!empty($options)) {
                
                $parameters = '?';
                foreach ($options as $k=>$v) {
                    if ($parameters !== null) {
                        $parameters .= '&';
                    }
                    $parameters .= "{$k}={$v}";
                }


            
                if ($this->_isYoutube($url)) {
                    $url_parts = parse_url($url);
                    parse_str($url_parts['query'], $segments);
        
                    $embedUrl = '//www.youtube.com/embed/' . $segments['v'] . $parameters;
                    return Template::raw($embedUrl);
                } else if ($this->_isShortYoutube($url)) {
                    $url_parts = parse_url($url);
        
                    $embedUrl = '//www.youtube.com/embed' . $url_parts['path'] . $parameters;
                    return Template::raw($embedUrl);
                } else if ($this->_isVimeo($url)) {
                    $url_parts = parse_url($url);
                    $segments = explode('/', $url_parts['path']);
        
                    $embedUrl = '//player.vimeo.com/video/' . $segments[1] . $parameters . '?player_id=video&api=1';
                    return Template::raw($embedUrl);
                }
            }
            else
            {
                // No options
                if ($this->_isYoutube($url)) {
                    $url_parts = parse_url($url);
                    parse_str($url_parts['query'], $segments);
        
                    $embedUrl = '//www.youtube.com/embed/' . $segments['v'];
                    return Template::raw($embedUrl);
                } else if ($this->_isShortYoutube($url)) {
                    $url_parts = parse_url($url);
        
                    $embedUrl = '//www.youtube.com/embed' . $url_parts['path'];
                    return Template::raw($embedUrl);
                } else if ($this->_isVimeo($url)) {
                    $url_parts = parse_url($url);
                    $segments = explode('/', $url_parts['path']);
        
                    $embedUrl = '//player.vimeo.com/video/' . $segments[1] . '?player_id=video&api=1';
                    return Template::raw($embedUrl);
                }
            }
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
        $url_parts = parse_url($url);

        // check for vimeo, I don't like the way Embed returns the Vimeo thumbnail
        if($this->getInfo($url)->type == 'video' && ($url_parts['host'] == 'vimeo.com' || $url_parts['host'] == 'www.vimeo.com'))
        {
            $segments = explode('/', $url_parts['path']);
            $id = $segments[1];
            
            $data = file_get_contents("http://vimeo.com/api/v2/video/$id.json");
            $data = json_decode($data);
            return Template::raw($data[0]->thumbnail_large);
        }
        else
        {
            // not vimeo
            return Template::raw($this->getInfo($url)->image);
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
     * Determine whether the url is a youtube or vimeo url
     * @param string $url
     * @return boolean
     */
    public function getInfo($url)
    {
        return Embed::create($url, [
            'min_image_width' => 1280,
            'min_image_height' => 720,
            'parameters' => [],
        ]);
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
