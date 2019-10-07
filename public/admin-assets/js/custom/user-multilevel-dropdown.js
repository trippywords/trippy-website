//Creating multilevel dropdown dynamic
 $(document).ready(function(){
      
            $('select[name="parent_genre_id"]').on('change',function(){
                var id=$(this).val();
                
                if(id)
                {
                    //console.log(id);
                    $.ajax({
                        //url: ADMIN_URL+'/adminpanel/blog/ajax'+id,
                        type:'GET',
                        dataType:'json',

                        url:"{{url('../dashboard/blog/ajax')}}?id="+id,
                         
                        success:function(data)
                        {
                            console.log(data);
                            $('select[name="blog_genre"]').empty();
                            $.each(data,function(key,value){
                            $('select[name="blog_genre"]').append('<option value="'+key+'">'+value+'</option>');
                            
                               });                   
                        },
                        error: function (e) {
                    
                    console.log("ERROR: ", e);
                }

                    });
                }
                else{
                    $('select[name="blog_genre"]').empty();
                }
            });
        });  