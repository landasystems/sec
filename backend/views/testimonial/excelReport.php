<?php if ($model !== null):?>
<table border="1">

	<tr>
		<th width="80px">
		      id		</th>
 		<th width="80px">
		      name		</th>
 		<th width="80px">
		      email		</th>
 		<th width="80px">
		      img_avatar		</th>
 		<th width="80px">
		      testimonial		</th>
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
			<?php echo $row->email; ?>
		</td>
       		<td>
			<?php echo $row->img_avatar; ?>
		</td>
       		<td>
			<?php echo $row->testimonial; ?>
		</td>
       	</tr>
     <?php endforeach; ?>
</table>
<?php endif; ?>
