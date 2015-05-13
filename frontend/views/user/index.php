<?php
$this->pageTitle = $_GET['title'];
$this->breadcrumbs = array(
    $_GET['title']
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
    $('.search-form').slideToggle('fast');
    return false;
});
$('.search-form form').submit(function(){
    $.fn.yiiGridView.update('User-grid', {
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
//        array('label' => 'Tambah', 'icon' => 'icon-plus', 'url' => Yii::app()->controller->createUrl('create'), 'linkOptions' => array()),
//        array('label' => 'Daftar', 'icon' => 'icon-th-list', 'url' => Yii::app()->controller->createUrl('index'), 'active' => true, 'linkOptions' => array()),
        array('label' => 'Pencarian', 'icon' => 'icon-search', 'url' => '#', 'linkOptions' => array('class' => 'search-button')),
//        array('label' => 'Export ke PDF', 'icon' => 'icon-download', 'url' => Yii::app()->controller->createUrl('GeneratePdf'), 'linkOptions' => array('target' => '_blank'), 'visible' => true),
//        array('label' => 'Export ke Excel', 'icon' => 'icon-download', 'url' => Yii::app()->controller->createUrl('GenerateExcel'), 'linkOptions' => array('target' => '_blank'), 'visible' => true),
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
    'id' => 'User-grid',
//    'dataProvider' => $model->search($roles),
    'dataProvider' => new CActiveDataProvider(User::model(), array('criteria' => array('condition' => 'roles_id=' . $param->rolesId))),
    'type' => 'striped bordered condensed',
    'template' => '{pager}{items}{pager}',
    'columns' => array(
       array(
           'name' => 'Foto',
            'type' => 'raw',
            'value' => '"$data->tagImg"', 
            'htmlOptions' => array('style' => 'text-align: center; width:180px;text-align:center;')
//            'value' => '"<img src=\"$data->imgUrl[\\"medium\\"]\" class="image"/>"', 
//            'value' => 'aa', 
            ),
        array(
           'name' => 'Biodata',
            'type' => 'raw',
            'value' => '"$data->tagBiodata"', 
            'htmlOptions' => array('style' => 'text-align: center;')
//            'value' => '"<img src=\"$data->imgUrl[\\"medium\\"]\" class="image"/>"', 
//            'value' => 'aa', 
            ),
//        array(
//           'name' => 'Access',
//            'type' => 'raw',
//            'value' => '"$data->tagAccess"', 
//            'htmlOptions' => array('style' => 'text-align: center;'),
//            'headerHtmlOptions'=>array('text-align'=>'center'),
////            'value' => '"<img src=\"$data->imgUrl[\\"medium\\"]\" class="image"/>"', 
////            'value' => 'aa', 
//            ),
//        array('header'=>'Enabled',
//        'name'=>'enabled',
//        'type'=>'raw',    
//        'htmlOptions' => array('class' => 'span1'),    
//        'value'=>'($data->enabled==0) ? "<span class=\"label label-important\">No</span>":
//         "<span class=\"label label-info\">Yes</span>"',
//        ),   

//        'UserPosition.name',
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'template' =>'{lihat}',
            'buttons' => array(
                'lihat' => array(
                    'label' => 'Lihat',
                    'url'=>'Yii::app()->createUrl("user/view", array("id"=>$data->id))',
                    'options' => array(
                        'class' => 'btn btn-warning'
                    )
                ),
                'update' => array(
                    'label' => 'Edit',
//                    'url'=>'Yii::app()->createUrl("user/update", array("id"=>$data->id,"type"=>"'.$type.'"))',
                    'options' => array(
                        'class' => 'btn btn-small update'
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

