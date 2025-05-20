<?php

namespace SzepeViktor\WordPress\ACF\FlexibleAssets;

use function get_field_objects;
use function have_rows;
use function is_single;
use function the_row;
use function sanitize_key;
use function wp_enqueue_script;
use function wp_enqueue_style;
use function wp_script_is;
use function wp_style_is;

class AutoAssets
{
    public static function enqueue()
    {
        if (!is_single()) {
            return;
        }

        foreach (array_unique(static::getBlocks()) as $block) {
            $assetHandle = sprintf('acf_flex_%s', sanitize_key($block));

            if (wp_style_is($assetHandle, 'registered')) {
                wp_enqueue_style($assetHandle);
            }

            if (wp_script_is($assetHandle, 'registered')) {
                wp_enqueue_script($assetHandle);
            }
        }
    }

    public static function getBlocks()
    {
        $fields = get_field_objects();

        if (!$fields) {
            return [];
        }

        $blocks = [];

        foreach ($fields as $field) {
            if ($field['type'] !== 'flexible_content') {
                continue;
            }

            while (have_rows($field['name'])) {
                the_row();
                $blocks[] = $field['label'].'_'.$field['name'];
            }
        }

        return $blocks;
    }
}
