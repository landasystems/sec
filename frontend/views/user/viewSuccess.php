<?php
$this->setPageTitle('Confirm Register User To : '. $model->name);

?>
<div class="alert alert-success">
    JIka belum lengkap anda bisa mengedit biodata diri di website resmi tp untuk saat ini belum lauching.<br>
</div>

<table>
    <tr>
        <td width="20%" style="vertical-align: top">

            <?php
            echo $model->mediumImage;
            ?>

        </td>
        <td style="vertical-align: top;" width="70%">
            <table class="table table-striped" style="width:100%">

                <tr>
                    <td style="text-align: left" class="span1">
                        <b>Nama</b>
                    </td>
                    <td style="text-align: left;width:1px">
                        :
                    </td>
                    <td style="text-align: left" class="span4">
                        <?php echo $model->name; ?>
                    </td>
                    <td style="text-align: left" class="span1">
                        <span class="inventory"><b>Email</b></span>
                    </td>
                    <td style="text-align: left;width:1px" class="">
                        <span class="inventory">:</span>
                    </td>                        
                    <td style="text-align: left" class="span4">
                        <span class="inventory">
                            <?php
                            echo $model->email;
                            ?>
                        </span>
                    </td>

                </tr>
                <tr>
                    <td style="text-align: left" class="span1">
                        <b>Kota/ Kab</b>
                    </td>
                    <td style="text-align: left;width:1px">
                        :
                    </td>
                    <td style="text-align: left" class="span4">
                        <?php echo $model->City->name; ?>
                    </td>
                    <td style="text-align: left" class="span1">
                        <span class="inventory"><b>Telpon</b></span>
                    </td>
                    <td style="text-align: left;width:1px" class="">
                        <span class="inventory">:</span>
                    </td>                        
                    <td style="text-align: left" class="span4">
                        <span class="inventory">
                            <?php echo landa()->hp($model->phone); ?>            
                        </span>
                    </td>

                </tr>
                <tr>
                    <td style="text-align: left" class="span1">
                        <b>Kategori Usaha</b>
                    </td>
                    <td style="text-align: left;width:1px">
                        :
                    </td>
                    <td style="text-align: left" class="span4" >
                        <?php echo $model->BusinessCategory->name; ?>
                    </td>
                                            
                    <td style="text-align: left" class="span1">
                        <span class="inventory"><b>Jenis Usaha</b></span>
                    </td>
                    <td style="text-align: left;width:1px" class="">
                        <span class="inventory">:</span>
                    </td>                        
                    <td style="text-align: left" class="span4">
                        <span class="inventory">
                            <?php echo $model->type_business; ?>            
                        </span>
                    </td>

                </tr>                     
                <tr>
                    <td style="text-align: left" class="span1">
                        <b>Nama Usaha</b>
                    </td>
                    <td style="text-align: left;width:1px">
                        :
                    </td>
                    <td style="text-align: left" class="span4" >
                        <?php echo $model->company_name; ?>
                    </td>
                                            
                    <td style="text-align: left" class="span1">
                        <span class="inventory"><b>Pin BB / WA</b></span>
                    </td>
                    <td style="text-align: left;width:1px" class="">
                        <span class="inventory">:</span>
                    </td>                        
                    <td style="text-align: left" class="span4">
                        <span class="inventory">  
                            <?php echo $model->pin; ?>
                        </span>
                    </td>

                </tr>                     

                <tr class="inventory">
                    <td style="text-align: left" class="span2">
                        <b>Alamat</b>
                    </td>
                    <td style="text-align: left;width:1px">
                        :
                    </td>
                    <td style="text-align: left" class="span4" colspan="4">
                        <?php echo $model->address; ?>
                    </td>
                   

    </tr>  


    <tr class="inventory">
        <td style="text-align: left" class="span2" colspan="6">
            <?php echo '<i>"' . $model->description . '"</i>'; ?>
        </td>


    </tr>                     
</table>                                           
</td>

</tr>


</table>
