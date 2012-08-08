(function($){
  $(function() {
    try {
      $("a[rel*=leanModal]").leanModal({ top : 30, overlay : 0.5, closeButton: ".modal_close" });
    } catch (e) {
    }
  });
})(jQuery);