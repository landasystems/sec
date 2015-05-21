<?php
/* @var $this ForumController */
/* @var $forum BbiiForum */
/* @var $dataProvider CArrayDataProvider */

$this->bbii_breadcrumbs = array(
    Yii::t('BbiiModule.bbii', 'Forum') => array('forum/index'),
    $forum->name,
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

<?php if (Yii::app()->user->hasFlash('moderation')): ?>
    <div class="flash-notice">
        <?php echo Yii::app()->user->getFlash('moderation'); ?>
    </div>
<?php endif; ?>
<style>
    .list-view{
        padding-top: 0px;
    }
</style>
<div id="bbii-wrapper" class="img-polaroid">
    <?php echo $this->renderPartial('_header', array('item' => $item)); ?>

    <div class="codo_topics_head">

        <div class="codo_topics_head_item"><a href="#"><?php echo $forum->name; ?></a></div>

    </div>

    <?php // if (!(Yii::app()->user->isGuest || $forum->locked) || $this->isModerator()): ?>
        <div class="form">
            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'create-topic-form',
                'htmlOptions' => array(
                    'style' => 'margin: 0px 0px 0px;',
                ),
                'action' => array('forum/createTopic'),
                'enableAjaxValidation' => false,
            ));
            ?>
            <?php echo $form->hiddenField($forum, 'id'); ?>
            <div style="padding:10px;">
                <?php // echo CHtml::submitButton(Yii::t('BbiiModule.bbii', 'Buat Topic'), array('class' => 'bbii-topic-button')); ?>
                <button  class="btn btn-warning" type="submit"><i class="icon-plus-sign"></i> Buat Topic Baru</button>
            </div>
            <?php $this->endWidget(); ?>
        </div><!-- form -->	
    <?php // endif; ?>

    <?php
    $this->widget('zii.widgets.CListView', array(
        'id' => 'bbiiTopic',
        'dataProvider' => $dataProvider,
        'itemView' => '_topic',
    ));
    ?>

    <?php // echo $this->renderPartial('_forumfooter'); ?>
</div>
<div style="display:none;">
    <?php
    if ($this->isModerator()) {
        $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
            'id' => 'dlgTopicForm',
            'theme' => $this->module->juiTheme,
            'options' => array(
                'title' => Yii::t('BbiiModule.bbii', 'Update Topic'),
                'autoOpen' => false,
                'modal' => true,
                'width' => 800,
                'show' => 'fade',
                'buttons' => array(
                    Yii::t('BbiiModule.bbii', 'Change') => 'js:function(){ BBii.changeTopic("' . $this->createAbsoluteUrl('moderator/changeTopic') . '"); }',
                    Yii::t('BbiiModule.bbii', 'Cancel') => 'js:function(){ $(this).dialog("close"); }',
                ),
            ),
        ));

        echo $this->renderPartial('_topicForm', array('model' => new BbiiTopic));

        $this->endWidget('zii.widgets.jui.CJuiDialog');
    }
    ?>
</div>
