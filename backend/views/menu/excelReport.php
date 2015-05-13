<?php if ($model !== null):?>
<table border="1">

	<tr>
		<th width="80px">
		      id		</th>
 		<th width="80px">
		      name		</th>
 		<th width="80px">
		      ordering		</th>
 		<th width="80px">
		      access		</th>
 		<th width="80px">
		      lft		</th>
 		<th width="80px">
		      rgt		</th>
 		<th width="80px">
		      root		</th>
 		<th width="80px">
		      link		</th>
 		<th width="80px">
		      type		</th>
 	</tr>
	<?php foreach($model as $row): ?>
	<tr>
        		<td>
			<?php echo $row->id; ?>
		</td>
       		<td>
			<?php echo $row->name; ?>
		</td>
       		<td>
			<?php echo $row->ordering; ?>
		</td>
       		<td>
			<?php echo $row->access; ?>
		</td>
       		<td>
			<?php echo $row->lft; ?>
		</td>
       		<td>
			<?php echo $row->rgt; ?>
		</td>
       		<td>
			<?php echo $row->root; ?>
		</td>
       		<td>
			<?php echo $row->link; ?>
		</td>
       		<td>
			<?php echo $row->type; ?>
		</td>
       	</tr>
     <?php endforeach; ?>
</table>
<?php endif; ?>
