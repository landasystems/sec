<?php echo $form->textFieldRow($model, 'link', array('class' => 'span5', 'prepend'=>'http://')); ?>
<div class="control-group ">
    <label class="control-label">Target</label>
    <div class="controls">
        <?php
        echo CHtml::dropDownList('Menu[param][target]', 'Menu[param][target]', array('' => 'This Page', '_blank' => 'New Tab'))
        ?>
    </div>
    
</div>