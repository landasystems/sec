
<?php
cs()->registerCss('', '#list2 { width:620px; }
#list2 ol {width: 30em; font-style:italic; font-family:Georgia, Times, serif; font-size:24px; color:#000000;  }
#list2 ol li {float:left;width: 16em;}
#list2 ol li p { padding:8px; font-style:normal; font-family:Arial; font-size:13px; color:#000000; border-left: 1px solid #999; }
#list2 ol li p em { display:block; }
#list2 ol a{text-decoration:none;}
#list2 ol li:hover {
  background: #eee;
  cursor: pointer;
  text-decoration:none;
}');
$this->setPageTitle('Downloads');
$this->breadcrumbs = array(
    '',
);
?>





<?php /* echo'<div id="list2">
  <ol>';
  trace($_SERVER["REQUEST_URI"]);
  foreach($modelCategory as $arrModelCategory){
  echo '
  <a href="'. url( $_GET['menu']['alias'].'/'. $arrModelCategory->id . '/'. landa()->urlParsing($arrModelCategory->name)) .'"> <li><p><em>'.$arrModelCategory->name.'</em></p></li></a>

  ';
  }

  echo '</ol>
  </div>'; */ ?>
<h2>Download</h2>
<hr>
<br><br>
<div class="well">
    <?php
//                        $oDownloads = Download::model()->findAll(array());
    foreach ($model as $odownload) {
        echo '<div class="well well-small">
                               <p>' . $odownload->url . '
                                
                             <a href="' . $odownload->urlFull . '" class="btn btn-primary pull-right"> Download</a></p>
                               
</div>';
    }
    ?>
    <?php
//                        $oDownloads = Download::model()->findAll(array());
    foreach ($modelCategory as $arrModelCategory) {
        $cektotal = Download::model()->findAll(array('condition'=>'download_category_id='.$arrModelCategory->id.' AND publish=1'));
        echo '<div class="well well-small">
                               <p>' . $arrModelCategory->name . ' ('.count($cektotal).' Data)
                                
                             <a href="' . url($_GET['alias'] . '/cat/' . $arrModelCategory->id . '/' . landa()->urlParsing($arrModelCategory->name)) . '" class="btn btn-primary pull-right"> Pilih</a></p>
                               
</div>';
    }
    ?>
</div>
<div class="pagination-all pagination">
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
</div>
<style>
    .pagination-all.pagination {
        margin:0 0 36px 0;
        float:left;
        width:100%;
        position:relative;
    }
    .pagination-all.pagination ul > li:first-child:before {
        content:'';
        width:7px;
        height:7px;
        background-color:#ccc;
        border-radius:7px;
        position:absolute;
        left:-16px;
        top:41%;
        margin:auto;
    }
    .pagination-all.pagination ul > li:last-child:after {
        content:'';
        width:7px;
        height:7px;
        background-color:#ccc;
        border-radius:7px;
        position:absolute;
        right:-16px;
        top:41%;
        margin:auto;
    }
    .pagination-all.pagination ul {
        border-radius:0;
        box-shadow:none;
        display:block;
        margin-bottom:0;
        margin-left:0;
        text-align:center;
        position:relative;
    }
    .pagination-all.pagination ul:before {
        content:'';
        border-top:1px solid #ccc;
        width:360px;
        position:absolute;
        left:0;
        right:0;
        margin:auto;
        top:42%;
    }
    .pagination-all.pagination ul > li {
        display: inline-block;
        padding:0 0 0 6px;
        position:relative;
        float:none;
    }
    .pagination-all.pagination ul > li:first-child {
        padding:0;
        position:relative;
    }
    .pagination-all.pagination ul > li:first-child > a, .pagination ul > li:first-child > span {
        border-radius:38px;
    }
    .pagination-all.pagination ul > li:last-child > a, .pagination ul > li:last-child > span {
        border-radius:38px;
    }
    .pagination-all.pagination ul > li > a, .pagination ul > li > span {
        border:1px solid #ccc;
        background-color:#fff;
        float: left;
        line-height:normal;
        width:38px;
        height:40px;
        border-radius:100%;
        padding:0;
        text-decoration: none;
        box-shadow:0 -3px 0 0 #ccc inset;
        -moz-box-shadow:0 -3px 0 0 #ccc inset;
        -moz-box-shadow:0 -3px 0 0 #ccc inset;
        font:400 16px/38px 'Roboto Slab', serif;
        color:#999;
    }
    .pagination-all.pagination ul > li > a:hover, .pagination ul > li > a:focus, .pagination ul > .active > a, .pagination ul > .active > span {
        color:#fff;
        border:1px solid;
        box-shadow:0 -3px 0 0 rgba(0,0,0,0.2) inset;
        -moz-box-shadow:0 -3px 0 0 rgba(0,0,0,0.2) inset;
        -moz-box-shadow:0 -3px 0 0 rgba(0,0,0,0.2) inset;
    }
    .pagination-all.pagination ul > .selected > a, .pagination ul > .selected > span {
        color:#fff;
        background-color: #ba131a;
        border:1px solid;
        box-shadow:0 -3px 0 0 rgba(0,0,0,0.2) inset;
        -moz-box-shadow:0 -3px 0 0 rgba(0,0,0,0.2) inset;
        -moz-box-shadow:0 -3px 0 0 rgba(0,0,0,0.2) inset;
    }
</style>



