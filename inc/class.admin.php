<?php
class myTinyMceButtonModal_Admin{

    function __construct() {
        // init process for button control
        add_action( 'admin_init', array (&$this, 'addButtons' ) );
        add_action( 'wp_ajax_mybutton_shortcodePrinter', array( &$this, 'wp_ajax_fct' ) );
    }
    
    /*
    * The content of the javascript popin for the insertion
    *
    */
    function wp_ajax_fct(){
        ?>
        <h2><?php _e("Modal Box", 'mytmodal');?></h2>
        <p>
            <?php _e("You can put any kind of content. Please use short code iframe to embed iframe.","mytmodal");?>
            <br>
            <?php _e('ex: [iframe src="http://player.vimeo.com/video/3261363" width="100%" height="620"]', 'mytmodal');?>
            <br><br>
            <?php _e("Please enter the name of the button link: ", 'mytmodal');?><br>
            <input style="width: 100%;" type="text" name="mytmodal_name" id="mytmodal_name" value="<?php _e('a button name','mytmodal');?>"/><br>
            <?php _e("Please enter the title of the window: ", 'mytmodal');?><br>
            <input style="width: 100%;" type="text" name="mytmodal_title" id="mytmodal_title" value="<?php _e('a title','mytmodal');?>"/><br>
            <?php _e("Please enter the width of the window: ", 'mytmodal');?><br>
            <input style="width: 20%;" type="text" name="mytmodal_width_value" id="mytmodal_width_value" value=""/>
            <select name="mytmodal_width_unity" id="mytmodal_width_unity">
                <option value="px" selected>px</option>
                <option value="%">%</option>
            </select><br/>
            <?php _e("Please enter the height of the window: ", 'mytmodal');?><br>
            <input style="width: 20%;" type="text" name="mytmodal_height_value" id="mytmodal_height_value" value=""/>
            <select name="mytmodal_height_unity" id="mytmodal_height_unity">
                <option value="px" selected>px</option>
                <option value="%">%</option>
            </select><br/>
            <?php _e("Please enter a class you want to use to skin the button: ", 'mytmodal');?><br>
            <input style="width: 20%;" type="text" name="mytmodal_class" id="mytmodal_class" value=""/>
            <br>
            <?php _e("Please enter the text that should fit in a modal box: ", 'mytmodal');?><br />
            <textarea name="mytmodal_text" id="mytmodal_text" height="40" row="10" value="<?php _e('make some magic','mytmodal');?>"></textarea>
        </p>
        <script type="text/javascript" src="<?php echo MTMCE_URL. 'inc/ressources/mytmodal_script.js'; ?>"></script>  
        <p class="description">
            <?php esc_html_e("The text you enter will be diplayed in a modal window", 'mytmodal');?>
        </p>
        <input name="mytmodal_button" id="mytmodal_button" type="submit" class="button-primary" value="<?php _e("Insert the box", 'mytmodal');?>">

        <?php die();
    }

   
    /*
    * Add buttons to the tiymce bar
    */
    function addButtons() {
        // Don't bother doing this stuff if the current user lacks permissions
        if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
            return false;
    
        if ( get_user_option('rich_editing') == 'true') {
            add_filter('mce_external_plugins', array (&$this,'addScriptTinymce' ) );
            add_filter('mce_buttons', array (&$this,'registerTheButton' ) );
        }
    }

    /*
    * Add buttons to the tiymce bar
    *
    */
    function registerTheButton($buttons) {
        array_push($buttons, "|", "mybutton");
        return $buttons;
    }

    /*
    * Load the custom js for the tinymce button
    *

    */
    function addScriptTinymce($plugin_array) {
        $plugin_array['mybutton'] = MTMCE_URL. 'inc/ressources/tinymce.js';
        return $plugin_array;
    }

}
?>