//////////////////////////////////////////////////////
//  Template Name: octAdmin
//  Author: octathemes
//  Email: octathemes@gmail.com
//  File: table-datatable-example.js
///////////////////////////////////////////////////
$(function () {
    "use strict";
    //alert("hello");
    $('#table-child-genre').DataTable({

        "scrollX": true,
        processing: true,
        serverSide: false,
        ordering: false,
        stateSave: true,
        dom: 'Bfrtip',
        "ajax": ADMIN_URL+'/child-genre/getdata',
        columns: [
            {data: 'id', name: 'id'},
            {data:'img',name:'Img'},
            {data:'child_genre_name',name:'child_genre_name'},
            {data: 'parent_genre_id', name: 'parent_genre_id'}, 
            {data: 'is_published', name: 'is_published'}, 
            {data: 'created_at', name: 'created_at'},
            {data: 'action', name: 'Actions'},
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
                    columns: [ 0, 1, 2, 3 ],
                    
                },
                title: null
            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2, 3 ],
                     
                },
                filename: function(){
                    var d = new Date();
                    var n = d.getDate();
                    var m = d.getMonth()+1;
                    var y = d.getFullYear();
                    return 'Trippywords_Child_Genre - ' + n + '-' + m + '-' + y;
                },
                title: null
            },
            {
                extend: 'csvHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2, 3 ]
                },
                title: null
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2, 3 ]
                },
                title: null
            }
        ]
    });
});



