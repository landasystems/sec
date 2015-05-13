<div class="control-group ">
    <label class="control-label">Province/City show or hide</label>
    <div class="controls">
        <?php echo $form->toggleButtonRow($model, 'param[contactAddress]', array('label' => true)); ?>
    </div>
</div>
<div class="control-group ">
    <label class="control-label">Prepend Text</label>
    <div class="controls">
        <?php echo $form->html5EditorRow($model, 'param[prependText]', array('class'=>'span4', 'rows'=>5, 'height'=>'200', 'label' => false,'options'=>array('color'=>true))); ?>
        
    </div>
</div>


