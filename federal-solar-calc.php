<?php
/**
* Plugin Name: Federal Solar Calculator
* Plugin URI:
* Description: Calculates estimated solar savings based on your electricity bill. Use '[fsc-calc]' shortcode.
* Version: 1.0
* Author: RomartM
* Author URI:
**/

define('FSC_PLUGIN_PATH', plugin_dir_url( __FILE__ ));

function FSCalculator( $overrides_attr ){

  // Attributes
  $overrides_attr = shortcode_atts(
    array(
      'id' => 'video ID',
    ),
    $overrides_attr
  );

  // Include FSC Table
  include('class/FSC_Table.php');

  ob_start();

  include('templates/widget.php');

  $content = ob_get_clean();

  return $content;
}

add_shortcode( 'fsc-calc', 'FSCalculator' );

function fsc_assets() {
    global $post;

    if ( is_a( $post, 'WP_Post' ) &&  has_shortcode( $post->post_content, 'fsc-calc')) {
        // all styles
        wp_enqueue_style( 'bootstrap', FSC_PLUGIN_PATH . 'assets/css/lib/bootstrap.min.css', array(), 1 );
        wp_enqueue_style( 'fsc-style', FSC_PLUGIN_PATH . 'assets/css/fsc-style.css', array(), 1 );

        // all scripts
        //wp_enqueue_script( 'bootstrap', FSC_PLUGIN_PATH . 'assets/lib/js/bootstrap.min.js', array('jquery'), '1', true );
        wp_enqueue_script( 'fsc-script', FSC_PLUGIN_PATH . 'assets/js/fsc-script.js', array('jquery'), '1', true );

        // Preset Data
        $preset_input_data = array(
             'office' => array(array('Brisbane', 'selected'), array('Cairns', ''), array('Melbourne', ''), array('Sydney', '')),
             'battery_offered' =>  array(array('Yes', 'selected'), array('No', '')),
             'battery_model' =>  array(array('LG Chem 6.4', 'selected'), array('LG Chem 9.8', ''), array('Tesla PW2', '')),
             'system_size' => array('value'=>10.00),
             'daytime_usage' => array('value'=>60),
             'power_price'=>array('value'=>0.29),
             'feed_in_tariff'=>array('value'=>0.16),
             'system_loss_factor'=>array('value'=>0),
             'smoothing_rate'=>array('value'=>25)
        );
        wp_localize_script('fsc-script', 'fsc_json_vars', array('preset-data'=> $preset_input_data ) );
    }
}

add_action('wp_enqueue_scripts', 'fsc_assets');
