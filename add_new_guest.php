<div class="col-lg-12 col-md-4 col-sm-12">			
	<div class="heading">	
		Add New Guest
	</div>
	<p id="successfull_guest_message"></p>  
	<hr>
	<div class="row">
		<form id="add_guest_form">
			<div class="form-group col-lg-12">
				<label for="guest_name" class="form-control-label">
					<b>Guest Name</b>
				</label>
				<input type="text" class="form-control" placeholder="Enter Guest Name" name="guest_name" id="guest_name" maxlength="50" required>
			</div>
			<div class="form-group col-lg-12">
				<label for="guest_email_id" class="form-control-label">
					<b>Guest Email-ID</b>
				</label>
				<input type="email" class="form-control" placeholder="Enter Guest Email-ID" name="guest_email_id" id="guest_email_id" maxlength="50" required>	
			</div>
			<div class="form-group col-lg-12">
				<label for="guest_mobile_number" class="form-control-label">
					<b>Guest Mobile Number</b>
				</label>
				<input type="tel" pattern="[789][0-9]{9}" class="form-control"  placeholder="Guest Mobile Number" name="guest_mobile_number" id="guest_mobile_number" maxlength="10" required>	
			</div>  
			<div class="form-group col-lg-12">
				<label for="guest_gender" class="form-control-label">
					<b>Gender</b>
				</label>
				<label class="custom-control custom-radio">
					<input name="guest_gender" value="Male" type="radio" class="custom-control-input" required="required">
					<span class="custom-control-indicator"></span>
					<span class="custom-control-description">Male</span>
				</label>
				<label class="custom-control custom-radio">
					<input name="guest_gender" value="Female" type="radio" class="custom-control-input" required="required">
					<span class="custom-control-indicator"></span>
					<span class="custom-control-description">Female</span>
				</label>
				<label class="custom-control custom-radio">
					<input name="guest_gender" value="Others" type="radio" class="custom-control-input" required="required">
					<span class="custom-control-indicator"></span>
					<span class="custom-control-description">Others</span>
				</label>
			</div>
			<div class="col-lg-4">
				<button type="button" class="btn btn-outline-primary"  id="add_guest">Add Guest</button>
			</div>
		</form>
	</div>
</div>