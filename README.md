# acf-flexible-auto-assets

Automatically enqueue CSS and JavaScript files for ACF Flexible Content blocks.

## Installation

Here is the plugin ZIP https://github.com/szepeviktor/acf-flexible-auto-assets/archive/refs/heads/master.zip

## Usage

Name your asset handle like this.

```php
add_action('wp', function () {
    $handle = 'acf_flex_' . $field_name . '_' . $block_name;
    wp_register_style($handle, plugins_url('my-plugin/flex/the-block.css'), [], MY_PLUGIN_VERSION);
});
```
