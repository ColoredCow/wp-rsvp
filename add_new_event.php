<div class="container">
	<h1>Add New Event </h1>
		<hr>	

		<div class="row">
			<div class="col-lg-7 col-md-7 col-sm-12">
		<div class="col-lg-7">
		<p id="msg3"></p>
		</div>
				<form id="add_event_form">
					<div class="form-group">
						<div class="col-lg-12">
							<label for="event-name" class="form-control-label">
								Event Name:
							</label>
							<input type="text" class="form-control" placeholder="Event Name" name="event_name" id="event_name" maxlength="50" required>
						</div>
					</div>
					<div class="form-group">
						<div class="col-lg-12">
							<label for="event-theme" class="form-control-label">
								Event Theme:
							</label>
							<input type="text" class="form-control" placeholder="Theme of Event" name="event_theme" id="event_theme" maxlength="50" required>
						</div>
					</div>
					<div class="form-group">
						<div class="col-lg-12">
							<label for="event-date" class="form-control-label">
								Enter Date :
							</label>
							<input type="date" class="form-control"  placeholder="Date of Event" name="event_date" min='<?php echo date('Y-m-d'); ?>' id="event_date" required>
						</div>
					</div>  
					<div class="form-group">
						<div class="col-lg-12">
							<label for="event-venue" class="form-control-label">
								Enter Venue :
							</label>
							<input type="text" class="form-control" placeholder="Venue of Event" name="event_venue" id="event_venue" maxlength="250" required>
						</div>
					</div>
                    <div class="form-group">
                    <div class="col-lg-12">
                    <label for="about-event">About The Event</label>
                    <textarea class="form-control" placeholder="Limit 150 Words" name="about_event" id="about_event" maxlength="150" rows="4" required></textarea>
                    </div>
                    </div>
					<div class="col-lg-4 add-event-button">
						<button type="button" class="btn btn-primary btn-block"  id="add_event">Add Event</button>
					</div>
				</form>
			</div>
		</div>
	</div>
