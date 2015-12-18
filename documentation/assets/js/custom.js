$(function() {

    var hash = window.location.hash.substr(1)
    var available_partials = ['change_log', 'faq', 'credits', 'feature', 'configure_locations', 'configure_categories', 'configure_app_settings', 'paypal_settings', 'banner_settings', 'social_settings','configure_email','storage_settings','stripe_settings']
    var loadPartial = function(hash, callback) {
        var scallback = callback || $.noop()
        if(available_partials.indexOf(hash) > -1) {
            $('#partialContent').load('./partials/_' + hash+ '.html', scallback);
        }
    }

    if(hash) {
        console.dir(hash)
        loadPartial(hash)
    }

    $('a.partial').on('click', function(e){
        e.preventDefault();
        var link = $(this);
        var template_name = link.data('template');

        if(template_name) {
            loadPartial(template_name, function(){
                $('a').removeClass('active');
                link.addClass('active');
            })
        }
    })


});