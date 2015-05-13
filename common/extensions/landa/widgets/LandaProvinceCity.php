<?php

class LandaProvinceCity extends CWidget {

    public $name;
    public $disabled;
    public $cityValue;
    public $provinceValue;
    public $prefix;

    public function run() {
        if (empty($this->prefix))
            $this->prefix = "";
        $name = $this->name;
        $cityValue = $this->cityValue;
        $provinceValue = $this->provinceValue;
        $disabled = $this->disabled;
        $id = str_replace(" ", "_", $name);
        $data ='';
//        $data = '<div class="control-group ">';
//        $data .= '<label class="control-label" for="province_id_' . $name . '">Province<span class="text-error"> *</span></label>';
//        $data .= '<div class="controls">';

//        $data .= $this->widget(
//                'bootstrap.widgets.TbSelect2', array(
//            'name' => $this->prefix . 'province_' . $name,
//            'value' => $provinceValue,
//            'data' => CHtml::listData(Province::model()->findAll(), 'id', 'name'),
//            'options' => array(
//                'placeholder' => 'type clever, or is, or just type!',
//                'width' => '40%',
//            ),
//            'events' => array('change' => 'js: function() {
//                                                     $.ajax({
//                                                        url : "' . url('city/takeCity') . '",
//                                                        type : "POST",
//                                                        data :  { landaProvince:  $(this).val(),name:'.$name.',prefix:'.$this->prefix.'},
//                                                        success : function(data){                                                              
//                                                           $("#cityq_' . $id . '").html(data);  
//                                                        }
//                                                     });
//                                            }')
//                )
//                , true);
//        $data .= $this->widget(
//                'bootstrap.widgets.TbSelect2', array(
//            'name' => $this->prefix . 'province_' . $name,
//            'value' => $provinceValue,
//            'data' => CHtml::listData(Province::model()->findAll(), 'id', 'name'),
//            'htmlOptions' => array(
//                'disabled' => $disabled
//            ),
//            'options' => array(
//                'width' => '40%'
//            ),
//            'events' => array('change' => 'js: function() {
//                                        $.ajax({
//                                           url : "' . url('city/takeCity') . '",
//                                           type : "POST",
//                                           data :  { landaProvince:  $(this).val(),name:"' . $name . '",prefix:"' . $this->prefix . '"},
//                                           success : function(data){                                                              
//                                              $("#cityq_' . $id . '").html(data);  
//                                             
//                                           }
//                                        });
//                               }')
//                ), true);


//        $data .= CHtml::dropDownList($this->prefix . 'province_' . $name, $provinceValue, CHtml::listData(Province::model()->findAll(), 'id', 'name'), array('disabled' => $disabled,
//                    'empty' => t('choose', 'global'),
//                    'ajax' => array(
//                        'type' => 'POST',
//                        'url' => url('city/takeCity'),
//                        'data' => array('landaProvince' => 'js:this.value', 'name' => $name, 'prefix' => $this->prefix),
//                        'success' => 'function(data){                                                                      
//                                       $("#cityq_' . $id . '").html(data);  
//                         }',
//                    ),
//        ));


//        $data .= '</div></div>';

        $data .= '<div class="control-group ">';
        $data .= '<label class="control-label" for="city_' . $name . '">City<span class="text-error"> *</span></label>';
        $data .= '<div class="controls" id="cityq_' . $id . '">';

        $data .= $this->widget(
                'bootstrap.widgets.TbSelect2', array(
            'name' => $this->prefix . 'city_' . $name,
            'value' => $cityValue,
            'data' => CHtml::listData(City::model()->findAll(), 'id', 'fullName'),
            'htmlOptions' => array(
                'disabled' => $disabled
            ),
            'options' => array(
                'width' => '60%'
            )), true);

//        $data .= CHtml::dropDownList($this->prefix . 'city_' . $name, $cityValue, CHtml::listData(City::model()->findAll(), 'id', 'name'), array('class' => 'span3', 'disabled' => $disabled,));



        $data .= '</div></div>';
        echo $data;
    }

}
?>




