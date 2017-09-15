<table>
	<thead>
		<tr class="hover-background">
			<th><?php echo $serial_number++ ?></th>
			<th><?php echo $event_name ?></th>
			<th><?php echo $event_theme ?></th>
			<th><?php echo $event_venue ?></th>
			<th><?php echo $modify_date ?></th>
			<th><button type="button" class="btn btn-outline-info btn-sm edit-event" id="<?php echo $event_id ?>">Update</button>&nbsp;
			<button type="button" class="btn btn-outline-danger btn-sm delete-event" id="<?php echo $event_id ?>">Delete</button></th>			
		</tr> 
	</thead> 
</table>
