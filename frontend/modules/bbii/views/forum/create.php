<?php
/* @var $this ForumController */
/* @var $forum BbiiForum */
/* @var $post BbiiPost */
/* @var $poll BbiiPoll */
/* @var $choices array */

$this->bbii_breadcrumbs = array(
    Yii::t('BbiiModule.bbii', 'Forum') => array('forum/index'),
    $forum->name => array('forum/forum', 'id' => $forum->id),
    Yii::t('BbiiModule.bbii', 'New topic'),
);

$item = array(
    array('label' => Yii::t('BbiiModule.bbii', 'Forum'), 'url' => array('forum/index')),
    array('label' => Yii::t('BbiiModule.bbii', 'Members'), 'url' => array('member/index'))
);

if (empty($poll->question) && !$poll->hasErrors()) {
    $show = false;
} else {
    $show = true;
}
?>
<script>
$(function() {
    $('#BbiiPost_content').ckeditor({
        toolbar: 'Full',
        enterMode : CKEDITOR.ENTER_BR,
        shiftEnterMode: CKEDITOR.ENTER_P,
        
    });
});
</script>
<div id="bbii-wrapper" class="img-polaroid">
    <?php echo $this->renderPartial('_header', array('item' => $item)); ?>

    <noscript>
    <div class="flash-notice">
        <?php echo Yii::t('BbiiModule.bbii', 'Your web browser does not support JavaScript, or you have temporarily disabled scripting. This site needs JavaScript to function correct.'); ?>
    </div>
    </noscript>
    <style>
        input#BbiiPost_subject {
            border-radius: 2px;
            box-shadow: none;
            border: none;
            background: #fff;
            border: 1px solid #000;
            height: 35px;
            font-size: 14px;
            color: #000;
            font-family: 'Open Sans Light', sans-serif;
            margin-bottom: 10px;

        }
        .labelRight {
            width: 54px !important;
        }
    </style>
    <div class="form well">
        <?php
        $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
            'id' => 'create-topic-form',
            'enableAjaxValidation' => false,
            'htmlOptions' => array(
            'enctype' => 'multipart/form-data'
        )
        ));
        ?>

        <?php echo $form->errorSummary($post); ?>
        <table>
            <tr>
                <td>
                    <label for="BbiiTopic_merge">Judul</label> 
                </td>
                <td>
                    <?php echo $form->textField($post, 'subject', array('size' => 100, 'maxlength' => 255, 'style' => 'width:99%;')); ?>
                    <?php echo $form->error($post, 'subject'); ?>
                </td>
            </tr>
            <?php if ($forum->poll == 2 || ($forum->poll == 1 && $this->isModerator())) { ?>
                <tr>
                    <td>
                    </td>
                    <td>
                        <div class="button" id="poll-button" style="<?php echo ($show ? 'display:none;' : ''); ?>">
                            <?php echo CHtml::button(Yii::t('BbiiModule.bbii', 'Add poll'), array('class' => 'btn-warning', 'onclick' => 'showPoll()')); ?>
                        </div>
                        <div id="poll-form" style="<?php echo ($show ? '' : 'display:none;'); ?>" class="bbii-poll-form">
                            <table>
                                <tr>
                                    <td>
                                        <label for="BbiiTopic_merge">Pertanyaan</label> 
                                    </td>
                                    <td>
                                        <?php echo CHtml::activeTextField($poll, 'question', array('size' => 100, 'maxlength' => 255, 'style' => 'width:99%;')); ?>
                                        <?php echo CHtml::error($poll, 'question'); ?>   
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="BbiiTopic_merge">Jawaban</label> 
                                    </td>
                                    <td>
                                        <?php echo CHtml::errorSummary($poll); ?>
                                        <?php
                                        foreach ($choices as $key => $value) {
                                            echo CHtml::textField('choice[' . $key . ']', $value, array('maxlength' => 80, 'style' => 'width:99%;', 'onchange' => 'pollChange(this)'));
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="BbiiTopic_merge">Allow Revote</label>
                                    </td>
                                    <td>
                                        <?php
                                        $this->widget(
                                                'bootstrap.widgets.TbToggleButton', array(
                                            'name' => 'allow_revote',
                                            'onChange' => 'js:function($el, status, e){console.log($el, status, e);}'
                                                )
                                        );
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="BbiiTopic_merge">Multiple Revote</label>
                                    </td>
                                    <td>
                                        <?php
                                        $this->widget(
                                                'bootstrap.widgets.TbToggleButton', array(
                                            'name' => 'allow_multiple',
                                            'onChange' => 'js:function($el, status, e){console.log($el, status, e);}'
                                                )
                                        );
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="BbiiTopic_merge">Akhit Poll</label>
                                    </td>
                                    <td>
                                        <?php echo $form->hiddenField($poll, 'expire_date'); ?>
                                        <?php
                                        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                            'name' => 'expiredate',
                                            'value' => Yii::app()->dateFormatter->formatDateTime($poll->expire_date, 'short', null),
                                            'language' => substr(Yii::app()->language, 0, 2),
                                            'theme' => $this->module->juiTheme,
                                            'options' => array(
                                                'altField' => '#BbiiPoll_expire_date',
                                                'altFormat' => 'yy-mm-dd',
                                                'showAnim' => 'fold',
                                                'defaultDate' => 7,
                                                'minDate' => 1,
                                            ),
                                            'htmlOptions' => array(
                                                'style' => 'height:18px;width:75px;',
                                            ),
                                        ));
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <?php echo CHtml::hiddenField('addPoll', 'no'); ?>
                                        <?php echo CHtml::button(Yii::t('BbiiModule.bbii', 'Remove poll'), array('class' => 'btn-warning', 'onclick' => 'hidePoll()')); ?>
                                    </td>
                                    <td>

                                    </td>
                                </tr>
                            </table>

                        </div>
                    </td>
                </tr>
            <?php } ?>
            <?php if ($this->isModerator()) { ?>
                <tr>
                    <td>
                        <label for="BbiiTopic_merge">Locked</label> 
                    </td>
                    <td>
                        <?php
                        $this->widget(
                                'bootstrap.widgets.TbToggleButton', array(
                            'name' => 'locked',
                            'onChange' => 'js:function($el, status, e){console.log($el, status, e);}'
                                )
                        );
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="BbiiTopic_merge">Sticky</label> 
                    </td>
                    <td>
                        <?php
                        $this->widget(
                                'bootstrap.widgets.TbToggleButton', array(
                            'name' => 'sticky',
                            'onChange' => 'js:function($el, status, e){console.log($el, status, e);}'
                                )
                        );
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="BbiiTopic_merge">Global</label> 
                    </td>
                    <td>
                        <?php
                        $this->widget(
                                'bootstrap.widgets.TbToggleButton', array(
                            'name' => 'global',
                            'onChange' => 'js:function($el, status, e){console.log($el, status, e);}'
                                )
                        );
                        ?>
                    </td>
                </tr>
            <?php } ?>
            <tr>
                <td>
                    <label for="BbiiTopic_merge">Isi</label> 
                </td>
                <td>        
                    <?php echo $form->ckEditorRow($post, 'content', array('label'=>false,'options' => array('fullpage' => 'js:true', 'filebrowserBrowseUrl' => $this->createUrl("fileManager/indexBlank")))); ?>

                    <?php // echo $this->TbCKEditor( 'content', array('options' => array('fullpage' => 'js:true', 'filebrowserBrowseUrl' => $this->createUrl("fileManager/indexBlank")))); ?>
                    <?php
//                    $this->widget(
//                            'bootstrap.widgets.TbCKEditor', array(
//                        'name' => 'BbiiPost[content]',
//                                array('options' => array('filebrowserBrowseUrl' => Yii::app()->controller->createUrl("fileManager/indexBlank"))),
//                        'editorOptions' => array(
                        // From basic `build-config.js` minus 'undo', 'clipboard' and 'about'
//                    'plugins' => 'basicstyles,toolbar,enterkey,entities,floatingspace,wysiwygarea,indentlist,link,list,dialog,dialogui,button,indent,fakeobjects'
//                        )
//                            )
//                    );
                    ?>
                    <?php // echo $form->error($post, 'content'); ?>
                </td>
            </tr>
            
        </table>




        <div class="form-actions" >
            <?php echo $form->hiddenField($post, 'forum_id'); ?>
            <?php
            $this->widget(
                    'bootstrap.widgets.TbButton', array(
                'buttonType' => 'submit',
                'type' => 'primary',
                'label' => 'Create'
                    )
            );
            ?></div>
        <?php $this->endWidget(); ?>
    </div><!-- form -->	

</div>