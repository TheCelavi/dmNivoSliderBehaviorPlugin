<?php
/*
 * @author TheCelavi
 */
class dmNivoSliderBehaviorView extends dmBehaviorBaseView {
    
    public function configure() {
        
    }

    public function filterBehaviorVars(array $vars = array()) {
        $vars = parent::filterBehaviorVars($vars);
        if (isset($vars['startSlide'])) $vars['startSlide'] = $vars['startSlide'] - 1;
        (isset($vars['captionOpacity'])) ? $vars['captionOpacity'] = round($vars['captionOpacity'] / 100, 2) : $vars['captionOpacity'] = 0.80;
        return $vars; 
    }

    public function getJavascripts() {
        return array(
            'dmNivoSliderBehaviorPlugin.nivo',
            'dmNivoSliderBehaviorPlugin.launch'
        );
    }
    
    public function getStylesheets() {
        $vars = $this->getBehaviorVars();
        return array(
            'dmNivoSliderBehaviorPlugin.nivo',
            'dmNivoSliderBehaviorPlugin.' . $vars['theme']
        );
    }
}


