<div class="form">
    <?php
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'roles-form',
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

        <?php echo $form->textFieldRow($model, 'name', array('class' => 'span5', 'maxlength' => 255)); ?>
        <?php
        ?>
        <?php
        echo $form->toggleButtonRow($model, 'is_allow_login', array(
            'onChange' => '
                            if($("#Roles_is_allow_login").prop("checked")){
                            $(".elek").show();
                            }else{
                            $(".elek").hide();
                            }'
        ));
        $class = ($model->is_allow_login == 1) ? 'block' : 'none';
        ?>

        <div class="well elek" style="display:<?php echo $class ?>;">
            <ul class="nav nav-tabs" id="myTab">
                <li class="active"><a href="#module" data-toggle="tab">Module</a></li>
                <li><a href="#extended" data-toggle="tab">Extended</a></li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane active" id="module">
                    <table class="table">
                        <thead> 
                            <tr>
                                <th></th>
                                <th>Read</th>
                                <th>Create</th>
                                <th>Update</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $arrMenu = Auth::model()->modules();
                            $mAuth = Auth::model()->findAll(array('index' => 'id', 'select' => 'id,crud'));

                            if ($model->isNewRecord == false) {
                                $mRolesAuth = RolesAuth::model()->findAll(array('condition' => 'roles_id=' . $model->id, 'select' => 'id,auth_id,crud', 'index' => 'auth_id'));
                            } else {
                                $mRolesAuth = array();
                            }
                            $this->renderPartial('_menuSub', array('arrMenu' => $arrMenu, 'mRolesAuth' => $mRolesAuth, 'mAuth' => $mAuth, 'model' => $model, 'space' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'));
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane" id="extended">
                    <table class="table">
                        <thead> 
                            <tr>
                                <th>Permission</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <?php
                        if (in_array('accounting', param('menu'))) {
                            ?>
                            <tr>
                                <td width="40%">Approval Admin</td>
                                <td width="10"><b>:</b></td>
                                <td>
                                    <?php
                                    if (isset($mRolesAuth['AccApprovalAdmin'])) {
                                        $arrRolesAuth = json_decode($mRolesAuth['AccApprovalAdmin']->crud, true);
                                        $rValue = (isset($arrRolesAuth['r']) && $arrRolesAuth['r'] == 1) ? 1 : 0;
                                    } else {
                                        $rValue = 0;
                                    }
                                    echo '<input type="hidden" name="auth_id[]" value="AccApprovalAdmin"/>';
                                    echo CHtml::CheckBox('AccApprovalAdmin[r]', $rValue)
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td width="40%">Approval (Pimpinan)</td>
                                <td width="10"><b>:</b></td>
                                <td>
                                    <?php
                                    if (isset($mRolesAuth['AccApproval'])) {
                                        $arrRolesAuth = json_decode($mRolesAuth['AccApproval']->crud, true);
                                        $rValue = (isset($arrRolesAuth['r']) && $arrRolesAuth['r'] == 1) ? 1 : 0;
                                    } else {
                                        $rValue = 0;
                                    }
                                    echo '<input type="hidden" name="auth_id[]" value="AccApproval"/>';
                                    echo CHtml::CheckBox('AccApproval[r]', $rValue)
                                    ?>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </table>
                </div>
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
