"use strict";
$(document).ready(function() {
    var table = $('#assets-table').DataTable({
        dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>tp",
        deferRender: true,
        ajax : {
            type : 'POST',
            url  : base + 'Assets/getAssetsTable/' + charID + '/' + aggr,
            data : {region_id: regionID},
            dataSrc: function (json) {
                var return_data = [];
                for (var i = 0; i < json.length; i++) {
                    return_data.push({
                        item: '<img src="' + json[i].url + '">' + '<a class="item-name" style="color:#fff">' +  json[i].item_name,
                        owner: json[i].owner,
                        quantity: number_format(json[i].quantity, 0, '.', ',' ),
                        location: json[i].loc_name,
                        volume_total: number_format(json[i].total_volume, 2, '.', ',' ),
                        isk_unit: number_format(json[i].unit_value, 2, '.', ',' ),
                        isk_total: number_format(json[i].total_value, 2, '.', ',' )
                    });
                  }
                updateTableTotals();
                return return_data;
            }   
        },
        columns: [
            { data: "item" },
            { data: "owner" },
            { data: "quantity" },
            { data: "location" },
            { data: "volume_total" },
            { data: "isk_unit" },
            { data: "isk_total" },
        ],
        lengthMenu: [
            [25, 50, 100, -1],
            [25, 50, 100, "All"]
        ],
        buttons: [{
            extend: 'copy',
            className: 'btn-sm'
        }, {
            extend: 'csv',
            title: 'assets',
            className: 'btn-sm'
        }, {
            extend: 'pdf',
            title: 'assets',
            className: 'btn-sm',
            orientation: 'landscape'
        }, {
            extend: 'print',
            className: 'btn-sm'
        }],
        aoColumnDefs: [
            { 
            bSearchable: false, 
            aTargets: [ 3 ] 
        }]
    });

    function updateTableTotals() {
        setTimeout(function() {
            $('.assets-body .input-sm').trigger('keyup');
        });
    }

    // totals
    $(".assets-body p.yellow").html("<p>There are "+ table.rows().count() + " results for a total of "
        + number_format(table.column(5).data().sum(),2, '.', ',' ) + " ISK</p>");
    $("#assets-table_filter input").keyup(function () {
        $(".assets-body p.yellow").html("There are "+ table.rows({filter: 'applied'}).count() + " results for a total of "
            + number_format(table.column(5, {"filter": "applied"} ).data().sum(),2, '.', ',' ) + " ISK");
    });

    // item filter
    $("table").on('click', 'a', function() {
        var name = $(this).text();
        $(".assets-body input.form-control").val(name);
        $(".assets-body input.form-control").trigger("keyup");
    });

    // normalize sparkline
    var i = 0;
    $(".spark-tab").on('click', function() {
        i++;
        if(i<2) {
            $(".spark-tab").trigger('click');
            renderSparkline();
        }
    });

    function renderSparkline() {
        var sparklineCharts = function() {
            $(".sparkline").sparkline($(".sparkline").data('profit'), {
                type: 'line',
                lineColor: '#f6a821',
                fillColor: '#f6a821',
                height: 100,
                width: '100%'
            });
        };
        
        var sparkResize;
        // Resize sparkline charts on window resize
        $(window).resize(function() {
            clearTimeout(sparkResize);
            sparkResize = setTimeout(sparklineCharts, 100);
        });
        // Run sparkline
        sparklineCharts();
    }

    // load assets chart
    var assetsChart = function() {
        FusionCharts.ready(function () {
            var lineChart = new FusionCharts({
                type: 'pie3d',
                renderAt: 'pie',
                width: '100%',
                height: '500',
                dataFormat: 'json',
                dataSource: pieData
            });
            lineChart.render();
        });
    };

    assetsChart();
});