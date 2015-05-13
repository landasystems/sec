<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle = 'Login - Member Area';
$this->breadcrumbs = array(
    'Login',
);
?>



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
    .center-bar {
        margin: 0 auto 30px;
        display: block;
    }
      #login-form header hgroup h2 {
        color: #1998ed;
        font-size: 14px;
        /*position: absolute;*/
        top: 72px;
        width: 100%;
    }
    #login-form header hgroup h2 span {
padding: 0 10px;
background: #fff;
}


</style>
<div id="login-form" class="center-bar clearfix">
    <header>
        <hgroup class="text-center">
            <div class="col-xs-12"><h1><a href="/"> 
                        <a href="<?php echo url('forum') ?>" style="color: #fff"><img src="<?php echo param('urlImg') ?>file/logo.png" style="width: 45%;"></a>
 <hgroup class="text-center"><h2><span>Masuk Forum SEC</span></h2></hgroup> 
                        </hgroup>
                        </header>
                        <div class="text-center"></div>


<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'losgin-form',
    'enableClientValidation' => true,
    'clientOptions' => array(
        'validateOnSubmit' => true,
    ),
        ));
?>

<!--<div class="container-fluid">

    <div id="header">

        <div class="row-fluid">

            <div class="navbar">
                <div class="navbar-inner">
                    <div class="container">
                        <a class="brand" href="#"><?php // echo app()->name   ?> <span class="slogan"><?php echo param('appVersion') ?></span></a>
                    </div>
                </div> /navbar-inner 
            </div> /navbar 


        </div> End .row-fluid 

    </div> End #header 

</div> End .container-fluid     -->

<div class="container-fluid">
    <?php
    foreach (Yii::app()->user->getFlashes() as $key => $message) {

        echo'<div class="alert alert-' . $key . ' fade in">
            
            ' . $message . '
          </div>';
    }
    ?>
    <div class="loginContainer">
        <form class="form-horizontal" action="dashboard.html" id="loginForm" />
        <br/>
        <div class="form-row row-fluid">
            <div class="span12">
                <div class="row-fluid">
                    <label class="form-label span12" for="username">
                        Username:
                        <span class="icon16 icomoon-icon-user-2 right gray marginR10"></span>
                    </label>
                    <?php echo $form->textField($model, 'username', array('class' => 'span12')); ?>
                    <?php echo $form->error($model, 'username'); ?>
<!--                    <input class="span12" id="username" type="text" name="username" value="Administrator" />-->
                </div>
            </div>
        </div>

        <div class="form-row row-fluid">
            <div class="span12">
                <div class="row-fluid">
                    <label class="form-label span12" for="password">
                        Password:
                        <span class="icon16 icomoon-icon-locked right gray marginR10"></span>
                        <span class="forgot"><a href="<?php echo url('forgot-password'); ?>">Forgot your password?</a></span>
                    </label>
                    <?php echo $form->passwordField($model, 'password', array('class' => 'span12')); ?>
                    <?php echo $form->error($model, 'password'); ?>
<!--                    <input class="span12" id="password" type="password" name="password" value="somepass" />-->
                </div>
            </div>
        </div>
        <div class="form-row row-fluid">                       
            <div class="span12">
                <div class="row-fluid">
                    <div class="form-actions">
                        <div class="span12 controls">
                            <?php echo $form->checkBox($model, 'rememberMe', array('class' => 'left', 'style' => 'width:20px')); ?> Keep me login in

<!--                            <input type="checkbox" id="keepLoged" value="Value" class="styled" name="logged" />-->

                            <button type="submit" class="btn btn-info right" id="loginBtn"><span class="icon16 icomoon-icon-enter white"></span> Login</button>                            
                            <a href="<?php echo url('register'); ?>" class="btn btn-info right">Register</a>
                        </div>
                    </div>
                </div>
            </div> 
        </div>

        </form>
    </div>

</div><!-- End .container-fluid -->

<?php $this->endWidget(); ?>


                        </div>
