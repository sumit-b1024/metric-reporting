"use strict";
        
$(function () {
    var $dataTable = $(".datatables-users");
    let t, a, n;
    n = (isDarkStyle ? (t = config.colors_dark.borderColor, a = config.colors_dark.bodyBg, config.colors_dark) : (t = config.colors.borderColor, a = config.colors.bodyBg, config.colors)).headingColor;

    if ($dataTable.length) {
        $dataTable.DataTable({
            order: [
                [1, "desc"]
            ],
            dom: '<"row mx-2"<"col-md-2"<"me-3"l>><"col-md-10"<"dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-md-row flex-column mb-3 mb-md-0"fB>>>t<"row mx-2"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
            language: {
                sLengthMenu: "_MENU_",
                search: "Search",
                searchPlaceholder: "Search.."
            },
            buttons: [{
                text: '<i class="bx bx-plus me-0 me-sm-1"></i><span class="d-none d-sm-inline-block">Add New Lead Source</span>',
                className: "add-new btn btn-primary",
                attr: {
                    "data-bs-toggle": "offcanvas",
                    "data-bs-target": "#offcanvasAddLeadSource"
                }
            }],
            responsive: {
                details: {
                    display: $.fn.dataTable.Responsive.display.modal({
                        header: function (e) {
                            return "Details of " + e.data().full_name;
                        }
                    }),
                    type: "column",
                    renderer: function (e, a, data) {
                        var rows = $.map(data, function (item, i) {
                            return item.title ? '<tr data-dt-row="' + item.rowIndex + '" data-dt-column="' + item.columnIndex + '"><td>' + item.title + ":</td> <td>" + item.data + "</td></tr>" : "";
                        }).join("");
                        return rows ? $('<table class="table"/><tbody />').append(rows) : false;
                    }
                }
            }
        });

        setTimeout(() => {
            $(".dataTables_filter .form-control").removeClass("form-control-sm");
        }, 300);
    }
    
    
});
