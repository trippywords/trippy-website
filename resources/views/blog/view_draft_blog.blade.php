@if(!$draft_blogs->isEmpty())
        @foreach ($draft_blogs as $blog)
        <tr>
            <td class="checkbox_td draft_td">
                <label class="checkbox-inline ad-checkbox-inline delete_btn" style="display: none;">
                    <div class="ad-checkbox">
                        <input type="checkbox" class="chk" value="{{$blog->id}}">
                        <span></span>
                    </div>
                </label>
            </td>
            <td>
                <!-- <a href="" title="Draft">Draft</a> -->
                <span class="text_font_primary">{{ str_limit($blog->blog_title,30)}}</span>
            </td>
            <td class="text_content">
                <span class="text_font_secondary">{{ strip_tags(str_limit(isset($blog->blog_description)?$blog->blog_description:"", 30)) }}</span>
            </td>
            <td class="date_td date_edit_td">
                {{date('M d', strtotime($blog->created_at))}}
            </td>
            <td class="delete_btn" style="display:none;">
                <a href="{{ url('draft-edit/'.$blog->blog_slug) }}" class="edit" title="Edit">
                        <i class="fa fa-pencil-square"></i>
                </a>
                <a onclick="delete_draft('{{ $blog->id }}')" class="trash" title="Delete"> 
                    <i class="fa fa-trash"></i>
                </a>
            </td>
        </tr>
        @endforeach
@endif
@if(!$draft_blogs->isEmpty())
    @if(isset($draft_total) && $draft_total > 0)
    <div class="blog_button">
        <a href="javascript:;" class="btn btn-primary" id="loadmore_draft_blog" title="Load More" data-page="{{ $page }}">
            LOAD MORE
        </a>
    </div>
   @endif
@else
    <div class="profile_main_section no_any_content d-flex align-items-center justify-content-center" style="background-color:#fff !important;">
        <span>
            <img src="{{ asset('/') }}public/blog_img/no-blog.png"  alt="{!!Auth::user()->name !!}" height="100px" widht="100px" >
        </span>
            <p class="content_text">Awww ! no draft. Write now <span>Click on compose button to create a new draft</span></p>
    </div>
    @endif
<script>
    $(document).ready(function () {
        var arrayOfValues = [];
        $("body").on('click', '.action_multiple', function () {
            var total = $('.chk:checked').length;
            if (total == 0) {
                alert('Please select at least one record !!');
            }else{
           
            $('.chk:checked').each(function () {
                    arrayOfValues.push($(this).val());
            }).get();
               delete_draft_multiple(arrayOfValues);
            }
        });
    });
</script>