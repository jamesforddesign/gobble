<?php
/**
 * Gobble plugin for Craft 3
 *
 * A simple plugin for sending REST API requests directly from your templates.
 *
 * @link      https://www.jfd.co.uk
 * @copyright Copyright (c) 2018 James Ford Design
 */

namespace jfd\gobble;

use Craft;
use craft\base\Plugin;
use GuzzleHttp\Client;
use jfd\gobble\twigextensions\GobbleTwigExtensions;

/**
 *
 * @author    JFD
 * @package   Gobble
 * @since     1.0.0
 */
class Gobble extends Plugin
{
    public function init()
    {
        parent::init();

        // Create a new Guzzle client
        $client = new Client();

        Craft::$app->view->registerTwigExtension(new GobbleTwigExtensions($client));
    }
}
