<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'search-Menu-form',
    'action' => Yii::app()->createUrl($this->route),
    'method' => 'get',
        ));
?>






<div class="row">
    <div class="span4 pull-left">
        <?php echo $form->textFieldRow($model, 'name', array('class' => 'span4', 'maxlength' => 45)); ?>
    </div>
    <div class="span4 ">
<?php echo $form->dropDownListRow($model, 'menu_category_id', CHtml::listData(MenuCategory::model()->findAll(array()), 'id', 'name'), array('class' => 'span4', 'empty' => t('choose', 'global'),)); ?>
    </div>
    <div class="span3"></div>
</div>
<div class="form-actions">
<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'type' => 'primary', 'icon' => 'search white', 'label' => 'Pencarian')); ?>
</div>

<?php $this->endWidget(); ?>


<?php
$cs = Yii::app()->getClientScript();
$cs->registerCoreScript('jquery');
$cs->registerCoreScript('jquery.ui');
$cs->registerCssFile(Yii::app()->request->baseUrl . '/css/bootstrap/jquery-ui.css');
?>	
<script type="text/javascript">
    jQuery(function($) {
        $(".btnreset").click(function() {
            $(":input", "#search-Menu-form").each(function() {
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
