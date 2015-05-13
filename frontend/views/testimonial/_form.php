<div class="testimonial-content">
    
    
    
    <?php
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'testimonial-form',
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


        <?php echo $form->textFieldRow($model, 'name', array('class' => 'span5', 'placeholder' => 'Your Name', 'maxlength' => 100)); ?>

        <?php echo $form->textFieldRow($model, 'corporate', array('class' => 'span5', 'placeholder' => 'Your Corporate', 'maxlength' => 100)); ?>

        <?php echo $form->textFieldRow($model, 'email', array('class' => 'span5', 'placeholder' => 'Your Email', 'maxlength' => 100)); ?>


        <?php echo $form->fileFieldRow($model, 'img_avatar'); ?>


        <?php if (CCaptcha::checkRequirements()): ?>
            <div class="control-group ">
                <h5><?php //echo $form->labelEx($model, 'verifyCode');   ?></h5>
                <?php $this->widget('CCaptcha'); ?>

                <?php echo $form->error($model, 'verifyCode'); ?>
                <label class="control-label required" for="Testimonial_email"> <span class="required">*</span></label><div class="controls"><?php echo $form->textField($model, 'verifyCode'); ?></div></div>
        <?php endif; ?>


        <?php
        echo $form->html5EditorRow(
                $model, 'testimonial', array(
            'class' => 'span4',
            'rows' => 5,
            'height' => '200',
            'options' => array('color' => true)
                )
        );
        ?>


        <div class="form-actions">
            <?php
           
            $this->widget(
    'bootstrap.widgets.TbButton',
    array(
        'label' => 'Highlighted',
        'buttonType' => 'submit',
        'type' => 'primary',
                'label' => $model->isNewRecord ? 'Submit' : 'Simpan',
            ));
            ?>
            <?php
            /* $this->widget('bootstrap.widgets.TbButton', array(
                'buttonType' => 'reset',
                'icon' => 'remove',
                'label' => 'Reset',
            )); */
            ?>
        </div>
    </fieldset>

    <?php $this->endWidget(); ?>

</div>