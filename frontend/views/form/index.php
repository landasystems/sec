<?php

$this->setPageTitle('Form Builders');
$this->breadcrumbs=array(
	'Form Builders',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
    $('.search-form').slideToggle('fast');
    return false;
});
$('.search-form form').submit(function(){
    $.fn.yiiGridView.update('form-builder-grid', {
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
		array('label'=>'Tambah', 'icon'=>'icon-plus', 'url'=>Yii::app()->createUrl('form',array('create'=>$param->form_category_id)), 'linkOptions'=>array()), 
                array('label'=>'Daftar', 'icon'=>'icon-th-list', 'url'=>Yii::app()->createUrl('form',array('index'=>$param->form_category_id)),'active'=>true, 'linkOptions'=>array()),		
//		array('label'=>'Export ke PDF', 'icon'=>'icon-download', 'url'=>Yii::app()->controller->createUrl('GeneratePdf'), 'linkOptions'=>array('target'=>'_blank'), 'visible'=>true),
//		array('label'=>'Export ke Excel', 'icon'=>'icon-download', 'url'=>Yii::app()->controller->createUrl('GenerateExcel'), 'linkOptions'=>array('target'=>'_blank'), 'visible'=>true),
	),
));
$this->endWidget();
?>




<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'form-builder-grid',
	'dataProvider'=>$model->search_frontend(),
        'enableSorting' => false,
        'type'=>'striped bordered condensed',
        'template'=>'{pager}{items}{pager}',
	'columns'=>array(                                        

            array(   
            'header' => 'No. Pendaftaran',
            'type'  => 'raw',                
            'value' => 'substr("0000000000$data->id",-8)',
             ),
            'created',			
       array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
			'template' => ' {update}',
//			'template' => ' {update} {delete}',
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
            'htmlOptions'=>array('style'=>'width: 90px'),
           )
	),
)); 
?>