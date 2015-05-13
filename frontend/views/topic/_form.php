<div class="form">
    <?php
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'bbii-topic-form',
        'enableAjaxValidation' => false,
        'method' => 'post',
        'type' => 'horizontal',
        'htmlOptions' => array(
            'enctype' => 'multipart/form-data'
        )
    ));
    ?>
    <fieldset>
        <legend>
            <p class="note">Fields dengan <span class="required">*</span> harus di isi.</p>
        </legend>

        <?php echo $form->errorSummary($model, 'Opps!!!', null, array('class' => 'alert alert-error span12')); ?>

        <?php echo $form->dropDownListRow($model, 'forum_id', CHtml::listData(BbiiForum::model()->findAll(array('condition' => 'cat_id is not NULL')), 'id', 'name'), array('class' => 'span4', 'empty' => t('choose', 'global'),)); ?>
        <?php // echo $form->textFieldRow($model,'forum_id',array('class'=>'span5','maxlength'=>10)); ?>

        <div class="control-group ">
            <label class="control-label" for="BbiiTopic_user_id">Created</label>
            <div class="controls">
                <input class="span4" maxlength="10" name="name" id="BbiiTopic_user_id" type="text" value="<?php echo $model->starter->member_name ?>" readonly>
            </div></div>
        <?php // echo $form->textFieldRow($model, 'user_id', array('class' => 'span5', 'maxlength' => 10)); ?>

        <?php echo $form->textFieldRow($model, 'title', array('class' => 'span5', 'maxlength' => 255)); ?>

        <?php echo $form->toggleButtonRow($model, 'sticky'); ?>
        <?php echo $form->toggleButtonRow($model, 'locked'); ?>
        <?php echo $form->toggleButtonRow($model, 'global'); ?>


        <?php if (!isset($_GET['v'])) { ?>        <div class="form-actions">
                <?php
                $this->widget('bootstrap.widgets.TbButton', array(
                    'buttonType' => 'submit',
                    'type' => 'primary',
                    'icon' => 'ok white',
                    'label' => $model->isNewRecord ? 'Tambah' : 'Simpan',
                ));
                ?>
                <?php
                $this->widget('bootstrap.widgets.TbButton', array(
                    'buttonType' => 'reset',
                    'icon' => 'remove',
                    'label' => 'Reset',
                ));
                ?>
            </div>
        <?php } ?>    </fieldset>

    <?php $this->endWidget(); ?>

</div>
