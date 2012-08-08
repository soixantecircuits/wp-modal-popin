//TinyMCE
    jQuery.fn.tinymce_textareas = function(){
        tinyMCE.execCommand("mceAddControl", false, 'mytmodal_text');
    };
    function sample(){
        tinyMCE.execCommand('mceRemoveControl', false, 'mytmodal_text');
        jQuery("#mytmodal_text").tinymce_textareas();
    }
    setTimeout(sample,500);

//control width Entry
    jQuery("#mytmodal_width_value").keyup( function() { mytmodalControlNum(jQuery(this)); });
    var mytmodalOldNum=jQuery("#mytmodal_width_value").val();
    function mytmodalControlNum(elem){
        var newNum= elem.val();
        if (mytmodalCheckNumero(newNum)){
            mytmodalOldNum=newNum;
        }
        else {
            elem.val(mytmodalOldNum);
        }
    }
    function mytmodalCheckNumero(numero) {
        return ((!isNaN(numero)&&parseFloat(numero)==numero)||(numero==""));
    }      