(function($) {

    /**
     * Class for Table Module
     *
     * @since 1.12.0
     */
    UABBTable = function( settings )
    {   
        // set params
        this.settings           = settings;
        this.node               = settings.id;
        this.nodeClass          = '.fl-node-' + settings.id;
        this.show_entries       = settings.show_entries;
        this.uabb_table         = '';
        this.show_sort          = settings.show_sort;
        this.table_type         = settings.table_type;
        this.show_entries_all_label = settings.show_entries_all_label;

        // initialize the menu 
        this._init();
    };

    UABBTable.prototype = {

        settings    : {},
        node        : '',
        nodeClass   : '',

        _init: function()
        {
            var settings    = this.settings;
            var node        = settings.id;
            var nodeClass   = '.fl-node-' + node;

            $(nodeClass + " #searchHere").on("keyup", function() {

                var value = $(this).val().toLowerCase();
                    
                $(nodeClass + " .uabb-table-features .tbody-row").filter(function() {
                    var search_text = $(this).text().toLowerCase();
                    $(this).toggle(search_text.indexOf(value) > -1);
                });
            });

            var cnt = $(nodeClass + " .uabb-table-features .tbody-row").length;
            var show_entries = settings.show_entries;           

            if ('yes' == show_entries) {
             
                var show_entries_label = settings.show_entries_all_label;

                $(document).on('change', nodeClass + ' .entries-wrapper .select-filter', function(event) {
                    if ( show_entries_label == '' ) {
                        show_entries_label = 'All';
                    }
                    var num = $(this).val();    
                        
                    if (  show_entries_label != num ) {
                        $(nodeClass + ' .uabb-table-features .tbody-row').css('display', 'table-row');
                        $(nodeClass + ' .uabb-table-features .tbody-row').slice(num,cnt).css('display', 'none');
                    }
                    else {
                        $(nodeClass + ' .uabb-table-features .tbody-row').css('display', 'table-row');
                    }
                });
            }

            function sortTable(n) {

                var uabb_table, rows, switching, i, first_sort_row, second_sort_row, should_switch, dir, switch_count = 0;
                    uabb_table = $(nodeClass + " .uabb-table");
                    switching = true;
                    dir = "asc";

                while ( switching ) {
                    
                    switching = false;

                    if( uabb_table[0] ) {
                        var uabb_tbody = uabb_table[0].getElementsByTagName( 'TBODY' );
                        var rows = uabb_tbody[0].getElementsByTagName( 'TR' );
                    }

                    for ( i = 0; i < ( rows.length - 1); i++ ) {

                        should_switch = false;

                        first_sort_row = rows[i].getElementsByClassName('content-text')[n];
                        second_sort_row = rows[i + 1].getElementsByClassName('content-text')[n];

                        if ( dir === "asc" ) {

                            $( nodeClass + ' .uabb-table' + ' .uabb-sort-icon' ).removeClass('fa-sort-up');

                            $( nodeClass + ' .uabb-table' + ' .uabb-sort-icon' ).removeClass('fa-sort-down');

                            $( nodeClass + ' .uabb-table' + ' .uabb-sort-icon' ).addClass('fa-sort');

                            $( nodeClass + ' .uabb-table' + ' .table-heading-' + n + ' .uabb-sort-icon' ).removeClass( "fa-sort-up" );

                            $( nodeClass + ' .uabb-table' + ' .table-heading-' + n + ' .uabb-sort-icon' ).addClass( "fa fa-sort-up" );

                            if ( first_sort_row.innerHTML.toLowerCase() > second_sort_row.innerHTML.toLowerCase() ) {
                                //if so, mark as a switch and break the loop.
                                should_switch = true;
                                break;
                            }
                        } else if ( dir === "desc" ) {
                            $( nodeClass + ' .uabb-table' + ' .uabb-sort-icon' ).removeClass('fa-sort-up');

                            $( nodeClass + ' .uabb-table' + ' .uabb-sort-icon' ).removeClass('fa-sort-down');

                            $( nodeClass + ' .uabb-table' + ' .table-heading-' + n + ' .uabb-sort-icon' ).addClass('fa-sort');

                            $( nodeClass + ' .uabb-table' + ' .table-heading-' + n + ' .uabb-sort-icon' ).removeClass( "fa-sort-down" );

                            $( nodeClass + ' .uabb-table' + ' .table-heading-' + n + ' .uabb-sort-icon' ).addClass( "fa fa-sort-down" );

                            if ( first_sort_row.innerHTML.toLowerCase() < second_sort_row.innerHTML.toLowerCase() ) {
                                //if so, mark as a switch and break the loop.
                                should_switch = true;
                                break;
                            }
                        }
                    }
                    if ( should_switch ) {
                        /*If a switch has been marked, make the switch
                        and mark that a switch has been done.*/
                        rows[i].parentNode.insertBefore( rows[i + 1], rows[i] );
                        switching = true;
                        //Each time a switch is done, increase this count by 1.
                        switch_count ++;
                    } else {
                        /*If no switching has been done AND the direction is "asc",
                        set the direction to "desc" and run the while loop again.*/
                        if ( switch_count == 0 && dir === "asc" ) {
                            dir = "desc";
                            switching = true;
                        }
                    }
                }
            }

            var show_sort = settings.show_sort;

            if ( 'yes' === show_sort ) {

                var uabb_table = $(nodeClass + " .uabb-table"); 

                if( uabb_table[0] ) {

                    $( nodeClass + ' .uabb-table-header .table-header-th' ).css('cursor', 'pointer');
                    $( nodeClass + ' .uabb-table-header .table-header-th .th-style' ).css('cursor', 'pointer');
                    
                    $( nodeClass + ' .uabb-table-header .table-header-th' ).click(function() {

                        var $cell = $(this);
                        var cellIndex = $cell.index();

                        sortTable(cellIndex);
                    });
                }
            }

            var th_cnt = $(nodeClass + " .uabb-table").find('.uabb-table-header .table-header-th').length;
            var table_type = settings.table_type;
            
            if ( 'file' === table_type && th_cnt >= 10 ) {
                $(nodeClass).find( '.uabb-table-element-box' ).css( 'overflow-x', 'auto' );
            }
        },
    };

})(jQuery);