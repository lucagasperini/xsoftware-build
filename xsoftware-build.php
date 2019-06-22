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

/*
*  XSoftware Build Plugin Class
*  The following class is used to execute plugin operations
*  FIXME: Review structure of this plugin
*/
class xs_build_plugin
{
        /*
        *  __construct : void
        *  The class constructor does not require any parameters and
        *  include shortcode definition file
        */
        function __construct()
        {
                include 'shortcodes.php';
        }
}

$xs_build_plugin = new xs_build_plugin();

?>
