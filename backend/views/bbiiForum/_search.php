<?php  $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
'id'=>'search-bbii-forum-form',
'action'=>Yii::app()->createUrl($this->route),
'method'=>'get',
));  ?>


        <?php echo $form->textFieldRow($model,'id',array('class'=>'span5','maxlength'=>10)); ?>

        <?php echo $form->textFieldRow($model,'cat_id',array('class'=>'span5','maxlength'=>10)); ?>

        <?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>255)); ?>

        <?php echo $form->textFieldRow($model,'subtitle',array('class'=>'span5','maxlength'=>255)); ?>

        <?php echo $form->textFieldRow($model,'type',array('class'=>'span5')); ?>

        <?php echo $form->textFieldRow($model,'public',array('class'=>'span5')); ?>

        <?php echo $form->textFieldRow($model,'locked',array('class'=>'span5')); ?>

        <?php echo $form->textFieldRow($model,'moderated',array('class'=>'span5')); ?>

        <?php echo $form->textFieldRow($model,'sort',array('class'=>'span5')); ?>

        <?php echo $form->textFieldRow($model,'num_posts',array('class'=>'span5','maxlength'=>10)); ?>

        <?php echo $form->textFieldRow($model,'num_topics',array('class'=>'span5','maxlength'=>10)); ?>

        <?php echo $form->textFieldRow($model,'last_post_id',array('class'=>'span5','maxlength'=>10)); ?>

        <?php echo $form->textFieldRow($model,'poll',array('class'=>'span5')); ?>

        <?php echo $form->textFieldRow($model,'membergroup_id',array('class'=>'span5','maxlength'=>10)); ?>

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'search white', 'label'=>'Pencarian')); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'button', 'icon'=>'icon-remove-sign white', 'label'=>'Reset', 'htmlOptions'=>array('class'=>'btnreset btn-small'))); ?>
</div>

<?php $this->endWidget(); ?>

<script type="text/javascript">
    jQuery(function($) {
        $(".btnreset").click(function() {
            $(":input", "#search-bbii-forum-form").each(function() {
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

