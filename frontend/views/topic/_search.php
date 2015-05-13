<?php  $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
'id'=>'search-bbii-topic-form',
'action'=>Yii::app()->createUrl($this->route),
'method'=>'get',
));  ?>


        <?php echo $form->textFieldRow($model,'id',array('class'=>'span5','maxlength'=>10)); ?>

        <?php echo $form->textFieldRow($model,'forum_id',array('class'=>'span5','maxlength'=>10)); ?>

        <?php echo $form->textFieldRow($model,'user_id',array('class'=>'span5','maxlength'=>10)); ?>

        <?php echo $form->textFieldRow($model,'title',array('class'=>'span5','maxlength'=>255)); ?>

        <?php echo $form->textFieldRow($model,'first_post_id',array('class'=>'span5','maxlength'=>10)); ?>

        <?php echo $form->textFieldRow($model,'last_post_id',array('class'=>'span5','maxlength'=>10)); ?>

        <?php echo $form->textFieldRow($model,'num_replies',array('class'=>'span5','maxlength'=>10)); ?>

        <?php echo $form->textFieldRow($model,'num_views',array('class'=>'span5','maxlength'=>10)); ?>

        <?php echo $form->textFieldRow($model,'approved',array('class'=>'span5')); ?>

        <?php echo $form->textFieldRow($model,'locked',array('class'=>'span5')); ?>

        <?php echo $form->textFieldRow($model,'sticky',array('class'=>'span5')); ?>

        <?php echo $form->textFieldRow($model,'global',array('class'=>'span5')); ?>

        <?php echo $form->textFieldRow($model,'moved',array('class'=>'span5','maxlength'=>10)); ?>

        <?php echo $form->textFieldRow($model,'upvoted',array('class'=>'span5')); ?>

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'search white', 'label'=>'Pencarian')); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'button', 'icon'=>'icon-remove-sign white', 'label'=>'Reset', 'htmlOptions'=>array('class'=>'btnreset btn-small'))); ?>
</div>

<?php $this->endWidget(); ?>

<script type="text/javascript">
    jQuery(function($) {
        $(".btnreset").click(function() {
            $(":input", "#search-bbii-topic-form").each(function() {
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

