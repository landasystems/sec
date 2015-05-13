<div class="form">
    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'classroom-form',
	'enableAjaxValidation'=>false,
        'method'=>'post',
	'type'=>'horizontal',
	'htmlOptions'=>array(
		'enctype'=>'multipart/form-data'
	)
)); ?>
    <fieldset>
        <legend>
            <p class="note">Fields dengan <span class="required">*</span> harus di isi.</p>
        </legend>

        <?php echo $form->errorSummary($model,'Opps!!!', null,array('class'=>'alert alert-error span12')); ?>

        <?php echo $form->dropDownListRow($model, 'school_year_id', CHtml::listData(SchoolYear::model()->findAll(array('order' => 'id')), 'id', 'school_year'), array('class' => 'span3', 'empty' => 'Pilih tahun ajaran')); ?>
                                    <?php //echo $form->textFieldRow($model,'school_year_id',array('class'=>'span5')); ?>

                                        <?php echo $form->textFieldRow($model,'name',array('class'=>'span3','maxlength'=>255)); ?>
                                        <?php echo $form->html5EditorRow(
                                            $model,
                                            'description',
                                            array(
                                                'class' => 'span1',
                                                'rows' => 5,
                                                'height' => '200',
                                                'options' => array('color' => true)
                                            )
                                        ); ?>

                    

        <div class="form-actions">
            <?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
                        'icon'=>'ok white',  
			'label'=>$model->isNewRecord ? 'Tambah' : 'Simpan',
		)); ?>
            <?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'reset',
                        'icon'=>'remove',  
			'label'=>'Reset',
		)); ?>
        </div>
    </fieldset>

    <?php $this->endWidget(); ?>

</div>

