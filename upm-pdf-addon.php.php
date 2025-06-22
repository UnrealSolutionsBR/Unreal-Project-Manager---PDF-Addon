<?php
/**
 * Plugin Name: Unreal Project Manager - PDF Addon
 * Description: Genera contratos y facturas en PDF
 * Version: 1.0.0
 * Author: Unreal Solutions
 */

 defined('ABSPATH') || exit;

 define('UPM_PDF_PATH', plugin_dir_path(__FILE__));
 define('UPM_PDF_URL', plugin_dir_url(__FILE__));

 require_once UPM_PDF_PATH . 'includes/class-upm-pdf-generator.php';

 register_activation_hook(__FILE__, function() {
    if (!class_exists('UPM_Loader')) {
        deactivate_plugins(plugin_basename(__FILE__));
        wp_die('El plugin UPM debe estar activo para usar este addon.');
    }
});

add_action('plugins_loaded', function() {
    if (class_exists('UPM_Loader')) {
        UPM_PDF_Generator::init();
    }
});