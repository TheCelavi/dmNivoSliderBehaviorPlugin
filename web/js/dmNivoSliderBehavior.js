(function($) {    
    
    var methods = {        
        init: function(behavior) {                       
            var $this = $(this), data = $this.data('dmNivoSliderBehavior');
            if (data && behavior.dm_behavior_id != data.dm_behavior_id) { // There is attached the same, so we must report it
                alert('You can not attach Nivo Slider to same content'); // TODO TheCelavi - adminsitration mechanizm for this? Reporting error
            };
            $this.data('dmNivoSliderBehavior', behavior);
        },
        
        start: function(behavior) {  
            var $this = $(this);
            var $copy = $this.children().clone(true, true);
            $this.data('dmNivoSliderBehaviorPreviousDOM', $this.children().detach());            
            $this.children().remove();
            if (behavior.use_image_alt_attr) {
                $.each($('img',$copy), function(){
                    $(this).attr('title', $(this).attr('alt'));
                });
            };
            // Now we have to figure out what is the content
            // Content can be:
            // Case 1: $copy > DIV > A or $copy > DIV > IMG => we have to remove DIV (it is inside of widgets)
            // Case 2: $copy > A or $copy > IMG (this is good, just call NivoSlide
            
            if ($copy.length == $copy.filter('div').length) {
                $copy = $copy.find('.dm_widget_inner').children();
            };
            
            $this.append($('<div class="dmNivoSliderBehavior"></div>').append($copy));
            $this.addClass('nivo-theme-' + behavior.theme);
            $this.find('.dmNivoSliderBehavior').nivoSlider(behavior);
        },
        stop: function(behavior) {
            var $this = $(this);
            $this.children().remove();
            $this.removeClass('nivo-theme-' + behavior.theme);
            $this.append($this.data('dmNivoSliderBehaviorPreviousDOM'));        
        },
        destroy: function(behavior) {            
            var $this = $(this);
            $this.data('dmNivoSliderBehavior', null);
            $this.data('dmNivoSliderBehaviorPreviousDOM', null)
        }
    }
    
    $.fn.dmNivoSliderBehavior = function(method, behavior){
        
        return this.each(function() {
            if ( methods[method] ) {
                return methods[ method ].apply( this, [behavior]);
            } else if ( typeof method === 'object' || ! method ) {
                return methods.init.apply( this, [method] );
            } else {
                $.error( 'Method ' +  method + ' does not exist on jQuery.dmNivoSliderBehavior' );
            };  
        });
    };

    $.extend($.dm.behaviors, {        
        dmNivoSliderBehavior: {
            init: function(behavior) {
                $($.dm.behaviorsManager.getCssXPath(behavior, true) + ' ' + behavior.inner_target).dmNivoSliderBehavior('init', behavior);
            },
            start: function(behavior) {
                $($.dm.behaviorsManager.getCssXPath(behavior, true) + ' ' + behavior.inner_target).dmNivoSliderBehavior('start', behavior);
            },
            stop: function(behavior) {
                $($.dm.behaviorsManager.getCssXPath(behavior, true) + ' ' + behavior.inner_target).dmNivoSliderBehavior('stop', behavior);
            },
            destroy: function(behavior) {
                $($.dm.behaviorsManager.getCssXPath(behavior, true) + ' ' + behavior.inner_target).dmNivoSliderBehavior('destroy', behavior);
            }
        }
    });
    
})(jQuery);