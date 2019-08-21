<!DOCTYPE html><html><head><title>TrippyWords</title></head>
    <body style="font-family: arial; background-color: #f4f4f4; margin: 0px; padding: 0px;">
        <div style="text-align: center; margin: 30px 0px;">					
            <img src="http://test.trippywords.com/public/assets/email-template/image/logo.png" style="width:300px" />
        </div>
        <div style="width: 600px; margin:auto; background-color: #fff; padding-bottom: 30px; border-top-left-radius: 10px; border-top-right-radius: 10px; box-shadow: 0px 0px 10px 1px #00000021; margin-bottom: 30px;">
            <div style="width: 100%;padding: 20px 0px;text-align: center;background: #25aae1;border-top-left-radius: 0;border-top-right-radius: 0;">			
                <div style="font-size: 30px;color: #ffffff;line-height: 120%;margin-bottom: 0px;text-transform: uppercase;letter-spacing: 4px;">				
                    CONTACT US EMAIL
                </div>
            </div>
            <div style="padding-left: 30px; padding-right: 30px; padding-top: 30px; text-align: center;">
                <div style="font-size: 19px;color: #707070;line-height: 120%;margin-bottom: 30px;">				
                    Hey <span style="color: #2e2e2e;">{{ ucfirst($fromname) }}</span>,You have received new inquiry.<br/><br/>
                </div>
                <div style="width:290px; margin: auto;">				
                     <table border='1'>
                     <tr>
                     <td>Fullname</td>
                        <td>{{ $fullname }}</td>
                    </tr>
            
                    <tr>
                    <td>Email</td>
                    <td>{{ $email }}</td>
                    </tr>
                <tr>
                <td>Message</td>
                <td>{{ $message }}</td>
                </tr>
                </table>
                </div>
                <div style="width: 100%; border-top: 1px solid #cccccc; margin: 30px 0px"></div>
                <div style="text-align: center;">		
                @php
                $settings = getSettings();
            @endphp
            <div style="text-align: center;">       
                <div style="display: inline-block;">                    
                        <a href="{{$settings->site_facebook}}" title="Facebook">                        
                            <img src="http://test.trippywords.com/public/assets/email-template/image/icon-facebook.png" style="width: 40px; margin-right: 15px;">
                        </a>
                    </div>
                    <div style="display: inline-block;">                    
                        <a href="{{$settings->site_twitter}}" title="Twitter">                      
                            <img src="http://test.trippywords.com/public/assets/email-template/image/icon-twitter.png" style="width: 40px; margin-right: 15px;">
                        </a>
                    </div>
                    <div style="display: inline-block;">                    
                        <a href="{{$settings->site_instagram}}" title="Instagram">                      
                            <img src="http://test.trippywords.com/public/assets/email-template/image/icon-instagram.png" style="width: 40px; margin-right: 15px;">
                        </a>
                    </div>
                    <div style="display: inline-block;">                    
                        <a href="{{$settings->site_linkedin}}" title="Linkedin">                        
                            <img src="http://test.trippywords.com/public/assets/email-template/image/icon-linkedin.png" style="width: 40px;">
                        </a>
                    </div>
            </div>
            </div>	
            </div>
        </div>
        <div style="text-align: center; font-size: 12px; color: #707070; line-height: 145%; margin-bottom: 30px;">		
            Email sent by <a href="{{ url("/") }}" target="_blank" style="text-decoration: none;"><span style="color: #58ba47">Trippy</span><span style="color: #25aae1">Words</span></a>		
            <br>
            Copyright &copy; 2018 Trippywords - All Rights Reserved.
        </div>
    </body>
</html>