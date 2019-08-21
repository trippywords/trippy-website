@extends('emails.common')
@section('content')
    <div style="padding-left: 30px; padding-right: 30px; padding-top: 30px; text-align: center;">
      <!-- Body section -->  
      <div style="font-size: 25px;color: #707070;line-height: 120%;margin-bottom: 30px;">          
            Welcome<span style="color: #2e2e2e;"></span> to <span style="color: #58ba47">Trippy</span><span style="color: #25aae1">Words</span>.com
        </div>
       <div style="font-size: 19px;color: #707070;line-height: 120%;margin-bottom: 30px;">       

            Hey <span style="color: #2e2e2e;">Admin,</span> <br>      
            {{ $report_to }} ({{ $report_to_email }}) has been reported by {{ $report_by }} ({{ $report_by_email }}).<br> 
        </div>
        <div style="text-align: center; margin: 30px 0px">                 
            <img src="https://www.trippywords.com/demo/public/assets/email-template/image/gift.png" style="width:400px; height: 300px" />
        </div>
    <div style="width: 100%; border-top: 1px solid #cccccc; margin: 30px 0px"></div>
@endsection            