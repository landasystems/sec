<?php
/* @var $this ForumController */
/* @var $model BbiiMessage */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'report-form',
        'enableAjaxValidation' => true,
        'enableClientValidation' => true,
    ));
    ?>

    <div class="row">
        <textarea name='BbiiPost[content]'></textarea>
        <?php echo $form->error($model, 'content'); ?>
        <?php echo $form->hiddenField($model, 'post_id'); ?>
        <?php // echo CHtml::hiddenField('url', $this->createAbsoluteUrl('message/sendReport')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->