<div class="form">
    <?php
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'weblink-form',
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

        <table>
            <tr>
                <td>
                    <?php
                    $cc = '';
                    if ($model->isNewRecord) {
                        $img = Yii::app()->landa->urlImg('', '', '');
                    } else {
                        $img = Yii::app()->landa->urlImg('weblink/', $model->image, $_GET['id']);
                        $del = '<div class="btn-group photo-det-btn">';
                        $imgs = param('urlImg') . '350x350-noimage.jpg';
                        $cc = CHtml::ajaxLink(
                                        '<i class="icon-trash">Remove Photo</i>', url('weblink/removephoto', array('id' => $model->id)), array(
                                    'type' => 'POST',
                                    'success' => 'function( data )
                                                    {
                                                           $("#my_image").attr("src","' . $imgs . '");
                                                           $("#yt0").fadeOut();
                                                    }'), array('class' => 'btn btn-large btn-block btn-primary', 'style' => 'width: 360px;font-size: 15px;')
                                )
                                . '</div>';
                    }
                    echo '<img src="' . $img['medium'] . '" alt="" class="image img-polaroid" id="my_image" style="width:350px;height:360px"  /> ';
                    echo $cc;
                    ?>
                    <?php echo $form->fileFieldRow($model, 'image', array('class' => 'span3')); ?>
                </td>
                <td>
                    <?php echo $form->textFieldRow($model, 'name', array('class' => 'span4', 'maxlength' => 45)); ?>

                    
                    <?php
                    echo $form->textFieldRow(
                            $model, 'link', array('prepend' => 'Http://')
                    );
                    ?>
                </td>
            </tr>

        </table>








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
