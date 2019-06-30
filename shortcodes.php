<?php
if(!function_exists('xsb_two_column_img')) :

        add_shortcode( 'xsb_two_column_img', 'xsb_two_column_img');

        /*
        *  string : xsb_panel : array, string
        *  This method is used to create the shortcode of panel
        *  where an image is set as background of a content html
        *  $attr are the attributes of this shortcode
        *  $c is the html content of this shortcode default value is null
        */
        function xsb_two_column_img($attr, $c = null)
        {
                /* Set html output variable as empty string */
                $output = '';
                /*
                *  Extract the attributes from the array $attr with the following structure:
                *  'image' is the URL of background image default value is an empty string
                *  'first_text' is an virtual boolean value, if is > 0 print text on first column
                *  'class' is a list of css classes to add on icon, default value is empty string
                */
                $a = shortcode_atts(
                        [
                                'image' => '',
                                'first_text' => 1,
                                'class' => '',
                        ],
                        $attr
                );

                /* Return empty string if image is null (so there are not image to show) */
                if(empty($a['image'])) return '';

                /* Add it's css style */
                wp_enqueue_style(
                        'xsb_two_column_img',
                        plugins_url('style/xsb_two_column_img.min.css', __FILE__)
                );

                /* Print a container for class if it's not empty */

                /* Create a container for this shortcode and add css classes */
                $output .= '<div class="xsb_two_column '.$a['class'].'">';

                if($a['first_text']) {
                        /* Add in the first column the content and in second the image */
                        $output .= '<span>'.$c.'</span>';
                        $output .= '<img src="'.$a['image'].'"/>';
                } else {
                        /* Add in the first column the image and in second the content */
                        $output .= '<img src="'.$a['image'].'"/>';
                        $output .= '<span>'.$c.'</span>';
                }

                /* Close the container for this shortcode */
                $output .= '</div>';
                /* Return the html output */
                return $output;
        }

endif;
if(!function_exists('xsb_panel')) :

        add_shortcode( 'xsb_panel', 'xsb_panel');

        /*
        *  string : xsb_panel : array, string
        *  This method is used to create the shortcode of panel
        *  where an image is set as background of a content html
        *  $attr are the attributes of this shortcode
        *  $c is the html content of this shortcode default value is null
        */
        function xsb_panel($attr, $c = null)
        {
                /* Set html output variable as empty string */
                $output = '';
                /*
                *  Extract the attributes from the array $attr with the following structure:
                *  'image' is the URL of background image default value is an empty string
                */
                $a = shortcode_atts(
                        [
                                'image' => '',
                        ],
                        $attr
                );

                /* Add default style */
                wp_enqueue_style('xs_build_style', plugins_url('style/style.min.css', __FILE__));

                /* Create a container for this shortcode */
                $output .= '<div class="xs_build_panel">';

                /* If image is not empty print it */
                if(!empty($a['image']))
                        $output .= '<img class="xs_build_panel_image" src="'.$a['image'].'">';

                /* Add the content to the panel if is present */
                $output .= '<div class="xs_build_panel_content">'.$c.'</div>';

                /* Close the container for this shortcode */
                $output .= '</div>';
                /* Return the html output */
                return $output;
        }

endif;

if(!function_exists('xsb_slideshow')) :

        add_shortcode( 'xsb_slideshow', 'xsb_slideshow');

        /*
        *  string : xsb_slideshow : array, string
        *  This method is used to create the shortcode of slideshow
        *  where all images are show with an automatic switch time
        *  $attr are the attributes of this shortcode
        *  $c is the html content of this shortcode default value is null
        */
        function xsb_slideshow($attr, $c = null)
        {
                /* Set html output variable as empty string */
                $output = '';
                /*
                *  Extract the attributes from the array $attr with the following structure:
                *  'height' is pixel height property of all images default value is 0
                *  'width' is pixel width property of all images default value is 0
                *  'time' is a delta time in ms (second/1000) calculated by the start of image
                *  number 1 minus the start of image number 2
                */
                $a = shortcode_atts(
                        [
                                'height' => 0,
                                'width' => 0,
                                'time' => 0
                        ],
                        $attr
                );

                /* Return empty string if content is null (so there are not image to show) */
                if($c == null) return '';

                /* Hardcoded style in html */
                $style = '';

                /* Get the width property if it's not empty and append in $style */
                if(!empty($a['width']))
                        $style .= 'width:'.$a['width'].'px;';
                /* Get the height property if it's not empty and append in $style */
                if(!empty($a['height']))
                        $style .= 'height:'.$a['height'].'px;';

                /* Add default style */
                wp_enqueue_style('xs_build_style', plugins_url('style/style.min.css', __FILE__));
                /* Add the javascript */
                wp_enqueue_script('xs_build_script', plugins_url('js/panel.min.js', __FILE__));

                /*
                *  Hardcoded javascript to define the variable 'time' in js,
                *  4000 is the value when 'time' is empty (as 0)
                */
                if(!empty($a['time']))
                        $output .= '<script>var xs_build_image_slide_time='.json_encode($a['time']).
                                ';</script>';
                else
                        $output .= '<script>var xs_build_image_slide_time=4000;</script>';

                /* Print the container and it's style, with content (Image list) */
                $output .= '<div class="xs_build_slideshow" style="'.$style.'">'.$c.'</div>';

                /* Return the html output */
                return $output;
        }

endif;

if(!function_exists('xsb_carousel')) :

        add_shortcode( 'xsb_carousel', 'xsb_carousel');
        /*
        *  string : xsb_carousel : array, string
        *  This method is used to create the shortcode of carousel
        *  where 'items' value elements are show on the same line with arrows to show hidden element
        *  $attr are the attributes of this shortcode
        *  $c is the html content of this shortcode default value is null
        */
        function xsb_carousel($attr, $c = null)
        {
                /* Set html output variable as empty string */
                $output = '';
                /*
                *  Extract the attributes from the array $attr with the following structure:
                *  'height' is pixel height property of all images default value is 0
                *  'width' is pixel width property of all images default value is 0
                *  'items' is the number of image or element to show, default value is 0
                */
                $a = shortcode_atts(
                        [
                                'height' => 0,
                                'width' => 0,
                                'items' => 0
                        ],
                        $attr
                );

                /* Return empty string if content is null (so there are not elements to show) */
                if($c == null) return '';

                /* Hardcoded style in html */
                $style = '';

                 /* Get the width property if it's not empty and append in $style */
                if(!empty($a['width']))
                        $style .= 'max-width:'.$a['width'].'px;';
                /* Get the height property if it's not empty and append in $style */
                if(!empty($a['height']))
                        $style .= 'max-height:'.$a['height'].'px;';

                /*
                *  Hardcoded javascript to define the variable 'items' in js,
                *  5 is the value when 'items' is empty (as 0)
                */
                if(!empty($a['items']))
                        $output .= '<script>var xs_build_carousel_range='.json_encode($a['items']).
                        ';</script>';
                else
                        $output .= '<script>var xs_build_carousel_range=5;</script>';

                /* Add default style */
                wp_enqueue_style('xs_build_style', plugins_url('style/style.min.css', __FILE__));
                /* Add the specific javascript file */
                wp_enqueue_script('xs_build_script', plugins_url('js/carousel.min.js', __FILE__));

                /* Print container with it's hardcoded style */
                $output .= '<div class="xs_build_carousel" style="'.$style.'">';
                /* Print arrow to back on a previous element */
                $output .= '<div class="xs_build_carousel_control" style="float:left;"
                        onclick="xsb_carousel_btn(-1);"><i class="fas fa-less-than"></i></div>';
                /* Print a container for the content with an effect fade */
                $output .= '<div class="xs_build_carousel_content fade">';
                $output .= $c;
                $output .= '</div>';
                /* Print arrow to go on a next element */
                $output .= '<div class="xs_build_carousel_control" style="float:right;"
                        onclick="xsb_carousel_btn(1);"><i class="fas fa-greater-than"></i></div>';
                /* Close the container */
                $output .= '</div>';

                /* Return the html output */
                return $output;
        }

endif;

if(!function_exists('xsb_fa')) :

        add_shortcode( 'xsb_fa', 'xsb_fa');
        /*
        *  string : xsb_fa : array, string
        *  This method is used to create the shortcode to show fontawesome icons
        *  $attr are the attributes of this shortcode
        *  $c is the html content of this shortcode default value is null
        */
        function xsb_fa($attr, $c = null)
        {
                /* Set html output variable as empty string */
                $output = '';
                /*
                *  Extract the attributes from the array $attr with the following structure:
                *  'icon' is the name of fontawesome icon, default value is empty string
                *  'type' is the type of fontawesome icon, default value is "fas" string
                *  'style' is an hardcoded style for the icon, default value is empty string
                *  'class' is a list of css classes to add on icon, default value is empty string
                */
                $a = shortcode_atts(
                        [
                                'icon' => '',
                                'type' => 'fas',
                                'style' => '',
                                'class' => ''
                        ],
                        $attr
                );

                /* Return empty string if 'icon' is empty (so there is not icon to show) */
                if(empty($a['icon'])) return '';

                /* Add default style */
                wp_enqueue_style('xs_build_style', plugins_url('style/style.min.css', __FILE__));

                /* Print a container for class if it's not empty */
                if(!empty($a['class']))
                        $output .= '<span class="'.$a['class'].'">';

                /* Print a container for style if it's not empty */
                if(!empty($a['style']))
                        $output .= '<span style="'.$a['style'].'">';

                /* Print the icon with the content */
                $output .= '<i class="'.$a['type'].' fa-'.$a['icon'].'">'.$c.'</i>';

                /* Close the style container */
                if(!empty($a['style']))
                        $output .= '</span>';

                /* Close the class container */
                if(!empty($a['class']))
                        $output .= '</span>';
                /* Return the html output */
                return $output;
        }

endif;


?>
