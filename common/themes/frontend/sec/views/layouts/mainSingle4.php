<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Forum Diskusi Umum | <?php echo param('clientName') ?></title>
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
            (function (i, s, o, g, r, a, m) {
                i['GoogleAnalyticsObject'] = r;
                i[r] = i[r] || function () {
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

        </style>
    </head>
    <body>

        <div class="container-fluid">

            <!-- Slider -->

            <!-- //Slider -->

            <?php $this->renderPartial('common.themes.frontend.sec.views.layouts.header', array()); ?>
            <?php
            $head = BbiiForum::model()->findByPk(3);
            $anak = BbiiForum::model()->sorted()->findAll(array('condition' => 'cat_id=' . $head->id));
            ?>
            <?php
            if (isset(user()->member_name)) {
                ?>
                <section class="content2" style=" ">
                    <div class="container">
                        <div class="row-fluid">
                            <div class="span9" style="margin-top: 10px;">
                                <!--                            <ul class="nav nav-tabs" id="myTab" style="background:none">
                                                                <li class="active"><a href="#home">Forum</a></li>
                                                                <li><a href="#profile">List Anggota</a></li>
                                                                <li><a href="#messages">Search</a></li>
                                                            </ul>-->

                                <div class="post" style="padding: 15px;">
                                    <div class="forum-category" style="background:#faa61a" >
                                        <div class="header5">
                                            <?php echo $head->name ?>
                                        </div>
                                        <div class="header4">
                                            <?php echo $head->subtitle ?>
                                        </div>
                                    </div>
                                    <?php
                                    foreach ($anak as $data) {
                                        ?>
                                        <article class="clearfix">

                                            <div class="codo_topics_forum_img visible-desktop">
                                                <div class="codo_topics_no_replies"><span>
                                                        <?php
                                                        $jumlah_ribuan = 2;
                                                        $pemisah_ribuan = ',';
                                                        echo CHtml::encode($data->num_topics);
                                                        ?></span>topic</div>
                                                <div class="codo_topics_no_replies" id="codo_topics_no_views"><span><?php echo CHtml::encode($data->num_posts); ?></span>kiriman</div>

                                            </div>
                                            <div class="codo_topics_forum_content">
                                                <div class="codo_topics_forum_avatar">
                                                    <!--<a href="http://codologic.com/forum/index.php?u=/user/profile/5253">-->
                                                    <img src="<?php echo bt('images/forum.png') ?>" alt="" />
                                                    <!--</a>-->
                                                </div>

                                                <div class="codo_topics_forum_title">
                                                    <a href="<?php echo url('forum/forum/forum/', array('id' => $data->id)) ?>">
                                                        <?php echo $data->name ?>
                                                    </a>
                                                    <?php // echo CHtml::link(CHtml::encode($data->name), array('forum', 'id' => $data->id));  ?>

                                                </div>


                                            </div>
                                            <div class="codo_topics_forum_message">
                                                <div class="row-fluid">
                                                    <div class="span8">
                                                        <?php // echo CHtml::encode($data->subtitle); ?>
                                                        <?php
                                                        $terbaru = '';
                                                        $id = '';
                                                        if ($data->last_post_id && $data->lastPost) {
                                                            $topic = BbiiTopic::model()->findAll(array('condition' => 'forum_id=' . $data->id, 'limit' => 3, 'order' => 'id desc'));
                                                            foreach ($topic as $a) {
                                                                $terbaru = $a->title;
                                                                $id = $a->id;
                                                                echo '<span class="asem-jawa"><a href="' . url('forum/forum/topic', array('id' => $id)) . '">' . ucwords(strtolower($terbaru)) . '</a></span><hr style="margin-top: 2px;margin-bottom: 2px;">';
                                                            }
//                echo CHtml::encode($data->lastPost->poster->member_name);
//        echo CHtml::encode($data->lastPost->subject);
//                        echo 'Post Terakhir: <span class="asem-jawa">' . CHtml::link(CHtml::encode($data->lastPost->subject, 'next', array('style' => 'margin-left:5px;color:#5388B4')), array('style' => 'margin-left:5px;color:#5388B4', 'topic', 'id' => $data->lastPost->topic_id)) . '</span>';
//                        echo '<span style="font-size: 12px;">' . DateTimeCalculation::long($data->lastPost->create_time) . ', <i>oleh</i> : <span style="color:#5388B4">' . CHtml::encode($data->lastPost->poster->member_name) . '</span></span>';
                                                        } else {
                                                            echo Yii::t('BbiiModule.bbii', '<center>Tidak ada posting</center>');
                                                        }
                                                        ?>
                                                    </div>
                                                    <div class="span4">
        <?php
        $terbaru = '';
        $id = '';
        if ($data->last_post_id && $data->lastPost) {
            $topic = BbiiTopic::model()->findAll(array('condition' => 'forum_id=' . $data->id, 'limit' => 3, 'order' => 'id desc'));
            foreach ($topic as $a) {
                $post = BbiiPost::model()->findByAttributes(array('topic_id' => $a->id));

                echo '<span class="pull-right"  style="font-size: 12px;">' . date('d  M  Y H:i:s', strtotime($post->create_time)) . ' </span><br><hr style="margin-top: 2px;margin-bottom: 2px;">';
            }
//                echo CHtml::encode($data->lastPost->poster->member_name);
//        echo CHtml::encode($data->lastPost->subject);
//                        echo 'Post Terakhir: <span class="asem-jawa"><a href="'.url('forum/forum/topic', array('id'=>$id)).'">'.$terbaru.'</a></span>';
//                        echo 'Post Terakhir: <span class="asem-jawa">' . CHtml::link(CHtml::encode($data->lastPost->subject, 'next', array('style' => 'margin-left:5px;color:#5388B4')), array('style' => 'margin-left:5px;color:#5388B4', 'topic', 'id' => $data->lastPost->topic_id)) . '</span>';
        } else {
            echo Yii::t('BbiiModule.bbii', '<center>Tidak ada posting</center>');
        }
        ?>
                                                    </div>
                                                </div>



                                            </div>


                                        </article>

                                    <?php } ?>
                                </div>
                            </div>

                            <div class="span3" style="margin-top: 10px;">
                                <div name="login-form" class="login-form"  >

                                    <div class="header">
                                        <?php
                                        $user = '';
//                        echo user()->id;
                                        $user = BbiiMember::model()->findByPk(user()->id);
                                        ?>
                                        <img src="<?php echo $user->imgUrl['small'] ?>" class="img-responsive img-rounded " style="width:35%;margin-left: 50px;">
                                        <h2><?php echo $user->member_name ?>.</h2>
                                        <span><?php echo $user->business->name . ' - ' . $user->phone ?>.</span><br>
                                        <span><?php echo $user->address ?>.</span>

                                    </div>
                                    <?php // $this->renderPartial('common.themes.frontend.sec.views.layouts.search', array()); ?>
                                    <div class="content2" id="getFixed">
                                        <?php
                                        $approvals = BbiiPost::model()->unapproved()->count();
                                        $reports = BbiiMessage::model()->report()->count();
                                        $count['inbox'] = BbiiMessage::model()->inbox()->count('inbox = 1 and read_indicator = 0 and sendto = ' . user()->id . '');
                                        $count['outbox'] = BbiiMessage::model()->outbox()->count('outbox = 1 and read_indicator and sendfrom = ' . user()->id);
                                        $inbox = (empty($count['inbox'])) ? '' : $count['inbox'];
                                        $outbox = (empty($count['outbox'])) ? '' : $count['outbox'];
                                        $approval = (empty($approvals)) ? '' : $approvals;
                                        $report = (empty($reports)) ? '' : $reports;
                                        ?>
                                        <ul class="vertical">
                                            <li><a  href="<?php echo url('/forum') ?>"><i class="icon-book"></i>Forum</a></li>
                                            <li><a  href="<?php echo url('forum/member/index') ?>"><i class="icon-user"></i>Member</a></li>
                                            <li><a  href="<?php echo url('forum/member/view', array('id' => user()->id)) ?>"><i class="icon-cog"></i> Profile</a></li>
                                            <li><a  href="<?php echo url('forum/message/inbox') ?>"><i class="icon-envelope-alt"></i>Inbox <span class="badge badge-info"><?php echo $inbox ?></span></a>  </li>
                                            <li><a  href="<?php echo url('forum/message/outbox') ?>"><i class=" icon-share-alt"></i>Outbox <span class="badge badge-inverse"><?php echo $outbox ?></span></a></li>
                                            <?php if ($user->moderator == 1) { ?>
                                                <li><a  href="<?php echo url('forum/moderator/approval') ?>"><i class="icon-ok-sign"></i>Approval <span class="badge badge-warning"><?php echo $approval ?></span></a></li>
                                                <li><a  href="<?php echo url('forum/moderator/report') ?>"><i class="icon-info-sign"></i>Report <span class="badge badge-danger"><?php echo $report ?></span></a></li>
                                            <?php } ?>
                                            <li><a href="<?php echo url('site/logout') ?>"><i class="icon-signout"></i>Logout</a></li>
                                        </ul>

                                    </div>
                                </div>
                                <center>
                                    <img src="<?php echo param('urlImg') ?>file/iklan.png" class="img-responsive"/>
                                </center>

                            </div>
                        </div>
                    </div>
                </section>
                <?php
//                $this->renderPartial('common.themes.frontend.sec.views.layouts.content', array('content' => $content));
            } else {
                ?>
                <section class="content2" style="background-color:">
                    <div class="container">
                        <div class="row-fluid">

                            <div class="span9  ">
                                <!-- POST -->

                                <div class="post" style="padding: 15px;">

                                    <div class="forum-category" style="background:#faa61a" >
                                        <div class="header5">
                                            <?php echo $head->name ?>
                                        </div>
                                        <div class="header4">
                                            <?php echo $head->subtitle ?>
                                        </div>
                                    </div>
                                    <?php
//                                    $anak = BbiiForum::model()->findAll(array('condition' => 'cat_id=' . $head->id));
                                    foreach ($anak as $data) {
                                        ?>
                                        <article class="clearfix">

                                            <div class="codo_topics_forum_img">
                                                <div class="codo_topics_no_replies"><span>
                                                        <?php
                                                        $jumlah_ribuan = 2;
                                                        $pemisah_ribuan = ',';
                                                        echo CHtml::encode($data->num_topics);
                                                        ?></span>topic</div>
                                                <div class="codo_topics_no_replies" id="codo_topics_no_views"><span><?php echo CHtml::encode($data->num_posts); ?></span>kiriman</div>

                                            </div>
                                            <div class="codo_topics_forum_content">
                                                <div class="codo_topics_forum_avatar">
                                                    <!--<a href="http://codologic.com/forum/index.php?u=/user/profile/5253">-->
                                                    <img src="<?php echo bt('images/forum.png') ?>" alt="" />
                                                    <!--</a>-->
                                                </div>

                                                <div class="codo_topics_forum_title">
                                                    <a href="<?php echo url('forum/forum/forum/', array('id' => $data->id)) ?>">
                                                        <?php echo $data->name ?>
                                                    </a>
                                                    <?php // echo CHtml::link(CHtml::encode($data->name), array('forum', 'id' => $data->id));  ?>

                                                </div>


                                            </div>
                                            <div class="codo_topics_forum_message">
                                                <div class="row-fluid">
                                                    <div class="span8">
                                                        <?php // echo CHtml::encode($data->subtitle); ?>
                                                        <?php
                                                        $terbaru = '';
                                                        $id = '';
                                                        if ($data->last_post_id && $data->lastPost) {
                                                            $topic = BbiiTopic::model()->findAll(array('condition' => 'forum_id=' . $data->id, 'limit' => 3, 'order' => 'id desc'));
                                                            foreach ($topic as $a) {
                                                                $terbaru = $a->title;
                                                                $id = $a->id;
                                                                echo '<span class="asem-jawa"><a href="' . url('forum/forum/topic', array('id' => $id)) . '">' . ucwords(strtolower($terbaru)) . '</a></span><hr style="margin-top: 2px;margin-bottom: 2px;">';
                                                            }
//                echo CHtml::encode($data->lastPost->poster->member_name);
//        echo CHtml::encode($data->lastPost->subject);
//                        echo 'Post Terakhir: <span class="asem-jawa">' . CHtml::link(CHtml::encode($data->lastPost->subject, 'next', array('style' => 'margin-left:5px;color:#5388B4')), array('style' => 'margin-left:5px;color:#5388B4', 'topic', 'id' => $data->lastPost->topic_id)) . '</span>';
//                        echo '<span style="font-size: 12px;">' . DateTimeCalculation::long($data->lastPost->create_time) . ', <i>oleh</i> : <span style="color:#5388B4">' . CHtml::encode($data->lastPost->poster->member_name) . '</span></span>';
                                                        } else {
                                                            echo Yii::t('BbiiModule.bbii', '<center>Tidak ada posting</center>');
                                                        }
                                                        ?>
                                                    </div>
                                                    <div class="span4">
        <?php
        $terbaru = '';
        $id = '';
        if ($data->last_post_id && $data->lastPost) {
            $topic = BbiiTopic::model()->findAll(array('condition' => 'forum_id=' . $data->id, 'limit' => 3, 'order' => 'id desc'));
            foreach ($topic as $a) {
                $post = BbiiPost::model()->findByAttributes(array('topic_id' => $a->id));

                echo '<span class="pull-right"  style="font-size: 12px;">' . date('d  M  Y H:i:s', strtotime($post->create_time)) . ' </span><br><hr style="margin-top: 2px;margin-bottom: 2px;">';
            }
//                echo CHtml::encode($data->lastPost->poster->member_name);
//        echo CHtml::encode($data->lastPost->subject);
//                        echo 'Post Terakhir: <span class="asem-jawa"><a href="'.url('forum/forum/topic', array('id'=>$id)).'">'.$terbaru.'</a></span>';
//                        echo 'Post Terakhir: <span class="asem-jawa">' . CHtml::link(CHtml::encode($data->lastPost->subject, 'next', array('style' => 'margin-left:5px;color:#5388B4')), array('style' => 'margin-left:5px;color:#5388B4', 'topic', 'id' => $data->lastPost->topic_id)) . '</span>';
        } else {
            echo Yii::t('BbiiModule.bbii', '<center>Tidak ada posting</center>');
        }
        ?>
                                                    </div>
                                                </div>



                                            </div>


                                        </article>

                                    <?php } ?>
                                </div><!-- POST -->


                            </div>
                            <div class="span3">

                                <div class="sidebarblock" style="background-color: #f3f3f3;  margin-top: 10px;">
                                    <div id="wrapper">
                                        <?php // $this->renderPartial('common.themes.frontend.sec.views.layouts.search', array()); ?>
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