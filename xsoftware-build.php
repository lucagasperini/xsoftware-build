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

        private $default = array (
                'post_type' => [
                        'post',
                        'page'
                ],
                'fields' => [
                        'descr' => [
                                'name' => 'Description',
                                'type' => 'text'
                        ],
                        'keyword' => [
                                'name' => 'Keywords',
                                'type' => 'text'
                        ],
                        'thumb' => [
                                'name' => 'Thumbnail',
                                'type' => 'img'
                        ],
                        'type' => [
                                'name' => 'Type',
                                'type' => 'i'
                        ],
                        'locale' => [
                                'name' => 'Locale',
                                'type' => 'lang'
                        ]
                ]
        );
        
        private $options = array( );
        
        function __construct()
        {
                add_action('admin_menu', array($this, 'admin_menu'));
                add_action('admin_init', array($this, 'section_menu'));
                
                add_shortcode( 'xs_build', array($this, 'shortcode') );
               
                $this->options = get_option('xs_options_build', $this->default);
        }
        
        function admin_menu()
        {
                add_submenu_page( 'xsoftware', 'XSoftware Build','Build HTML', 'manage_options', 'xsoftware_build', array($this, 'menu_page') );
        }
        
        
        public function menu_page()
        {
                if ( !current_user_can( 'manage_options' ) )  {
                        wp_die( __( 'Exit!' ) );
                }
                
                xs_framework::init_admin_style();
                xs_framework::init_admin_script();
                
                echo '<div class="wrap">';
                
                echo '<form action="options.php" method="post">';

                settings_fields('xs_build_setting');
                do_settings_sections('xs_build');

                submit_button( '', 'primary', 'submit', true, NULL );
                echo '</form>';
                
                echo '</div>';
               
        }

        function section_menu()
        {
                register_setting( 'xs_build_setting', 'xs_options_build', array($this, 'input') );
                add_settings_section( 'xs_build_section', 'Settings', array($this, 'show'), 'xs_build' );
        }

        function show()
        {
                $tab = xs_framework::create_tabs( array(
                        'href' => '?page=xsoftware_build',
                        'tabs' => array(
                                'home' => 'Homepage',
                                'post' => 'Post Types'
                        ),
                        'home' => 'home',
                        'name' => 'main_tab'
                ));
                
                switch($tab) {
                        case 'home':
                                return;
                }
        }

        function input($input)
        {
                $current = $this->options;
                
                return $current;
        }
        
        function shortcode($a)
        {
                $a = shortcode_atts( 
                        [
                                'type' => '', 
                                'text' => '', 
                                'text2' => '',
                                'text3' => '',
                                'link' => '', 
                                'link2' => '',
                                'link3' => '',
                                'image' => '',
                                'image2' => '',
                                'image3' => '',
                                'height' => 0,
                                'width' => 0,
                        ], 
                        $a 
                );
              
                if(empty($a['type'])) return;
                
                wp_enqueue_style('xs_build_style', plugins_url('style/style.css', __FILE__));
                
                switch($a['type'])
                {
                        case 'panel':
                                $style = '';
                                if(!empty($a['image']))
                                        $style .= 'background-image:url(\''.$a['image'].'\');';
                                if(!empty($a['width']))
                                        $style .= 'width:'.$a['width'].';';
                                if(!empty($a['height']))
                                        $style .= 'height:'.$a['height'].';';
                                        
                                echo '<div class="xs_build_panel_bg" style="'.$style.'">';
                                        
                                echo '<div class="xs_build_panel_content">';
                                
                                if(!empty($a['text']))
                                        echo '<h1>'.$a['text'].'</h1>';
                                        
                                if(!empty($a['text2']))
                                        echo '<h3>'.$a['text2'].'</h3>';
                                
                                if(!empty($a['link']) && !empty($a['text3']))
                                        echo '<a class="xs_build_panel_link xs_button" href="'.$a['link'].'">'.$a['text3'].'</a>';
                                        
                                echo '</div>';
                                
                                if(!empty($a['image']))
                                        echo '</div>';
                                return;
                }
        }

}

$xs_build_plugin = new xs_build_plugin();

?>
