<div class="form">
    <?php
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'Menu-form',
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


        <div class="control-group ">
            <label class="control-label">Type </label>
            <div class="controls">
                <?php $this->beginWidget('bootstrap.widgets.TbModal', array('id' => 'myModal')); ?>

                <div class="modal-header">
                    <a class="close" data-dismiss="modal">&times;</a>
                    <h4>Tipe Menu</h4>
                </div>

                <div class="modal-body">
                    <?php
                    $this->widget('zii.widgets.CMenu', array('items' => Menu::model()->menuType));
                    ?>
                </div>

                <?php $this->endWidget(); ?>
                <?php
                if (isset($_GET['type'])) {
                    echo $form->textField($model, 'type', array('class' => 'span2', 'disabled' => true));
                }

                $this->widget('bootstrap.widgets.TbButton', array(
                    'label' => Yii::t('global', 'choose'),
                    'type' => 'primary',
                    'htmlOptions' => array(
                        'data-toggle' => 'modal',
                        'data-target' => '#myModal',
                    ),
                ));
                ?>

            </div>
        </div>

        <?php echo $form->textFieldRow($model, 'name', array('class' => 'span5', 'maxlength' => 45)); ?>
        <?php echo $form->textFieldRow($model, 'alias', array('class' => 'span5', 'maxlength' => 45)); ?>

        <div class="control-group ">
            <label class="control-label">Parent Menu</label>
            <div class="controls">
                <?php echo CHtml::dropDownList('Menu[parent_id]', $model->parent_id, CHtml::listData(Menu::model()->findAll(array('order' => 'root, lft')), 'id', 'nestedname'), array('class' => 'span3', 'empty' => 'root')); ?>
            </div>
        </div>

        <?php echo $form->textFieldRow($model, 'ordering', array('class' => 'span5', 'maxlength' => 45)); ?>
        <?php echo $form->dropdownListRow($model, 'access', array('all'=>'All','login'=>'Just for User Login','guest'=>'Guest (Not Logged)') + CHtml::listData(User::model()->roles(), 'name', 'name')); ?>

        <?php /* echo CHtml::dropDownList('type', 'type', Site::model()->getCmbFeatured(), array('class' => 'span3', 'empty' => Yii::t('global','choose') ,
          'ajax' => array(
          'type' => 'POST',
          'url' => CController::createUrl('Menu/typeParam'),
          'update' => '#typeContent',
          ), )); */ ?>



        <?php echo $form->dropDownListRow($model, 'menu_category_id', CHtml::listData(MenuCategory::model()->findAll(), 'id', 'name'), array('class' => 'span3')); ?>

        <?php
        if (isset($_GET['type'])) {
            $model->param = json_decode($model->param,true);
            echo $this->renderPartial('_type_' . $_GET['type'], array('model' => $model, 'form' => $form));
        }
        ?>




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
