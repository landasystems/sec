<div class="form">
    <?php
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'User-form',
        'enableAjaxValidation' => false,
        'method' => 'post',
        'type' => 'horizontal',
        'htmlOptions' => array(
            'enctype' => 'multipart/form-data'
        )
    ));
//    User::model()->mlm(79,3);
//    trace(json_encode(array('mlm_downline_amount'=>array('le$codeft'=>0,'right'=>0),'mlm_downline'=>array('left'=>null, 'right'=>null))))
    ?>


    <?php echo $form->errorSummary($model, 'Opps!!!', null, array('class' => 'alert alert-error ')); ?> 


    <style>
        .control-label{
            width: 120px !important;
        }
        .controls{
            margin-left: 150px !important;
        }
    </style>

    <div class="well">
        <h4><i class="icon-user"></i> Biodata</h4>
        <?php
        $accessDonation = in_array('donation', param('menu'));
        $accessMlm = in_array('mlm', param('menu'));
        $accessSaldo = in_array('saldo', param('menu'));
        if ($model->isNewRecord == true) { //hanya ada di tambah
            if (isset($listSiteConfig['settings']['register_is_generate_code']) && $listSiteConfig['settings']['register_is_generate_code']) {
                //do nothing
            } else {
                echo $form->textFieldRow($model, 'code', array('class' => 'span6', 'maxlength' => 255));
            }

            if ($accessMlm) {
                if (!empty($code)) {
                    echo CHtml::hiddenField('User[referal_user_code]', $code);
                    $user = User::model()->findByAttributes(array('code' => $code));
                    $c = (isset($user->name)) ? $user->name : '';
                    echo'<div class="control-group">
            <label class="control-label">Referal Anda</label>
            <div class="controls">
                <b>' . $c . '</b>
            </div>
        </div>';
                } else {
                    echo'<div class="control-group">
            <label class="control-label">Referal Anda</label>
            <div class="controls">
                <b>' . $codeRandom->name . '</b>
            </div>
        </div>';
                    echo'<input type="hidden" name="User[referal_user_code]" value="' . $codeRandom->code . '">';
                }
            }
        }
        ?> 

        <?php echo $form->textFieldRow($model, 'name', array('class' => 'span6', 'maxlength' => 255)); ?> 
        <?php echo $form->textFieldRow($model, 'username', array('class' => 'span6', 'maxlength' => 20)); ?>
        <?php echo $form->textFieldRow($model, 'email', array('class' => 'span6', 'maxlength' => 100)); ?>
        <?php echo $form->passwordFieldRow($model, 'password', array('class' => 'span6', 'maxlength' => 255, 'hint' => 'Fill the password, to change',)); ?>

        <?php
        echo $form->textFieldRow(
                $model, 'phone', array('prepend' => '+62', 'class' => 'span')
        );
        ?>
        <?php echo $form->datePickerRow($model, 'birth', array('class' => 'span4', 'style' => 'height:30px;', 'options' => array('showDropdowns' => true, 'format' => 'd/m/yyyy'))); ?>
    </div>

    <?php
    if ($accessMlm || $accessSaldo) {
        $others = json_decode($model->others, true);
        $bank_name = (isset($others['bank_name'])) ? $others['bank_name'] : '';
        $bank_account = (isset($others['bank_account'])) ? $others['bank_account'] : '';
        $bank_account_name = (isset($others['bank_account_name'])) ? $others['bank_account_name'] : '';

        echo'<div class="well">
        <h4><i class="icon-user"></i> Informasi Bank</h4>';
        echo'<div class="control-group">
            <label class="control-label" for="inputEmail">Bank</label>
            <div class="controls">';
        echo CHtml::dropDownList('User[bank_name]', $bank_name, array('BCA' => 'BCA', 'Mandiri' => 'Mandiri', 'BNI' => 'BNI', 'Muamalat' => 'Muamalat','BRI'=>'BRI'), array('empty' => 'Select Bank'));
        echo'</div>
        </div>
        <div class="control-group">
            <label class="control-label" for="inputEmail">Nomor Rekening</label>
            <div class="controls">
                <input style="height:30px;" class="span4" type="text" id="User[bank_account]" name="User[bank_account]" value="' . $bank_account . '">

            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="inputEmail">Pemilik Rekening</label>
            <div class="controls">
                <input style="height:30px;" class="span4" type="text" id="User[bank_account_name]" name="User[bank_account_name]" value="' . $bank_account_name . '">
            </div>
        </div>';
    }
    echo'';
    ?>

    <div class="well">
        <h4><i class="icon-envelope"></i> Informasi Lengkap</h4>
        <div class="control-group ">
            <label class="control-label required">Provinsi</label>
            <div class="controls">
                <?php
                echo CHtml::dropDownList('province_id', $model->City->province_id, CHtml::listData(Province::model()->findAll(), 'id', 'name'), array(
                    'empty' => t('choose', 'global'),
                    'ajax' => array(
                        'type' => 'POST',
                        'url' => CController::createUrl('City/dynacities'),
                        'update' => '#User_city_id',
                    ),
                ));
                ?>  
            </div>
        </div>

        <?php echo $form->dropDownListRow($model, 'city_id', CHtml::listData(City::model()->findAll('province_id=:province_id', array(':province_id' => (int) $model->City->province_id)), 'id', 'name'), array('class' => 'span6', 'labelOptions' => array('label' => 'Kabupaten/ Kota'))); ?>

        <?php
        echo $form->textAreaRow(
                $model, 'address', array('class' => 'span4', 'rows' => 5)
        );
        ?>

        <div class="control-group ">
            <label class="control-label required">Avatar Image</label>
            <div class="controls">
                <?php
                $img = Yii::app()->landa->urlImg('avatar/', $model->avatar_img, Yii::app()->user->id);
                echo '<img src="' . $img['small'] . '" alt="" class="image img-rounded img-polaroid"  /> ';
                ?>
                <br><br><div> <?php echo $form->fileFieldRow($model, 'avatar_img', array('class' => 'span6', 'label' => false)); ?></div>
            </div>
        </div>
        <?php if (CCaptcha::checkRequirements()): ?>
            <div class="control-group ">
                <h5><?php //echo $form->labelEx($model, 'verifyCode');               ?></h5>
                <?php $this->widget('CCaptcha'); ?>

                <?php echo $form->error($model, 'verifyCode'); ?>



                <label class="control-label required" for="Testimonial_email"> <span class="required">*</span></label><div class="controls"><?php echo $form->textField($model, 'verifyCode'); ?></div></div>
        <?php endif; ?>
    </div>

    <div class="form-actions">
        <?php
        $this->widget(
                'bootstrap.widgets.TbButtonGroup', array(
            'buttons' => array(
                array(
                    'buttonType' => 'button',
                    'url' => 'login',
                    'label' => 'Login',
                    'icon' => 'icon-user',
                    'htmlOptions' => array('onclick' => 'window.location=\'' . url('login') . '\''),
                ),
            ),
                )
        );
        ?>

        <?php
        $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType' => 'submit',
            'type' => 'primary',
            'icon' => 'ok white',
            'label' => $model->isNewRecord ? 'Register' : 'Simpan',
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


    <?php $this->endWidget(); ?>

</div>
