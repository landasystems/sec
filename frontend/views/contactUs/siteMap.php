<?php
$this->pageTitle = 'Site Maps';
$this->breadcrumbs = array(
    'Site Maps',
);
?>
<style>
    h2{
        color:#000;
    }
ul{
  margin-left:20px;
}
ol{
  margin-left:20px;
}

#ar li {
    width: 50%;
}
#ar li a{
    width: 50%;
    color:#000;
}
#ar li.left {
    float: left;
}

#ar li.right {
    float: right;
}

@media only screen and (max-width: 480px) {
    .left, .right {
        float: none;
        width: 100%;
    }
}
#ar li:nth-child(odd) {
    float: left;
}

#ar li:nth-child(even) {
    float: right;
}

@media only screen and (max-width: 480px) {
    #ar  li {
        float: none;
        width: 100%;
    }
}

/*SITE MAP*/

#list5 li {
    width: 50%;
}
#list5 li a{
    width: 50%;
    color:#000;
}
#list5 li.left {
    float: left;
}

#list5 li.right {
    float: right;
}

@media only screen and (max-width: 480px) {
    .left, .right {
        float: none;
        width: 100%;
    }
}
#list5 li:nth-child(odd) {
    float: left;
}

#list5 li:nth-child(even) {
    float: right;
}

@media only screen and (max-width: 480px) {
    #list5  li {
        float: none;
        width: 100%;
    }
}
</style>
<div id="list5">
  <center><h2>Site Map</h2></center>
<ol>
<?php
foreach($menulvl1 as $a){
    
    
   
?>
    <li><a href="<?php echo url($a->alias); ?>"><?php echo $a->name; ?></a>
        <?php
    $child = Menu::model()->findByPk($a->id);
    $valchild = $child->descendants()->findAll();
    if(!empty($valchild)){
       foreach ($valchild as $val) {
        echo '<ol>
            <li>'.$val->name.'</li>
            </ol>';
            } 
    }
             
            ?>
    
    </li>
<?php } ?>
</ol>
</div>
<hr>

<?php
if(!empty($article)){
    echo'<center><h2>List Article</h2></center>';
    echo'<div id="ar"><ul>';
    foreach($article as $ar){
        echo'<li><a href="'.$ar->url.'">'.$ar->title.'</a></li>';
    }
    echo'</ul></div>';
}
?>