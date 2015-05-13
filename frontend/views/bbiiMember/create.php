<?php
$this->setPageTitle('Tambah Bbii Members');
$this->breadcrumbs = array(
    'Bbii Members' => array('index'),
    'Create',
);
?>

<?php
//
//$this->beginWidget('zii.widgets.CPortlet', array(
//    'htmlOptions' => array(
//        'class' => ''
//    )
//));
//$this->widget('bootstrap.widgets.TbMenu', array(
//    'type' => 'pills',
//    'items' => array(
//        array('label' => 'Tambah', 'icon' => 'icon-plus', 'url' => Yii::app()->controller->createUrl('create'), 'active' => true, 'linkOptions' => array()),
//        array('label' => 'List Data', 'icon' => 'icon-th-list', 'url' => Yii::app()->controller->createUrl('index'), 'linkOptions' => array()),
//    ),
//));
//$this->endWidget();
?>

<?php // echo $this->renderPartial('_form', array('model'=>$model));  ?>
<style>
    input#semail {
        width: 35%;
        height: 35px;
        padding: 10px 36px 10px 15px;
        border: 1px solid #e5e5e5;
        font-size: 14px;
        /*float: left;*/
        border-radius: 2px;
        -moz-border-radius: 2px;
        -webkit-border-radius: 2px;
        margin-top: 10px;
    }
    input#filename {
        height: 25px;
        padding: 10px 36px 10px 15px;
        border: 1px solid #e5e5e5;
        font-size: 14px;
        /*float: left;*/
        border-radius: 2px;
        -moz-border-radius: 2px;
        -webkit-border-radius: 2px;
    }
</style>
<form enctype="multipart/form-data" style="text-align: center;" id="user-form"  method="post">
    <input type="text" id="semail" name="code" placeholder="Masukan NBA anda" onkeyup="angka(this);" /> &nbsp;
    <a  type="submit" id="ssubmit" onCLick="send();
            return false;"class="btn btn-warning"><i class='icon-ok'></i> Cek Data</a>
    <!--<input type="submit" id="ssubmit" onCLick="send();return false;" name="subscribe" value="<i class='icon-ok'></i> Cek Data" class="btn btn-warning" />-->

</form>
<p style="color: darkolivegreen;text-align: center;">*Apabila anda belum mengetahui NBA anda, silahkan datang ke kantor CU Sawiran terdekat</p>
<div class="form-wrapper3"  >
    <div class="alert alert-info" style="display: none" id="gagal">
        Silahkan melanjutkan ke proses selanjutnya.
    </div>
    <div class="alert alert-warning" style="display: none" id="berhasil">
        Maaf anda belum terdaftar di anggota CU Sawiran.
    </div>
    <div class="alert alert-success" style="display: none" id="terdaftar">
        Maaf NBA tersebut sudah terdaftar.
    </div>


</div>
<div class='well'>
    <?php
//    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
//        'id' => 'bbii-member-form',
//        'enableAjaxValidation' => true,
//        'action' => url('bbiiMember/create'),
//        'method' => 'post',
//        'type' => 'horizontal',
//        'enableClientValidation' => true,
//        'clientOptions' => array(
//            'validateOnSubmit' => true,
//        ),
//        'htmlOptions' => array(
//            'enctype' => 'multipart/form-data'
//        )
//    ));
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'bbii-member-form',
        'enableAjaxValidation' => false,
        'action' => url('bbiiMember/create'),
        'enableClientValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
        'method' => 'post',
        'type' => 'horizontal',
        'htmlOptions' => array(
            'enctype' => 'multipart/form-data'
        )
    ));
    ?>

    <div class='row'>
        <div class='span6'>
            <?php echo $form->hiddenField($model, 'username', array('class' => 'span12',)); ?>     
            <?php echo $form->hiddenField($model, 'code', array('class' => 'span12',)); ?>     
            <?php echo $form->textFieldRow($model, 'member_name', array('class' => 'span12', 'readonly' => true)); ?>


            <?php echo $form->textFieldRow($model, 'phone', array('class' => 'span12', 'readonly' => true, 'onkeyup' => 'angka(this)')); ?>
            <?php echo $form->textFieldRow($model, 'pin', array('class' => 'span12', 'readonly' => true,'label'=>'pin BB')); ?>

            <div class="control-group ">
                <label class="control-label required" for="BbiiMember_password">Kategori Usaha </label>
                <div class="controls">
                    <?php
                    echo CHtml::dropDownList('business_id', $model, CHtml::listData(BusinessCategory::model()->findAll(), 'id', 'name'), array('disabled' => true));
                    ?> 
                </div></div>
            <?php echo $form->textFieldRow($model, 'company_name', array('class' => 'span12', 'readonly' => true)); ?>

            <?php echo $form->textAreaRow($model, 'address', array('class' => 'span5', 'style' => 'width:90%', 'maxlength' => 255)); ?>
        </div>
        <div class='span6'>
            <?php echo $form->passwordFieldRow($model, 'password', array('class' => 'span12', 'readonly' => true)); ?>
            <?php echo $form->textFieldRow($model, 'email', array('class' => 'span12', 'readonly' => true)); ?>
            <div class="control-group ">
                <label class="control-label required" for="BbiiMember_password">Profile </label>
                <div class="controls">
                    <input type="file" id="browse" name="BbiiMember[avatar]" style="display: none" onChange="Handlechange();"/>
                    <input type="text" id="filename" class='span8' readonly="true" placeholder="Gambar Profile" style=""/>
                    <input type="button" class="btn-warning" value="Pilih Foto Profile" id="fakeBrowse" onclick="HandleBrowseClick();" /><br>
                    <span style="font-size:11px"><i>Ukuran file avatar yang bisa diupload maksimum 500 KB.</i></span>
                </div></div>
            <?php echo $form->textFieldRow($model, 'type_business', array('class' => 'span12', 'readonly' => true)); ?>

            <div class="control-group ">
                <label class="control-label required" for="BbiiMember_password">Kota/Kab </label>
                <div class="controls">
                    <?php
                    echo CHtml::dropDownList('city_id', $model, CHtml::listData(City::model()->findAll(array('condition' => 'province_id=5')), 'id', 'name'), array('empty' => 'Pilih Kota/Kab'));
                    ?>
                </div></div>
            <div id="captcha">

                <div class="control-group ">
                    
                    <div class="controls">
                        <?php $this->widget('CCaptcha', array('captchaAction' => 'bbiiMember/captcha')); ?>

                    <?php echo $form->error($model, 'verifyCode'); ?>
                     
                            <?php echo $form->textField($model, 'verifyCode', array('class' => 'verifyCode'), array('style' => 'margin-left:none')); ?>

                    </div></div>


            </div>
            <?php
            $this->widget('bootstrap.widgets.TbButton', array(
                'buttonType' => 'submit',
                'type' => 'primary',
                'icon' => 'ok white',
                'label' => $model->isNewRecord ? 'Daftar' : 'Simpan',
            ));
            ?>


        </div>

    </div>


    <?php $this->endWidget(); ?>
</div>

<script>
        function HandleBrowseClick()
        {
            var fileinput = document.getElementById("browse");
            fileinput.click();
        }
        function Handlechange()
        {
            var fileinput = document.getElementById("browse");
            var textinput = document.getElementById("filename");
            textinput.value = fileinput.value;
        }
        function send() {

            var data = $("#user-form").serialize();
            $.ajax({
                type: 'POST',
                url: '<?php echo Yii::app()->createAbsoluteUrl("bbiiMember/anggota"); ?>',
                data: data,
                success: function(data) {
                    var username = $("#semail").val();
                    if (data == 'gagal') {
                        $("#berhasil").css("display", "block");
                        $("#gagal").css("display", "none");
                        $("#terdaftar").css("display", "none");
                        $('#BbiiMember_email').prop("readonly", true);
                        $('#BbiiMember_phone').prop('readonly', true);
                        $('#BbiiMember_type_business').prop('readonly', true);
                        $('#BbiiMember_company_name').prop('readonly', true);
                        $('#BbiiMember_pin').prop('readonly', true);
                        $('#BbiiMember_password').prop('readonly', true);
                        $('#business_id').prop('disabled', true);
                        $('#city_id').prop('disabled', true);
                        $("#status").css("display", "none");
                    } else if (data == 'terdaftar') {
                        $("#gagal").css("display", "none");
                        $("#berhasil").css("display", "none");
                        $("#terdaftar").css("display", "block");
                        $('#BbiiMember_email').prop("readonly", true);
                        $('#BbiiMember_phone').prop('readonly', true);
                        $('#BbiiMember_type_business').prop('readonly', true);
                        $('#BbiiMember_company_name').prop('readonly', true);
                        $('#BbiiMember_pin').prop('readonly', true);
                        $('#BbiiMember_password').prop('readonly', true);
                        $('#usaha').prop('readonly', true);
                        $('#business_id').prop('disabled', true);
                        $('#city_id').prop('disabled', true);
                        $("#status").css("display", "none");
                    } else {
                        $("#gagal").css("display", "block");
                        $("#berhasil").css("display", "none");
                        $("#terdaftar").css("display", "none");
                        $("#BbiiMember_member_name").val(data);
                        $("#BbiiMember_username").val(username);
                        $("#BbiiMember_code").val(username);
//                            $("#submit").css("display", "block");
                        $('#BbiiMember_email').prop("readonly", false);
                        $('#BbiiMember_phone').prop('readonly', false);
                        $('#BbiiMember_type_business').prop('readonly', false);
                        $('#BbiiMember_company_name').prop('readonly', false);
                        $('#BbiiMember_pin').prop('readonly', false);
                        $('#BbiiMember_password').prop('readonly', false);
                        $('#usaha').prop('readonly', false);
                        $('#business_id').prop('disabled', false);
                        $('#city_id').prop('disabled', false);
                    }

                },
                error: function(data) { // if error occured
                    alert("Error occured.please try again");
                },
            });
        }
        function angka(e) {
            if (!/^[0-9,+,-]+$/.test(e.value)) {
                e.value = e.value.substring(0, e.value.length - 1);
            }
        }
</script>