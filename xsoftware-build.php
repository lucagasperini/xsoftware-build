<?php

/*
Plugin Name: XSoftware Build HTML
Description: HTML management on wordpress.
Version: 1.0
Author: Luca Gasperini
Author URI: https://xsoftware.it/
Text Domain: xsoftware_build
*/

if(!defined("ABSPATH")) die;

class xs_build_plugin
{
        function __construct()
        {
                include 'shortcodes.php';
        }
}

$xs_build_plugin = new xs_build_plugin();

?>
