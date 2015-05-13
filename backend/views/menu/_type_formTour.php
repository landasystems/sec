<?php echo $form->textFieldRow($model, 'link', array('class' => 'span5', 'prepend'=>'http://')); ?>
<div class="control-group ">
    <label class="control-label">Target</label>
    <div class="controls">
        <?php
        echo CHtml::dropDownList('Menu[param][target]', 'Menu[param][target]', array('' => 'This Page', '_blank' => 'New Tab'))
        ?>
    </div>
    
</div>
<div class="control-group ">
    <label class="control-label">Layout</label>
    <div class="controls">
        <?php
        $value = (isset($model->param['layout'])) ? $model->param['layout'] : '';
        echo CHtml::dropDownList('Menu[param][layout]', $value, array( 'mainsingle2' => 'Main Single 2', 
            'mainsingle3' => 'Main Single 3', 'mainsingle4' => 'Main Single 4', 'mainsingle4b' => 'Main Single 4b', 'mainsingle4c' => 'Main Single 4c', 'mainsingle5' => 'Main Single 5'),array('empty' => 'Select layout'));
        ?>
    </div>
</div>