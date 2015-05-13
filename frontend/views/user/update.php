<?php
$this->setPageTitle('Edit Users | ID : '. $model->name);
$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

?>

<?php 
$this->beginWidget('zii.widgets.CPortlet', array(
	'htmlOptions'=>array(
		'class'=>''
	)
));

$this->endWidget();
?>

<?php
foreach (Yii::app()->user->getFlashes() as $key => $message) {
    echo '<div class="alert alert-' . $key . '">' . $message . '</div>';
}
?>     

<?php echo $this->renderPartial('_form',array('model'=>$model, 'code' => (isset($_GET['code'])) ? $_GET['code'] : '', 'listSiteConfig' => $listSiteConfig,)); ?>