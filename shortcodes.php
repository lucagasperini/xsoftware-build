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
                
                if($c == null) return;
                
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

if(!function_exists('xsb_carousel')) :
        
        add_shortcode( 'xsb_carousel', 'xsb_carousel');

        function xsb_carousel($attr, $c = null)
        {
                $a = shortcode_atts( 
                        [
                                'height' => 0,
                                'width' => 0,
                                'items' => 0
                        ], 
                        $attr 
                );
                
                if($c == null) return;
                
                $style = '';
                
                if(!empty($a['width']))
                        $style .= 'max-width:'.$a['width'].';';
                if(!empty($a['height']))
                        $style .= 'max-height:'.$a['height'].';';
                        
                if(!empty($a['items']))
                        echo '<script>var xs_build_carousel_range='.json_encode($a['items']).';</script>';
                else
                        echo '<script>var xs_build_carousel_range=5;</script>';
               
                wp_enqueue_style('xs_build_style', plugins_url('style/style.css', __FILE__));
                wp_enqueue_script('xs_build_script', plugins_url('js/carousel.js', __FILE__));
                wp_enqueue_style('xs_build_fontawesome_style', plugins_url('style/fontawesome/css/all.min.css', __FILE__));

                echo '<div class="xs_build_carousel" style="'.$style.'">';
                echo '<div class="xs_build_carousel_control" style="float:left;" onclick="xsb_carousel_btn(-1);"><i class="fas fa-less-than"></i></div>';
                echo '<div class="xs_build_carousel_content">';
                echo $c;
                echo '</div>';
                echo '<div class="xs_build_carousel_control" style="float:right;" onclick="xsb_carousel_btn(1);"><i class="fas fa-greater-than"></i></div>';
                echo '</div>';
                        
                return;
        }
        
endif;

if(!function_exists('xsb_fa')) :
        
        add_shortcode( 'xsb_fa', 'xsb_fa');

        function xsb_fa($attr, $c = null)
        {
                $a = shortcode_atts( 
                        [
                                'icon' => '',
                                'type' => 'fas',
                                'style' => '',
                                'class' => ''
                        ], 
                        $attr 
                );
                
                if(empty($a['icon'])) return;
               
                wp_enqueue_style('xs_build_fontawesome_style', plugins_url('style/fontawesome/css/all.min.css', __FILE__));
                wp_enqueue_style('xs_build_style', plugins_url('style/style.css', __FILE__));
                
                if(!empty($a['class']))
                        echo '<span class="'.$a['class'].'">';
                
                if(!empty($a['style']))
                        echo '<span style="'.$a['style'].'">';
                
                echo '<i class="'.$a['type'].' fa-'.$a['icon'].'">'.$c.'</i>';
                
                if(!empty($a['style']))
                        echo '</span>';
                        
                if(!empty($a['class']))
                        echo '</span>';
                        
                return;
        }
        
endif;

 
?>
