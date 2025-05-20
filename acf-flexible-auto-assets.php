<?php

// Me = plugin

use SzepeViktor\WordPress\ACF\FlexibleAssets\AutoAssets;

add_action(
    'acf/init',
    static function () {
        add_action('wp', [AutoAssets::class, 'enqueue'], 10, 0);
    },
    10,
    0
);
