@extends('emails.common')
@section('content')

            <div style="padding-left: 30px; padding-right: 30px; padding-top: 30px; text-align: center;">
              <!-- Body section -->  
              <div style="font-size: 25px;color: #707070;line-height: 120%;margin-bottom: 30px;">          
                    Welcome<span style="color: #2e2e2e;"></span> to <span style="color: #58ba47">Trippy</span><span style="color: #25aae1">Words</span>.com
                </div>
               <div style="font-size: 19px;color: #707070;line-height: 120%;margin-bottom: 30px;">       

                    Hey <span style="color: #2e2e2e;">{{ ucfirst($user_name) }},</span> <br>      
                     Simply click the button to Reset your password.  
                </div>
                <div style="width:290px; margin: auto;">                
                    <a href="{{ url('resetpassword/'.$token_key) }}" style="font-size: 18px;letter-spacing: 1px;padding: 10px 0px;background: #58ba47;text-decoration: none;color: #fff;border-radius: 5px;cursor: pointer;display: block;">                  
                       Reset Password
                </a>
                </div>
            <div style="width: 100%; border-top: 1px solid #cccccc; margin: 30px 0px"></div>
@endsection            