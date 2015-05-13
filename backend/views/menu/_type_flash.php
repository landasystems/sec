<?php echo $form->textFieldRow($model, 'link', array('class' => 'span5', 'prepend'=>'http://')); ?>
<div class="control-group ">
    <label class="control-label">Flash name file</label>
    <div class="controls">
         <?php
        $value = (isset($model->param['flash_name'])) ? $model->param['flash_name'] : '';
        echo CHtml::textField('Menu[param][flash_name]',$value,array('size'=>10,'maxlength'=>225));
        ?>
    </div>
</div>
<div class="control-group ">
    <label class="control-label">Target</label>
    <div class="controls">
        <?php
        echo CHtml::dropDownList('Menu[param][target]', 'Menu[param][target]', array('' => 'This Page', '_blank' => 'New Tab'))
        ?>
    </div>
    
</div>