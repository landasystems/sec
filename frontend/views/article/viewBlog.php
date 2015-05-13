<?php
$this->pageTitle = $_GET['title'];
$this->breadcrumbs = array(
    $_GET['title']
);
?>
<!--    <div class="one columns alpha">
        <div class="blog-date-sec"> <span>AUG</span>
            <h3>09</h3>
            <span>2013</span> </div>
    </div>-->
<?php
foreach ($model as $oArticle) {
    echo '<article class="blog-post row-fluid">
    <div class="span3 columns alpha"> 
    <img src="' . $oArticle->img['medium'] . '" alt="" class="img-polaroid"><br>
    </div>
    <div class="span9 columns omega">
        <h4><a href="' . $oArticle->url . '">' . $oArticle->title . '</a></h4>
        ' . $oArticle->introText(1000) . ' <br/><br/>
        <a href="' . $oArticle->url . '"  class="btn" id="button-readmore">Read more</a> </div>
    <br class="clear">
    </article>';
}
?>
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