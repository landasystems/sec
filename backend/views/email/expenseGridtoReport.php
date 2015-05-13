<?php if ($model !== null):?>
<table border="1">

	<tr>
		<th width="80px">
		      id		</th>
 		<th width="80px">
		      email_from		</th>
 		<th width="80px">
		      email_to		</th>
 		<th width="80px">
		      title		</th>
 		<th width="80px">
		      content		</th>
 		<th width="80px">
		      is_send		</th>
 		<th width="80px">
		      client		</th>
 		<th width="80px">
		      created		</th>
 		<th width="80px">
		      created_user_name		</th>
 		<th width="80px">
		      modified		</th>
 	</tr>
	<?php foreach($model as $row): ?>
	<tr>
        		<td>
			<?php echo $row->id; ?>
		</td>
       		<td>
			<?php echo $row->email_from; ?>
		</td>
       		<td>
			<?php echo $row->email_to; ?>
		</td>
       		<td>
			<?php echo $row->title; ?>
		</td>
       		<td>
			<?php echo $row->content; ?>
		</td>
       		<td>
			<?php echo $row->is_send; ?>
		</td>
       		<td>
			<?php echo $row->client; ?>
		</td>
       		<td>
			<?php echo $row->created; ?>
		</td>
       		<td>
			<?php echo $row->created_user_name; ?>
		</td>
       		<td>
			<?php echo $row->modified; ?>
		</td>
       	</tr>
     <?php endforeach; ?>
</table>
<?php endif; ?>
