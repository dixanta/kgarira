</div>
    <div id="content-wrapper">
        <div class="my-container">
            <div class="row">
              <div class="col-sm-3">
              </div>
   
              <div class="col-sm-9 body">
                  <p class = "gig-box">GIG GUIDE</p>
                  <hr>
                  <?php foreach($events as $event){?>
                  <div class = "col-sm-4" map>
                      <a href="<?php echo site_url('event/'.$event['event_id'].'-'.url_title($event['event_name']))?>">  <img src="<?php echo base_url()?>uploads/event/<?php echo $event['event_image'];?>" height="200px" width="200px">  </a>
                  </div>
                  <?php }?>
                  
                  <hr>
                  <p class = "gig-guide-gallery-box">gallery</p>
                  <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                  <!-- Indicators -->
                                                  
                                                  <div class="carousel-inner">
                                                    <div class="item active">
                                                    
                                                         <div class = "item-image-holder">
                                                    <?php $i=0; ;foreach($events as $event){ ?>
                                                            <div <?php if($i==0){ ?>class = "item-image-left" height="450px"<?php $i++;;} 
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