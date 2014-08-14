
<link rel="stylesheet" href="<?php echo theme_url()?>assets/css/signin.css">
</div>
    <div class="container">

      <form class="form-signin" role="form" action="<?php echo site_url('account/event/save')?>">
        <h2 class="form-signin-heading">Add Event</h2>
        Event Name<input type="text" class="form-control" name="event_name" id="event_name" required autofocus>
        Event Description<textarea class="form-control" name="event_description" id="event_description" required></textarea>
        Event Image<input type="file" class="form-control" name="event_image" id="event_image" required>
        Event Type<input type="text" class="form-control"  name="event_type_id" id="event_type_id" required>
        Venue<input type="text" class="form-control"  name="venue_id" id="venue_id" required>
        Country<td><select name="country_id" id="country_id" >
    <?php
	foreach($countries as $country){
    ?>
    <option value="<?php echo $country['country_id'];?>" id="<?php echo $country['country_id'];?>"  name="<?php echo $country['country_id'];?>"><?php echo $country['country_name'];?></option>
    <?php
	}
	?></select></td><br />
        Event Start Date<input type="text" class="form-control"  name="event_start_date" id="event_start_date" required>
        Event End Date<input type="text" class="form-control"  name="event_end_date" id="event_end_date" required>
        Allow Ticket:  Yes<input type="radio" class=""  name="allow_ticket_sale" id="allow_ticket_sale_1" value="1">   No<input type="radio" class="" name="allow_ticket_sale" id="allow_ticket_sale_0" value="0"><br />
        Number of Tickets<input type="text" class="form-control"  name="no_of_tickets" id="no_of_tickets" required>
        Ticket Amount<input type="text" class="form-control"  name="ticket_amount" id="ticket_amount" required>
        Paid Tickets<input type="text" class="form-control"  name="paid_tickets" id="paid_tickets" required>
        Status:  Yes<input type="radio" class=""  name="status" id="status_1" value="1">   No<input type="radio" class="" name="status" id="status_0" value="0">      
        <button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>
        <button class="btn btn-lg btn-danger btn-block" type="button">Cancel</button>
      </form>

    </div> <!-- /container -->
