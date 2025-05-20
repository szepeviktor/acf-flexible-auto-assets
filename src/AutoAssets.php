<?php

namespace SzepeViktor\WordPress\ACF\FlexibleAssets;

use function get_field_objects;
use function have_rows;
use function is_single;
use function the_row;
use function wp_enqueue_script;
use function wp_enqueue_style;

class AutoAssets
{
    public static function enqueue()
    {
        if (!is_single()) {
            return;
        }

        foreach (static::getBlocks() as $block) {
            wp_enqueue_style($block);
            wp_enqueue_script($block);
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
