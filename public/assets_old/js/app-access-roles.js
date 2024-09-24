"use strict";
$(function () {
        var e = $(".datatables-users"),
            l = {
                1: {
                    title: "Pending",
                    class: "bg-label-warning"
                },
                2: {
                    title: "Active",
                    class: "bg-label-success"
                },
                3: {
                    title: "Inactive",
                    class: "bg-label-secondary"
                }
            },
            c = "app-user-view-account.html";
        e.length && e.DataTable({
            order: [
                [1, "desc"]
            ],
            dom: '<"row mx-2"<"col-sm-12 col-md-4 col-lg-6" l><"col-sm-12 col-md-8 col-lg-6"<"dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-md-end justify-content-center align-items-center flex-sm-nowrap flex-wrap me-1"<"me-3"f><"user_role w-px-200 pb-3 pb-sm-0">>>>t<"row mx-2"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
            language: {
                sLengthMenu: "_MENU_",
                search: "Search",
                searchPlaceholder: "Search.."
            },
            responsive: {
                details: {
                    display: $.fn.dataTable.Responsive.display.modal({
                        header: function (e) {
                            return "Details of " + e.data().full_name
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
            }
        }), setTimeout(() => {
            $(".dataTables_filter .form-control").removeClass("form-control-sm"), $(".dataTables_length .form-select").removeClass("form-select-sm")
        }, 300)
    }),
    function () {
        var e = document.querySelectorAll(".role-edit-modal"),
            a = document.querySelector(".add-new-role"),
            t = document.querySelector(".role-title");
        a.onclick = function () {
            t.innerHTML = "Add New Role"
        }, e && e.forEach(function (e) {
            e.onclick = function () {
                t.innerHTML = "Edit Role"
            }
        })
    }();