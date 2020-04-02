<?php
/**
* Plugin Name: Power Saving Estimate Calculator for Federal Energy Comparison
* Plugin URI:
* Description: Calculates estimated solar savings based on your electricity bill. Use '[pse-calc]' shortcode.
* Version: 1.0
* Author: RomartM
* Author URI:
**/

define('PSE_PLUGIN_PATH', plugin_dir_url( __FILE__ ));

function PSEcalculator( $overrides_attr ){

  // Attributes
  $overrides_attr = shortcode_atts(
    array(
      'id' => 'video ID',
    ),
    $overrides_attr
  );

  // Include PSE Table
  include('class/PSE_Table.php');

  ob_start();

  include('templates/widget.php');

  $content = ob_get_clean();

  return $content;
}

add_shortcode( 'pse-calc', 'PSEcalculator' );

function pse_assets() {
    global $post;

    if ( is_a( $post, 'WP_Post' ) &&  has_shortcode( $post->post_content, 'pse-calc')) {
        // all styles
        wp_enqueue_style( 'bootstrap', PSE_PLUGIN_PATH . 'assets/css/lib/bootstrap.min.css', array(), 1 );
        wp_enqueue_style( 'pse-style', PSE_PLUGIN_PATH . 'assets/css/pse-style.css', array(), 1 );

        // all scripts
        wp_enqueue_script( 'bootstrap', PSE_PLUGIN_PATH . 'assets/js/lib/bootstrap.min.js', array('jquery'), '1', true );
        wp_enqueue_script( 'pse-xls-utils', PSE_PLUGIN_PATH . 'assets/js/pse-xls-utils.js', array('jquery'), '1', true );
        wp_enqueue_script( 'pse-script', PSE_PLUGIN_PATH . 'assets/js/pse-script.js', array('jquery'), '1', true );

        // Preset Data
        $preset_input_data = array(
             'office' => array(array('Brisbane', 'selected'), array('Cairns', ''), array('Melbourne', ''), array('Sydney', '')),
             'battery_offered' =>  array(array('Yes', 'selected'), array('No', '')),
             'battery_model' =>  array(array('LG Chem 6.4', ''), array('LG Chem 9.8', ''), array('Tesla PW2', 'selected')),
             'system_size' => array('value'=>10.00),
             'daytime_usage' => array('value'=>60),
             'power_price'=>array('value'=>0.28),
             'feed_in_tariff'=>array('value'=>0.16),
             'system_loss_factor'=>array('value'=>0),
             'smoothing_rate'=>array('value'=>25),
             'offices_dataset'=> array(array('Brisbane', 4.2), array('Cairns', 4.2), array('Melbourne', 3.6), array('Sydney', 3.9)),
             'currency'=>array('value'=> '$')
        );
        wp_localize_script('pse-script', 'pse_json_vars', array('preset-data'=> $preset_input_data ) );
    }
}

add_action('wp_enqueue_scripts', 'pse_assets');
