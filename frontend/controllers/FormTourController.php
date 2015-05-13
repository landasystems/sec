<?php

class FormTourController extends Controller {

    public $breadcrumbs;

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = 'mainSingle';

    /**
     * @return array action filters
     */

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        cs()->registerMetaTag('pesan, paket, tour, murah, karimun, jawa, terrekomendasi, aman, meriah', 'keywords', null, array());
        cs()->registerMetaTag(param('clientName') . '.' . 'paket tour murah meriah dan aman di pulau karimunjawa', 'description', null, array());
        cs()->registerMetaTag('pesan paket tour karimunjawa', null, null, array('property' => 'og:title'));
        cs()->registerMetaTag('order', null, null, array('property' => 'og:type'));
        cs()->registerMetaTag(param('client'), null, null, array('property' => 'og:site_name'));

        $model = new FormTour;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['FormTour'])) {
            $model->attributes = $_POST['FormTour'];
            if (isset($_POST['FormTour']['gender']) && isset($_POST['kamar']) && isset($_POST['harga']) && isset($_POST['kapal']) && isset($_POST['date_start']) && isset($_POST['date_end'])) {

                $model->gender = $_POST['FormTour']['gender'];
                $model->paket = $_POST['FormTour']['paket'];
                $model->hotel = $_POST['FormTour']['hotel'];
                $model->kamar = $_POST['kamar'];
                $model->kapal = $_POST['kapal'];
                $model->harga = $_POST['harga'];
                $model->date_start = date('Y-m-d', strtotime($_POST['date_start']));
                $model->date_end = date('Y-m-d', strtotime($_POST['date_end']));
//                $model->description = $_POST['FormTour']['description'];
            }
            if ($model->save())
            //save to send email
                $hotel = '';
            $paket = '';
            $kapal = '';
            if ($model->hotel == '4d_1') {
                // =================PAKET 4 HARI 3 MALAM====================
                $hotel = 'Homestay';
            } elseif ($model->hotel == '4d_2') {
                $hotel = 'Hotel Cikal Karimun Jawa';
            } elseif ($model->hotel == '4d_3') {

                $hotel = 'Hotel New Ocean';
            } elseif ($model->hotel == '4d_4') {

                $hotel = 'Karimun Jawa Inn';
            } elseif ($model->hotel == '4d_5') {

                $hotel = 'Wisma Apung';
            } elseif ($model->hotel == '4d_6') {

                $hotel = 'Mangrove Inn';
            } elseif ($model->hotel == '4d_7') {

                $hotel = 'Dewanfaru Resort';
            } elseif ($model->hotel == '4d_8') {

                $hotel = 'Wisma Wisata';
            } elseif ($model->hotel == '3d_1') {
                // ========================PAKET 3 HARI 2 MALAM========================
                $hotel = 'Homestay';
            } elseif ($model->hotel == '3d_2') {
                $hotel = 'Hotel CIkal Karimun Jawa';
            } elseif ($model->hotel == '3d_3') {

                $hotel = 'Nirwana Resort Hotel';
            } elseif ($model->hotel == '3d_4') {

                $hotel = 'Hotel New Ocean';
            } elseif ($model->hotel == '3d_5') {

                $hotel = 'Karimun Jawa Inn';
            } elseif ($model->hotel == '3d_6') {

                $hotel = 'Wisma Apung';
            } elseif ($model->hotel == '3d_7') {

                $hotel = 'Mangrove Inn';
            } elseif ($model->hotel == '3d_8') {

                $hotel = 'Dewandaru Resort';
            } elseif ($model->hotel == '3d_9') {
                $hotel = 'Wisma Wisata';
            } elseif ($model->hotel == '2d_1') {
                // =======================PAKET 2 HARI 1 ============================
                $hotel = 'Homestay';
            } elseif ($model->hotel == '2d_2') {
                $hotel = 'Hotel CIkal Karimun Jawa';
            } elseif ($model->hotel == '2d_3') {


                $hotel = 'Nirwana Resort Hotel';
            } elseif ($model->hotel == '2d_4') {

                $hotel = 'Hotel New Ocean';
            } elseif ($model->hotel == '2d_5') {
                $hotel = 'Karimun Jawa Inn';
            } elseif ($model->hotel == '2d_6') {
                $hotel = 'Wisma Apung';
            } elseif ($model->hotel == '2d_7') {
                $hotel = 'Mangrove Inn';
            } elseif ($model->hotel == '2d_8') {
                $hotel = 'Dewan Daru Resort';
            } elseif ($model->hotel == '2d_9') {
                $hotel = 'Wisma Wisata';
            } else {
                $hotel = 'Wisma Wisata';
            }
            echo $hotel;

            //paket
            if ($model->paket == '4d3n') {
                $paket = '4 Hari 3 Malam';
            } elseif ($model->paket == '3d2n') {
                $paket = '3 Hari 2 Malam';
            } else {
                $paket = '2 Hari 1 Malam';
            }

            //kapal
            if ($model->kapal == '1') {
                $kapal = ' Express (executive)';
            } elseif ($model->kapal == '2') {
                $kapal = ' Express (executive)2';
            } elseif ($model->kapal == '3') {
                $kapal = 'Express (executive) - Siginjai (ekonomi)';
            } elseif ($model->kapal == '4') {
                $kapal = ' Express (executive)';
            } elseif ($model->kapal == '5') {
                $kapal = 'Siginjai (ekonomi)';
            } elseif ($model->kapal == '6') {
                $kapal = ' Express (executive) - Siginjai (ekonomi)';
            } elseif ($model->kapal == '7') {
                $kapal = 'Express (executive)';
            } elseif ($model->kapal == '8') {
                $kapal = 'Siginjai (ekonomi)';
            } elseif ($model->kapal == '9') {
                $kapal = 'Express (executive) - Siginjai (ekonomi)';
            } elseif ($model->kapal == '10') {
                $kapal = ' Express (executive)';
            } elseif ($model->kapal == '11') {
                $kapal = 'Siginjai (ekonomi)';
            } elseif ($model->kapal == '12') {
                $kapal = ' Express (executive) - Siginjai (ekonomi)';
            } elseif ($model->kapal == '13') {
                $kapal = 'Express (executive)';
            } elseif ($model->kapal == '14') {
                $kapal = 'Siginjai (ekonomi) ';
            } elseif ($model->kapal == '15') {
                $kapal = 'Express (executive) - Siginjai (ekonomi)';
            } elseif ($model->kapal == '16') {
                $kapal = 'Express (executive)';
            } elseif ($model->kapal == '17') {
                $kapal = ' Siginjai (ekonomi)';
            } elseif ($model->kapal == '18') {
                $kapal = ' Express (executive) - Siginjai (ekonomi)';
            } elseif ($model->kapal == '19') {
                $kapal = 'Express (executive) ';
            } elseif ($model->kapal == '20') {
                $kapal = 'Siginjai (ekonomi) ';
            } elseif ($model->kapal == '21') {
                $kapal = 'Express (executive) - Siginjai (ekonomi)  ';
            } elseif ($model->kapal == '22') {
                $kapal = ' Express (executive) ';
            } elseif ($model->kapal == '23') {
                $kapal = 'Siginjai (ekonomi) ';
            } elseif ($model->kapal == '24') {
                $kapal = 'Express (executive) - Siginjai (ekonomi)  ';
            } elseif ($model->kapal == '25') {
                $kapal = ' Express (executive) ';
            } elseif ($model->kapal == '26') {
                $kapal = ' Siginjai (ekonomi) ';
            } elseif ($model->kapal == '27') {
                $kapal = 'Express (executive) - Siginjai (ekonomi) ';
            } elseif ($model->kapal == '28') {
                $kapal = 'Express (executive) ';
            } elseif ($model->kapal == '29') {
                $kapal = ' Siginjai (ekonomi) ';
            } elseif ($model->kapal == '30') {
                $kapal = 'Express (executive) - Siginjai (ekonomi) ';
            } elseif ($model->kapal == '31') {
                $kapal = ' Express (executive)';
            } elseif ($model->kapal == '32') {
                $kapal = ' Siginjai (ekonomi) ';
            } elseif ($model->kapal == '33') {
                $kapal = ' Express (executive) - Siginjai (ekonomi) ';
            } elseif ($model->kapal == '34') {
                $kapal = ' Express (executive)';
            } elseif ($model->kapal == '35') {
                $kapal = ' Siginjai (ekonomi) ';
            } elseif ($model->kapal == '36') {
                $kapal = ' Express (executive) - Siginjai (ekonomi) ';
            } elseif ($model->kapal == '37') {
                $kapal = ' Express (executive)';
            } elseif ($model->kapal == '38') {
                $kapal = ' Siginjai (ekonomi) ';
            } elseif ($model->kapal == '39') {
                $kapal = ' Express (executive) - Siginjai (ekonomi) ';
            } elseif ($model->kapal == '40') {
                $kapal = ' Express (executive) ';
            } elseif ($model->kapal == '41') {
                $kapal = 'Siginjai (ekonomi) ';
            } elseif ($model->kapal == '42') {
                $kapal = 'Express (executive) - Siginjai (ekonomi) ';
            } elseif ($model->kapal == '43') {
                $kapal = ' Express (executive) ';
            } elseif ($model->kapal == '44') {
                $kapal = ' Siginjai (ekonomi)';
            } elseif ($model->kapal == '45') {
                $kapal = 'Express (executive) - Siginjai (ekonomi) ';
            } elseif ($model->kapal == '46') {
                $kapal = 'Express (executive)';
            } elseif ($model->kapal == '47') {
                $kapal = ' Siginjai (ekonomi) ';
            } elseif ($model->kapal == '48') {
                $kapal = ' Maaf tidak tersedia  
                     ';
            } elseif ($model->kapal == '49') {
                $kapal = 'Express (executive) ';
            } elseif ($model->kapal == '50') {
                $kapal = ' Siginjai (ekonomi) ';
            } elseif ($model->kapal == '51') {
                $kapal = ' Maaf tidak tersedia  
                     ';
            } elseif ($model->kapal == '52') {
                $kapal = ' Express (executive) ';
            } elseif ($model->kapal == '53') {
                $kapal = ' Siginjai (ekonomi) ';
            } elseif ($model->kapal == '54') {
                $kapal = ' Maaf tidak tersedia  
                     ';
            } elseif ($model->kapal == '55') {
                $kapal = ' Express (executive) ';
            } elseif ($model->kapal == '56') {
                $kapal = ' Siginjai (ekonomi)  ';
            } elseif ($model->kapal == '57') {
                $kapal = ' Maaf tidak tersedia  
                     ';
            } elseif ($model->kapal == '58') {
                $kapal = 'Express (executive) ';
            } elseif ($model->kapal == '59') {
                $kapal = ' Siginjai (ekonomi)   ';
            } elseif ($model->kapal == '60') {
                $kapal = ' Maaf tidak tersedia  
                    ';
            } elseif ($model->kapal == '61') {
                $kapal = ' Express (executive)  ';
            } elseif ($model->kapal == '62') {
                $kapal = ' Siginjai (ekonomi)   ';
            } elseif ($model->kapal == '63') {
                $kapal = ' Maaf tidak tersedia  
                     ';
            } elseif ($model->kapal == '64') {
                $kapal = ' Express (executive)  ';
            } elseif ($model->kapal == '65') {
                $kapal = ' Siginjai (ekonomi)  ';
            } elseif ($model->kapal == '66') {
                $kapal = ' Maaf tidak tersedia  
                     ';
            } elseif ($model->kapal == '67') {
                $kapal = ' Express (executive)   ';
            } elseif ($model->kapal == '68') {
                $kapal = ' Siginjai (ekonomi)  ';
            } elseif ($model->kapal == '69') {
                $kapal = ' Maaf tidak tersedia  
                    ';
            } elseif ($model->kapal == '70') {
                $kapal = 'Express (executive)   ';
            } elseif ($model->kapal == '71') {
                $kapal = 'Siginjai (ekonomi)   ';
            } elseif ($model->kapal == '72') {
                $kapal = ' Maaf tidak tersedia  
                   ';
            } elseif ($model->kapal == '73') {
                $kapal = ' Express (executive)   ';
            } elseif ($model->kapal == '74') {
                $kapal = ' Siginjai (ekonomi)  ';
            } elseif ($model->kapal == '75') {
                $kapal = ' Maaf tidak tersedia  
                     ';
            } elseif ($model->kapal == '76') {
                $kapal = ' Express (executive)   ';
            } elseif ($model->kapal == '77') {
                $kapal = ' Siginjai (ekonomi)  ';
            } elseif ($model->kapal == '78') {
                $kapal = ' Maaf tidak tersedia  
                     ';
            } elseif ($model->kapal == '79') {
                $kapal = 'Express (executive)  ';
            } elseif ($model->kapal == '80') {
                $kapal = ' Siginjai (ekonomi)   ';
            } elseif ($model->kapal == '81') {
                $kapal = ' Maaf tidak tersedia  
                      ';
            } elseif ($model->kapal == '82') {
                $kapal = ' Express (executive) ';
            } elseif ($model->kapal == '83') {
                $kapal = 'Siginjai (ekonomi)   ';
            } elseif ($model->kapal == '84') {
                $kapal = ' Maaf tidak tersedia  
                      ';
            } elseif ($model->kapal == '85') {
                $kapal = ' Express (executive) ';
            } elseif ($model->kapal == '86') {
                $kapal = 'Siginjai (ekonomi)  ';
            } elseif ($model->kapal == '87') {
                $kapal = ' Maaf tidak tersedia  
                      ';
            } elseif ($model->kapal == '88') {
                $kapal = ' Express (executive)   ';
            } elseif ($model->kapal == '89') {
                $kapal = ' Siginjai (ekonomi)   ';
            } elseif ($model->kapal == '90') {
                $kapal = ' Maaf tidak tersedia  
                       ';
            } elseif ($model->kapal == '91') {
                $kapal = 'Express (executive)   ';
            } elseif ($model->kapal == '92') {
                $kapal = ' Siginjai (ekonomi)   ';
            } elseif ($model->kapal == '93') {
                $kapal = ' Maaf tidak tersedia  
                      ';
            } elseif ($model->kapal == '94') {
                $kapal = 'Express (executive)  ';
            } elseif ($model->kapal == '95') {
                $kapal = 'Siginjai (ekonomi)   ';
            } elseif ($model->kapal == '96') {
                $kapal = ' Maaf tidak tersedia  
                      ';
            } elseif ($model->kapal == '97') {
                $kapal = ' Express (executive)   ';
            } elseif ($model->kapal == '98') {
                $kapal = ' Siginjai (ekonomi)   ';
            } elseif ($model->kapal == '99') {
                $kapal = ' Maaf tidak tersedia  
                      ';
            } elseif ($model->kapal == '100') {
                $kapal = ' Express (executive)   ';
            } elseif ($model->kapal == '101') {
                $kapal = ' Siginjai (ekonomi)   ';
            } elseif ($model->kapal == '102') {
                $kapal = ' Maaf tidak tersedia  
                      ';
            } elseif ($model->kapal == '103') {
                $kapal = ' Express (executive)   ';
            } elseif ($model->kapal == '104') {
                $kapal = ' Maaf tidak tersedia  
                      ';
            } elseif ($model->kapal == '105') {
                $kapal = ' Maaf tidak tersedia  
                       ';
            } elseif ($model->kapal == '106') {
                $kapal = ' Express (executive)   ';
            } elseif ($model->kapal == '107') {
                $kapal = ' Maaf tidak tersedia  
                      ';
            } elseif ($model->kapal == '108') {
                $kapal = ' Maaf tidak tersedia  
                      ';
            } elseif ($model->kapal == '109') {
                $kapal = 'Express (executive)  ';
            } elseif ($model->kapal == '110') {
                $kapal = ' Maaf tidak tersedia  
                      ';
            } elseif ($model->kapal == '112') {
                $kapal = ' Maaf tidak tersedia  
                      ';
            } elseif ($model->kapal == '113') {
                $kapal = ' Express (executive)   ';
            } elseif ($model->kapal == '114') {
                $kapal = ' Maaf tidak tersedia  
                      ';
            } elseif ($model->kapal == '115') {
                $kapal = ' Maaf tidak tersedia  
                      ';
            } elseif ($model->kapal == '116') {
                $kapal = ' Express (executive)  ';
            } elseif ($model->kapal == '117') {
                $kapal = ' Maaf tidak tersedia  
                      ';
            } elseif ($model->kapal == '118') {
                $kapal = ' Maaf tidak tersedia  
                      ';
            } elseif ($model->kapal == '119') {
                $kapal = ' Express (executive)   ';
            } elseif ($model->kapal == '120') {
                $kapal = ' Maaf tidak tersedia  
                      ';
            } elseif ($model->kapal == '121') {
                $kapal = ' Maaf tidak tersedia  
                      ';
            } elseif ($model->kapal == '122') {
                $kapal = ' Express (executive)  ';
            } elseif ($model->kapal == '123') {
                $kapal = ' Maaf tidak tersedia  
                  0   ';
            } elseif ($model->kapal == '124') {
                $kapal = ' Maaf tidak tersedia  
                      ';
            } elseif ($model->kapal == '125') {
                $kapal = ' Express (executive)   ';
            } elseif ($model->kapal == '126') {
                $kapal = ' Maaf tidak tersedia  
                      ';
            } elseif ($model->kapal == '127') {
                $kapal = ' Maaf tidak tersedia  
                      ';
            } elseif ($model->kapal == '128') {
                $kapal = ' Express (executive)   ';
            } elseif ($model->kapal == '129') {
                $kapal = ' Maaf tidak tersedia  
                      ';
            } elseif ($model->kapal == '130') {
                $kapal = ' Maaf tidak tersedia  
                      ';
            } elseif ($model->kapal == '131') {
                $kapal = ' Express (executive)   ';
            } elseif ($model->kapal == '132') {
                $kapal = ' Maaf tidak tersedia  
                      ';
            } elseif ($model->kapal == '133') {
                $kapal = ' Maaf tidak tersedia  
                      ';
            } elseif ($model->kapal == '134') {
                $kapal = 'Express (executive)  ';
            } elseif ($model->kapal == '135') {
                $kapal = ' Maaf tidak tersedia  
                      ';
            } elseif ($model->kapal == '136') {
                $kapal = ' Maaf tidak tersedia  
                      ';
            } elseif ($model->kapal == '137') {
                $kapal = ' Express (executive)   ';
            } elseif ($model->kapal == '138') {
                $kapal = ' Maaf tidak tersedia  
                      ';
            } elseif ($model->kapal == '139') {
                $kapal = ' Maaf tidak tersedia  
                      ';
            } elseif ($model->kapal == '140') {
                $kapal = 'Express (executive)   ';
            } elseif ($model->kapal == '141') {
                $kapal = ' Maaf tidak tersedia  
                      ';
            } elseif ($model->kapal == '142') {
                $kapal = ' Maaf tidak tersedia  
                      ';
            } elseif ($model->kapal == '143') {
                $kapal = 'Express (executive)  ';
            } elseif ($model->kapal == '144') {
                $kapal = ' Maaf tidak tersedia  
                      ';
            } elseif ($model->kapal == '145') {
                $kapal = ' Maaf tidak tersedia  
                      ';
            } elseif ($model->kapal == '146') {
                $kapal = ' Express (executive)   ';
            } elseif ($model->kapal == '147') {
                $kapal = ' Maaf tidak tersedia  
                     ';
            } elseif ($model->kapal == '148') {
                $kapal = ' Maaf tidak tersedia  
                     ';
            } elseif ($model->kapal == '149') {
                $kapal = ' Express (executive)   ';
            } elseif ($model->kapal == '150') {
                $kapal = ' Maaf tidak tersedia  
                      ';
            } elseif ($model->kapal == '151') {
                $kapal = ' Maaf tidak tersedia  
                      ';
            } elseif ($model->kapal == '152') {
                $kapal = ' Express (executive)   ';
            } elseif ($model->kapal == '153') {
                $kapal = ' Maaf tidak tersedia  
                      ';
            } elseif ($model->kapal == '154') {
                $kapal = ' Maaf tidak tersedia  
                       ';
            } elseif ($model->kapal == '155') {
                $kapal = 'Express (executive)  ';
            } elseif ($model->kapal == '156') {
                $kapal = ' Maaf tidak tersedia  
                      ';
            } elseif ($model->kapal == '157') {
                $kapal = ' Maaf tidak tersedia  
                      ';
            } elseif ($model->kapal == '158') {
                $kapal = ' Express (executive)  ';
            } elseif ($model->kapal == '159') {
                $kapal = ' Maaf tidak tersedia  
                      ';
            } elseif ($model->kapal == '160') {
                $kapal = ' Maaf tidak tersedia  
                      ';
            } elseif ($model->kapal == '161') {
                $kapal = ' Express (executive)   ';
            } elseif ($model->kapal == '162') {
                $kapal = ' Maaf tidak tersedia  
                  0   ';
            } elseif ($model->kapal == '163') {
                $kapal = ' Maaf tidak tersedia  
                  0   ';
            }
            $siteConfig = SiteConfig::model()->listSiteConfig();

            $emailContent = '
    <table border="1" cellspacing="0" co<table border="0" cellpadding="0" cellspacing="0" style="font-size: 13px" width="650px">
    <tbody>
        <tr>
            <td style="text-align: center">
                <div style="background-color:#e1ecf9;margin: 3px;border:1px solid #bfd7ff;width: 642;padding: 10px 0;">
                    <h2 style="margin: 0px">Rajakarimun.com</h2>
                    <em style="font-size:11px">Jl. Brigjend S.Riadi 10, kota malang, jawa timur. (0341) 355 333 - Mail : info@rajakarimun.com</em><br />
                    <br />
                    <b>Konfirmasi Pemesanan Paket Tour Karimunjawa</b></div>

                <table style="font-size: 13px" width="650px">
                    <tbody>
                        <tr>
                            <td style="text-align: left;"><br />
                                Terimakasih sudah memesan paket tour kami. Berikut adalah data pesanan anda :</td>
                        </tr>
                        <tr valign="top">
                            <td style="padding-left: 50px">
                                <table cellpadding="4" style="font-size: 13px" width="100%">
                                    <tbody>
                                        <tr valign="top">
                                            <td style="text-align: left;" width="20%">Pemesan</td>
                                            <td style="text-align: left;" width="1%">:</td>
                                            <td style="text-align: left;" width="79%">' . ucwords($model->gender) . '. ' . $model->nama . '</td>
                                        </tr>
                                        <tr valign="top">
                                            <td style="text-align: left;">Email</td>
                                            <td style="text-align: left;">:</td>
                                            <td style="text-align: left;">' . $model->email . '</td>
                                        </tr>
                                        <tr valign="top">
                                            <td style="text-align: left;">No Telpon</td>
                                            <td style="text-align: left;">:</td>
                                            <td style="text-align: left;">' . landa()->hp($model->phone) . '</td>
                                        </tr>
                                        <tr valign="top">
                                            <td style="text-align: left;">Indentitas</td>
                                            <td style="text-align: left;">:</td>
                                            <td style="text-align: left;"> ' . ucwords($model->code_type) . '</td>
                                        </tr>
                                        <tr valign="top">
                                            <td style="text-align: left;">No Identitas</td>
                                            <td style="text-align: left;">:</td>
                                            <td style="text-align: left;">' . $model->code . '</td>
                                        </tr>
                                        <tr valign="top">
                                            <td style="text-align: left;">Jenis Paket</td>
                                            <td style="text-align: left;">:</td>
                                            <td style="text-align: left;">' . $paket . '</td>
                                        </tr>
                                        <tr valign="top">
                                            <td style="text-align: left;">Hotel</td>
                                            <td style="text-align: left;">:</td>
                                            <td style="text-align: left;">' . $hotel . '</td>
                                        </tr>
                                        <tr valign="top">
                                            <td style="text-align: left;">Kapal</td>
                                            <td style="text-align: left;">:</td>
                                            <td style="text-align: left;">' . $kapal . '</td>
                                        </tr>
                                        <tr valign="top">
                                            <td style="text-align: left;">Total Harga</td>
                                            <td style="text-align: left;">:</td>
                                            <td style="text-align: left;">' . landa()->rp($model->harga) . '</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: left;"><br />
                                Silakan transfer ke salah satu dari rekening kami berikut. Semua rekening di bawah adalah rekening milik rajakarimunjawa.com.</td>
                        </tr>
                        <tr valign="top">
                            <td style="padding-left: 20px; text-align: left;">
                                <table>
                                    <tr>
                                        <td>
                                            Bank : BCA<br>
                                            Cabang : Sawojajar, Malang<br>
                                            Account Holder : Nama samaran<br>
                                            Account No. : 210 601 789 9  <br>
                                        </td>
                                        <td>
                                            Bank : BCA<br>
                                            Cabang : Sawojajar, Malang<br>
                                            Account Holder : Nama samaran<br>
                                            Account No. : 210 601 789 9  <br>
                                        </td>
                                        <td>
                                            Bank : BCA<br>
                                            Cabang : Sawojajar, Malang<br>
                                            Account Holder : Nama samaran<br>
                                            Account No. : 210 601 789 9  <br>
                                        </td>
                                    </tr>
                                </table>

                            </td>
                        </tr>
                        <tr>
                            <td align="center">
                                <p style="text-align: center;"><br />
                                <h2>SELAMAT BERLIBURAN !!!</h2></p>

                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>

<div style="border-top:1px solid #ccc;margin:15px 2px 0px 2px;width: 650px; line-height:10px">&nbsp;</div>ls="4">';


            Email::model()->send('fariedwahyu4@gmail.com', $model->email, 'Konfirmasi pemesanan paket wisata Karimunjawa', $emailContent, TRUE);
            Email::model()->send($model->email, 'fariedwahyu4@gmail.com', 'Konfirmasi pemesanan paket wisata Karimunjawa', $emailContent, TRUE);

//            $mEmail = new Email;
//            $mEmail->email_from ='fariedwahyu@gmail.com';
//            $mEmail->email_to = $model->email;
//            $mEmail->title = 'Konfirmasi pemesanan paket wisata Karimunjawa ';
//            $mEmail->content = $emailContent;
//            $mEmail->client = param('client');
//            $mEmail->save();
//
//            $mEmail = new Email;
//            $mEmail->email_from = $model->email;
//            $mEmail->email_to = 'fariedwahyu@gmail.com';
//            $mEmail->title = 'Konfirmasi pemesanan paket wisata Karimunjawa ';
//            $mEmail->content = $emailContent;
//            $mEmail->client = param('client');
//            $mEmail->save();

            $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['FormTour'])) {
            $model->attributes = $_POST['FormTour'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $this->loadModel($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
        else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $session = new CHttpSession;
        $session->open();
        $criteria = new CDbCriteria();

        $model = new FormTour('search');
        $model->unsetAttributes();  // clear any default values

        if (isset($_GET['FormTour'])) {
            $model->attributes = $_GET['FormTour'];



            if (!empty($model->id))
                $criteria->addCondition('id = "' . $model->id . '"');


            if (!empty($model->gender))
                $criteria->addCondition('gender = "' . $model->gender . '"');


            if (!empty($model->nama))
                $criteria->addCondition('nama = "' . $model->nama . '"');


            if (!empty($model->email))
                $criteria->addCondition('email = "' . $model->email . '"');


            if (!empty($model->code))
                $criteria->addCondition('code = "' . $model->code . '"');


            if (!empty($model->code_type))
                $criteria->addCondition('code_type = "' . $model->code_type . '"');


            if (!empty($model->phone))
                $criteria->addCondition('phone = "' . $model->phone . '"');


            if (!empty($model->pin_bb))
                $criteria->addCondition('pin_bb = "' . $model->pin_bb . '"');


            if (!empty($model->city_from))
                $criteria->addCondition('city_from = "' . $model->city_from . '"');


            if (!empty($model->paket))
                $criteria->addCondition('paket = "' . $model->paket . '"');


            if (!empty($model->hotel))
                $criteria->addCondition('hotel = "' . $model->hotel . '"');


            if (!empty($model->lama_menginap))
                $criteria->addCondition('lama_menginap = "' . $model->lama_menginap . '"');


            if (!empty($model->jumlah_peserta))
                $criteria->addCondition('jumlah_peserta = "' . $model->jumlah_peserta . '"');


            if (!empty($model->daftar_nama))
                $criteria->addCondition('daftar_nama = "' . $model->daftar_nama . '"');


            if (!empty($model->description))
                $criteria->addCondition('description = "' . $model->description . '"');
        }
        $session['FormTour_records'] = FormTour::model()->findAll($criteria);


        $this->render('index', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = FormTour::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'form-tour-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionGenerateExcel() {
        $session = new CHttpSession;
        $session->open();

        if (isset($session['FormTour_records'])) {
            $model = $session['FormTour_records'];
        }
        else
            $model = FormTour::model()->findAll();


        Yii::app()->request->sendFile(date('YmdHis') . '.xls', $this->renderPartial('excelReport', array(
                    'model' => $model
                        ), true)
        );
    }

    public function actionGeneratePdf() {

        $session = new CHttpSession;
        $session->open();
        Yii::import('application.modules.admin.extensions.giiplus.bootstrap.*');
        require_once(Yii::getPathOfAlias('common') . '/extensions/tcpdf/tcpdf.php');
        require_once(Yii::getPathOfAlias('common') . '/extensions/tcpdf/config/lang/eng.php');

        if (isset($session['FormTour_records'])) {
            $model = $session['FormTour_records'];
        }
        else
            $model = FormTour::model()->findAll();



        $html = $this->renderPartial('expenseGridtoReport', array(
            'model' => $model
                ), true);

        //die($html);

        $pdf = new TCPDF();
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor(Yii::app()->name);
        $pdf->SetTitle('Laporan FormTour');
        $pdf->SetSubject('Laporan FormTour Report');
        //$pdf->SetKeywords('example, text, report');
        $pdf->SetHeaderData('', 0, "Report", '');
        //$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, "Laporan" FormTour, "");
        $pdf->SetHeaderData("", "", "Laporan FormTour", "");
        $pdf->setHeaderFont(Array('helvetica', '', 8));
        $pdf->setFooterFont(Array('helvetica', '', 6));
        $pdf->SetMargins(15, 18, 15);
        $pdf->SetHeaderMargin(5);
        $pdf->SetFooterMargin(10);
        $pdf->SetAutoPageBreak(TRUE, 0);
        $pdf->SetFont('dejavusans', '', 7);
        $pdf->AddPage();
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->LastPage();
        $pdf->Output("FormTour_002.pdf", "I");
    }

    public function actionPaketTour() {
        if ($_POST['FormTour']['paket'] == '4d3n') {
            $result = '
            <option value="4d_0">Silahkan Pilih Paket</option>
            <option value="4d_1">Homestay</option>
            <option value="4d_2">Hotel Cikal Karimun Jawa</option>
            <option value="4d_3">Hotel New Ocean</option>
            <option value="4d_4">Karimun Jawa Inn</option>
            <option value="4d_5">Wisma Apung</option>
            <option value="4d_6">Mangrove Inn</option>
            <option value="4d_7">Dewan Daru Resort</option>
            <option value="4d_8">Wisma Wisata</option>';
        } elseif ($_POST['FormTour']['paket'] == '3d2n') {
            $result = '
            <option value="3d_0">Silahkan Pilih Paket</option>
            <option value="3d_1">Homestay</option>
            <option value="3d_2">Hotel Cikal Karimun Jawa</option>
            <option value="3d_3">Nirwana Resort Hotel</option>
            <option value="3d_4">Hotel New Ocean</option>
            <option value="3d_5">Karimun Jawa Inn</option>
            <option value="3d_6">Wisma Apung</option>
            <option value="3d_7">Mangrove Inn</option>
            <option value="3d_8">Dewan Daru Resort</option>
            <option value="3d_9">Wisma Wisata</option>';
        } elseif ($_POST['FormTour']['paket'] == '2d1n') {
            $result = '
            <option value="2d_0">Silahkan Pilih Paket</option>
            <option value="2d_1">Homestay</option>
            <option value="2d_2">Hotel Cikal Karimun Jawa</option>
            <option value="2d_3">Nirwana Resort Hotel</option>
            <option value="2d_4">Hotel New Ocean</option>
            <option value="2d_5">Karimun Jawa Inn</option>
            <option value="2d_6">Wisma Apung</option>
            <option value="2d_7">Mangrove Inn</option>
            <option value="2d_8">Dewan Daru Resort</option>
            <option value="2d_9">Wisma Wisata</option>';
        } else {
            $result = '
            <option value="hn_0">Silahkan Pilih Paket</option>
            <option value="hn_1">Hotel New Ocean</option>
            <option value="hn_2">Karimun Jawa Inn</option>
            <option value="hn_3">Mangrove Inn</option>';
        }
        echo $result;
    }

    public function actionPaketKamar() {
        if ($_POST['FormTour']['hotel'] == '4d_1') {
            // =================PAKET 4 HARI 3 MALAM====================
            $result['opsi'] = '
            <option value="km1_4d_0">Silahkan Pilih Kamar</option>
            <option value="km1_4d_1">Fan, Kamar Mandi Luar</option>
                ';
            $result['gambar'] = '<img src="' . param('urlImg') . 'file/hotel/homestay.png"  >';
            $result['fasilitas'] = '<div class="alert alert-info"><strong>Fasilitas</strong> : Pilihan Dua Putri dan Trisiwi. Kamar Homestay untuk 2 orang , tambah 70rb';
        } elseif ($_POST['FormTour']['hotel'] == '4d_2') {
            $result['opsi'] = '
                        <option value="km2_4d_0">Silahkan Pilih Kamar</option>
                        <option value="km2_4d_1">Standart AC</option>';
            $result['gambar'] = '<img src="' . param('urlImg') . 'file/hotel/cikal.png"  >';
            $result['fasilitas'] = '<div class="alert alert-info"><strong>Fasilitas</strong> : AC, TV , KM Dalam';
        } elseif ($_POST['FormTour']['hotel'] == '4d_3') {
            $result['opsi'] = '
                        <option value="km3_4d_0">Silahkan Pilih Kamar</option>
                        <option value="km3_4d_1">Standart AC</option>
                        <option value="km3_4d_2">Deluxe AC</option>';
            $result['gambar'] = '<img src="' . param('urlImg') . 'file/hotel/new-ocean.png"  >';
            $result['fasilitas'] = '<div class="alert alert-info"><strong>Fasilitas</strong>  <br>
                                    <strong>Standart AC</strong> : AC, TV, KM Dalam, 1st Floor room<br>
                                    <strong>Deluxe AC</strong> : AC, TV, KM Dalam, 2st Floor room (bigger room)<br>';
        } elseif ($_POST['FormTour']['hotel'] == '4d_4') {
            $result['opsi'] = '
                        <option value="km4_4d_0">Silahkan Pilih Kamar</option>
                        <option value="km4_4d_1">Standart AC</option>
                        <option value="km4_4d_2">Suite AC</option>
                        <option value="km4_4d_3">Family AC</option>';
            $result['gambar'] = '<img src="' . param('urlImg') . 'file/hotel/gtw.png"  >';
            $result['fasilitas'] = '<div class="alert alert-info"><strong>Fasilitas</strong>  <br>
                                    <strong>Standart AC</strong> : AC, TV, KM Dalam<br>
                                    <strong>Suite AC</strong> : AC, TV, KM Dalam (Shower)<br>
                                    <strong>Family AC</strong> (4 orang): AC, TV, KM Dalam (Shower)';
        } elseif ($_POST['FormTour']['hotel'] == '4d_5') {
            $result['opsi'] = '
                        <option value="km5_4d_0">Silahkan Pilih Kamar</option>
                        <option value="km5_4d_1">Non AC kamar mandi luar</option>
                        <option value="km5_4d_2">Non AC kamar mandi dalam</option>
                        <option value="km5_4d_3">Standart AC</option>';
            $result['gambar'] = '<img src="' . param('urlImg') . 'file/hotel/wisma-apung.png"  >';
            $result['fasilitas'] = '<div class="alert alert-info"><strong>Fasilitas</strong>  <br>
                                    <strong>Non AC kamar mandi luar</strong> : Fan, KM Luar<br>
                                    <strong>Non AC kamar mandi dalam</strong> : Fan, KM Dalam<br>
                                    <strong>Standart AC</strong>: AC, KM Luar';
        } elseif ($_POST['FormTour']['hotel'] == '4d_6') {
            $result['opsi'] = '
                        <option value="km6_4d_0">Silahkan Pilih Kamar</option>
                        <option value="km6_4d_1">Standart AC</option>';
            $result['gambar'] = '<img src="' . param('urlImg') . 'file/hotel/gtw2.png"  >';
            $result['fasilitas'] = '<div class="alert alert-info"><strong>Fasilitas</strong>  AC, TV , KM Dalam';
        } elseif ($_POST['FormTour']['hotel'] == '4d_7') {
            $result['opsi'] = '
                        <option value="km7_4d_0">Silahkan Pilih Kamar</option>
                        <option value="km7_4d_1">Standart AC</option>
                        <option value="km7_4d_2">Bungalow AC</option>
                        <option value="km7_4d_3">Villa AC</option>';
            $result['gambar'] = '<img src="' . param('urlImg') . 'file/hotel/dewadaru.png"  >';
            $result['fasilitas'] = '<div class="alert alert-info"><strong>Fasilitas</strong>  <br>
                                    <strong>Standart AC</strong> : AC, TV, KM Luar<br>
                                    <strong>Bungalow AC</strong> : AC, KM Dalam<br>
                                    <strong>Villa AC</strong> (4 orang): AC, KM Luar';
        } elseif ($_POST['FormTour']['hotel'] == '4d_8') {
            $result['opsi'] = '
                        <option value="km8_4d_0">Silahkan Pilih Kamar</option>
                        <option value="km8_4d_1">Standart AC</option>';
            $result['gambar'] = '<img src="' . param('urlImg') . 'file/hotel/ww.png"  >';
            $result['fasilitas'] = '<div class="alert alert-info"><strong>Fasilitas</strong> : AC, KM Dalam';
        } elseif ($_POST['FormTour']['hotel'] == '3d_1') {
            // ========================PAKET 3 HARI 2 MALAM========================
            $result['opsi'] = '
                        <option value="km1_3d_0">Silahkan Pilih Kamar</option>
                        <option value="km1_3d_1">Fan, Kamar Mandi Luar</option>
                ';
            $result['gambar'] = '<img src="' . param('urlImg') . 'file/hotel/homestay.png"  >';
            $result['fasilitas'] = '<div class="alert alert-info"><strong>Fasilitas</strong> : Pilihan Dua Putri dan Trisiwi. Kamar Homestay untuk 2 orang , tambah 70rb';
        } elseif ($_POST['FormTour']['hotel'] == '3d_2') {
            $result['opsi'] = '
                        <option value="km2_3d_0">Silahkan Pilih Kamar</option>
                        <option value="km2_3d_1">Standart AC</option>';
            $result['gambar'] = '<img src="' . param('urlImg') . 'file/hotel/cikal.png"  >';
            $result['fasilitas'] = '<div class="alert alert-info"><strong>Fasilitas</strong> : AC, TV , KM Dalam';
        } elseif ($_POST['FormTour']['hotel'] == '3d_3') {
            $result['opsi'] = '
                        <option value="km3_3d_0">Silahkan Pilih Kamar</option>
                        <option value="km3_3d_1">Joglo Bisnis</option>
                        <option value="km3_3d_2">Joglo Executive</option>
                        <option value="km3_3d_3">Room Suite</option>
                        <option value="km3_3d_4">Master Suite</option>';
            $result['gambar'] = '<img src="' . param('urlImg') . 'file/hotel/gtw.png"  >';
            $result['fasilitas'] = '<div class="alert alert-info"><strong>Fasilitas</strong>  <br>
                                    <strong>Joglo Bisnis</strong> : AC, Dapur, TV, DVD, Almari, Lemari Es, Water Heater, KM Luar<br>
                                    <strong>Joglo Executive</strong> : AC, Dapur, TV, DVD, Almari, Lemari Es, Water Heater, KM Dalam<br>
                                    <strong>Room Suite</strong> : AC, Dapur, TV, DVD, Almari, Lemari Es, Water Heater, KM Dalam<br>
                                    <strong>Master Suite</strong> : AC, Dapur, TV, DVD, Almari, Lemari Es, Water Heater, KM Dalam, Bathtub<br>';
        } elseif ($_POST['FormTour']['hotel'] == '3d_4') {
            $result['opsi'] = '
                        <option value="km4_3d_0">Silahkan Pilih Kamar</option>
                        <option value="km4_3d_1">Standart AC</option>
                        <option value="km4_3d_2">Deluxe AC</option>';
            $result['gambar'] = '<img src="' . param('urlImg') . 'file/hotel/new-ocean.png"  >';
            $result['fasilitas'] = '<div class="alert alert-info"><strong>Fasilitas</strong>  <br>
                                    <strong>Standart AC</strong> : AC, TV, KM Dalam, 1st Floor room<br>
                                    <strong>Deluxe AC</strong> : AC, TV, KM Dalam, 2st Floor room (bigger room)<br>';
        } elseif ($_POST['FormTour']['hotel'] == '3d_5') {
            $result['opsi'] = '
                        <option value="km5_3d_0">Silahkan Pilih Kamar</option>
                        <option value="km5_3d_1">Standart AC</option>
                        <option value="km5_3d_2">Suite AC</option>
                        <option value="km5_3d_3">Family AC</option>';
            $result['gambar'] = '<img src="' . param('urlImg') . 'file/hotel/gtw.png"  >';
            $result['fasilitas'] = '<div class="alert alert-info"><strong>Fasilitas</strong>  <br>
                                    <strong>Standart AC</strong> : AC, TV, KM Dalam<br>
                                    <strong>Suite AC</strong> : AC, TV, KM Dalam (Shower)<br>
                                    <strong>Family AC</strong> (4 orang): AC, TV, KM Dalam (Shower)';
        } elseif ($_POST['FormTour']['hotel'] == '3d_6') {
            $result['opsi'] = '
                        <option value="km6_3d_0">Silahkan Pilih Kamar</option>
                        <option value="km6_3d_1">Non AC kamar mandi luar</option>
                        <option value="km6_3d_2">Non AC kamar mandi dalam</option>
                        <option value="km6_3d_3">Standart AC</option>';
            $result['gambar'] = '<img src="' . param('urlImg') . 'file/hotel/wisma-apung.png"  >';
            $result['fasilitas'] = '<div class="alert alert-info"><strong>Fasilitas</strong>  <br>
                                    <strong>Non AC kamar mandi luar</strong> : Fan, KM Luar<br>
                                    <strong>Non AC kamar mandi dalam</strong> : Fan, KM Dalam<br>
                                    <strong>Standart AC</strong>: AC, KM Luar';
        } elseif ($_POST['FormTour']['hotel'] == '3d_7') {
            $result['opsi'] = '
                        <option value="km7_3d_0">Silahkan Pilih Kamar</option>
                        <option value="km7_3d_1">Standart AC</option>';
            $result['gambar'] = '<img src="' . param('urlImg') . 'file/hotel/gtw2.png"  >';
            $result['fasilitas'] = '<div class="alert alert-info"><strong>Fasilitas</strong>  AC, TV , KM Dalam';
        } elseif ($_POST['FormTour']['hotel'] == '3d_8') {
            $result['opsi'] = '
                        <option value="km8_3d_0">Silahkan Pilih Kamar</option>
                        <option value="km8_3d_1">Standart AC</option>
                        <option value="km8_3d_2">Bungalow AC</option>
                        <option value="km8_3d_3">Villa AC</option>';
            $result['gambar'] = '<img src="' . param('urlImg') . 'file/hotel/dewadaru.png"  >';
            $result['fasilitas'] = '<div class="alert alert-info"><strong>Fasilitas</strong>  <br>
                                    <strong>Standart AC</strong> : AC, TV, KM Luar<br>
                                    <strong>Bungalow AC</strong> : AC, KM Dalam<br>
                                    <strong>Villa AC</strong> (4 orang): AC, KM Luar';
        } elseif ($_POST['FormTour']['hotel'] == '3d_9') {
            $result['opsi'] = '
                        <option value="km9_3d_0">Silahkan Pilih Kamar</option>
                        <option value="km9_3d_1">Standart AC</option>';
            $result['gambar'] = '<img src="' . param('urlImg') . 'file/hotel/ww.png"  >';
            $result['fasilitas'] = '<div class="alert alert-info"><strong>Fasilitas</strong> : AC, KM Dalam';
        } elseif ($_POST['FormTour']['hotel'] == '2d_1') {
            // =======================PAKET 2 HARI 1 ============================
            $result['opsi'] = '
                        <option value="km1_2d_0">Silahkan Pilih Kamar</option>
                        <option value="km1_2d_1">Fan, Kamar Mandi Luar</option>
                ';
            $result['gambar'] = '<img src="' . param('urlImg') . 'file/hotel/homestay.png"  >';
            $result['fasilitas'] = '<div class="alert alert-info"><strong>Fasilitas</strong> : Pilihan Dua Putri dan Trisiwi. Kamar Homestay untuk 2 orang , tambah 70rb';
        } elseif ($_POST['FormTour']['hotel'] == '2d_2') {
            $result['opsi'] = '
                        <option value="km2_2d_0">Silahkan Pilih Kamar</option>
                        <option value="km2_2d_1">Standart AC</option>';
            $result['gambar'] = '<img src="' . param('urlImg') . 'file/hotel/cikal.png"  >';
            $result['fasilitas'] = '<div class="alert alert-info"><strong>Fasilitas</strong> : AC, TV , KM Dalam';
        } elseif ($_POST['FormTour']['hotel'] == '2d_3') {
            $result['opsi'] = '
                        <option value="km3_2d_0">Silahkan Pilih Kamar</option>
                        <option value="km3_2d_1">Joglo Bisnis</option>
                        <option value="km3_2d_2">Joglo Executive</option>
                        <option value="km3_2d_3">Room Suite</option>
                        <option value="km3_2d_4">Master Suite</option>';
            $result['gambar'] = '<img src="' . param('urlImg') . 'file/hotel/gtw.png"  >';
            $result['fasilitas'] = '<div class="alert alert-info"><strong>Fasilitas</strong>  <br>
                                    <strong>Joglo Bisnis</strong> : AC, Dapur, TV, DVD, Almari, Lemari Es, Water Heater, KM Luar<br>
                                    <strong>Joglo Executive</strong> : AC, Dapur, TV, DVD, Almari, Lemari Es, Water Heater, KM Dalam<br>
                                    <strong>Room Suite</strong> : AC, Dapur, TV, DVD, Almari, Lemari Es, Water Heater, KM Dalam<br>
                                    <strong>Master Suite</strong> : AC, Dapur, TV, DVD, Almari, Lemari Es, Water Heater, KM Dalam, Bathtub<br>';
        } elseif ($_POST['FormTour']['hotel'] == '2d_4') {
            $result['opsi'] = '
                        <option value="km4_2d_0">Silahkan Pilih Kamar</option>
                        <option value="km4_2d_1">Standart AC</option>
                        <option value="km4_2d_2">Deluxe AC</option>';
            $result['gambar'] = '<img src="' . param('urlImg') . 'file/hotel/new-ocean.png"  >';
            $result['fasilitas'] = '<div class="alert alert-info"><strong>Fasilitas</strong>  <br>
                                    <strong>Standart AC</strong> : AC, TV, KM Dalam, 1st Floor room<br>
                                    <strong>Deluxe AC</strong> : AC, TV, KM Dalam, 2st Floor room (bigger room)<br>';
        } elseif ($_POST['FormTour']['hotel'] == '2d_5') {
            $result['opsi'] = '
                        <option value="km5_2d_0">Silahkan Pilih Kamar</option>
                        <option value="km5_2d_1">Standart AC</option>
                        <option value="km5_2d_2">Suite AC</option>
                        <option value="km5_2d_3">Family AC</option>';
            $result['gambar'] = '<img src="' . param('urlImg') . 'file/hotel/gtw.png"  >';
            $result['fasilitas'] = '<div class="alert alert-info"><strong>Fasilitas</strong>  <br>
                                    <strong>Standart AC</strong> : AC, TV, KM Dalam<br>
                                    <strong>Suite AC</strong> : AC, TV, KM Dalam (Shower)<br>
                                    <strong>Family AC</strong> (4 orang): AC, TV, KM Dalam (Shower)';
        } elseif ($_POST['FormTour']['hotel'] == '2d_6') {
            $result['opsi'] = '
                        <option value="km6_2d_0">Silahkan Pilih Kamar</option>
                        <option value="km6_2d_1">Non AC kamar mandi luar</option>
                        <option value="km6_2d_2">Non AC kamar mandi dalam</option>
                        <option value="km6_2d_3">Standart AC</option>';
            $result['gambar'] = '<img src="' . param('urlImg') . 'file/hotel/wisma-apung.png"  >';
            $result['fasilitas'] = '<div class="alert alert-info"><strong>Fasilitas</strong>  <br>
                                    <strong>Non AC kamar mandi luar</strong> : Fan, KM Luar<br>
                                    <strong>Non AC kamar mandi dalam</strong> : Fan, KM Dalam<br>
                                    <strong>Standart AC</strong>: AC, KM Luar';
        } elseif ($_POST['FormTour']['hotel'] == '2d_7') {
            $result['opsi'] = '
                        <option value="km7_2d_0">Silahkan Pilih Kamar</option>
                        <option value="km7_2d_1">Standart AC</option>';
            $result['gambar'] = '<img src="' . param('urlImg') . 'file/hotel/gtw2.png"  >';
            $result['fasilitas'] = '<div class="alert alert-info"><strong>Fasilitas</strong>  AC, TV , KM Dalam';
        } elseif ($_POST['FormTour']['hotel'] == '2d_8') {
            $result['opsi'] = '
                        <option value="km8_2d_0">Silahkan Pilih Kamar</option>
                        <option value="km8_2d_1">Standart AC</option>
                        <option value="km8_2d_2">Bungalow AC</option>
                        <option value="km8_2d_3">Villa AC</option>';
            $result['gambar'] = '<img src="' . param('urlImg') . 'file/hotel/dewadaru.png"  >';
            $result['fasilitas'] = '<div class="alert alert-info"><strong>Fasilitas</strong>  <br>
                                    <strong>Standart AC</strong> : AC, TV, KM Luar<br>
                                    <strong>Bungalow AC</strong> : AC, KM Dalam<br>
                                    <strong>Villa AC</strong> (4 orang): AC, KM Luar';
        } elseif ($_POST['FormTour']['hotel'] == '2d_9') {
            $result['opsi'] = '
                        <option value="km9_2d_0">Silahkan Pilih Kamar</option>
                        <option value="km9_2d_1">Standart AC</option>';
            $result['gambar'] = '<img src="' . param('urlImg') . 'file/hotel/ww.png"  >';
            $result['fasilitas'] = '<div class="alert alert-info"><strong>Fasilitas</strong> : AC, KM Dalam';
        } else {
            $result['opsi'] = '
                        <option value="km_hn_0">Silahkan Pilih Kamar</option>
                        <option value="km_hn_1">Standart AC</option>';
            $result['gambar'] = '<img src="' . param('urlImg') . 'file/hotel/ww.png"  >';
            $result['fasilitas'] = '<div class="alert alert-info"><strong>Fasilitas</strong> : AC, KM Dalam';
        }
        echo json_encode($result);
    }

    public function actionPaketKapal() {

        if ($_POST['kamar'] == 'km1_4d_1') {
            // ================= 4 HARI 3 MALAM===============
            $result = '
                <option value="0">Silahkan Pilih kapal</option>
                <option value="1">Express (Executive)</option>
                <option value="2">Siginjai (Ekonomi)</option>
                <option value="3">Express - SIginjai</option>';
        } elseif ($_POST['kamar'] == 'km2_4d_1') {
            $result = '
                <option value="0">Silahkan Pilih kapal</option>
                <option value="4">Express (Executive)</option>
                <option value="5">Siginjai (Ekonomi)</option>
                <option value="6">Express - SIginjai</option>';
        } elseif ($_POST['kamar'] == 'km3_4d_1') {
            $result = '
                <option value="0">Silahkan Pilih kapal</option>
                <option value="7">Express (Executive)</option>
                <option value="8">Siginjai (Ekonomi)</option>
                <option value="9">Express - SIginjai</option>';
        } elseif ($_POST['kamar'] == 'km3_4d_2') {
            $result = '
                <option value="0">Silahkan Pilih kapal</option>
                <option value="10">Express (Executive)</option>
                <option value="11">Siginjai (Ekonomi)</option>
                <option value="12">Express - SIginjai</option>';
        } elseif ($_POST['kamar'] == 'km4_4d_1') {
            $result = '
                <option value="0">Silahkan Pilih kapal</option>
                <option value="13">Express (Executive)</option>
                <option value="14">Siginjai (Ekonomi)</option>
                <option value="15">Express - SIginjai</option>';
        } elseif ($_POST['kamar'] == 'km4_4d_2') {
            $result = '
                <option value="0">Silahkan Pilih kapal</option>
                <option value="16">Express (Executive)</option>
                <option value="17">Siginjai (Ekonomi)</option>
                <option value="18">Express - SIginjai</option>';
        } elseif ($_POST['kamar'] == 'km4_4d_3') {
            $result = '
               <option value="0">Silahkan Pilih kapal</option>
                <option value="19">Express (Executive)</option>
                <option value="20">Siginjai (Ekonomi)</option>
                <option value="21">Express - SIginjai</option>';
        } elseif ($_POST['kamar'] == 'km5_4d_1') {
            $result = '
               <option value="0">Silahkan Pilih kapal</option>
                <option value="22">Express (Executive)</option>
                <option value="23">Siginjai (Ekonomi)</option>
                <option value="24">Express - SIginjai</option>';
        } elseif ($_POST['kamar'] == 'km5_4d_2') {
            $result = '
               <option value="0">Silahkan Pilih kapal</option>
                <option value="25">Express (Executive)</option>
                <option value="26">Siginjai (Ekonomi)</option>
                <option value="27">Express - SIginjai</option>';
        } elseif ($_POST['kamar'] == 'km5_4d_3') {
            $result = '
                <option value="0">Silahkan Pilih kapal</option>
                <option value="28">Express (Executive)</option>
                <option value="29">Siginjai (Ekonomi)</option>
                <option value="30">Express - SIginjai</option>';
        } elseif ($_POST['kamar'] == 'km6_4d_1') {
            $result = '
                <option value="0">Silahkan Pilih kapal</option>
                <option value="31">Express (Executive)</option>
                <option value="32">Siginjai (Ekonomi)</option>
                <option value="33">Express - SIginjai</option>';
        } elseif ($_POST['kamar'] == 'km7_4d_1') {
            $result = '
                <option value="0">Silahkan Pilih kapal</option>
                <option value="34">Express (Executive)</option>
                <option value="35">Siginjai (Ekonomi)</option>
                <option value="36">Express - SIginjai</option>';
        } elseif ($_POST['kamar'] == 'km7_4d_2') {
            $result = '
                <option value="0">Silahkan Pilih kapal</option>
                <option value="37">Express (Executive)</option>
                <option value="38">Siginjai (Ekonomi)</option>
                <option value="39">Express - SIginjai</option>';
        } elseif ($_POST['kamar'] == 'km7_4d_3') {
            $result = '
                <option value="0">Silahkan Pilih kapal</option>
                <option value="40">Express (Executive)</option>
                <option value="41">Siginjai (Ekonomi)</option>
                <option value="42">Express - SIginjai</option>';
        } elseif ($_POST['kamar'] == 'km8_4d_1') {
            $result = '
                <option value="0">Silahkan Pilih kapal</option>
                <option value="43">Express (Executive)</option>
                <option value="44">Siginjai (Ekonomi)</option>
                <option value="45">Express - SIginjai</option>';
        } elseif ($_POST['kamar'] == 'km1_3d_1') {
            // ===================== 3 HARI 2 MALAM =================
            $result = '
                <option value="0">Silahkan Pilih kapal</option>
                <option value="46">Express (Executive)</option>
                <option value="47">Siginjai (Ekonomi)</option>
                <option value="48">Express - SIginjai</option>';
        } elseif ($_POST['kamar'] == 'km2_3d_1') {
            $result = '
                <option value="0">Silahkan Pilih kapal</option>
                <option value="49">Express (Executive)</option>
                <option value="50">Siginjai (Ekonomi)</option>
                <option value="51">Express - SIginjai</option>';
        } elseif ($_POST['kamar'] == 'km3_3d_1') {
            $result = '
                <option value="0">Silahkan Pilih kapal</option>
                <option value="52">Express (Executive)</option>
                <option value="53">Siginjai (Ekonomi)</option>';
        } elseif ($_POST['kamar'] == 'km3_3d_2') {
            $result = '
                <option value="0">Silahkan Pilih kapal</option>
                <option value="55">Express (Executive)</option>
                <option value="56">Siginjai (Ekonomi)</option>';
        } elseif ($_POST['kamar'] == 'km3_3d_3') {
            $result = '
                <option value="0">Silahkan Pilih kapal</option>
                <option value="58">Express (Executive)</option>
                <option value="59">Siginjai (Ekonomi)</option>';
        } elseif ($_POST['kamar'] == 'km3_3d_4') {
            $result = '
                <option value="0">Silahkan Pilih kapal</option>
                <option value="61">Express (Executive)</option>
                <option value="62">Siginjai (Ekonomi)</option>';
        } elseif ($_POST['kamar'] == 'km4_3d_1') {
            $result = '
                <option value="0">Silahkan Pilih kapal</option>
                <option value="64">Express (Executive)</option>
                <option value="65">Siginjai (Ekonomi)</option>
                <option value="66">Express - SIginjai</option>';
        } elseif ($_POST['kamar'] == 'km4_3d_2') {
            $result = '
                <option value="0">Silahkan Pilih kapal</option>
                <option value="67">Express (Executive)</option>
                <option value="68">Siginjai (Ekonomi)</option>
                <option value="69">Express - SIginjai</option>';
        } elseif ($_POST['kamar'] == 'km5_3d_1') {
            $result = '
                <option value="0">Silahkan Pilih kapal</option>
                <option value="70">Express (Executive)</option>
                <option value="71">Siginjai (Ekonomi)</option>
                <option value="72">Express - SIginjai</option>';
        } elseif ($_POST['kamar'] == 'km5_3d_2') {
            $result = '
                <option value="0">Silahkan Pilih kapal</option>
                <option value="73">Express (Executive)</option>
                <option value="74">Siginjai (Ekonomi)</option>
                <option value="75">Express - SIginjai</option>';
        } elseif ($_POST['kamar'] == 'km5_3d_3') {
            $result = '
                <option value="0">Silahkan Pilih kapal</option>
                <option value="76">Express (Executive)</option>
                <option value="77">Siginjai (Ekonomi)</option>
                <option value="78">Express - SIginjai</option>';
        } elseif ($_POST['kamar'] == 'km6_3d_1') {
            $result = '
                <option value="0">Silahkan Pilih kapal</option>
                <option value="79">Express (Executive)</option>
                <option value="80">Siginjai (Ekonomi)</option>
                <option value="81">Express - SIginjai</option>';
        } elseif ($_POST['kamar'] == 'km6_3d_2') {
            $result = '
                <option value="0">Silahkan Pilih kapal</option>
                <option value="82">Express (Executive)</option>
                <option value="83">Siginjai (Ekonomi)</option>
                <option value="84">Express - SIginjai</option>';
        } elseif ($_POST['kamar'] == 'km6_3d_3') {
            $result = '
                <option value="0">Silahkan Pilih kapal</option>
                <option value="85">Express (Executive)</option>
                <option value="86">Siginjai (Ekonomi)</option>
                <option value="87">Express - SIginjai</option>';
        } elseif ($_POST['kamar'] == 'km7_3d_1') {
            $result = '
                <option value="0">Silahkan Pilih kapal</option>
                <option value="88">Express (Executive)</option>
                <option value="89">Siginjai (Ekonomi)</option>
                <option value="90">Express - SIginjai</option>';
        } elseif ($_POST['kamar'] == 'km8_3d_1') {
            $result = '
                <option value="0">Silahkan Pilih kapal</option>
                <option value="91">Express (Executive)</option>
                <option value="92">Siginjai (Ekonomi)</option>
                <option value="93">Express - SIginjai</option>';
        } elseif ($_POST['kamar'] == 'km8_3d_2') {
            $result = '
                <option value="0">Silahkan Pilih kapal</option>
                <option value="94">Express (Executive)</option>
                <option value="95">Siginjai (Ekonomi)</option>
                <option value="96">Express - SIginjai</option>';
        } elseif ($_POST['kamar'] == 'km8_3d_3') {
            $result = '
                <option value="0">Silahkan Pilih kapal</option>
                <option value="97">Express (Executive)</option>
                <option value="98">Siginjai (Ekonomi)</option>
                <option value="99">Express - SIginjai</option>';
        } elseif ($_POST['kamar'] == 'km9_3d_1') {
            $result = '
                <option value="0">Silahkan Pilih kapal</option>
                <option value="100">Express (Executive)</option>
                <option value="101">Siginjai (Ekonomi)</option>
                <option value="102">Express - SIginjai</option>';
        } elseif ($_POST['kamar'] == 'km1_2d_1') {
            // ===================== 2 HARI 1 MALAM =================
            $result = '
                <option value="0">Silahkan Pilih kapal</option>
                <option value="103">Express (Executive)</option>
                <option value="104">Siginjai (Ekonomi)</option>
                <option value="105">Express - SIginjai</option>';
        } elseif ($_POST['kamar'] == 'km2_2d_1') {
            $result = '
                <option value="0">Silahkan Pilih kapal</option>
                <option value="106">Express (Executive)</option>
                <option value="107">Siginjai (Ekonomi)</option>
                <option value="108">Express - SIginjai</option>';
        } elseif ($_POST['kamar'] == 'km3_2d_1') {
            $result = '
                <option value="0">Silahkan Pilih kapal</option>
                <option value="109">Express (Executive)</option>
                <option value="110">Siginjai (Ekonomi)</option>
                <option value="112">Express - SIginjai</option>';
        } elseif ($_POST['kamar'] == 'km3_2d_2') {
            $result = '
                <option value="0">Silahkan Pilih kapal</option>
                <option value="113">Express (Executive)</option>
                <option value="114">Siginjai (Ekonomi)</option>
                <option value="115">Express - SIginjai</option>';
        } elseif ($_POST['kamar'] == 'km3_2d_3') {
            $result = '
                <option value="0">Silahkan Pilih kapal</option>
                <option value="116">Express (Executive)</option>
                <option value="117">Siginjai (Ekonomi)</option>
                <option value="118">Express - SIginjai</option>';
        } elseif ($_POST['kamar'] == 'km3_2d_4') {
            $result = '
                <option value="0">Silahkan Pilih kapal</option>
                <option value="119">Express (Executive)</option>
                <option value="120">Siginjai (Ekonomi)</option>
                <option value="121">Express - SIginjai</option>';
        } elseif ($_POST['kamar'] == 'km4_2d_1') {
            $result = '
                <option value="0">Silahkan Pilih kapal</option>
                <option value="122">Express (Executive)</option>
                <option value="123">Siginjai (Ekonomi)</option>
                <option value="124">Express - SIginjai</option>';
        } elseif ($_POST['kamar'] == 'km4_2d_2') {
            $result = '
                <option value="0">Silahkan Pilih kapal</option>
                <option value="125">Express (Executive)</option>
                <option value="126">Siginjai (Ekonomi)</option>
                <option value="127">Express - SIginjai</option>';
        } elseif ($_POST['kamar'] == 'km5_2d_1') {
            $result = '
                <option value="0">Silahkan Pilih kapal</option>
                <option value="128">Express (Executive)</option>
                <option value="129">Siginjai (Ekonomi)</option>
                <option value="130">Express - SIginjai</option>';
        } elseif ($_POST['kamar'] == 'km5_2d_2') {
            $result = '
                <option value="0">Silahkan Pilih kapal</option>
                <option value="131">Express (Executive)</option>
                <option value="132">Siginjai (Ekonomi)</option>
                <option value="133">Express - SIginjai</option>';
        } elseif ($_POST['kamar'] == 'km5_2d_3') {
            $result = '
                <option value="0">Silahkan Pilih kapal</option>
                <option value="134">Express (Executive)</option>
                <option value="135">Siginjai (Ekonomi)</option>
                <option value="136">Express - SIginjai</option>';
        } elseif ($_POST['kamar'] == 'km6_2d_1') {
            $result = '
                <option value="0">Silahkan Pilih kapal</option>
                <option value="137">Express (Executive)</option>
                <option value="138">Siginjai (Ekonomi)</option>
                <option value="139">Express - SIginjai</option>';
        } elseif ($_POST['kamar'] == 'km6_2d_2') {
            $result = '
                <option value="0">Silahkan Pilih kapal</option>
                <option value="140">Express (Executive)</option>
                <option value="141">Siginjai (Ekonomi)</option>
                <option value="142">Express - SIginjai</option>';
        } elseif ($_POST['kamar'] == 'km6_2d_3') {
            $result = '
                <option value="0">Silahkan Pilih kapal</option>
                <option value="143">Express (Executive)</option>
                <option value="144">Siginjai (Ekonomi)</option>
                <option value="145">Express - SIginjai</option>';
        } elseif ($_POST['kamar'] == 'km7_2d_1') {
            $result = '
                <option value="0">Silahkan Pilih kapal</option>
                <option value="146">Express (Executive)</option>
                <option value="147">Siginjai (Ekonomi)</option>
                <option value="148">Express - SIginjai</option>';
        } elseif ($_POST['kamar'] == 'km8_2d_1') {
            $result = '
                <option value="0">Silahkan Pilih kapal</option>
                <option value="149">Express (Executive)</option>
                <option value="150">Siginjai (Ekonomi)</option>
                <option value="151">Express - SIginjai</option>';
        } elseif ($_POST['kamar'] == 'km8_2d_2') {
            $result = '
                <option value="0">Silahkan Pilih kapal</option>
                <option value="152">Express (Executive)</option>
                <option value="153">Siginjai (Ekonomi)</option>
                <option value="154">Express - SIginjai</option>';
        } elseif ($_POST['kamar'] == 'km8_2d_3') {
            $result = '
                <option value="0">Silahkan Pilih kapal</option>
                <option value="155">Express (Executive)</option>
                <option value="156">Siginjai (Ekonomi)</option>
                <option value="157">Express - SIginjai</option>';
        } elseif ($_POST['kamar'] == 'km9_2d_1') {
            $result = '
                <option value="0">Silahkan Pilih kapal</option>
                <option value="158">Express (Executive)</option>
                <option value="159">Siginjai (Ekonomi)</option>
                <option value="160">Express - SIginjai</option>';
        } elseif ($_POST['kamar'] == 'km_hn_1') {
            $result = '
                <option value="0">Silahkan Pilih kapal</option>
                <option value="161">Express (Executive)</option>
                <option value="162">Siginjai (Ekonomi)</option>
                <option value="163">Express - SIginjai</option>';
        }

        echo $result;
    }

    public function actionHarga() {
        if ($_POST['kapal'] == '1') {
            $harga['jadwal'] = '<div class="alert alert-error"> Jumat - Senin';
            $harga['rego'] = ' <h2><span class="label label-info">Rp 1.050.000</span></h2>
                <input type="hidden" name="harga" value="1050000" >';
        } elseif ($_POST['kapal'] == '2') {
            $harga['jadwal'] = '<div class="alert alert-error"> Senin - Kamis <br> Selasa - Sabtu';
            $harga['rego'] = '<h2><span class="label label-info">Rp 850.000</span></h2>
                <input type="hidden" name="harga" value="850000" >';
        } elseif ($_POST['kapal'] == '3') {
            $harga['jadwal'] = '<div class="alert alert-error">Senin - kamis <br> Selsasa - jumat <br> Sabtu - selasa';
            $harga['rego'] = '<h2><span class="label label-info">Rp 1.000.000</span></h2>
                <input type="hidden" name="harga" value="1000000" >';
        } elseif ($_POST['kapal'] == '4') {
            $harga['jadwal'] = '<div class="alert alert-error"> Jumat - Senin';
            $harga['rego'] = '<h2><span class="label label-info">Rp 1.950.000</span></h2>
                <input type="hidden" name="harga" value="1950000" >';
        } elseif ($_POST['kapal'] == '5') {
            $harga['jadwal'] = '<div class="alert alert-error"> Senin - Kamis <br> Selasa - Sabtu';
            $harga['rego'] = '<h2><span class="label label-info">Rp 1.800.000</span></h2>
                <input type="hidden" name="harga" value="1800000" >';
        } elseif ($_POST['kapal'] == '6') {
            $harga['jadwal'] = '<div class="alert alert-error">Senin - kamis <br> Selsasa - jumat <br> Sabtu - selasa';
            $harga['rego'] = '<h2><span class="label label-info">Rp 1.900.000</span></h2>
                <input type="hidden" name="harga" value="1900000" >';
        } elseif ($_POST['kapal'] == '7') {
            $harga['jadwal'] = '<div class="alert alert-error"> Jumat - Senin';
            $harga['rego'] = '<h2><span class="label label-info">Rp 1.900.000</span></h2>
                <input type="hidden" name="harga" value="1900000" >';
        } elseif ($_POST['kapal'] == '8') {
            $harga['jadwal'] = '<div class="alert alert-error"> Senin - Kamis <br> Selasa - Sabtu';
            $harga['rego'] = '<h2><span class="label label-info">Rp 1.800.000</span></h2>
                <input type="hidden" name="harga" value="1800000" >';
        } elseif ($_POST['kapal'] == '9') {
            $harga['jadwal'] = '<div class="alert alert-error">Senin - kamis <br> Selsasa - jumat <br> Sabtu - selasa';
            $harga['rego'] = '<h2><span class="label label-info">Rp 1.850.000</span></h2>
                <input type="hidden" name="harga" value="1850000 >';
        } elseif ($_POST['kapal'] == '10') {
            $harga['jadwal'] = '<div class="alert alert-error"> Jumat - Senin';
            $harga['rego'] = '<h2><span class="label label-info">Rp 2.000.000</span></h2>
                <input type="hidden" name="harga" value="2000000" >';
        } elseif ($_POST['kapal'] == '11') {
            $harga['jadwal'] = '<div class="alert alert-error"> Senin - Kamis <br> Selasa - Sabtu';
            $harga['rego'] = '<h2><span class="label label-info">Rp 1.900.000</span></h2>
                <input type="hidden" name="harga" value="1900000" >';
        } elseif ($_POST['kapal'] == '12') {
            $harga['jadwal'] = '<div class="alert alert-error">Senin - kamis <br> Selsasa - jumat <br> Sabtu - selasa';
            $harga['rego'] = '<h2><span class="label label-info">Rp 1.950.000</span></h2>
                <input type="hidden" name="harga" value="1950000" >';
        } elseif ($_POST['kapal'] == '13') {
            $harga['jadwal'] = '<div class="alert alert-error"> Jumat - Senin';
            $harga['rego'] = '<h2><span class="label label-info">Rp 1.900.000</span></h2>
                <input type="hidden" name="harga" value="1900000" >';
        } elseif ($_POST['kapal'] == '14') {
            $harga['jadwal'] = '<div class="alert alert-error"> Senin - Kamis <br> Selasa - Sabtu';
            $harga['rego'] = '<h2><span class="label label-info">Rp 1.800.000</span></h2>
                <input type="hidden" name="harga" value="1800000" >';
        } elseif ($_POST['kapal'] == '15') {
            $harga['jadwal'] = '<div class="alert alert-error">Senin - kamis <br> Selsasa - jumat <br> Sabtu - selasa';
            $harga['rego'] = '<h2><span class="label label-info">Rp 1.850.000</span></h2>
                <input type="hidden" name="harga" value="1850000" >';
        } elseif ($_POST['kapal'] == '16') {
            $harga['jadwal'] = '<div class="alert alert-error"> Jumat - Senin';
            $harga['rego'] = '<h2><span class="label label-info">Rp 2.100.000</span></h2>
                <input type="hidden" name="harga" value="2100000" >';
        } elseif ($_POST['kapal'] == '17') {
            $harga['jadwal'] = '<div class="alert alert-error"> Senin - Kamis <br> Selasa - Sabtu';
            $harga['rego'] = '<h2><span class="label label-info">Rp 2.000.000</span></h2>
                <input type="hidden" name="harga" value="2000000" >';
        } elseif ($_POST['kapal'] == '18') {
            $harga['jadwal'] = '<div class="alert alert-error">Senin - kamis <br> Selsasa - jumat <br> Sabtu - selasa';
            $harga['rego'] = '<h2><span class="label label-info">Rp 2.050.000</span></h2>
                <input type="hidden" name="harga" value="2050000" >';
        } elseif ($_POST['kapal'] == '19') {
            $harga['jadwal'] = '<div class="alert alert-error"> Jumat - Senin';
            $harga['rego'] = '<h2><span class="label label-info">Rp 2.000.000</span></h2>
                <input type="hidden" name="harga" value="2000000" >';
        } elseif ($_POST['kapal'] == '20') {
            $harga['jadwal'] = '<div class="alert alert-error"> Senin - Kamis <br> Selasa - Sabtu';
            $harga['rego'] = '<h2><span class="label label-info">Rp 1.900.000</span></h2>
                <input type="hidden" name="harga" value="1900000" >';
        } elseif ($_POST['kapal'] == '21') {
            $harga['jadwal'] = '<div class="alert alert-error">Senin - kamis <br> Selsasa - jumat <br> Sabtu - selasa';
            $harga['rego'] = '<h2><span class="label label-info">Rp 1.950.000</span></h2>
                <input type="hidden" name="harga" value="1950000" >';
        } elseif ($_POST['kapal'] == '22') {
            $harga['jadwal'] = '<div class="alert alert-error"> Jumat - Senin';
            $harga['rego'] = '<h2><span class="label label-info">Rp 1.800.000</span></h2>
                <input type="hidden" name="harga" value="1800000" >';
        } elseif ($_POST['kapal'] == '23') {
            $harga['jadwal'] = '<div class="alert alert-error"> Senin - Kamis <br> Selasa - Sabtu';
            $harga['rego'] = '<h2><span class="label label-info">Rp 1.700.000</span></h2>
                <input type="hidden" name="harga" value="1700000" >';
        } elseif ($_POST['kapal'] == '24') {
            $harga['jadwal'] = '<div class="alert alert-error">Senin - kamis <br> Selsasa - jumat <br> Sabtu - selasa';
            $harga['rego'] = '<h2><span class="label label-info">Rp 1.750.000</span></h2>
                <input type="hidden" name="harga" value="1750000" >';
        } elseif ($_POST['kapal'] == '25') {
            $harga['jadwal'] = '<div class="alert alert-error"> Jumat - Senin';
            $harga['rego'] = '<h2><span class="label label-info">Rp 1.900.000</span></h2>
                <input type="hidden" name="harga" value="1900000" >';
        } elseif ($_POST['kapal'] == '26') {
            $harga['jadwal'] = '<div class="alert alert-error"> Senin - Kamis <br> Selasa - Sabtu';
            $harga['rego'] = '<h2><span class="label label-info">Rp 1.800.000</span></h2>
                <input type="hidden" name="harga" value="1800000" >';
        } elseif ($_POST['kapal'] == '27') {
            $harga['jadwal'] = '<div class="alert alert-error">Senin - kamis <br> Selsasa - jumat <br> Sabtu - selasa';
            $harga['rego'] = '<h2><span class="label label-info">Rp 1.850.000</span></h2>
                <input type="hidden" name="harga" value="1850000" >';
        } elseif ($_POST['kapal'] == '28') {
            $harga['jadwal'] = '<div class="alert alert-error"> Jumat - Senin';
            $harga['rego'] = '<h2><span class="label label-info">Rp 2.000.000</span></h2>
                <input type="hidden" name="harga" value="2000000" >';
        } elseif ($_POST['kapal'] == '29') {
            $harga['jadwal'] = '<div class="alert alert-error"> Senin - Kamis <br> Selasa - Sabtu';
            $harga['rego'] = '<h2><span class="label label-info">Rp 1.900.000</span></h2>
                <input type="hidden" name="harga" value="1900000" >';
        } elseif ($_POST['kapal'] == '30') {
            $harga['jadwal'] = '<div class="alert alert-error">Senin - kamis <br> Selsasa - jumat <br> Sabtu - selasa';
            $harga['rego'] = '<h2><span class="label label-info">Rp 1.950.000</span></h2>
                <input type="hidden" name="harga" value="1950000" >';
        } elseif ($_POST['kapal'] == '31') {
            $harga['jadwal'] = '<div class="alert alert-error"> Jumat - Senin';
            $harga['rego'] = '<h2><span class="label label-info">Rp 1.800.000</span></h2>
                <input type="hidden" name="harga" value="1800000" >';
        } elseif ($_POST['kapal'] == '32') {
            $harga['jadwal'] = '<div class="alert alert-error"> Senin - Kamis <br> Selasa - Sabtu';
            $harga['rego'] = '<h2><span class="label label-info">Rp 1.700.000</span></h2>
                <input type="hidden" name="harga" value="1700000" >';
        } elseif ($_POST['kapal'] == '33') {
            $harga['jadwal'] = '<div class="alert alert-error">Senin - kamis <br> Selsasa - jumat <br> Sabtu - selasa';
            $harga['rego'] = '<h2><span class="label label-info">Rp 1.7500.000</span></h2>
                <input type="hidden" name="harga" value="1750000" >';
        } elseif ($_POST['kapal'] == '34') {
            $harga['jadwal'] = '<div class="alert alert-error"> Jumat - Senin';
            $harga['rego'] = '<h2><span class="label label-info">Rp 2.100.000</span></h2>
                <input type="hidden" name="harga" value="2100000" >';
        } elseif ($_POST['kapal'] == '35') {
            $harga['jadwal'] = '<div class="alert alert-error"> Senin - Kamis <br> Selasa - Sabtu';
            $harga['rego'] = '<h2><span class="label label-info">Rp 1.900.000</span></h2>
                <input type="hidden" name="harga" value="1900000" >';
        } elseif ($_POST['kapal'] == '36') {
            $harga['jadwal'] = '<div class="alert alert-error">Senin - kamis <br> Selsasa - jumat <br> Sabtu - selasa';
            $harga['rego'] = '<h2><span class="label label-info">Rp 2.000.000</span></h2>
                <input type="hidden" name="harga" value="2000000" >';
        } elseif ($_POST['kapal'] == '37') {
            $harga['jadwal'] = '<div class="alert alert-error"> Jumat - Senin';
            $harga['rego'] = '<h2><span class="label label-info">Rp 2.200.000</span></h2>
                <input type="hidden" name="harga" value="2200000" >';
        } elseif ($_POST['kapal'] == '38') {
            $harga['jadwal'] = '<div class="alert alert-error"> Senin - kamis <br> Selasa - sabtu';
            $harga['rego'] = '<h2><span class="label label-info">Rp 2.100.000</span></h2>
                <input type="hidden" name="harga" value="2100000" >';
        } elseif ($_POST['kapal'] == '39') {
            $harga['jadwal'] = '<div class="alert alert-error">Senin - kamis <br> Selsasa - jumat <br> Sabtu - selasa';
            $harga['rego'] = '<h2><span class="label label-info">Rp 2.150.000</span></h2>
                <input type="hidden" name="harga" value="2150000" >';
        } elseif ($_POST['kapal'] == '40') {
            $harga['jadwal'] = '<div class="alert alert-error"> Jumat - Senin';
            $harga['rego'] = '<h2><span class="label label-info">Rp 2.100.000</span></h2>
                <input type="hidden" name="harga" value="2100000" >';
        } elseif ($_POST['kapal'] == '41') {
            $harga['jadwal'] = '<div class="alert alert-error"> Senin - kamis <br> Selasa - sabtu';
            $harga['rego'] = '<h2><span class="label label-info">Rp 1.900.000</span></h2>
                <input type="hidden" name="harga" value="1900000" >';
        } elseif ($_POST['kapal'] == '42') {
            $harga['jadwal'] = '<div class="alert alert-error">Senin - kamis <br> Selsasa - jumat <br> Sabtu - selasa';
            $harga['rego'] = '<h2><span class="label label-info">Rp 2.000.000</span></h2>
                <input type="hidden" name="harga" value="2000000" >';
        } elseif ($_POST['kapal'] == '43') {
            $harga['jadwal'] = '<div class="alert alert-error"> Jumat - Senin';
            $harga['rego'] = '<h2><span class="label label-info">Rp 1.800.000</span></h2>
                <input type="hidden" name="harga" value="1800000" >';
        } elseif ($_POST['kapal'] == '44') {
            $harga['jadwal'] = '<div class="alert alert-error"> Senin - kamis <br> Selasa - sabtu';
            $harga['rego'] = '<h2><span class="label label-info">Rp 1.700.000</span></h2>
                <input type="hidden" name="harga" value="1700000" >';
        } elseif ($_POST['kapal'] == '45') {
            $harga['jadwal'] = '<div class="alert alert-error">Senin - kamis <br> Selsasa - jumat <br> Sabtu - selasa';
            $harga['rego'] = '<h2><span class="label label-info">Rp 1.750.000</span></h2>
                <input type="hidden" name="harga" value="1750000" >';
        } elseif ($_POST['kapal'] == '46') {
            $harga['jadwal'] = '<div class="alert alert-error">Senin - Rabu <br> Jumat - Minggu <br> Sabtu - Senin';
            $harga['rego'] = '<h2><span class="label label-info">Rp 850.000</span></h2>
                <input type="hidden" name="harga" value="850000" >';
        } elseif ($_POST['kapal'] == '47') {
            $harga['jadwal'] = '<div class="alert alert-error">Rabu - Jumat<br> Jumat - Minggu ';
            $harga['rego'] = '<h2><span class="label label-info">Rp 750.000</span></h2>
                <input type="hidden" name="harga" value="750000" >';
        } elseif ($_POST['kapal'] == '48') {
            $harga['jadwal'] = '<div class="alert alert-error">Jadwal Tidak Ada ';
            $harga['rego'] = '<h2><span class="label label-info">Maaf tidak tersedia</span></h2>
                <input type="hidden" name="harga" value="-" >';
        } elseif ($_POST['kapal'] == '49') {
            $harga['jadwal'] = '<div class="alert alert-error">Senin - Rabu <br> Jumat - Minggu <br> Sabtu - Senin';
            $harga['rego'] = '<h2><span class="label label-info">Rp 1.600.000</span></h2>
                <input type="hidden" name="harga" value="1600000" >';
        } elseif ($_POST['kapal'] == '50') {
            $harga['jadwal'] = '<div class="alert alert-error">Rabu - Jumat<br> Jumat - Minggu ';
            $harga['rego'] = '<h2><span class="label label-info">Rp 1.400.000</span></h2>
                <input type="hidden" name="harga" value="1400000" >';
        } elseif ($_POST['kapal'] == '51') {
            $harga['jadwal'] = '<div class="alert alert-error">Jadwal Tidak Ada ';
            $harga['rego'] = '<h2><span class="label label-info">Maaf tidak tersedia</span></h2>
                <input type="hidden" name="harga" value="0" >';
        } elseif ($_POST['kapal'] == '52') {
            $harga['jadwal'] = '<div class="alert alert-error">Senin - Rabu <br> Jumat - Minggu <br> Sabtu - Senin';
            $harga['rego'] = '<h2><span class="label label-info">Rp 2.500.000</span></h2>
                <input type="hidden" name="harga" value="2500000" >';
        } elseif ($_POST['kapal'] == '53') {
            $harga['jadwal'] = '<div class="alert alert-error">Rabu - Jumat<br> Jumat - Minggu ';
            $harga['rego'] = '<h2><span class="label label-info">Rp 2.400.000</span></h2>
                <input type="hidden" name="harga" value="2400000" >';
        } elseif ($_POST['kapal'] == '54') {
            $harga['jadwal'] = '<div class="alert alert-error">Jadwal Tidak Ada ';
            $harga['rego'] = '<h2><span class="label label-info">Maaf tidak tersedia</span></h2>
                <input type="hidden" name="harga" value="-" >';
        } elseif ($_POST['kapal'] == '55') {
            $harga['jadwal'] = '<div class="alert alert-error">Senin - Rabu <br> Jumat - Minggu <br> Sabtu - Senin';
            $harga['rego'] = '<h2><span class="label label-info">Rp 2.600.000</span></h2>
                <input type="hidden" name="harga" value="2600000" >';
        } elseif ($_POST['kapal'] == '56') {
            $harga['jadwal'] = '<div class="alert alert-error">Rabu - Jumat<br> Jumat - Minggu ';
            $harga['rego'] = '<h2><span class="label label-info">Rp 2.500.000</span></h2>
                <input type="hidden" name="harga" value="2500000" >';
        } elseif ($_POST['kapal'] == '57') {
            $harga['jadwal'] = '<div class="alert alert-error">Jadwal Tidak Ada ';
            $harga['rego'] = '<h2><span class="label label-info">Maaf tidak tersedia</span></h2>
                <input type="hidden" name="harga" value="0" >';
        } elseif ($_POST['kapal'] == '58') {
            $harga['jadwal'] = '<div class="alert alert-error">Senin - Rabu <br> Jumat - Minggu <br> Sabtu - Senin';
            $harga['rego'] = '<h2><span class="label label-info">Rp 3.500.000</span></h2>
                <input type="hidden" name="harga" value="3500000" >';
        } elseif ($_POST['kapal'] == '59') {
            $harga['jadwal'] = '<div class="alert alert-error">Rabu - Jumat<br> Jumat - Minggu ';
            $harga['rego'] = '<h2><span class="label label-info">Rp 3.400.000</span></h2>
                <input type="hidden" name="harga" value="3400000" >';
        } elseif ($_POST['kapal'] == '60') {
            $harga['jadwal'] = '<div class="alert alert-error">Jadwal Tidak Ada';
            $harga['rego'] = '<h2><span class="label label-info">Maaf tidak tersedia</span></h2>
                <input type="hidden" name="harga" value="0" >';
        } elseif ($_POST['kapal'] == '61') {
            $harga['jadwal'] = '<div class="alert alert-error">Senin - Rabu <br> Jumat - Minggu <br> Sabtu - Senin';
            $harga['rego'] = '<h2><span class="label label-info">Rp 4.000.000</span></h2>
                <input type="hidden" name="harga" value="4000000" >';
        } elseif ($_POST['kapal'] == '62') {
            $harga['jadwal'] = '<div class="alert alert-error">Rabu - Jumat<br> Jumat - Minggu ';
            $harga['rego'] = '<h2><span class="label label-info">Rp 3.900.000</span></h2>
                <input type="hidden" name="harga" value="3900000" >';
        } elseif ($_POST['kapal'] == '63') {
            $harga['jadwal'] = '<div class="alert alert-error">Jadwal Tidak Ada';
            $harga['rego'] = '<h2><span class="label label-info">Maaf tidak tersedia</span></h2>
                <input type="hidden" name="harga" value="0" >';
        } elseif ($_POST['kapal'] == '64') {
            $harga['jadwal'] = '<div class="alert alert-error">Senin - Rabu <br> Jumat - Minggu <br> Sabtu - Senin';
            $harga['rego'] = '<h2><span class="label label-info">Rp 1.500.000</span></h2>
                <input type="hidden" name="harga" value="1500000" >';
        } elseif ($_POST['kapal'] == '65') {
            $harga['jadwal'] = '<div class="alert alert-error">Rabu - Jumat<br> Jumat - Minggu ';
            $harga['rego'] = '<h2><span class="label label-info">Rp 1.450.000</span></h2>
                <input type="hidden" name="harga" value="1450000" >';
        } elseif ($_POST['kapal'] == '66') {
            $harga['jadwal'] = '<div class="alert alert-error">Jadwal Tidak Ada';
            $harga['rego'] = '<h2><span class="label label-info">Maaf tidak tersedia</span></h2>
                <input type="hidden" name="harga" value="0" >';
        } elseif ($_POST['kapal'] == '67') {
            $harga['jadwal'] = '<div class="alert alert-error">Senin - Rabu <br> Jumat - Minggu <br> Sabtu - Senin';
            $harga['rego'] = '<h2><span class="label label-info">Rp 1.700.000</span></h2>
                <input type="hidden" name="harga" value="1700000" >';
        } elseif ($_POST['kapal'] == '68') {
            $harga['jadwal'] = '<div class="alert alert-error">Rabu - Jumat<br> Jumat - Minggu ';
            $harga['rego'] = '<h2><span class="label label-info">Rp 1.600.000</span></h2>
                <input type="hidden" name="harga" value="1600000" >';
        } elseif ($_POST['kapal'] == '69') {
            $harga['jadwal'] = '<div class="alert alert-error">Jadwal Tidak Ada';
            $harga['rego'] = '<h2><span class="label label-info">Maaf tidak tersedia</span></h2>
                <input type="hidden" name="harga" value="0" >';
        } elseif ($_POST['kapal'] == '70') {
            $harga['jadwal'] = '<div class="alert alert-error">Senin - Rabu <br> Jumat - Minggu <br> Sabtu - Senin';
            $harga['rego'] = '<h2><span class="label label-info">Rp 1.600.000</span></h2>
                <input type="hidden" name="harga" value="1600000" >';
        } elseif ($_POST['kapal'] == '71') {
            $harga['jadwal'] = '<div class="alert alert-error">Rabu - Jumat<br> Jumat - Minggu ';
            $harga['rego'] = '<h2><span class="label label-info">Rp 1.500.000</span></h2>
                <input type="hidden" name="harga" value="1500000" >';
        } elseif ($_POST['kapal'] == '72') {
            $harga['jadwal'] = '<div class="alert alert-error">Jadwal Tidak Ada ';
            $harga['rego'] = '<h2><span class="label label-info">Maaf tidak tersedia</span></h2>
                <input type="hidden" name="harga" value="0" >';
        } elseif ($_POST['kapal'] == '73') {
            $harga['jadwal'] = '<div class="alert alert-error">Senin - Rabu <br> Jumat - Minggu <br> Sabtu - Senin';
            $harga['rego'] = '<h2><span class="label label-info">Rp 1.700.000</span></h2>
                <input type="hidden" name="harga" value="1700000" >';
        } elseif ($_POST['kapal'] == '74') {
            $harga['jadwal'] = '<div class="alert alert-error">Rabu - Jumat<br> Jumat - Minggu ';
            $harga['rego'] = '<h2><span class="label label-info">Rp 1.600.000</span></h2>
                <input type="hidden" name="harga" value="1600000" >';
        } elseif ($_POST['kapal'] == '75') {
            $harga['jadwal'] = '<div class="alert alert-error">Jadwal Tidak Ada';
            $harga['rego'] = '<h2><span class="label label-info">Maaf tidak tersedia</span></h2>
                <input type="hidden" name="harga" value="0" >';
        } elseif ($_POST['kapal'] == '76') {
            $harga['jadwal'] = '<div class="alert alert-error">Senin - Rabu <br> Jumat - Minggu <br> Sabtu - Senin';
            $harga['rego'] = '<h2><span class="label label-info">Rp 1.600.000</span></h2>
                <input type="hidden" name="harga" value="1600000" >';
        } elseif ($_POST['kapal'] == '77') {
            $harga['jadwal'] = '<div class="alert alert-error">Rabu - Jumat<br> Jumat - Minggu ';
            $harga['rego'] = '<h2><span class="label label-info">Rp 1.500.000</span></h2>
                <input type="hidden" name="harga" value="1500000" >';
        } elseif ($_POST['kapal'] == '78') {
            $harga['jadwal'] = '<div class="alert alert-error">Jadwal tidak ada';
            $harga['rego'] = '<h2><span class="label label-info">Maaf tidak tersedia</span></h2>
                <input type="hidden" name="harga" value="0" >';
        } elseif ($_POST['kapal'] == '79') {
            $harga['jadwal'] = '<div class="alert alert-error">Senin - Rabu <br> Jumat - Minggu <br> Sabtu - Senin';
            $harga['rego'] = '<h2><span class="label label-info">Rp 1.350.000</span></h2>
                <input type="hidden" name="harga" value="1350000" >';
        } elseif ($_POST['kapal'] == '80') {
            $harga['jadwal'] = '<div class="alert alert-error">Rabu - Jumat<br> Jumat - Minggu ';
            $harga['rego'] = '<h2><span class="label label-info">Rp 1.300.000</span></h2>
                <input type="hidden" name="harga" value="1300000" >';
        } elseif ($_POST['kapal'] == '81') {
            $harga['jadwal'] = '<div class="alert alert-error">Jadwal Tidak Ada';
            $harga['rego'] = '<h2><span class="label label-info">Maaf tidak tersedia</span></h2>
                <input type="hidden" name="harga" value="0" >';
        } elseif ($_POST['kapal'] == '82') {
            $harga['jadwal'] = '<div class="alert alert-error">Senin - Rabu <br> Jumat - Minggu <br> Sabtu - Senin';
            $harga['rego'] = '<h2><span class="label label-info">Rp 1.450.000</span></h2>
                <input type="hidden" name="harga" value="1450000" >';
        } elseif ($_POST['kapal'] == '83') {
            $harga['jadwal'] = '<div class="alert alert-error">Rabu - Jumat<br> Jumat - Minggu ';
            $harga['rego'] = '<h2><span class="label label-info">Rp 1.400.000</span></h2>
                <input type="hidden" name="harga" value="1400000" >';
        } elseif ($_POST['kapal'] == '84') {
            $harga['jadwal'] = '<div class="alert alert-error">Jadwal Tidak Ada';
            $harga['rego'] = '<h2><span class="label label-info">Maaf tidak tersedia</span></h2>
                <input type="hidden" name="harga" value="0" >';
        } elseif ($_POST['kapal'] == '85') {
            $harga['jadwal'] = '<div class="alert alert-error">Senin - Rabu <br> Jumat - Minggu <br> Sabtu - Senin';
            $harga['rego'] = '<h2><span class="label label-info">Rp 1.650.000</span></h2>
                <input type="hidden" name="harga" value="1650000" >';
        } elseif ($_POST['kapal'] == '86') {
            $harga['jadwal'] = '<div class="alert alert-error">Rabu - Jumat<br> Jumat - Minggu ';
            $harga['rego'] = '<h2><span class="label label-info">Rp 1.600.000</span></h2>
                <input type="hidden" name="harga" value="1600000" >';
        } elseif ($_POST['kapal'] == '87') {
            $harga['jadwal'] = '<div class="alert alert-error">Jadwal Tidak Ada';
            $harga['rego'] = '<h2><span class="label label-info">Maaf tidak tersedia</span></h2>
                <input type="hidden" name="harga" value="0" >';
        } elseif ($_POST['kapal'] == '88') {
            $harga['jadwal'] = '<div class="alert alert-error">Senin - Rabu <br> Jumat - Minggu <br> Sabtu - Senin';
            $harga['rego'] = '<h2><span class="label label-info">Rp 1.500.000</span></h2>
                <input type="hidden" name="harga" value="1500000" >';
        } elseif ($_POST['kapal'] == '89') {
            $harga['jadwal'] = '<div class="alert alert-error">Rabu - Jumat<br> Jumat - Minggu ';
            $harga['rego'] = '<h2><span class="label label-info">Rp 1.400.000</span></h2>
                <input type="hidden" name="harga" value="1400000" >';
        } elseif ($_POST['kapal'] == '90') {
            $harga['jadwal'] = '<div class="alert alert-error">Jadwal Tidak Ada';
            $harga['rego'] = '<h2><span class="label label-info">Maaf tidak tersedia</span></h2>
                <input type="hidden" name="harga" value="0" >';
        } elseif ($_POST['kapal'] == '91') {
            $harga['jadwal'] = '<div class="alert alert-error">Senin - Rabu <br> Jumat - Minggu <br> Sabtu - Senin';
            $harga['rego'] = '<h2><span class="label label-info">Rp 1.700.000</span></h2>
                <input type="hidden" name="harga" value="1700000" >';
        } elseif ($_POST['kapal'] == '92') {
            $harga['jadwal'] = '<div class="alert alert-error">Rabu - Jumat<br> Jumat - Minggu ';
            $harga['rego'] = '<h2><span class="label label-info">Rp 1.600.000</span></h2>
                <input type="hidden" name="harga" value="1600000" >';
        } elseif ($_POST['kapal'] == '93') {
            $harga['jadwal'] = '<div class="alert alert-error">Jadwal Tidak Ada';
            $harga['rego'] = '<h2><span class="label label-info">Maaf tidak tersedia</span></h2>
                <input type="hidden" name="harga" value="0" >';
        } elseif ($_POST['kapal'] == '94') {
            $harga['jadwal'] = '<div class="alert alert-error">Senin - Rabu <br> Jumat - Minggu <br> Sabtu - Senin';
            $harga['rego'] = '<h2><span class="label label-info">Rp 1.800.000</span></h2>
                <input type="hidden" name="harga" value="1800000" >';
        } elseif ($_POST['kapal'] == '95') {
            $harga['jadwal'] = '<div class="alert alert-error">Rabu - Jumat<br> Jumat - Minggu ';
            $harga['rego'] = '<h2><span class="label label-info">Rp 1.700.000</span></h2>
                <input type="hidden" name="harga" value="1700000" >';
        } elseif ($_POST['kapal'] == '96') {
            $harga['jadwal'] = '<div class="alert alert-error">Jadwal Tidak Ada ';
            $harga = '<h2><span class="label label-info">Maaf tidak tersedia</span></h2>
                <input type="hidden" name="harga" value="0" >';
        } elseif ($_POST['kapal'] == '97') {
            $harga['jadwal'] = '<div class="alert alert-error">Senin - Rabu <br> Jumat - Minggu <br> Sabtu - Senin';
            $harga['rego'] = '<h2><span class="label label-info">Rp 1.700.000</span></h2>
                <input type="hidden" name="harga" value="1700000" >';
        } elseif ($_POST['kapal'] == '98') {
            $harga['jadwal'] = '<div class="alert alert-error">Rabu - Jumat<br> Jumat - Minggu ';
            $harga['rego'] = '<h2><span class="label label-info">Rp 1.600.000</span></h2>
                <input type="hidden" name="harga" value="1600000" >';
        } elseif ($_POST['kapal'] == '99') {
            $harga['jadwal'] = '<div class="alert alert-error">Jadwal Tidak Ada';
            $harga['rego'] = '<h2><span class="label label-info">Maaf tidak tersedia</span></h2>
                <input type="hidden" name="harga" value="0" >';
        } elseif ($_POST['kapal'] == '100') {
            $harga['jadwal'] = '<div class="alert alert-error">Senin - Rabu <br> Jumat - Minggu <br> Sabtu - Senin';
            $harga['rego'] = '<h2><span class="label label-info">Rp 1.500.000</span></h2>
                <input type="hidden" name="harga" value="1500000" >';
        } elseif ($_POST['kapal'] == '101') {
            $harga['jadwal'] = '<div class="alert alert-error">Rabu - Jumat<br> Jumat - Minggu ';
            $harga['rego'] = '<h2><span class="label label-info">Rp 1.400.000</span></h2>
                <input type="hidden" name="harga" value="1400000" >';
        } elseif ($_POST['kapal'] == '102') {
            $harga['jadwal'] = '<div class="alert alert-error">Jadwal Tidak Ada';
            $harga['rego'] = '<h2><span class="label label-info">Maaf tidak tersedia</span></h2>
                <input type="hidden" name="harga" value="0" >';
        } elseif ($_POST['kapal'] == '103') {
            $harga['jadwal'] = '<div class="alert alert-error">Selasa - Rabu<br> Jumat - Sabtu <br> Sabtu - Minggu ';
            $harga['rego'] = '<h2><span class="label label-info">Rp 750.000</span></h2>
                <input type="hidden" name="harga" value="750000" >';
        } elseif ($_POST['kapal'] == '104') {
            $harga['jadwal'] = '<div class="alert alert-error">Jadwal Tidak Ada';
            $harga['rego'] = '<h2><span class="label label-info">Maaf tidak tersedia</span></h2>
                <input type="hidden" name="harga" value="0" >';
        } elseif ($_POST['kapal'] == '105') {
            $harga['jadwal'] = '<div class="alert alert-error">Jadwal Tidak Ada';
            $harga['rego'] = '<h2><span class="label label-info">Maaf tidak tersedia</span></h2>
                <input type="hidden" name="harga" value="0" >';
        } elseif ($_POST['kapal'] == '106') {
            $harga['jadwal'] = '<div class="alert alert-error">Selasa - Rabu<br> Jumat - Sabtu <br> Sabtu - Minggu ';
            $harga['rego'] = '<h2><span class="label label-info">Rp 1.300.000</span></h2>
                <input type="hidden" name="harga" value="1300000" >';
        } elseif ($_POST['kapal'] == '107') {
            $harga['jadwal'] = '<div class="alert alert-error">Jadwal Tidak Ada';
            $harga['rego'] = '<h2><span class="label label-info">Maaf tidak tersedia</span></h2>
                <input type="hidden" name="harga" value="0" >';
        } elseif ($_POST['kapal'] == '108') {
            $harga['jadwal'] = '<div class="alert alert-error">Jadwal Tidak Ada';
            $harga['rego'] = '<h2><span class="label label-info">Maaf tidak tersedia</span></h2>
                <input type="hidden" name="harga" value="0" >';
        } elseif ($_POST['kapal'] == '109') {
            $harga['jadwal'] = '<div class="alert alert-error">Selasa - Rabu<br> Jumat - Sabtu <br> Sabtu - Minggu ';
            $harga['rego'] = '<h2><span class="label label-info">Rp 2.100.000</span></h2>
                <input type="hidden" name="harga" value="2100000" >';
        } elseif ($_POST['kapal'] == '110') {
            $harga['jadwal'] = '<div class="alert alert-error">Jadwal Tidak Ada';
            $harga['rego'] = '<h2><span class="label label-info">Maaf tidak tersedia</span></h2>
                <input type="hidden" name="harga" value="0" >';
        } elseif ($_POST['kapal'] == '112') {
            $harga['jadwal'] = '<div class="alert alert-error">Jadwal Tidak Ada';
            $harga['rego'] = '<h2><span class="label label-info">Maaf tidak tersedia</span></h2>
                <input type="hidden" name="harga" value="0" >';
        } elseif ($_POST['kapal'] == '113') {
            $harga['jadwal'] = '<div class="alert alert-error">Selasa - Rabu<br> Jumat - Sabtu <br> Sabtu - Minggu ';
            $harga['rego'] = '<h2><span class="label label-info">Rp 2.200.000</span></h2>
                <input type="hidden" name="harga" value="2200000" >';
        } elseif ($_POST['kapal'] == '114') {
            $harga['jadwal'] = '<div class="alert alert-error">Jadwal Tidak Ada';
            $harga['rego'] = '<h2><span class="label label-info">Maaf tidak tersedia</span></h2>
                <input type="hidden" name="harga" value="0" >';
        } elseif ($_POST['kapal'] == '115') {
            $harga['jadwal'] = '<div class="alert alert-error">Jadwal Tidak Ada';
            $harga['rego'] = '<h2><span class="label label-info">Maaf tidak tersedia</span></h2>
                <input type="hidden" name="harga" value="0" >';
        } elseif ($_POST['kapal'] == '116') {
            $harga['jadwal'] = '<div class="alert alert-error">Selasa - Rabu<br> Jumat - Sabtu <br> Sabtu - Minggu ';
            $harga['rego'] = '<h2><span class="label label-info">Rp 2.500.000</span></h2>
                <input type="hidden" name="harga" value="2500000" >';
        } elseif ($_POST['kapal'] == '117') {
            $harga['jadwal'] = '<div class="alert alert-error">Jadwal Tidak Ada';
            $harga['rego'] = '<h2><span class="label label-info">Maaf tidak tersedia</span></h2>
                <input type="hidden" name="harga" value="0" >';
        } elseif ($_POST['kapal'] == '118') {
            $harga['jadwal'] = '<div class="alert alert-error">Jadwal Tidak Ada';
            $harga['rego'] = '<h2><span class="label label-info">Maaf tidak tersedia</span></h2>
                <input type="hidden" name="harga" value="0" >';
        } elseif ($_POST['kapal'] == '119') {
            $harga['jadwal'] = '<div class="alert alert-error">Selasa - Rabu<br> Jumat - Sabtu <br> Sabtu - Minggu ';
            $harga['rego'] = '<h2><span class="label label-info">Rp 3.000.000</span></h2>
                <input type="hidden" name="harga" value="3000000" >';
        } elseif ($_POST['kapal'] == '120') {
            $harga['jadwal'] = '<div class="alert alert-error">Jadwal Tidak Ada';
            $harga['rego'] = '<h2><span class="label label-info">Maaf tidak tersedia</span></h2>
                <input type="hidden" name="harga" value="0" >';
        } elseif ($_POST['kapal'] == '121') {
            $harga['jadwal'] = '<div class="alert alert-error">Jadwal Tidak Ada';
            $harga['rego'] = '<h2><span class="label label-info">Maaf tidak tersedia</span></h2>
                <input type="hidden" name="harga" value="0" >';
        } elseif ($_POST['kapal'] == '122') {
            $harga['jadwal'] = '<div class="alert alert-error">Selasa - Rabu<br> Jumat - Sabtu <br> Sabtu - Minggu ';
            $harga['rego'] = '<h2><span class="label label-info">Rp 1.250.000</span></h2>
                <input type="hidden" name="harga" value="1250000" >';
        } elseif ($_POST['kapal'] == '123') {
            $harga['jadwal'] = '<div class="alert alert-error">Jadwal Tidak Ada';
            $harga['rego'] = '<h2><span class="label label-info">Maaf tidak tersedia</span></h2>
                <input type="hidden" name="harga" value="0" >';
        } elseif ($_POST['kapal'] == '124') {
            $harga['jadwal'] = '<div class="alert alert-error">Jadwal Tidak Ada';
            $harga['rego'] = '<h2><span class="label label-info">Maaf tidak tersedia</span></h2>
                <input type="hidden" name="harga" value="0" >';
        } elseif ($_POST['kapal'] == '125') {
            $harga['jadwal'] = '<div class="alert alert-error">Selasa - Rabu<br> Jumat - Sabtu <br> Sabtu - Minggu ';
            $harga['rego'] = '<h2><span class="label label-info">Rp 1.400.000</span></h2>
                <input type="hidden" name="harga" value="1400000" >';
        } elseif ($_POST['kapal'] == '126') {
            $harga['jadwal'] = '<div class="alert alert-error">Jadwal Tidak Ada';
            $harga['rego'] = '<h2><span class="label label-info">Maaf tidak tersedia</span></h2>
                <input type="hidden" name="harga" value="0" >';
        } elseif ($_POST['kapal'] == '127') {
            $harga['jadwal'] = '<div class="alert alert-error">Jadwal Tidak Ada';
            $harga['rego'] = '<h2><span class="label label-info">Maaf tidak tersedia</span></h2>
                <input type="hidden" name="harga" value="0" >';
        } elseif ($_POST['kapal'] == '128') {
            $harga['jadwal'] = '<div class="alert alert-error">Selasa - Rabu<br> Jumat - Sabtu <br> Sabtu - Minggu ';
            $harga['rego'] = '<h2><span class="label label-info">Rp 1.400.000</span></h2>
                <input type="hidden" name="harga" value="1400000" >';
        } elseif ($_POST['kapal'] == '129') {
            $harga['jadwal'] = '<div class="alert alert-error">Jadwal Tidak Ada';
            $harga['rego'] = '<h2><span class="label label-info">Maaf tidak tersedia</span></h2>
                <input type="hidden" name="harga" value="0" >';
        } elseif ($_POST['kapal'] == '130') {
            $harga['jadwal'] = '<div class="alert alert-error">Jadwal Tidak Ada';
            $harga['rego'] = '<h2><span class="label label-info">Maaf tidak tersedia</span></h2>
                <input type="hidden" name="harga" value="0" >';
        } elseif ($_POST['kapal'] == '131') {
            $harga['jadwal'] = '<div class="alert alert-error">Selasa - Rabu<br> Jumat - Sabtu <br> Sabtu - Minggu ';
            $harga['rego'] = '<h2><span class="label label-info">Rp 1.500.000</span></h2>
                <input type="hidden" name="harga" value="1500000" >';
        } elseif ($_POST['kapal'] == '132') {
            $harga['jadwal'] = '<div class="alert alert-error">Jadwal Tidak Ada';
            $harga['rego'] = '<h2><span class="label label-info">Maaf tidak tersedia</span></h2>
                <input type="hidden" name="harga" value="0" >';
        } elseif ($_POST['kapal'] == '133') {
            $harga['jadwal'] = '<div class="alert alert-error">Jadwal Tidak Ada';
            $harga['rego'] = '<h2><span class="label label-info">Maaf tidak tersedia</span></h2>
                <input type="hidden" name="harga" value="0" >';
        } elseif ($_POST['kapal'] == '134') {
            $harga['jadwal'] = '<div class="alert alert-error">Selasa - Rabu<br> Jumat - Sabtu <br> Sabtu - Minggu ';
            $harga['rego'] = '<h2><span class="label label-info">Rp 1.400.000</span></h2>
                <input type="hidden" name="harga" value="1400000" >';
        } elseif ($_POST['kapal'] == '135') {
            $harga['jadwal'] = '<div class="alert alert-error">Jadwal Tidak Ada';
            $harga['rego'] = '<h2><span class="label label-info">Maaf tidak tersedia</span></h2>
                <input type="hidden" name="harga" value="0" >';
        } elseif ($_POST['kapal'] == '136') {
            $harga['jadwal'] = '<div class="alert alert-error">Jadwal Tidak Ada';
            $harga['rego'] = '<h2><span class="label label-info">Maaf tidak tersedia</span></h2>
                <input type="hidden" name="harga" value="0" >';
        } elseif ($_POST['kapal'] == '137') {
            $harga['jadwal'] = '<div class="alert alert-error">Selasa - Rabu<br> Jumat - Sabtu <br> Sabtu - Minggu ';
            $harga['rego'] = '<h2><span class="label label-info">Rp 1.250.000</span></h2>
                <input type="hidden" name="harga" value="1250000" >';
        } elseif ($_POST['kapal'] == '138') {
            $harga['jadwal'] = '<div class="alert alert-error">Jadwal Tidak Ada';
            $harga['rego'] = '<h2><span class="label label-info">Maaf tidak tersedia</span></h2>
                <input type="hidden" name="harga" value="0" >';
        } elseif ($_POST['kapal'] == '139') {
            $harga['jadwal'] = '<div class="alert alert-error">Jadwal Tidak Ada';
            $harga['rego'] = '<h2><span class="label label-info">Maaf tidak tersedia</span></h2>
                <input type="hidden" name="harga" value="0" >';
        } elseif ($_POST['kapal'] == '140') {
            $harga['jadwal'] = '<div class="alert alert-error">Selasa - Rabu<br> Jumat - Sabtu <br> Sabtu - Minggu ';
            $harga['rego'] = '<h2><span class="label label-info">Rp 1.300.000</span></h2>
                <input type="hidden" name="harga" value="1300000" >';
        } elseif ($_POST['kapal'] == '141') {
            $harga['jadwal'] = '<div class="alert alert-error">Jadwal Tidak Ada';
            $harga['rego'] = '<h2><span class="label label-info">Maaf tidak tersedia</span></h2>
                <input type="hidden" name="harga" value="0" >';
        } elseif ($_POST['kapal'] == '142') {
            $harga['jadwal'] = '<div class="alert alert-error">Jadwal Tidak Ada';
            $harga['rego'] = '<h2><span class="label label-info">Maaf tidak tersedia</span></h2>
                <input type="hidden" name="harga" value="0" >';
        } elseif ($_POST['kapal'] == '143') {
            $harga['jadwal'] = '<div class="alert alert-error">Selasa - Rabu<br> Jumat - Sabtu <br> Sabtu - Minggu ';
            $harga['rego'] = '<h2><span class="label label-info">Rp 1.450.000</span></h2>
                <input type="hidden" name="harga" value="1450000" >';
        } elseif ($_POST['kapal'] == '144') {
            $harga['jadwal'] = '<div class="alert alert-error">Jadwal Tidak Ada';
            $harga['rego'] = '<h2><span class="label label-info">Maaf tidak tersedia</span></h2>
                <input type="hidden" name="harga" value="0" >';
        } elseif ($_POST['kapal'] == '145') {
            $harga['jadwal'] = '<div class="alert alert-error">Jadwal Tidak Ada';
            $harga['rego'] = '<h2><span class="label label-info">Maaf tidak tersedia</span></h2>
                <input type="hidden" name="harga" value="0" >';
        } elseif ($_POST['kapal'] == '146') {
            $harga['jadwal'] = '<div class="alert alert-error">Selasa - Rabu<br> Jumat - Sabtu <br> Sabtu - Minggu ';
            $harga['rego'] = '<h2><span class="label label-info">Rp 1.250.000</span></h2>
                <input type="hidden" name="harga" value="1250000" >';
        } elseif ($_POST['kapal'] == '147') {
            $harga['jadwal'] = '<div class="alert alert-error">Jadwal Tidak Ada';
            $harga['rego'] = '<h2><span class="label label-info">Maaf tidak tersedia</span></h2>
                <input type="hidden" name="harga" value="0" >';
        } elseif ($_POST['kapal'] == '148') {
            $harga['jadwal'] = '<div class="alert alert-error">Jadwal Tidak Ada';
            $harga['rego'] = '<h2><span class="label label-info">Maaf tidak tersedia</span></h2>
                <input type="hidden" name="harga" value="0" >';
        } elseif ($_POST['kapal'] == '149') {
            $harga['jadwal'] = '<div class="alert alert-error">Selasa - Rabu<br> Jumat - Sabtu <br> Sabtu - Minggu ';
            $harga['rego'] = '<h2><span class="label label-info">Rp 1.500.000</span></h2>
                <input type="hidden" name="harga" value="1500000" >';
        } elseif ($_POST['kapal'] == '150') {
            $harga['jadwal'] = '<div class="alert alert-error">Jadwal Tidak Ada';
            $harga['rego'] = '<h2><span class="label label-info">Maaf tidak tersedia</span></h2>
                <input type="hidden" name="harga" value="0" >';
        } elseif ($_POST['kapal'] == '151') {
            $harga['jadwal'] = '<div class="alert alert-error">Jadwal Tidak Ada';
            $harga['rego'] = '<h2><span class="label label-info">Maaf tidak tersedia</span></h2>
                <input type="hidden" name="harga" value="0" >';
        } elseif ($_POST['kapal'] == '152') {
            $harga['jadwal'] = '<div class="alert alert-error">Selasa - Rabu<br> Jumat - Sabtu <br> Sabtu - Minggu ';
            $harga['rego'] = '<h2><span class="label label-info">Rp 1.700.000</span></h2>
                <input type="hidden" name="harga" value="1700000" >';
        } elseif ($_POST['kapal'] == '153') {
            $harga['jadwal'] = '<div class="alert alert-error">Jadwal Tidak Ada';
            $harga['rego'] = '<h2><span class="label label-info">Maaf tidak tersedia</span></h2>
                <input type="hidden" name="harga" value="0" >';
        } elseif ($_POST['kapal'] == '154') {
            $harga['jadwal'] = '<div class="alert alert-error">Jadwal Tidak Ada';
            $harga['rego'] = '<h2><span class="label label-info">Maaf tidak tersedia</span></h2>
                <input type="hidden" name="harga" value="0" >';
        } elseif ($_POST['kapal'] == '155') {
            $harga['jadwal'] = '<div class="alert alert-error">Selasa - Rabu<br> Jumat - Sabtu <br> Sabtu - Minggu ';
            $harga['rego'] = '<h2><span class="label label-info">Rp 1.500.000</span></h2>
                <input type="hidden" name="harga" value="1500000" >';
        } elseif ($_POST['kapal'] == '156') {
            $harga['jadwal'] = '<div class="alert alert-error">Jadwal Tidak Ada';
            $harga['rego'] = '<h2><span class="label label-info">Maaf tidak tersedia</span></h2>
                <input type="hidden" name="harga" value="0" >';
        } elseif ($_POST['kapal'] == '157') {
            $harga['jadwal'] = '<div class="alert alert-error">Jadwal Tidak Ada';
            $harga['rego'] = '<h2><span class="label label-info">Maaf tidak tersedia</span></h2>
                <input type="hidden" name="harga" value="0" >';
        } elseif ($_POST['kapal'] == '158') {
            $harga['jadwal'] = '<div class="alert alert-error">Selasa - Rabu<br> Jumat - Sabtu <br> Sabtu - Minggu ';
            $harga['rego'] = '<h2><span class="label label-info">Rp 1.300.000</span></h2>
                <input type="hidden" name="harga" value="1300000" >';
        } elseif ($_POST['kapal'] == '159') {
            $harga['jadwal'] = '<div class="alert alert-error">Jadwal Tidak Ada';
            $harga['rego'] = '<h2><span class="label label-info">Maaf tidak tersedia</span></h2>
                <input type="hidden" name="harga" value="0" >';
        } elseif ($_POST['kapal'] == '160') {
            $harga['jadwal'] = '<div class="alert alert-error">Jadwal Tidak Ada';
            $harga['rego'] = '<h2><span class="label label-info">Maaf tidak tersedia</span></h2>
                <input type="hidden" name="harga" value="0" >';
        } elseif ($_POST['kapal'] == '161') {
            $harga['jadwal'] = '<div class="alert alert-error">Selasa - Rabu<br> Jumat - Sabtu <br> Sabtu - Minggu ';
            $harga['rego'] = '<h2><span class="label label-info">Rp 1.300.000</span></h2>
                <input type="hidden" name="harga" value="1300000" >';
        } elseif ($_POST['kapal'] == '162') {
            $harga['jadwal'] = '<div class="alert alert-error">Jadwal Tidak Ada';
            $harga['rego'] = '<h2><span class="label label-info">Maaf tidak tersedia</span></h2>
                <input type="hidden" name="harga" value="0" >';
        } elseif ($_POST['kapal'] == '163') {
            $harga['jadwal'] = '<div class="alert alert-error">Jadwal Tidak Ada';
            $harga['rego'] = '<h2><span class="label label-info">Maaf tidak tersedia</span></h2>
                <input type="hidden" name="harga" value="0" >';
        }
        echo json_encode($harga);
    }

}
