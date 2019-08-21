@extends('layouts.app')

@section("title","Preferences")

@section('content')



<!-- main.css | /* Prefrence Section S */ -->

	<section>

                                

		<div class="preference-main section-gap-half-padding">

			<div class="container">

                            <div class="rows text-right" id="errselgen">

                                @if($errors->any())

                                <h4 style="color:red">{{$errors->first()}}</h4>

                                @endif

                                </div>

				<div class="prefrence-main-box">

					<div class="prefrence-main-box-inner">

						<h2 class="main-title text-center">What are you into?</h2>

						<p class="content">Tell us what you like and we will get you the good stuff.</p>

					</div>

				</div>

                               

                                <form action="{{ route('save_user_preference') }}" method="post" >

				<div class="prefrence-sub-box-main">

                                    @php

                                    $counter=0

                                    @endphp

                                    @foreach($genres as $genre)                                    

                                        

                                        @if($counter<10)

                                        

					<div class="prefrence-sub-box">

						<label class="prefrence-sub-box-inner">

                                                    <input type="checkbox" class="box-inner-input" name="gen[{{ $genre->id }}]" id="gen_{{$genre->id}}">

							<span class="prefrence-text">{{ $genre->name }}</span>

							<span class="tick"></span>

						</label>

					</div>	

                                        

                                        @else

                                    

                                     <div class="prefrence-sub-box-bottom">

						<div class="prefrence-sub-box">

							<label class="prefrence-sub-box-inner">

								<input type="checkbox" class="box-inner-input" name="gen[{{ $genre->id }}]" id="gen_{{$genre->id}}">

                                                                <span class="prefrence-text">{{ $genre->name }}</span>

								<span class="tick"></span>

							</label>

						</div>		

                                                

                                    </div>

                                        

                                        @endif

                                    @php $counter++ @endphp

                                    @endforeach

                                    

                                    @csrf

                                    <div class="prefrence-sub-box-bottom btn-center">

                                        <input type="submit" class="btn btn-primary" value="&nbsp;&nbsp;&nbsp;&nbsp;Continue&nbsp;&nbsp;&nbsp;&nbsp;" style="margin-top:110px" />

                                    </div>    

				</div>

                                        

                                   

                            </form>

			</div>

                        

		</div>

            

	</section>

            

@endsection

<script>

setTimeout(function(){

        $("#errselgen").hide();

    }, 5000 ); // 5 secs



</script>    