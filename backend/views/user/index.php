<?php
$this->setPageTitle(ucfirst($type));
$this->breadcrumbs = array(
    ucfirst($type),
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
$svisible = "";
if ($type == "client") {
    $svisible = landa()->checkAccess('Client', 'c');
} elseif ($type == "contact") {
    $svisible = landa()->checkAccess('Contact', 'c');
} elseif ($type == "customer") {
    $svisible = landa()->checkAccess('Customer', 'c');
} elseif ($type == "employment") {
    $svisible = landa()->checkAccess('Employment', 'c');
} elseif ($type == "guest") {
    $svisible = landa()->checkAccess('Guest', 'c');
} elseif ($type == "supplier") {
    $svisible = landa()->checkAccess('Supplier', 'c');
} else {
    $svisible = landa()->checkAccess('User', 'c');
}
$this->beginWidget('zii.widgets.CPortlet', array(
    'htmlOptions' => array(
        'class' => ''
    )
));
$this->widget('bootstrap.widgets.TbMenu', array(
    'type' => 'pills',
    'items' => array(
        array('visible'=>$svisible,'label' => 'Tambah', 'icon' => 'icon-plus', 'url' => Yii::app()->controller->createUrl('create',array('type'=>$type)), 'linkOptions' => array()),
        array('label' => 'Daftar', 'icon' => 'icon-th-list', 'url' => Yii::app()->controller->createUrl($type), 'active' => true, 'linkOptions' => array()),
        array('label' => 'Pencarian', 'icon' => 'icon-search', 'url' => '#', 'linkOptions' => array('class' => 'search-button')),
        array('label' => 'Export Excel', 'icon' => 'icomoon-icon-file-excel', 'url' => Yii::app()->controller->createUrl('user/generateExcel'), 'linkOptions' => array()),
    ),
));
$this->endWidget();
?>



<div class="search-form" style="display:none">
    <?php
    $this->renderPartial('_search', array(
        'model' => $model,
        'type'=>$type,
    ));
    ?>
</div><!-- search-form -->
<?php
foreach (Yii::app()->user->getFlashes() as $key => $message) {
    echo '<div class="alert alert-' . $key . '">' . $message . '</div>';
}
?>
<?php
        $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
            'id' => 'ws-finish-form',
            'enableAjaxValidation' => false,
            'method' => 'post',
            'type' => 'horizontal',
            'action' => url('user/moderator'),
            'htmlOptions' => array(
                'enctype' => 'multipart/form-data',
                'class' => 'table table-striped'
            )
        ));
        ?>
        <button type="submit" name="delete" value="dd" style="margin-left: 10px" class="btn btn-danger pull-right"><span class="icon16 brocco-icon-trashcan white"></span> Delete</button>
        <button type="submit" name="buttonmoderator" value="dd" style="margin-left: 10px" class="btn btn-info pull-right"><span class="icon16 entypo-icon-publish white"></span> Enable Moderator </button> 
        <button type="submit" name="buttondelmoderator" value="dd"  class="btn btn-warning pull-right"><span class="icon16 entypo-icon-close white"></span> Disabled Moderator</button><br>


<?php
$buton = "";
if ($type == "client") {
    if (landa()->checkAccess('Client', 'r')) {
        $buton .= '{view}';
    }
    
    if (landa()->checkAccess('Client', 'u')) {
        $buton .= '{update}';
    }
    if (landa()->checkAccess('Client', 'd')) {
        $buton .= '{delete}';
    }
} elseif ($type == "contact") {
    if (landa()->checkAccess('Contact', 'r')) {
        $buton .= '{view}';
    }
    
    if (landa()->checkAccess('Contact', 'u')) {
        $buton .= '{update}';
    }
    if (landa()->checkAccess('Contact', 'd')) {
        $buton .= '{delete}';
    }
} elseif ($type == "customer") {
    if (landa()->checkAccess('Customer', 'r')) {
        $buton .= '{view}';
    }
    
    if (landa()->checkAccess('Customer', 'u')) {
        $buton .= '{update}';
    }
    if (landa()->checkAccess('Customer', 'd')) {
        $buton .= '{delete}';
    }
} elseif ($type == "employment"){
    if (landa()->checkAccess('Employment', 'r')) {
        $buton .= '{view}';
    }
    
    if (landa()->checkAccess('Employment', 'u')) {
        $buton .= '{update}';
    }
    if (landa()->checkAccess('Employment', 'd')) {
        $buton .= '{delete}';
    }
} elseif ($type == "guest"){
    if (landa()->checkAccess('Guest', 'r')) {
        $buton .= '{view}';
    }
    
    if (landa()->checkAccess('Guest', 'u')) {
        $buton .= '{update}';
    }
    if (landa()->checkAccess('Guest', 'd')) {
        $buton .= '{delete}';
    }
} else{
    if (landa()->checkAccess('User', 'r')) {
        $buton .= '{view}';
    }
    
    if (landa()->checkAccess('User', 'u')) {
        $buton .= '{update}';
    }
    if (landa()->checkAccess('User', 'd')) {
        $buton .= '{delete}';
    }
}
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'User-grid',
    'dataProvider' => $model->search($type,$roles),
    'type' => 'striped bordered condensed',
    'template' => '{summary}{pager}{items}{pager}',
    'columns' => array(
        array(
                    'class' => 'CCheckBoxColumn',
                    'headerTemplate' => '{item}',
                    'selectableRows' => 2,
                    'checkBoxHtmlOptions' => array(
                        'name' => 'id[]',
                    ),
                ),
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
        array(
           'name' => 'Access',
            'type' => 'raw',
            'value' => '"$data->tagAccess"', 
            'htmlOptions' => array('style' => 'text-align: center;'),
            'headerHtmlOptions'=>array('text-align'=>'center'),
//            'value' => '"<img src=\"$data->imgUrl[\\"medium\\"]\" class="image"/>"', 
//            'value' => 'aa', 
            ),
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
            'template' =>$buton,
            'buttons' => array(
                'view' => array(
                    'label' => 'Lihat',
                    'url'=>'Yii::app()->createUrl("user/view", array("id"=>$data->id,"type"=>"'.$type.'"))',
                    'options' => array(
                        'class' => 'btn btn-small view'
                    )
                ),
                'update' => array(
                    'label' => 'Edit',
                    'url'=>'Yii::app()->createUrl("user/update", array("id"=>$data->id,"type"=>"'.$type.'"))',
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
<?php $this->endWidget(); ?>

