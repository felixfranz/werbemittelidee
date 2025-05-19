<?php 
 
// Element Class 
class vc_wmi_cta extends WPBakeryShortCode {
     
    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'vc_wmi_cta_mapping' ),12 );
        add_shortcode( 'vc_call_wmi_cta', array( $this, 'vc_call_wmi_cta_html' ) );
    }
     
    // Element Mapping
    public function vc_wmi_cta_mapping() {
         
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
                return;
        }
             
        // Map the block with vc_map()
        vc_map( 
            array(
                'name' => __('CTA with Link', 'text-domain'),
                'base' => 'vc_call_wmi_cta',
                'description' => __('CTA with Link', 'text-domain'), 
                'category' => __('Custom Elements', 'text-domain'),   
                'icon' => get_template_directory_uri().'/library/images/vc_icons/element-icon-banner.svg',
                 'params' => array(

                    array(
                    'type' => 'textfield',
                    'heading' => __( 'Heading', 'js_composer' ),
                    'param_name' => 'vc_cta_heading',
                    'description' => __( '', 'js_composer' ),
                    'admin_label' => true,
                    'group' => 'General',
                  ),

                    array(
                    'type' => 'textfield',
                    'heading' => __( 'Pre-Heading', 'js_composer' ),
                    'param_name' => 'vc_cta_pre_heading',
                    'description' => __( '', 'js_composer' ),
                    'admin_label' => false,
                    'group' => 'General',
                  ),

                     array(
                    'type' => 'vc_link',
                    'heading' => __( 'Link', 'js_composer' ),
                    'param_name' => 'cta_link',
                    'admin_label' => false,
                    'description' => __( '', 'js_composer' ),
                    'group' => 'General',
                     ),

                     array(
                        "type" => "dropdown",
                        "heading" => __("CTA Farbe", 'text-domain') ,
                        "param_name" => "vc_cta_color",
                        'group' => 'General',
                        "value" => array(
                            "Bitte Auswählen" => "bitte Auswählen",
                            "Blau" => "cta_blue",
                            "Dunkel Blau" => "cta_dark_blue",
                            "Grau" => "cta_gray"
                            
                            ) ,
                            "description" => __("", 'text-domain')
                    ), 
                      array(
                        'type' => 'checkbox',
                        'heading' => __( 'With Image?', 'js_composer' ),
                        'param_name' => 'is_with_image',
                        'value' => array('Yes' => true ),
                        'description' => __( '', 'js_composer' ),
                        'group' => 'General',
                    ),

                     array(
                    'type' => 'attach_image',
                    'heading' => __( 'Image next to Block', 'js_composer' ),
                    'param_name' => 'vc_image',
                    'admin_label' => false,
                     "dependency" => array(
                        "element" => "is_with_image",
                        "not_empty" => true
                      ),
                    'description' => __( '', 'js_composer' ),
                    'group' => 'General',
                  ), 

                  array(
                        "type" => "dropdown",
                        "heading" => __("Reihenfolge", 'text-domain') ,
                        "param_name" => "order",
                        'group' => 'General',
                         "dependency" => array(
                        "element" => "is_with_image",
                        "not_empty" => true
                      ),
                        "value" => array(
                            "Bild Rechts" => "image_right",
                            "Bild Links" => "image_left"
                            ) ,
                            "description" => __("", 'text-domain')
                    ), 

     
                    
                    
                    // end params            
              )
            )
        );                                       
    }
        
// Element HTML
public function vc_call_wmi_cta_html( $atts ) {

    $atts = vc_map_get_attributes('vc_call_wmi_cta', $atts);
    extract($atts);

    $link = vc_build_link( $cta_link );

   

     $cta_class= '';

    if($vc_image){
       $image = wp_get_attachment_url( $atts['vc_image'] );
        $cta_class = 'cta_with_image';
    }

    $output = '<div class="wmi_cta '.$vc_cta_color.' '.$cta_class.'  '.$order.' ">';
    $output .= ' <a href="'.esc_url($link['url']).'" >';

    if($order == "image_right"){
      
    }

    if($vc_image){
        $output .= '<div class="type_container">';
    }

    if($vc_cta_pre_heading){
    $output .= '<h3 class="pre_heading">'.$vc_cta_pre_heading.'</h3>';
    }
    if($vc_cta_heading){
    $output .= '<h2>'.$vc_cta_heading.'</h2>';
    }

     if($vc_image){
        $output .= '</div>'; // end type container
    }

    if($vc_image){
        $output .= '<div class="cta_image_container"><img src="'. $image .'"></div>'; 
    }

   
    $output .='</a>';   
    
    $output .= '</div>';
                  
    return $output;  
}
     
} // End Element Class
 
// Element Class Init
new vc_wmi_cta(); 

?>