$(document).ready(function() {
    $('#example').DataTable({
        "pageLength": 1000000,
        "lengthChange": false,
        // "bFilter" : false,
        "columnDefs": [ {
            "targets": 'no-sort',
            "orderable": false,
      } ]
    });

    $('#advanced_search_button').on('click', () => {
        let display = $("#advanced_search").css("display");
        if (display == "none"){
            $("#advanced_search").css("display", "-webkit-box");
        } else {
            $("#advanced_search").css("display", "none");
        }
    })
} );



function filterGlobal () {
    $('#example').DataTable().search(
        $('#global_filter').val(),
        $('#global_regex').prop('checked'),
        $('#global_smart').prop('checked')
    ).draw();
}

function filterColumn ( i ) {
    $('#example').DataTable().column( i ).search(
        $('#col'+i+'_filter').val(),
        $('#col'+i+'_regex').prop('checked'),
        $('#col'+i+'_smart').prop('checked')
    ).draw();
}

$(document).ready(function() {
    $('#example').DataTable();

    $('input.global_filter').on( 'keyup click', function () {
        filterGlobal();
    } );

    $('input.column_filter').on( 'keyup click', function () {
        let parent = $(this).parents('div.filter-container')[0];
        let dataColumn = $(parent).attr('data-column');
        filterColumn( dataColumn );
    } );

    $('#accountsTable').DataTable();
} );