<div class="form">
    <?php
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'Article-form',
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


        <?php echo $form->textFieldRow($model, 'title', array('class' => 'span5', 'maxlength' => 100)); ?>

        <?php echo $form->dropDownListRow($model, 'article_category_id', CHtml::listData(ArticleCategory::model()->findAll(array('order' => 'root, lft')), 'id', 'nestedname'), array('class' => 'span3', 'empty' => 'root')); ?>
        <?php echo $form->toggleButtonRow($model, 'publish'); ?>

        <?php echo $form->ckEditorRow($model, 'content', array('options' => array('fullpage' => 'js:true', 'filebrowserBrowseUrl' => $this->createUrl("fileManager/indexBlank")))); ?>
        <div class="control-group "><label class="control-label" for="Article_description">Keyword</label>
            <div class="controls">
                <?php
                $this->widget('bootstrap.widgets.TbSelect2', array(
                    'asDropDownList' => false,
                    'name' => 'Article[keyword]',
                    'value' => $model->keyword,
                    'options' => array(
                        'tags' => array(),
                        'placeholder' => 'Tag : nasi, bubur',
                        'width' => '50%',
                        'height' => '20%',
                        'tokenSeparators' => array(', ', ' ')
                    )
                ));
                ?>
            </div></div>
        <?php
        echo $form->textAreaRow(
                $model, 'description', array(
            'class' => 'span4',
            'rows' => 5,
            'height' => '200',
                )
        );
        ?>


        <?php echo $form->fileFieldRow($model, 'primary_image', array('class' => 'span5')); ?>


        <div class="form-actions">
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
    </fieldset>

    <?php $this->endWidget(); ?>

</div>
