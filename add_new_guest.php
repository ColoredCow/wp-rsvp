<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-10 col-sm-8">
            <div>Add New Guest </div>
             <P>You Can Add your guest by Submitting the given form.The guest will added to your guest list so that you can send an invite through Email for the event.</P> 
                <form id="add_event_form">
                    <hr>
                    <div class="form-group">
                        <div class="col-lg-6">
                            <label for="event-name" class="form-control-label">
                                <div>Guest Name:</div>
                            </label>
                            <input type="text" class="form-control" placeholder="Enter Guest Name" name="guest_name" id="guest_name" maxlength="50" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-6">
                            <label for="event-name" class="form-control-label">
                                <div>Email-ID:</div>
                            </label>
                            <input type="text" class="form-control" placeholder="Enter Guest Email-ID" name="guest_email_id" id="guest_email_id" maxlength="50" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-6">
                            <label for="event-date" class="form-control-label">
                                <div>Mobile Number:</div>
                            </label>
                            <input type="text" class="form-control"  placeholder="Enter Guest Mobile Number" name="guest_mobile_number" id="guest_mobile_number" required>
                        </div>
                    </div>  
                    <div class="form-group">
                        <div class="col-lg-6">
                            <label for="event-venue" class="form-control-label">
                                <div>Gender</div>
                            </label>
                            <label class="custom-control custom-radio">
                                <input name="request_gender" value="Male" type="radio" class="custom-control-input" required="required">
                                <span class="custom-control-indicator"></span>
                                <span class="custom-control-description">Male</span>
                            </label>
                            <label class="custom-control custom-radio">
                                <input name="request_gender" value="Female" type="radio" class="custom-control-input" required="required">
                                <span class="custom-control-indicator"></span>
                                <span class="custom-control-description">Female</span>
                            </label>
                            <label class="custom-control custom-radio">
                                <input name="request_gender" value="Others" type="radio" class="custom-control-input" required="required">
                                <span class="custom-control-indicator"></span>
                                <span class="custom-control-description">Others</span>
                            </label>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <button type="button" class="btn btn-primary"  id="submit_request">Add Guest</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>