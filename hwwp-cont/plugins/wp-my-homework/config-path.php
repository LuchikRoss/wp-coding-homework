<?php
/**
 * User: rostyslavnaryzhniak
 * Date: 12.12.17
 */
define("HOMEWORK_PlUGIN_DIR", plugin_dir_path(__FILE__));
define("HOMEWORK_PlUGIN_URL", plugin_dir_url( __FILE__ ));
define("HOMEWORK_PlUGIN_SLUG", preg_replace( '/[^\da-zA-Z]/i', '_',  basename(HOMEWORK_PlUGIN_DIR)));
define("HOMEWORK_PlUGIN_TEXTDOMAIN", str_replace( '_', '-', HOMEWORK_PlUGIN_SLUG ));
define("HOMEWORK_PlUGIN_OPTION_VERSION", HOMEWORK_PlUGIN_SLUG.'_version');
define("HOMEWORK_PlUGIN_OPTION_NAME", HOMEWORK_PlUGIN_SLUG.'_options');
define("HOMEWORK_PlUGIN_AJAX_URL", admin_url('admin-ajax.php'));

if ( ! function_exists( 'get_plugins' ) ) {
    require_once ABSPATH . 'wp-admin/includes/plugin.php';
}
$TPOPlUGINs = get_plugin_data(HOMEWORK_PlUGIN_DIR.'/'.basename(HOMEWORK_PlUGIN_DIR).'.php', false, false);

define("HOMEWORK_PlUGIN_VERSION", $TPOPlUGINs['Version']);
define("HOMEWORK_PlUGIN_NAME", $TPOPlUGINs['Name']);

define("HOMEWORK_PlUGIN_DIR_LOCALIZATION", plugin_basename(HOMEWORK_PlUGIN_DIR.'/languages/'));