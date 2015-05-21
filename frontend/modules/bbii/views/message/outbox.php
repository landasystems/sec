<?php
/* @var $this MessageController */
/* @var $model BbiiMessage */
/* @var $count Array */

$this->bbii_breadcrumbs = array(
    Yii::t('BbiiModule.bbii', 'Forum') => array('forum/index'),
    Yii::t('BbiiModule.bbii', 'Outbox'),
);

//$item = array(
//	array('label'=>Yii::t('BbiiModule.bbii', 'Inbox') .' ('. $count['inbox'] .')', 'url'=>array('message/inbox')),
//	array('label'=>Yii::t('BbiiModule.bbii', 'Outbox') .' ('. $count['outbox'] .')', 'url'=>array('message/outbox')),
//	array('label'=>Yii::t('BbiiModule.bbii', 'New message'), 'url'=>array('message/create'))
//);
?>
<style>
    .grid-view {
        padding-top: 10px;
    }
    .grid-view table.items th{
        background-color: #0066b3 !important;
        background: none ;
    }
         .grid-view table.items td a{
        color: #0066b3 !important;
        text-decoration: underline;
       
    }
    .grid-view table.items td a:hover{
        color: #0066b3 !important;
        text-decoration: none;
       
    }
</style>
<div id="bbii-wrapper" class="img-polaroid">
    <?php // echo $this->renderPartial('_header', array('item'=>$item)); ?>

<!--<div class="progress"><div class="progressbar" style="width:<?php // echo (2*$count['outbox']);  ?>%"> </div></div>-->
    <a href="<?php echo url('forum/message/create') ?>" class="btn btn-warning" type="submit"><i class="icon-plus-sign"></i> Buat Pesan</a>
    <?php
    $this->widget('zii.widgets.grid.CGridView', array(
        'id' => 'inbox-grid',
        'dataProvider' => $model->search(),
        'rowCssClassExpression' => '($data->read_indicator)?"":"unread"',
        'columns' => array(
            array(
                'name' => 'sendto',
                'value' => '$data->receiver->member_name'
            ),
//            'subject',
             array(
                'name' => 'subject',
                'type' => 'raw',
                'value' => 'CHtml::link(CHtml::encode($data->subject), array("message/viewMessage", "id"=>$data->id))',
                
            ),
            array(
                'name' => 'create_time',
                'value' => 'DateTimeCalculation::long($data->create_time)',
            ),
            array(
                'name' => 'type',
                'value' => '($data->type)?Yii::t("bbii", "notification"):Yii::t("bbii", "message")',
            ),
            array(
                'class' => 'CButtonColumn',
                'template' => '{view}{delete}',
                'buttons' => array(
                    'view' => array(
                        'url' => '$data->id',
                        'imageUrl' => $this->module->getRegisteredImage('view.png'),
                        'click' => 'js:function() { viewMessage($(this).attr("href"), "' . $this->createAbsoluteUrl('message/view') . '");return false; }',
                    ),
                    'delete' => array(
                        'imageUrl' => $this->module->getRegisteredImage('delete.png'),
                        'options' => array('style' => 'margin-left:5px;'),
                    ),
                )
            ),
        ),
    ));
    ?>

    

</div>
<div id="bbii-message"></div>