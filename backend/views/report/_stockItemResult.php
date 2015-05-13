<div class="row-fluid">
    
    <div class="span6">
        Method : <b><?php
            $siteConfig = SiteConfig::model()->listSiteConfig();
            echo $siteConfig['method'];
            ?></b>
    </div>
</div>

<table class="table table-bordered">
    <thead>
        <tr>
        <td  style="text-align: center" colspan="3"><h2>STOCK ITEMS REPORT</h2>
            
            <hr></td>
    </tr>
        <tr>
            <th rowspan="2">Code</th>
            <th rowspan="2">Name</th>
            <th rowspan="2">Stock</th>
        </tr>
        
    </thead>
    <tbody>
        <?php
       // $category=  ProductCategory::model()->findAll(array('condition'=>'id='.$_GET['product_category_id']));
       // $model=  Product::model()->findAll(array('condition'=>'product_category_id='.$_GET['product_category_id']));
            foreach($stockItem as $m){
                echo'
                    <tr>
                    <td>'.$m->code.'</td>
                    <td>'.$m->name.'</td>
                    <td>'. ProductStock::model()->departement($m->stock,$_POST['departement_id']).'</td>
                    </tr>
';
            }
        ?>
    </tbody>
   
</table>
