<?php
/* @var $this MessageController */
/* @var $model BbiiMessage */
/* @var $form CActiveForm */
?>
<noscript>
<div class="flash-notice">
    <?php echo Yii::t('BbiiModule.bbii', 'Your web browser does not support JavaScript, or you have temporarily disabled scripting. This site needs JavaScript to function correct.'); ?>
</div>
</noscript>
<style>
     input#BbiiMessage_search, input#BbiiMessage_subject {
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
        width: 60%;

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

    <?php echo $form->errorSummary($model); ?>
    <table>
        <tr>
            <td>
                <label for="BbiiTopic_merge">Kepada</label> 
            </td>
            <td>
                <?php if ($this->action->id == 'create'): ?>
            <?php
            $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                'attribute' => 'search',
                'model' => $model,
                'sourceUrl' => array('member/members'),
                'theme' => $this->module->juiTheme,
                'options' => array(
                    'minLength' => 2,
                    'delay' => 200,
                    'select' => 'js:function(event, ui) { 
						$("#BbiiMessage_search").val(ui.item.label);
						$("#BbiiMessage_sendto").val(ui.item.value);
						return false;
					}',
                ),
                'htmlOptions' => array(
                    'style' => 'height:30px;',
                ),
            ));
            ?>
        <?php else: ?>
            <?php echo $form->label($model, 'sendto'); ?>
            <strong><?php echo CHtml::encode($model->search); ?></strong>
        <?php endif; ?>
        <?php echo $form->hiddenField($model, 'sendto'); ?>
        <?php echo $form->error($model, 'sendto'); ?>
            </td>
        </tr>
        <tr>
            <td>
                <label for="BbiiTopic_merge">Judul</label>
            </td>
            <td>
                
                 <?php echo $form->textField($model, 'subject', array('size' => 100, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'subject'); ?>
            </td>
        </tr>
        <tr>
            <td>
                <label for="BbiiTopic_merge">Pesan</label>
            </td>
            <td>
          <?php echo $form->ckEditorRow($model, 'content', array('label'=>false,'options' => array('fullpage' => 'js:true', 'filebrowserBrowseUrl' => $this->createUrl("fileManager/indexBlank")))); ?>
            </td>
        </tr>
    </table>


    

    <div class="form-actions" >
        <?php echo $form->hiddenField($model, 'type'); ?>
        <?php
        $this->widget(
                'bootstrap.widgets.TbButton', array(
            'buttonType' => 'submit',
            'type' => 'primary',
            'label' => 'Send'
                )
        );
        ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->