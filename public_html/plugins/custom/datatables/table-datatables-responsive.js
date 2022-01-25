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
            columnDefs: [ {
                className: 'control',
                orderable: false,
                targets:   0
            } ],

//            order: [ 0, 'desc' ],

            "lengthMenu": [
                [5, 10, 15, 20, -1],
                [5, 10, 15, 20, "All"] // change per page values here
            ],
            // set the initial value
            "pageLength": 5,

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
                { extend: 'print', className: 'btn btn-primary btn-outline' },
                { extend: 'pdf', className: 'btn btn-success btn-outline' },
                { extend: 'excel', className: 'btn btn-info btn-outline ' }
            ],

            // setup responsive extension: http://datatables.net/extensions/responsive/
             // setup responsive extension: http://datatables.net/extensions/responsive/
            responsive: {
                details: {
                    type: 'column',
                    target: 'tr'
                }
            },
            columnDefs: [ {
                className: 'control',
                orderable: false,
                targets:   0
            } ],

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
            columnDefs: [ {
                className: 'control',
                orderable: false,
                targets:   0
            } ],

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
            columnDefs: [ {
                className: 'control',
                orderable: false,
                targets:   0
            } ],

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

    var initTable10 = function () {
        var table = $('#sample_10');

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
            columnDefs: [ {
                className: 'control',
                orderable: false,
                targets:   0
            } ],

//            order: [ 0, 'desc' ],

            "paging":   false,
            "ordering": false,
            "info":     false,

            "columns": [
                null,
                { "width": "9%" },
                { "width": "7%" },
                { "width": "7%" },
                { "width": "7%" },
                { "width": "7%" },
                { "width": "7%" },
                { "width": "7%" },
                { "width": "7%" },
                { "width": "7%" },
                { "width": "7%" },
                { "width": "7%" },
                { "width": "7%" },
                { "width": "7%" },
                { "width": "7%" }
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

    var initTable11 = function () {
        var table = $('#sample_11');

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
            columnDefs: [ {
                className: 'control',
                orderable: false,
                targets:   0
            } ],

//            order: [ 0, 'desc' ],
"paging":   false,
"ordering": false,
"info":     false,

"columns": [
    null,
    { "width": "9%" },
    { "width": "7%" },
    { "width": "7%" },
    { "width": "7%" },
    { "width": "7%" },
    { "width": "7%" },
    { "width": "7%" },
    { "width": "7%" },
    { "width": "7%" },
    { "width": "7%" },
    { "width": "7%" },
    { "width": "7%" },
    { "width": "7%" },
    { "width": "7%" }
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

    var initTable12 = function () {
        var table = $('#sample_12');

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
            columnDefs: [ {
                className: 'control',
                orderable: false,
                targets:   0
            } ],

//            order: [ 0, 'desc' ],
"paging":   false,
"ordering": false,
"info":     false,

"columns": [
    null,
    { "width": "9%" },
    { "width": "7%" },
    { "width": "7%" },
    { "width": "7%" },
    { "width": "7%" },
    { "width": "7%" },
    { "width": "7%" },
    { "width": "7%" },
    { "width": "7%" },
    { "width": "7%" },
    { "width": "7%" },
    { "width": "7%" },
    { "width": "7%" },
    { "width": "7%" }
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

    var initTable13 = function () {
        var table = $('#sample_13');

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
            columnDefs: [ {
                className: 'control',
                orderable: false,
                targets:   0
            } ],

//            order: [ 0, 'desc' ],
"paging":   false,
"ordering": false,
"info":     false,
"columns": [
    null,
    { "width": "9%" },
    { "width": "7%" },
    { "width": "7%" },
    { "width": "7%" },
    { "width": "7%" },
    { "width": "7%" },
    { "width": "7%" },
    { "width": "7%" },
    { "width": "7%" },
    { "width": "7%" },
    { "width": "7%" },
    { "width": "7%" },
    { "width": "7%" },
    { "width": "7%" }
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

    var initTable14 = function () {
        var table = $('#sample_14');

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
            columnDefs: [ {
                className: 'control',
                orderable: false,
                targets:   0
            } ],

//            order: [ 0, 'desc' ],
"paging":   false,
"ordering": false,
"info":     false,
"columns": [
    null,
    { "width": "9%" },
    { "width": "7%" },
    { "width": "7%" },
    { "width": "7%" },
    { "width": "7%" },
    { "width": "7%" },
    { "width": "7%" },
    { "width": "7%" },
    { "width": "7%" },
    { "width": "7%" },
    { "width": "7%" },
    { "width": "7%" },
    { "width": "7%" },
    { "width": "7%" }
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

            initTable10();
            initTable11();
            initTable12();
            initTable13();
            initTable14();
        }

    };

}();

jQuery(document).ready(function() {
    TableDatatablesResponsive.init();
});
