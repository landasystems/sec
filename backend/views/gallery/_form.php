<div class="form">
    <?php
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'gallery-form',
        'enableAjaxValidation' => false,
        'method' => 'post',
        'type' => 'horizontal',
        'htmlOptions' => array(
            'enctype' => 'multipart/form-data'
        )
    ));
    ?>
    <fieldset>
        <legend>

        </legend>

        <?php echo $form->errorSummary($model, 'Opps!!!', null, array('class' => 'alert alert-error span12')); ?>


        <div>
            <ul class="thumbnails product-list-img">
                <?php 
                foreach ($modelGallery as $oGallery) {
                    echo '<li class="span2 product-list-img-item" id="elm' . $oGallery->id . '">
                            
                            <a href="#" class="thumbnail">
                              <img src="' . $oGallery->img['small'] . '">
                              <div class="caption">' . $oGallery->description . '</div>
                            </a>
                            <div class="btn-group photo-det-btn">';

                    $this->widget('bootstrap.widgets.TbButton', array(
                        'label' => '<i class="icon-tags"></i>',
                        'encodeLabel' => false,
                        'htmlOptions' => array(
                            'style' => 'margin-left:3px',
                            'onclick' => 'js:bootbox.prompt("Name new description for this photo ",
			function(result){
                            if (result){
                                $.ajax({
                                    url:"' . url('gallery/updateDesc/' . $oGallery->id) . '",
                                    data:"desc="+result,
                                    type:"POST",
                                    success:function(result2){
                                        $("#elm' . $oGallery->id . ' .caption").html(result);
                                    }
                                });
                            }
                        })',
                        ),
                    ));

echo CHtml::ajaxLink(
                                        '<i class="brocco-icon-bookmark-2"></i>', url('galleryCategory/defaultPhoto', array('id' => $oGallery->gallery_category_id, 'gallery_id' => $oGallery->id,'image'=>$oGallery->image)), array(
                                    'type' => 'POST',
                                    'success' => 'function( data )
                                                    {
                                                      $("#elm' . $oGallery->id . '").css("border", "solid 4px cadetblue");
                                                    }'), array('class' => 'btn')
                                );
                    echo CHtml::ajaxLink(
                            '<i class="icon-trash"></i>', url('gallery/delete', array('id' => $oGallery->id)), array(
                        'type' => 'POST',
                        'success' => 'function( data )
                                                    {
                                                      $("#elm' . $oGallery->id . '").fadeOut();
                                                    }'), array('class' => 'btn')
                    )
                    . '</div>  
                          </li>';
                }
                ?>
            
            </ul>
        </div>

        <hr/>

        <div class="control-group">		
            <label class="control-label">Foto</label>
            <div class="controls">
                <?php
                $this->widget('common.extensions.EAjaxUpload.EAjaxUpload', array(
                    'id' => 'primary_image',
                    'config' => array(
                        'action' => Yii::app()->createUrl('Gallery/upload/' . $model->gallery_category_id),
                        'allowedExtensions' => array("jpg", "jpeg", "gif", "png", "gif"), //array("jpg","jpeg","gif","exe","mov" and etc...
                        'sizeLimit' => 2 * 1024 * 1024, // maximum file size in bytes
                        'minSizeLimit' => 10 * 10 * 10, // minimum file size in bytes
                        'multiple' => false,
                    //'onComplete'=>"js:function(id, fileName, responseJSON){ alert(fileName  ); }",
                    //'messages'=>array(
                    //                  'typeError'=>"{file} has invalid extension. Only {extensions} are allowed.",
                    //                  'sizeError'=>"{file} is too large, maximum file size is {sizeLimit}.",
                    //                  'minSizeError'=>"{file} is too small, minimum file size is {minSizeLimit}.",
                    //                  'emptyError'=>"{file} is empty, please select files again without it.",
                    //                  'onLeave'=>"The files are being uploaded, if you leave now the upload will be cancelled."
                    //                 ),
                    //'showMessage'=>"js:function(message){ alert(message); }"
                    ),
                ));
                ?>

                <br/>
                <div class="well">
                    <ul>
                        <li>Untuk melakukan multiple upload file, drag foto secara bersamaan ke dalam area tombol Upload</li>
                        <li>Extensi yang diperbolehkan adalah <span class="label label-info">jpg, jpeg, gif, png, gif</span></li>
                        <li>Thumbnail foto akan dicreate secara otomatis oleh systems</li>
                    </ul>
                </div>

            </div>   
        </div>


    </fieldset>

    <?php $this->endWidget(); ?>

    <br/>


</div>
