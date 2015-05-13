<?php
/* @var $this ForumController */
/* @var $model BbiiMessage */
/* @var $form CActiveForm */
?>
<style>
    input#ip, input#pelapor, input#judul {
    border-radius: 2px;
    box-shadow: none;
    border: none;
    text-shadow: 1px 1px 0 rgba(256,256,256,1.0);
    background: #fff;
    border: 1px solid #999;
    height: 35px;
    font-size: 14px;
    color: #000;
    font-family: 'Open Sans Light', sans-serif;
    margin-bottom: 10px;
    width: 60%;

}
    textarea#alasan {
    border-radius: 2px;
    border: 1px solid #999;
    width: 60%;
}
</style>
<div class="form well">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'report-form',
        'enableAjaxValidation' => true,
        'enableClientValidation' => true,
    ));
    ?>
    <table width="100%">
        <tr>
            <td>
                <label for="BbiiTopic_merge">IP</label>
            </td>
            <td>
                <input type="text" id="ip" value="<?php echo Yii::app()->request->userHostAddress ?>" name="BbiiMessage[ip]">
            </td>
        </tr>
        <tr>
            <td>
                <label for="BbiiTopic_merge">Pelapor</label>
            </td>
            <td>
                <input type="text" id="pelapor" value="<?php echo user()->member_name ?>" name="BbiiMessage[ip]">
            </td>
        </tr>
        <tr>
            <td>
                <label for="BbiiTopic_merge">Post ID</label>
            </td>
            <td>
                <input type="text" id="judul" value="<?php echo $_GET['id'] ?>" name="BbiiMessage[ip]">
                <input name="BbiiMessage[post_id]" id="BbiiMessage_post_id" type="hidden" value="<?php echo $_GET['id'] ?>">
            </td>
        </tr>
        <tr>
            <td>
                <label for="BbiiTopic_merge">Alasan</label>
            </td>
            <td>
                <textarea name='BbiiMessage[content]' id="alasan"></textarea>
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
            'label' => 'Laporkan'
                )
        );
        ?>
    </div>
    <div class="row">
        <?php echo $form->error($model, 'content'); ?>
        <?php echo $form->hiddenField($model, 'post_id'); ?>
        <?php // echo CHtml::hiddenField('url', $this->createAbsoluteUrl('message/sendReport')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->