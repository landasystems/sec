<?php

Yii::import('zii.widgets.CPortlet');

class SimpleSearchForm extends CPortlet {

    protected function renderContent() {
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'simple-search-form',
            'action' => array('search/index'),
            'enableAjaxValidation' => false,
        ));
        echo '<div class="controls" style=padding:0px;>';
        echo CHtml::textField('search', '', array('size' => 20, 'maxlength' => 50));
        echo CHtml::hiddenField('choice', '0');
        echo CHtml::hiddenField('type', '0');
        $this->widget(
                'bootstrap.widgets.TbButton', array('buttonType' => 'submit',
            'label' => 'Cari',
            'htmlOptions' => array(
                'style' => 'margin-top:-10px;',
            ),
                    
                )
        );
        echo '</div>';
        // echo CHtml::submitButton('', array('class' => 'medium-search-button', 'style' => 'width:20px;'));
        $this->endWidget();
    }

}