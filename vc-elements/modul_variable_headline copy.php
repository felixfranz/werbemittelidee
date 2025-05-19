<?php 
 
// Element Class 
class vc_variable_headline extends WPBakeryShortCode {
     
    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'vc_variable_headline_mapping' ),12 );
        add_shortcode( 'vc_call_variable_headline', array( $this, 'vc_call_variable_headline_html' ) );
    }
     
    // Element Mapping
    public function vc_variable_headline_mapping() {
         
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
                return;
        }
             
        // Map the block with vc_map()
        vc_map( 
                 array(
                'name' => __('Variable Headline', 'text-domain'),
                'base' => 'vc_call_variable_headline',
                'description' => __('Display Headline', 'text-domain'), 
                'category' => __('Custom Elements', 'text-domain'),   
                'icon' => get_template_directory_uri().'/library/images/vc_icons/element-icon-headline-colored.svg',
                 'params' => array(

                  array(
                    'type' => 'textarea',
                    'heading' => __( 'Text', 'js_composer' ),
                    'param_name' => 'vc_headline_text',
                    'description' => __( '', 'js_composer' ),
                    'admin_label' => true,
                    'group' => 'General',
                  ),

                    array(
                        "type" => "dropdown",
                        "heading" => __("Größe", 'text-domain') ,
                        "param_name" => "vc_headline_size",
                        'group' => 'General',
                        'admin_label' => false,
                        "value" => array(
                            "Bitte Auswählen" => "bitte Auswählen",
                            "Klein" => "small",
                            "Medium" => "medium",
                            "Groß" => "big"
                            ) ,
                            "description" => __("", 'text-domain')

                    ), 
                    
                        array(
                        'type' => 'checkbox',
                        'heading' => __( 'Subnavi Section Headline', 'js_composer' ),
                        'param_name' => 'is_section',
                        'value' => array('Yes' => true ),
                        'description' => __( 'Will this headline be part of a section for the Subnavigation.', 'js_composer' ),
                        'group' => 'General',
                    ),

                     array(
                    'type' => 'textfield',
                    'heading' => __( 'Text', 'js_composer' ),
                    'param_name' => 'vc_subnavi_headline_text',
                    'description' => __( '', 'js_composer' ),
                     "dependency" => array(
                        "element" => "is_section",
                        "not_empty" => true
                      ),
                    'admin_label' => false,
                    'group' => 'General',
                  ),

                   array(
                    'type' => 'textfield',
                    'heading' => __( 'Section ID', 'js_composer' ),
                    'param_name' => 'vc_subnavi_section_id',
                    'description' => __( 'ID used for Subnavi. For example: regular_infos', 'js_composer' ),
                     "dependency" => array(
                        "element" => "is_section",
                        "not_empty" => true
                      ),
                    'admin_label' => false,
                    'group' => 'General',
                  ),
              )
            )
        );                                       
    }
        
// Element HTML
public function vc_call_variable_headline_html( $atts ) {

    $atts = vc_map_get_attributes('vc_call_variable_headline', $atts);
    extract($atts);
    //baseline
    $header_size = "h2";

    $section_class="";

    if($vc_subnavi_headline_text != ''){
        $section_class = "section_headline";
    }

    

    if($vc_headline_size == "small"){
        $header_size = "h4";
    }
     if($vc_headline_size == "medium"){
        $header_size = "h3";
    }
     if($vc_headline_size == "big"){
        $header_size = "h2";
    }
   
        $output = '<'.$header_size.' class="variable_headline '.$section_class.'" data-section_title="'.$vc_subnavi_headline_text.'" data-section_id="'.$vc_subnavi_section_id.'" id="'.$vc_subnavi_section_id.'"><span>'. $vc_headline_text .'</span></'.$header_size.'>';              
                  
    return $output;  
}
     
} // End Element Class
 
// Element Class Init
new vc_variable_headline(); 

?>