<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo CHtml::encode($this->pageTitle); ?> | <?php echo param('clientName') ?></title>
        <link rel="shortcut icon" href="<?php echo param('urlImg') ?>file/favicon.ico" />




        <?php
        cs()->registerCssFile(bt('css/custom.css'));
//        cs()->registerCssFile(bt('font-awesome-4.0.3/css/font-awesome.min.css'));
        cs()->registerCssFile(bt('css/style.css'));
        cs()->registerCssFile(bt('css/menu.css'));
        cs()->registerCssFile(bt('css/login.css'));
        cs()->registerCssFile(bt('css/vertical.css'));
        cs()->registerCssFile(bt('css/stylemobile.css'));
        ?>
        <script>
            (function(i, s, o, g, r, a, m) {
                i['GoogleAnalyticsObject'] = r;
                i[r] = i[r] || function() {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
                a = s.createElement(o),
                        m = s.getElementsByTagName(o)[0];
                a.async = 1;
                a.src = g;
                m.parentNode.insertBefore(a, m)
            })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

            ga('create', 'UA-60686751-1', 'auto');
            ga('send', 'pageview');

        </script>
        <style>
            .blog-post{
                padding: 10px;
            }
        </style>
    </head>
    <body>

        <div class="container-fluid">

            <!-- Slider -->

            <!-- //Slider -->

            <?php $this->renderPartial('common.themes.frontend.sec.views.layouts.header', array()); ?>

            <?php
            if (isset(user()->member_name)) {
                $this->renderPartial('common.themes.frontend.sec.views.layouts.content', array('content' => $content));
            } else {
                ?>
                <section class="content2" style="background-color:">
                    <div class="container">
                        <div class="row-fluid">

                            <div class="span9 ">
                                <!-- POST -->

                                <div class="well" style="padding: 15px;margin-top: 10px;">

                                    <?php echo $content ?>
                                </div><!-- POST -->


                            </div>
                            <div class="span3">
                                

                                <div class="sidebarblock">

                                    <div id="wrapper" style="background-color: #f3f3f3;  margin-top: 10px;">


                                        <?php
                                        $model = new LoginForm;
                                        $form = $this->beginWidget('CActiveForm', array(
                                            'id' => 'login-form',
                                            'action' => url('site/login'),
                                            'enableClientValidation' => true,
                                            'clientOptions' => array(
                                                'validateOnSubmit' => true,
                                            ),
                                            'htmlOptions' => array(
                                                'enctype' => 'multipart/form-data',
                                                'class' => 'login-form',
                                            ),
                                        ));
                                        ?>
                                        <!--<form name="login-form" class="login-form" action="" method="post">-->

                                        <div class="header">
                                            <h1>Area Anggota</h1>
                                            <span>Masuk dengan menggunakan username NBA anggota dan password yang sudah anda tentukan sendiri.</span>
                                        </div>

                                        <div class="content">
                                            <?php echo $form->textField($model, 'username', array('class' => 'span12 cc', 'placeHolder' => 'NBA Anggota')); ?>
                                            <?php echo $form->error($model, 'username'); ?>


                                            <div class="user-icon"></div>
                                            <?php echo $form->passwordField($model, 'password', array('class' => 'span12 cc', 'placeHolder' => 'Password')); ?>
                                            <?php echo $form->error($model, 'password'); ?>
                                            <div class="pass-icon"></div>
                                            <div class="lupa">
                                                <a  href="<?php echo url('forgot-password'); ?>" style="text-align:right">Lupa pasword anda ?</a>
                                            </div>
                                        </div>

                                        <div class="footer">
                                            <input type="submit" name="submit" value="Masuk" class="button" />
                                        </div>

                                        <?php $this->endWidget(); ?>

                                    </div>
                                </div>
                                <center>
                                <img src="<?php echo param('urlImg') ?>file/iklan.png" class="img-responsive"/>
                                </center>
                                            <?php $this->renderPartial('common.themes.frontend.sec.views.layouts.topMember', array()); ?>
                                  

                            </div>
                        </div>
                    </div>
                </section>

            <?php } ?>


            <?php $this->renderPartial('common.themes.frontend.sec.views.layouts.footer', array()); ?>



        </div>
<script>
function myFunction() {
    document.getElementById("login-form").reset();
}
</script>