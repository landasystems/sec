<?php
/* @var $this ModeratorController */
/* @var $model BbiiMessage */

$this->bbii_breadcrumbs = array(
    Yii::t('BbiiModule.bbii', 'Forum') => array('forum/index'),
    Yii::t('BbiiModule.bbii', 'Reports'),
);
?>
<style>
    .grid-view {
        padding-top: 10px;
    }
    .grid-view table.items th{
        background-color: #0066b3 !important;
        background: none ;
    }
</style>
<div id="bbii-wrapper" class="well">
    <?php // echo $this->renderPartial('_header', array('item'=>$item));  ?>

    <?php
    $this->widget('zii.widgets.grid.CGridView', array(
        'id' => 'message-grid',
        'dataProvider' => $model->search(),
        'filter' => $model,
        'columns' => array(
            array(
                'name' => 'sendfrom',
                'value' => '$data->sender->member_name',
                'filter' => false,
            ),
            'subject',
            array(
                'name' => 'content',
                'type' => 'html',
            ),
            'create_time',
            array(
                'class' => 'CButtonColumn',
                'template' => '{view}{reply}{delete}',
                'buttons' => array(
                    'view' => array(
                        'url' => 'array("forum/topic", "id"=>$data->forumPost->topic_id, "nav"=>$data->post_id)',
                        'label' => Yii::t('BbiiModule.bbii', 'Go to post'),
                        'imageUrl' => $this->module->getRegisteredImage('goto.png'),
                    ),
                    'reply' => array(
                        'url' => 'array("message/reply", "id"=>$data->id)',
                        'label' => Yii::t('BbiiModule.bbii', 'Reply'),
                        'imageUrl' => $this->module->getRegisteredImage('reply.png'),
                        'options' => array('style' => 'margin-left:5px;'),
                    ),
                    'delete' => array(
                        'url' => 'array("message/delete", "id"=>$data->id)',
                        'imageUrl' => $this->module->getRegisteredImage('delete.png'),
                        'options' => array('style' => 'margin-left:5px;'),
                    ),
                )
            ),
        ),
    ));
    ?>
</div>