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
    ?>
    <fieldset>
        <legend>
            <p class="note">Fields dengan <span class="required">*</span> harus di isi.</p>
        </legend>

        <?php echo $form->errorSummary($model, 'Opps!!!', null, array('class' => 'alert alert-error span12')); ?>
        <div class="clearfix"></div>

        <div class="box">
            <div class="title">
                <h4>
                    <?php
                    echo 'Hak Akses Sebagai<span class="required">*</span> :    ';
                    if ($model->id == User()->id) { //if same id, cannot change role it self
                        $listRoles = Roles::model()->listRoles();
                        if (User()->roles_id == -1) {
                            echo 'Super User';
                        } elseif (isset($listRoles[User()->roles_id])) {
                            echo $listRoles[User()->roles_id]['name'];
                        }
                    } else {
                        $array = Roles::model()->listRole($type);
                      
//                        if(!empty($array)){
                        echo CHtml::dropDownList('User[roles_id]', $model->roles_id, CHtml::listData($array, 'id', 'name'), array(
                            'empty' => t('choose', 'global'),
                            'ajax' => array('url' => url('user/AllowLogin'),
                                'type' => 'POST',
                                'success' => 'function(data){
                                            if (data=="0")
                                                $(".notAllow").fadeOut();
                                            else
                                                $(".notAllow").fadeIn();                                                                                        
                                        }'),
                        ));
//                        }else{
//                            echo'Data is empty please insert data group '.$type.'.';
//                        }
                    }
                    ?>  
                </h4>
            </div>
        </div>

        <ul class="nav nav-tabs" id="myTab">
            <li class="active"><a href="#personal">Personal</a></li>
            <li><a href="#public">Public</a></li>
            <li><a href="#bank">Bank Information</a></li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane active" id="personal">

                <table>
                    <tr>
                        <td width="300">

                            <?php
                            $accessSaldo = in_array('saldo', param('menu'));
//                          $imgs = '';
                            $cc = '';
                            if ($model->isNewRecord) {
                                $img = Yii::app()->landa->urlImg('', '', '');
                            } else {
                                $img = Yii::app()->landa->urlImg('avatar/', $model->avatar_img, $_GET['id']);
                                $del = '<div class="btn-group photo-det-btn">';
                                $imgs = param('urlImg') . '350x350-noimage.jpg';
                                $cc = CHtml::ajaxLink(
                                                '<i class="icon-trash">Remove Photo</i>', url('user/removephoto', array('id' => $model->id)), array(
                                            'type' => 'POST',
                                            'success' => 'function( data )
                                                    {
                                                           $("#my_image").attr("src","' . $imgs . '");
                                                           $("#yt0").fadeOut();
                                                    }'), array('class' => 'btn btn-large btn-block btn-primary', 'style' => 'width: 360px;font-size: 15px;')
                                        )
                                        . '</div>';
                            }
                            echo '<img src="' . $img['medium'] . '" alt="" class="image img-polaroid" id="my_image"  /> ';
                            echo $cc;
                            ?>
                            <br><br><div style="margin-left: -90px;"> <?php echo $form->fileFieldRow($model, 'avatar_img', array('class' => 'span3')); ?></div>

                        </td>
                        <td style="vertical-align: top;">                                

                            <div class="notAllow" style="display: <?php
                            if ($model->scenario == 'notAllow')
                                echo 'none';
                            else
                                echo '';
                            ?>">
                                     <?php echo $form->textFieldRow($model, 'username', array('class' => 'span5', 'maxlength' => 20)); ?>

                                <?php echo $form->textFieldRow($model, 'email', array('class' => 'span5', 'maxlength' => 100)); ?>

                                <?php echo $form->passwordFieldRow($model, 'password', array('class' => 'span3', 'maxlength' => 255, 'hint' => 'Fill the password, to change',)); ?>
                            </div>                            

                            <?php echo $form->textFieldRow($model, 'code', array('class' => 'span5', 'maxlength' => 25)); ?>

                            <?php echo $form->textFieldRow($model, 'name', array('class' => 'span5', 'maxlength' => 255)); ?> 
                            <?php
                            if ($accessSaldo) {
                                ?>
                                <div class="control-group ">
                                    <label class="control-label">Saldo</label>
                                    <div class="controls">
                                        <?php echo landa()->rp($model->saldo) ?>
                                    </div>        
                                </div>
                            <?php } ?>

                            <?php echo $form->toggleButtonRow($model, 'enabled'); ?>
                            <?php
                            echo $form->textFieldRow(
                                    $model, 'phone', array('prepend' => '+62')
                            );
                            ?>
                            <?php
                            echo $form->textAreaRow(
                                    $model, 'description', array('class' => 'span4', 'rows' => 5)
                            );
                            ?>
                        </td>

                    </tr>
                </table>

            </div> 
            <div class="tab-pane" id="public">
                <div class="control-group ">
                    <?php
                    echo CHtml::activeLabel($model, 'province_id', array('class' => 'control-label'));
                    ?>
                    <div class="controls">
                        <?php
                        echo CHtml::dropDownList('province_id', $model->City->province_id, CHtml::listData(Province::model()->findAll(), 'id', 'name'), array(
                            'empty' => t('choose', 'global'),
                            'ajax' => array(
                                'type' => 'POST',
                                'url' => CController::createUrl('landa/city/dynacities'),
                                'update' => '#s2id_User_city_id',
                            ),
                        ));
                        ?>  
                    </div>
                </div>


                <?php // echo $form->dropDownListRow($model, 'city_id', CHtml::listData(City::model()->findAll('province_id=:province_id', array(':province_id' => (int) $model->City->province_id)), 'id', 'name'), array('class' => 'span3')); ?>
                <?php
                         $data = array(0 => t('choose', 'global')) + CHtml::listData(City::model()->findAll('province_id=:province_id', array(':province_id' => (int) $model->City->province_id)), 'id', 'name');
                    echo $form->select2Row($model, 'city_id', array(
                        'asDropDownList' => true,
                        'data' => $data,
                        'options' => array(
                            "placeholder" => t('choose', 'global'),
                            "allowClear" => true,
                            'width' => '100%',
                        ),
                            ), array('class' => 'span9')
                    );
                ?>


                <?php echo $form->textAreaRow($model, 'address', array('class' => 'span5', 'maxlength' => 255)); ?>

                <?php //echo $form->textFieldRow($model, 'phone', array('class' => 'span5', 'maxlength' => 20));     ?>

            </div>
            <div class="tab-pane" id="bank">
                <?php
                if ($model->isNewRecord == false) {
                    $others = json_decode($model->others, true);
                    $bank_name = (isset($others['bank_name'])) ? $others['bank_name'] : '';
                    $bank_account = (isset($others['bank_account'])) ? $others['bank_account'] : '';
                    $bank_account_name = (isset($others['bank_account_name'])) ? $others['bank_account_name'] : '';
                    echo'<div class="control-group">
            <label class="control-label" for="inputEmail">Bank Name</label>
            <div class="controls">
                <input style="height:30px;" type="text" id="User[bank_name]" name="User[bank_name]" value="' . $bank_name . '">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="inputEmail">Bank Account</label>
            <div class="controls">
                <input style="height:30px;" type="text" id="User[bank_account]" name="User[bank_account]" value="' . $bank_account . '">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="inputEmail">Bank Account Name</label>
            <div class="controls">
                <input style="height:30px;" type="text" id="User[bank_account_name]" name="User[bank_account_name]" value="' . $bank_account_name . '">
            </div>
        </div>';
                } else {
                    ?>
                    <?php ?>
                    <div class="control-group">
                        <label class="control-label" for="inputEmail">Bank Name</label>
                        <div class="controls">
                            <input style="height:px;" type="text" id="User[bank_name]" name="User[bank_name]" placeholder="Bank Name">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="inputEmail">Bank Account</label>
                        <div class="controls">
                            <input style="height:px;" type="text" id="User[bank_account]" name="User[bank_account]" placeholder="Bank Account">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="inputEmail">Bank Account Name</label>
                        <div class="controls">
                            <input style="height:px;" type="text" id="User[bank_account_name]" name="User[bank_account_name]" placeholder="Bank Account Name">
                        </div>
                    </div>
                    <?php
                }
                ?>
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
