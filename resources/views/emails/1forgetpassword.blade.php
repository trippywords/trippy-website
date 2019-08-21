@extends('emails.common')
@section('content')
    <div style="padding-left: 30px; padding-right: 30px; padding-top: 30px; text-align: center;">
        <div style="font-size: 19px;color: #707070;line-height: 120%;margin-bottom: 30px;">				
            Hey <span style="color: #2e2e2e;">{{ ucfirst($user_name) }}</span>, <span style="color: #58ba47">Trippy</span><span style="color: #25aae1">Words</span>.Simply click the button to Reset your password.
        </div>
        <div style="width:290px; margin: auto;">				
            <a href="{{ url('resetpassword/'.$token_key) }}" style="font-size: 18px;text-transform: uppercase;letter-spacing: 1px;padding: 10px 0px;background: #58ba47;text-decoration: none;color: #fff;border-radius: 5px;cursor: pointer;display: block;">					
                    Reset Password
            </a>
        </div>
@endsection