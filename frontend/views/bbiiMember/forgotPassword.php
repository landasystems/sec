<style>
    body {
        background: #f7f7f7;
        color: #6e6e6e;
        font: 12px 'Open Sans',Helvetica,Arial,sans-serif;
        line-height: 140%;
    }
    body {
        margin: 0;
    }
    #login-form {
        margin-top: 10vh;
        margin-bottom: 10vh;
        padding: 20px;
        border: 1px solid #d4d4d4;
        width: 481px;
        background: #fff;
    }
   
     h3 {
        color: #1998ed;
        /*font-size: 14px;*/
        /*position: absolute;*/
        top: 72px;
        width: 100%;
    }
   
    .center-bar {
        margin: 0 auto 30px;
        display: block;
    }
    .field{
        font-size: 14px;
        line-height: 20px;
    }


</style>
<div id="login-form" class="center-bar clearfix">
    <header>
        <hgroup class="text-center">
            <div class="col-xs-12"><h1><a href="/"> 
                        <a href="<?php echo url('forum') ?>" style="color: #fff"><img src="<?php echo param('urlImg') ?>file/logo.png" style="width: 45%;"></a>

                        <hgroup class="text-center"></hgroup>                        </header>
                        <div class="text-center"></div>

                        <center><div class="well " style="padding:">

                                <?php
                                foreach (Yii::app()->user->getFlashes() as $key => $message) {
                                    echo '<div class="alert alert-' . $key . '">' . $message . '</div>';
                                }
                                ?>
                                <h3><span>Reset Password</span></h3>
                                <span class="field">
                                    <p>Masukkan email kamu disini dan kami akan email prosedur untuk mereset password akun kamu.</p>
                                </span>
                                <hr>

                                <?php
//        $model = new User;
                                $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                                    'id' => 'User-form',
                                    'action' => url('bbiiMember/sendEmail'),
                                    'enableAjaxValidation' => false,
                                    'method' => 'post',
                                    'type' => 'horizontal',
                                    'htmlOptions' => array(
                                        'enctype' => 'multipart/form-data',
                                        'style' => 'margin-top: 25px;'
                                    )
                                ));
                                ?>
                                <div class="form-group">
                                    <div class="row-fluid">
                                        <div class="span12">
                                            <div class="input-prepend" style="width: 90%;">
                                                <span class="add-on"><i class="icon-envelope"></i></span>
                                                <input class="span12" style="width:100%" placeholder="Masukan Email" name="email" id="LoginForm_password" type="text" required>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                                <hr>
                                <button class="btn btn-primary btn-lg " name="commit" type="submit"><i class="icon-ok"></i>&nbsp; Kirim ke Email</button>
                                <a href="<?php echo url('forum') ?>" class="btn btn-primary btn-lg " name="commit" ><i class="icon-remove"></i> Cancel</a>
                                <?php $this->endWidget(); ?>

                            </div></center>



                        </div>