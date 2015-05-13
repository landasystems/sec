<?php
/* @var $this ForumController */
$present = BbiiSession::model()->present()->count();
$members = BbiiMember::model()->present()->count();
?>
<style>
    .foots a{
        color:#5388B4;
    }
</style>
<div id="bbii-footer" class="bootstrap-widget-content ">


    <article class="clearfix">


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
