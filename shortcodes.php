<?php
if(!function_exists('xsb_panel')) :
        
        add_shortcode( 'xsb_panel', 'xsb_panel');

        function xsb_panel($attr, $c = null)
        {
                $a = shortcode_atts( 
                        [
                                'image' => '',
                                'height' => 0,
                                'width' => 0,
                        ], 
                        $attr 
                );
                
                wp_enqueue_style('xs_build_style', plugins_url('style/style.css', __FILE__));

                $style = '';
                if(!empty($a['image']))
                        $style .= 'background-image:url(\''.$a['image'].'\');';
                if(!empty($a['width']))
                        $style .= 'width:'.$a['width'].';';
                if(!empty($a['height']))
                        $style .= 'height:'.$a['height'].';';
                                        
                if(!empty($a['image']))
                        echo '<div class="xs_build_panel_bg" style="'.$style.'">';
                                        
                echo '<div class="xs_build_panel_content">'.$c.'</div>';
                                
                if(!empty($a['image']))
                        echo '</div>';
                        
                return;
        }
        
endif;

if(!function_exists('xsb_slideshow')) :
        
        add_shortcode( 'xsb_slideshow', 'xsb_slideshow');

        function xsb_slideshow($attr, $c = null)
        {
                $a = shortcode_atts( 
                        [
                                'height' => 0,
                                'width' => 0,
                                'time' => 0
                        ], 
                        $attr 
                );
                
                $style = '';
                
                if(!empty($a['width']))
                        $style .= 'width:'.$a['width'].';';
                if(!empty($a['height']))
                        $style .= 'height:'.$a['height'].';';
                
                xs_framework::init_admin_script();
                wp_enqueue_style('xs_build_style', plugins_url('style/style.css', __FILE__));
                wp_enqueue_script('xs_build_script', plugins_url('js/panel.js', __FILE__));
                
                if(!empty($a['time']))
                        echo '<script>var xs_build_image_slide_time='.json_encode($a['time']).';</script>';
                else
                        echo '<script>var xs_build_image_slide_time=4000;</script>';

                echo '<div class="xs_build_slideshow" style="'.$style.'">'.$c.'</div>';
                        
                return;
        }
        
endif;
 
?>
