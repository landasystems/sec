<style>
   .panel {
        padding:10px 80px;
        left:220px;
        position:relative;
    }
</style>

<div class="panel">
    <center><div class="well span5" style="padding:">
            
            <?php
            foreach (Yii::app()->user->getFlashes() as $key => $message) {
                echo '<div class="alert alert-' . $key . '">'.$message.'</div>';
            }
            ?>
            
            <span class="field">
                <p>Masukkan email kamu disini dan kami akan email prosedur untuk mereset password akun kamu.</p>
            </span>
            <hr>

            <?php
//        $model = new User;
            $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                'id' => 'User-form',
                'action' => url('user/sendEmail'),
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
                         <input class="span12" placeholder="Masukan Email" name="email" id="LoginForm_password" type="text">
                    </div>
                </div>
               
            </div>
            <hr>
            <button class="btn btn-primary btn-lg " name="commit" type="submit"><i class="fa fa-sign-in"></i>&nbsp; Reset Password</button>
            <a href="<?php echo url('index') ?>" class="btn btn-primary btn-lg " name="commit" ><i class="fa fa-sign-in"></i>Cancel</a>
            <?php $this->endWidget(); ?>

        </div></center>
    
    
</div>

