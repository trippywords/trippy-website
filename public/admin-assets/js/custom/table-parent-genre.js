//////////////////////////////////////////////////////
//  Template Name: octAdmin
//  Author: octathemes
//  Email: octathemes@gmail.com
//  File: table-datatable-example.js
///////////////////////////////////////////////////
$(function () {
    "use strict";
    //alert("hello");
    $('#table-parent-genre').DataTable({

        "scrollX": true,
        processing: true,
        serverSide: false,
        ordering: false,
        stateSave: true,
        dom: 'Bfrtip',
        "ajax": ADMIN_URL+'/parent-genre/getdata',
        columns: [
            {data: 'id', name: 'id'},
            
            {data: 'parent_name', name: 'Name'},
                    
            {data: 'created_at', name: 'created'},
            
            {data: 'is_published', name: 'Published'},
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
                    return 'Trippywords_Parent_Genre - ' + n + '-' + m + '-' + y;
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



