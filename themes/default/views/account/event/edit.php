
<link rel="stylesheet" href="<?php echo theme_url()?>assets/css/signin.css">
    <div class="container">

      <form class="form-signin" role="form">
        <h2 class="form-signin-heading">Add Event</h2>
        <input type="hidden" name="event_id" id="event_id" value="<?php $event['event_id']?>">
        Event Name<input type="text" class="form-control" name="event_name" id="event_name" value="<?php $event['event_name']?>" required autofocus>
        Event Description<textarea class="form-control" name="event_description" id="event_description" value="<?php $event['event_description']?>" required></textarea>
        Event Image<input type="file" class="form-control" name="event_image" id="event_image" value="<?php $event['event_image']?>" required>
        Event Type<input type="text" class="form-control"  name="event_type_id" id="event_type_id" value="<?php $event['event_type_id']?>" required>
        Venue<input type="text" class="form-control"  name="venue_id" id="venue_id" value="<?php $event['venue_id']?>" required>
        Country<input type="text" class="form-control"  name="country_id" id="country_id" value="<?php $event['country_id']?>" required>
        Event Start Date<input type="text" class="form-control"  name="event_start_date" id="event_start_date" value="<?php $event['event_start_date']?>" required>
        Event End Date<input type="text" class="form-control"  name="event_end_date" id="event_end_date" value="<?php $event['event_end_date']?>" required>
        Allow Ticket:  Yes<input type="radio" class=""  name="allow_ticket_sale" id="allow_ticket_sale_1" value="1">   No<input type="radio" class="" name="allow_ticket_sale" id="allow_ticket_sale_0" value="0"><br />
        Number of Tickets<input type="text" class="form-control"  name="no_of_tickets" id="no_of_tickets" value="<?php $event['no_of_tickets']?>" required>
        Ticket Amount<input type="text" class="form-control"  name="ticket_amount" id="ticket_amount" value="<?php $event['ticket_amount']?>" required>
        Paid Tickets<input type="text" class="form-control"  name="paid_tickets" id="paid_tickets" value="<?php $event['paid_tickets']?>" required>
        Status:  Yes<input type="radio" class=""  name="status" id="status_1" value="1">   No<input type="radio" class="" name="status" id="status_0" value="0">      
        <button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>
        <button class="btn btn-lg btn-danger btn-block" type="button">Cancel</button>
      </form>

    </div> <!-- /container -->


