<?php
/* @var $this SettingController */
/* @var $forumdata BbiiForum (forum) */
?>

<table style="margin:0px;">
    <tbody class="forum">
        <tr>
            <td class="name">
                <strong><?php echo CHtml::encode($forumdata->name); ?></strong><br>
                <?php echo $forumdata->subtitle; ?>
            </td>
            <td rowspan="2" style="width:140px;">
                <?php
//                echo CHtml::button('<i class="brocco-icon-trashcan"></i> Edit', array(
//                    'class'=>'btn-primary',
//                    'submit' => array('bbiiForum/update', array('id' => $forumdata->id)),
//                    'confirm' => 'Are you sure?'
//                        // or you can use 'params'=>array('id'=>$id)
//                        )
//                );
                ?>

                <?php echo CHtml::link('<i class="brocco-icon-pencil"></i>', array('bbiiForum/update', 'id' => $forumdata->id)); ?> | 
                <?php echo CHtml::link('<i class="brocco-icon-trashcan"></i>', array('bbiiForum/del', 'id' => $forumdata->id)); ?><br>
                
            </td>

        </tr>


    </tbody>
</table>