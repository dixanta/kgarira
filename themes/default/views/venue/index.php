</div>
    <div id="content-wrapper">
        <div class="my-container">
            <div class="row">
              <div class="col-sm-3">
              </div>
   
              <div class="col-sm-9 body">
                 <div class ="bar-top">
                <?php foreach($venue_types as $venue_type){?>
                  <p class = "bar-menu"><a href="<?php echo site_url('venue/type/'.$venue_type['venue_type_id'].'-'.url_title($venue_type['venue_type']))?>"> <?php echo $venue_type['venue_type']?></a></p><?php }?>
                  <div class = "bar-menu-sideko">
                  <img src="<?php echo theme_url();?>assets/images/tiles.png">
                  <img src="<?php echo theme_url();?>assets/images/list.png">
                  </div>

                  <hr>              
                  </div>
                  <div class="clearfix"></div>
                 
                  <div class="image">
                   <?php foreach($venues as $venue){?>
                          <div class = "image-info">  
                         
                        <a href="<?php echo site_url('venue/'.$venue['venue_id'].'-'.url_title($venue['venue_name']))?>"><img src="<?php echo base_url();?>uploads/venue/<?php echo $venue['venue_image'];?>" height="200px" width="200px" class="bar-img"></a>
                          <div class = "caption">
                          <p><?php echo $venue['venue_name']?><br><span><?php echo $venue['venue_location']?></span></p>
                          </div>
                          </div>
                          <?php }?>
                          
                          

                        <!--  <div class = "image-info">  
                          <a href="#"><img src="<?php echo theme_url();?>assets/images/bars2.jpg" class="bar-img"></a>
                          <div class = "caption">
                          <p>SHEESHA CAFE & BAR<br><span>Thamel, Kathmandu</span></p>
                          </div>
                          <div class="caption2">
                              <img src="<?php echo theme_url();?>assets/images/like.png">
                              <img src="<?php echo theme_url();?>assets/images/heart1.png">
                              <img src="<?php echo theme_url();?>assets/images/location.png">
                          </div>
                          </div>-->
                          
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
        </div>
    </div>  <!--Content Wrapper-->      
         