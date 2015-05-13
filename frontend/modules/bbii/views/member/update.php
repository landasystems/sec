<?php
/* @var $this ForumController */
/* @var $model BbiiMember */

$this->bbii_breadcrumbs = array(
    Yii::t('BbiiModule.bbii', 'Forum') => array('forum/index'),
    Yii::t('BbiiModule.bbii', 'Members') => array('member/index'),
    $model->member_name . Yii::t('BbiiModule.bbii', '\'s profile') => array('member/view', 'id' => $model->id),
    Yii::t('BbiiModule.bbii', 'Update')
);

//$item = array(
//    array('label' => Yii::t('BbiiModule.bbii', 'Forum'), 'url' => array('forum/index')),
//    array('label' => Yii::t('BbiiModule.bbii', 'Members'), 'url' => array('member/index')),
//    array('label' => Yii::t('BbiiModule.bbii', 'Approval'), 'url' => array('moderator/approval'), 'visible' => $this->isModerator()),
//    array('label' => Yii::t('BbiiModule.bbii', 'Posts'), 'url' => array('moderator/admin'), 'visible' => $this->isModerator()),
//);
?>
<style>
    input#BbiiMember_member_name, input#BbiiMember_username, input#BbiiMember_password, input#BbiiMember_email,
    input#BbiiMember_code, input#BbiiMember_phone, input#BbiiMember_type_business, input#BbiiMember_company_name,
    input#BbiiMember_facebook,input#BbiiMember_website,input#BbiiMember_pin{
        border-radius: 2px;
        box-shadow: none;
        border: none;
        text-shadow: 1px 1px 0 rgba(256,256,256,1.0);
        background: #fff;
        border: 1px solid #999;
        padding: 10px;
        font-size: 14px;
        color: #000;
        font-family: 'Open Sans Light', sans-serif;
        margin-bottom: 10px;
        width: 60%;
        height: 32px;
    }
    input#BbiiMember_birthdate{
        border-radius: 2px;
        box-shadow: none;
        border: none;
        text-shadow: 1px 1px 0 rgba(256,256,256,1.0);
        background: #fff;
        border: 1px solid #999;
        padding: 16px;
        font-size: 14px;
        color: #000;
        font-family: 'Open Sans Light', sans-serif;
        margin-bottom: 10px;
        width: 40%;
    }
    select {
        border-radius: 2px;
        border: 1px solid #999;
    }
    .labelRight {
        width: 54px !important;
    }
</style>
<div id="bbii-wrapper" class="well">
    <?php // echo $this->renderPartial('_header', array('item' => $item)); ?>

    <div class="" style='margin-top: 0px;'>

        <?php
        $form = $this->beginWidget(
                'bootstrap.widgets.TbActiveForm', array(
            'id' => 'horizontal',
            'type' => 'horizontal',
            'enableAjaxValidation' => false,
            'htmlOptions' => array(
                'class' => 'form-horizontal',
                'enctype' => 'multipart/form-data'),
                )
        );
        ?>
        <p class="note"><?php echo Yii::t('BbiiModule.bbii', 'Fields with <span class="required">*</span> are required.'); ?></p>
        <?php echo $form->errorSummary($model); ?>
        <div id="yw1">
            <ul id="yw2" class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#yw1_tab_1">Profil</a></li>
                 <li class=""><a data-toggle="tab" href="#yw1_tab_3">Keterangan Usaha</a></li>
                <li class=""><a data-toggle="tab" href="#yw1_tab_2">Setting Akun</a></li>
               
            </ul>
            <div class="tab-content">
                <div id="yw1_tab_1" class="tab-pane fade active in" style='padding:20px;'>
                    <?php echo $form->textFieldRow($model, 'member_name', array('class' => 'span5',)); ?>
                    <?php if ($this->isModerator() or $this->isAdmin()): ?>
                        <?php echo $form->dropDownListRow($model, 'group_id', CHtml::listData(BbiiMembergroup::model()->findAll(), 'id', 'name'), array('class' => 'span3')); ?>
                    <?php endif; ?>
                    <?php echo $form->textFieldRow($model, 'username', array('maxlength' => 255, 'class' => 'span5')); ?>
                    <?php
                    $model->password = "";
                    echo $form->passwordFieldRow($model, 'password', array('maxlength' => 255, 'class' => 'span4','placeholder'=>'Kosongi jika tidak ada perubahan'));
                    ?>
                    <?php echo $form->dropDownListRow($model, 'gender', array('' => '', '0' => Yii::t('BbiiModule.bbii', 'Laki'), '1' => Yii::t('BbiiModule.bbii', 'Perempuan')), array('class' => 'span4')); ?>
                    <?php echo $form->textFieldRow($model, 'email', array('maxlength' => 255, 'class' => 'span5')); ?>
                    <?php // echo $form->textFieldRow($model, 'code', array('maxlength' => 255, 'class' => 'span3')); ?>
                    <?php echo $form->textFieldRow($model, 'pin', array('maxlength' => 255, 'class' => 'span3')); ?>
                    <?php echo $form->textFieldRow($model, 'phone', array('maxlength' => 255, 'class' => 'span3')); ?>

                    <?php
                    $data = array(0 => t('choose', 'global')) + CHtml::listData(City::model()->findAll(array('condition' => 'province_id=5')), 'id', 'name');
                    echo $form->select2Row($model, 'city_id', array(
                        'asDropDownList' => true,
                        'data' => $data,
                        'options' => array(
                            "placeholder" => t('choose', 'global'),
                            "allowClear" => true,
                            'width' => '60%',
                        ),
                            ), array('class' => 'span9')
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
                            'width' => '60%',
                        ),
                            ), array('class' => 'span9')
                    );
                    ?>
                    <?php echo $form->textFieldRow($model, 'type_business', array('class' => 'span5')); ?>
                    <?php echo $form->textFieldRow($model, 'company_name', array('class' => 'span5')); ?>
                    <?php
                    echo $form->datepickerRow(
                            $model, 'birthdate', array(
                            ), array(
                        'prepend' => '<i class="icon-calendar"></i>'
                            )
                    );
                    ?>
                    <?php
//                    echo $form->datepickerRow(
//                            $model, 'birthdate', array(
//                            ), array(
//                        'prepend' => '<i class="icon-calendar"></i>'
//                            )
//                    );
                    ?>

                    <?php echo $form->textAreaRow($model, 'address', array('maxlength' => 255, 'class' => 'span8','rows'=>5,'cols'=>8)); ?>
                    <?php // echo $form->textAreaRow($model, 'signature', array('maxlength' => 255, 'class' => 'span8','rows'=>5,'cols'=>8)); ?>
                </div>
                <div id="yw1_tab_3" class="tab-pane fade" style='padding:20px;'>
                    <?php echo $form->ckEditorRow($model, 'signature', array('label'=>false,'options' => array('fullpage' => 'js:true', 'filebrowserBrowseUrl' => $this->createUrl("fileManager/indexBlank")))); ?>
                </div>
                <div id="yw1_tab_2" class="tab-pane fade" style='padding:20px;'>
                    <?php echo $form->toggleButtonRow($model, 'show_online'); ?>
                    <?php echo $form->toggleButtonRow($model, 'contact_email'); ?>
                    <?php echo $form->toggleButtonRow($model, 'contact_pm'); ?>
                    <?php echo $form->textFieldRow($model, 'facebook', array('maxlength' => 255, 'placeholder' => 'https://www.facebook.com/budi')); ?>
                    <?php echo $form->textFieldRow($model, 'website', array('maxlength' => 255, 'placeholder' => 'www.namawebsite.com'), array('prepend' => CHtml::image($this->module->getRegisteredImage('Website.png'), 'Website', array('style' => 'vertical-align:middle')))); ?>

                    <div class="control-group">
                        <label class="control-label">Avatar</label>
                        <div class="controls">
                            <img align="left" style="" src="<?php echo $model->imgUrl['small'] ?>" alt="avatar"><br>
                            
                           <?php // echo $form->fileFieldRow($model, 'avatar', array('class' => 'span3','label'=>false)); ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label"></label>
                        <div class="controls">
                            <span style="font-size:11px"><i>Ukuran file avatar yang bisa diupload maksimum 500 KB.</i></span>
                           <?php echo $form->fileFieldRow($model, 'avatar', array('class' => 'span3','label'=>false)); ?>
                        </div>
                    </div>

                </div>
                </div>
        </div>
        <div class="form-actions">
            <?php
            $this->widget(
                    'bootstrap.widgets.TbButton', array(
                'buttonType' => 'submit',
                'type' => 'primary',
                'label' => 'Save'
                    )
            );
            ?>

            <?php $this->endWidget(); ?>

        </div><!-- form -->
    </div>
</div>