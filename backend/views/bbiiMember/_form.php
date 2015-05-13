<div class="form">
    <?php
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'bbii-member-form',
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


        <ul class="nav nav-tabs" id="myTab">
            <li class="active"><a href="#personal">Personal</a></li>
            <li><a href="#public">Public</a></li>
            <li><a href="#business">Business</a></li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane active" id="personal">

                <table>
                    <tr>
                        <td width="300">

                            <?php
//                            $accessSaldo = in_array('saldo', param('menu'));
//                          $imgs = '';
                            $cc = '';
                            if ($model->isNewRecord) {
                                $img = Yii::app()->landa->urlImg('', '', '');
                            } else {
                                $img = Yii::app()->landa->urlImg('avatar/', $model->avatar, $_GET['id']);
                                $del = '<div class="btn-group photo-det-btn">';
                                $imgs = param('urlImg') . '350x350-noimage.jpg';
                                $cc = CHtml::ajaxLink(
                                                '<i class="icon-trash">Remove Photo</i>', url('bbiiMember/removephoto', array('id' => $model->id)), array(
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
                            <br><br><div style="margin-left: -90px;"> <?php echo $form->fileFieldRow($model, 'avatar', array('class' => 'span3')); ?></div>

                        </td>
                        <td style="vertical-align: top;">                                

                            
                                     <?php echo $form->textFieldRow($model, 'username', array('class' => 'span5', 'maxlength' => 20)); ?>

                                <?php echo $form->textFieldRow($model, 'email', array('class' => 'span5', 'maxlength' => 100)); ?>

                                <?php echo $form->passwordFieldRow($model, 'password', array('class' => 'span3', 'maxlength' => 255, 'hint' => 'Fill the password, to change',)); ?>
                                                      

                            <?php echo $form->textFieldRow($model, 'code', array('class' => 'span5', 'maxlength' => 25)); ?>

                            <?php echo $form->textFieldRow($model, 'member_name', array('class' => 'span5', 'maxlength' => 255)); ?> 

                            <?php
                            echo $form->textFieldRow(
                                    $model, 'phone', array('prepend' => '+62')
                            );
                            ?>

                        </td>

                    </tr>
                </table>

            </div> 
            <div class="tab-pane" id="public">



                <?php // echo $form->dropDownListRow($model, 'city_id', CHtml::listData(City::model()->findAll('province_id=:province_id', array(':province_id' => (int) $model->City->province_id)), 'id', 'name'), array('class' => 'span3')); ?>
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
                        ), array('class' => 'span9')
                );
                ?>

                <?php echo $form->dropDownListRow($model, 'gender', array('0' => 'Laki-laki', '1' => 'Perempuan'), array('class' => 'span4')); ?>
                <?php echo $form->toggleButtonRow($model, 'show_online'); ?>
                <?php echo $form->toggleButtonRow($model, 'contact_email'); ?>
                <?php echo $form->toggleButtonRow($model, 'contact_pm'); ?>
                <?php echo $form->toggleButtonRow($model, 'moderator'); ?>


                <?php echo $form->textAreaRow($model, 'address', array('class' => 'span5', 'maxlength' => 255)); ?>

                <?php //echo $form->textFieldRow($model, 'phone', array('class' => 'span5', 'maxlength' => 20));     ?>

            </div>
            <div class="tab-pane" id="business">
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
                        ), array('class' => 'span9')
                );
                ?>
                <?php echo $form->textFieldRow($model, 'type_business', array('class' => 'span5')); ?>
                <?php echo $form->textFieldRow($model, 'company_name', array('class' => 'span5')); ?>
                <?php echo $form->textFieldRow($model, 'facebook', array('class' => 'span2', 'maxlength' => 255, 'prepend' => 'http://www.facebook.com/')); ?>
                <?php echo $form->textFieldRow($model, 'website', array('class' => 'span2', 'maxlength' => 255, 'prepend' => 'http://')); ?>
            </div>


        </div>


        <?php if (!isset($_GET['v'])) { ?>        <div class="form-actions">
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
        <?php } ?>    </fieldset>

    <?php $this->endWidget(); ?>

</div>
