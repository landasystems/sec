<div class="form">
    <?php
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'bpn-document-form',
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

        <div class="control-group">		
            <div class="span4">

                <?php echo $form->dropDownListRow($model, 'doc_year', array('2013'=>'2013','2012'=>'2012','2011'=>'2011','2010'=>'2010')); ?>

                <?php echo $form->textFieldRow($model, 'name', array('class' => 'span5', 'maxlength' => 255)); ?>

                <?php echo $form->textFieldRow($model, 'type', array('class' => 'span5', 'maxlength' => 255)); ?>

                <?php echo $form->textFieldRow($model, 'status_document', array('class' => 'span5', 'maxlength' => 255)); ?>

                <?php echo $form->textFieldRow($model, 'status_check', array('class' => 'span5', 'maxlength' => 255)); ?>

<?php echo $form->textFieldRow($model, 'barcode', array('class' => 'span5', 'maxlength' => 255)); ?>

            </div>   
        </div>

        <div class="form-actions">
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
    </fieldset>

<?php $this->endWidget(); ?>

</div>
