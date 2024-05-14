<?php
/**
*  @package GoldCurrencyHeatMapPlugin
*/

/*
*  Plugin Name: Gold Currency Heat Map
*  Description: A map that shows Gold, Silver, Platinum, and Palladium’s performance against each country’s currency
*  Version: 1.0
*  Author: auronum
*  Author URI: https://auronum.co.uk
*  License: GPLv2
*  Text Domain: gold-currency-heat-map
*/

if( !defined('ABSPATH') ) {
    header("Location: /");
    die("");
}

function goldCurrencyHeatMap_shortcode($atts) {
    // Default attributes
    $default_atts = array(
        'theme' => 'brand' // Default theme is 'brand'
    );

    // Merge default attributes with user-defined attributes
    $atts = shortcode_atts($default_atts, $atts);

    // Sanitize attributes
    $theme = esc_attr($atts['theme']);

    // Set fixed values for height, width, and src
    $width = '100%';
    $src = 'https://auronum.co.uk/heat-map/';

    // Adjust src URL based on theme
    if ($theme === 'dark' || $theme === 'light') {
        $src .= '?theme=' . $theme;
    }

    // Output HTML embed
    $output = '<embed src="' . $src . '" type="text/html"  width="' . $width . '" rel="noopener" id="heat-map-embed"/><script src="https://auronum.co.uk/heat-map/heat-map-sizing.js" type="text/javascript">';
    
    return $output;
}
add_shortcode('gold_currency_heat_map', 'goldCurrencyHeatMap_shortcode');

// Add a menu item in the WordPress dashboard
function add_gold_currency_heat_map_menu_item() {
    add_menu_page(
        'Gold Currency Heat Map', // Page title
        'Gold Currency Heat Map', // Menu title
        'manage_options', // Capability required
        'gold-currency-heat-map-settings', // Menu slug
        'gold_currency_heat_map_settings_page', // Callback function to display the settings page
        'dashicons-admin-site', // Icon URL
        30 // Menu position
    );
}
add_action('admin_menu', 'add_gold_currency_heat_map_menu_item');

// Callback function to display the settings page
function gold_currency_heat_map_settings_page() {
    ?>
    <div class="wrap heat-map-auronum">
        <h1><?php echo esc_html__('Welcome to Gold Currency Heat Map Guide', 'gold-currency-heat-map'); ?></h1>
        <p><?php echo esc_html__('Thank you for choosing Gold Currency Heat Map to display Gold, Silver, Platinum, and Palladium\'s performance against each country\'s currency. A country will turn green if the metals have risen against its currency', 'gold-currency-heat-map'); ?></p>

        <h2><?php echo esc_html__('How to Use', 'gold-currency-heat-map'); ?></h2>
        <p><?php echo esc_html__('To display the Gold Currency Heat Map, simply use the shortcode [gold_currency_heat_map] in your posts, pages, or widgets.', 'gold-currency-heat-map'); ?></p>

        <h2><?php echo esc_html__('Customization', 'gold-currency-heat-map'); ?></h2>
        <p><?php echo esc_html__('You can customize the appearance of the heat map by specifying a theme. Themes available are "dark" and "light", default theme is "light". To specify a theme, use the attribute "theme" in the shortcode. For example: [gold_currency_heat_map theme="dark"]', 'gold-currency-heat-map'); ?></p>

        <p><?php echo esc_html__('For technical support, please contact us at', 'gold-currency-heat-map'); ?> <a href="mailto:support@auronum.co.uk">support@auronum.co.uk</a>.</p>

        <p><?php echo esc_html__('Visit our website at', 'gold-currency-heat-map'); ?> <a href="https://auronum.co.uk" target="_blank">auronum.co.uk</a>.</p>

        <p><strong><?php echo esc_html__('Thank you for using Gold Currency Heat Map!', 'gold-currency-heat-map'); ?></strong></p>
    </div>

    <style>
        .heat-map-auronum.wrap {
            margin: 20px;
            padding: 20px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .heat-map-auronum h1 {
            color: #c89d58; /* Your brand color */
        }

        .heat-map-auronum p {
            margin-bottom: 15px;
        }

        .heat-map-auronum a {
            color: #c89d58;
        }
    </style>
    <?php
}