<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'search-Article-form',
    'action' => Yii::app()->createUrl($this->route),
    'method' => 'get',
        ));
?>




<?php echo $form->textFieldRow($model, 'title', array('class' => 'span5', 'maxlength' => 45)); ?>

<?php echo $form->dropDownListRow($model, 'article_category_id', CHtml::listData(ArticleCategory::model()->findAll(array('order' => 'root, lft')), 'id', 'nestedname'), array('class' => 'span3', 'empty' => 'All')); ?>
<?php // echo $form->toggleButtonRow($model, 'publish');  ?>

<div class="control-group "><label class="control-label required" for="Article_title">Status <span class="required"></span></label><div class="controls">
        <select class="span2" name="Article[publish]" id="Article_article_category_id">
    <option value="">All</option>
    <option value="1">Publish</option>
    <option value="0">Unpublish</option>
</select>
    </div></div>



<div class="form-actions">
<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'type' => 'primary', 'icon' => 'search white', 'label' => 'Pencarian')); ?>
<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'button', 'icon' => 'icon-remove-sign white', 'label' => 'Reset', 'htmlOptions' => array('class' => 'btnreset btn-small'))); ?>
</div>

<?php $this->endWidget(); ?>


<?php
$cs = Yii::app()->getClientScript();
$cs->registerCoreScript('jquery');
$cs->registerCoreScript('jquery.ui');
$cs->registerCssFile(Yii::app()->request->baseUrl . '/css/bootstrap/jquery-ui.css');
?>	
<script>
    $(".btnreset").click(function() {
        $(":input", "#search-Article-form").each(function() {
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
</script>

