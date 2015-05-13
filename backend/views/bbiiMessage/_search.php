<?php  $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
'id'=>'search-bbii-message-form',
'action'=>Yii::app()->createUrl($this->route),
'method'=>'get',
));  ?>


        <?php echo $form->textFieldRow($model,'id',array('class'=>'span5','maxlength'=>10)); ?>

        <?php echo $form->textFieldRow($model,'sendfrom',array('class'=>'span5','maxlength'=>10)); ?>

        <?php echo $form->textFieldRow($model,'sendto',array('class'=>'span5','maxlength'=>10)); ?>

        <?php echo $form->textFieldRow($model,'subject',array('class'=>'span5','maxlength'=>255)); ?>

        <?php echo $form->textAreaRow($model,'content',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

        <?php echo $form->textFieldRow($model,'create_time',array('class'=>'span5')); ?>

        <?php echo $form->textFieldRow($model,'read_indicator',array('class'=>'span5')); ?>

        <?php echo $form->textFieldRow($model,'type',array('class'=>'span5')); ?>

        <?php echo $form->textFieldRow($model,'inbox',array('class'=>'span5')); ?>

        <?php echo $form->textFieldRow($model,'outbox',array('class'=>'span5')); ?>

        <?php echo $form->textFieldRow($model,'ip',array('class'=>'span5','maxlength'=>39)); ?>

        <?php echo $form->textFieldRow($model,'post_id',array('class'=>'span5','maxlength'=>10)); ?>

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'search white', 'label'=>'Pencarian')); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'button', 'icon'=>'icon-remove-sign white', 'label'=>'Reset', 'htmlOptions'=>array('class'=>'btnreset btn-small'))); ?>
</div>

<?php $this->endWidget(); ?>

<script type="text/javascript">
    jQuery(function($) {
        $(".btnreset").click(function() {
            $(":input", "#search-bbii-message-form").each(function() {
                var type = this.type;
                var tag = this.tagName.toLowerCase(); // normalize case
                if (type == "text" || type == "password" || tag == "textarea")
                    this.value = "";
                else if (type == "checkbox" || type == "radio")
                    this.checked = false;
                else if (tag == "select")
                    this.selectedIndex = "";
            });
        });
    })
</script>

