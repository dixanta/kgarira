</div>
    <div id="content-wrapper">
        <div class="my-container">
            <div class="row">
              <div class="col-sm-3">
              </div>
   
              <div class="col-sm-9 body">
                  <p class = "gig-box">Artist</p>
                  <hr>
                  <div class = "col-sm-4" map>
                      <img src="<?php echo base_url();?>uploads/artist/<?php echo $artist['artist_image'];?>" height="300px" width="300px" >  
                  </div>
                  <div class= "col-sm-8">
                      <div class ="row">
                      <div class = "artist-gig-guide">
                          <p class="gig-band"><?php echo $artist['artist_name'];?></p>
                          <hr>
                      </div>
                       <div class="row">
                      <div class = "col-sm-3 map">
                          <img src="<?php echo base_url();?>uploads/artist/<?php echo $artist['artist_image'];?>" height="150px" width="150px">
                          </div>
                          
                       
                       
                      <div class = "col-sm-9">
                          <p class="band-info">Vocals: <?php echo $artist['artist_name'];?></p>
                          <p class="band-info">Genre: <?php echo $artist['genre_name'];?></p>
                          <p class="band-info">Guitar: Manoj KC</p>
                          <p class="band-info">Percussion: Sanjay Maharjan</p>
                          <p class="band-info">Bass: Nirakar Yakthumba</p>
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
                      <p class = "gig-band-box">BAND DETAILS</p>
                      <hr>
                      <p>
                      <?php echo $artist['artist_description'];?>
                      </p>
                  <p class = "gig-event-box">upcoming events from this band</p>
                  <hr>
                 
                
                </div>
                  
                  <p class = "band-gallery-box">band gallery</p>
                  <hr>
                  
                  <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                  <!-- Indicators -->
                                                  
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
         