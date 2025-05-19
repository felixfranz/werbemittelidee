<?php 
/*
Element Description: VC Recent Projects Mix
*/
 
// Element Class 
class vc_aga_slider extends WPBakeryShortCode {
     
    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'vc_slider_mapping' ),12 );
        add_shortcode( 'vc_call_to_slider', array( $this, 'vc_call_to_slider_html' ) );
    }
     
    // Element Mapping
    public function vc_slider_mapping() {
         
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
                return;
        }
             
        // Map the block with vc_map()
        vc_map( 
            array(
                'name' => __('Mitglieds Film Slider', 'text-domain'),
                'base' => 'vc_call_to_slider',
                'description' => __('Mitglieds Film Slider', 'text-domain'), 
                'category' => __('Custom Elements', 'text-domain'),   
                'icon' => get_template_directory_uri().'/assets/img/icon-media-teaser.svg'

            )
        );                                       
    }
        
// Element HTML
public function vc_call_to_slider_html( $atts ) {

    $atts = vc_map_get_attributes('vc_call_to_slider', $atts);
    extract($atts);


    $args = [
    'numberposts' => -1, 
    'post_type' => 'mitglied',
            'post_status' => 'publish',
           'meta_query' => array(
                array(
                    'key' => 'custompost_show_on_home',
                    'compare' => 'IN',
                    'value' => array('1')
                )
            )
];
$posts = get_posts($args);
$count = count($posts);


if( $count != 0){


    $html = '<div class="slider_container">
                <ul class="aga_slider">';

    $post_type = 'mitglied';
    $post_count = 4;
     
    // LOOP LAUFEN LASSEN
    $args = array( 
            'post_type' => $post_type,
            'posts_per_page' => $post_count,
            'orderby'   => 'rand',
            'post_status' => 'publish',
           'meta_query' => array(
                array(
                    'key' => 'custompost_show_on_home',
                    'compare' => 'IN',
                    'value' => array('1')
                )
            ),
          );

        $loop = new WP_Query( $args );
        while ( $loop->have_posts() ) : $loop->the_post(); 

        $post_id       = get_the_ID();
        $image         = get_field('custompost_example_image');
        $infos         = get_field('custompost_movie_infos');

        $image_src = $image['url'];
        $title          = get_the_title();
        

       $html .= '<li>

                    <div class="image_container">
                        <img src="'.$image_src.'">
                    </div>
                        <p class="movie_captoin">'. $infos .'</h4>
                       
                
                </<li>';

        endwhile;

        $html .= '</ul>';    
    

        $html .= '</div>'; // end slider


    wp_reset_postdata();
    return $html;  

}

}
     
} // End Element Class
 
// Element Class Init
new vc_aga_slider(); 

?>