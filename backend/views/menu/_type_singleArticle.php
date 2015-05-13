<div class="control-group ">
    <label class="control-label">Artikel</label>
    <div class="controls">
        <?php
        $this->widget('bootstrap.widgets.TbSelect2', array(
            'asDropDownList' => TRUE,
            'data' => CHtml::listData(Article::model()->findAll(), 'id', 'titleCat'),
            'name' => 'Menu[param][article_id]',
            'value' => (isset($model->param['article_id'])) ? $model->param['article_id'] : '',
            'options' => array(
                'placeholder' => yii::t('global', 'choose'),
                'width' => '100%',
                'tokenSeparators' => array(',', ' ')
        )));
        ?>

    </div>
</div>

<div class="control-group ">
    <label class="control-label">Social Media</label>
    <div class="controls">
        <?php echo $form->toggleButtonRow($model, 'param[socialmedia]', array('label' => false)); ?>

    </div>
</div>
<div class="control-group ">
    <label class="control-label">Facebook Comment</label>
    <div class="controls">
        <?php echo $form->toggleButtonRow($model, 'param[fbComment]', array('label' => false)); ?>
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
