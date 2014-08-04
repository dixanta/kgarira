</div>

    <div id="content-wrapper">

        <div class="my-container">
           
            <div class="row">
              <div class="col-sm-3">
              </div>
   
              <div class="col-sm-9 body">
                 
                  
                  <div class="col-sm-12">
                      
                      <h2>Contact Us</h2>
                    
                    <div class = "col-sm-6">
                      <form action="" method="post" name="sender-detail-form">
                            <div class="form-wrapper">
                            <div class="control-row" >
                            <input type="text" name="name" id="name" value="<?php echo set_value('name')?>" class="input-block-level" placeholder="Name">
    <span class="text-error"><?php echo form_error('name')?></span>
                            </div>
                            </div>
                            <div class="form-wrapper">
                            <div class="control-row" >
                          <input type="text" name="email" value="<?php echo set_value('email')?>" class="input-block-level" placeholder="Email">
    <span class="text-error"><?php echo form_error('email')?></span>
                            </div>
                            </div>
                            <div class="form-wrapper">
                            <div class="control-row" >
                           <label>Message</label> 
    <textarea name="message" class="input-block-level" rows="8" cols="50"><?php echo set_value('message')?></textarea>
     <span class="text-error"><?php echo form_error('message')?></span>
                            </div>
                           <div class= "control-row">
                            <label for="recaptcha_response_field">Captcha:</label>
    <span id="display-captcha" style="line-height:6px"><?php print $captcha?></span>
   <span class="text-error"><?php echo form_error('recaptcha_response_field')?></span>
                            </div>
                           <input name="submit" type="submit" id="submit" value="Send" class="btn btn-primary"/> 
                            </div>
                    </div>
                      
                  </div>
              </div>
            </div>
        </div>
    </div>  <!--Content Wrapper--> 

