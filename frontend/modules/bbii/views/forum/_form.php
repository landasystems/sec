<?php
/* @var $this ForumController */
/* @var $post BbiiPost */
/* @var $form CActiveForm */
?>
<style>
    input#BbiiPost_subject, input#BbiiPost_change_reason {
        border-radius: 2px;
        box-shadow: none;
        border: none;
        background: #fff;
        border: 1px solid #999;
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
<noscript>
<div class="flash-notice">
    <?php echo Yii::t('BbiiModule.bbii', 'Your web browser does not support JavaScript, or you have temporarily disabled scripting. This site needs JavaScript to function correct.'); ?>
</div>
</noscript>
<div class="form">
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
        <tr>
            <td>
                <label for="BbiiTopic_merge">Content</label> 
            </td>
            <td>
                <?php echo $form->ckEditorRow($post, 'content', array('label'=>false,'options' => array('fullpage' => 'js:true', 'filebrowserBrowseUrl' => $this->createUrl("fileManager/indexBlank")))); ?>
                <?php
//                $this->widget(
//                        'bootstrap.widgets.TbCKEditor', array(
//                    'name' => 'BbiiPost[content]',
//                    'value' => $post->content,
//                    'editorOptions' => array(
//// From basic `build-config.js` minus 'undo', 'clipboard' and 'about'
////                'plugins' => 'sourcearea,basicstyles,toolbar,enterkey,entities,floatingspace,wysiwygarea,indentlist,link,list,dialog,dialogui,button,indent,fakeobjects,blockquote,image,smiley'
//                    )
//                        )
//                );
                ?>
            </td>
        </tr>
        <?php if (!$post->isNewRecord){ ?>
        <tr>
            <td>
                <label for="BbiiTopic_merge">Alasan</label> 
            </td>
            <td>
                 <?php echo $form->textField($post, 'change_reason', array('size' => 100, 'maxlength' => 255, 'style' => 'width:99%;')); ?>
            <?php echo $form->error($post, 'change_reason'); ?>
            </td>
        </tr>
        <?php } ?>
    </table>


    <div class="form-actions">
        <?php echo $form->hiddenField($post, 'forum_id'); ?>
        <?php echo $form->hiddenField($post, 'topic_id'); ?>
        <?php
        $this->widget(
                'bootstrap.widgets.TbButton', array(
            'buttonType' => 'submit',
            'type' => 'primary',
            'label' => 'Send'
                )
        );
        ?> </div>

    <?php $this->endWidget(); ?>
</div><!-- form -->	
