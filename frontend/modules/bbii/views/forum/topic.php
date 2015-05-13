<?php
/* @var $this ForumController */
/* @var $forum BbiiForum */
/* @var $topic BbiiTopic */
/* @var $dataProvider CActiveDataProvider */
/* @var $postId integer */
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->getClientScript()->getCoreScriptUrl() . '/jui/js/jquery-ui-i18n.min.js', CClientScript::POS_END);
$this->bbii_breadcrumbs = array(
    Yii::t('BbiiModule.bbii', 'Forum') => array('forum/index'),
    $forum->name => array('forum/forum', 'id' => $forum->id),
    $topic->title,
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

Yii::app()->clientScript->registerScript('language', "
	var language = \"" . substr(Yii::app()->language, 0, 2) . "\";", CClientScript::POS_BEGIN);

Yii::app()->clientScript->registerScript('scrollToPost', "
	var aTag = $('a[name=\"" . $postId . "\"]');
	if(aTag.length > 0) {
		$('html,body').animate({scrollTop: aTag.offset().top},'fast');
	}
", CClientScript::POS_READY);
?>
<div id="fb-root"></div>
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id))
            return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.0";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
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
<div id="bbii-wrapper">
    <?php echo $this->renderPartial('_header', array('item' => $item)); ?>

    <div class="codo_topics_post_head">

        <center><div class="codo_topics_head_item"><a href="#"><?php echo $topic->title; ?></a></div></center>

    </div>
    <br>
    <table>
        <tr>
            <td>
                 <?php if (!( $topic->locked == 1)): ?>
        <div class="form">
            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'create-post-form',
                'htmlOptions' => array(
                    'style' => 'margin:0px;',
                ),
                'action' => array('forum/reply', 'id' => $topic->id),
                'enableAjaxValidation' => false,
            ));
            ?>
            <?php // echo CHtml::submitButton(Yii::t('BbiiModule.bbii', 'Reply'), array('class' => 'bbii-topic-button')); ?>
            <button  class="btn btn-warning" type="submit"><i class=" icon-share"></i> Balas</button>
            <?php $this->endWidget(); ?>
        </div><!-- form -->	
    <?php endif; ?>
            </td>
            <td>
                <form style="margin:0px;" id="create-post-form" >  
                <a target="_blank" class="share-button facebook tracking" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>" data-event-desktop-action-click="ShowBiz::Bottom::Share::FB"><img src="<?php echo bt('images/fb.png') ?>" style="width: 30%;"></i></a>
    <a target="_blank" class="share-button twitter tracking "  href="https://twitter.com/home?status=<?php echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>" data-event-desktop-action-click="ShowBiz::Bottom::Share::Twitter"><img src="<?php echo bt('images/twitter.png') ?>" style="width: 30%;"></a>

        </form>
            </td>
        </tr>
    </table>
   
        

    <?php
    $this->widget('zii.widgets.CListView', array(
        'id' => 'bbiiPost',
        'dataProvider' => $dataProvider,
        'itemView' => '_post',
        'viewData' => array('postId' => $postId),
    ));
    ?>
</div>
<div style="display:none;">
    <?php
    $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
        'id' => 'dlgReportForm',
        'theme' => $this->module->juiTheme,
        'options' => array(
            'title' => Yii::t('BbiiModule.bbii', 'Report post'),
            'autoOpen' => false,
            'modal' => true,
            'width' => 800,
            'show' => 'fade',
            'buttons' => array(
//                Yii::t('BbiiModule.bbii', 'Send') => 'js:function(){ sendReport(); }',
                Yii::t('BbiiModule.bbii', 'Send') => 'js:function(){ sendReport("' . $this->createAbsoluteUrl('message/sendReport') . '"); }',
                Yii::t('BbiiModule.bbii', 'Cancel') => 'js:function(){ $(this).dialog("close"); }',
            ),
        ),
    ));

    echo $this->renderPartial('_reportForm', array('model' => new BbiiMessage));

    $this->endWidget('zii.widgets.jui.CJuiDialog');
    ?>
</div>
