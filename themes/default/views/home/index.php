</div>
<div id="content-wrapper">
				<div class="my-container">
<div class="row">
  <div class="col-sm-3">
  </div>
  
  <div class="col-sm-9 body">
                       <ul class="list-inline secondary-menu">
                            <?php foreach($event_types as $type){?>
                            <li class= "body-menu"><a href="<?php echo site_url('home/type/'.$type['event_type_id'].'-'.url_title($type['event_type']))?>"><?php echo $type['event_type']?></a></li>
                            <?php }?>
                        </ul>
                        <div class="clearfix"></div>
                            
                        <div class="bxslider">
							<?php foreach($events as $event){?>
                            <div class="slide">
                           		<a href="<?php echo site_url('event/'.$event['event_id'].'-'.url_title($event['event_name']))?>">  <img style src="<?php echo base_url();?>uploads/event/<?php echo $event['event_image']?>"></a>
                                <div class="caption">
                                	<p><?php echo $event['event_name']?><br></p>
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
                                                   <?php $i=0;foreach ($galleries as $gallery){?> 
                                                    <div <?php if($i==0){?>class="item active"<?php } else{ ?>class="item" <?php }?>>
                                                   <img src="<?php echo base_url();?>uploads/event/<?php echo $gallery['image_name']; $i++;?>" style=" width: 100%; height:337px">
                                                      <div class="carousel-caption">
                                                        <?php echo $gallery['gallery_title']?>
                                                      </div>
                                                    </div>
													<?php } ?>                       

                                                  </div>
                                                </div>

                                                 <div class="album pull-left">
                                                 <p>albums</p>
                                                 </div>
                                                 <div class="full-gallery pull-right">
                                               <a href="<?php echo site_url('gallery/')?>">  <p>view full gallery</p></a>
                                                 </div>
                          </div>
                          </div>
                          </div>
                            
                        <div class= "row">
                        <div class="col-sm-12">
                        <div class= "talako-foto ">
                                     <ul class="bxslider2">
                                     <?php foreach($galleries as $gallery){?>
                                      <li><a href="<?php echo site_url('gallery/'.$gallery['gallery_id'].'-'.url_title($gallery['gallery_title']))?>">  <img src="<?php echo base_url()?>uploads/event/<?php echo $gallery['image_name'];?>" height="157px" width="236px">  </a></li>
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
      
         

