<?php 
/*
 * Plugin Name:       Github Plugin Sync
 * Plugin URI:        https://github.com/jay-galileo-academy/Wordpress-Plugin-Github-Sync
 * Description:       Syncs your WordPress plugin with your Github repository.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Jay Schmidt
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://github.com/jay-galileo-academy/Wordpress-Plugin-Github-Sync
 * Text Domain:       github-plugin-sync
 * Domain Path:       /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
    die;
}

class GithubPluginSync
{

    function register() {
        add_action('init', [$this, 'update']);
    }

    function update() {

        include_once 'handlers/gps-updater.php';

        define( 'WP_GITHUB_FORCE_UPDATE', true );

        if ( is_admin() ) {

            $config = array(
                'slug' => plugin_basename( __FILE__ ),
                'proper_folder_name' => 'github-updater',
                'api_url' => 'https://api.github.com/repos/jay-galileo-academy/Wordpress-Plugin-Github-Sync',
                'raw_url' => 'https://raw.github.com/jay-galileo-academy/Wordpress-Plugin-Github-Sync/master',
                'github_url' => 'https://github.com/jay-galileo-academy/Wordpress-Plugin-Github-Sync',
                'zip_url' => 'https://github.com/jay-galileo-academy/Wordpress-Plugin-Github-Sync/archive/master.zip',
                'sslverify' => true,
                'requires' => '3.0',
                'tested' => '3.3',
                'readme' => 'README.md',
                'access_token' => '',
            );

            new WP_GitHub_Updater( $config );

        }

    }

}

if ( class_exists( 'GithubPluginSync' ) ) {
    $githubpluginsync = new GithubPluginSync();
    $githubpluginsync->register();
}


// activation
require_once plugin_dir_path(__FILE__) . 'handlers/gps-activate.php';
register_activation_hook( __FILE__, [ 'GPSactivate', 'activate']);

// deactivation
require_once plugin_dir_path(__FILE__) . 'handlers/gps-deactivate.php';
register_deactivation_hook( __FILE__, ['GPSdeactivate', 'deactivate']);