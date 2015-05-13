<?php

$this->setPageTitle('Edit Users | ID : ' . $model->name);
$this->breadcrumbs = array(
    'Users' => array('index'),
    $model->name => array('view', 'id' => $model->id),
    'Update',
    array('visible' => in_array('mlm', param('menu')), 'label' => 'Diagram Jaringan', 'icon' => 'entypo-icon-card', 'url' => url('mlmDiagram/downline', array('id' => $model->id)), 'linkOptions' => array()),
);
?>

<?php

$this->beginWidget('zii.widgets.CPortlet', array(
    'htmlOptions' => array(
        'class' => ''
    )
));

$this->endWidget();
?>

<?php echo $this->renderPartial('_form', array('model' => $model, 'type' => $type)); ?>