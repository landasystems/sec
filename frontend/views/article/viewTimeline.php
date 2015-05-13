<?php
$this->pageTitle = $_GET['title'];
$this->breadcrumbs = array(
    $_GET['title']
);
?>

<div id="tline-content">
    <?php
    $month = 0;
    foreach ($model as $no => $arrArticle) {
        $position = ($no % 2) ? 'r' : 'l';
        if ($month != date('m', strtotime($arrArticle->created))) {
            echo '<div class="vertical-space1"></div>
                  <div class="tline-topdate">' . date('F Y', strtotime($arrArticle->created)) . '</div>';
            $month = date('m', strtotime($arrArticle->created));
        }
        ?>

        <article  class="tline-box <?php echo ($position == 'r') ? 'rgtline' : '' ?>">
            <span class="tline-row-<?php echo $position ?>"></span>
            <img src="<?php echo $arrArticle->img['medium'] ?>" alt=""><br>
    <!--            <h6 class="blog-cat"><strong>in</strong> Business, News, Company </h6>-->
            <h4><a href="<?php echo $arrArticle->url ?>" > <?php echo $arrArticle->title ?></a></h4>
    <!--            <h6 class="blog-author"><strong>by</strong> John Smith </h6>-->
            <p class="tline-content">
                <?php echo $arrArticle->introText(410) ?>
                <a href="<?php echo $arrArticle->url ?>" class="btn btn-primary">Read more</a>
            </p>
            <div class="blog-date-sp">
                <h3><?php echo date('d', strtotime($arrArticle->created)) ?></h3><span><?php echo date('F', strtotime($arrArticle->created)) ?><br>
                    <?php echo date('Y', strtotime($arrArticle->created)) ?></span></div>
            <div class="blog-com-sp">
                <?php echo $arrArticle->hits ?> Hits</div>

        </article>

    <?php } ?>

</div><!-- end-pin-content -->


<div class="vertical-space2"></div>
