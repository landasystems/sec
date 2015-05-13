<div class="control-group ">
    <label class="control-label">Kategori Artikel</label>
    <div class="controls">
        <?php
        echo CHtml::dropDownList('Menu[param][article_category_id]', 'Menu[param][article_category_id]', CHtml::listData(ArticleCategory::model()->findAll(),'id','name') );
        ?>
    </div>
    
</div>

