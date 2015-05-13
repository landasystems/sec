<style>
    .sub-header {
background: #ebebeb;
margin: 0 0 10px;
padding: 5px 10px;
position: relative;
display: block;
border-left: 5px solid #1998ed;
}

</style>
<span class="sub-header"> <strong>My Posts</strong> </span>
<?php
                        $this->widget('zii.widgets.CListView', array(
                            'dataProvider' => $dataProvider,
                            'itemView' => '_post',
                            'summaryText' => false,
                        ));
                        
                        ?>
