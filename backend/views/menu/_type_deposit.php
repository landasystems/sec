<?php echo $form->textFieldRow($model, 'link', array('class' => 'span5', 'prepend' => 'http://')); ?>
<div class="control-group ">
    <label class="control-label">Target</label>
    <div class="controls">
        <?php
        echo CHtml::dropDownList('Menu[param][target]', 'Menu[param][target]', array('' => 'This Page', '_blank' => 'New Tab'))
        ?>
    </div>

</div>
<div class="control-group ">
    <label class="control-label">Action</label>
    <div class="controls">
        <?php
        $value = (isset($model->param['action'])) ? $model->param['action'] : '';
        echo CHtml::dropDownList('Menu[param][action]', $value, array('deposit' => 'Deposit', 'sell' => 'Sell', 'roles' => 'Roles'));
        ?>
    </div>
</div>
<div class="control-group cc" style="display:none">
    <label class="control-label">Roles</label>
    <div class="controls">
        <?php
        $value = (isset($model->param['rolesId'])) ? $model->param['rolesId'] : '';
        echo CHtml::dropDownList('Menu[param][rolesId]', $value, CHtml::listData(Roles::model()->findAll(), 'id', 'name'));
        ?>
    </div>
</div>
<div class="control-group cc" >
    <label class="control-label">Top Amount</label>
    <div class="controls">
        <?php
        $value = (isset($model->param['top_amount'])) ? $model->param['top_amount'] : '';
        echo CHtml::textField('Menu[param][top_amount]',$value,array('size'=>10,'maxlength'=>15,'prepend' => 'Rp'));
        ?>
    </div>
</div>
<div class="control-group ">
    <label class="control-label">Description</label>
    <div class="controls">
        <?php echo $form->html5EditorRow($model, 'param[prependText]', array('class' => 'span4', 'rows' => 5, 'height' => '200', 'label' => false, 'options' => array('color' => true))); ?>

    </div>
</div>
<script>
$("#Menu_param_action").on("change",function(){

    if($(this).val() == "roles" ){
        $(".cc").show();
    }else{
        $(".cc").hide();
    }
});
</script>