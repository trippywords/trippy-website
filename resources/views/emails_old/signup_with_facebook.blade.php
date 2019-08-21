<!DOCTYPE html><html><head><title>TrippyWords</title></head>
<body style="font-family: arial; background-color: #f4f4f4; margin: 0px; padding: 0px;">
    <div style="text-align: center; margin: 30px 0px;">                 
        <img src="{{ asset('/public/assets/image/logo.png')}}" style="width:300px" />
   </div>
    <div style="width: 600px; margin:auto; background-color: #fff; padding-bottom: 30px; border-top-left-radius: 10px; border-top-right-radius: 10px; box-shadow: 0px 0px 10px 1px #00000021; margin-bottom: 30px;">
    <div style="width: 100%;padding: 20px 0px;text-align: center;background: #25aae1;border-top-left-radius: 0;border-top-right-radius: 0;">            
    <div style="font-size: 30px;color: #ffffff;line-height: 120%;margin-bottom: 0px;text-transform: uppercase;letter-spacing: 4px;">                
    Registrataion
    </div>
    </div>
    <div style="padding-left: 30px; padding-right: 30px; padding-top: 30px; text-align: center;">
    <div style="font-size: 19px;color: #707070;line-height: 120%;margin-bottom: 30px;">             
    Hey <span style="color: #2e2e2e;">{{ $first_name }} {{ $last_name }}</span>, thanks for registration <br/> with <span style="color: #58ba47">Trippy</span><span style="color: #25aae1">Words</span>.<br/> Please find your credential below,
    </div>
    <div style="width:290px; margin: auto;">                
        <span style="color: #25aae1">Email : {{ $email }}</span><br>
        <span style="color: #25aae1">Password : {{ $new_password }}</span>
    </div>
    <div style="width: 100%; border-top: 1px solid #cccccc; margin: 30px 0px"></div>
    <div style="display: flex; justify-content: center;">    
@php
            $settings = getSettings();
        @endphp   
    <div>                   
        <a href="{{ route('contactus') }}" title="Contact Us" class="icon" style="width: 40px; margin-right: 15px;">
                    <i class="fa fa-phone"></i>
                </a>
    </div>
    <div>                   
        <a href="{{addhttp($settings->site_facebook)}}" target="_blank" title="Facebook" class="icon" style="width: 40px; margin-right: 15px;">
                    <i class="fa fa-facebook"></i>
                </a>
    </div>
    <div>                   
        <a href="{{addhttp($settings->site_twitter)}}" target="_blank" title="Twitter" class="icon" style="width: 40px; margin-right: 15px;">
                    <i class="fa fa-twitter"></i>
                </a>
    </div>
    <div>                   
        <a href="{{addhttp($settings->site_linkedin)}}" target="_blank" title="Linkedin" class="icon" style="width: 40px; margin-right: 15px;">
                    <i class="fa fa-linkedin"></i>
                </a>
    </div>
    <div>                   
        <a href="{{addhttp($settings->site_instagram)}}" target="_blank" title="instagram" class="icon" style="width: 40px; margin-right: 15px;">
                    <i class="fa fa-instagram"></i>
                </a>
    </div>
<div>                   
        <a href="{{addhttp($settings->site_google)}}" target="_blank" title="Google Plus" class="icon" style="width: 40px; margin-right: 15px;">
                    <i class="fa fa-google-plus"></i>
                </a>
    </div>
    </div>  
    </div>
    </div>
    <div style="text-align: center; font-size: 12px; color: #707070; line-height: 145%; margin-bottom: 30px;">      
    Email sent by <span style="color: #58ba47">Trippy</span><span style="color: #25aae1">Words</span>       
    <br>
    Copyright &copy; {{ date('Y') }} StayRunners - All Rights Reserved.
    </div>
    </body>
</html>
