<?php
/* @var $this SiteController */
$this->pageTitle = 'Dashboard - Selamat Datang di Area Administrator';
$siteConfig = SiteConfig::model()->listSiteConfig();
?>
<div class="row-fluid">
    <div class="span8">
        <div class="row-fluid">
            <div class="box gradient">
                <div class="content" style="display: block;">
                    <?php
                    
                    $visitor = cmd('
                            SELECT DATE_FORMAT(last_visit,"%M %Y") as dateMonth,count(id) as amount
                            FROM bbii_session
                            WHERE `last_visit` <= now() 
                            AND `last_visit` >= now() - INTERVAL 6 MONTH
                            GROUP BY YEAR(last_visit), MONTH(last_visit)')->queryAll();
                    
                    
                    $result = array();
                    foreach ($visitor as $value) {
                        $result[$value['dateMonth']] = $value['amount'];
                    }

                    $arrVisitor = array();
                    for ($index = 5; $index > -1; $index--) {
                        $sDate = date("F Y", strtotime("-" . $index . " months"));
                        $categories[] = $sDate;
                        $arrVisitor[] = (isset($result[$sDate]) ? (int) $result[$sDate] : 0);
                        //                            $arrOutbox[] = (isset($resultOutbox[$sDate]) ? (int) $resultOutbox[$sDate] : 0);
                    }

                    $this->Widget('common.extensions.highcharts.HighchartsWidget', array(
                        'options' => array(
                            'title' => array('text' => ''),
                            'xAxis' => array(
                                'categories' => $categories
                            ),
                            'yAxis' => array(
                                'title' => array('text' => 'Visitor')
                            ),
                            'series' => array(
                                array('name' => 'Pengunjung per Bulan', 'data' => $arrVisitor),
//                                    array('name' => 'Total semua Pengunjung '.$semua),
                            ),
                            'legend' => array(
                                'enabled' => true
                            ),
                            'credits' => array(
                                'enabled' => false
                            ),
                        )
                    ));
                    $tot = BbiiSession::model()->findAll();
                    $semua = count($tot);
                    ?>
                    <center><span class="label label-info">Total semua pengunjung : <b><?php echo $semua ?></b> orang</span></center> 
                </div>
            </div>
            <?php if (in_array('content', param('menu'))) { ?>
                <div class="box">
                    <div class="title">

                        <h4>
                            <span class="icon16 iconic-icon-bars"></span>
                            <span>Popular Articles </span>
                        </h4>
                        <a href="#" class="minimize" style="display: none;">Minimize</a>
                    </div>
                    <div class="content">

                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <th>Popular Items</th>
                                    <th>Created</th>
                                    <th>Hits</th>
                                </tr>
                                <?php
                                $oArticles = Article::model()->findAll(array('order' => 'hits DESC', 'limit' => '5'));
                                foreach ($oArticles as $oArticle) {
                                    echo '<tr>
                                        <td>' . $oArticle->title . '</td>
                                        <td>' . date('d F Y', strtotime($oArticle->created)) . '</td>
                                        <td>' . $oArticle->hits . '</td>
                                      </tr>';
                                }
                                ?>
                            </tbody>
                        </table>

                    </div>
                </div><!-- End .box -->  
                <div class="box">
                    <div class="title">

                        <h4>
                            <span class="icon16 iconic-icon-bars"></span>
                            <span>Recently Added Articles </span>
                        </h4>
                        <a href="#" class="minimize" style="display: none;">Minimize</a>
                    </div>
                    <div class="content">

                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <th>Latest Items</th>
                                    <th>Created</th>
                                    <th>Hits</th>
                                </tr>
                                <?php
                                $oArticles = Article::model()->findAll(array('order' => 'created DESC', 'limit' => '5'));
                                foreach ($oArticles as $oArticle) {
                                    echo '<tr>
                                        <td>' . $oArticle->title . '</td>
                                        <td>' . date('d F Y', strtotime($oArticle->created)) . '</td>
                                        <td>' . $oArticle->hits . '</td>
                                      </tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div><!-- End .box -->  
            <?php } ?>

            <?php if (in_array('sms', param('menu'))) { ?>
                <div class="box gradient">
                    <div class="content" style="display: block;">
                        <?php
                        $inbox = cmd('
                            SELECT DATE_FORMAT(created,"%M %Y") as dateMonth,count(id) as amount
                            FROM acca_sms_detail
                            WHERE `created` <= now() 
                            AND `created` >= now() - INTERVAL 6 MONTH
                            AND  `date_received` is not NULL
                            GROUP BY YEAR(created), MONTH(created)')->queryAll();
                        $outbox = cmd('
                            SELECT DATE_FORMAT(created,"%M %Y") as dateMonth,count(id) as amount
                            FROM acca_sms_detail
                            WHERE `created` <= now() 
                            AND `created` >= now() - INTERVAL 6 MONTH
                            AND  `date_received` is NULL
                            GROUP BY YEAR(created), MONTH(created)')->queryAll();

                        $result = array();
                        foreach ($inbox as $value) {
                            $result[$value['dateMonth']] = $value['amount'];
                        }

                        $resultOutbox = array();
                        foreach ($outbox as $value) {
                            $resultOutbox[$value['dateMonth']] = $value['amount'];
                        }


                        $arrInbox = array();
                        for ($index = 5; $index > -1; $index--) {
                            $sDate = date("F Y", strtotime("-" . $index . " months"));
                            $categories[] = $sDate;
                            $arrInbox[] = (isset($result[$sDate]) ? (int) $result[$sDate] : 0);
                            $arrOutbox[] = (isset($resultOutbox[$sDate]) ? (int) $resultOutbox[$sDate] : 0);
                        }

                        $this->Widget('common.extensions.highcharts.HighchartsWidget', array(
                            'options' => array(
                                'title' => array('text' => 'Statistik SMS 6 Bulan Terakhir'),
                                'xAxis' => array(
                                    'categories' => $categories
                                ),
                                'yAxis' => array(
                                    'title' => array('text' => 'Amount (Rp.)')
                                ),
                                'series' => array(
                                    array('name' => 'Pesan Masuk', 'data' => $arrInbox),
                                    array('name' => 'Pesan Terkirim', 'data' => $arrOutbox),
                                ),
                                'legend' => array(
                                    'enabled' => true
                                ),
                                'credits' => array(
                                    'enabled' => false
                                ),
                            )
                        ));
                        ?>
                    </div>
                </div><!-- End .box -->

            <?php } ?>
        </div>
    </div>
    <div class="span4">
        <div class="row-fluid">
            <div class="box">
                <div class="title">

                    <h4>
                        <span class="icon16 silk-icon-office"></span>
                        <span><?php echo Yii::app()->session['site']['client_name'] ?></span>
                    </h4>
                </div>
                <div class="content">
                    <?php
                    $img = Yii::app()->landa->urlImg('site/', $siteConfig->client_logo, param('id'));
                    echo '<img src="' . $img['small'] . '" class="img-polaroid" width="100%"/>';
                    ?>
                    <div class="clearfix"></div>
                    <dl>
                        <dt>Address</dt>
                        <dd><?php echo $siteConfig->fullAddress ?></dd>
                        <dt>Telephone</dt>
                        <dd><?php echo $siteConfig->phone ?></dd>
                        <dt>Email</dt>
                        <dd><?php echo $siteConfig->email ?></dd>
                    </dl>
                </div>

            </div>
            <?php
            if (in_array('sms', param('menu')) && landa()->checkAccess('Sms', 'r')) {
                $smsInfo = SmsInfo::model()->find(array('order' => 'id DESC'));
                ?>
                <div class="box">
                    <div class="title">
                        <h4>
                            <span class="icon16 minia-icon-mobile"></span>
                            <span>Celullar Information</span>
                        </h4>
                    </div>
                    <div class="content">
                        <div class="row-fluid">
                            <div class="span4"><b>Checking Date</b></div>
                            <div class="span8">: <?php if (!empty($smsInfo)) echo date('d F Y, H:i', strtotime($smsInfo->time_check)) ?></div>
                        </div>
                        <div class="row-fluid">
                            <div class="span4"><b>Provider</b></div>
                            <div class="span8">: <?php if (!empty($smsInfo)) echo $smsInfo->provider ?></div>
                        </div>
                        <div class="row-fluid">
                            <div class="span4"><b>Phone Number</b></div>
                            <div class="span8">: <?php if (!empty($smsInfo)) echo $smsInfo->phone ?></div>
                        </div>
                        <div class="row-fluid">
                            <div class="span4"><b>Info</b></div>
                            <div class="span8">: <?php if (!empty($smsInfo)) echo $smsInfo->content ?></div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <div class="todo">
                <h4>Latest Logged-in Users
                    <a href="#" class="icon tip" oldtitle="Configure" title=""><span class="icon16 iconic-icon-cog"></span></a>

                </h4>
                <ul>

                    <?php
                    $listUser = User::model()->listUser();
                    $oUserLogs = UserLog::model()->findAll(array('order' => 'created DESC', 'limit' => '5'));
                    foreach ($oUserLogs as $oUserLog) {
                        if (isset($oUserLog->User->Roles->name)) {
                            echo '<li class="clearfix">' .
                            $oUserLog->User->name . ' | ' . $oUserLog->User->Roles->name . '
                        <span class="label pull-right" style="margin-top: 6px;">' . landa()->ago($oUserLog->created) . '</span>
                        </li> ';
                        };
                    }
                    ?>

                </ul>
            </div><!-- End .reminder -->
            <!--            <div class="box">
                            <div class="title">
                                <h4>
                                    <span class="icon16 silk-icon-office"></span>
                                    <span>Website Statistic</span>
                                </h4>
                            </div>
                            <div class="content">
                                 Histats.com  START  (standard)
                                <div class="row-fluid">
                                    <div class="span3">
                                        <ul class="bigBtnIcon">
                                            <li>
                                                <a href="<?php //echo $siteConfig->histats_link              ?>" class="tipB" title="" aria-describedby="ui-tooltip-23">
                                                    <span class="icon brocco-icon-stats"></span>
                                                    <span class="txt">Click to view Website Stats</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="span9">
                                        Klik counter disamping untuk mendapatkan detail dari pengunjung website Anda. Kami menggunakan bantuan Tools Counter (Pihak Ketiga) agar keakuratan counter pengunjung dapat diperoleh lebih detail.
                                    </div>
                                </div>
                                 Histats.com  END  
                            </div>
                        </div>-->

        </div>
    </div>
</div>
