</div>
    <div id="content-wrapper">
        <div class="my-container">
            <div class="row">
              <div class="col-sm-3">
              </div>
   
              <div class="col-sm-9 body">
                  <p class = "gig-box">gallery</p>
                  <hr>
                  <?php foreach($gallery as $gallery){?>
                  <div class = "col-sm-4" map>
                      <a href="<?php echo site_url('gallery/'.$gallery['gallery_id'].'-'.url_title($gallery['gallery_title']))?>">  <img src="<?php echo base_url()?>uploads/event/<?php echo $gallery['image_name'];?>">  </a>
                  </div>
                  <?php }?>
                  
                  <hr>
                    
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