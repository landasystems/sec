<?php
$this->setPageTitle('Forums');
$this->breadcrumbs = array(
    'Forums',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
    $('.search-form').slideToggle('fast');
    return false;
});
$('.search-form form').submit(function(){
    $.fn.yiiGridView.update('bbii-forum-grid', {
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
		array('label'=>'Tambah', 'icon'=>'icon-plus', 'url'=>Yii::app()->controller->createUrl('create'), 'linkOptions'=>array()),
                array('label'=>'List Data', 'icon'=>'icon-th-list', 'url'=>Yii::app()->controller->createUrl('index'),'active'=>true, 'linkOptions'=>array()),
		array('label'=>'Pencarian', 'icon'=>'icon-search', 'url'=>'#', 'linkOptions'=>array('class'=>'search-button')),
	),
));
$this->endWidget();
?>
<style>
    .ui-sortable table{
        /*background-color: aqua;*/
        width: 100%;
    }
    .forum{
        background-color: aqua;
        width: 100%;
    }
    .category{
        background-color: burlywood;
        /*color: #fff;*/
    }
</style>

<?php
foreach (Yii::app()->user->getFlashes() as $key => $message) {
    echo '<div class="alert alert-' . $key . '">' . $message . '</div>';
}
?>


<div class="sortable well">
    <?php
    $items = array();
    foreach ($category as $data) {
        $forum = BbiiForum::model()->sorted()->forum()->findAll("cat_id = $data->id");
        $items['cat_' . $data->id] = $this->renderPartial('_category', array('data' => $data, 'forum' => $forum), true);
    }
    $this->widget('zii.widgets.jui.CJuiSortable', array(
        'id' => 'sortcategory',
        'items' => $items,
        'htmlOptions' => array('style' => 'list-style:none;;margin-top:1px'),
//			'theme'=>$this->module->juiTheme,
        'options' => array(
            'delay' => '100',
            'update' => "js:function(){
                        $.ajax({
                                type: 'POST',
                                url: '{$this->createUrl('bbiiForum/sort')}',
                                data: $(this).sortable('serialize'),
                        });
                }",
//				'update'=>'js:function(){Sort(this,"' . Yii::app()->controller->createUrl('sort') . '");}',
        ),
    ));
    ?>
</div>

