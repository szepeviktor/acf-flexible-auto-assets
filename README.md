# acf-flexible-auto-assets

Automatically enqueue CSS and JavaScript files for ACF Flexible Content blocks

Name your asset handle like this

```php
add_action('wp', function() {
    $handle = 'acf_flex_' . $field_name . '_' . $block_name;
    wp_register_style($handle, plugins_url('my-plugin/flex/the-block.css'), [], MY_PLUGIN_VERSION);
});
```
