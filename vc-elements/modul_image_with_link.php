<?php 
 
// Element Class 
class vc_image_with_link extends WPBakeryShortCode {
     
    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'vc_image_with_link_mapping' ),12 );
        add_shortcode( 'vc_call_image_with_link', array( $this, 'vc_call_image_with_link_html' ) );
    }
     
    // Element Mapping
    public function vc_image_with_link_mapping() {
         
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
                return;
        }
             
        // Map the block with vc_map()
        vc_map( 
            array(
                'name' => __('Image mit Link', 'text-domain'),
                'base' => 'vc_call_image_with_link',
                'description' => __('', 'text-domain'), 
                'category' => __('Custom Elements', 'text-domain'),   
                'icon' => get_template_directory_uri().'/library/images/vc_icons/element-icon-image-with-link.svg',
                 'params' => array(

                   array(
                    'type' => 'attach_image',
                    'heading' => __( 'Fallback Image', 'js_composer' ),
                    'param_name' => 'vc_image',
                    'admin_label' => false,
                    'description' => __( '', 'js_composer' ),
                    'group' => 'General',
                  ), 

                  array(
                        "type" => "dropdown",
                        "heading" => __("Hintergrundfarbe Link", 'text-domain') ,
                        "param_name" => "vc_link_style",
                        'group' => 'General',
                        "value" => array(
                            "Bitte Auswählen" => "bitte Auswählen",
                            "Grün" => "green",
                            "Grau" => "gray"
                            
                            ) ,
                            "description" => __("", 'text-domain')

                    ), 
                  
                   array(
                    'type' => 'vc_link',
                    'heading' => __( 'Link', 'js_composer' ),
                    'param_name' => 'image_link',
                    'admin_label' => false,
                    'description' => __( '', 'js_composer' ),
                    'group' => 'General',
                  ), // end params 
                )
            )            
        );                        
    }
        
// Element HTML
public function vc_call_image_with_link_html( $atts ) {

    $atts = vc_map_get_attributes('vc_call_image_with_link', $atts);
    extract($atts);

    $link = vc_build_link( $image_link );


    $image = wp_get_attachment_url( $atts['vc_image'] );

        $output = '<div class="image_with_link_wrapper">
       
            <img src="'. $image . '" >';
    if($link){
  $output .='<a href="'.esc_url($link['url']).'" class="" target="'.$link['target'].'">'.$link['title'].'</a>';
    }        

    
     $output .=   '</div>';    
        
         
                  
    return $output;  
}
     
} // End Element Class
 
// Element Class Init
new vc_image_with_link(); 

?>