<?php
/* @var $this ForumController */
/* @var $model BbiiTopic */
/* @var $form CActiveForm */
?>
<style>
    #BbiiTopic_title {
    border-radius: 2px;
    box-shadow: none;
    border: none;
    text-shadow: 1px 1px 0 rgba(256,256,256,1.0);
    background: #fff;
    border: 1px solid #000;
    height: 35px;
    font-size: 14px;
    color: #000;
    font-family: 'Open Sans Light', sans-serif;
    margin-bottom: 10px;

}
    select {
    border-radius: 2px;
    border: 1px solid #000;
}
</style>
<div class="form">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'update-topic-form',
        'enableAjaxValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
            'validateOnChange' => false,
        )
    ));
    ?>
    <?php echo $form->errorSummary($model); ?>


    <table>
        <tr>
            <td><label for="BbiiTopic_merge">Forum</label></td>
            <td>
                <?php echo $form->dropDownList($model, 'forum_id', CHtml::listData(BbiiForum::model()->forum()->findAll(), 'id', 'name'), array('onchange' => 'refreshTopics(this, "' . $this->createAbsoluteUrl('moderator/refreshTopics') . '")')); ?>
                <?php echo $form->error($model, 'forum_id'); ?>
            </td>
        </tr>
        <tr>
            <td>
                <label for="BbiiTopic_merge">Title</label> 
            </td>
            <td>
                <?php echo $form->textField($model, 'title', array('size' => 100, 'maxlength' => 255, 'style' => 'width:99%;')); ?>
                <?php echo $form->error($model, 'title'); ?>
            </td>
        </tr>
        <tr>
            <td>
                <label for="BbiiTopic_merge">Locked</label> 
            </td>
            <td>
                <?php echo $form->dropDownList($model, 'locked', array('0' => Yii::t('BbiiModule.bbii', 'No'), '1' => Yii::t('BbiiModule.bbii', 'Yes'))); ?>
                <?php echo $form->error($model, 'locked'); ?>
            </td>
        </tr>
        <tr>
            <td>
                <label for="BbiiTopic_merge">Sticky</label> 
            </td>
            <td>
                
                <?php echo $form->dropDownList($model, 'sticky', array('0' => Yii::t('BbiiModule.bbii', 'No'), '1' => Yii::t('BbiiModule.bbii', 'Yes'))); ?>
                <?php echo $form->error($model, 'sticky'); ?>
            </td>
        </tr>
        <tr>
            <td>
                <label for="BbiiTopic_merge">Global</label> 
            </td>
            <td>
                
                <?php echo $form->dropDownList($model, 'global', array('0' => Yii::t('BbiiModule.bbii', 'No'), '1' => Yii::t('BbiiModule.bbii', 'Yes'))); ?>
                <?php echo $form->error($model, 'global'); ?>
            </td>
        </tr>
    </table>


    <div class="row">
        <?php // echo $form->labelEx($model, 'merge'); ?>
        <?php // echo $form->dropDownList($model, 'merge', array()); ?>
        <?php // echo $form->error($model, 'merge'); ?>
    </div>


    <div class="row">
        <?php echo $form->hiddenField($model, 'id'); ?>
    </div>

    <?php $this->endWidget(); ?>
</div><!-- form -->	
