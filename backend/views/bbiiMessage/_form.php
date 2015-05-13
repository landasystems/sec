<div class="form">
    <?php
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'bbii-message-form',
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


        <?php echo $form->textFieldRow($model, 'sendfrom', array('class' => 'span5', 'maxlength' => 10)); ?>

        <?php echo $form->textFieldRow($model, 'sendto', array('class' => 'span5', 'maxlength' => 10)); ?>

        <?php echo $form->textFieldRow($model, 'subject', array('class' => 'span5', 'maxlength' => 255)); ?>
        <?php
        $content = '<blockquote cite="'. $model->sender->member_name .'"><p class="blockquote-header"><strong>'.$model->sender->member_name.'</strong></p>' . $model->content . '</blockquote><p></p>';
        $this->widget(
                'bootstrap.widgets.TbCKEditor', array(
            'name' => 'BbiiMessage[content]',
                    'value'=>$content,
                    
                )
        );
        ?>
        <?php echo $form->textAreaRow($model, 'content', array('rows' => 6, 'cols' => 50, 'class' => 'span8')); ?>

        <?php echo $form->textFieldRow($model, 'create_time', array('class' => 'span5')); ?>

        <?php echo $form->textFieldRow($model, 'read_indicator', array('class' => 'span5')); ?>

        <?php echo $form->textFieldRow($model, 'type', array('class' => 'span5')); ?>

        <?php echo $form->textFieldRow($model, 'inbox', array('class' => 'span5')); ?>

        <?php echo $form->textFieldRow($model, 'outbox', array('class' => 'span5')); ?>

        <?php echo $form->textFieldRow($model, 'ip', array('class' => 'span5', 'maxlength' => 39)); ?>

<?php echo $form->textFieldRow($model, 'post_id', array('class' => 'span5', 'maxlength' => 10)); ?>


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
