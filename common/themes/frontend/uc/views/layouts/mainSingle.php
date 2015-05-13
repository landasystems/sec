<!DOCTYPE html> 
<html lang="en"> 
    <head> 
        <title>Website masih dalam pengembangan</title> 
        <meta name="author" content="Landa Systems - Profesional Website Development - Your Business Grown Here" />
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php
        cs()->registerCssFile(bt('css/style.css'));
        cs()->registerScriptFile(bt('js/jquery.countdown.js'));
        cs()->registerScriptFile(bt('js/jquery.tipsy.js'));
        cs()->registerScriptFile(bt('js/jquery.subscribe.js'));
        cs()->registerScriptFile(bt('js/jquery.contact.js'));
        ?>
        <script type="text/javascript">
            $(document).ready(function() {

//cowntdown function. Set the date by modifying the date in next line (January 01, 2013 00:00:00):
                var austDay = new Date("Mar 25, 2015 12:00:00");
                $('#countdown').countdown({until: austDay, layout: '<div class="item"><p>{dn}</p> <span>-{dl}-</span></div> <div class="item"><p>{hn}</p> <span>-{hl}-</span></div> <div class="item"><p>{mn}</p> <span>-{ml}-</span></div> <div class="item"><p>{sn}</p> <span>-{sl}-</span></div>'});
                $('#year').text(austDay.getFullYear());

//function for the social hover effect - tooltips		
                $('.tooltip').tipsy
                        ({
                            fade: true,
                            gravity: 's'
                        });

//function for the contact-form dropdown
                function contact() {
                    if ($("#cform").is(":hidden"))
                    {
                        $("#ribbon").css({"background": "url(<?php echo bt('images/ribbon.png') ?>) bottom left no-repeat"});
                        $("#home").slideUp("fast");
                        $("#cform").slideDown("slow");
                    }
                    else {
                        $("#ribbon").css({"background": "url(<?php echo bt('images/ribbon.png') ?>) top left no-repeat"});
                        $("#cform").slideUp("slow");
                        $("#home").slideDown("slow");
                    }
                }

//run contact form when the ribbon is clicked
                $(".contact").click(function() {
                    contact()
                });
            });
        </script>
        <style type="text/css">
            <!--



            .val-email {
                font: 8pt verdana;
                font-weight:bold; 
                text-decoration:none;
                background-color: #dff0d8;
                border-color: #d6e9c6;
                color: #468847;
                padding: 8px 35px 8px 14px;
                margin-bottom: 20px;
                text-shadow: 0 1px 0 rgba(255, 255, 255, 0.5);
                background-color: #fcf8e3;
                border: 1px solid #fbeed5;
                -webkit-border-radius: 4px;
                -moz-border-radius: 4px;
                border-radius: 4px;
            }
            .form-horizontal .controls{
                margin-left: 1px;
            }
            input {
                color: #000000;
                background: #F8F8F8;
                border: 1px solid #353535;
                width:250px;
                font: 8pt verdana;
                font-weight:normal; 
                text-decoration:none;
                margin-top:5px; 
            }
            -->
        </style>
    </head> 

    <body> 
        <div id="wrapper">


            <div id="book">		

                <div class="content-page">
                    <div class="top-spiral"></div>
                    <div class="bottom-spiral"></div>
                    <div class="bottom-spiral2"></div>

                    <!--end cform-->

                    <div id="home">
                        <header>
                            <a class="logo" href="<?php echo url('index') ?>"><img src="<?php echo bt('images/logo.png') ?>" alt="logo" title="logo" /></a>

                        </header>

                        <div class="row"></div>
                        <h3>Kita sedang bekerja keras, hitungan mundur untuk Go Live :</h3>

                        <div id="countdown"></div>	
                        <div class="clear"></div>
                        <div class="form-wrapper2" >
                            <?php echo $content ?>
                        </div>
                        <div class="row"></div>
                        <div class="form-wrapper2" style="float:left">

                               <?php
                            $anggota_jum = BbiiMember::model()->findAll(array('condition' => ' id != 1'));
                            $anggota = BbiiMember::model()->findAll(array('condition' => ' id != 1', 'limit' => 14));
                            $jumlah = count($anggota_jum);
                            echo '<h3><strong style="color:#000">' . $jumlah . '</strong> Anggota Sudah Terdaftar</h3>';
                            foreach ($anggota as $a) {
                                echo'<div style="width: 65px;height: 65px;margin: 8px;float: left;"><img src="' . $a->imgUrl['small'] . '" class="img-polaroid img-rounded" title="' . $a->member_name . ' " style="height: 65px;width: 60px;"/></div>';
                            }
                            ?>
                        </div>
                        <!--end form-wrapper-->
                    </div><!--end home-->

                </div><!--end content-page-->


            </div><!--end book-->

            <p class="copyright">Copyright 2015 &copy; <a href="http://www.landa.co.id" target="_blank">SEC Sawiran</a> - Profesional Website Development - All Rights Reserved</p>
            <script type="text/javascript">


            </script>
        </div><!--end wrapper-->
    </body> 
</html>

