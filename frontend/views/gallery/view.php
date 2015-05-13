<style>

    div.wrapper{  
        float:left; /* important */  
        position:relative; /* important(so we can absolutely position the description div */  
    }  
    div.description{  
        position:absolute; /* absolute position (so we can position it where we want)*/  
        margin-top:-90px; /* position will be on bottom */  
        left:0px;  
        width: 100%;
        height: 55px;
        /* styling bellow */  
        background-color:black;  

        font-size:13px;  
        color:white;  
        opacity:0.6; /* transparency */  
        filter:alpha(opacity=60); /* IE transparency */  
        text-decoration:bold;
    }  
    p.description_content{  
        /*        padding:20px;  */
        padding:7px;
        color: #fff;

    }
    .gallery{
        min-height: 213px;
    }
    .row-fluid ul.thumbnails li.span12 + li { margin-left : 0px;clear:left }
    .row-fluid ul.thumbnails li.span6:nth-child(2n + 3) { margin-left : 0px;clear:left }
    .row-fluid ul.thumbnails li.span8:nth-child(2n + 3) { margin-left : 0px;clear:left }
    .row-fluid ul.thumbnails li.span9:nth-child(2n + 3) { margin-left : 0px;clear:left }
    .row-fluid ul.thumbnails li.span4:nth-child(3n + 4) { margin-left : 0px;clear:left }
    .row-fluid ul.thumbnails li.span3:nth-child(4n + 5) { margin-left : 0px; clear:left}
    .row-fluid ul.thumbnails li.span2:nth-child(6n + 7) { margin-left : 0px;clear:left }
    .row-fluid ul.thumbnails li.span1:nth-child(12n + 13) { margin-left : 0px;clear:left }

</style>


<?php
$this->pageTitle = $_GET['title'];
$this->breadcrumbs = array(
    $_GET['title']
);

?>
<hr>
<?php
echo'<div class="row-fluid">
    <ul class="thumbnails" style="width:;">';
//trace($_SERVER["REQUEST_URI"]);

foreach ($modelGallery as $arrModelCategory) {
    $description = (!empty($arrModelCategory->name)) ? '<div class="description"><p class="description_content">' . strtolower($arrModelCategory->name) . '</p></div>' : '';
    echo '<li class="span3">
               <div class="wrapper">  
                    <a href="' . url($_GET['alias'] . '/cat/' . $arrModelCategory->id . '/' . landa()->urlParsing($arrModelCategory->name)) . '" >
                <div class="bordered"><img src="' . $arrModelCategory->img['medium'] . '" alt="" class="scale-with-grid " style="min-height: 213px;min-width:112px" /></div>
                   ' . strtolower($description) . '</div>  
          </li>';
}

echo '</ul></div> ';
?>
<div classs="row-fluid">
    <ul class="thumbnails">
        <?php
        foreach ($model as $arrGallery) {
            $sDescription = (!empty($arrGallery->description)) ? '<div class="description"><p class="description_content">' . strtolower($arrGallery->description) . '</p></div>' : '';

            echo '<li class="span3">
                <div class="wrapper">    
                    <a href="' . $arrGallery->img['big'] . '" data-rel="prettyPhoto[ppGal]" title="' . $arrGallery->description . '">
                       <img src="' . $arrGallery->img['medium'] . '" alt="" class="" style="height: 273px;width:312px"/>
                       ' . $sDescription . '
                    </a>
                </div>
              </li>';
        }
        ?>
    </ul></div>

<?php
$this->widget('CLinkPager', array(
    'header' => '',
    'firstPageLabel' => '&lt;&lt;',
    'prevPageLabel' => '&lt;',
    'nextPageLabel' => '&gt;',
    'lastPageLabel' => '&lt;&lt;',
    'pages' => $pages,
));
?>
