<div class="form">

    <fieldset>


        <?php // echo $form->errorSummary($model, 'Opps!!!', null, array('class' => 'alert alert-error span12')); ?>
        <?php
        foreach (Yii::app()->user->getFlashes() as $key => $message) {
            echo '<div class="alert alert-' . $key . '">' . $message . '</div>';
        }
        ?>
        <?php
        $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
            'id' => 'ws-finish-form',
            'enableAjaxValidation' => false,
            'method' => 'post',
            'type' => 'horizontal',
            'action' => url('download/publish'),
            'htmlOptions' => array(
                'enctype' => 'multipart/form-data',
                'class' => 'table table-striped'
            )
        ));
        ?>
        <button type="submit" name="delete" value="dd" style="margin-left: 10px" class="btn btn-danger pull-right"><span class="icon16 brocco-icon-trashcan white"></span> Delete</button>
        <button type="submit" name="buttonpublish" value="dd" style="margin-left: 10px" class="btn btn-info pull-right"><span class="icon16 entypo-icon-publish white"></span> Publish </button> 
        <button type="submit" name="buttonunpublish" value="dd"  class="btn btn-warning pull-right"><span class="icon16 entypo-icon-close white"></span> Unpublish</button>

        <input type="hidden" name="id_download" value="<?php echo $_GET['id'] ?>"
        <?php
        $this->widget('bootstrap.widgets.TbGridView', array(
            'id' => 'download-grid',
            'dataProvider' => $model->search(),
            'type' => 'striped bordered condensed',
            'template' => '{summary}{pager}{items}{pager}',
            'columns' => array(
                array(
                    'class' => 'CCheckBoxColumn',
                    'headerTemplate' => '{item}',
                    'selectableRows' => 2,
                    'checkBoxHtmlOptions' => array(
                        'name' => 'id[]',
                    ),
                ),
                'id',
                'DownloadCategory.name',
                array(
                    'name' => 'File Name',
                    'value' => '$data->url',
                    'htmlOptions' => array('style' => 'text-align: left;')
                ),
                array(
                    'name' => 'publish',
                    'header' => 'Status',
                    'value' => '$data->publishdata',
                    'htmlOptions' => array('style' => 'text-align: left;')
                ),
                'created',
                array(
                    'class' => 'bootstrap.widgets.TbButtonColumn',
                    'template' => '{download}',
                    'buttons' => array(
                        'download' => array(
                            'label' => 'Publish',
                            'icon' => 'cut-icon-download',
                            'url' => ' $data->urlFull ',
                            'options' => array(
                                'class' => 'btn btn-small publish'
                            )
                        ),
                        'update' => array(
                            'label' => 'Edit',
                            'options' => array(
                                'class' => 'btn btn-small update'
                            )
                        ),
                        'delete' => array(
                            'label' => 'Hapus',
                            'url' => 'Yii::app()->createUrl("download/delete", array("id"=>$data->id))',
                            'options' => array(
                                'class' => 'btn btn-small delete'
                            )
                        )
                    ),
                    'htmlOptions' => array('style' => 'width: 125px'),
                )
            ),
        ));
        ?>          

               <?php $this->endWidget(); ?>

        <script>
<?php
echo '$(".publish").click(function(){
                    var postData = "id=" + $(this).attr("id") ;
                    $.ajax({
                        url:"' . url("download/publish") . '",
                        data:postData,
                        type:"post",
                        success:function(data){
                            if(data==1){
                            var user = "' . user()->name . '";
                            $("id").attr("class","label label-info");
                            }else{
                            }
                        }
                    });
                });';
?>
        </script>
        <?php //echo $form->textFieldRow($model, 'name', array('class' => 'span3', 'maxlength' => 255));    ?>


        <?php //echo $form->dropDownListRow($model, 'download_category_id', CHtml::listData(DownloadCategory::model()->findAll(array('order' => 'root, lft')),arr 'id', 'nestedname'), array('class' => 'span3', 'empty' => 'root'));    ?>

        <?php
        $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
            'id' => 'download-form',
            'enableAjaxValidation' => false,
            'method' => 'post',
            'type' => 'horizontal',
            'htmlOptions' => array(
                'enctype' => 'multipart/form-data'
            )
        ));
        ?>
        <div class="control-group">		
            <label class="control-label">Document</label>
            <div class="controls">
                <?php
                $this->widget('common.extensions.EAjaxUpload.EAjaxUpload', array(
                    'id' => 'url',
                    'config' => array(
                        'action' => Yii::app()->createUrl('download/upload/' . $model->download_category_id),
                        'allowedExtensions' => array("zip", "rar", "doc", "docx", "pdf", "ppt"), //array("jpg","jpeg","gif","exe","mov" and etc...
                        'sizeLimit' => 7 * 1024 * 1024, // maximum file size in bytes
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
                <?php /* echo $form->textFieldRow($model,'url',array('class'=>'span5','maxlength'=>255)); ?>

                  <?php echo $form->textFieldRow($model,'public',array('class'=>'span5')); ?>

                  <?php echo $form->textFieldRow($model,'created',array('class'=>'span5')); ?>

                  <?php echo $form->textFieldRow($model,'created_user_id',array('class'=>'span5')); ?>

                  <?php echo $form->textFieldRow($model,'modified',array('class'=>'span5')); */ ?>



                <div class="">
                    <?php /* $this->widget('bootstrap.widgets.TbButton', array(
                      'buttonType'=>'submit',
                      'type'=>'primary',
                      'icon'=>'ok white',
                      'label'=>$model->isNewRecord ? 'Tambah' : 'Simpan',
                      )); ?>
                      <?php $this->widget('bootstrap.widgets.TbButton', array(
                      'buttonType'=>'reset',
                      'icon'=>'remove',
                      'label'=>'Reset',
                      )); */ ?>
                </div>
                <br/>
                <div class="well">
                    <ul>
                        <li>Untuk melakukan multiple upload file, drag foto secara bersamaan ke dalam area tombol Upload</li>
                        <li>Extensi yang diperbolehkan adalah <span class="label label-info">zip, rar, doc,ppt, pdf</span></li>
                        <li>Thumbnail foto akan dicreate secara otomatis oleh systems</li>
                    </ul>
                </div>
                </fieldset>

                <?php $this->endWidget(); ?>

            </div>
