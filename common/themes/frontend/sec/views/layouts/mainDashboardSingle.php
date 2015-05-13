<!DOCTYPE html>
<html>
    <head>
        <title><?php echo param('clientName') ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <!-- Bootstrap -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="<?php echo bt() ?>/images/file/favicon.ico" />
        <?php
        cs()->registerCssFile(bt('css/capture.css'));
        ?>

    </head>
    <body>
        <div id="header" class="fixed-header-container">
            <div class="container">
                <div class="row">
                    <div class="span12">
                        <div class="navbar">
                            <div class="navbar-inners fixed-header-active">
                                <div class="container">
                                    <div class="nav-container-outer" style="margin-top: 70px;" >
                                        <div class="nav-container-inner">
                                            <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                                                <span class="icon-bar"></span>
                                                <span class="icon-bar"></span>
                                                <span class="icon-bar"></span>
                                            </button>
                                            <div class="logo">
                                                <a class="brand pull-left" href="<?php echo url('dashboard') ?>"><img class="logo" src="<?php echo bt('img/logo.png') ?>" alt="Capture Logo" width="220" style="padding: 10px;"/></a>
                                            </div><!--/logo-->

                                            <div class="nav-collapse collapse">
                                                <?php $this->widget('common.extensions.landa.widgets.LandaMenu', array('htmlOptions' => array('class' => 'nav pull-left '), 'itemCssClass' => 'dropdown', 'submenuOptions' => array('class' => 'dropdown-menu'), 'menu_category_id' => 4)); ?>

                                            </div><!--nav collapse-->
                                            <div class="searchtophead pull-right">
                                                <div class="searchtop">&nbsp;<i class="icon-search"></i>&nbsp;<input type="text" name="search" placeholder="Search..." /></div>
                                            </div><!--/search-->
                                        </div>
                                    </div>
                                </div><!--/container-->
                            </div><!--/navbar inner-->
                        </div><!--/navbar-->

                    </div><!--/span12-->
                </div><!--/row-->
            </div><!--/container-->
        </div><!--/header-->




        <div class="white inner-page padding-inner">

            <div class="container">
                <div class="row">
                    <div class="span12">
                        <?php echo $content; ?>					
                    </div><!--span9 -->



                </div><!--row -->
            </div><!--/container-->
        </div><!--/white-->

        <div class="testimonials">
            <div class="container">
                <div class="row">
                    <div class="span8 offset2 center">
                        <i class="fontawesome-icon medium circle-white center icon-quote-left test-quote-icon"></i>
                        <div id="cbp-qtrotator" class="cbp-qtrotator">
                            <?php
                            $testi = Testimonial::model()->findAll(array('limit' => 5, 'order' => 'id desc'));
                            foreach ($testi as $a) {
                                echo'<div class="cbp-qtcontent">
                                <blockquote>
                                    <p>' . $a->testimonial . '.</p>
                                    <div class="quote-avatar">
                                        <img class="img-circle" src="' . $a->img['small'] . '" alt="avatar" width="200" height="200" />
                                    </div><!--/quote avatar-->
                                    <small>' . $a->name . '</small>
                                </blockquote>
                            </div>';
                            }
                            ?>
                        </div>
                    </div><!--/span6-->
                </div><!--/row-->
            </div><!--/container-->
        </div><!--/testimonials-->



        <div class="footer">
            <div class="container">
                <div class="row">
                    <div class="span6">
                        <p class="copyright">Copyright 2014 <a href="#">member.landa.co.id</a> - All Rights Reserved</p>
                    </div><!--/span 6-->
                    <div class="span6 social-icons">
                        <a href="#"><i class="fontawesome-icon social circle-social icon-facebook"></i></a>
                        <a href="#"><i class="fontawesome-icon social circle-social icon-twitter"></i></a>
                        <a href="#"><i class="fontawesome-icon social circle-social icon-github"></i></a>
                        <a href="#"><i class="fontawesome-icon social circle-social icon-linkedin"></i></a>
                        <a href="#"><i class="fontawesome-icon social circle-social icon-google-plus"></i></a>
                    </div><!--/span 6-->
                </div><!--/row-->
            </div><!--/container-->
        </div><!--/footer-->
        <?php
        cs()->registerScriptFile(bt('js/modernizr.custom.js'));
        cs()->registerScriptFile(bt('js/testimonials.js'));
        ?>
    </body>
</html>
