<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo param('clientName') ?></title>




        <?php
        cs()->registerCssFile(bt('css/custom.css'));
        cs()->registerCssFile(bt('font-awesome-4.0.3/css/font-awesome.min.css'));
        cs()->registerCssFile(bt('css/style.css'));
        cs()->registerCssFile(bt('css/menu.css'));
        cs()->registerCssFile(bt('css/login.css'));
        ?>
    </head>
    <body>

        <div class="container-fluid">

            <!-- Slider -->

            <!-- //Slider -->

            <?php $this->renderPartial('common.themes.frontend.sec.views.layouts.header', array()); ?>

            <section class="content2" style="background-color:">
                <div class="container">
                    <div class="row-fluid">

                        <div class="span8 ">
                            <div id="myCarousel" class="carousel slide" style="margin-top: 10px;">

                                <!-- Carousel items -->
                                <div class="carousel-inner">
                                    <div class="active item"><img src="<?php echo param('urlImg') ?>file/slider/4.jpg" alt="" /></div>
                                    <div class="item"><img src="<?php echo param('urlImg') ?>file/slider/4.jpg" alt="" /></div>
                                    <div class="item"><img src="<?php echo param('urlImg') ?>file/slider/4.jpg" alt="" /></div>
                                </div>
                                <!-- Carousel nav -->
                                <a class="carousel-control left" href="#myCarousel" data-slide="prev" style="background: none;border: none"><img src="<?php echo bt('images/prev2.png') ?>"></a>
                                <a class="carousel-control right" href="#myCarousel" data-slide="next" style="background: none;border: none"><img src="<?php echo bt('images/next2.png') ?>"></a>
                                <img src="<?php echo bt('images/shadow3.png') ?>" style="width: 100%;height: 40px;">
                            </div>
                            <!-- POST -->
                            
                        </div>
                        <div class="span4">
                            <div class="sidebarblock">
                                <div id="wrapper">

                                    <form name="login-form" class="login-form" action="" method="post">

                                        <div class="header">
                                            <h1>Selamat Datang, <?php echo user()->member_name ?></h1>
                                            
                                        </div>

                                        <div class="content">
                                            <input name="username" type="text" class="input" placeholder="NBA Anggota" />


                                            <div class="user-icon"></div>
                                            <input name="password" type="password" class="input" placeholder="Password" />
                                            <div class="pass-icon"></div>		
                                        </div>

                                        <div class="footer">

                                            <input type="submit" name="submit" value="Masuk" class="button" />
                                            <input type="submit" name="submit" value="Daftar" class="button" />
                                        </div>

                                    </form>

                                </div>

                            </div>
                            

                            
                            
                        </div>
                    </div>
                </div>
            </section>
            
            <section class="content2" style="background-color:">
                <div class="container">
                    <div class="row-fluid">
                        <div class="span12">
<!--                            <ul class="nav nav-tabs" id="myTab" style="background:none">
                                <li class="active"><a href="#home">Forum</a></li>
                                <li><a href="#profile">List Anggota</a></li>
                                <li><a href="#messages">Search</a></li>
                            </ul>-->

                            <div class="tab-content">
                                <div class="tab-pane active" id="home">
                                     <?php echo $content ?>
                                </div>
                                <div class="tab-pane" id="profile">Dalam Pengerjaan.</div>
                                <div class="tab-pane" id="messages">c</div>
                            </div>
                        </div>
                    </div>
                    </div>
            </section>
           
            <?php $this->renderPartial('common.themes.frontend.sec.views.layouts.footer', array()); ?>
        </div>
        <script>
       $('#myTab a').click(function (e) {
  e.preventDefault();
  $(this).tab('show');
})
        </script>
