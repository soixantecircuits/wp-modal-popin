<?php
class myTinyMceButtonModal_Client {
    
    function box_style(){
        wp_register_style(
                "style_box",
                plugins_url( "ressources/css/style_modal.css", __FILE__ ),
                false,
                0.1
            );
            wp_enqueue_style( "style_box" );
    }

    function external_script(){
        wp_enqueue_script(
                "jquery.leanModal.min.js",
                plugins_url( "ressources/jquery.leanModal.min.js", __FILE__ ),
                array('jquery'), true, true
            );

            wp_enqueue_script(
                "leanModalapp.js",
                plugins_url( "ressources/leanModalapp.js", __FILE__ ),
                array('jquery'), true, true
            );
    }

    function __construct() {
        if( !is_admin() ){
            add_action( 'wp_enqueue_scripts', array($this, 'box_style' ) );
            add_action( 'wp_enqueue_scripts', array($this, 'external_script') );

            
        }
        add_shortcode( 'modal', array( &$this, 'modal_shortcode' ));
    }

    function modal_shortcode( $attr, $content = null ) {
        extract(shortcode_atts(array(  
        "title" => __("Window","mytmodal")
        ,"name" => __("Default name","mytmodal")
        ,"width_value"=> "850"
        ,"width_unity"=> "px"
        ,"height_value"=> "100"
        ,"height_unity"=>"%"
        ,"class"=> "default"
        ,'id' => 'default'
        ), $attr)); 
        if (empty($width_value)||$width_value==""){
            $width_value=850;
            $width_unity="px";
        }
        if (empty($height_value)||$height_value==""){
            $height_value=100;
            $height_unity="%";
        }
        $nbr_modal_window_id = uniqid (rand(), false);
        return '<a id = "'.esc_attr($id).'" href="#frame'.$nbr_modal_window_id.'" class="'.esc_attr($class).' a-btn modal-btn" rel="leanModal">'.esc_attr($name).'</a><div id="frame'.$nbr_modal_window_id.'" class="modal" data-widthunity="'.esc_attr($width_unity).'" data-widthvalue="'.esc_attr($width_value).'" data-heightunity="'.esc_attr($height_unity).'" data-heightvalue="'.esc_attr($height_value).'"><div class="signup-header"><h2>'.esc_attr($title).'</h2><a class="modal_close" href="#"></a></div>'. do_shortcode($content) .'</div>';
    }

}