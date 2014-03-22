/*!
 * Responsive JS Plugins v1.1.0
 */
// Placeholder
jQuery(function (){
    jQuery('input[placeholder], textarea[placeholder]').placeholder();
});
// FitVids
jQuery(function (){
// Target your .container, .wrapper, .post, etc.
    jQuery("#wrapper").fitVids();
});

// Have a custom video player? We now have a customSelector option where you can add your own specific video vendor selector (mileage may vary depending on vendor and fluidity of player):
// jQuery("#thing-with-videos").fitVids({ customSelector: "iframe[src^='http://example.com'], iframe[src^='http://example.org']"});
// Selectors are comma separated, just like CSS
// Note: This will be the quickest way to add your own custom vendor as well as test your player's compatibility with FitVids.

(function ($){
    $.fn.jQualize = function(options) {
        options =  $.extend({
            'children' : false
        }, options );
        var tallest = 0,
            $elements = (options.children) ? $(this).children() : $(this);
        return this.each(function() {
            $elements.each(function(i) {
                var $element = $(this);
                tallest = ($element.height() > tallest) ? $element.height() : tallest;
            }).height(tallest);
        });
    };
    $.fn.cycle = function (options){
        options =  $.extend({
            'speed' : 4000
        }, options);
        return this.each(function (){
            var $darthFader = $(this),
                rotate;

            function getFirst(){
                return $darthFader.find('>:first');
            }
            function fadeNext() {
                getFirst().fadeOut("fast", function (){
                    $(this).appendTo($darthFader);
                    getFirst().fadeIn(options.speed/2);
                });
            }
            $darthFader.addClass('slider').find('>:not(:first)').hide();
            rotate = setInterval(fadeNext, options.speed);
        });
    };
}(jQuery));
jQuery(".slideshow").jQualize({"children":true}).cycle();