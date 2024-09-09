"use strict";
$(function () {
    var e, a = $(".datatables-permissions"),
        d = "app-user-list.html";
    a.length && (e = a.DataTable({
        columns: [{
            data: "name"
        }, {
            data: "operation"
        }, {
            data: "created_date"
        }, {
            data: ""
        }],
        order: [
            [1, "asc"]
        ],
        dom: '<"row mx-1"<"col-sm-12 col-md-3" l><"col-sm-12 col-md-9"<"dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-md-end justify-content-center flex-wrap me-1"<"me-3"f>B>>>t<"row mx-2"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
        language: {
            sLengthMenu: "_MENU_",
            search: "Search",
            searchPlaceholder: "Search.."
        },
        buttons: [{
            text: "Add Permission",
            className: "add-new btn btn-primary mb-3 mb-md-0",
            attr: {
                "data-bs-toggle": "modal",
                "data-bs-target": "#addPermissionModal"
            },
            init: function (e, a, t) {
                $(a).removeClass("btn-secondary")
            }
        }],
        responsive: {
            details: {
                display: $.fn.dataTable.Responsive.display.modal({
                    header: function (e) {
                        return "Details of " + e.data().name
                    }
                }),
                type: "column",
                renderer: function (e, a, t) {
                    t = $.map(t, function (e, a) {
                        return "" !== e.title ? '<tr data-dt-row="' + e.rowIndex + '" data-dt-column="' + e.columnIndex + '"><td>' + e.title + ":</td> <td>" + e.data + "</td></tr>" : ""
                    }).join("");
                    return !!t && $('<table class="table"/><tbody />').append(t)
                }
            }
        },
        initComplete: function () {
            this.api().columns(3).every(function () {
                var a = this,
                    t = $('<select id="UserRole" class="form-select text-capitalize"><option value=""> Select Role </option></select>').appendTo(".user_role").on("change", function () {
                        var e = $.fn.dataTable.util.escapeRegex($(this).val());
                        a.search(e ? "^" + e + "$" : "", !0, !1).draw()
                    });
                a.data().unique().sort().each(function (e, a) {
                    t.append('<option value="' + e + '" class="text-capitalize">' + e + "</option>")
                })
            })
        }
    })), setTimeout(() => {
        $(".dataTables_filter .form-control").removeClass("form-control-sm"), $(".dataTables_length .form-select").removeClass("form-select-sm")
    }, 300)
});