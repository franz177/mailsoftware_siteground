var TableDatatablesResponsive = function () {

    var initTable1 = function () {
        var table = $('#sample_1');

        var oTable = table.dataTable({
            // Internationalisation. For more info refer to http://datatables.net/manual/i18n
            "language": {
                "aria": {
                    "sortAscending": ": attivare per ordinare la colonna in ordine crescente",
                    "sortDescending": ": attivare per ordinare la colonna decrescente"
                },
                "emptyTable": "Nessun dato trovato nella Tabella",
                "info": "Visualizzati da _START_ a _END_ di _TOTAL_ record",
                "infoEmpty": "Nessuna voce trovata",
                "infoFiltered": "(Filtrato 1 di _MAX_ record totali)",
                "lengthMenu": "_MENU_ Righe",
                "search": "Cerca:",
                "zeroRecords": "Nessuna corrispondenza trovata"
            },

            // Or you can use remote translation file
            //"language": {
            //   url: '//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Portuguese.json'
            //},

            // setup buttons extentension: http://datatables.net/extensions/buttons/
            buttons: [
                { extend: 'print', className: 'btn dark btn-outline' },
                { extend: 'pdf', className: 'btn green btn-outline' },
                { extend: 'excel', className: 'btn purple btn-outline ' }
            ],

            // setup responsive extension: http://datatables.net/extensions/responsive/
            // setup responsive extension: http://datatables.net/extensions/responsive/
            responsive: {
                details: {
                    type: 'column',
                    target: 'tr'
                }
            },
            columnDefs: [
                { className: 'control', orderable: false, targets:   0 },
                { width: '5%', targets: 1},
                { width: '25%', targets: 2},
            ],

//            order: [ 0, 'desc' ],

            "lengthMenu": [
                [5, 10, 15, 20, -1],
                [5, 10, 15, 20, "All"] // change per page values here
            ],
            // set the initial value
            "pageLength": 10,

            "dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'B f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>", // horizobtal scrollable datatable

            // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
            // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js).
            // So when dropdowns used the scrollable div should be removed.
            //"dom": "<'row' <'col-md-12'T>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
        });
    }


    var initTable2 = function () {
        var table = $('#sample_2');

        var oTable = table.dataTable({
            // Internationalisation. For more info refer to http://datatables.net/manual/i18n
            "language": {
                "aria": {
                    "sortAscending": ": attivare per ordinare la colonna in ordine crescente",
                    "sortDescending": ": attivare per ordinare la colonna decrescente"
                },
                "emptyTable": "Nessun dato trovato nella Tabella",
                "info": "Visualizzati da _START_ a _END_ di _TOTAL_ record",
                "infoEmpty": "Nessuna voce trovata",
                "infoFiltered": "(Filtrato 1 di _MAX_ record totali)",
                "lengthMenu": "_MENU_ Righe",
                "search": "Cerca:",
                "zeroRecords": "Nessuna corrispondenza trovata"
            },

            // Or you can use remote translation file
            //"language": {
            //   url: '//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Portuguese.json'
            //},

            // setup buttons extentension: http://datatables.net/extensions/buttons/
            buttons: [
                { extend: 'print', className: 'btn dark btn-outline' },
                { extend: 'pdf', className: 'btn green btn-outline' },
                { extend: 'excel', className: 'btn purple btn-outline ' }
            ],

            // setup responsive extension: http://datatables.net/extensions/responsive/
            // setup responsive extension: http://datatables.net/extensions/responsive/
            responsive: {
                details: {
                    type: 'column',
                    target: 'tr'
                }
            },
            columnDefs: [
                { className: 'control', orderable: false, targets:   0 },
                { width: '5%', targets: 1},
                { width: '5%', targets: 2},
                { width: '20%', targets: 3}
                ],

//            order: [ 0, 'desc' ],

            "lengthMenu": [
                [5, 10, 15, 20, -1],
                [5, 10, 15, 20, "All"] // change per page values here
            ],
            // set the initial value
            "pageLength": -1,

            "dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'B f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>", // horizobtal scrollable datatable

            // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
            // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js).
            // So when dropdowns used the scrollable div should be removed.
            //"dom": "<'row' <'col-md-12'T>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
        });
    };

    var initTable3 = function () {
        var table = $('#sample_3');

        var oTable = table.dataTable({
            // Internationalisation. For more info refer to http://datatables.net/manual/i18n
            "language": {
                "aria": {
                    "sortAscending": ": attivare per ordinare la colonna in ordine crescente",
                    "sortDescending": ": attivare per ordinare la colonna decrescente"
                },
                "emptyTable": "Nessun dato trovato nella Tabella",
                "info": "Visualizzati da _START_ a _END_ di _TOTAL_ record",
                "infoEmpty": "Nessuna voce trovata",
                "infoFiltered": "(Filtrato 1 di _MAX_ record totali)",
                "lengthMenu": "_MENU_ Righe",
                "search": "Cerca:",
                "zeroRecords": "Nessuna corrispondenza trovata"
            },

            // Or you can use remote translation file
            //"language": {
            //   url: '//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Portuguese.json'
            //},

            // setup buttons extentension: http://datatables.net/extensions/buttons/
            buttons: [
                { extend: 'print', className: 'btn dark btn-outline' },
                { extend: 'pdf', className: 'btn green btn-outline' },
                { extend: 'excel', className: 'btn purple btn-outline ' }
            ],

            // setup responsive extension: http://datatables.net/extensions/responsive/
            // setup responsive extension: http://datatables.net/extensions/responsive/
            responsive: {
                details: {
                    type: 'column',
                    target: 'tr'
                }
            },
            columnDefs: [
                { className: 'control', orderable: false, targets:   0 },
                { width: '5%', targets: 1},
                { width: '5%', targets: 2},
                { width: '20%', targets: 3}
            ],

//            order: [ 0, 'desc' ],

            "lengthMenu": [
                [5, 10, 15, 20, -1],
                [5, 10, 15, 20, "All"] // change per page values here
            ],
            // set the initial value
            "pageLength": -1,

            "dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'B f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>", // horizobtal scrollable datatable

            // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
            // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js).
            // So when dropdowns used the scrollable div should be removed.
            //"dom": "<'row' <'col-md-12'T>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
        });
    };

    var initTable4 = function () {
        var table = $('#sample_4');

        var oTable = table.dataTable({
            // Internationalisation. For more info refer to http://datatables.net/manual/i18n
            "language": {
                "aria": {
                    "sortAscending": ": attivare per ordinare la colonna in ordine crescente",
                    "sortDescending": ": attivare per ordinare la colonna decrescente"
                },
                "emptyTable": "Nessun dato trovato nella Tabella",
                "info": "Visualizzati da _START_ a _END_ di _TOTAL_ record",
                "infoEmpty": "Nessuna voce trovata",
                "infoFiltered": "(Filtrato 1 di _MAX_ record totali)",
                "lengthMenu": "_MENU_ Righe",
                "search": "Cerca:",
                "zeroRecords": "Nessuna corrispondenza trovata"
            },

            // Or you can use remote translation file
            //"language": {
            //   url: '//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Portuguese.json'
            //},

            // setup buttons extentension: http://datatables.net/extensions/buttons/
            buttons: [
//                { extend: 'print', className: 'btn dark btn-outline' },
//                { extend: 'pdf', className: 'btn green btn-outline' },
//                { extend: 'excel', className: 'btn purple btn-outline ' }
            ],

            // setup responsive extension: http://datatables.net/extensions/responsive/
            // setup responsive extension: http://datatables.net/extensions/responsive/
            responsive: {
                details: {
                    type: 'column',
                    target: 'tr'
                }
            },
            columnDefs: [
                { className: 'control', orderable: false, targets:   0 },
                { width: '15%', targets: 1},
                { width: '15%', targets: 2},
                { width: '15%', targets: 3},
                { width: '25%', targets: 4},
                { width: '10%', targets: 5, orderable: false},
                { width: '10%', targets: 6, orderable: false},
                { width: '10%', targets: 7, orderable: false}

            ],

            order: [
                [8, 'asc'],
                [9, 'asc'],
                [3, 'asc'],
                [4, 'asc']
            ],

//            order: [ 0, 'desc' ],

            "lengthMenu": [
                [5, 10, 15, 20, -1],
                [5, 10, 15, 20, "All"] // change per page values here
            ],
            // set the initial value
            "pageLength": 10,

            "dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'B f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>", // horizobtal scrollable datatable

            // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
            // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js).
            // So when dropdowns used the scrollable div should be removed.
            //"dom": "<'row' <'col-md-12'T>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
        });
    };

    var initTable5 = function () {
        var table = $('#sample_5');

        var oTable = table.dataTable({
            // Internationalisation. For more info refer to http://datatables.net/manual/i18n
            "language": {
                "aria": {
                    "sortAscending": ": attivare per ordinare la colonna in ordine crescente",
                    "sortDescending": ": attivare per ordinare la colonna decrescente"
                },
                "emptyTable": "Nessun dato trovato nella Tabella",
                "info": "Visualizzati da _START_ a _END_ di _TOTAL_ record",
                "infoEmpty": "Nessuna voce trovata",
                "infoFiltered": "(Filtrato 1 di _MAX_ record totali)",
                "lengthMenu": "_MENU_ Righe",
                "search": "Cerca:",
                "zeroRecords": "Nessuna corrispondenza trovata"
            },

            // Or you can use remote translation file
            //"language": {
            //   url: '//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Portuguese.json'
            //},

            // setup buttons extentension: http://datatables.net/extensions/buttons/
            buttons: [
                // { extend: 'print', className: 'btn dark btn-outline' },
                // { extend: 'pdf', className: 'btn green btn-outline' },
                // { extend: 'excel', className: 'btn purple btn-outline ' }
            ],

            // setup responsive extension: http://datatables.net/extensions/responsive/
            // setup responsive extension: http://datatables.net/extensions/responsive/
            responsive: {
                details: {
                    type: 'column',
                    target: 'tr'
                }
            },
            columnDefs: [
                { className: 'control', orderable: false, targets:   0 },
                { width: '15%', targets: 1},
                { width: '15%', targets: 2},
                { width: '15%', targets: 3},
                { width: '25%', targets: 4},
                { width: '10%', targets: 5, orderable: false},
                { width: '10%', targets: 6, orderable: false},
                { width: '10%', targets: 7, orderable: false}

            ],

            order: [
                [8, 'asc'],
                [9, 'asc'],
                [3, 'asc'],
                [4, 'asc']
            ],

            "lengthMenu": [
                [5, 10, 15, 20, -1],
                [5, 10, 15, 20, "All"] // change per page values here
            ],
            // set the initial value
            "pageLength": 10,

            "dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'B f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>", // horizobtal scrollable datatable

            // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
            // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js).
            // So when dropdowns used the scrollable div should be removed.
            //"dom": "<'row' <'col-md-12'T>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
        });
    };

    var initTable6 = function () {
        var table = $('#sample_6');

        var oTable = table.dataTable({
            // Internationalisation. For more info refer to http://datatables.net/manual/i18n
            "language": {
                "aria": {
                    "sortAscending": ": attivare per ordinare la colonna in ordine crescente",
                    "sortDescending": ": attivare per ordinare la colonna decrescente"
                },
                "emptyTable": "Nessun dato trovato nella Tabella",
                "info": "Visualizzati da _START_ a _END_ di _TOTAL_ record",
                "infoEmpty": "Nessuna voce trovata",
                "infoFiltered": "(Filtrato 1 di _MAX_ record totali)",
                "lengthMenu": "_MENU_ Righe",
                "search": "Cerca:",
                "zeroRecords": "Nessuna corrispondenza trovata"
            },

            // Or you can use remote translation file
            //"language": {
            //   url: '//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Portuguese.json'
            //},

            // setup buttons extentension: http://datatables.net/extensions/buttons/
            buttons: [
                { extend: 'print', className: 'btn dark btn-outline' },
                { extend: 'pdf', className: 'btn green btn-outline' },
                { extend: 'excel', className: 'btn purple btn-outline ' }
            ],

            // setup responsive extension: http://datatables.net/extensions/responsive/
            // setup responsive extension: http://datatables.net/extensions/responsive/
            responsive: {
                details: {
                    type: 'column',
                    target: 'tr'
                }
            },
            columnDefs: [
                { className: 'control', orderable: false, targets:   0 },
                { width: '8%', targets: 1},
                { width: '8%', targets: 2},
                { width: '19%', targets: 3},
                { width: '50%', targets: 4},
                { width: '15%', targets: 7, orderable: false}

            ],

            order: [
                [1, 'asc'],
                [2, 'asc'],
            ],

            "lengthMenu": [
                [5, 10, 15, 20, -1],
                [5, 10, 15, 20, "All"] // change per page values here
            ],
            // set the initial value
            "pageLength": -1,

            "dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'B f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>", // horizobtal scrollable datatable

            // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
            // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js).
            // So when dropdowns used the scrollable div should be removed.
            //"dom": "<'row' <'col-md-12'T>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
        });
    };


    return {

        //main function to initiate the module
        init: function () {

            if (!jQuery().dataTable) {
                return;
            }

            initTable1();
            initTable2();
            initTable3();
            initTable4();
            initTable5();
            initTable6();
        }

    };

}();

jQuery(document).ready(function() {
    TableDatatablesResponsive.init();
});
