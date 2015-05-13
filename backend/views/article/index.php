<?php
$this->setPageTitle('Articles');
$this->breadcrumbs=array(
	'Articles',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
    $('.search-form').slideToggle('fast');
    return false;
});
$('.search-form form').submit(function(){
    $.fn.yiiGridView.update('Article-grid', {
        data: $(this).serialize()
    });
    return false;
});
");

?>

<?php 
$this->beginWidget('zii.widgets.CPortlet', array(
	'htmlOptions'=>array(
		'class'=>''
	)
));
$this->widget('bootstrap.widgets.TbMenu', array(
	'type'=>'pills',
	'items'=>array(
		array('label'=>'Tambah', 'icon'=>'icon-plus', 'url'=>Yii::app()->controller->createUrl('create'), 'linkOptions'=>array(),'visible'=>landa()->checkAccess('Article', 'c')),
                array('label'=>'Daftar', 'icon'=>'icon-th-list', 'url'=>Yii::app()->controller->createUrl('index'),'active'=>true, 'linkOptions'=>array()),
		array('label'=>'Pencarian', 'icon'=>'icon-search', 'url'=>'#', 'linkOptions'=>array('class'=>'search-button')),
		array('label'=>'Export ke PDF', 'icon'=>'icon-download', 'url'=>Yii::app()->controller->createUrl('GeneratePdf'), 'linkOptions'=>array('target'=>'_blank'), 'visible'=>true),
		array('label'=>'Export ke Excel', 'icon'=>'icon-download', 'url'=>Yii::app()->controller->createUrl('GenerateExcel'), 'linkOptions'=>array('target'=>'_blank'), 'visible'=>true),
	),
));
$this->endWidget();
?>



<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
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
            'action' => url('article/publish'),
            'htmlOptions' => array(
                'enctype' => 'multipart/form-data',
                'class' => 'table table-striped'
            )
        ));
        ?>
        <button type="submit" name="delete" value="dd" style="margin-left: 10px" class="btn btn-danger pull-right"><span class="icon16 brocco-icon-trashcan white"></span> Delete</button>
        <button type="submit" name="buttonpublish" value="dd" style="margin-left: 10px" class="btn btn-info pull-right"><span class="icon16 entypo-icon-publish white"></span> Publish </button> 
        <button type="submit" name="buttonunpublish" value="dd"  class="btn btn-warning pull-right"><span class="icon16 entypo-icon-close white"></span> Unpublish</button><br>

<?php 
$buton="";
if(landa()->checkAccess('Article', 'r')){
    $buton .= '{view}';
}
if(landa()->checkAccess('Article', 'u')){
    $buton .= '{update}';
}
if(landa()->checkAccess('Article', 'd')){
    $buton .= '{delete}';
}
$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'Article-grid',
	'dataProvider'=>$model->search(),
        'type'=>'striped bordered condensed',
        'template'=>'{summary}{pager}{items}{pager}',
	'columns'=>array(
            array(
                    'class' => 'CCheckBoxColumn',
                    'headerTemplate' => '{item}',
                    'selectableRows' => 2,
                    'checkBoxHtmlOptions' => array(
                        'name' => 'id[]',
                    ),
                ),
		'id',
		'title',
		'ArticleCategory.name',
		'hits',
            array(
                    'name' => 'publish',
                    'header' => 'Status',
                    'value' => '$data->publishdata',
                    'htmlOptions' => array('style' => 'text-align: left;')
                ),
		/*
		'created_user_id',
		'access',
		'modified',
		*/
       array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
			'template' => $buton,
			'buttons' => array(
			      'view' => array(
					'label'=> 'Lihat',
					'options'=>array(
						'class'=>'btn btn-small view'
					)
				),	
                              'update' => array(
					'label'=> 'Edit',
					'options'=>array(
						'class'=>'btn btn-small update'
					)
				),
				'delete' => array(
					'label'=> 'Hapus',
					'options'=>array(
						'class'=>'btn btn-small delete'
					)
				)
			),
            'htmlOptions'=>array('style'=>'width: 125px'),
           )
	),
)); ?>
        
<?php $this->endWidget(); ?>
        

