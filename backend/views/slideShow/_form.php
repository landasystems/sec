<style>
#imagePreview {
    width: 100%;
    height: 300px;
    background-position: center center;
    background-size: cover;
    -webkit-box-shadow: 0 0 1px 1px rgba(0, 0, 0, .3);
    display: inline-block;
}
</style>
<div class="form">
    <?php
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'slide-show-form',
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
            <p class="note">Fields dengan <span class="required">*</span> harus di isi.</p>
        </legend>

        <?php echo $form->errorSummary($model, 'Opps!!!', null, array('class' => 'alert alert-error span12')); ?>




        <?php echo $form->textFieldRow($model, 'title', array( 'class' => 'span6')); ?>

        <?php echo $form->textAreaRow($model, 'description', array('rows' => 6, 'cols' => 50, 'class' => 'span8')); ?>

       
        

         <?php // echo $form->toggleButtonRow($model, 'status'); ?>
        

        <div class="control-group ">
            <label class="control-label">Artikel</label>
            <div class="controls">
                <?php
                $this->widget('bootstrap.widgets.TbSelect2', array(
                    'asDropDownList' => TRUE,
                    'data' => CHtml::listData(Article::model()->findAll(), 'id', 'titleCat'),
                    'name' => 'SlideShow[article_id]',
                    'value' => (isset($model->article_id)) ? $model->article_id : '',
                    'options' => array(
                        'placeholder' => yii::t('global', 'choose'),
                        'width' => '60%',
                        'tokenSeparators' => array(',', ' ')
                )));
                ?>

            </div>
        </div>
       
<?php echo $form->fileFieldRow($model, 'image', array('class' => 'span3')); ?>
          <?php
     if(isset($model->image)){
         echo'
             <style>
             #imagePreview {
             background-image:url('.param('urlImg'). 'slider/'.$model->image.');
                 }
             </style>
             ';
     }
     ?>
 <div id="imagePreview">
   
 </div>

        <?php if (!isset($_GET['v'])) { ?>        <div class="form-actions">
                <?php
                $this->widget('bootstrap.widgets.TbButton', array(
                    'buttonType' => 'submit',
                    'type' => 'primary',
                    'icon' => 'ok white',
                    'label' => $model->isNewRecord ? 'Tambah' : 'Simpan',
                ));
                ?>
                <?php
                $this->widget('bootstrap.widgets.TbButton', array(
                    'buttonType' => 'reset',
                    'icon' => 'remove',
                    'label' => 'Reset',
                ));
                ?>
            </div>
        <?php } ?>    </fieldset>

    <?php $this->endWidget(); ?>

</div>

<script type="text/javascript">
$(function() {
    $("#SlideShow_image").on("change", function()
    {
        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support
 
        if (/^image/.test( files[0].type)){ // only image file
            var reader = new FileReader(); // instance of the FileReader
            reader.readAsDataURL(files[0]); // read the local file
 
            reader.onloadend = function(){ // set image data as background of div
                $("#imagePreview").css("background-image", "url("+this.result+")");
            }
        }
    });
});
</script>