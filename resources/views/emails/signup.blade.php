@extends('emails.common')

@section('content')

<div style="padding-left: 30px; padding-right: 30px; padding-top: 30px; text-align: center;">

              <!-- Body section -->  

  <div style="font-size: 25px;color: #707070;line-height: 120%;margin-bottom: 30px;">          

        Welcome<span style="color: #2e2e2e;"></span> to <span style="color: #58ba47">Trippy</span><span style="color: #25aae1">Words</span>.com

    </div>

   <div style="font-size: 19px;color: #707070;line-height: 120%;margin-bottom: 30px;">              

        Thank you for creating an account.<br>

        <span style="font-size: 15px;color: #707070">Please activate it by clicking below.</span>

    </div>

    <div style="width:290px; margin: auto;">                

        <a href="{{ url('accountactivate/'.$user_id.'/'.$token_key) }}" style="font-size: 18px;text-transform: uppercase;letter-spacing: 1px;padding: 10px 0px;background: #58ba47;text-decoration: none; color: #fff;border-radius: 5px;cursor: pointer;display: block;">                   

           Activate Your Account

        </a>

    </div>

    <div style="text-align: center; margin: 30px 0px">                 

        <img src="https://www.trippywords.com/demo/public/assets/email-template/image/gift.png" style="width:400px; height: 300px" />

    </div>

<div style="width: 100%; border-top: 1px solid #cccccc; margin: 30px 0px"></div>

@endsection            