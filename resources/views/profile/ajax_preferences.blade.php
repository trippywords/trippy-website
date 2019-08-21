<div class="connection-main-section ajaxfollowerlist1">
<?php  
    if (count($preferences) > 0) { ?>
        <div id="preference_more">
            @foreach($preferences as $pg)
                @php 
                $selected="";
                $checked="";
                @endphp
                @if(isSelectedgenres($pg->id)>=1)
                    @php 
                        $selected=" style=color:black"; 
                        $checked=" checked";
                    @endphp
                @else
                    @php 
                        $selected="";
                        $checked="";
                    @endphp
                @endif
                <div class="prefrence-toggle-main display-flex-custom">
                    <div class="tabcontent-title" {{ $selected }}><a class="plusclick" style="color:#58bb47;font-weight: bolder;font-size:15px ;display:none;" data-toggle="collapse" href="#collapse{{ $pg->id }}"> + </a>  {{ $pg->name }}</div>
                    <div class="switch-main">
                        <label class="switch">
                            <input type="checkbox" class="toggle-input pgclass" data-pid="{{ $pg->parent_genre_id }}"  data-val="{{ $pg->name}}" id="pg_{{ $pg->id }}" name="parrentgen[{{ $pg->id }}]"  value="{{ $pg->id }}"  {{ $checked }} />
                            <span class="slider round"></span>
                        </label>
                    </div>
                </div>
            @endforeach
        </div>    
    <?php } else { ?>
        <div class="profile_main_section no_any_content d-flex align-items-center justify-content-center profile-bg">
            <span>
                <img src="{{ asset('/') }}public/blog_img/no-blog.png"  alt="{!!Auth::user()->name !!}" height="100px" widht="100px" >
            </span>
            <p class="content_text">Awww ! no preferences.</p>
        </div>
    <?php } ?>
</div> 
<div class="ajaxpreferenceslistza">
    <div class="ajax-load text-center" id="ajax-load-preferences" style="display:none">
        <p><img src="http://demo.itsolutionstuff.com/plugin/loader.gif">Loading More post</p>
    </div>
    <?php if (isset($preferences_total) && intval($preferences_total) > 0) { ?>
        <div class="blog_button">
            <a href="javascript:;" class="btn btn-primary" id="load_more_preferences" title="Load More" data-page="{{ $page }}">
                LOAD MORE
            </a>
        </div>
    <?php } ?> 
</div>  