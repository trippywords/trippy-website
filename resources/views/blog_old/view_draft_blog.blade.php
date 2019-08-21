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
				<a href="blog/{{ $blog->blog_slug }}" title="Draft">Draft</a>
			</td>
			<td class="text_content">
				<span class="text_font_primary">{{ str_limit($blog->blog_title,30)}}</span>
				<span class="text_font_secondary">{{ str_limit($blog->blog_heading,30)}}</span>
			</td>
			<td class="date_td date_edit_td">
				{{date('M d', strtotime($blog->created_at))}}
			</td>
			<td class="delete_btn" style="display:none;">
				<a href="draft-edit/{{ $blog->blog_slug }}" class="edit" title="Edit">
						<i class="fa fa-pencil-square"></i>
				</a>
				<a onclick="delete_draft('{{ $blog->id }}')" class="trash" title="Delete"> 
					<i class="fa fa-trash"></i>
				</a>
			</td>
		</tr>
		@endforeach
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