</div>
    <div id="content-wrapper">
        <div class="my-container">
            <div class="row">
              <div class="col-sm-3">
              </div>
   
              <div class="col-sm-9 body">
                  <p class = "gig-box">GIG GUIDE</p>
                  <hr>
                  <div class = "col-sm-4" map>
                      <img src="<?php echo base_url()?>uploads/event/<?php echo $event['event_image'];?>">  
                  </div>
                  
                  <div class= "col-sm-8">
                      <div class ="row">
                          <div class = "gig-guide">
                              <p class="gig-guide-band-info">Spotify, Music Feeds, Sailor Jerry & Select Music Present</p>
                              <hr>
                          </div>
                       <div class="row">  
                           <div class="col-sm-12">
                              <p class="gig-band">1947 A.D</p>
                                <div class ="gig-guide-submit">
                                  <input type="submit" value="Add to Wish List" name="wish_list ">
                                  <input type="submit" value="Buy Tickets" name="buy_tickets ">
                               </div>
                            </div>
                        </div>
                               
                        
                      <p class="gig-guide-band-info1">Date and Time: <?php echo $event['event_start_date'] ?></p>
                      <p class="gig-guide-band-info1"><?php echo $event['venue_name'] ?></p>
                      </div>                     
                  </div>
                  <div class ="fb">
                  <img src ="<?php echo theme_url()?>assets/images/fb.jpg">
                  </div>
                  <div class="clearfix"></div>
                  <br/>
                      <p class = "event-detail-box">EVENT DETAILS</p>
                      <hr>
                      <p><?php echo $event['event_description'];?></p><br /><br />
                  <p class = "similar-event-box">SIMILAR EVENTS</p>
                  <hr>
                  
                  <?php foreach($events as $event){?>
                  <a href="<?php echo site_url('event/details/')?>/<?php echo $event['event_id'];?>">  <img src="<?php echo base_url()?>uploads/event/thumb/<?php echo $event['event_image']?>" class ="artist-img-event"></a>
                  <?php }?>
                  
                  <p class = "gig-guide-gallery-box">gallery</p>
                  <hr>
                  
                  <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                  <!-- Indicators -->
                                                  
                                                   <div class="carousel-inner">
                                                    <div class="item active">
                                                    
                                                         <div class = "item-image-holder">
                                                    <?php $i=0; $j=0;foreach($events as $event){ ?>
                                                            <div <?php if($i==0){ if($j>=3){break;}?>class = "item-image-left"<?php $i++;$j++;} 
															else{?>class="item-image-right"<?php }?>>
                                                            <img src="<?php echo base_url()?>uploads/event/<?php echo $event['event_image']?>" >
                                                            </div>
                                                            
                                                    <?php } ?>      
                                                          </div>                                                    
                                                    </div>
                                                    </div>
                                                    
              </div>
                    <div class="full-gallery pull-right">
                        <p>view full gallery</p>
                    </div>
                    
                     <div class ="row">
                        <div class="col-sm-12">   
                        <div class = "dog-and-flair">
                            <div class= "dog pull-left">
                                <img style="width: 100%; " src="<?php echo theme_url()?>assets/images/dog.jpg">
                            </div>
                            <div class = "flair pull-left">
                                <img style="width: 100%;" src="<?php echo theme_url()?>assets/images/flair.jpg">
                            </div>            
                        </div>
                            </div>
                            </div>

            </div>
        </div>
    </div>  <!--Content Wrapper-->       