<?php

declare(strict_types=1);

namespace SzepeViktor\WordPress\ACF\FlexibleAssets;

use function get_field;
use function get_field_objects;
use function is_single;
use function sanitize_key;
use function wp_enqueue_script;
use function wp_enqueue_style;
use function wp_script_is;
use function wp_style_is;

class AutoAssets
{
    /** @var string */
    public const HANDLE_PREFIX = 'acf_flex';

    public static function enqueue(): void
    {
        if (!is_singular()) {
            return;
        }

        foreach (array_unique(static::getBlocks()) as $block) {
            $assetHandle = sprintf('%s_%s', static::HANDLE_PREFIX, sanitize_key($block));

            if (wp_style_is($assetHandle, 'registered')) {
                wp_enqueue_style($assetHandle);
            }

            if (wp_script_is($assetHandle, 'registered')) {
                wp_enqueue_script($assetHandle);
            }
        }
    }

    /**
     * @return list<string>
     */
    public static function getBlocks(): array
    {
        $fields = get_field_objects();

        if (!$fields) {
            return [];
        }

        $blocks = [];

        foreach ($fields as $field) {
            /** @var array<string, string> $field */
            if ($field['type'] !== 'flexible_content') {
                continue;
            }

            // Don't use ACF loop
            /** @var list<array<string, string>>|false $rows */
            $rows = get_field($field['name']);

            if (!is_array($rows)) {
                continue;
            }

            foreach ($rows as $row) {
                if (!isset($row['acf_fc_layout'])) {
                    continue;
                }

                $blocks[] = sprintf('%s_%s', $field['name'], $row['acf_fc_layout']);
            }
        }

        return $blocks;
    }
}
