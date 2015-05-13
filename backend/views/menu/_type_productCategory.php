<div class="control-group ">
    <label class="control-label">Product Category</label>
    <div class="controls">
        <?php
        $this->widget('bootstrap.widgets.TbSelect2', array(
            'asDropDownList' => TRUE,
            'data' => CHtml::listData(ProductCategory::model()->findAll(array('order' => 'root, lft')), 'id', 'nestedname'),
            'name' => 'Menu[param][product_category_id]',
            'value' => isset($model->param['product_category_id']) ? $model->param['product_category_id'] : '',
            'options' => array(
                'placeholder' => yii::t('global', 'choose'),
                'width' => '100%',
                'tokenSeparators' => array(',', ' ')
        )));
        ?>
    </div>
</div>