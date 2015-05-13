<div class="printableArea">
    <div class="row-fluid">
        <div class="span6">Date : <b><?php echo date('d F Y', strtotime($mPlay->created)) ?></b></div>
        <div class="span6">
            Output : <b><?php echo ($mPlay->output == 's') ? 'Singapore ' : 'Hongkong'; ?></b>
        </div>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>            
                <th rowspan="2" style="text-align: center">#</th>
                <th colspan="2" style="text-align: center">0</th>
                <th colspan="2" style="text-align: center">1</th>
                <th colspan="2" style="text-align: center">2</th>
                <th colspan="2" style="text-align: center">3</th>
                <th colspan="2" style="text-align: center">4</th>
                <th colspan="2" style="text-align: center">5</th>
                <th colspan="2" style="text-align: center">6</th>
                <th colspan="2" style="text-align: center">7</th>
                <th colspan="2" style="text-align: center">8</th>
                <th colspan="2" style="text-align: center">9</th>
            </tr>
            <tr>            
                <th>Angka</th>
                <th>Pasangan</th>
                <th>Angka</th>
                <th>Pasangan</th>
                <th>Angka</th>
                <th>Pasangan</th>
                <th>Angka</th>
                <th>Pasangan</th>
                <th>Angka</th>
                <th>Pasangan</th>
                <th>Angka</th>
                <th>Pasangan</th>
                <th>Angka</th>
                <th>Pasangan</th>
                <th>Angka</th>
                <th>Pasangan</th>
                <th>Angka</th>
                <th>Pasangan</th>
                <th>Angka</th>
                <th>Pasangan</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 0;
            $total = 0;
            $cOutput = (!empty($mPlay->output)) ? ' AND output="' . $mPlay->output . '"' : '';
            $cType = (!empty($mPlay->type)) ? ' AND type="' . $mPlay->type . '"' : '';
            $date = date('Y-m-d', strtotime($mPlay->created));
            $play = Play::model()->findAll(array('select' => 'number,output,type, sum(amount) as sum_amount,status,play_result_id', 'group' => 'number,output,type,status,play_result_id', 'condition' => 'date(created)="' . $date . '"' . $cOutput . $cType, 'order' => 'type, sum_amount DESC'));

            $group = '';
            $groupTotal = array();
            foreach ($play as $o) {
                $no++;

                if ($group != $o->type) {

                    if ($group != '') {
                        //               mencari baris terbanyak
                        $most = 0;
                        for ($i = 0; $i <= 9; $i++) {
                            if (isset($results[$group][$i]) && count($results[$group][$i]) > $most) {
                                $most = count($results[$group][$i]) - 1;
                            }
                        }
//                    echo '<tr style="background-color: beige;"><td colspan="18"> ' . $most . '</td></tr>';

                        for ($i = 0; $i <= $most; $i++) {
                            $aa = (isset($results[$group][0][$i])) ? $results[$group][0][$i] : array('status' => '', 'number' => '', 'sum_amount' => '-');
                            $bb = (isset($results[$group][1][$i])) ? $results[$group][1][$i] : array('status' => '', 'number' => '', 'sum_amount' => '-');
                            $cc = (isset($results[$group][2][$i])) ? $results[$group][2][$i] : array('status' => '', 'number' => '', 'sum_amount' => '-');
                            $dd = (isset($results[$group][3][$i])) ? $results[$group][3][$i] : array('status' => '', 'number' => '', 'sum_amount' => '-');
                            $ee = (isset($results[$group][4][$i])) ? $results[$group][4][$i] : array('status' => '', 'number' => '', 'sum_amount' => '-');
                            $ff = (isset($results[$group][5][$i])) ? $results[$group][5][$i] : array('status' => '', 'number' => '', 'sum_amount' => '-');
                            $gg = (isset($results[$group][6][$i])) ? $results[$group][6][$i] : array('status' => '', 'number' => '', 'sum_amount' => '-');
                            $hh = (isset($results[$group][7][$i])) ? $results[$group][7][$i] : array('status' => '', 'number' => '', 'sum_amount' => '-');
                            $ii = (isset($results[$group][8][$i])) ? $results[$group][8][$i] : array('status' => '', 'number' => '', 'sum_amount' => '-');
                            $jj = (isset($results[$group][9][$i])) ? $results[$group][9][$i] : array('status' => '', 'number' => '', 'sum_amount' => '-');
                            $groupTotal[$group][0] += $aa['sum_amount'];
                            $groupTotal[$group][1] += $bb['sum_amount'];
                            $groupTotal[$group][2] += $cc['sum_amount'];
                            $groupTotal[$group][3] += $dd['sum_amount'];
                            $groupTotal[$group][4] += $ee['sum_amount'];
                            $groupTotal[$group][5] += $ff['sum_amount'];
                            $groupTotal[$group][6] += $gg['sum_amount'];
                            $groupTotal[$group][7] += $hh['sum_amount'];
                            $groupTotal[$group][8] += $ii['sum_amount'];
                            $groupTotal[$group][9] += $jj['sum_amount'];
                            $no = $i + 1;

                            $aaStyle = ($aa['status'] == 'win') ? ' style="background-color: greenyellow;"' : '';
                            $bbStyle = ($bb['status'] == 'win') ? ' style="background-color: greenyellow;"' : '';
                            $ccStyle = ($cc['status'] == 'win') ? ' style="background-color: greenyellow;"' : '';
                            $ddStyle = ($dd['status'] == 'win') ? ' style="background-color: greenyellow;"' : '';
                            $eeStyle = ($ee['status'] == 'win') ? ' style="background-color: greenyellow;"' : '';
                            $ffStyle = ($ff['status'] == 'win') ? ' style="background-color: greenyellow;"' : '';
                            $ggStyle = ($gg['status'] == 'win') ? ' style="background-color: greenyellow;"' : '';
                            $hhStyle = ($hh['status'] == 'win') ? ' style="background-color: greenyellow;"' : '';
                            $iiStyle = ($ii['status'] == 'win') ? ' style="background-color: greenyellow;"' : '';
                            $jjStyle = ($jj['status'] == 'win') ? ' style="background-color: greenyellow;"' : '';
                            echo '<tr style="font-size: 11px;">            
                            <td>' . $no . '</td>
                            <td' . $aaStyle . '>' . $aa['number'] . '</td>
                            <td' . $aaStyle . '>' . landa()->rp($aa['sum_amount'], false) . '</td>
                            <td' . $bbStyle . '>' . $bb['number'] . '</td>
                            <td' . $bbStyle . '>' . landa()->rp($bb['sum_amount'], false) . '</td>
                            <td' . $ccStyle . '>' . $cc['number'] . '</td>
                            <td' . $ccStyle . '>' . landa()->rp($cc['sum_amount'], false) . '</td>
                            <td' . $ddStyle . '>' . $dd['number'] . '</td>
                            <td' . $ddStyle . '>' . landa()->rp($dd['sum_amount'], false) . '</td>
                            <td' . $eeStyle . '>' . $ee['number'] . '</td>
                            <td' . $eeStyle . '>' . landa()->rp($ee['sum_amount'], false) . '</td>
                            <td' . $ffStyle . '>' . $ff['number'] . '</td>
                            <td' . $ffStyle . '>' . landa()->rp($ff['sum_amount'], false) . '</td>
                            <td' . $ggStyle . '>' . $gg['number'] . '</td>
                            <td' . $ggStyle . '>' . landa()->rp($gg['sum_amount'], false) . '</td>
                            <td' . $hhStyle . '>' . $hh['number'] . '</td>
                            <td' . $hhStyle . '>' . landa()->rp($hh['sum_amount'], false) . '</td>
                            <td' . $iiStyle . '>' . $ii['number'] . '</td>
                            <td' . $iiStyle . '>' . landa()->rp($ii['sum_amount'], false) . '</td>
                            <td' . $jjStyle . '>' . $jj['number'] . '</td>
                            <td' . $jjStyle . '>' . landa()->rp($jj['sum_amount'], false) . '</td>
                        </tr>';
                        }
                    }

                    $group = $o->type;
                    $groupTotal[$group][0] = 0;
                    $groupTotal[$group][1] = 0;
                    $groupTotal[$group][2] = 0;
                    $groupTotal[$group][3] = 0;
                    $groupTotal[$group][4] = 0;
                    $groupTotal[$group][5] = 0;
                    $groupTotal[$group][6] = 0;
                    $groupTotal[$group][7] = 0;
                    $groupTotal[$group][8] = 0;
                    $groupTotal[$group][9] = 0;
                    echo '<tr style="background-color: beige;"><td colspan="21">Permainan : ' . $group . '</td></tr>';
                }




                $results[$o->type][substr($o->number, -1)][] = array('status' => $o->status, 'number' => $o->number, 'sum_amount' => $o->sum_amount);

//            $groupTotal[$group] += $o->sum_amount;
//            echo'<tr>
//            <td>' . $o->number . '</td>    
//            <td>' . landa()->rp($o->sum_amount) . '</td>    
//            </tr>';
//            $total += $o->sum_amount;
            }

            if ($group != '') {
                //               mencari baris terbanyak
                $most = 0;
                for ($i = 0; $i <= 9; $i++) {
                    if (isset($results[$group][$i]) && count($results[$group][$i]) > $most) {
                        $most = count($results[$group][$i]) - 1;
                    }
                }
//                    echo '<tr style="background-color: beige;"><td colspan="18"> ' . $most . '</td></tr>';

                for ($i = 0; $i <= $most; $i++) {
                    $aa = (isset($results[$group][0][$i])) ? $results[$group][0][$i] : array('status' => '', 'number' => '', 'sum_amount' => '-');
                    $bb = (isset($results[$group][1][$i])) ? $results[$group][1][$i] : array('status' => '', 'number' => '', 'sum_amount' => '-');
                    $cc = (isset($results[$group][2][$i])) ? $results[$group][2][$i] : array('status' => '', 'number' => '', 'sum_amount' => '-');
                    $dd = (isset($results[$group][3][$i])) ? $results[$group][3][$i] : array('status' => '', 'number' => '', 'sum_amount' => '-');
                    $ee = (isset($results[$group][4][$i])) ? $results[$group][4][$i] : array('status' => '', 'number' => '', 'sum_amount' => '-');
                    $ff = (isset($results[$group][5][$i])) ? $results[$group][5][$i] : array('status' => '', 'number' => '', 'sum_amount' => '-');
                    $gg = (isset($results[$group][6][$i])) ? $results[$group][6][$i] : array('status' => '', 'number' => '', 'sum_amount' => '-');
                    $hh = (isset($results[$group][7][$i])) ? $results[$group][7][$i] : array('status' => '', 'number' => '', 'sum_amount' => '-');
                    $ii = (isset($results[$group][8][$i])) ? $results[$group][8][$i] : array('status' => '', 'number' => '', 'sum_amount' => '-');
                    $jj = (isset($results[$group][9][$i])) ? $results[$group][9][$i] : array('status' => '', 'number' => '', 'sum_amount' => '-');
                    $groupTotal[$group][0] += $aa['sum_amount'];
                    $groupTotal[$group][1] += $bb['sum_amount'];
                    $groupTotal[$group][2] += $cc['sum_amount'];
                    $groupTotal[$group][3] += $dd['sum_amount'];
                    $groupTotal[$group][4] += $ee['sum_amount'];
                    $groupTotal[$group][5] += $ff['sum_amount'];
                    $groupTotal[$group][6] += $gg['sum_amount'];
                    $groupTotal[$group][7] += $hh['sum_amount'];
                    $groupTotal[$group][8] += $ii['sum_amount'];
                    $groupTotal[$group][9] += $jj['sum_amount'];
                    $no = $i + 1;

                    $aaStyle = ($aa['status'] == 'win') ? ' style="background-color: greenyellow;"' : '';
                    $bbStyle = ($bb['status'] == 'win') ? ' style="background-color: greenyellow;"' : '';
                    $ccStyle = ($cc['status'] == 'win') ? ' style="background-color: greenyellow;"' : '';
                    $ddStyle = ($dd['status'] == 'win') ? ' style="background-color: greenyellow;"' : '';
                    $eeStyle = ($ee['status'] == 'win') ? ' style="background-color: greenyellow;"' : '';
                    $ffStyle = ($ff['status'] == 'win') ? ' style="background-color: greenyellow;"' : '';
                    $ggStyle = ($gg['status'] == 'win') ? ' style="background-color: greenyellow;"' : '';
                    $hhStyle = ($hh['status'] == 'win') ? ' style="background-color: greenyellow;"' : '';
                    $iiStyle = ($ii['status'] == 'win') ? ' style="background-color: greenyellow;"' : '';
                    $jjStyle = ($jj['status'] == 'win') ? ' style="background-color: greenyellow;"' : '';
                    echo '<tr style="font-size: 11px;">            
                            <td>' . $no . '</td>
                            <td' . $aaStyle . '>' . $aa['number'] . '</td>
                            <td' . $aaStyle . '>' . landa()->rp($aa['sum_amount'], false) . '</td>
                            <td' . $bbStyle . '>' . $bb['number'] . '</td>
                            <td' . $bbStyle . '>' . landa()->rp($bb['sum_amount'], false) . '</td>
                            <td' . $ccStyle . '>' . $cc['number'] . '</td>
                            <td' . $ccStyle . '>' . landa()->rp($cc['sum_amount'], false) . '</td>
                            <td' . $ddStyle . '>' . $dd['number'] . '</td>
                            <td' . $ddStyle . '>' . landa()->rp($dd['sum_amount'], false) . '</td>
                            <td' . $eeStyle . '>' . $ee['number'] . '</td>
                            <td' . $eeStyle . '>' . landa()->rp($ee['sum_amount'], false) . '</td>
                            <td' . $ffStyle . '>' . $ff['number'] . '</td>
                            <td' . $ffStyle . '>' . landa()->rp($ff['sum_amount'], false) . '</td>
                            <td' . $ggStyle . '>' . $gg['number'] . '</td>
                            <td' . $ggStyle . '>' . landa()->rp($gg['sum_amount'], false) . '</td>
                            <td' . $hhStyle . '>' . $hh['number'] . '</td>
                            <td' . $hhStyle . '>' . landa()->rp($hh['sum_amount'], false) . '</td>
                            <td' . $iiStyle . '>' . $ii['number'] . '</td>
                            <td' . $iiStyle . '>' . landa()->rp($ii['sum_amount'], false) . '</td>
                            <td' . $jjStyle . '>' . $jj['number'] . '</td>
                            <td' . $jjStyle . '>' . landa()->rp($jj['sum_amount'], false) . '</td>
                        </tr>';
                }
            }

            $total = array(0 => 0, 1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 6 => 0, 7 => 0, 8 => 0, 9 => 0);
            foreach ($groupTotal as $key => $val) {
                $total[0] += $val[0];
                $total[1] += $val[1];
                $total[2] += $val[2];
                $total[3] += $val[3];
                $total[4] += $val[4];
                $total[5] += $val[5];
                $total[6] += $val[6];
                $total[7] += $val[7];
                $total[8] += $val[8];
                $total[9] += $val[9];
                echo'<tr style="background-color: bisque;">
            <td>' . $key . '</td>    
            <td></td>       
            <td>' . landa()->rp($val[0], false) . '</td>    
            <td></td>       
            <td>' . landa()->rp($val[1], false) . '</td>    
            <td></td>       
            <td>' . landa()->rp($val[2], false) . '</td>    
            <td></td>       
            <td>' . landa()->rp($val[3], false) . '</td>    
            <td></td>       
            <td>' . landa()->rp($val[4], false) . '</td>    
            <td></td>       
            <td>' . landa()->rp($val[5], false) . '</td>    
            <td></td>       
            <td>' . landa()->rp($val[6], false) . '</td>    
            <td></td>       
            <td>' . landa()->rp($val[7], false) . '</td>    
            <td></td>       
            <td>' . landa()->rp($val[8], false) . '</td>    
            <td></td>       
            <td>' . landa()->rp($val[9], false) . '</td>       
            </tr>';
            }
            echo'<tr style="background-color: bisque;">
            <td><b>Total</b></td>    
            <td></td>    
            <td>' . landa()->rp($total[0], false) . '</td>    
            <td></td>       
            <td>' . landa()->rp($total[1], false) . '</td>    
            <td></td>       
            <td>' . landa()->rp($total[2], false) . '</td>    
            <td></td>       
            <td>' . landa()->rp($total[3], false) . '</td>    
            <td></td>       
            <td>' . landa()->rp($total[4], false) . '</td>    
            <td></td>       
            <td>' . landa()->rp($total[5], false) . '</td>    
            <td></td>       
            <td>' . landa()->rp($total[6], false) . '</td>    
            <td></td>       
            <td>' . landa()->rp($total[7], false) . '</td>    
            <td></td>       
            <td>' . landa()->rp($total[8], false) . '</td>    
            <td></td>       
            <td>' . landa()->rp($total[9], false) . '</td>       
            </tr>';
            ?>
        </tbody>
    </table>
</div>
<style type="text/css" media="print">
    body {
        visibility:hidden;
    }
    .printableArea{
        position:absolute;
        top:0;
        left:0;
        visibility:visible;
        -webkit-print-color-adjust: exact; 
    } 
</style>
<script type="text/javascript">
    function printDiv()
    {

        window.print();

    }
</script>