<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'search-bbii-post-form',
    'action' => Yii::app()->createUrl($this->route),
    'method' => 'get',
        ));
?>
<div class="row">   
    <div class="span4">
       <?php echo $form->dropDownListRow($model, 'forum_id', CHtml::listData(BbiiForum::model()->FindAll(), 'id', 'name'), array('class' => 'span4', 'empty' => t('choose', 'global'),)); ?>
    </div>

    <div class="span4" style="padding-left: 90px;">
<?php
$data = array(0 => t('choose', 'global')) + CHtml::listData(BbiiMember::model()->findAll(array()), 'id', 'member_name');
echo $form->select2Row($model, 'user_id', array(
    'asDropDownList' => true,
    'data' => $data,
    'options' => array(
        "placeholder" => t('choose', 'global'),
        "allowClear" => true,
        'width' => '100%',
    ),
        ), array('class' => 'span4')
);
?>
    </div>
</div>

<?php // echo $form->dropDownListRow($model, 'user_id', CHtml::listData(BbiiMember::model()->FindAll(), 'id', 'member_name'), array('class' => 'span4','empty' => t('choose', 'global'),)); ?>


<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'type' => 'primary', 'icon' => 'search white', 'label' => 'Pencarian')); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'button', 'icon' => 'icon-remove-sign white', 'label' => 'Reset', 'htmlOptions' => array('class' => 'btnreset btn-small'))); ?>
</div>

<?php $this->endWidget(); ?>

<script type="text/javascript">
    jQuery(function($) {
        $(".btnreset").click(function() {
            $(":input", "#search-bbii-post-form").each(function() {
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

