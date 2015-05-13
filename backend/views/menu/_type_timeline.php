<div class="control-group ">
    <label class="control-label">Article Category</label>
    <div class="controls">
        <?php
        $this->widget('bootstrap.widgets.TbSelect2', array(
            'asDropDownList' => TRUE,
            'data' => CHtml::listData(ArticleCategory::model()->findAll(array('order' => 'root, lft')), 'id', 'nestedname'),
            'name' => 'Menu[param][article_category_id]',
            'value' => (isset($model->param['article_category_id'])) ? $model->param['article_category_id'] : '',
            'options' => array(
                'placeholder' => yii::t('global', 'choose'),
                'width' => '100%',
                'tokenSeparators' => array(',', ' ')
        )));
        ?>

    </div>
</div>