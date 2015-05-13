<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ArticleAccordion
 *
 * @author landa
 */
class LandaEventUpcoming extends CWidget {

    public $model;

    //put your code here

    public function run() {
        $this->registerScript();

        $isAny = true;
        $li = '';

        trace(count($this->model));
        foreach ($this->model as $no => $oEvent) {
            if ($oEvent->date_event >= date("Y-m-d")) {
                if ($isAny) { //first li, give the thumbnail
//                    echo '<div class="thumbnail"><img src="' . $oEvent->img['medium'] . '"/></div>';
                }
                $li .= '<li class="group">			
                            <div class="row-fluid">
                                <div class="span3">
                                <p class="tour-date"><span class="day">' . date('d', strtotime($oEvent->date_event)) . '</span><span class="month" style="color: #fff;">' . date('M', strtotime($oEvent->date_event)) . '</span></p>
                                </div>
                                <div class="span9">
                                   <a href="' . url('event/' . $oEvent->alias) . '">' . $oEvent->title . '</a>
                                    
                                </div> 
                            <div>
                       </li>';
                $isAny = false; //any upcoming event
            }
        }

        if ($isAny) {
            echo 'Even selanjutnya akan segera di perbarui.<br/><br/>';
        } else {
            echo '<ul class="tour-dates current-dates" style="margin-left:0">' . $li . '</ul>';
        }
    }

    public function registerScript() {
        app()->landa->registerAssetCss('landaEvent.css');
    }

}

?>
