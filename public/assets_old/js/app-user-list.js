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
                extend: "collection",
                className: "btn btn-label-secondary dropdown-toggle mx-3",
                text: '<i class="bx bx-export me-1"></i>Export',
                buttons: [{
                    extend: "print",
                    text: '<i class="bx bx-printer me-2" ></i>Print',
                    className: "dropdown-item",
                    exportOptions: {
                        columns: [1, 2, 3],
                        format: {
                            body: function(e, t, a) {
                                var n;
                                return e.length <= 0 ? e : (e = $.parseHTML(e), n = "", $.each(e, function(e, t) {
                                    void 0 !== t.classList && t.classList.contains("user-name") ? n += t.lastChild.firstChild.textContent : void 0 === t.innerText ? n += t.textContent : n += t.innerText
                                }), n)
                            }
                        }
                    },
                    customize: function(e) {
                        $(e.document.body).css("color", n).css("border-color", t).css("background-color", a), $(e.document.body).find("table").addClass("compact").css("color", "inherit").css("border-color", "inherit").css("background-color", "inherit")
                    }
                }, {
                    extend: "csv",
                    text: '<i class="bx bx-file me-2" ></i>Csv',
                    className: "dropdown-item",
                    exportOptions: {
                        columns: [1, 2, 3],
                        format: {
                            body: function(e, t, a) {
                                var n;
                                return e.length <= 0 ? e : (e = $.parseHTML(e), n = "", $.each(e, function(e, t) {
                                    void 0 !== t.classList && t.classList.contains("user-name") ? n += t.lastChild.firstChild.textContent : void 0 === t.innerText ? n += t.textContent : n += t.innerText
                                }), n)
                            }
                        }
                    }
                }, {
                    extend: "excel",
                    text: '<i class="bx bxs-file-export me-2"></i>Excel',
                    className: "dropdown-item",
                    exportOptions: {
                        columns: [1, 2, 3],
                        format: {
                            body: function(e, t, a) {
                                var n;
                                return e.length <= 0 ? e : (e = $.parseHTML(e), n = "", $.each(e, function(e, t) {
                                    void 0 !== t.classList && t.classList.contains("user-name") ? n += t.lastChild.firstChild.textContent : void 0 === t.innerText ? n += t.textContent : n += t.innerText
                                }), n)
                            }
                        }
                    }
                }, {
                    extend: "pdf",
                    text: '<i class="bx bxs-file-pdf me-2"></i>Pdf',
                    className: "dropdown-item",
                    exportOptions: {
                        columns: [1, 2, 3],
                        format: {
                            body: function(e, t, a) {
                                var n;
                                return e.length <= 0 ? e : (e = $.parseHTML(e), n = "", $.each(e, function(e, t) {
                                    void 0 !== t.classList && t.classList.contains("user-name") ? n += t.lastChild.firstChild.textContent : void 0 === t.innerText ? n += t.textContent : n += t.innerText
                                }), n)
                            }
                        }
                    }
                }, {
                    extend: "copy",
                    text: '<i class="bx bx-copy me-2" ></i>Copy',
                    className: "dropdown-item",
                    exportOptions: {
                        columns: [1, 2, 3],
                        format: {
                            body: function(e, t, a) {
                                var n;
                                return e.length <= 0 ? e : (e = $.parseHTML(e), n = "", $.each(e, function(e, t) {
                                    void 0 !== t.classList && t.classList.contains("user-name") ? n += t.lastChild.firstChild.textContent : void 0 === t.innerText ? n += t.textContent : n += t.innerText
                                }), n)
                            }
                        }
                    }
                }]
            }, {
                text: '<i class="bx bx-plus me-0 me-sm-1"></i><span class="d-none d-sm-inline-block">Add New User</span>',
                className: "add-new btn btn-primary",
                attr: {
                    "data-bs-toggle": "offcanvas",
                    "data-bs-target": "#offcanvasAddUser"
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
