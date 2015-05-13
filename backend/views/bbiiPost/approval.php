<?php
$this->setPageTitle('Posts');
$this->breadcrumbs = array(
    'Bbii Posts',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
    $('.search-form').slideToggle('fast');
    return false;
});
$('.search-form form').submit(function(){
    $.fn.yiiGridView.update('bbii-post-grid', {
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
            'action' => url('bbiiPost/approveAll'),
            'htmlOptions' => array(
                'enctype' => 'multipart/form-data',
                'class' => 'table table-striped'
            )
        ));
        ?>
        <button type="submit" name="delete" value="dd" style="margin-left: 10px" class="btn btn-danger pull-right"><span class="icon16 brocco-icon-trashcan white"></span> Delete</button>
        <button type="submit" name="buttonapprove" value="dd" style="margin-left: 10px" class="btn btn-info pull-right"><span class="icon16 icon-ok white"></span> Approve </button> <br>
        


<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'bbii-post-grid',
    'dataProvider' => $model->search(),
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
//        'id',
        array(
            'name' => 'user_id',
            'header' => 'User',
            'value' => '$data->postName',
        ),
        'subject',
        array(
            'name' => 'forum_id',
            'header' => 'Forum',
            'value' => '$data->forumName',
        ),
        array(
            'name' => 'upvoted',
            'header' => 'Vote',
            'value' => $model->upvoted
        ),
        array(
            'name' => 'create_time',
            'header' => 'Create',
            'value' => '$data->create',
        ),
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'template' => '{view} {update} {delete}',
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
            ),
            'htmlOptions' => array('style' => 'width: 125px'),
        )
    ),
));
?>
<?php $this->endWidget(); ?>
