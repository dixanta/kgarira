    <div id="content-wrapper">
        <div class="my-container">
            <div class="row">
              <div class="col-sm-3">
              </div>
   
              <div class="col-sm-9 body">
               <p class = "gallery-box">gallery</p>
                <hr>
                        
                        <div id="gallery-main" role="gallery-main">
                             <ul id="tiles">
                            <!-- These are our grid blocks -->
                            <?php foreach($gallery_image as $image){?> 
                            <li>
                              <a href="<?php echo base_url()?>uploads/gallery/<?php echo $image['gallery_id']?>/<?php echo $image['gallery_image'] ?>">
                                <img src="<?php echo base_url()?>uploads/gallery/<?php echo  $image['gallery_id']?>/<?php echo $image['gallery_image'] ?>" width="200" height="283">
                              </a>
                            </li>
                            <?php } ?>
                            <!-- End of grid blocks -->
                             </ul>
                          </div>


                
              </div>
            </div>
        </div>
    </div>  <!--Content Wrapper--> 