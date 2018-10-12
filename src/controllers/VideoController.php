<?php
/**
 * Video Embedder plugin for Craft CMS 3.x
 *
 * Craft plugin to generate an embed URL from a YouTube or Vimeo URL.
 *
 * @link      http://github.com/mikestecker
 * @copyright Copyright (c) 2017 Mike Stecker
 */

namespace mikestecker\videoembedder\controllers;

use Craft;
use craft\web\Controller;
use mikestecker\videoembedder;

class VideoController extends Controller
{

    // Protected Properties
    // =========================================================================

    /**
     * @var    bool|array Allows anonymous access to this controller's actions.
     *         The actions must be in 'kebab-case'
     * @access protected
     */
    protected $allowAnonymous = [];

    // Public Methods
    // =========================================================================

    /**
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \yii\base\Exception
     */
    public function actionParse(): string
    {
        $url = Craft::$app->request->get('url');

        return Craft::$app->getView()->renderTemplate(
            'video-embedder/VideoField/inputEmbed.twig',
            [
                'name' => Craft::$app->request->get('name'),
                'value' => $url,
            ]
        );
    }

}
