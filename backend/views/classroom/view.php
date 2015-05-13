<?php
$this->setPageTitle('Lihat Classrooms | ID : ' . $model->id);
$this->breadcrumbs = array(
    'Classrooms' => array('index'),
    $model->name,
);
?>

<?php
$this->beginWidget('zii.widgets.CPortlet', array(
    'htmlOptions' => array(
        'class' => ''
    )
));
$this->widget('bootstrap.widgets.TbMenu', array(
    'type' => 'pills',
    'items' => array(
        array('label' => 'Tambah', 'icon' => 'icon-plus', 'url' => Yii::app()->controller->createUrl('create'), 'linkOptions' => array(), 'visible' => landa()->checkAccess('Classroom', 'c')),
        array('label' => 'Daftar', 'icon' => 'icon-th-list', 'url' => Yii::app()->controller->createUrl('index'), 'linkOptions' => array()),
        array('label' => 'Edit', 'icon' => 'icon-edit', 'url' => Yii::app()->controller->createUrl('update', array('id' => $model->id)), 'linkOptions' => array(), 'visible' => landa()->checkAccess('Classroom', 'u')),
        array('label' => 'Pencarian', 'icon' => 'icon-search', 'url' => '#', 'linkOptions' => array('class' => 'search-button')),
        array('label' => 'Print', 'icon' => 'icon-print', 'url' => 'javascript:void(0);return false', 'linkOptions' => array('onclick' => 'printDiv();return false;')),
)));
$this->endWidget();
$this->breadcrumbs = array(
    'Classrooms' => array('index'),
    $model->name,
);
?>
<div class='printableArea'>
    <?php
    echo '<div class="page-header">
  <h1>Kelas :'.$model->name.' </h1>
</div>';
    ?>
    


    <table class="table table-hover">
        <thead>
            <tr>
                <th>No</th>
                <th>NIS</th>
                <th>Nama</th>
                <th>ALamat</th>
                <th>No Telpon</th>
            <tr>
        </thead>
        <tbody>
            <?php
            $no=0;
            $userclass = UserClassroom::model()->findAll(array('condition' => 'classroom_id=' . $_GET['id']));
            foreach ($userclass as $a) {
                $no++;
                $code = (isset($a->User->code)) ? $a->User->code : '-';
                $name = (isset($a->User->name)) ? $a->User->name : '-';
                $address = (isset($a->User->address)) ? $a->User->address : '-';
                $phone = (isset($a->User->phone)) ? $a->User->phone : '-';
                echo'<tr>
                     <td>'.$no.'</td>
                    <td>'.$code.'</td>
                    <td><a href="'.Yii::app()->createUrl("user/$a->user_id").'">'.$name.'</a></td>
                    <td>'.$address.'</td>
                    <td>'.$phone.'</td>
                    </tr>';
            }
            ?>

        </tbody>
    </table>
</div>
<style type="text/css" media="print">
    body {visibility:hidden;}
    .printableArea{visibility:visible;} 
</style>
<script type="text/javascript">
    function printDiv()
    {

        window.print();

    }
</script>
<?php
$model->name;
?>
