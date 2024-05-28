<?php 
/**
 * @package GithubPluginSync
 */

class GPSactivate
{

    public static function activate() {
        flush_rewrite_rules();
    }
    
}