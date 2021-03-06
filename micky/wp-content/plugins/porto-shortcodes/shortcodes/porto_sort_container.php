<?php

// Porto Sort Container
add_shortcode('porto_sort_container', 'porto_shortcode_sort_container');
add_action('vc_after_init', 'porto_load_sort_container_shortcode');

function porto_shortcode_sort_container($atts, $content = null) {
    ob_start();
    if ($template = porto_shortcode_template('porto_sort_container'))
        include $template;
    return ob_get_clean();
}

function porto_load_sort_container_shortcode() {
    $animation_type = porto_vc_animation_type();
    $animation_duration = porto_vc_animation_duration();
    $animation_delay = porto_vc_animation_delay();
    $custom_class = porto_vc_custom_class();

    vc_map( array(
        "name" => "Porto " . __("Sort Container", 'porto-shortcodes'),
        "base" => "porto_sort_container",
        "category" => __("Porto", 'porto-shortcodes'),
        "icon" => "porto_vc_sort_container",
        'is_container' => true,
        'weight' => - 50,
        'js_view' => 'VcColumnView',
        "as_parent" => array('only' => 'porto_sort_item'),
        "params" => array(
            array(
                "type" => "textfield",
                "heading" => __("Container ID", 'porto-shortcodes'),
                "param_name" => "id",
                "value" => ""
            ),
            $animation_type,
            $animation_duration,
            $animation_delay,
            $custom_class
        )
    ) );

    if (!class_exists('WPBakeryShortCode_Porto_Sort_Container')) {
        class WPBakeryShortCode_Porto_Sort_Container extends WPBakeryShortCodesContainer {
        }
    }
}