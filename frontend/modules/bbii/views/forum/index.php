<?php
$this->setPageTitle('Articles');
/* @var $this ForumController */
/* @var $dataProvider CArrayDataProvider */

$this->bbii_breadcrumbs = array(
    Yii::t('BbiiModule.bbii', 'Forum'),
);

$approvals = BbiiPost::model()->unapproved()->count();
$reports = BbiiMessage::model()->report()->count();

$item = array(
    array('label' => Yii::t('BbiiModule.bbii', 'Forum'), 'url' => array('forum/index')),
    array('label' => Yii::t('BbiiModule.bbii', 'Members'), 'url' => array('member/index'), 'visible' => $this->isModerator() || $this->isAdmin()),
 array('label' => Yii::t('BbiiModule.bbii', 'Login'), 'url' => array('/site/login'), 'visible' => Yii::app()->user->isGuest),
    array('label' => Yii::t('BbiiModule.bbii', 'Register'), 'url' => array('member/register'), 'visible' => Yii::app()->user->isGuest),
    array('label' => Yii::t('BbiiModule.bbii', 'Approval') . ' (' . $approvals . ')', 'url' => array('moderator/approval'), 'visible' => $this->isModerator()),
    array('label' => Yii::t('BbiiModule.bbii', 'Reports') . ' (' . $reports . ')', 'url' => array('moderator/report'), 'visible' => $this->isModerator()),
);
?>
<style>
    .list-view{
        padding-top: 0px;
    }
</style>
<div id="bbii-wrapper" class="img-polaroid">
    <?php  ?>

    <?php
//    $this->beginwidget(
//            'bootstrap.widgets.TbBox', array(
////        'title' => 'Forum List',
////        'headerIcon' => 'icon-home',
//            )
//    );
    echo $this->renderPartial('_header', array('item' => $item));
    $this->widget('zii.widgets.CListView', array(
        'id' => 'bbiiForum',
        'dataProvider' => $dataProvider,
        'itemView' => '_forum',
        'viewData' => array('lastIndex' => ($dataProvider->totalItemCount - 1)),
        'summaryText' => false,
    ));
//    $this->endWidget('bootstrap.widgets.TbBox');
    ?>

    <?php // echo $this->renderPartial('_footer'); ?>
</div>
