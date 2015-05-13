<div class="control-group cc" style>
    <label class="control-label">Roles</label>
    <div class="controls">
        <?php
        echo CHtml::dropDownList('Menu[param][rolesId]', 'Menu[param][rolesId]', CHtml::listData(Roles::model()->findAll(),'id','name') );
        ?>
    </div>
    
</div>