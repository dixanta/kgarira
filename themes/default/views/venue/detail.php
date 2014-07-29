</div>
    <div id="content-wrapper">
        <div class="my-container">
            <div class="row">
              <div class="col-sm-3">
              </div>
   
              <div class="col-sm-9 body">
                  <p class = "gig-box">Venue</p>
                  <hr>
                  <div class = "col-sm-4" map>
                      <img src="<?php echo base_url();?>uploads/venue/<?php echo $venue['venue_image'];?>" height="300px" width="300px" >  
                  </div>
                  <div class= "col-sm-8">
                      <div class ="row">
                      <div class = "artist-gig-guide">
                          <p class="gig-band"><?php echo $venue['venue_name'];?></p>
                          <hr>
                      </div>
                       <div class="row">
                      <div class = "col-sm-3 map">
                          <img src="<?php echo base_url();?>uploads/venue/<?php echo $venue['venue_image'];?>" height="150px" width="150px">
                          </div>
                          
                       
                       
                      <div class = "col-sm-9">
                          <p class="band-info">Venue Name: <?php echo $venue['venue_name'];?></p>
                          <p class="band-info">Location: <?php echo $venue['venue_location'];?></p>
                         
                      </div>
                      </div>
                      </div>
                       <div class = "row">
                              <div class="row">
                              <div class = "col-sm-3 artist-gig-guide-submit">
                                  <input type="submit" value="Buy Tickets" name="buy_tickets">
                               </div>
                               </div>
                        </div>                                                  
                  </div>
                 <div class ="artist-fb">
                  <img src ="<?php echo theme_url();?>assets/images/fb.jpg">
                  </div>
                  
                  <div class="clearfix"></div>
                  <br/>
                      <p class = "gig-band-box">VENUE DETAILS</p>
                      <hr>
                      <p>
                      <?php echo $venue['venue_description'];?>
                      </p>
                 <!-- <p class = "gig-event-box">upcoming events from this band</p>
                  <hr>
                  
                  <img src="<?php echo theme_url();?>assets/images/evnet-img.jpg" class ="artist-img-event">
                  <img src="<?php echo theme_url();?>assets/images/evnet-img.jpg" class ="artist-img-event">
                  <img src="<?php echo theme_url();?>assets/images/evnet-img.jpg" class ="artist-img-event">
                  <img src="<?php echo theme_url();?>assets/images/evnet-img.jpg" class ="artist-img-event">
                  <img src="<?php echo theme_url();?>assets/images/evnet-img.jpg" class ="artist-img-event">
                  
                  <p class = "band-gallery-box">band gallery</p>
                  <hr>
                  
                  <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                  <!-- Indicators -->
                                              <!--    
                                                  <div class="carousel-inner">
                                                    <div class="item active">
                                                         <div class = "item-image-holder">
                                                            <div class="item-image-left">
                                                            <img src="<?php echo theme_url();?>assets/images/band-gallery.jpg" >
                                                            </div>
                                                            <div class="item-image-right">
                                                            <img src="<?php echo theme_url();?>assets/images/123123.jpg">
                                                            <img src="<?php echo theme_url();?>assets/images/123123.jpg">
                                                            </div>
                                                            
                                                          </div>
                                                    </div>
                                                    </div>
                                                    
              </div>
                    <div class="full-gallery pull-right">
                        <p>view full gallery</p>
                    </div>
                    -->
                     <div class ="row">
                        <div class="col-sm-12">   
                        <div class = "dog-and-flair">
                            <div class= "dog pull-left">
                                <img style="width: 100%; " src="<?php echo theme_url();?>assets/images/dog.jpg">
                            </div>
                            <div class = "flair pull-left">
                                <img style="width: 100%;" src="<?php echo theme_url();?>assets/images/flair.jpg">
                            </div>            
                        </div>
                            </div>
                            </div>

            </div>
        </div>
    </div>  <!--Content Wrapper-->      
         