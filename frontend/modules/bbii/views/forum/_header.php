
<?php
echo CHtml::dropDownList('bbii-jumpto', '', CHtml::listData(BbiiForum::getForumOptions(), 'id', 'name', 'group'), array('empty' => Yii::t('BbiiModule.bbii', 'Pilih Kategori'),
    'onchange' => "window.location.href='" . CHtml::normalizeUrl(array('forum')) . "/id/'+$(this).val()",
));
?>
<?php if (isset($this->bbii_breadcrumbs)): ?>
    <?php
    $this->widget(
            'bootstrap.widgets.TbBreadcrumbs', array(
        'homeLink' => false,
        'links' => $this->bbii_breadcrumbs,
            )
    );
    ?>
    <?php





 endif ?>
