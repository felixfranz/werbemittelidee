<?php 
 
// Element Class 
class vc_page_header extends WPBakeryShortCode {
     
    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'vc_page_header_mapping' ),12 );
        add_shortcode( 'vc_call_page_header', array( $this, 'vc_call_page_header_html' ) );
    }
     
    // Element Mapping
    public function vc_page_header_mapping() {
         
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
                return;
        }
             
        // Map the block with vc_map()
        vc_map( 
            array(
                'name' => __('Page Header', 'text-domain'),
                'base' => 'vc_call_page_header',
                'description' => __('Display Page Header', 'text-domain'), 
                'category' => __('Custom Elements', 'text-domain'),   
                'icon' => get_template_directory_uri().'/library/images/icons/vc-icon-header.png',
                 'params' => array(
                  
                  /// LAYOUT
                  array(
                    "type" => "dropdown",
                    "heading" => __("Header Style", 'text-domain') ,
                    "param_name" => "vc_header_style",
                    'group' => 'General',
                    "value" => array(
                        "Regular" => "regular",
                        "Minimal" => "minimal",
                        "Foto" => "image",

                        ) ,
                       "description" => '',
                    ),

                    array(
                    'type' => 'attach_image',
                    'heading' => __( 'Image', 'js_composer' ),
                    'param_name' => 'vc_header_image',
                    "dependency" => array(
                      "element" => "vc_header_style",
                      "value" => array("image")
                    ),
                   "description" => '',
                    'group' => 'General',
                  ),

                   array(
                  "type" => "dropdown",
                    "heading" => __("Image Style", 'text-domain') ,
                    "param_name" => "vc_image_style",
                    'group' => 'General',
                    "dependency" => array(
                      "element" => "vc_header_style",
                      "value" => array("image")
                    ),
                    "value" => array(
                        "Dunkles Bild" => "dark_image",
                        "Helles Bild" => "light_image",
                        ) ,
                        "description" => '',
                    ),

                  /// TEXT 
                  array(
                    'type' => 'textfield',
                    'heading' => __( 'Bild abdunklen?', 'js_composer' ),
                    'param_name' => 'darken_image',
                    'value' => '0',
                     "dependency" => array(
                      "element" => "vc_header_style",
                      "value" => array("image")
                    ),
                    'description' => __( 'Prozent, umd die das Bild abgedunkelt werden soll damit Schrift besser lesbar ist. 0 (nichts machen) - 100 (komplett schwarz)', 'js_composer' ),
                    'group' => 'General',
                  ),


                  /// TEXT 
                  array(
                    'type' => 'textfield',
                    'heading' => __( 'Page Headline', 'js_composer' ),
                    'param_name' => 'vc_page_headline',
                    'admin_label' => true,
                    'description' => __( '', 'js_composer' ),
                    'group' => 'Text',
                  ),

                    array(
                    "type" => "dropdown",
                    "heading" => __("Headline Style", 'text-domain') ,
                    "param_name" => "vc_headline_style",
                    'group' => 'Text',
                    "value" => array(
                        "Bitte Auswählen" => "bitte Auswählen",
                        "Big" => "big",
                        "Medium" => "medium",
                        "Small" => "small"
                       ) ,
                    "dependency" => array(
                        "element" => "vc_page_headline",
                        "not_empty" => true
                      ),
                        "description" => __("", 'text-domain')
                    ),


                  array(
                    'type' => 'textarea',
                    'heading' => __( 'Page Subline', 'js_composer' ),
                    'param_name' => 'vc_page_subline',
                    'admin_label' => true,
                    'description' => __( 'Text unter der Headline', 'js_composer' ),
                    'group' => 'Text',
                  ),

                  array(
                    'type' => 'vc_link',
                    'heading' => __( 'Button 1', 'js_composer' ),
                    'param_name' => 'header_link_1',
                    'admin_label' => false,
                    'description' => __( '', 'js_composer' ),
                    'group' => 'Buttons',
                     ),
                     
                     array(
                        "type" => "dropdown",
                        "heading" => __("Button Style 1", 'text-domain') ,
                        "param_name" => "vc_button_style_1",
                        'group' => 'Buttons',
                        "value" => array(
                            "Bitte Auswählen" => "btn_outline",
                            "Regular" => "btn_outline",
                            "Solide" => "btn_solid"
                            
                            ) ,
                            "description" => __("", 'text-domain')

                    ), // end params    

                    array(
                    'type' => 'vc_link',
                    'heading' => __( 'Button 2', 'js_composer' ),
                    'param_name' => 'header_link_2',
                    'admin_label' => false,
                    'description' => __( '', 'js_composer' ),
                    'group' => 'Buttons',
                     ),
                     
                     array(
                        "type" => "dropdown",
                        "heading" => __("Button Style 2", 'text-domain') ,
                        "param_name" => "vc_button_style_2",
                        'group' => 'Buttons',
                        "value" => array(
                            "Bitte Auswählen" => "btn_outline",
                            "Regular" => "btn_outline",
                            "Solide" => "btn_solid"
                            
                            ) ,
                            "description" => __("", 'text-domain')

                    ), // end params    
           
              )
            )
        );                                       
    }
        
// Element HTML
public function vc_call_page_header_html( $atts ) {

    $atts = vc_map_get_attributes('vc_call_page_header', $atts);
    extract($atts);

     $link_1 = vc_build_link( $header_link_1 );
     $link_2 = vc_build_link( $header_link_2 );


   $image =  wp_get_attachment_url($vc_header_image);

   $header_style ='';

   if($image != ''){
    $header_style = "image_header";
   }

   $opacity = (100 - $darken_image)/100; 

     
        $html = '<div class="page_header '. $vc_header_style .' '. $vc_image_style .' ">';

 if($image != ''){
   $html .= '<div class="image_container">
                <img src="'.$image.'" style="opacity:'.$opacity.';">
            </div>';
   }

           $html .=        '<div class="inner_page_header inner_wrapper">

                          <div class="header_text_container">';

                          if($vc_page_subline != ''){
                                $html .= '<h3 class="header_text_subline pre_heading">'. $vc_page_subline .'</h3>';
                            }   
                          

            $html .=   '<h1 class="header_text '. $vc_headline_style .' ">'. $vc_page_headline .' </h1>';

                             

        $html .= '</div>'; // end inner text container 
        $html .= '</div>'; // end inner header
        $html .= '</div>'; // end page header             
                  
    return $html;  
}
     
} // End Element Class
 
// Element Class Init
new vc_page_header(); 

?>