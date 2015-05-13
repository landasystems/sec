

<?php 
// $this->beginWidget('zii.widgets.CPortlet', array(
//	'htmlOptions'=>array(
//		'class'=>''
//	)
//));
//$this->widget('bootstrap.widgets.TbMenu', array(
//	'type'=>'pills',
//	'items'=>array(
//		array('label'=>'Tambah', 'icon'=>'icon-plus', 'url'=>Yii::app()->controller->createUrl('create'), 'linkOptions'=>array()),
//                //array('label'=>'Daftar', 'icon'=>'icon-th-list', 'url'=>Yii::app()->controller->createUrl('index'),'active'=>true, 'linkOptions'=>array()),
//		//array('label'=>'Pencarian', 'icon'=>'icon-search', 'url'=>'#', 'linkOptions'=>array('class'=>'search-button')),
//		//array('label'=>'Export ke PDF', 'icon'=>'icon-download', 'url'=>Yii::app()->controller->createUrl('GeneratePdf'), 'linkOptions'=>array('target'=>'_blank'), 'visible'=>true),
//		//array('label'=>'Export ke Excel', 'icon'=>'icon-download', 'url'=>Yii::app()->controller->createUrl('GenerateExcel'), 'linkOptions'=>array('target'=>'_blank'), 'visible'=>true),
//	),
//));
//$this->endWidget(); 
?>



<!--<div class="search-form" style="display:none">
<?php //$this->renderPartial('_search',array(
	//'model'=>$model,
//)); ?>
</div> search-form -->

<br>
<?php 

$this->widget('common.extensions.landa.widgets.LandaTestimonial');
//trace($model->search());

//$this->widget('bootstrap.widgets.TbGridView',array(
//	'id'=>'testimonial-grid',
//	'dataProvider'=>$model->search(),
//        'type'=>'striped bordered condensed',
//        'template'=>'{summary}{pager}{items}{pager}',
//	'columns'=>array(
//		'id',
//		'name',
//		'email',
//		'img_avatar',
//		'testimonial',
//       array(
//            'class'=>'bootstrap.widgets.TbButtonColumn',
//			'template' => '{view} {update} {delete}',
//			'buttons' => array(
//			      'view' => array(
//					'label'=> 'Lihat',
//					'options'=>array(
//						'class'=>'btn btn-small view'
//					)
//				),	
//                              'update' => array(
//					'label'=> 'Edit',
//					'options'=>array(
//						'class'=>'btn btn-small update'
//					)
//				),
//				'delete' => array(
//					'label'=> 'Hapus',
//					'options'=>array(
//						'class'=>'btn btn-small delete'
//					)
//				)
//			),
//            'htmlOptions'=>array('style'=>'width: 125px'),
//           )
//	),
//)); 
?>

<?php
$this->setPageTitle('Testimonials');
$this->breadcrumbs=array(
	'Testimonials',
);

//Yii::app()->clientScript->registerScript('search', "
//$('.search-button').click(function(){
//    $('.search-form').slideToggle('fast');
//    return false;
//});
//$('.search-form form').submit(function(){
//    $.fn.yiiGridView.update('testimonial-grid', {
//        data: $(this).serialize()
//    });
//    return false;
//});
//");

?>
<hr>
<h2>Send Testimonal</h2>
<div class="testimonial">
<?php echo $this->renderPartial('_form', array('model'=>$modelCreate)); ?>
</div>
<?php

$this->widget('CLinkPager', array(
	'header' => '',
	'firstPageLabel' => '&lt;&lt;',
	'prevPageLabel' => '&lt;',
	'nextPageLabel' => '&gt;',
	'lastPageLabel' => '&lt;&lt;',
	'pages' => $pages,
));
?>