@extends('emails.common')

@section('content')

<div style="width: 600px; margin:auto; background-color: #fff; padding-bottom: 30px; border-top-left-radius: 10px; border-top-right-radius: 10px; box-shadow: 0px 0px 10px 1px #00000021; margin-bottom: 30px;">



            <div style="width: 100%;padding: 20px 0px;text-align: center;background: #25aae1;border-top-left-radius: 0;border-top-right-radius: 0;">            



                <div style="font-size: 30px;color: #ffffff;line-height: 120%;margin-bottom: 0px;text-transform: uppercase;letter-spacing: 4px;">                



                    UPDATE EMAIL CONFIRMATION



                </div>



            </div>



            <div style="padding-left: 30px; padding-right: 30px; padding-top: 30px; text-align: center;">



                <div style="font-size: 19px;color: #707070;line-height: 120%;margin-bottom: 30px;">             



                    Hey <span style="color: #2e2e2e;">{{ ucfirst($user_name) }}</span>,Simply click the button to verify your email.



                </div>



                <div style="width:290px; margin: auto;">                



                    <a href="{{ url('accountactivate/'.$user_id.'/'.$token_key) }}" style="font-size: 18px;text-transform: uppercase;letter-spacing: 1px;padding: 10px 0px;background: #58ba47;text-decoration: none; color: #fff;border-radius: 5px;cursor: pointer;display: block;">                   



                       Verify Email Address



                </a>



            </div>



            <div style="width: 100%; border-top: 1px solid #cccccc; margin: 30px 0px"></div>

@endsection   