<div class="tab-pane" id="game">
    <legend>
        Singapore
    </legend>
    <div class="control-group" style>
        <label class="control-label">Hari</label>
        <div class="controls">
            <?php
            echo CHtml::dropDownList('SiteConfig[settings][game][sgp_day]', (isset($settings->game->sgp_day)) ? $settings->game->sgp_day : '', array('1' => 'Senin', '2' => 'Selasa', '3' => 'Rabu', '4' => 'Kamis', '5' => 'Jumat', '6' => 'Sabtu', '7' => 'Minggu'), array('multiple' => true));
            ?>
        </div>
    </div>
    <div class="control-group" style>
        <label class="control-label">Waktu Mulai</label>
        <div class="controls">
            <?php
            $this->widget(
                    'bootstrap.widgets.TbTimePicker', array(
                'name' => 'SiteConfig[settings][game][sgp_time_start]',
                'value' => (isset($settings->game->sgp_time_start)) ? $settings->game->sgp_time_start : '',
                'options' => array(
                    'showMeridian' => false
                )
                    )
            );
            ?>
        </div>
    </div>
    <div class="control-group" style>
        <label class="control-label">Waktu Berakhir</label>
        <div class="controls">
            <?php
            $this->widget(
                    'bootstrap.widgets.TbTimePicker', array(
                'name' => 'SiteConfig[settings][game][sgp_time_end]',
                'value' => (isset($settings->game->sgp_time_end)) ? $settings->game->sgp_time_end : '',
                'options' => array(
                    'showMeridian' => false
                )
                    )
            );
            ?>
        </div>
    </div>
    <legend>
        Hongkong
    </legend>
    <div class="tab-pane" id="game">
        <div class="control-group" style>
            <label class="control-label">Hari</label>
            <div class="controls">
                <?php
                echo CHtml::dropDownList('SiteConfig[settings][game][hkg_day]', (isset($settings->game->hkg_day)) ? $settings->game->hkg_day : '', array('1' => 'Senin', '2' => 'Selasa', '3' => 'Rabu', '4' => 'Kamis', '5' => 'Jumat', '6' => 'Sabtu', '7' => 'Minggu'), array('multiple' => true));
                ?>
            </div>
        </div>
        <div class="control-group" style>
            <label class="control-label">Waktu Mulai</label>
            <div class="controls">
                <?php
                $this->widget(
                        'bootstrap.widgets.TbTimePicker', array(
                    'name' => 'SiteConfig[settings][game][hkg_time_start]',
                    'value' => (isset($settings->game->hkg_time_start)) ? $settings->game->hkg_time_start : '',
                    'options' => array(
                        'showMeridian' => false
                    )
                        )
                );
                ?>
            </div>
        </div>
        <div class="control-group" style>
            <label class="control-label">Waktu Berakhir</label>
            <div class="controls">
                <?php
                $this->widget(
                        'bootstrap.widgets.TbTimePicker', array(
                    'name' => 'SiteConfig[settings][game][hkg_time_end]',
                    'value' => (isset($settings->game->hkg_time_end)) ? $settings->game->hkg_time_end : '',
                    'options' => array(
                        'showMeridian' => false
                    )
                        )
                );
                ?>
            </div>
        </div>
    </div>   
    <legend>
        Hadiah
    </legend>
    <div class="control-group ">
        <label class="control-label">2D</label>
        <div class="controls">
            <div class="input-prepend">
                <span class="add-on">Rp.</span>
                <?php
                echo CHtml::textField('SiteConfig[settings][game][prize_2d]', (isset($settings->game->prize_2d)) ? $settings->game->prize_2d : '', array('size' => 10, 'maxlength' => 15));
                ?>
            </div>      
            <span class="help-inline">per Rp. 1.000</span>

        </div>        
    </div>
    <div class="control-group ">
        <label class="control-label">3D</label>
        <div class="controls">
            <div class="input-prepend">
                <span class="add-on">Rp.</span>
                <?php
                echo CHtml::textField('SiteConfig[settings][game][prize_3d]', (isset($settings->game->prize_3d)) ? $settings->game->prize_3d : '', array('size' => 10, 'maxlength' => 15));
                ?>
            </div>      
            <span class="help-inline">per Rp. 1.000</span>

        </div>        
    </div>
    <div class="control-group ">
        <label class="control-label">4D</label>
        <div class="controls">
            <div class="input-prepend">
                <span class="add-on">Rp.</span>
                <?php
                echo CHtml::textField('SiteConfig[settings][game][prize_4d]', (isset($settings->game->prize_4d)) ? $settings->game->prize_4d : '', array('size' => 10, 'maxlength' => 15));
                ?>
            </div> 
            <span class="help-inline">per Rp. 1.000</span>

        </div>        
    </div>
    <div class="control-group ">
        <label class="control-label">Colok Jitu</label>
        <div class="controls">
            <div class="input-prepend">
                <span class="add-on">Rp.</span>
                <?php
                echo CHtml::textField('SiteConfig[settings][game][prize_cj]', (isset($settings->game->prize_cj)) ? $settings->game->prize_cj : '', array('size' => 10, 'maxlength' => 15));
                ?>
            </div>
            <span class="help-inline">per Rp. 10.000</span>
        </div>        
    </div>
    <div class="control-group ">
        <label class="control-label">Colok Raun</label>
        <div class="controls">
            <div class="input-prepend">
                <span class="add-on">Rp.</span>
                <?php
                echo CHtml::textField('SiteConfig[settings][game][prize_cr]', (isset($settings->game->prize_cr)) ? $settings->game->prize_cr : '', array('size' => 10, 'maxlength' => 15));
                ?>
            </div> 
            <span class="help-inline">per Rp. 10.000</span>
        </div>        
    </div>
    <legend>
        Potongan
    </legend>

    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Grup/Permainan</th>
                <th>2D</th>
                <th>3D</th>
                <th>4D</th>
                <th>Colok Jitu</th>
                <th>Colok Raun</th>
            </tr>
        </thead>
        <?php
        $listRoles = Roles::model()->listRoles();
        foreach ($listRoles as $val) {
            echo '<tr>
                    <td>' . $val->name . '</td>
                    <td>
                        <div class="input-append">' .
                        CHtml::textField('SiteConfig[settings][game]['.$val->id.'][discount_2d]', (isset($settings->game->{$val->id}->discount_2d)) ? $settings->game->{$val->id}->discount_2d : '', array('size' => 3, 'maxlength' => 3, 'style' => 'width:25px'))
                        . '<span class="add-on">%</span>
                        </div>
                    </td>
                    <td>
                        <div class="input-append">' .
                        CHtml::textField('SiteConfig[settings][game]['.$val->id.'][discount_3d]', (isset($settings->game->{$val->id}->discount_3d)) ? $settings->game->{$val->id}->discount_3d : '', array('size' => 3, 'maxlength' => 3, 'style' => 'width:25px'))
                        . '<span class="add-on">%</span>
                        </div>
                    </td>
                    <td>
                        <div class="input-append">' .
                        CHtml::textField('SiteConfig[settings][game]['.$val->id.'][discount_4d]', (isset($settings->game->{$val->id}->discount_4d)) ? $settings->game->{$val->id}->discount_4d : '', array('size' => 3, 'maxlength' => 3, 'style' => 'width:25px'))
                        . '<span class="add-on">%</span>
                        </div>
                    </td>
                    <td>
                        <div class="input-append">' .
                        CHtml::textField('SiteConfig[settings][game]['.$val->id.'][discount_cr]', (isset($settings->game->{$val->id}->discount_cr)) ? $settings->game->{$val->id}->discount_cr : '', array('size' => 3, 'maxlength' => 3, 'style' => 'width:25px'))
                        . '<span class="add-on">%</span>
                        </div>
                    </td>
                    <td>
                        <div class="input-append">' .
                        CHtml::textField('SiteConfig[settings][game]['.$val->id.'][discount_cj]', (isset($settings->game->{$val->id}->discount_cj)) ? $settings->game->{$val->id}->discount_cj : '', array('size' => 3, 'maxlength' => 3, 'style' => 'width:25px'))
                        . '<span class="add-on">%</span>
                        </div>
                    </td>
                 </tr>';
        }
        ?>
    </table>
</div>   
