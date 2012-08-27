(function() {
    var called = false;
    tinymce.create('tinymce.plugins.mybutton', {
        init : function(ed, url) {
            ed.addButton('mybutton', {
                title : 'Box',
                image : url + '/images/mybutton.png',
                cmd : 'mceMyButtonInsert',
            });

            ed.addCommand('mceMyButtonInsert', function(ui, v) {
                tb_show('Modal Box', ajaxurl + '?height=650&width="96%"&action=mybutton_shortcodePrinter');
                if(called == false) {
                    called = true;
                    jQuery('#mytmodal_button').live("click", function(e) {
                        e.preventDefault();
                        tinyMCE.triggerSave();

                        ed.execCommand('mceInsertContent', 0, mybutton_create_shortcode());

                        tb_remove();

                    });
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('mybutton', tinymce.plugins.mybutton);
})();

function mybutton_create_shortcode() {
    var name = nl2br(jQuery('#mytmodal_name').val(),false);
    var title = nl2br(jQuery('#mytmodal_title').val(),false);
    var content = nl2br(jQuery('#mytmodal_text').val(),false);
    var width_value = nl2br(jQuery('#mytmodal_width_value').val(),false);
    var class_ = nl2br(jQuery('#mytmodal_class').val(),false);
    //if width value is empty;
    if (typeof width_value=="undefined" || width_value==""){width_value=850;}
    var width_unity = nl2br(jQuery('#mytmodal_width_unity').val(),false);
    var height_value = nl2br(jQuery('#mytmodal_height_value').val(),false);
    var height_unity = nl2br(jQuery('#mytmodal_height_unity').val(),false);
    if (typeof height_value=="undefined" || height_value==""){height_value=100;height_unity="%"}
    return '[modal name="'+name+'" class="'+class_+'" title="'+title+'" width_value="'+width_value+'" width_unity="'+width_unity+'" height_value="'+height_value+'" height_unity="'+height_unity+'"]'+content+'[/modal]';
}

function nl2br (str, is_xhtml) {   
    var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';    
    return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1'+ breakTag +'$2');
}