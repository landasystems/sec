<?php
$this->setPageTitle('Bbii Messages');
$this->breadcrumbs = array(
    'Bbii Messages',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
    $('.search-form').slideToggle('fast');
    return false;
});
$('.search-form form').submit(function(){
    $.fn.yiiGridView.update('bbii-message-grid', {
        data: $(this).serialize()
    });
    return false;
});
");
?>

<?php
$this->beginWidget('zii.widgets.CPortlet', array(
    'htmlOptions' => array(
        'class' => ''
    )
));
$this->widget('bootstrap.widgets.TbMenu', array(
    'type' => 'pills',
    'items' => array(
        array('label' => 'Tambah', 'icon' => 'icon-plus', 'url' => Yii::app()->controller->createUrl('create'), 'linkOptions' => array()),
        array('label' => 'List Data', 'icon' => 'icon-th-list', 'url' => Yii::app()->controller->createUrl('index'), 'active' => true, 'linkOptions' => array()),
        array('label' => 'Pencarian', 'icon' => 'icon-search', 'url' => '#', 'linkOptions' => array('class' => 'search-button')),
    ),
));
$this->endWidget();
?>



<div class="search-form" style="display:none">
    <?php
    $this->renderPartial('_search', array(
        'model' => $model,
    ));
    ?>
</div><!-- search-form -->


<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'bbii-message-grid',
    'dataProvider' => $model->search(),
    'type' => 'striped bordered condensed',
    'template' => '{summary}{pager}{items}{pager}',
    'columns' => array(
        'id',
        'sendfrom',
        'sendto',
        'subject',
        'content',
        'create_time',
        /*
          'read_indicator',
          'type',
          'inbox',
          'outbox',
          'ip',
          'post_id',
         */
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'template' => '{view} {delete}{reply}',
            'buttons' => array(
                'view' => array(
                    'label' => 'Lihat',
                    'options' => array(
                        'class' => 'btn btn-small view'
                    )
                ),
                'update' => array(
                    'label' => 'Edit',
                    'options' => array(
                        'class' => 'btn btn-small update'
                    )
                ),
                'delete' => array(
                    'label' => 'Hapus',
                    'options' => array(
                        'class' => 'btn btn-small delete'
                    )
                ),
                'reply' => array(
                    'label' => 'Reply',
                    'icon' => 'entypo-icon-reply',
                    'visible' => '1',
                    'url' => 'Yii::app()->createUrl("bbiiMessage/update", array("id"=>$data->id))',
                    'options' => array(
                        'class' => 'btn btn-small ',
                    )
                ),
            ),
            'htmlOptions' => array('style' => 'width: 125px'),
        )
    ),
));
?>

