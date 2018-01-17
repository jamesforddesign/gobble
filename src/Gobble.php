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
use jfd\gobble\twigextensions\GobbleTwigExtensions;

/**
 * Craft plugins are very much like little applications in and of themselves. We’ve made
 * it as simple as we can, but the training wheels are off. A little prior knowledge is
 * going to be required to write a plugin.
 *
 * For the purposes of the plugin docs, we’re going to assume that you know PHP and SQL,
 * as well as some semi-advanced concepts like object-oriented programming and PHP namespaces.
 *
 * https://craftcms.com/docs/plugins/introduction
 *
 * @author    JFD
 * @package   Gobble
 * @since     1.0.0
 *
 * @property  Settings $settings
 * @method    Settings getSettings()
 */
class Gobble extends Plugin
{
    /**
     * Enable use of Gobble::$plugin-> in place of Craft::$plugin->
     *
     * @var Gobble
     */
    public static $plugin;

    public function init()
    {
        parent::init();

        self::$plugin = $this;

        Craft::$app->view->twig->addExtension(new GobbleTwigExtensions());
    }
}
