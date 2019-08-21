//////////////////////////////////////////////////////
//  Template Name: octAdmin
//  Author: octathemes
//  Email: octathemes@gmail.com
//  File: table-datatable-example.js
///////////////////////////////////////////////////
$(function () {    
    "use strict";

    $('#table-user').DataTable({
        "scrollX": true,
        processing: true,
        serverSide: false,
        ordering: false,
        dom: 'Bfrtip',
        "ajax": ADMIN_URL+'/users/getdata',
        columns: [
            {data: 'id', name: 'id'},
            {data: 'profile_image', name: 'profile_image'},             
            {data: 'name',searchable:true, name: 'name'},
            {data: 'email', name: 'email'},            
            
            {data: 'created_at', name: 'created_at'},
            {data: 'last_login', name: 'last_login'},
            {data: 'is_verified', name: 'is_verified'},
            {data: 'action', name: 'action'},
        ],/*
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]*/
        buttons: [
            {
                extend: 'copyHtml5',
                exportOptions: {
                    columns: [ 0, 2, 3, 4, 5, 6 ],

                },
                title: null
            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: [ 0, 2, 3, 4, 5, 6 ]
                },
                filename: function(){
                    var d = new Date();
                    var n = d.getDate();
                    var m = d.getMonth()+1;
                    var y = d.getFullYear();
                    return 'Trippywords_User - ' + n + '-' + m + '-' + y;
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