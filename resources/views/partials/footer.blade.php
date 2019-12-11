</div>
<footer>
<?php if(Auth::guard('web')->user()==null){ ?>
	<div class="subscribe-mail">
		<div class="container">
			<div class="row center-newsletter">
                <div class="col-lg-7 col-sm-6">
                    <div class="subscribe-content">Subscribe to our Newsletter</div>
                </div>
                <div class="col-lg-5 col-sm-6">
                	<div id="news_success">Newsletter subscribed</div>
                    <div id="news_resuccess">Newsletter already subscribed</div>
                    <div id="news_email_enter">Please Enter Your Valid Email</div>
                    <form method="post" id="frmnewsletter">
                        @csrf
                        <div class="input-group">
                            <input type="email" value="" class="form-control form-control1" name="newsletter_email" id="newsletter_email" placeholder="Subscribe Newsletter">
	                        <div class="input-group-btn">
	                            <button class="btn btn-primary sub_btn" id="submit_subscribe" type="button">Subscribe</button>
	                        </div> 
                        </div>
                        <label id="newsletter_email-error" class="error" for="newsletter_email"></label>
                		<!-- <h6 class="newsletter-error" id="result"></h6>   -->
                    </form>
                </div>
            </div>
		</div>
	</div> 
<?php } ?>
	<div class="footer-section">
		<div class="container">
		@php
			$settings = getSettings();
		@endphp
			<div class="social_icon">
				<?php $is_first_login = Session::get('is_first_login'); ?>
				<a <?php if(isset($is_first_login) && intval($is_first_login) ==1 ){ ?> href="javascript:void(0);" <?php }else{ ?>  href="{{ route('contactus') }}" <?php } ?> title="Contact Us" class="icon">
					<i class="fa fa-phone"></i>
				</a>
				<a href="{{addhttp($settings->site_facebook)}}" target="_blank" title="Facebook" class="icon">
					<i class="fa fa-facebook"></i>
				</a>
				<a href="{{addhttp($settings->site_twitter)}}" target="_blank" title="Twitter" class="icon">
					<i class="fa fa-twitter"></i>
				</a>
				<a href="{{addhttp($settings->site_linkedin)}}" target="_blank" title="Linkedin" class="icon">
					<i class="fa fa-linkedin"></i>
				</a>
				<a href="{{addhttp($settings->site_instagram)}}" target="_blank" title="instagram" class="icon">
					<i class="fa fa-instagram"></i>
				</a>
				<a href="{{addhttp($settings->site_google)}}" target="_blank" title="Google Plus" class="icon">
					<i class="fa fa-google-plus"></i>
				</a>
			</div>
			<div class="copyright-main">
				<div class="copyright_section">
					<div class="copyright" style="text-transform:capitalize">Copyright &copy; 2019 All Rights Reserved. &nbsp;&nbsp;&nbsp;
					</div>
				</div>
			</div>
		</div>
		</div>
	</div>
</footer>
<script src="{{ asset('js/jquery.validate.min.js') }}"></script>
<script type="text/javascript">       
$(document).ready(function(){
	 $("#submit_subscribe").click(function(){
        $("#frmnewsletter").validate({
            rules: {
                newsletter_email: {
                    required: true,
                    customemail:true
                }
            },
            messages: {
            	newsletter_email: {
            		required: 'Please enter a valid email address',
            		customemail: "Please enter a valid email address"
            	}		
            }          
        });
    });
    setTimeout(fade_out, 5000);
	function fade_out() {
	  $("#newsletter_email-error").fadeOut().empty();
	}


	$.validator.addMethod("customemail", 
		function(value, element) {
    		var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	  		return re.test(value);
	});

	/*Email validation starts*/
	function validateEmail(email) {
	  var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	  return re.test(email);
	}

	$('#submit_subscribe').on('click',function(){
		$("#result").text("");
	  	if ($("#frmnewsletter").valid() == true) {
			var newsletter_email =$('#newsletter_email').val();
			$.ajax({
				url: "{{route('newsletter')}}",
				type:"POST", 
				data: {'newsletter_email': newsletter_email,'_token':$('meta[name="csrf-token"]').attr('content')},
				success: function (result) {  
					if(result==1){
						var x = document.getElementById("news_success");
		                x.className = "show";
		                setTimeout(
		                    function(){ 
		                        x.className = x.className.replace("show", ""); 
		                    }, 5000);
		                setTimeout(function(){location.reload();}, 1000);
		                return false;	
					}else{
						if(result==2){
							var x = document.getElementById("news_email_enter");
			                x.className = "show";
			                setTimeout(
			                    function(){ 
			                        x.className = x.className.replace("show", ""); 
			                    }, 5000);
			                setTimeout(function(){location.reload();}, 1000);
			                return false;
		                }else{
		                	var x = document.getElementById("news_resuccess");
			                x.className = "show";
			                setTimeout(
			                    function(){ 
			                        x.className = x.className.replace("show", ""); 
			                    }, 5000);
			                setTimeout(function(){location.reload();}, 1000);
			                return false;
		                }	
					}                                                          
				}
			});
	  	}
	  	return false;
	});
 });   
</script>