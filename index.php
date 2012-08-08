<?php
/*
Plugin Name: WP-Modal-Popin
Plugin URI: http://soixantecircuits.fr
Description: Add tinymce button for [modal window]
Version: 1.0
Author: Soixante Circuits
Author URI: http://soixantecircuits.fr
*/

define('MTMCE_URL', plugins_url('/', __FILE__));
define('MTMCE_DIR', dirname(__FILE__));
define('MTMCE_VERSION', '1.0');

require_once (MTMCE_DIR . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'class.client.php');
function MyTinyMceButtonModal_Init() {
  global $myTinyMce;

  // Load translations
  load_plugin_textdomain('mytmodal', false, basename(rtrim(dirname(__FILE__), '/')) . '/languages');

  // Load client
  if (!is_admin()) {
    $myTinyMce['client'] = new myTinyMceButtonModal_Client();
  }

  // Admin
  if (is_admin()) {
    require_once (MTMCE_DIR . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'class.admin.php');
    $myTinyMce['admin'] = new myTinyMceButtonModal_Admin();
}
}

add_action('plugins_loaded', 'MyTinyMceButtonModal_Init');
?>
