<?php 
/**
 * @package GithubPluginSync
 */

class GPSdeactivate
{

    public static function deactivate() {
        flush_rewrite_rules();
    }
    
}