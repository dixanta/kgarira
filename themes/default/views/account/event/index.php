<style>
#aa{
		  padding-left:580px;
		  }
</style>
<table class="table table-striped" id="aa">
<tr>
    <th><input type="checkbox" name="checkbox2" id="checkbox2" /></th>
    <th>Id</th>
    <th>Event Name</th>
    <th>Description</th>
    <th>Event Image</th>
    <th>Created Date</th>
    <th>End Date</th
    ><th>Allow Tickets Sell</th>
    <th>Number of Tickets</th>
    <th>Ticket Price</th> 
    <th>Paid Tickets</th>
    <th>Status</th>
    <th>Action</th>    
    <th><a href="<?php echo site_url('account/event/add')?>"<button class="btn btn-lg btn-primary btn-block">Add</button></th>
  </tr>
  <?php foreach($events as $event){?>
   <tr>
  
    <td><input type="checkbox" name="checkbox" id="checkbox" />
      <label for="checkbox"></label></td>
    <td><?php echo $event['event_id']?></td>
    <td><a href="<?php echo site_url('account/event/details/'.$event['event_id'].'-'.url_title($event['event_name']))?>" target="_blank"><?php echo $event['event_name']?></a></td>
    <td><?php echo $event['event_description']?></td>
     <td><img src="<?php echo base_url()?>uploads/event/thumb/<?php echo $event['event_image'];?>"></td>
    <td><?php echo $event['event_start_date']?></td>
    <td><?php echo $event['event_end_date']?></td>
    <td><?php echo $event['allow_ticket_sell']?></td>
    <td><?php echo $event['no_of_tickets']?></td>
    <td><?php echo $event['ticket_amount']?></td>
    <td><?php echo $event['paid_tickets']?></td>
    <td><?php echo $event['status']?></td>
    <td><button class="btn btn-large btn-primary">Edit</button> <button class="btn btn-large btn-danger">Delete</button></td>
    <?php }?>
</table>