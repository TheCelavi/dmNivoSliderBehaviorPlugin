<?php

/*
 * @author TheCelavi
 */
class dmNivoSliderBehaviorForm extends dmBehaviorBaseForm {
    
    protected $effect = array(
        'random' => 'Random',
        'sliceDown' => 'Slice down',
        'sliceDownLeft' => 'Slice down-left',
        'sliceUp' => 'Slice up',
        'sliceUpLeft' => 'Slice up-left',
        'sliceUpDown' => 'Slice up-down',
        'sliceUpDownLeft' => 'Slice up-down-left',
        'fold' => 'Fold',
        'fade' => 'Fade',
        'slideInRight' => 'Slide in-right',
        'slideInLeft' => 'Slide in-left',
        'boxRandom' => 'Box random',
        'boxRain' => 'Box rain',
        'boxRainReverse' => 'Box rain reverse',
        'boxRainGrow' => 'Box rain grow',
        'boxRainGrowReverse' => 'Box rain grow reverse'
    );
    
    protected $theme = array(
        'default' => 'Default'
    );


    public function configure() {
        
        $this->widgetSchema['inner_target'] = new sfWidgetFormInputText();
        $this->validatorSchema['inner_target'] = new sfValidatorString(array(
            'required' => false
        ));
        
        $this->widgetSchema['theme'] = new sfWidgetFormChoice(array(
            'choices' => $this->getI18n()->translateArray($this->theme)
        ));
        $this->validatorSchema['theme'] = new sfValidatorChoice(array(
            'choices' => array_keys($this->theme)
        ));
        
        $this->widgetSchema['effect'] = new sfWidgetFormChoice(array(
            'choices' => $this->getI18n()->translateArray($this->effect)
        ));
        $this->validatorSchema['effect'] = new sfValidatorChoice(array(
            'choices' => array_keys($this->effect)
        ));
        
        $this->widgetSchema['use_image_alt_attr'] = new sfWidgetFormInputCheckbox();
        $this->validatorSchema['use_image_alt_attr'] = new sfValidatorBoolean();
        
        $this->widgetSchema['slices'] = new sfWidgetFormInputText();
        $this->validatorSchema['slices'] = new sfValidatorInteger(array(
            'required' => true,
            'min' => 2
        ));
        
        $this->widgetSchema['boxCols'] = new sfWidgetFormInputText();
        $this->validatorSchema['boxCols'] = new sfValidatorInteger(array(
            'required' => true,
            'min' => 2
        ));
        
        $this->widgetSchema['boxRows'] = new sfWidgetFormInputText();
        $this->validatorSchema['boxRows'] = new sfValidatorInteger(array(
            'required' => true,
            'min' => 2
        ));
        
        $this->widgetSchema['animSpeed'] = new sfWidgetFormInputText();
        $this->validatorSchema['animSpeed'] = new sfValidatorInteger(array(
            'required' => true,
            'min' => 1
        ));
        
        $this->widgetSchema['pauseTime'] = new sfWidgetFormInputText();
        $this->validatorSchema['pauseTime'] = new sfValidatorInteger(array(
            'required' => true,
            'min' => 1
        ));
        
        $this->widgetSchema['randomStart'] = new sfWidgetFormInputCheckbox();
        $this->validatorSchema['randomStart'] = new sfValidatorBoolean();
        
        $this->widgetSchema['captionOpacity'] = new sfWidgetFormInputText();
        $this->validatorSchema['captionOpacity'] = new sfValidatorInteger(array(
            'required' => true,
            'min' => 0,
            'max' => 100
        ));
        
        $this->widgetSchema['directionNav'] = new sfWidgetFormInputCheckbox();
        $this->validatorSchema['directionNav'] = new sfValidatorBoolean();
        
        $this->widgetSchema['directionNavHide'] = new sfWidgetFormInputCheckbox();
        $this->validatorSchema['directionNavHide'] = new sfValidatorBoolean();
        
        $this->widgetSchema['controlNav'] = new sfWidgetFormInputCheckbox();
        $this->validatorSchema['controlNav'] = new sfValidatorBoolean();
        
        
        
        $this->widgetSchema['keyboardNav'] = new sfWidgetFormInputCheckbox();
        $this->validatorSchema['keyboardNav'] = new sfValidatorBoolean();
        
        $this->widgetSchema['pauseOnHover'] = new sfWidgetFormInputCheckbox();
        $this->validatorSchema['pauseOnHover'] = new sfValidatorBoolean();

        
        $this->getWidgetSchema()->setLabels(array(
            'use_image_alt_attr' => 'Use alt for caption',
            'slices' => 'Number of slices',
            'boxCols' => 'Box columns',
            'boxRows' => 'Box rows',
            'animSpeed' => 'Animation speed',
            'pauseTime' => 'Pause time',
            'randomStart' => 'Random start',
            'captionOpacity' => 'Captions opacity',
            'directionNav' => 'Use navigation',
            'directionNavHide' => 'Hide navigation on mouse out',
            'controlNav' => 'Navigation numbers',
            'keyboardNav' => 'Keyboard navigation',
            'pauseOnHover' => 'Pause on hover'
        ));
        
        $this->getWidgetSchema()->setHelps(array(
            'use_image_alt_attr' => 'If there is no TITLE attribuute, you can use ALT attribute for image caption',
            'slices' => 'Number of slices for slice animation',
            'boxCols' => 'Number of box columns for box animations',
            'boxCols' => 'Number of box columns for box animations',
            'boxRows' => 'Number of box rows for box animations',
            'animSpeed' => 'Animation speed in ms',
            'pauseTime' => 'Pause time between slides in ms',
            'randomStart' => 'Start with random image',
            'captionOpacity' => 'Opacity of captions in percents, set 0 for no captions',
            'controlNav' => 'Show navigation numbers'            
        ));
        
        if (is_null($this->getDefault('theme'))) $this->setDefault ('theme', 'default');
        if (is_null($this->getDefault('effect'))) $this->setDefault ('effect', 'random');
        if (is_null($this->getDefault('use_image_alt_attr'))) $this->setDefault ('use_image_alt_attr', true);
        if (is_null($this->getDefault('slices'))) $this->setDefault ('slices', 15);
        if (is_null($this->getDefault('boxCols'))) $this->setDefault ('boxCols', 8);
        if (is_null($this->getDefault('boxRows'))) $this->setDefault ('boxRows', 4);
        if (is_null($this->getDefault('animSpeed'))) $this->setDefault ('animSpeed', 500);
        if (is_null($this->getDefault('pauseTime'))) $this->setDefault ('pauseTime', 3000);
        if (is_null($this->getDefault('randomStart'))) $this->setDefault ('randomStart', false);
        if (is_null($this->getDefault('captionOpacity'))) $this->setDefault ('captionOpacity', 80);
        if (is_null($this->getDefault('directionNav'))) $this->setDefault ('directionNav', true);
        if (is_null($this->getDefault('directionNavHide'))) $this->setDefault ('directionNavHide', true);
        if (is_null($this->getDefault('controlNav'))) $this->setDefault ('controlNav', true);
        if (is_null($this->getDefault('keyboardNav'))) $this->setDefault ('keyboardNav', true);
        if (is_null($this->getDefault('pauseOnHover'))) $this->setDefault ('pauseOnHover', true);
        
        parent::configure();
    }
}

