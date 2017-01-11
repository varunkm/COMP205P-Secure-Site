var searchVisible = 0;
var transparent = true;

var transparentDemo = true;
var fixedTop = false;

var navbar_initialized = false;

$(document).ready(function(){
    window_width = $(window).width();

    if($('.datepicker').length != 0){
        $('.datepicker').datepicker({
             weekStart:1,
             color: '{color}'
         });
    }

    // Init popovers
    gsdk.initPopovers();

});

gsdk = {
    misc:{
        navbar_menu_visible: 0
    },

    initPopovers: function(){
        if($('[data-toggle="popover"]').length != 0){
            $('body').append('<div class="popover-filter"></div>');

            //    Activate Popovers
           $('[data-toggle="popover"]').popover().on('show.bs.popover', function () {
                $('.popover-filter').click(function(){
                    $(this).removeClass('in');
                    $('[data-toggle="popover"]').popover('hide');
                });
                $('.popover-filter').addClass('in');
            }).on('hide.bs.popover', function(){
                $('.popover-filter').removeClass('in');
            });

        }
    },
}

$('button[id="rowDelete"]').click(function(e){
   $(this).closest('tr').remove()
})