var table;

$(document).ready(function () {
    ajaxcsrf();

    table = $("#essay").DataTable({
        initComplete: function () {
            var api = this.api();
            $("#essay_filter input")
                .off(".DT")
                .on("keyup.DT", function (e) {
                    api.search(this.value).draw();
                });
        },
        dom:
            "<'row'<'col-sm-3'l><'col-sm-6 text-center'B><'col-sm-3'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        buttons: [
            {
                extend: "copy",
                exportOptions: { columns: [1, 2, 3, 4] }
            },
            {
                extend: "print",
                exportOptions: { columns: [1, 2, 3, 4] }
            },
            {
                extend: "excel",
                exportOptions: { columns: [1, 2, 3, 4] }
            },
            {
                extend: "pdf",
                exportOptions: { columns: [1, 2, 3, 4] }
            }
        ],
        oLanguage: {
            sProcessing: "loading..."
        },
        processing: true,
        serverSide: true,
        ajax: {
            url: base_url + "essay/data",
            type: "POST"
        },
        columns: [
            {
                data: "id_essay",
                orderable: false,
                searchable: false
            },
            {
                data: "id_essay",
            },
            {
                data: "bobot",
                orderable: false,
                searchable: false
            },
            {
                data: "judul",
                orderable: false,
                searchable: false
            },
            {
                data: "nama",
                orderable: false,
                searchable: false
            },
            { data: "created_on" }
        ],
        columnDefs: [
            {
                targets: 0,
                data: "id_essay",
                render: function (data, type, row, meta) {
                    return `<div class="text-center">
									<input name="checked[]" class="check" value="${data}" type="checkbox">
								</div>`;
                }
            },
            {
                targets: 6,
                title: "Status",
                data: "status",
                render: function (data, type, row, meta) {
                    if (data === "1") {
                        return `<div class="text-center">
                                <span class="badge bg-green">Terisi</span>
                            </div>`;
                    } else {
                        return `<div class="text-center">
                                <span class="badge bg-red">Kosong</span>
                            </div>`;
                    }
                }
            },
            {
                targets: 7,
                data: "id_essay",
                render: function (data, type, row, meta) {
                    return `<div class="text-center">
                                <a href="${base_url}essay/detail/${data}" class="btn btn-xs btn-default">
                                    <i class="fa fa-eye"></i> Detail
                                </a>
                                <a href="${base_url}essay/edit/${data}" class="btn btn-xs btn-warning">
                                    <i class="fa fa-edit"></i> Edit
                                </a>
                            </div>`;
                }
            }
        ],
        order: [[1, "desc"]],
        rowId: function (a) {
            return a;
        },
        rowCallback: function (row, data, iDisplayIndex) {
            var info = this.fnPagingInfo();
            var page = info.iPage;
            var length = info.iLength;
            var index = page * length + (iDisplayIndex + 1);
            $("td:eq(1)", row).html(index);
        }
    });

    table
        .buttons()
        .container()
        .appendTo("#essay_wrapper .col-md-6:eq(0)");

    $(".select_all").on("click", function () {
        if (this.checked) {
            $(".check").each(function () {
                this.checked = true;
                $(".select_all").prop("checked", true);
            });
        } else {
            $(".check").each(function () {
                this.checked = false;
                $(".select_all").prop("checked", false);
            });
        }
    });

    $("#essay tbody").on("click", "tr .check", function () {
        var check = $("#essay tbody tr .check").length;
        var checked = $("#essay tbody tr .check:checked").length;
        if (check === checked) {
            $(".select_all").prop("checked", true);
        } else {
            $(".select_all").prop("checked", false);
        }
    });

    $("#bulk").on("submit", function (e) {
        e.preventDefault();
        e.stopImmediatePropagation();

        $.ajax({
            url: $(this).attr("action"),
            data: $(this).serialize(),
            type: "POST",
            success: function (respon) {
                if (respon.status) {
                    Swal({
                        title: "Berhasil",
                        text: respon.total + " data berhasil dihapus",
                        type: "success"
                    });
                } else {
                    Swal({
                        title: "Gagal",
                        text: "Tidak ada data yang dipilih",
                        type: "error"
                    });
                }
                reload_ajax();
            },
            error: function () {
                Swal({
                    title: "Gagal",
                    text: "Ada data yang sedang digunakan",
                    type: "error"
                });
            }
        });
    });
});

function bulk_delete() {
    if ($("#essay tbody tr .check:checked").length == 0) {
        Swal({
            title: "Gagal",
            text: "Tidak ada data yang dipilih",
            type: "error"
        });
    } else {
        Swal({
            title: "Anda yakin?",
            text: "Data akan dihapus!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Hapus!"
        }).then(result => {
            if (result.value) {
                $("#bulk").submit();
            }
        });
    }
}
