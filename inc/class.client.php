<?php
class myTinyMceButtonModal_Client {
    
    function cdn_jquery_scripts()
    {
        global $wp_scripts;
        wp_enqueue_script( 'jquery' ); // on ajoute le script
        $jq_version_from_wp = "1.7.2"; // on lit la version
        $https = is_ssl() ? 's' : ''; // on vérifie si SSL est activé
        $jq_url_from_cdn = 'http'.$https.'://ajax.googleapis.com/ajax/libs/jquery/' . $jq_version_from_wp . '/jquery.min.js'; // on crée l'url du CDN
        $response = wp_remote_get( $jq_url_from_cdn ); // on fait une requête HTTP vers le fichier
        if( !is_wp_error( $response ) && $response['response']['code'] != 404 ) { // si il n'est ni en erreur ni une 404 ...
            wp_register_script( 'jquery', $jq_url_from_cdn, '', $jq_version_from_wp, true ); // on le "register" et on l'ajoute de nouveau (en footer grâce au "true")
            wp_deregister_script( 'jquery' ); // on retire le script
        }
    }

    function __construct() {
        if( !is_admin() ){
            add_action( 'wp_enqueue_scripts', 'cdn_jquery_scripts' ); 

            wp_register_style(
                "style_box",
                plugins_url( "ressources/css/style_modal.css", __FILE__ ),
                false,
                0.1
            );
            wp_enqueue_style( "style_box" );

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
?>
