<?php
/* @var $this ForumController */

$this->bbii_breadcrumbs = array(
    Yii::t('BbiiModule.bbii', 'Forum') => array('forum/index'),
    Yii::t('BbiiModule.bbii', 'Members'),
);

$approvals = BbiiPost::model()->unapproved()->count();
$reports = BbiiMessage::model()->report()->count();

$item = array(
    array('label' => Yii::t('BbiiModule.bbii', 'Forum'), 'url' => array('forum/index')),
    array('label' => Yii::t('BbiiModule.bbii', 'Members'), 'url' => array('member/index')),
    array('label' => Yii::t('BbiiModule.bbii', 'Approval') . ' (' . $approvals . ')', 'url' => array('moderator/approval'), 'visible' => $this->isModerator()),
    array('label' => Yii::t('BbiiModule.bbii', 'Reports') . ' (' . $reports . ')', 'url' => array('moderator/report'), 'visible' => $this->isModerator()),
    array('label' => Yii::t('BbiiModule.bbii', 'Posts'), 'url' => array('moderator/admin'), 'visible' => $this->isModerator()),
    array('label' => Yii::t('BbiiModule.bbii', 'Blocked IP'), 'url' => array('moderator/ipadmin'), 'visible' => $this->isModerator()),
);
?>
<style>
    .grid-view {
        padding-top: 0px;
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
<div id="bbii-wrapper" class="well">
    <?php // echo $this->renderPartial('_header', array('item' => $item)); ?>

    <?php
    $this->widget('zii.widgets.grid.CGridView', array(
        'id' => 'member-grid',
        'dataProvider' => $model->search(),
        'filter' => $model,
        'columns' => array(
            array(
                'name' => 'avatar',
                'type' => 'raw',
                'value' => '"$data->tagImg"',
                'htmlOptions' => array('style' => 'text-align: center; width:70px;text-align:center;')
//            'value' => '"<img src=\"$data->imgUrl[\\"medium\\"]\" class="image"/>"', 
//            'value' => 'aa', 
            ),
            array(
                'name' => 'member_name',
                'type' => 'raw',
                'value' => 'CHtml::link(CHtml::encode($data->member_name), array("member/view", "id"=>$data->id))',
            ),
            array(
                'name' => 'business_id',
                'filter' => CHtml::listData(BusinessCategory::model()->findAll(), 'id', 'name'),
                'value' => '(isset($data->business))?$data->business->name:""',
            ),
            array(
                'name' => 'type_business',
                'type' => 'raw',
//                'value' => 'CHtml::link(CHtml::encode($data->type_business), array("member/view", "id"=>$data->id))',
            ),
            
            array(
                'header' => 'Phone',
                'value' => '$data->phone',
            ),
            array(
                'header' => Yii::t('BbiiModule.bbii', 'Last visit'),
                'value' => 'DateTimeCalculation::full($data->last_visit)',
            ),
            
            array(
                'name' => 'city_id',
                'filter' => CHtml::listData(City::model()->findAll(array('condition'=>'province_id=5')), 'id', 'name'),
                'value' => '(isset($data->city))?$data->city->name:""',
            ),
        ),
    ));
    ?>


    <?php // echo $this->renderPartial('_footer'); ?>
</div>
