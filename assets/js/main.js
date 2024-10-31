/**
 * Product screenshot main js
 *
 * Handle all custom activation of the plugin.
 *
 * @since 1.0.0
 */
(function ($) {
    "use strict";   
    //$('.prscrt-popup-images').lightGallery(); 
    $('.prscrt-popup-images').lightGallery({
      selector:'.prscrt-active-item',
  })

    var initializeActive = function( $sec ) {
    var selectAttr = $($sec).data('secid');
    var selectorItem = selectAttr.sec_id;
    var showedItem = selectAttr.show_item;
    var loaded_item = selectAttr.load_item;
    var selectorItemd = '.'+selectorItem +' .prscrt-single-gallary-item';
    var loadItem = '.'+selectorItem+'.prscrt-loadMore';
    var sliceIteam = selectorItemd+":hidden";

    $(selectorItemd).slice(0, showedItem).show(800);
    $("."+selectorItem).addClass("prscrt-preloader-deactive");
    $(loadItem).addClass("loaded-btn");
    $(loadItem).on("click", function (e) {
        e.preventDefault();
        $(loadItem).addClass("button--loading");
        $(sliceIteam).slice(0, loaded_item).slideDown(500);
        if ($(sliceIteam).length == 0) {
          $(loadItem).addClass("noContent");
        }
        $(loadItem).removeClass("button--loading");
    });
  }

  $(document).ready(function(){
    $(".prscrt-gallary-page-area").each(function(){
      initializeActive($(this));
    });
});
var ElementorForntendActivation = function(){
  $(".prscrt-gallary-page-area").each(function(){
       initializeActive($(this));
     });
};

$(window).on('elementor/frontend/init', function () {
 elementorFrontend.hooks.addAction( 'frontend/element_ready/widget', ElementorForntendActivation );
});

})(jQuery);

