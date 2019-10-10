//////////////////////////////////////////////////////
//  Template Name: octAdmin
//  Author: octathemes
//  Email: octathemes@gmail.com
//  File: table-datatable-example.js
///////////////////////////////////////////////////
$(function () {    
    "use strict";

    $('#table-blog').DataTable({
        "scrollX": true,
        processing: true,
        serverSide: false,
        ordering: false,
        dom: 'Bfrtip',
        "ajax": ADMIN_URL+'/recommended-blog/getdata',
        columns: [
            {data: 'id', name: 'id'},
            {data: 'blog_image', name: 'blog_image'},            
            {data: 'blog_title', name: 'blog_title'},
            {data: 'blog_genre', name: 'blog_genre'}, 
            {data: 'created_at', name: 'created_at'}, 
            {data: 'created_by', name: 'created_by'},
            {data: 'blog_status', name: 'blog_status'},                      
            {data: 'is_featured', name: 'is_featured'},                      
            {data: 'is_trending', name: 'is_trending'},                      
            {data: 'is_recommended', name: 'is_recommended'},                      
            {data: 'action', name: 'action'},
        ],
        /*buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]*/
        buttons: [
            {
                extend: 'copyHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6 ],
                    /*<img src='{{ asset('public/blog_img/'.$blog->blog_image) }}' >*/
                },
                title: null
            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6 ],
                     
                },
                filename: function(){
                    var d = new Date();
                    var n = d.getDate();
                    var m = d.getMonth()+1;
                    var y = d.getFullYear();
                    return 'Trippywords_Blog - ' + n + '-' + m + '-' + y;
                },
                title: null
            },
            {
                extend: 'csvHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6 ]
                },
                title: null
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6 ]
                },
                title: null
            }
        ]
    });
});