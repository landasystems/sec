
<div class="forum-category" style="background:#faa61a" >
    <div class="header5" style="font-size: 18px;">
        Pencarian dengan kata <i><?php echo $_GET['cari'] ?></i>
    </div>
    <div class="header4">
        <?php // echo CHtml::encode($data->subtitle); ?>
    </div>
</div><?php
//echo $_GET['cari'];
foreach ($model as $data) {
//    echo $a->title;
    ?>
    <article class="clearfix">

        <div class="codo_topics_topic_img">
            <a href="http://codologic.com/forum/index.php?u=/category/general-discussion">

            </a>
        </div>
        <div class="codo_topics_topic_content">
            <div class="codo_topics_topic_avatar">

                <img src="<?php echo bt('images/forum.png') ?>" alt="" />

            </div>
            <div class="codo_topics_topic_name">
                <?php echo CHtml::encode($data->starter->member_name); ?>
                <span><span id="posted_txt">posted </span><?php echo ' on ' . date('d M Y', strtotime($data->firstPost->create_time)); ?></span>
            </div>
            <div class="codo_topics_topic_title">
                <?php
                if ($data->sticky == 1) {
                    echo'<u><i class="fa fa-thumb-tack"></i> Sticky</u> :';
                }
                ?>
                <?php echo CHtml::link(CHtml::encode($data->title), array('topic', 'id' => $data->id), array('class' => $data->hasPostedClass())); ?></a>

            </div>                                        

        </div>
        <div class="codo_topics_topic_message">
            <?php
            $post = BbiiPost::model()->findByAttributes(array('topic_id' => $data->id));
            echo implode(" ", array_slice(explode(" ", $post->content), 0, 225));
            ?>


        </div>





        <div class="codo_topics_topic_foot clearfix">

            <div class="codo_topics_no_replies"><span><?php echo$data->num_replies; ?></span>dibalas</div>
            <div class="codo_topics_no_replies" id="codo_topics_no_views"><span><?php echo $data->num_views; ?></span>dilihat</div>
            <div class="codo_topics_last_post">
                balasan terakhir dari <a href=""><?php echo $data->lastPost->poster->member_name; ?></a>
                &nbsp;·&nbsp; <span class="codo_topics_last_post_time"><?php // echo DateTimeCalculation::long($data->lastPost->create_time)  ?></span>
            </div>
        </div>

    </article>
<? } ?>
<div class="pagination-all pagination">
    <?php
//    $this->widget('CLinkPager', array(
//        'header' => '',
//        'firstPageLabel' => '&lt;&lt;',
//        'prevPageLabel' => '&lt;',
//        'nextPageLabel' => '&gt;',
//        'lastPageLabel' => '&lt;&lt;',
//        'pages' => $pages,
//    ));
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