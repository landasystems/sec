<div class="form">
    <?php
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'bbii-forum-form',
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
        <?php
        foreach (Yii::app()->user->getFlashes() as $key => $message) {
            echo '<div class="alert alert-' . $key . '">' . $message . '</div>';
        }
        ?>

        <?php echo $form->textFieldRow($model, 'name', array('class' => 'span5', 'maxlength' => 255)); ?>
        <?php
        if( $model->isNewRecord == true){
        ?>
        
                <?php echo $form->dropDownListRow($model, 'type', array('0' => 'Category', '1' => 'Sub Category'), array('class' => 'span4')); ?>
            
        <?php } ?>
        <?php echo $form->dropDownListRow($model, 'cat_id', CHtml::listData(BbiiForum::model()->findAll(array('condition' => 'cat_id is NULL')), 'id', 'name'), array('class' => 'span4', 'empty' => t('choose', 'global'),)); ?>

        <?php
        echo $form->textAreaRow(
                $model, 'subtitle', array('class' => 'span4', 'rows' => 5)
        );
        ?>
        <?php echo $form->toggleButtonRow($model, 'public'); ?>
        <?php echo $form->toggleButtonRow($model, 'locked'); ?>
        <?php echo $form->toggleButtonRow($model, 'moderated'); ?>
        <?php echo $form->toggleButtonRow($model, 'fjb'); ?>
        <?php echo $form->dropDownListRow($model, 'poll', array('0' => 'No Polling', '1' => 'Moderator Polling','2'=>'User Polling'), array('class' => 'span4', 'empty' => t('choose', 'global'),)); ?>
       

        <?php // echo $form->textFieldRow($model, 'membergroup_id', array('class' => 'span5', 'maxlength' => 10)); ?>


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
