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
</div>