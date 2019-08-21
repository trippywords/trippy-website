<!DOCTYPE html><html><head><title>TrippyWords</title></head>
    <body style="font-family: arial; background-color: #f4f4f4; margin: 0px; padding: 0px;">
        <div style="text-align: center; margin: 30px 0px;">                 
            <img src="https://www.trippywords.com/demo/public/assets/email-template/image/logo.png" style="width:300px" />
        </div>
        <div style="width: 600px; margin:auto; background-color: #fff; padding-bottom: 30px; border-top-left-radius: 10px; border-top-right-radius: 10px; box-shadow: 0px 0px 10px 1px #00000021; margin-bottom: 30px;">
            <div style="width: 100%;padding: 20px 0px;text-align: center;background: #25aae1;border-top-left-radius: 0;border-top-right-radius: 0;">            
                <div style="font-size: 20px;color: #ffffff;line-height: 120%;margin-bottom: 0px;text-transform: uppercase;letter-spacing: 4px;">                
                   TrippyWords
                </div>
            </div>
            @yield('content')  
            <div style="text-align: center;">  
                 <!-- Footer Section -->
                 @php
                    $settings = getSettings();
                @endphp   
                @if(isset($settings->site_facebook) && $settings->site_facebook!='')  
                    <div style="display: inline-block;">                    
                        <a href="{{$settings->site_facebook}}" title="Facebook">                        
                            <img src="https://www.trippywords.com/demo/public/assets/email-template/image/icon-facebook.png" style="width: 40px; margin-right: 15px;">
                        </a>
                    </div>
                @endif 
                @if(isset($settings->site_twitter) && $settings->site_twitter!='')     
                    <div style="display: inline-block;">                    
                        <a href="{{$settings->site_twitter}}" title="Twitter">                      
                            <img src="https://www.trippywords.com/demo/public/assets/email-template/image/icon-twitter.png" style="width: 40px; margin-right: 15px;">
                        </a>
                    </div>
                @endif 
                @if(isset($settings->site_instagram) && $settings->site_instagram!='')    
                    <div style="display: inline-block;">                    
                        <a href="{{$settings->site_instagram}}" title="Instagram">                      
                            <img src="https://www.trippywords.com/demo/public/assets/email-template/image/icon-instagram.png" style="width: 40px; margin-right: 15px;">
                        </a>
                    </div>
                @endif 
                @if(isset($settings->site_linkedin) && $settings->site_linkedin!='') 
                    <div style="display: inline-block;">                    
                        <a href="{{$settings->site_linkedin}}" title="Linkedin">                        
                            <img src="https://www.trippywords.com/demo/public/assets/email-template/image/icon-linkedin.png" style="width: 40px;">
                        </a>
                    </div>
                @endif
            </div>  
        </div>
    </div>
    <div style="text-align: center; font-size: 12px; color: #707070; line-height: 145%; margin-bottom: 30px;">      
        Email sent by <a href="{{ url("/") }}" target="_blank" style="text-decoration: none;"><span style="color: #58ba47">Trippy</span><span style="color: #25aae1">Words</span></a>
        <br>
        Copyright &copy; {{ date('Y') }} Trippywords - All Rights Reserved.
    </div>
</body>
</html>