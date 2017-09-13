<select name="status" id="status" class="form-control form-control-sm col-lg-2">
	<option disabled="" selected="">Select your event</option>';
		<?php
			foreach ( $result as $page ){		
				$event_id = $page->event_id;
				$event_name = $page->event_name;
		?>
	<option value="<?php echo $event_id ?>"><?php echo $event_name ?></option>							
		<?php	
			} 
		?>

</select>
