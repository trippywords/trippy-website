//////////////////////////////////////////////////////
//  Template Name: octAdmin
//  Author: octathemes
//  Email: octathemes@gmail.com
//  File: table-datatable-example.js
///////////////////////////////////////////////////
$(function () {    
    "use strict";

    $('#table-contactus').DataTable({
        "scrollX": true,
        processing: true,
        serverSide: false,
        ordering: false,
        dom: 'Bfrtip',
        "ajax": ADMIN_URL+'/contactus/getdata',
        columns: [
            {data: 'id', name: 'id'}, 
            {data: 'name', name: 'name'},           
            {data: 'email', name: 'email'}, 
            {data: 'message', name: 'message'},           
            {data: 'created_at', name: 'created_at'},            
            {data: 'is_deleted', name: 'is_deleted'},
            {data: 'action', name: 'action'},
        ],
        /*buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
          */
         buttons: [
            {
                extend: 'copyHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4],

                },
                title: null
            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4]
                },
                filename: function(){
                    var d = new Date();
                    var n = d.getDate();
                    var m = d.getMonth()+1;
                    var y = d.getFullYear();
                    return 'Trippywords_Contactus - ' + n + '-' + m + '-' + y;
                },
                title: null
            },
            {
                extend: 'csvHtml5',
                exportOptions: {
                    columns: [ 0, 2, 3, 4, 5, 6 ]
                },
                title: null
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: [ 0, 2, 3, 4, 5, 6 ]
                },
                title: null
            }
        ]
    });
});