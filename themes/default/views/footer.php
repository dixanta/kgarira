
		<div id="footer-wrapper">
			
             
                        <div class="footer-back">
                        
                          <div class="footer-line footer-line-menu">
                    
                         <ul class="list-inline">
                            <li><a href="<?php echo site_url('event')?>">GIG GUIDE</a></li>
                            <li><a href="#">BAR GUIDE</a></li>
                            <li><a href="#">BANDS</a></li>
                            <li><a href="#">DJ</a></li>
                            <li><a href="<?php echo site_url('gallery')?>">GALLERY</a></li>
                            <li><a href="<?php echo site_url('contact')?>">CONTACT US</a></li>
                            <li><a href="#">ABOUT US</a></li>
                          <hr> 
                        </ul>
                           
                            </div>
                                <div class="all-right pull-left">
                                <p>© 2014 Kgarira.com All rights reserved.</p>
                                </div>
                                <div class="pagoda pull-right">
                                <p>Powered By <a href="#">PAGODA LABS</a></p>
                                </div>
                                 <div class="clearfix"></div> 
                             
                                <div class="footer-logo">
                                <img src="<?php echo theme_url();?>assets/images/kgarira-logo-footer.png">
                                </div>

                          </div>
                    </div>
                    </div>
                
                </div>
               
                 </div><!-- my-container ko talako row ko end --> 
        </div>  <!--Footer Wrapper Ends-->

		</div> <!--Main Wrapper Ends-->
        
		<script src="http://code.jquery.com/jquery.js"></script>
		<script src="<?php echo theme_url()?>assets/js/bootstrap.min.js"></script>
         <script src="<?php echo theme_url()?>assets/js/jquery.wookmark.min.js"></script>      
                 <script src="<?php echo theme_url()?>assets/js/jquery.bxslider.min.js"></script>
                 <script src="<?php echo theme_url()?>assets/js/jquery.imagesloaded.js"></script>
                  <script src="<?php echo theme_url()?>assets/js/jquery.magnific-popup.min.js"></script>
                 
        <script>$(document).ready(function(){
               $('.bxslider').bxSlider({
                  minSlides: 4,
                  maxSlides: 10,
                  slideWidth: 154,
                  slideMargin: 5,
                  pager: false,
                  controls: true
                });
               $('.bxslider2').bxSlider({
                  minSlides: 3,
                  maxSlides: 10,
                  slideWidth: 236,
                  slideMargin: 5,
                  pager: false,
             
                });
                 $('.bxslider3').bxSlider({
                  minSlides: 3,
                  maxSlides: 10,
                  slideWidth: 174,
                  slideMargin: 20,
                  pager: false,
             
                });            
                });</script>
                
                 <script type="text/javascript">
    (function ($){
      // Prepare layout options.
      var options = {
        autoResize: true, // This will auto-update the layout when the browser window is resized.
        container: $('#gallery-main'), // Optional, used for some extra CSS styling
        offset: 3, // Optional, the distance between grid items
        itemWidth: 210 // Optional, the width of a grid item
      };

      // Get a reference to your grid items.
      var handler = $('#tiles li');

      // Init lightbox
      $('#tiles').magnificPopup({
        delegate: 'li:not(.inactive) a',
        type: 'image',
        gallery: {
          enabled: true
        }
      });

      // Call the layout function after all images have loaded
      $('#tiles').imagesLoaded(function() {
        handler.wookmark(options);
      });
    })(jQuery);
    
    
        var active = 1;
        $('.side-toggle').on('click', function() {
            if(active == 1) {
                active = 2;
                $('#side-menu-1').fadeOut(0);
                $('#side-menu-2').fadeIn(500);
            } else if(active == 2) {
                active = 1;
                $('#side-menu-1').fadeIn(500);
                $('#side-menu-2').fadeOut(0);
            }
        });
    
    
  </script>
        
    </body>
    
</html>
