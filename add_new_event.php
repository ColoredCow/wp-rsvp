<div class="container">
	<div class="page-header"> Add New Event </div>
		<hr>	
		<div class="row">
			<div class="col-lg-7 col-md-7 col-sm-12">
				<form id="add_event_form">
					<div class="form-group">
						<div class="col-lg-12">
							<label for="event-name" class="form-control-label">
								<div>Event Name:</div>
							</label>
							<input type="text" class="form-control" placeholder="Event Name" name="event_name" id="event_name" maxlength="50" required>
						</div>
					</div>
					<div class="form-group">
						<div class="col-lg-12">
							<label for="event-name" class="form-control-label">
								<div>Event Theme:</div>
							</label>
							<input type="text" class="form-control" placeholder="Theme of Event" name="event_theme" id="event_theme" maxlength="50" required>
						</div>
					</div>
					<div class="form-group">
						<div class="col-lg-12">
							<label for="event-date" class="form-control-label">
								<div>Enter Date :</div>
							</label>
							<input type="date" class="form-control"  placeholder="Date of Event" name="event_date" id="event_date" required>
						</div>
					</div>  
					<div class="form-group">
						<div class="col-lg-12">
							<label for="event-venue" class="form-control-label">
								<div>Enter Venue :</div>
							</label>
							<input type="text" class="form-control" placeholder="Venue of Event" name="event_venue" id="event_venue" maxlength="250" required>
						</div>
					</div>
					<div class="col-lg-4 add-event-button">
						<button type="button" class="btn btn-primary btn-block"  id="add_event">Add Event</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>