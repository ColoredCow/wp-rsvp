<div class="alert alert-success">
	<h4 class="alert-heading">Update Event Details</h4>
	<button type="button" class="btn btn-outline-danger btn-sm pull-right hide">&times;</button>	
	<form id="event_form">
		<div class="row">
			<div class="form-group col-lg-4 col-md-4 col-sm-12">
				<label for="event_name" class="form-control-label">
					<b>Update Event Title</b>
				</label>
				<input type="text" class="form-control" name="event_name" value="<?php echo $event_name ?>" id="event_name" maxlength="50" required>
			</div>
			<div class="form-group col-lg-4 col-md-4 col-sm-12">				
				<label for="event_theme" class="form-control-label">
					<b>Update Event Theme</b>
				</label>
				<input type="text" class="form-control" name="event_theme" value="<?php echo $event_theme?>" id="event_theme" maxlength="50" required>			
			</div>
			<div class="form-group col-lg-4 col-md-4 col-sm-12">
				<label for="event_venue" class="form-control-label">
					<b>Update Event Venue </b>
				</label>
				<input type="text" class="form-control" name="event_venue" value="<?php echo $event_venue?>" id="event_venue" maxlength="50" required>
			</div>
			<div class="form-group col-lg-5 col-md-4 col-sm-12">	
				<label for="event_address" class="form-control-label">
					<b>Update Event Address </b>
				</label>
				<input type="text" class="form-control" name="event_address" value="<?php echo $event_address ?>" id="event_address" maxlength="250" required>
			</div>
			<div class="form-group col-lg-4 col-md-4 col-sm-12">
				<label for="event_date" class="form-control-label">
					<b>Update Event Date</b>
				</label>
				<input type="date" class="form-control" name="event_date" value="<?php echo $date ?>"  min="<?php echo $date ?>" id="event_date" required>
			</div>
			<div class="form-group col-lg-2 col-md-4 col-sm-12">	
				<label for="event_time" class="form-control-label">
					<b>Update Event time</b>
				</label>
				<input type="time" class="form-control" name="event_time" value="<?php echo $time ?>" id="event_time" required>
			</div>
			<div class="form-group col-lg-4 col-md-4 col-sm-12">		            
				<label for="about_event">
					<b>Update About The Event</b>
				</label>
				<textarea class="form-control" name="event_about" id="event_about" maxlength="1000" rows="4" required><?php echo $event_about ?> </textarea>
			</div>
			<div class="form-group col-lg-6 col-md-4 col-sm-12">
				<label for="event_host" class="form-control-label">
					<b>Update Event Host</b>
				</label>
				<input type="text" class="form-control" name="event_host" value="<?php echo $event_host ?>" id="event_host" maxlength="50" required>
			</div>
		</div>			
		<div class="form-group col-lg-3 col-md-4 col-sm-12">
   			<button type="button" class="btn btn-primary btn-block update_event" id="<?php echo $event_id ?>"> Update Event Details</button>
		</div>
	</form>			
</div>
<hr>
