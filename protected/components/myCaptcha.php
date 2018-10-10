<?php
Yii::import('web.widgets.CCaptcha');

class myCaptcha extends CCaptcha{

    protected function renderImage()
    {
        if(!isset($this->imageOptions['id']))
            $this->imageOptions['id']=$this->getId();

        $url=$this->getController()->createUrl($this->captchaAction,array('v'=>uniqid()));
        $alt=isset($this->imageOptions['alt'])?$this->imageOptions['alt']:'';
        echo '<div id="msm" class="column_left">'.CHtml::image($url,$alt,$this->imageOptions).'</div>';
    }

    public function registerClientScript()
    {
        $cs=Yii::app()->clientScript;
        $id=$this->imageOptions['id'];
        $url=$this->getController()->createUrl($this->captchaAction,array(CCaptchaAction::REFRESH_GET_VAR=>true));

        $js="";
        if($this->showRefreshButton)
        {
            // reserve a place in the registered script so that any enclosing button js code appears after the captcha js
            $cs->registerScript('Yii.CCaptcha#'.$id,'// dummy');
            $label=$this->buttonLabel===null?Yii::t('yii','Get a new code'):$this->buttonLabel;
            $options=$this->buttonOptions;
            if(isset($options['id']))
                $buttonID=$options['id'];
            else
                $buttonID=$options['id']=$id.'_button';
            if($this->buttonType==='button')
                $html=CHtml::button($label, $options);
            else
                $html='<div style="padding-top: 10px" class="column_right">'.CHtml::link($label, $url, $options).'</div>';
            //$js="jQuery('#$id').after(".CJSON::encode($html).");";
            $js="jQuery('#msm').after(".CJSON::encode($html).");";
            $selector="#$buttonID";
        }

        if($this->clickableImage)
            $selector=isset($selector) ? "$selector, #$id" : "#$id";

        if(!isset($selector))
            return;

        $js.="
$(document).on('click', '$selector', function(){
	$.ajax({
		url: ".CJSON::encode($url).",
		dataType: 'json',
		cache: false,
		success: function(data) {
			$('#$id').attr('src', data['url']);
			$('body').data('{$this->captchaAction}.hash', [data['hash1'], data['hash2']]);
		}
	});
	return false;
});
";
        $cs->registerScript('Yii.CCaptcha#'.$id,$js);
    }

}
?>