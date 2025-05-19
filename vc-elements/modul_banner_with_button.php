<?php 
 
// Element Class 
class vc_zweigrad_banner_with_button extends WPBakeryShortCode {
     
    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'vc_zweigrad_banner_with_button_mapping' ),12 );
        add_shortcode( 'vc_call_zweigrad_banner_with_button', array( $this, 'vc_call_zweigrad_banner_with_button_html' ) );
    }
     
    // Element Mapping
    public function vc_zweigrad_banner_with_button_mapping() {
         
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
                return;
        }
             
        // Map the block with vc_map()
        vc_map( 
            array(
                'name' => __('Banner with Button', 'text-domain'),
                'base' => 'vc_call_zweigrad_banner_with_button',
                'description' => __('Banner with Button', 'text-domain'), 
                'category' => __('Custom Elements', 'text-domain'),   
                'icon' => get_template_directory_uri().'/library/images/vc_icons/element-icon-banner.svg',
                 'params' => array(

                      array(
                    'type' => 'textfield',
                    'heading' => __( 'Text', 'js_composer' ),
                    'param_name' => 'vc_banner_text',
                    'description' => __( '', 'js_composer' ),
                    'admin_label' => true,
                    'group' => 'General',
                  ),

                     array(
                    'type' => 'vc_link',
                    'heading' => __( 'Link', 'js_composer' ),
                    'param_name' => 'image_link',
                    'admin_label' => false,
                    'description' => __( '', 'js_composer' ),
                    'group' => 'General',
                     ),

                     array(
                        "type" => "dropdown",
                        "heading" => __("Banner Farbe", 'text-domain') ,
                        "param_name" => "vc_banner_style",
                        'group' => 'General',
                        "value" => array(
                            "Bitte Auswählen" => "bitte Auswählen",
                            "Grün" => "banner_green",
                            "Weiß" => "banner_white",
                            "Grau" => "banner_gray"
                            
                            ) ,
                            "description" => __("", 'text-domain')

                    ), // end params            
              )
            )
        );                                       
    }
        
// Element HTML
public function vc_call_zweigrad_banner_with_button_html( $atts ) {

    $atts = vc_map_get_attributes('vc_call_zweigrad_banner_with_button', $atts);
    extract($atts);

    $link = vc_build_link( $image_link );

     if($vc_banner_text){
    $banner_class = 'banner_with_text';
    }

    $output = '<section class="zweigrad_banner plain_colored_section '.$vc_banner_style.' '.$banner_class.'">';

    if($vc_banner_text){
    $output .= '<h2>'.$vc_banner_text.'</h2>';
    }

    $output .= '  <a href="'.esc_url($link['url']).'" class="button '. $vc_link_style .'" target="'.$link['target'].'">'.$link['title'].'</a>';   
    
    $output .= '</section>';
                  
    return $output;  
}
     
} // End Element Class
 
// Element Class Init
new vc_zweigrad_banner_with_button(); 

?>