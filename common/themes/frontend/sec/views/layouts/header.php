<script type="text/javascript">
            $(document).ready(function() {
                $(window).scroll(function() {
                    if ($(document).scrollTop() <= 40) {
                        $('#header-full').removeClass('small');
                        $('.tabs-blur').removeClass('no-blur');
                        $('#main-header').removeClass('small');
                    } else {
                        $('#header-full').addClass('small');
                        $('.tabs-blur').addClass('no-blur');
                        $('#main-header').addClass('small');
                    }
                });
            });
        </script>
<header id="main-header" class="clearfix">
    <!--<div class="container">-->
            <div id="header-full" class="clearfix">
                <div id="header" class="clearfix">
                    <a href="#nav" class="open-menu">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <a href="<?php echo url('forum') ?>" id="logo"><img src="<?php echo param('urlImg') ?>file/logo.png" data-retina="<?php echo bt('images/logo-retina.png') ?>" style="width:149px" alt="School Fun - WordPress Theme" /></a>
                    <aside id="header-content">
                        <form action="<?php echo url('topic/cari') ?>" method="get" id="searchform">
                        <div class="wrap">
                            <div class="search">
                                <input type="text" name="cari" id="search" placeholder="Pencarian Topik & Posting" required>
                                <input type="submit" class="searchButton">
                            </div>
                        </div>
                        </form>
                        
                        <h3 id="slogan">"Solusi cerdas untuk berkembang dan berbagi"</h3>
                    </aside>
                </div>
            </div>
            <nav id="nav" class="clearfix">
                <a href="#" class="close-menu-big">Close</a>
                <div id="nav-container">
                    <a href="#" class="close-menu">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <?php $this->widget('common.extensions.landa.widgets.LandaMenu', array('htmlOptions' => array('class' => 'nav-menu pull-right'), 'menu_category_id' => 1)); ?>
                    <?php
                    if(isset(user()->id)){
//                        $a = explode(' ', user()->member_name);
                        echo'<a href="'.url('site/logout').'" id="button-registration"><i class="icon-signout"></i> Logout</a>';
                    }else{
                        echo'<a href="'.url('register').'" id="button-registration">Daftar Sekarang</a>';
                    }
                    ?>
                    
                    <!--<a href="#" id="button-registration">Registration</a>-->
                </div>
            </nav>
        <!--</div>-->
        </header>