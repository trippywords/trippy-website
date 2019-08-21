@extends('emails.common')
@section('content')
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
@endsection     