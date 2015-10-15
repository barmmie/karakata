// Allow for console.log to not break IE
if (typeof window.console == "undefined" || typeof window.console.log == "undefined") {
    window.console = {
        log: function () {
        },
        info: function () {
        },
        warn: function () {
        }
    };

}
;


// attach ready event
$(document)
    .ready(function () {

        var
            $tocSticky = $('.toc .ui.sticky'),
            $fullHeightContainer = $('.pusher > .full.height'),
            $menu = $('#toc');

        $menu
            .sidebar({
                dimPage: true,
                transition: 'overlay',
                mobileTransition: 'uncover'
            })
        ;

        $tocSticky
            .sticky({
                context: '#dash'
            })
        ;

        // launch buttons
        $menu
            .sidebar('attach events', '.launch.button, .view-ui, .launch.item')
        ;


    });

