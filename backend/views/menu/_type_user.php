<div class="control-group ">
    <label class="control-label">Action User</label>
    <div class="controls">
        <?php
        $this->widget('bootstrap.widgets.TbSelect2', array(
            'asDropDownList' => TRUE,
            'data' => array('Registration' => 'Registration','Update Profile'=>'Update Profile','Login'=>'Login','Logout'=>'Logout'),
            'name' => 'Menu[param][action_user]',
            'value' => isset($model->param['action_user']) ? $model->param['action_user'] : '',
            'options' => array(
                'placeholder' => yii::t('global', 'choose'),
                'class' => 'span4',
                'tokenSeparators' => array(',', ' ')
        )));
        ?>
    </div>
</div>
<div class="control-group cc" style>
    <label class="control-label">Roles</label>
    <div class="controls">
        <?php
        echo CHtml::dropDownList('Menu[param][rolesId]', 'Menu[param][rolesId]', CHtml::listData(Roles::model()->findAll(),'id','name') );
        ?>
    </div>
    
</div>



