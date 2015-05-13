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
                echo '<div class="alert alert-' . $key . '">' . $message . '</div>';
            }
            ?>

            <span class="field">
                <p>Masukan password baru anda.</p>
            </span>
            <hr>

            <?php
//        $model = new User;
            $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                'id' => 'User-form',
                'action' => url('user/savePassword'),
                'enableAjaxValidation' => false,
                'method' => 'post',
//                'name'=>'myForm',
//                'onsubmit'=>
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
                        <input class="span12" placeholder="" name="password" id="LoginForm_password" type="password">
                        <input type="hidden" value="<?php echo md5($id); ?>" name="id">
                    </div>
                </div>
            </div>
            <hr>
            <button class="btn btn-primary btn-lg btn-block" name="commit" type="submit"><i class="fa fa-sign-in"></i>&nbsp; Save Password</button>
            <?php $this->endWidget(); ?>

        </div></center>

</div>
<script type="text/javascript">
<!--
    function validate()
    {
        if (document.myForm.password.value == "")
        {
            alert("Please provide your name!");
            document.myForm.password.focus();
            return false;
        }

        return(true);
    }
//-->
</script>
