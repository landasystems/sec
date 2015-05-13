<?php
if (count($model)>0){
if (isset($name))
echo "<h1 style='color:black'>".$name."</h1><hr>";
?>
        <table>
        <?php           
            foreach ($model as $value) {                                            
        ?>
 
                <tr>
                    <?php 
                    if ($value->type=="Text Content"){
                        echo "<td colspan='3'>".$value->type_value."</td>";
                    }else{
                    ?>
                    <td class="span3" style="vertical-align: top">
                        <?php echo htmlentities($value->name);
                              if ($value->mandatory=='1') echo " <span class='required'>*</span>";
                        ?>
                    </td>
                    <td style="vertical-align: top">:</td>
                    <td style="vertical-align: top;width:700px">
                        <?php
                        //--------------- check type
                        $province=1;
                        $city=1;
                        $selected='';
                        if($value->type=="Address"){                                                                                                                                    
                            $value->type_value = (isset($result[$value->form_category_id.'_'.'street_'. str_replace(' ','_',$value->name).'_'.$value->id])) ? $result[$value->form_category_id.'_'.'street_'.str_replace(' ','_',$value->name).'_'.$value->id] : '';                                                                                                
                            $province = (isset($result[$value->form_category_id.'_'.'province_'. str_replace(' ','_',$value->name).'_'.$value->id])) ? $result[$value->form_category_id.'_'.'province_'.str_replace(' ','_',$value->name).'_'.$value->id] : '';                                                                                                
                            $city = (isset($result[$value->form_category_id.'_'.'city_'. str_replace(' ','_',$value->name).'_'.$value->id])) ? $result[$value->form_category_id.'_'.'city_'.str_replace(' ','_',$value->name).'_'.$value->id] : '';                                                                                                
                        }elseif ($value->type!= 'RadioButton' && $value->type!= 'CheckBox' && $value->type!= 'ComboBox'){
                            $value->type_value = (isset($result[$value->form_category_id.'_'. str_replace(' ','_',$value->name).'_'.$value->id])) ? $result[$value->form_category_id.'_'.str_replace(' ','_',$value->name).'_'.$value->id] : '';                                                                                                                         
                        }else{                            
                            $selected =(isset($result[$value->form_category_id.'_'. str_replace(' ','_',$value->name).'_'.$value->id])) ? $result[$value->form_category_id.'_'.str_replace(' ','_',$value->name).'_'.$value->id] : '';                                                                        
                        }                                                
                        
                        if ($value->type=="TextBox"){                        
                            echo CHtml::textField($value->form_category_id.'_'.$value->name.'_'.$value->id,$value->type_value,array('class'=>'span6'));
                        }elseif($value->type=="TextArea"){
                            echo CHtml::textArea($value->form_category_id.'_'.$value->name.'_'.$value->id,$value->type_value,array('class'=>'span6','style'=>'height:100px'));
                        }elseif($value->type=="ComboBox"){
                            $value->type_value='- Pilih '.$value->name.' -<br>'.$value->type_value;
                            $variable=  explode('<br>',  ucwords($value->type_value));                            
                            echo CHtml::dropDownList($value->form_category_id.'_'.$value->name.'_'.$value->id, $selected, 
                                         $variable,array('class'=>'span2'));
                        }elseif($value->type=="RadioButton"){
                            $variable=  explode('<br>',  ucwords($value->type_value));                            
                            echo CHtml::radioButtonList($value->form_category_id.'_'.$value->name.'_'.$value->id,$selected,$variable, array( 'separator' => "  ",'style'=>'float:left'));
                        }elseif($value->type=="CheckBox"){

                            $variable=  explode('<br>',  ucwords($value->type_value));                            
                            echo CHtml::checkBoxList($value->form_category_id.'_'.$value->name.'_'.$value->id,$selected,$variable, array( 'separator' => "  ",'style'=>'float:left'));
                        }elseif($value->type=="Date"){
                            echo '<div class="input-prepend">
                                    <span class="add-on"><i class="icon-calendar"></i></span>';                            
                            $this->widget(
                                'bootstrap.widgets.TbDatePicker',
                                array(
                                    'name' => $value->form_category_id.'_'.$value->name.'_'.$value->id,
                                    'options' => array(
                                        'language' => 'en'
                                    ),
                                    'value'=>$value->type_value
                                )
                            );
                            echo '</div>'; 
                        }elseif($value->type=="Date Range"){
                            echo '<div class="input-prepend">
                                    <span class="add-on"><i class="icon-calendar"></i></span>';                            
                            $this->widget(
                                'bootstrap.widgets.TbDateRangePicker',
                                array(
                                    'name' => $value->form_category_id.'_'.$value->name.'_'.$value->id,
                                    'options' => array(
                                        'language' => 'en'
                                    )
                                )
                            );
                            echo '</div>';                     
                        }elseif($value->type=="Email"){
                            echo '<div class="input-prepend">
                                    <span class="add-on">@</i></span>';
                            echo CHtml::textField($value->form_category_id.'_'.$value->name.'_'.$value->id,$value->type_value,array('class'=>'span6'));
                            echo '</div>';   
                        }elseif($value->type=="Editor"){
                            $this->widget(
                                'bootstrap.widgets.TbCKEditor',
                                array(
                                    'name' => $value->form_category_id.'_'.$value->name.'_'.$value->id,
                                    'value'=>$value->type_value
                                )
                            );  
                            
                        //-----------------------------------------------------------------    
                        }elseif($value->type=="Text Content"){
                            echo $value->type_value;
                        }elseif($value->type=="Address"){  
                            echo CHtml::textArea($value->form_category_id.'_'.'street_'.$value->name.'_'.$value->id,$value->type_value,array('class'=>'span6','style'=>'height:100px'));                         
                            $this->widget('common.extensions.landa.widgets.LandaProvinceCity', array('name' => $value->name.'_'.$value->id, 'provinceValue' => $province, 'cityValue' => $city, 'disabled' => false,'prefix'=>$value->form_category_id.'_'));                         
                        }elseif($value->type=="ComboBox with Other"){
                            echo CHtml::textArea($value->form_category_id.'_'.$value->name.'_'.$value->id,$value->type_value,array('style'=>'width:500px;height:100px'));                        
                        }elseif($value->type=="RadioButton with Other"){
                            echo CHtml::textArea($value->form_category_id.'_'.$value->name.'_'.$value->id,$value->type_value,array('style'=>'width:500px;height:100px'));
                        }elseif($value->type=="CheckBox with Other"){
                            echo CHtml::textArea($value->form_category_id.'_'.$value->name.'_'.$value->id,$value->type_value,array('style'=>'width:500px;height:100px'));
                        }
                        ?>
                    </td>
                    
            <?php } ?>
                </tr>
            
     
        <?        
            }
        ?>        
    </table>             

<?php } ?>

