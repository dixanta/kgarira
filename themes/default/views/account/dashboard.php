    <style type="text/css">
      .form-signin {
        max-width: 400px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }
      .form-signin input[type="text"],
      .form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
      }
	  
	  .centre{
		  padding-left:580px;
		  padding-top:300px;
		  }
	 
    </style>
<div class="centre">
        <a href="<?php echo site_url('account/event')?>"><button class="btn btn-large btn-primary" id="events" type="submit" name="submit" value="submit">My Events</button> </a>
		<button class="btn btn-large btn-primary" id="account" type="submit" name="submit" value="submit">My Account</button> 
		<button class="btn btn-large btn-primary" id="guest" type="submit" name="submit" value="submit">My Guest List</button> 
		<a href="<?php echo site_url('account/gallery')?>"><button class="btn btn-large btn-primary" id="gallery" type="submit" name="submit" value="submit">My Galleries</button> 
</div>

