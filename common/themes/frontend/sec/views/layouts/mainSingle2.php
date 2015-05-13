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

                                    <div class="post" style="padding: 15px;height: 400px">
                                        <div id="yw22" class="tabs-left">
                                            <ul id="yw23" class="nav nav-tabs" style="max-width: 20%;">
                                                <?php
                                                $no = 0;
                                                $list = ArticleCategory::model()->findAll(array('condition' => 'parent_id=3'));
                                                foreach ($list as $data) {
                                                    $no++;
                                                    $active = ($no == 1) ? 'active' : '';
                                                    echo' <li class="' . $active . '">
                                                    <a data-toggle="tab" href="#tab' . $no . '">' . $data->name . '</a>
                                                </li>';
                                                }
                                                ?>


                                            </ul>
                                            <div class="tab-content">
                                                <?php
                                                $no = 0;
                                                $list = ArticleCategory::model()->findAll(array('condition' => 'parent_id=3'));
                                                foreach ($list as $data) {
                                                    $no++;
                                                    $active = ($no == 1) ? 'active in' : '';
                                                    echo' <div id="tab' . $no . '" class="tab-pane fade ' . $active . '">';
                                                    $artikel = Article::model()->findAll(array('condition' => 'article_category_id='.$data->id));
                                                    foreach ($artikel as $as) {
                                                        echo' <article class="blog-post row-fluid">
                                                        <div class="span3 columns alpha"> 
                                                            <img src="'.$as->img['small'].'" alt="" class="img-polaroid"><br>
                                                        </div>
                                                        <div class="span9 columns omega">
                                                            <h4><a href="'.$as->url.'">' . ucwords($as->title) . '</a></h4>
                                                            ' . $as->introText(400) . '
                                                            <br><br>
                                                            <a href="'.$as->url.'" class="btn" id="button-readmore">Read more</a> </div>
                                                        <br class="clear">
                                                    </article>';
                                                    }
                                                    echo'</div>';
                                                }
                                                ?>
                                                

                                            </div>
                                        </div>
                                    </div><!-- POST -->
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
                                    <div class="gradient"></div>

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