@extends('layouts.app_layout')

@section('css_bottom')

@endsection

@section('body')

<div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-6 col-8 align-self-center">
            <ol class="breadcrumb">
             <!--    <li class="breadcrumb-item"><a href="{{ url('/note') }}">เกี่ยวกับบริษัท</a></li> -->
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-lg-6">
                            <h4 class="">จดบันทึกข้อมูล</h4>
                        </div>
                             <div class="col-lg-6">
                             <button class="btn float-right btn btn-info btn-add btn-md"> <i class="me-2 mdi mdi-tag-plus"></i> เพิ่มโน้ท </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="note-has-grid row">
        @foreach($notes as $note)
        <div class="col-md-4 single-note-item all-category">
            <div class="card card-body">
                <span class="side-stick" style="position: absolute;
    width: 3px;
    height: 35px;
    background: #009efb;
    left: 0;"></span>
                <h5 class="note-title text-truncate w-75 mb-0">{{ $note->topic }} <i class="me-2 mdi mdi-bookmark" style="color: #009efb;
    font-size: small;"></i></h5>
                <p class="note-date fs-2 text-muted" style="    font-size: small;
    margin-top: 5px;
    color: #b4b4b4 !important;">{{ DateThai($note->created_at) }}</p>
                <div class="note-content">
                    <div>{!! nl2br($note->detail) !!}</div>
                    <br>
                </div>
                <div class="text-right">
                    <button type="button" class="btn btn-edit btn-warning" data-id="{{ $note->id }}" style="border-radius: 29px;"><i class="me-2 mdi mdi-pencil"></i></button>
                    <button type="button" class="btn btn-delete btn-danger" data-id="{{ $note->id }}" data-name="{{ $note->topic }}" style="border-radius: 29px;"><i class="far fa-trash-alt remove-note"></i></button>
                </div>
            </div>
        </div>
        @endforeach
    </div>
        <br>
        <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class=""> NotePad Online </h4>
                    <hr/>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-address">
                                <label> ไว้ทดสอบพิมพ์ข้อความ</label>
                                <textarea class="form-control" rows="10"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>



</div>

<div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="" id="myLargeModalLabel">เพิ่ม</h3>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form id="FormAdd">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="add_topic">หัวข้อ</label>
                                <input type="text" name="topic" id="add_topic" class="form-control" required="">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="add_detail">ข้อความ</label>
                                <textarea class="form-control" name="detail" id="add_detail" rows="10"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btdel-red" data-dismiss="modal">ปิด</button>
                    <button type="submit" class="btn btn-success btn-lg btn-success btsave-g">บันทึก</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="" id="myLargeModalLabel">แก้ไข</h3>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <input type="hidden" id="update_id">
            <form id="FormEdit">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="edit_topic">หัวข้อ</label>
                                <input type="text" name="topic" id="edit_topic" class="form-control" required="">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">ข้อความ</label>
                                <textarea class="form-control" name="detail" id="edit_detail" rows="10"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btdel-red" data-dismiss="modal">ปิด</button>
                    <button type="submit" class="btn btn-success btn-lg btn-success btsave-g">บันทึก</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('js_bottom')
<script>

    var TableList = $('#Table').dataTable({
        // เซอเวอไซต์ต้องมี 2 อันนี้
        "processing": true,
        "serverSide": true,
        // -------------------
        scrollCollapse: true,
        autoWidth: false,
        responsive: true,
        columnDefs: [{
                targets: "datatable-nosort",
                orderable: false,
            }],
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        "language": {
            "info": "_START_-_END_ of _TOTAL_ entries",
            searchPlaceholder: "Search"
        },
        "ajax": {
            "url": url_gb + "/note/get/get_datatable",
            "data": function (d) {
                //d.myKey = "myValue";
                // d.custom = $('#myInput').val();
                // etc
            }
        },
        "columns": [
            {"data": "DT_RowIndex", "className": "text-center", "orderable": false, "searchable": false},
            {"data": "name"},
            {"data": "created_at"},
            {"data": "action", "className": "action text-center", "orderable": false, "searchable": false}
        ], "order": [[2, "desc"]],
        rowCallback: function (row, data, index) {

        }
    });

    $('body').on('click', '.btn-add', function (e) {
        e.preventDefault();
        $('#ModalAdd').modal("show");
    });

    $('#FormAdd').validate({
        focusCleanup: true,
        rules: {
            topic: {
                required: true,
            },
        },
        messages: {
            topic: {
                required: "กรุณาระบุ",
            },
        },
        errorPlacement: function (error, element) { // คำสั่งโชกล่องข้อความ
            error.addClass("help-block");
            error.insertAfter(element);
        },
        highlight: function (element, errorClass, validClass) { // ใส่สีเมื่อเกิด error
            $(element).closest('.form-group').addClass("has-danger");
            $(element).addClass("form-control-danger");
        },
        unhighlight: function (element, errorClass, validClass) { // ใส่สีเมื่อผ่าน error แล้ว;
            $(element).closest(".form-group").removeClass("has-danger");
            $(element).removeClass("form-control-danger");
        },
        submitHandler: function (form) {
            var btn = $(form).find('[type="submit"]');
            btn.button("loading");
            $.ajax({
                method: "POST",
                url: url_gb + "/note",
                dataType: 'json',
                data: $(form).serialize()
            }).done(function (rec) {
                console.log(rec);
                btn.button("reset");
                if (rec.status == 1) {
                    swal({
                        title: rec.title,
                        text: rec.content,
                        type: "success",
                    }).then(() => {
                        location.reload();
                    });
                } else {
                    swal(rec.title, rec.content, "error");
                }
            }).fail(function () {
                swal("Error", "System error", "error");
                btn.button("reset");
            });
        }
    });

    $('body').on('click', '.btn-edit', function (e) {
        e.preventDefault();
        var btn = $(this);
        btn.button('loading');
        var id = $(this).data('id');
        $('#update_id').val(id);
        $.ajax({
            method: "GET",
            url: url_gb + "/note/get/get_by_id/" + id,
            dataType: 'json'
        }).done(function (rec) {

            $('#edit_topic').val(rec.topic);
            $('#edit_detail').val(rec.detail);

            btn.button("reset");
            $('#ModalEdit').modal("show");
        }).fail(function () {
            swal("system.system_alert", "system.system_error", "error");
            btn.button("reset");
        });
    });

    $('#FormEdit').validate({
        rules: {
            topic: {
                required: true,
            },
        },
        messages: {
            topic: {
                required: "กรุณาระบุ",
            },
        },
        errorPlacement: function (error, element) { // คำสั่งโชกล่องข้อความ
            error.addClass("help-block");
            error.insertAfter(element);
        },
        highlight: function (element, errorClass, validClass) { // ใส่สีเมื่อเกิด error
            $(element).closest('.form-group').addClass("has-danger");
            $(element).addClass("form-control-danger");
        },
        unhighlight: function (element, errorClass, validClass) { // ใส่สีเมื่อผ่าน error แล้ว;
            $(element).closest(".form-group").removeClass("has-danger");
            $(element).removeClass("form-control-danger");
        },
        submitHandler: function (form) {
            var btn = $(form).find('[type="submit"]');
            var id = $('#update_id').val();
            btn.button("loading");
            $.ajax({
                method: "PUT",
                url: url_gb + "/note/" + id,
                dataType: 'json',
                data: $(form).serialize()
            }).done(function (rec) {
                console.log(rec);
                btn.button("reset");
                if (rec.status == 1) {
                    swal({
                        title: rec.title,
                        text: rec.content,
                        type: "success",
                    }).then(() => {
                        location.reload();
                    });
                } else {
                    swal(rec.title, rec.content, "error");
                }
            }).fail(function () {
                swal("Error", "System error", "error");
                btn.button("reset");
            });
        }
    });


    $('body').on('click', '.btn-delete', function (e) {
        e.preventDefault();
        var btn = $(this);
        var id = btn.data('id');
        var name = btn.data('name');
        swal({
            title: "คุณต้องการลบ " + name + " ใช่หรือไม่",
            text: "หากคุณลบจะไม่สามารถเรียกคืนข้อมูกลับมาได้",
            type: 'warning',
            showCancelButton: true,
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            confirmButtonText: "ใช่ ฉันต้องการลบ",
            cancelButtonText: "ยกเลิก",
            showLoaderOnConfirm: true,
        }).then(function (result) {
            if (result.value) {
                $.ajax({
                    method: "DELETE",
                    url: url_gb + "/note/" + id,
                    data: {ID: id}
                }).done(function (rec) {
                    if (rec.status == 1) {
                        swal({
                            title: rec.title,
                            text: rec.content,
                            type: "success",
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        swal("ระบบมีปัญหา", "กรุณาติดต่อผู้ดูแล", "error");
                    }
                }).fail(function (data) {
                    swal("ระบบมีปัญหา", "กรุณาติดต่อผู้ดูแล", "error");
                });
            }
        });
    });

</script>
@endsection
