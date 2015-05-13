<?php if ($model !== null):?>
<table border="1">

	<tr>
		<th width="80px">
		      id		</th>
 		<th width="80px">
		      doc_year		</th>
 		<th width="80px">
		      name		</th>
 		<th width="80px">
		      type		</th>
 		<th width="80px">
		      status_document		</th>
 		<th width="80px">
		      status_check		</th>
 		<th width="80px">
		      barcode		</th>
 	</tr>
	<?php foreach($model as $row): ?>
	<tr>
        		<td>
			<?php echo $row->id; ?>
		</td>
       		<td>
			<?php echo $row->doc_year; ?>
		</td>
       		<td>
			<?php echo $row->name; ?>
		</td>
       		<td>
			<?php echo $row->type; ?>
		</td>
       		<td>
			<?php echo $row->status_document; ?>
		</td>
       		<td>
			<?php echo $row->status_check; ?>
		</td>
       		<td>
			<?php echo $row->barcode; ?>
		</td>
       	</tr>
     <?php endforeach; ?>
</table>
<?php endif; ?>
