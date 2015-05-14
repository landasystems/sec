<?php
$this->setPageTitle('Slide Shows');
$this->breadcrumbs = array(
    'Slide Shows',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
    $('.search-form').slideToggle('fast');
    return false;
});
$('.search-form form').submit(function(){
    $.fn.yiiGridView.update('slide-show-grid', {
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
//        array('label' => 'Pencarian', 'icon' => 'icon-search', 'url' => '#', 'linkOptions' => array('class' => 'search-button')),
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
foreach (Yii::app()->user->getFlashes() as $key => $message) {
    echo '<div class="alert alert-' . $key . '">' . $message . '</div>';
}
?>

<?php

$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'slide-show-grid',
    'dataProvider' => $model->search(),
    'type' => 'striped bordered condensed',
    'template' => '{summary}{pager}{items}{pager}',
    'columns' => array(
        array(
           'name' => 'Foto',
            'type' => 'raw',
            'value' => '"$data->tagImg"', 
            'htmlOptions' => array('style' => 'text-align: center; width:100px;text-align:center;')
//            'value' => '"<img src=\"$data->imgUrl[\\"medium\\"]\" class="image"/>"', 
//            'value' => 'aa', 
            ),
        
        'title',
        'description',
//         array(
//           'name' => 'status',
//            'type' => 'raw',
//            'value' => '"$data->statusPublish"', 
////            'htmlOptions' => array('style' => 'text-align: center; width:100px;text-align:center;')
////            'value' => '"<img src=\"$data->imgUrl[\\"medium\\"]\" class="image"/>"', 
////            'value' => 'aa', 
//            ),
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'template' => '{view} {update} {status} {off} {delete}',
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
                'status' => array(
                    'label' => 'Publish',
                    'icon' => 'icon-ok',
                    'url'=>'Yii::app()->controller->createUrl("slideShow/changeActive", array("id"=>$data->id))',
                    'visible' => '( $data->status==0)',
                    'options' => array(
                        'class' => 'btn btn-small update status',
                       
                    )
                ),
                'off' => array(
                    'label' => 'Unpublish',
                    'icon' => 'icon-remove',
                    'url'=>'Yii::app()->controller->createUrl("slideShow/changeOff", array("id"=>$data->id))',
                    'visible' => '( $data->status==1)',
                    'options' => array(
                        'class' => 'btn btn-small update status',
                       
                    )
                ),
                'delete' => array(
                    'label' => 'Hapus',
                    'options' => array(
                        'class' => 'btn btn-small delete'
                    )
                )
            ),
            'htmlOptions' => array('style' => 'width: 125px'),
        )
    ),
));

?>

