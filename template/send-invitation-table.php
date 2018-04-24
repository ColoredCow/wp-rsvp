<table class="header-table">
	<thead>  
		<tr>
			<th><input type="checkbox" id="check_all_guest">S.No</th>  
			<th>Name</th>
			<th>Email</th>
			<th>Gender</th>
			<th>Action</th>
		</tr> 
	</thead> 
</table>
<?php 		
	foreach ( $result as $page ){
		$guest_id = $page->guest_id;
		$guest_name = $page->guest_name;
		$guest_email = $page->guest_email;
		$guest_gender = $page->guest_gender;	
		$email = $page->email_status;	
?>				
		<table>
			<thead>  
				<tr class="hover-background"> 
					<th><input type="checkbox" value="<?php echo $guest_id ?>" class="guest-checkbox checkBoxClass chk">
					<?php echo $serial_number++ ?></th> 
					<th><?php echo $guest_name ?></th>
					<th><?php echo $guest_email ?></th>
					<th><?php echo $guest_gender ?></th>
					<th><button type="button" class="btn btn-outline-primary btn-sm send-email <?php echo $email ?>" value="<?php echo $current_event_id ?>" id="<?php echo $guest_id ?>">Send Invitation</button></th>
				</tr> 
			</thead> 
		</table>
<?php
	}
?>					