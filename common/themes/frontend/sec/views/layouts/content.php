<style>


</style>
<section class="content2" style=" ">
    <div class="container">
        <div class="row-fluid">
            <div class="span9" style="margin-top: 10px;">
                <!--                            <ul class="nav nav-tabs" id="myTab" style="background:none">
                                                <li class="active"><a href="#home">Forum</a></li>
                                                <li><a href="#profile">List Anggota</a></li>
                                                <li><a href="#messages">Search</a></li>
                                            </ul>-->
                <div class="well" style="padding: 15px;">
                    <?php echo $content ?>

                </div>
            </div>
            <div class="span3" style="margin-top: 10px;">
                <div name="login-form" class="login-form">

                    <div class="header">
                        <?php
                        $user = '';
//                        echo user()->id;
                        $user = BbiiMember::model()->findByPk(user()->id);
                        ?>
                        <br>
                        <img src="<?php echo $user->imgUrl['small'] ?>" class="img-responsive img-rounded " style="width:35%;margin-left: 50px;">
                        <h2><?php echo $user->member_name ?>.</h2>
                        <span><?php echo $user->business->name . ' - ' . $user->phone ?>.</span><br>
                        <span><?php echo $user->address ?>.</span>

                    </div>
                </div>
                <div name="login-form" class="login-form">

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
                            <li><a  href="<?php echo url('forum/member/myPost', array('id' => user()->id)) ?>"><i class="icon-file"></i> My Post</a></li>
                            <li><a  href="<?php echo url('forum/message/inbox') ?>"><i class="icon-envelope-alt"></i>Inbox <span class="badge badge-info"><?php echo $inbox ?></span></a>  </li>
                            <li><a  href="<?php echo url('forum/message/outbox') ?>"><i class=" icon-share-alt"></i>Outbox <span class="badge badge-inverse"><?php echo $outbox ?></span></a></li>
                            <?php if ($user->moderator == 1) { ?>
                                <li><a  href="<?php echo url('forum/moderator/approval') ?>"><i class="icon-ok-sign"></i>Approval <span class="badge badge-warning"><?php echo $approval ?></span></a></li>
                                <li><a  href="<?php echo url('forum/moderator/report') ?>"><i class="icon-info-sign"></i>Report <span class="badge badge-danger"><?php echo $report ?></span></a></li>
                            <?php } ?>
                        <!--<li><a href="<?php // echo url('site/logout')  ?>"><i class="icon-signout"></i>Logout</a></li>-->
                        </ul>

                    </div>

                </div>
                <div name="login-form" class="login-form">
                                    <div class="header2">
                                        <div class="text">Ada pertanyaan ?</div>
                                        <center>
                                            <a href="ymsgr:sendIM?indomobilecell">
                                                <img border="0" src="http://opi.yahoo.com/online?u=indomobilecell&amp;m=g&amp;t=14"></a>
                                        </center>   
                                    </div>
                                </div><br>

                                <center> <img src="<?php echo param('urlImg') ?>file/iklan.png" alt="" /></center>
                                <br>
                <?php $this->renderPartial('common.themes.frontend.sec.views.layouts.topMember', array()); ?>

            </div>
        </div>
    </div>
</section>
<script>
//    jQuery(function($) {
//  function fixDiv() {
//    var $cache = $('#getFixed');
//    if ($(window).scrollTop() > 100)
//      $cache.css({
//        'position': 'fixed',
//        'top': '10px',
//        'width':'20.8%'
//      });
//    else
//      $cache.css({
//        'position': 'relative',
//        'top': 'auto',
//        'width':'auto'
//      });
//  }
//  $(window).scroll(fixDiv);
//  fixDiv();
//});
</script>