<div class="container">
	<div>Add New Guest </div>
	<P>You Can Add your guest by Submitting the given form.The guest will added to your guest list so that you can send an invite through Email for the guest.</P>
	<hr>
	<div class="row">
		<div class="col-lg-7 col-md-7 col-sm-12">
			<form id="add_guest_form">
				<div class="form-group">
					<div class="col-lg-12">
						<label for="guest-name" class="form-control-label">
							<div>Guest Name:</div>
						</label>
						<input type="text" class="form-control" placeholder="Enter Guest Name" name="guest_name" id="guest_name" maxlength="50" required>
					</div>
				</div>
				<div class="form-group">
					<div class="col-lg-12">
						<label for="guest-email" class="form-control-label">
							<div>Email-ID:</div>
						</label>
						<input type="text" class="form-control" placeholder="Enter Guest Email-ID" name="guest_email_id" id="guest_email_id" maxlength="50" required>
					</div>
				</div>
				<div class="form-group">
					<div class="col-lg-12">
						<label for="guest-number" class="form-control-label">
							<div>Mobile Number:</div>
						</label>
						<input type="text" class="form-control"  placeholder="Enter Guest Mobile Number" name="guest_mobile_number" id="guest_mobile_number" required>
					</div>
				</div>  
				<div class="form-group">
					<div class="col-lg-12">
						<label for="guest-gender" class="form-control-label">
							<div>Gender</div>
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
				</div>
				<div class="col-lg-4">
					<button type="button" class="btn btn-primary"  id="add_guest">Add Guest</button>
				</div>
			</form>
		</div>
	</div>
</div>