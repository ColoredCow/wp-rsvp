<div class="col-lg-12 col-md-4 col-sm-12">			
	<div class="heading">	
		Add New Event
	</div>
	<p id="successfull_event_message"></p>  
	<hr>
</div>
<div class="container-fluid">
	<form id="add_event_form">
		<div class="row">
			<div class="form-group col-lg-4 col-md-4 col-sm-12">
				<div class="">
					<label for="event_name" class="form-control-label">
						<b>Event Title</b>
					</label>
					<input type="text" class="form-control" placeholder="Event title*" name="event_name" id="event_name" maxlength="50" required>
				</div>
			</div>
			<div class="form-group col-lg-4 col-md-4 col-sm-12">				
				<label for="event_theme" class="form-control-label">
					<b>Event Theme</b>
				</label>
				<input type="text" class="form-control" placeholder="Event theme*" name="event_theme" id="event_theme" maxlength="50" required>			
			</div>
			<div class="form-group col-lg-4 col-md-4 col-sm-12">
				<label for="event_venue" class="form-control-label">
					<b>Event Venue </b>
				</label>
				<input type="text" class="form-control" placeholder="Event venue*" name="event_venue" id="event_venue" maxlength="50" required>
			</div>
			<div class="form-group col-lg-5 col-md-4 col-sm-12">	
				<label for="event_address" class="form-control-label">
					<b>Event Address </b>
				</label>
				<input type="text" class="form-control" placeholder="Event address*" name="event_address" id="event_address" maxlength="250" required>
			</div>
			<div class="form-group col-lg-4 col-md-4 col-sm-12">
				<label for="event_date" class="form-control-label">
					<b>Event Date</b>
				</label>
				<input type="date" class="form-control" placeholder="Event date*" name="event_date" min='<?php echo date('Y-m-d'); ?>' id="event_date" required>
			</div>
			<div class="form-group col-lg-2 col-md-4 col-sm-12">	
				<label for="event_time" class="form-control-label">
					<b>Event time</b>
				</label>
				<input type="time" class="form-control" placeholder="Event time*" name="event_time" id="event_time" required>
			</div>
          	<div class="form-group col-lg-4 col-md-4 col-sm-12">		            
             	<label for="about_event">
             		<b>About The Event</b>
             	</label>
        		<textarea class="form-control" placeholder="Limit 1000 words*" name="event_about" id="event_about" maxlength="1000" rows="4" required></textarea>
            </div>
            <div class="form-group col-lg-4 col-md-4 col-sm-12">
				<label for="event_host" class="form-control-label">
					<b>Event Host</b>
				</label>
				<input type="text" class="form-control" placeholder="Event host*" name="event_host" id="event_host" maxlength="50" required>
			</div>
		</div>	
	</form>
</div>
<div class="col-lg-4 add-event-button">
   <button type="button" class="btn btn-outline-primary btn-block"  id="add_event">Add Event</button>
</div>