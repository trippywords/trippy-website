//////////////////////////////////////////////////////
//  Template Name: octAdmin
//  Author: octathemes
//  Email: octathemes@gmail.com
//  File: table-datatable-example.js
///////////////////////////////////////////////////
$(function () {
    "use strict";

    $('#table-genre').DataTable({
        "scrollX": true,
        processing: true,
        serverSide: false,
        ordering: false,
        dom: 'Bfrtip',
        "ajax": ADMIN_URL+'/genre/getdata',
        columns: [
            {data: 'id', name: 'id'},
            {data: 'img', name: 'Img'},
            {data: 'name', name: 'Name'},
            {data: 'parent_genre_id', name: 'parent_genre_id'},            
            {data: 'created_at', name: 'created_at'},
            {data: 'updated_at', name: 'updated_at'},
            {data: 'is_published', name: 'is_published'},
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
                    columns: [ 0, 1, 2, 3, 4, 5, 6 ],
                    
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



