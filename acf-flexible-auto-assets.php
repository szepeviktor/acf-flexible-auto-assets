<?php

/**
 * Auto Assets for ACF Flexible Content
 *
 * @wordpress-plugin
 * Plugin Name:       Auto Assets for ACF Flexible Content
 * Plugin URI:        https://github.com/szepeviktor/acf-flexible-auto-assets
 * Description:       Automatically enqueue CSS and JavaScript files for ACF Flexible Content blocks
 * Version:           1.0.0
 * Requires at least: 6.0
 * Requires PHP:      7.4
 * Requires Plugins:  advanced-custom-fields-pro
 * Author:            Viktor Szépe
 * Author URI:        https://github.com/szepeviktor
 * License:           GPL v2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */

declare(strict_types=1);

use SzepeViktor\WordPress\ACF\FlexibleAssets\AutoAssets;

require_once __DIR__.'/src/AutoAssets.php';

add_action(
    'acf/init',
    static function () {
        add_action('wp', [AutoAssets::class, 'enqueue'], 10, 0);
    },
    10,
    0
);
