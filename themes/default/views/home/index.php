</div>
<div id="content-wrapper">
				<div class="my-container">
<div class="row">
  <div class="col-sm-3">
  </div>
  
  <div class="col-sm-9 body">
                       <ul class="list-inline secondary-menu">
                            <?php foreach($event_types as $type){?>
                            <li class= "body-menu"><a href="<?php site_url('home');?>?id=<?php echo $type['event_type_id']?>"><?php echo $type['event_type']?></a></li>
                            <?php }?>
                        </ul>
                            <div class="clearfix"></div>
                            
                        <div class="bxslider">
							 <?php foreach($events as $event){?>
                            <div class="slide">
                           
                           <a href="<?php echo site_url('event/'.$event['event_id'].'-'.url_title($event['event_name']))?>">  <img style src="<?php echo base_url();?>uploads/event/thumb/<?php echo $event['event_image']?>"></a>
                                <div class="caption">
                                <p>JINDABAAD<br><span>Thamel</span></p>
                            </div>
                            </div>
                            <?php }?>

                            
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
                            
                        <div class = "row">
                            <div class="col-sm-12">
                            <div class ="gallery-talako">
                                            <p class = "gallery-box">gallery</p>
                                                <hr>
                                                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                  <!-- Indicators -->
                                                  <ol class="carousel-indicators">
                                                    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                                                    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                                                    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                                                    <li data-target="#carousel-example-generic" data-slide-to="3"></li>
                                                  </ol>

                                                  <!-- Wrapper for slides -->
                                                  <div class="carousel-inner">
                                                   <?php $i=0;foreach ($events as $event){?> 
                                                    <div <?php if($i==0){?>class="item active"<?php } else{ ?>class="item" <?php }?>>
                                                   <img src="<?php echo base_url();?>uploads/event/<?php echo $event['event_image']; $i++;?>" style=" width: 100%;">
                                                      <div class="carousel-caption">
                                                        1st image
                                                      </div>
                                                    </div><?php } ?>                       

                                                  </div>
                                                </div>

                                                 <div class="album pull-left">
                                                 <p>albums</p>
                                                 </div>
                                                 <div class="full-gallery pull-right">
                                                 <p>view full gallery</p>
                                                 </div>
                          </div>
                          </div>
                          </div>
                            
                        <div class= "row">
                        <div class="col-sm-12">
                        <div class= "talako-foto ">
                                     <ul class="bxslider2">
                                     <?php foreach($galleries as $gallery){?>
                                      <li><a href="<?php echo site_url('gallery/'.$gallery['gallery_id'].'-'.url_title($gallery['gallery_title']))?>">  <img src="<?php echo base_url()?>uploads/event/<?php echo $gallery['image_name'];?>" height="253px" width="157px">  </a></li>
                                      <?php }?>
                                    </ul>
                        </div>
                        </div>
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
      
         

