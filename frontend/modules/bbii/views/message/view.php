<?php
/* @var $this MessageController */
/* @var $model BbiiMessage */
?>
<style>
    .form-horizontal .control-group {
    margin-bottom: 0px;
    }
    group:after {
    clear: none;
}
</style>

<div class='row-fluid well asu' >
    <a href="<?php echo url('forum/message/reply', array('id'=>$model->id)) ?>" class="btn btn-warning" type="submit"><i class="icon-share-alt"></i> Balas</a><br>
    <div style='background-color: #c9e0ed;padding: 10px;'>
       
        <form class="form-horizontal" style='margin-bottom: 0px;'>
            <div class="control-group">
                <label class="control-label" style='text-align: left; font-weight: bold'><b>Dari</b></label>
                <div class="controls" style='padding-top: 5px;'>
                    <?php echo CHtml::encode($model->sender->member_name); ?>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" style='text-align: left; font-weight: bold'><b>Kepada</b></label>
                <div class="controls" style='padding-top: 5px;'>
                    <?php echo CHtml::encode($model->receiver->member_name); ?>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" style='text-align: left; font-weight: bold'><b>Judul</b></label>
                <div class="controls" style='padding-top: 5px;'>
                    <?php echo CHtml::encode($model->subject); ?>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" style='text-align: left; font-weight: bold'><b>Tanggak Kirim</b></label>
                <div class="controls" style='padding-top: 5px;'>
                    <?php echo DateTimeCalculation::full($model->create_time); ?>
                </div>
            </div>
        </form>
    </div>
    <div style="background-color: white;padding: 10px;">
        <?php echo $model->content; ?>
    </div>
</div>
