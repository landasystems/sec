<!DOCTYPE html> 
<html lang="en"> 
    <head> 
        <title>Website masih dalam pengembangan</title> 
        <meta name="author" content="Landa Systems - Profesional Website Development - Your Business Grown Here" />
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php
        cs()->registerCssFile(bt('css/style.css'));
        cs()->registerScriptFile(bt('js/jquery.countdown.js'));
        cs()->registerScriptFile(bt('js/jquery.tipsy.js'));
        cs()->registerScriptFile(bt('js/jquery.subscribe.js'));
        cs()->registerScriptFile(bt('js/jquery.contact.js'));
        ?>
        <script type="text/javascript">
            $(document).ready(function() {

//cowntdown function. Set the date by modifying the date in next line (January 01, 2013 00:00:00):
                var austDay = new Date("Mar 25, 2015 12:00:00");
                $('#countdown').countdown({until: austDay, layout: '<div class="item"><p>{dn}</p> <span>-{dl}-</span></div> <div class="item"><p>{hn}</p> <span>-{hl}-</span></div> <div class="item"><p>{mn}</p> <span>-{ml}-</span></div> <div class="item"><p>{sn}</p> <span>-{sl}-</span></div>'});
                $('#year').text(austDay.getFullYear());
//function for the social hover effect - tooltips		
                $('.tooltip').tipsy
                        ({
                            fade: true,
                            gravity: 's'
                        });
//function for the contact-form dropdown
                function contact() {
                    if ($("#cform").is(":hidden"))
                    {
                        $("#ribbon").css({"background": "url(<?php echo bt('images/ribbon.png') ?>) bottom left no-repeat"});
                        $("#home").slideUp("fast");
                        $("#cform").slideDown("slow");
                    }
                    else {
                        $("#ribbon").css({"background": "url(<?php echo bt('images/ribbon.png') ?>) top left no-repeat"});
                        $("#cform").slideUp("slow");
                        $("#home").slideDown("slow");
                    }
                }

//run contact form when the ribbon is clicked
                $(".contact").click(function() {
                    contact()
                });
            });
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
        </script>
        <style type="text/css">
            <!--



            .val-email {
                font: 8pt verdana;
                font-weight:bold; 

            }
            .form-horizontal .controls{
                margin-left: 1px;
            }
            input {
                color: #000000;
                background: #F8F8F8;
                border: 1px solid #353535;
                width:250px;
                font: 8pt verdana;
                font-weight:normal; 
                text-decoration:none;
                margin-top:5px; 
            }
            #fakeBrowse{
                margin-top: 18px;
                float: right;
                position: absolute;
                right: 7px;
            }
            .errorMessage{
                color:red;
            }
            -->
        </style>
    </head> 

    <body> 
        <div id="wrapper">


            <div id="book">		
                <div id="ribbon" class="contact">Klik untuk menuju halaman pesan</div>		
                <div class="top-page"></div>

                <div class="content-page">
                    <div class="top-spiral"></div>
                    <div class="bottom-spiral"></div>
                    <div class="bottom-spiral2"></div>

                    <div id="cform">

                        <div class="row"></div>
                        <div class="form-wrapper email-list">
                            <?php
                            $form = $this->beginWidget('CActiveForm', array(
                                'id' => 'user-form',
                                'enableAjaxValidation' => true,
//                                'action' => $this->createUrl('user/anggota'),
                                'enableClientValidation' => true,
                                'htmlOptions' => array(
                                    'enctype' => 'multipart/form-data'
                                ),
                                
                            ));
                            ?>
                            <input type="text" id="semail" name="code" placeholder="Masukan NBA anda" onkeyup="angka(this);" />				
                            <input type="submit" id="ssubmit" onCLick="send();
                return false;" name="subscribe" value="Cek Data" class="orange" />

                            <?php $this->endWidget(); ?>
                            <br><br><br>
                            <p style="color: darkolivegreen;text-align: center;">*Apabila anda belum mengetahui NBA anda, silahkan datang ke kantor CU Sawiran terdekat</p>
                        </div>
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
                        <div class="form-wrapper" id="form-daftar" style="display:block">
                            <div id="message"></div>
                            <?php
                            $model = new User;
                            $form = $this->beginWidget('CActiveForm', array(
                                'id' => 'login-form',
                                'action' => url('user/create'),
                                'enableClientValidation' => true,
                                'clientOptions' => array(
                                    'validateOnSubmit' => true,
                                ),
                                'htmlOptions' => array(
                                    'enctype' => 'multipart/form-data'
                                ),
                            ));
                            ?>

                            <?php
                            echo'<table width="100%">
                                <tr>
                                    <td>
                                     ' .
                            $form->error($model, 'password') .
                            $form->error($model, 'phone') .
                            $form->error($model, 'email') . '   
                                    </td>
                                    <td>
                                        ' .
                            $form->error($model, 'company_name') .
                            $form->error($model, 'type_business') .
                            $form->error($model, 'address') . '
                                    </td>
                                </tr>
                                <tr>
                                <td colspan="2">
                                <span class="val-email" id="status" style="display:none"></span>
                                </td>
                                </tr>
                            </table>';
                            ?>

                            <input type="hidden" name="User[username]" placeholder="Nama" id="username" />
                            <input type="hidden" name="User[code]" placeholder="Nama" id="code" />
                            <input type="hidden" name="province_id" placeholder="Nama" id="code" value="5" />

                            <table width="100%">
                                <tr>
                                    <td>
                                        <input type="text" name="User[name]" placeholder="Nama" id="name" readonly />
                                    </td>
                                    <td>
                                        <?php echo $form->passwordField($model, 'password', array('class' => '3', 'placeholder' => 'Password', 'readonly' => true)); ?>

                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <?php echo $form->textField($model, 'phone', array('class' => 'span3 angka', 'onkeyup' => 'angka(this)', 'placeholder' => 'No Telpon', 'readonly' => true)); ?>
                                    </td>
                                    <td>
                                        <?php echo $form->textField($model, 'email', array('class' => 'span3 ', 'onkeyup' => 'email_validate(this.value)', 'placeholder' => 'Email', 'readonly' => true)); ?> 
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <?php echo $form->textField($model, 'pin', array('class' => 'span3 ', 'placeholder' => 'Pin BB / Whatshap', 'readonly' => true)); ?> 
                                    </td>
                                    <td>
                                        <input type="file" id="browse" name="User[avatar_img]" style="display: none" onChange="Handlechange();"/>
                                        <input type="text" id="filename" readonly="true" placeholder="Gambar Profile" style=""/>
                                        <input type="button" value="Pilih Foto Profile" id="fakeBrowse" onclick="HandleBrowseClick();" />

                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <?php
                                        echo CHtml::dropDownList('business_id', $model, CHtml::listData(BusinessCategory::model()->findAll(), 'id', 'name'), array('disabled' => true));
                                        ?>
                                    </td>
                                    <td>
                                        <?php echo $form->textField($model, 'type_business', array('class' => 'span3 ', 'placeholder' => 'Jenis Usaha', 'readonly' => true)); ?> 
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <?php echo $form->textField($model, 'company_name', array('class' => 'span3 ', 'placeholder' => 'Nama Usaha', 'readonly' => true)); ?> 
                                    </td>
                                    <td>
                                        <?php
                                        echo CHtml::dropDownList('city_id', $model, CHtml::listData(City::model()->findAll(array('condition' => 'province_id=5')), 'id', 'name'), array('empty' => 'Pilih Kota/Kab'));
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <?php
                                        echo $form->textArea(
                                                $model, 'address', array('class' => 'span4', 'rows' => 5, 'cols' => 7, 'placeholder' => 'Alamat')
                                        );
                                        ?>
                                    </td>
                                </tr>
                            </table>
                            <?php // echo $form->dropDownListRow($model, 'business_id', CHtml::listData(BusinessCategory::model()->findAll(array('order' => 'id')), 'id', 'name'), array('class' => 'span3', 'empty' => 'Pilih tahun ajaran'));    ?>

                            <?php // echo $form->error($model, 'business_id');    ?>
                            <?php // echo $form->dropDownListRow($model, 'city_id', CHtml::listData(City::model()->findAll(array('condition' => 'province_id=5')), 'id', 'name'), array('class' => '', 'labelOptions' => array('label' => 'Kabupaten/ Kota'))); ?>
                            <?php // echo $form->error($model, 'city_id');  ?>
<!--                            <input type="text" name="User[company_name]" placeholder="Nama Usaha" id="usaha" readonly/>
                            <input type="text" name="User[company_name]" placeholder="Nama Usaha" id="usaha" readonly/>




                            <textarea placeholder="Alamat" name="User[address2]" id="alamat2" readonly></textarea>-->
                            <div id="captcha">
                                <?php $this->widget('CCaptcha', array('captchaAction' => 'user/captcha')); ?>

                                <?php // echo $form->error($model, 'verifyCode');      ?>



                                <br><label class="control-label required" for="Testimonial_email"> <span class="required">*</span></label><div class="controls">
                                    <?php echo $form->textField($model, 'verifyCode', array('class' => 'verifyCode'), array('style' => 'margin-left:none')); ?></div>


                            </div>
                            <input type="submit" style="display:block"  name="send" value="Daftar"  id="submit" class="orange" /> 

                            <?php $this->endWidget(); ?>
                        </div>

                        <!--end form-wrapper-->
                    </div><!--end cform-->

                    <div id="home">
                        <header>
                            <a class="logo" href="index.html"><img src="<?php echo bt('images/logo.png') ?>" alt="logo" title="logo" /></a>
                            <div class="daftar" >
                                <img src="<?php echo bt('images/daftar.png') ?>" alt="logo" title="logo" style="width:50%" />  
                            </div>
                        </header>
                        <div class="row"></div>
                        <h2>
                            website masih dalam pengembangan
                        </h2>					

                        <div class="row"></div>
                        <h3>Kita sedang bekerja keras, hitungan mundur untuk Go Live :</h3>

                        <div id="countdown"></div>	
                        <div class="clear"></div>
                        <div class="row"></div>

                        <div class="row"></div>
                        <div class="form-wrapper2" style="float:left">

                            <?php
                            $anggota_jum = User::model()->findAll(array('condition' => ' roles_id !=-1'));
                            $anggota = User::model()->findAll(array('condition' => ' roles_id !=-1', 'limit' => 14));
                            $jumlah = count($anggota_jum);
                            echo '<h3><strong style="color:#000">' . $jumlah . '</strong> Anggota Sudah Terdaftar</h3>';
                            foreach ($anggota as $a) {
                                echo'<div style="width: 65px;height: 65px;margin: 8px;float: left;"><img src="' . $a->imgUrl['small'] . '" class="img-polaroid img-rounded" title="' . $a->name . ' " style="height: 65px;width: 60px;"/></div>';
                            }
                            ?>
                        </div>
                        <!--end form-wrapper-->
                    </div><!--end home-->

                </div><!--end content-page-->


            </div><!--end book-->

            <p class="copyright">Copyright 2015 &copy; <a href="http://www.sec.cusawiran.org" target="_blank">SEC Sawiran</a>  - All Rights Reserved</p>
            <script type="text/javascript">
            function validasi()

            {

                var password = document.pendaftaran.password.value;
                var alamat = document.pendaftaran.alamat.value;
                var telp = document.pendaftaran.telp.value;
                if (password == '')

                {

                    alert("Nama Harus Diisi");
                }

                if (alamat == '')

                {

                    alert("Alamat Harus Diisi");
                }

                if (telp == '')

                {

                    alert("Telpon Harus Diisi");
                }

            }



            function send() {

                var data = $("#user-form").serialize();
                $.ajax({
                    type: 'POST',
                    url: '<?php echo Yii::app()->createAbsoluteUrl("user/anggota"); ?>',
                    data: data,
                    success: function(data) {
                        var username = $("#semail").val();
                        if (data == 'gagal') {
                            $("#berhasil").css("display", "block");
                            $("#gagal").css("display", "none");
                            $("#terdaftar").css("display", "none");
                            $('#User_email').prop("readonly", true);
                            $('#User_phone').prop('readonly', true);
                            $('#User_type_business').prop('readonly', true);
                            $('#User_company_name').prop('readonly', true);
                            $('#User_pin').prop('readonly', true);
                            $('#User_password').prop('readonly', true);
                            $('#business_id').prop('disabled', true);
                            $('#city_id').prop('disabled', true);
                            $("#status").css("display", "none");
                        } else if (data == 'terdaftar') {
                            $("#gagal").css("display", "none");
                            $("#berhasil").css("display", "none");
                            $("#terdaftar").css("display", "block");
                            $('#User_email').prop("readonly", true);
                            $('#User_phone').prop('readonly', true);
                            $('#User_type_business').prop('readonly', true);
                            $('#User_company_name').prop('readonly', true);
                            $('#User_pin').prop('readonly', true);
                            $('#User_password').prop('readonly', true);
                            $('#usaha').prop('readonly', true);
                            $('#business_id').prop('disabled', true);
                            $('#city_id').prop('disabled', true);
                            $("#status").css("display", "none");
                        } else {
                            $("#gagal").css("display", "block");
                            $("#berhasil").css("display", "none");
                            $("#terdaftar").css("display", "none");
                            $("#name").val(data);
                            $("#username").val(username);
                            $("#code").val(username);
//                            $("#submit").css("display", "block");
                            $('#User_email').prop("readonly", false);
                            $('#User_phone').prop('readonly', false);
                            $('#User_type_business').prop('readonly', false);
                            $('#User_company_name').prop('readonly', false);
                            $('#User_pin').prop('readonly', false);
                            $('#User_password').prop('readonly', false);
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
            function email_validate(email)
            {

                var regMail = /^([_a-zA-Z0-9-]+)(\.[_a-zA-Z0-9-]+)*@([a-zA-Z0-9-]+\.)+([a-zA-Z]{2,3})$/;
                if (regMail.test(email) == false)
                {

                    document.getElementById("status").innerHTML = "Format Email Salah, mohon di cek lagi.";
                    $("#status").css("display", "block");
//                    $("#submit").css("display", "none");
                }
                else
                {

                    document.getElementById("status").innerHTML = "Format Email Sudah Benar";
                    $("#status").css("display", "block");
                    $("#submit").css("display", "block");
                }
            }

            </script>
        </div><!--end wrapper-->
    </body> 
</html>

