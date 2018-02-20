<?php
/**
 * Video Embedder plugin for Craft CMS 3.x
 *
 * Craft plugin to generate an embed URL from a YouTube or Vimeo URL.
 *
 * @link      http://github.com/mikestecker
 * @copyright Copyright (c) 2017 Mike Stecker
 */

namespace mikestecker\videoembedder;

use mikestecker\videoembedder\services\VideoEmbedderService;
use mikestecker\videoembedder\variables\VideoEmbedderVariable;

use Craft;
use craft\base\Plugin;
use craft\services\Plugins;
use craft\events\PluginEvent;
use craft\web\twig\variables\CraftVariable;

use yii\base\Event;

/**
 * Class VideoEmbedder
 *
 * @author    Mike Stecker
 * @package   VideoEmbedder
 * @since     1.0.0
 *
 * @property  VideoEmbedderServiceService $videoEmbedderService
 */
class VideoEmbedder extends Plugin
{
    // Static Properties
    // =========================================================================

    /**
     * @var VideoEmbedder
     */
    public static $plugin;

    // Public Properties
    // =========================================================================

    /**
     * @var string
     */
    public $schemaVersion = '1.0.0';

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        self::$plugin = $this;

        // Register Components (Services)
        $this->setComponents([
            'service' => VideoEmbedderService::class,
        ]);

        Event::on(
            CraftVariable::class,
            CraftVariable::EVENT_INIT,
            function (Event $event) {
                /** @var CraftVariable $variable */
                $variable = $event->sender;
                $variable->set('videoEmbedder', VideoEmbedderVariable::class);
            }
        );

        Event::on(
            Plugins::class,
            Plugins::EVENT_AFTER_INSTALL_PLUGIN,
            function (PluginEvent $event) {
                if ($event->plugin === $this) {
                }
            }
        );

        Craft::info(
            Craft::t(
                'video-embedder',
                '{name} plugin loaded',
                ['name' => $this->name]
            ),
            __METHOD__
        );
    }

    // Protected Methods
    // =========================================================================

}