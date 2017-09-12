<?php

$emailbody ='
 '.$event_about.'
<center>
 Please join us for:

 '.$current_event.'

 Theme: '.$event_theme.'
 Venue: '.$event_venue.'
 Date: '.$modify_date.'
 Time:'.$modify_time.'
 Host:'.$event_host.'
 Address: '.$event_address.'
</center>
';        
         
$output2 .='';
$output2 .='
			<button type="button" class="btn btn-success btn-sm email" id="lo">Email Template</button>
        	<hr>
			<div id="email-temp" style="display:none;">
				<div class="alert alert-success">
					<button type="button" class="btn btn-danger btn-sm pull-right hide-email">&times;</button>
					<form id="email_form">
						<div class="row">
							<label for="guest_name" class="form-control-label col-lg-2">
								Email Subject
							</label>
							<select name="fontstyle" id="fontstyle" class="form-control form-control-sm col-lg-2">
								<option disabled="" selected="">Select Font Style </option>
								<option style="font-family : Arial" value="Arial">Arial</option>
								<option style="font-family : Courier" value="Courier">Courier</option>
								<option style="font-family : Tahoma" value="Tahoma">Tahoma</option>
								<option style="font-family : Times New Roman" value="Times New Roman">Times New Roman</option>
								<option style="font-family : Verdana" value="Verdana">Verdana</option>
							</select>&nbsp;&nbsp;
							<input type ="number" class="form-control form-control-sm col-lg-2 fontsize" id="fontsize" name="fontsize" placeholder="Size of the fonts">
						</div>
						<input type="text" class="form-control" value="WP-RSVP Invitation" placeholder="Subect of the Email" name="subject" id="subject" maxlength="50" required>
						<label for="about_event">
             				Email Body
             			</label>
        				<textarea class="form-control" name="body" id="body" rows="7">'.$emailbody.'</textarea>	
						<br>
						<div class="container-fluid">
							<div class="row pull-left">
								<button type="button" class="btn btn-outline-warning btn-sm email">Instructions</button>
							</div>
							<div class="row pull-right">
								<input type="email" class="form-control form-control-sm col-lg-6 col-md-2" placeholder="Type your email address" name="test_email_id" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" title="e.g example@domain.com" id="test_email_id">&nbsp;&nbsp;
								<button type="button" class="btn btn-outline-info btn-sm test-email" required>Send Test Email</button>
							</div>
						</div>
					</form>	
					<br>   		
				</div>
				<hr>
			</div>
		'; 
?>