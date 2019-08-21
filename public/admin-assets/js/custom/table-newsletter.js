//////////////////////////////////////////////////////
//  Template Name: octAdmin
//  Author: octathemes
//  Email: octathemes@gmail.com
//  File: table-datatable-example.js
///////////////////////////////////////////////////
$(function () {    
    "use strict";

    $('#table-newsletter').DataTable({
        "scrollX": true,
        processing: true,
        serverSide: false,
        ordering: false,
        dom: 'Bfrtip',
        "ajax": ADMIN_URL+'/newsletter/getdata',
        columns: [
            {data: 'id', name: 'id'},            
            {data: 'newsletter_email', name: 'newsletter_email'},            
            
            {data: 'created_at', name: 'created_at'},  
            {data: 'is_delete', name: 'is_delete'},          
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
                    return 'Trippywords_Newsletter - ' + n + '-' + m + '-' + y;
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