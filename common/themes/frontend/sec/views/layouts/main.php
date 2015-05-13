<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo CHtml::encode($this->pageTitle); ?> </title>
        <link rel="shortcut icon" href="<?php echo param('urlImg') ?>file/favicon.png" />
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
//                echo $_SERVER['REQUEST_URI'].'-'.url('forum');
                if ($_SERVER['REQUEST_URI'] == url('forum')) {
//                    echo'ilang';
                    ?>
                    <section class="content2">
                        <div class="container">
                            <div class="row-fluid">
                                <div class="span12">
                                    <div id="myCarousel" class="img-polaroid carousel slide visible-desktop" style="margin-top: 10px;">

                                        <!-- Carousel items -->
                                        <div class="carousel-inner">
                                            <div class="item active">
                                                <img src="<?php echo param('urlImg') ?>file/slider/1.jpg" alt="" />
                                                <div class="carousel-caption">
                                                    <h3>Sawiran Enterpreneur Community persembahan dari CU Sawiran</h3>
                                                    <p>
                                                        Setiap orang yang sudah bergabung menjadi Anggota di CU Sawiran berhak untuk memperoleh fasilitas pinjaman yang ada sesuai dengan kebutuhan Anda. Dan untuk ketentuan pengajuan pinjaman, Anda dapat datang langsung ke kantor pelayanan CU Sawiran terdekat
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="item">
                                                <img src="<?php echo param('urlImg') ?>file/slider/2.jpg" alt="" />
                                                <div class="carousel-caption">
                                                    <h3>Tujuan adanya SEC</h3>
                                                    <p>
                                                        SEC ada karena dibutuhkannya media untuk saling memberikan informasi antar anggota SEC yang berkaitan dengan usaha, pemikiran, inovasi, teknologi dll.
                                                        Sehingga terciptanya koneksi antar anggota sehingga menjadikan lingkaran kekuatan ekonomi, pendidikan, dan budaya.
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="item">
                                                <img src="<?php echo param('urlImg') ?>file/slider/3.jpg" alt="" />
                                                <div class="carousel-caption">
                                                    <h3>Simpanan Bunga Harian (SISWA)</h3>
                                                    <p>
                                                        Biasakan anak untuk rajin menabung, dengan menggunakan SIBUHAR dari CU Sawiran. Dapatkan kemudahan fasilitas untuk membuat anak rajin menabung. Customer service lebih lanjut hub : (0341) 477 777
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Carousel nav -->
                                        <a class="carousel-control left" href="#myCarousel" data-slide="prev" style="background: none;border: none"><img src="<?php echo bt('images/prev2.png') ?>"></a>
                                        <a class="carousel-control right" href="#myCarousel" data-slide="next" style="background: none;border: none"><img src="<?php echo bt('images/next2.png') ?>"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <?php
                } else {
                    echo'';
                }
                ?>

                <section class="content2" style="padding-top: 25px;">
                    <div class="container">
                        <div class="row-fluid">
                            <div class="span9">

                                <?php echo $content ?>
                                <article class="clearfix">
                                    <?php
                                    /* @var $this ForumController */
                                    $present = BbiiSession::model()->present()->count();
                                    $members = BbiiMember::model()->present()->count();
                                    ?>

                                    <div class="codo_topics_forum_content">
                                        <div class="codo_topics_forum_avatar">
                                            <a href="http://codologic.com/forum/index.php?u=/user/profile/5253">
                                                <img src="<?php echo bt('images/stats.png') ?>" alt="" />
                                            </a>
                                        </div>

                                        <div class="codo_topics_forum_title">Statistik Pengunjung

                                        </div>


                                    </div>
                                    <div class="codo_topics_forum_message">
                                        <div class="row-fluid">
                                            <div class="span6">
                                                <?php
                                                $tothari = 0;
                                                $date = date('Y-m-d');
                                                $hari = BbiiSession::model()->findAll(array('condition' => '(last_visit >="' . $date . '") '));
                                                $tothari = count($hari);
                                                ?>
                                                <ul class="footer-list " id="yw1" style="margin-left: 0px;color:#000;">
                                                    <li>Total Topic: <strong> <?php echo BbiiTopic::model()->count(); ?></strong> <span class="divider">|</span> Total Kiriman: <strong><?php echo BbiiPost::model()->count(); ?></strong></li>
                                                    <li>Total Kategori: <strong> <?php echo BbiiForum::model()->count(); ?></strong> <span class="divider">|</span> Pengunjung Hari Ini : <strong><?php echo $tothari; ?></strong></li>
                                                    <li>Total Semua Pengunjung: <strong><?php echo BbiiSession::model()->count(); ?></strong></li>
                                                </ul>
                                            </div>
                                            <div class="span6">
                                                <ul class="footer-list foots" id="yw1" style="margin-left: 0px;color:#000;text-align: right;">
                                                    <li>Total Anggota : <strong> <?php echo BbiiMember::model()->count(); ?></strong> <span class="divider">|</span> Anggota Terakhir: <strong><?php
                                                            $member = BbiiMember::model()->newest()->find();
                                                            if (empty($member)) {
                                                                echo'';
                                                            } else {
                                                                echo CHtml::link($member->member_name, array('class' => 'foots'), array('class' => 'foots', 'member/view', 'id' => $member->id));
                                                            }
                                                            ?></strong></li>
                                                    <li><div class="kwhoonline kwho-total ks">
                                                            Jumlah Keseluruhan<strong>&nbsp;<?php echo ($present + $members) ?></strong>&nbsp;anggota&nbsp;Online&nbsp;&nbsp;::&nbsp;&nbsp;<strong><?php echo $members ?> </strong>Anggota&nbsp;dan<strong> <?php echo $present ?> </strong>Tamu&nbsp;				</div></li>


                                                </ul>
                                            </div>
                                        </div>



                                    </div>


                                </article>
                            </div>
                            <div class="span3">

                                <div class="sidebarblock">
                                    <div id="wrapper">

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
                                <div name="login-form" class="login-form">
                                    <div class="header2">
                                        <div class="text">Posting Pilihan</div>
                                        <ul class="topic">
                                            <?php
                                            $topic = BbiiTopic::model()->findAll(array('order' => 'rand()', 'limit' => 6));
                                            foreach ($topic as $tt) {
                                                echo'<li><a href="' . url('forum/forum/topic', array('id' => $tt->id)) . '">' . ucfirst($tt->title) . '</a>
                                                      <div class="aa">' . date('d M Y H:i:s', strtotime($tt->firstPost->create_time)) . '</div></li>';
                                            }
                                            ?>


                                        </ul>
                                    </div>
                                </div>

                                <div name="login-form" class="login-form" >
                                    <div class="header2">
                                        <div class="text">Online Messager</div>
                                        <ul class="topic">
                                            <li><img src="<?php echo param('urlImg') ?>file/ym.png" style="width: 12%;"> Yaho Messager <span style="float: right"> <a href="ymsgr:sendIM?secsawiran"><img src="http://opi.yahoo.com/online?u=secsawiran&m=g&t=1/"></a></span></li>
                                            <li><img src="<?php echo param('urlImg') ?>file/wa.png" style="width: 12%;"> Whatsapp  <span style="font-weight: 100;float: right">085649543999</span> </li>
                                            <li><img src="<?php echo param('urlImg') ?>file/bbm.png" style="width: 12%;"> BBM <span style="font-weight: 100;float: right">-</span></li>


                                        </ul>
                                    </div>
                                </div>
                                <?php $this->renderPartial('common.themes.frontend.sec.views.layouts.topMember', array()); ?>

                            </div>
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
<?php
cs()->registerScript('', '
    $(".carousel").carousel({
        interval: 6000
    });

    $(".carousel").carousel("cycle");
    ', CClientScript::POS_END);
?>
