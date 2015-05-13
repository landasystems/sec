<?php
$cOutput = (!empty($mPlay->output)) ? ' AND output="' . $mPlay->output . '"' : '';
$cType = (!empty($mPlay->type)) ? ' AND type="' . $mPlay->type . '"' : '';
$date = date('Y-m-d', strtotime($mPlay->created));
$play = Play::model()->findAll(array('index' => 'number', 'select' => 'number,output,type, sum(amount) as sum_amount,status,play_result_id', 'group' => 'number,output,type,status,play_result_id', 'condition' => 'type="2d" AND date(created)="' . $date . '"' . $cOutput . $cType, 'order' => 'sum_amount DESC'));
$sRankNumber = '';
$i = 1;
foreach ($play as $val) {
    $sRankNumber .= $val->number;
    if ($i == 10)
        break;
    $i++;
}
//echo $sRankNumber;
$pasang = array();
$pasangTidak = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9);

$arrRankNumber = str_split($sRankNumber, 1);
foreach ($arrRankNumber as $val) {
    if (!in_array($val, $pasang)) //jika belum angka belum ada di pasang, maka dimasukkan pasang
        $pasang[] = $val;
}

foreach ($pasang as $val) {
    unset($pasangTidak[$val]);
}

//membuat menjadi arr 2 dimensi
$arr = $pasangTidak;
$pasangTidak = array();
foreach ($arr as $val) {
    $pasangTidak[] = $val;
}

//print_r($pasangTidak);
//mencari 5 aduan angka, depan belakang
$aduan = array();
$aduanTidak = array();
foreach ($play as $no => $val) {
    $angka = str_split($val->number, 1);
//    if (in_array($pasang[0], $angka) || in_array($pasang[1], $angka) || in_array($pasang[2], $angka) || in_array($pasang[3], $angka) || in_array($pasang[4], $angka) || in_array($pasangTidak[0], $angka) || in_array($pasangTidak[1], $angka) || in_array($pasangTidak[2], $angka) || in_array($pasangTidak[3], $angka) || in_array($pasangTidak[4], $angka))
    $aduan[] = $val->number;
}
//print_r($pasang);
//print_r($aduan);
$totalAll = 0;
?>

<center>
    <h3>Pembuangan 2D : <?php echo date('d F Y', strtotime($mPlay->created)) ?></h3>
    <h4>Output : <?php echo ($mPlay->output == 's') ? 'Singapore ' : 'Hongkong'; ?>, <?php echo implode('', $pasang) ?> / <?php echo implode('', $pasangTidak) ?></h4>
</center>
<br/>
<table class="table table-condensed">
    <thead>
        <tr>            
            <th colspan="2" style="text-align: center"><?php echo (isset($pasang[0])) ? $pasang[0] : '--' ?></th>
            <th colspan="2" style="text-align: center"><?php echo (isset($pasang[1])) ? $pasang[1] : '--' ?></th>
            <th colspan="2" style="text-align: center"><?php echo (isset($pasang[2])) ? $pasang[2] : '--' ?></th>
            <th colspan="2" style="text-align: center"><?php echo (isset($pasang[3])) ? $pasang[3] : '--' ?></th>
            <th colspan="2" style="text-align: center"><?php echo (isset($pasang[4])) ? $pasang[4] : '--' ?></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <?php if (isset($pasang[0])) { ?>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="text-align: center">Angka</th>
                                <th style="text-align: center">X</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            //depan
                            $total = 0;
                            foreach ($aduan as $no => $val) {
                                if (substr($val, 0, 1) == $pasang[0]) {
                                    $sum_amount = ($play[$val]->sum_amount / 1000 );
                                    $total += $sum_amount;
                                    echo '<tr>
                                    <td style="text-align: center">' . $val . '</td>
                                    <td style="text-align: right">' . $sum_amount . '</td>
                                </tr>';
                                    unset($aduan[$no]);
                                }
                            }
                            $totalAll += $total;
                            echo '<tr class="warning">
                                    <td style="text-align: center" colspan="2">' . $total . '</td>
                                </tr>';
                            ?>
                        </tbody>
                    </table>
                <?php } ?>
            </td>
            <td>
                <?php if (isset($pasang[0])) { ?>
                    <table class="table table-bordered">
                        <thead>                            <tr>                                <th style="text-align: center">Angka</th>                                <th style="text-align: center">X</th>                            </tr>                        </thead>
                        <tbody>
                            <?php
                            //belakang
                            $total = 0;
                            foreach ($aduan as $no => $val) {
                                if (substr($val, 1, 1) == $pasang[0]) {
                                    $sum_amount = ($play[$val]->sum_amount / 1000 );
                                    $total += $sum_amount;
                                    echo '<tr>
                                    <td style="text-align: center">' . $val . '</td>
                                    <td style="text-align: right">' . $sum_amount . '</td>
                                </tr>';
                                    unset($aduan[$no]);
                                }
                            }
                            $totalAll += $total;
                            echo '<tr class="warning">
                                    <td style="text-align: center" colspan="2">' . $total . '</td>
                                </tr>';
                            ?>
                        </tbody>
                    </table>
                <?php } ?>
            </td>
            <td>
                <?php if (isset($pasang[1])) { ?>
                    <table class="table table-bordered">
                        <thead>                            <tr>                                <th style="text-align: center">Angka</th>                                <th style="text-align: center">X</th>                            </tr>                        </thead>
                        <tbody>
                            <?php
                            //depan
                            $total = 0;
                            foreach ($aduan as $no => $val) {
                                if (substr($val, 0, 1) == $pasang[1]) {
                                    $sum_amount = ($play[$val]->sum_amount / 1000 );
                                    $total += $sum_amount;
                                    echo '<tr>
                                    <td style="text-align: center">' . $val . '</td>
                                    <td style="text-align: right">' . $sum_amount . '</td>
                                </tr>';
                                    unset($aduan[$no]);
                                }
                            }
                            $totalAll += $total;
                            echo '<tr class="warning">
                                    <td style="text-align: center" colspan="2">' . $total . '</td>
                                </tr>';
                            ?>
                        </tbody>
                    </table>
                <?php } ?>
            </td>
            <td>
                <?php if (isset($pasang[1])) { ?>
                    <table class="table table-bordered">
                        <thead>                            <tr>                                <th style="text-align: center">Angka</th>                                <th style="text-align: center">X</th>                            </tr>                        </thead>
                        <tbody>
                            <?php
                            //belakang
                            $total = 0;
                            foreach ($aduan as $no => $val) {
                                if (substr($val, 1, 1) == $pasang[1]) {
                                    $sum_amount = ($play[$val]->sum_amount / 1000 );
                                    $total += $sum_amount;
                                    echo '<tr>
                                    <td style="text-align: center">' . $val . '</td>
                                    <td style="text-align: right">' . $sum_amount . '</td>
                                </tr>';
                                    unset($aduan[$no]);
                                }
                            }
                            $totalAll += $total;
                            echo '<tr class="warning">
                                    <td style="text-align: center" colspan="2">' . $total . '</td>
                                </tr>';
                            ?>
                        </tbody>
                    </table>
                <?php } ?>
            </td>
            <td>
                <?php if (isset($pasang[2])) { ?>
                    <table class="table table-bordered">
                        <thead>                            <tr>                                <th style="text-align: center">Angka</th>                                <th style="text-align: center">X</th>                            </tr>                        </thead>
                        <tbody>
                            <?php
                            //depan
                            $total = 0;
                            foreach ($aduan as $no => $val) {
                                if (substr($val, 0, 1) == $pasang[2]) {
                                    $sum_amount = ($play[$val]->sum_amount / 1000 );
                                    $total += $sum_amount;
                                    echo '<tr>
                                    <td style="text-align: center">' . $val . '</td>
                                    <td style="text-align: right">' . $sum_amount . '</td>
                                </tr>';
                                    unset($aduan[$no]);
                                }
                            }
                            $totalAll += $total;
                            echo '<tr class="warning">
                                    <td style="text-align: center" colspan="2">' . $total . '</td>
                                </tr>';
                            ?>
                        </tbody>
                    </table>
                <?php } ?>
            </td>
            <td>
                <?php if (isset($pasang[2])) { ?>
                    <table class="table table-bordered">
                        <thead>                            <tr>                                <th style="text-align: center">Angka</th>                                <th style="text-align: center">X</th>                            </tr>                        </thead>
                        <tbody>
                            <?php
                            //belakang
                            $total = 0;
                            foreach ($aduan as $no => $val) {
                                if (substr($val, 1, 1) == $pasang[2]) {
                                    $sum_amount = ($play[$val]->sum_amount / 1000 );
                                    $total += $sum_amount;
                                    echo '<tr>
                                    <td style="text-align: center">' . $val . '</td>
                                    <td style="text-align: right">' . $sum_amount . '</td>
                                </tr>';
                                    unset($aduan[$no]);
                                }
                            }
                            $totalAll += $total;
                            echo '<tr class="warning">
                                    <td style="text-align: center" colspan="2">' . $total . '</td>
                                </tr>';
                            ?>
                        </tbody>
                    </table>
                <?php } ?>
            </td>
            <td>
                <?php if (isset($pasang[3])) { ?>
                    <table class="table table-bordered">
                        <thead>                            <tr>                                <th style="text-align: center">Angka</th>                                <th style="text-align: center">X</th>                            </tr>                        </thead>
                        <tbody>
                            <?php
                            //depan
                            $total = 0;
                            foreach ($aduan as $no => $val) {
                                if (substr($val, 0, 1) == $pasang[3]) {
                                    $sum_amount = ($play[$val]->sum_amount / 1000 );
                                    $total += $sum_amount;
                                    echo '<tr>
                                    <td style="text-align: center">' . $val . '</td>
                                    <td style="text-align: right">' . $sum_amount . '</td>
                                </tr>';
                                    unset($aduan[$no]);
                                }
                            }
                            $totalAll += $total;
                            echo '<tr class="warning">
                                    <td style="text-align: center" colspan="2">' . $total . '</td>
                                </tr>';
                            ?>
                        </tbody>
                    </table>
                <?php } ?>
            </td>
            <td>
                <?php if (isset($pasang[3])) { ?>
                    <table class="table table-bordered">
                        <thead>                            <tr>                                <th style="text-align: center">Angka</th>                                <th style="text-align: center">X</th>                            </tr>                        </thead>
                        <tbody>
                            <?php
                            //belakang
                            $total = 0;
                            foreach ($aduan as $no => $val) {
                                if (substr($val, 1, 1) == $pasang[3]) {
                                    $sum_amount = ($play[$val]->sum_amount / 1000 );
                                    $total += $sum_amount;
                                    echo '<tr>
                                    <td style="text-align: center">' . $val . '</td>
                                    <td style="text-align: right">' . $sum_amount . '</td>
                                </tr>';
                                    unset($aduan[$no]);
                                }
                            }
                            $totalAll += $total;
                            echo '<tr class="warning">
                                    <td style="text-align: center" colspan="2">' . $total . '</td>
                                </tr>';
                            ?>
                        </tbody>
                    </table>
                <?php } ?>
            </td>
            <td>
                <?php if (isset($pasang[4])) { ?>
                    <table class="table table-bordered">
                        <thead>                            <tr>                                <th style="text-align: center">Angka</th>                                <th style="text-align: center">X</th>                            </tr>                        </thead>
                        <tbody>
                            <?php
                            //depan
                            $total = 0;
                            foreach ($aduan as $no => $val) {
                                if (substr($val, 0, 1) == $pasang[4]) {
                                    $sum_amount = ($play[$val]->sum_amount / 1000 );
                                    $total += $sum_amount;
                                    echo '<tr>
                                    <td style="text-align: center">' . $val . '</td>
                                    <td style="text-align: right">' . $sum_amount . '</td>
                                </tr>';
                                    unset($aduan[$no]);
                                }
                            }
                            $totalAll += $total;
                            echo '<tr class="warning">
                                    <td style="text-align: center" colspan="2">' . $total . '</td>
                                </tr>';
                            ?>
                        </tbody>
                    </table>
                <?php } ?>
            </td>
            <td>
                <?php if (isset($pasang[4])) { ?>
                    <table class="table table-bordered">
                        <thead>                            <tr>                                <th style="text-align: center">Angka</th>                                <th style="text-align: center">X</th>                            </tr>                        </thead>
                        <tbody>
                            <?php
                            //belakang
                            $total = 0;
                            foreach ($aduan as $no => $val) {
                                if (substr($val, 1, 1) == $pasang[4]) {
                                    $sum_amount = ($play[$val]->sum_amount / 1000 );
                                    $total += $sum_amount;
                                    echo '<tr>
                                                                            <td style="text-align: center">' . $val . '</td>
                                                                            <td style="text-align: right">' . $sum_amount . '</td>
                                                                        </tr>';
                                    unset($aduan[$no]);
                                }
                            }
                            $totalAll += $total;
                            echo '<tr class="warning">
                                                                            <td style="text-align: center" colspan="2">' . $total . '</td>
                                                                        </tr>';
                            ?>
                        </tbody>
                    </table>
                <?php } ?>
            </td>
        </tr>
        <tr>            
            <th colspan="2" style="text-align: center"><?php echo (isset($pasangTidak[0])) ? $pasangTidak[0] : '--' ?></th>
            <th colspan="2" style="text-align: center"><?php echo (isset($pasangTidak[1])) ? $pasangTidak[1] : '--' ?></th>
            <th colspan="2" style="text-align: center"><?php echo (isset($pasangTidak[2])) ? $pasangTidak[2] : '--' ?></th>
            <th colspan="2" style="text-align: center"><?php echo (isset($pasangTidak[3])) ? $pasangTidak[3] : '--' ?></th>
            <th colspan="2" style="text-align: center"><?php echo (isset($pasangTidak[4])) ? $pasangTidak[4] : '--' ?></th>
        </tr>
        <tr>
            <td>
                <?php if (isset($pasangTidak[0])) { ?>
                    <table class="table table-bordered">
                        <thead>                            <tr>                                <th style="text-align: center">Angka</th>                                <th style="text-align: center">X</th>                            </tr>                        </thead>
                        <tbody>
                            <?php
                            //depan
                            $total = 0;
                            foreach ($aduan as $no => $val) {
                                if (substr($val, 0, 1) == $pasangTidak[0]) {
                                    $sum_amount = ($play[$val]->sum_amount / 1000 );
                                    $total += $sum_amount;
                                    echo '<tr>
                                    <td style="text-align: center">' . $val . '</td>
                                    <td style="text-align: right">' . $sum_amount . '</td>
                                </tr>';
                                    unset($aduan[$no]);
                                }
                            }
                            $totalAll += $total;
                            echo '<tr class="warning">
                                    <td style="text-align: center" colspan="2">' . $total . '</td>
                                </tr>';
                            ?>
                        </tbody>
                    </table>
                <?php } ?>
            </td>
            <td>
                <?php if (isset($pasangTidak[0])) { ?>
                    <table class="table table-bordered">
                        <thead>                            <tr>                                <th style="text-align: center">Angka</th>                                <th style="text-align: center">X</th>                            </tr>                        </thead>
                        <tbody>
                            <?php
                            //belakang
                            $total = 0;
                            foreach ($aduan as $no => $val) {
                                if (substr($val, 1, 1) == $pasangTidak[0]) {
                                    $sum_amount = ($play[$val]->sum_amount / 1000 );
                                    $total += $sum_amount;
                                    echo '<tr>
                                    <td style="text-align: center">' . $val . '</td>
                                    <td style="text-align: right">' . $sum_amount . '</td>
                                </tr>';
                                    unset($aduan[$no]);
                                }
                            }
                            $totalAll += $total;
                            echo '<tr class="warning">
                                    <td style="text-align: center" colspan="2">' . $total . '</td>
                                </tr>';
                            ?>
                        </tbody>
                    </table>
                <?php } ?>
            </td>
            <td>
                <?php if (isset($pasangTidak[1])) { ?>
                    <table class="table table-bordered">
                        <thead>                            <tr>                                <th style="text-align: center">Angka</th>                                <th style="text-align: center">X</th>                            </tr>                        </thead>
                        <tbody>
                            <?php
                            //depan
                            $total = 0;
                            foreach ($aduan as $no => $val) {
                                if (substr($val, 0, 1) == $pasangTidak[1]) {
                                    $sum_amount = ($play[$val]->sum_amount / 1000 );
                                    $total += $sum_amount;
                                    echo '<tr>
                                    <td style="text-align: center">' . $val . '</td>
                                    <td style="text-align: right">' . $sum_amount . '</td>
                                </tr>';
                                    unset($aduan[$no]);
                                }
                            }
                            $totalAll += $total;
                            echo '<tr class="warning">
                                    <td style="text-align: center" colspan="2">' . $total . '</td>
                                </tr>';
                            ?>
                        </tbody>
                    </table>
                <?php } ?>
            </td>
            <td>
                <?php if (isset($pasangTidak[1])) { ?>
                    <table class="table table-bordered">
                        <thead>                            <tr>                                <th style="text-align: center">Angka</th>                                <th style="text-align: center">X</th>                            </tr>                        </thead>
                        <tbody>
                            <?php
                            //belakang
                            $total = 0;
                            foreach ($aduan as $no => $val) {
                                if (substr($val, 1, 1) == $pasangTidak[1]) {
                                    $sum_amount = ($play[$val]->sum_amount / 1000 );
                                    $total += $sum_amount;
                                    echo '<tr>
                                    <td style="text-align: center">' . $val . '</td>
                                    <td style="text-align: right">' . $sum_amount . '</td>
                                </tr>';
                                    unset($aduan[$no]);
                                }
                            }
                            $totalAll += $total;
                            echo '<tr class="warning">
                                    <td style="text-align: center" colspan="2">' . $total . '</td>
                                </tr>';
                            ?>
                        </tbody>
                    </table>
                <?php } ?>
            </td>
            <td>
                <?php if (isset($pasangTidak[2])) { ?>
                    <table class="table table-bordered">
                        <thead>                            <tr>                                <th style="text-align: center">Angka</th>                                <th style="text-align: center">X</th>                            </tr>                        </thead>
                        <tbody>
                            <?php
                            //depan
                            $total = 0;
                            foreach ($aduan as $no => $val) {
                                if (substr($val, 0, 1) == $pasangTidak[2]) {
                                    $sum_amount = ($play[$val]->sum_amount / 1000 );
                                    $total += $sum_amount;
                                    echo '<tr>
                                    <td style="text-align: center">' . $val . '</td>
                                    <td style="text-align: right">' . $sum_amount . '</td>
                                </tr>';
                                    unset($aduan[$no]);
                                }
                            }
                            $totalAll += $total;
                            echo '<tr class="warning">
                                    <td style="text-align: center" colspan="2">' . $total . '</td>
                                </tr>';
                            ?>
                        </tbody>
                    </table>
                <?php } ?>
            </td>
            <td>
                <?php if (isset($pasangTidak[2])) { ?>
                    <table class="table table-bordered">
                        <thead>                            <tr>                                <th style="text-align: center">Angka</th>                                <th style="text-align: center">X</th>                            </tr>                        </thead>
                        <tbody>
                            <?php
                            //belakang
                            $total = 0;
                            foreach ($aduan as $no => $val) {
                                if (substr($val, 1, 1) == $pasangTidak[2]) {
                                    $sum_amount = ($play[$val]->sum_amount / 1000 );
                                    $total += $sum_amount;
                                    echo '<tr>
                                    <td style="text-align: center">' . $val . '</td>
                                    <td style="text-align: right">' . $sum_amount . '</td>
                                </tr>';
                                    unset($aduan[$no]);
                                }
                            }
                            $totalAll += $total;
                            echo '<tr class="warning">
                                    <td style="text-align: center" colspan="2">' . $total . '</td>
                                </tr>';
                            ?>
                        </tbody>
                    </table>
                <?php } ?>
            </td>
            <td>
                <?php if (isset($pasangTidak[3])) { ?>
                    <table class="table table-bordered">
                        <thead>                            <tr>                                <th style="text-align: center">Angka</th>                                <th style="text-align: center">X</th>                            </tr>                        </thead>
                        <tbody>
                            <?php
                            //depan
                            $total = 0;
                            foreach ($aduan as $no => $val) {
                                if (substr($val, 0, 1) == $pasangTidak[3]) {
                                    $sum_amount = ($play[$val]->sum_amount / 1000 );
                                    $total += $sum_amount;
                                    echo '<tr>
                                    <td style="text-align: center">' . $val . '</td>
                                    <td style="text-align: right">' . $sum_amount . '</td>
                                </tr>';
                                    unset($aduan[$no]);
                                }
                            }
                            $totalAll += $total;
                            echo '<tr class="warning">
                                    <td style="text-align: center" colspan="2">' . $total . '</td>
                                </tr>';
                            ?>
                        </tbody>
                    </table>
                <?php } ?>
            </td>
            <td>
                <?php if (isset($pasangTidak[3])) { ?>
                    <table class="table table-bordered">
                        <thead>                            <tr>                                <th style="text-align: center">Angka</th>                                <th style="text-align: center">X</th>                            </tr>                        </thead>
                        <tbody>
                            <?php
                            //belakang
                            $total = 0;
                            foreach ($aduan as $no => $val) {
                                if (substr($val, 1, 1) == $pasangTidak[3]) {
                                    $sum_amount = ($play[$val]->sum_amount / 1000 );
                                    $total += $sum_amount;
                                    echo '<tr>
                                    <td style="text-align: center">' . $val . '</td>
                                    <td style="text-align: right">' . $sum_amount . '</td>
                                </tr>';
                                    unset($aduan[$no]);
                                }
                            }
                            $totalAll += $total;
                            echo '<tr class="warning">
                                    <td style="text-align: center" colspan="2">' . $total . '</td>
                                </tr>';
                            ?>
                        </tbody>
                    </table>
                <?php } ?>
            </td>
            <td>
                <?php if (isset($pasangTidak[4])) { ?>
                    <table class="table table-bordered">
                        <thead>                            <tr>                                <th style="text-align: center">Angka</th>                                <th style="text-align: center">X</th>                            </tr>                        </thead>
                        <tbody>
                            <?php
                            //depan
                            $total = 0;
                            foreach ($aduan as $no => $val) {
                                if (substr($val, 0, 1) == $pasangTidak[4]) {
                                    $sum_amount = ($play[$val]->sum_amount / 1000 );
                                    $total += $sum_amount;
                                    echo '<tr>
                                    <td style="text-align: center">' . $val . '</td>
                                    <td style="text-align: right">' . $sum_amount . '</td>
                                </tr>';
                                    unset($aduan[$no]);
                                }
                            }
                            $totalAll += $total;
                            echo '<tr class="warning">
                                    <td style="text-align: center" colspan="2">' . $total . '</td>
                                </tr>';
                            ?>
                        </tbody>
                    </table>
                <?php } ?>
            </td>
            <td>
                <?php if (isset($pasangTidak[4])) { ?>
                    <table class="table table-bordered">
                        <thead>                            <tr>                                <th style="text-align: center">Angka</th>                                <th style="text-align: center">X</th>                            </tr>                        </thead>
                        <tbody>
                            <?php
                            //belakang
                            $total = 0;
                            foreach ($aduan as $no => $val) {
                                if (substr($val, 1, 1) == $pasangTidak[4]) {
                                    $sum_amount = ($play[$val]->sum_amount / 1000 );
                                    $total += $sum_amount;
                                    echo '<tr>
                                    <td style="text-align: center">' . $val . '</td>
                                    <td style="text-align: right">' . $sum_amount . '</td>
                                </tr>';
                                    unset($aduan[$no]);
                                }
                            }
                            $totalAll += $total;
                            echo '<tr class="warning">
                                    <td style="text-align: center" colspan="2">' . $total . '</td>
                                </tr>';
                            ?>
                        </tbody>
                    </table>
                <?php } ?>
            </td>
        </tr>
        <tr>
            <td colspan="10">&nbsp;</td>
        </tr> 
        <tr class="info">
            <td colspan="10"><h4>Total Pemasangan : <?php echo $totalAll ?></h4></td>
        </tr> 
    </tbody>
</table>