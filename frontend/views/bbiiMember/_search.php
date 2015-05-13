<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'search-bbii-member-form',
    'action' => Yii::app()->createUrl($this->route),
    'method' => 'get',
        ));
?>

<div class="row">   
    <div class="span4">
        <?php echo $form->textFieldRow($model, 'code', array('class' => 'span4', 'maxlength' => 255)); ?>
        <?php echo $form->textFieldRow($model, 'member_name', array('class' => 'span4', 'maxlength' => 255)); ?>
        <?php // echo $form->textFieldRow($model,'city_id',array('class'=>'span4'));  ?>
        <div class="control-group ">
          
            <div class="controls">
                <?php
               
                $data = array(0 => t('choose', 'global')) + CHtml::listData(City::model()->findAll(array('condition' => 'province_id=5')), 'id', 'name');
                echo $form->select2Row($model, 'city_id', array(
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
                <?php
                $data = array(0 => t('choose', 'global')) + CHtml::listData(BusinessCategory::model()->findAll(array()), 'id', 'name');
                echo $form->select2Row($model, 'business_id', array(
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
        <?php // echo $form->dropDownListRow($model, 'city_id', array(), array('class' => 'span3')); ?>
    </div>

    <div class="span4" style="padding-left: 90px;">

        <?php echo $form->textFieldRow($model, 'email', array('class' => 'span4', 'maxlength' => 100)); ?>
        <?php
        echo $form->textFieldRow(
                $model, 'phone', array('prepend' => '+62')
        );
        ?>
        <?php echo $form->textAreaRow($model, 'address', array('class' => 'span5', 'maxlength' => 255)); ?>
    </div>
</div>


<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'type' => 'primary', 'icon' => 'search white', 'label' => 'Pencarian')); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'button', 'icon' => 'icon-remove-sign white', 'label' => 'Reset', 'htmlOptions' => array('class' => 'btnreset btn-small'))); ?>
</div>

<?php $this->endWidget(); ?>

<script type="text/javascript">
    jQuery(function($) {
        $(".btnreset").click(function() {
            $(":input", "#search-bbii-member-form").each(function() {
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

