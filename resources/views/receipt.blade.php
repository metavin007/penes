@extends('layouts.app_layout')

@section('css_bottom')

@endsection

@section('body')

<div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-6 col-8 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/receipt') }}">ตารางจัดเก็บใบเสร็จลูกค้า</a></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row"> 
                        <div class="col-lg-2">    
                            <div class="form-group">
                                <label style="font-weight: bold;"><b>วันที่เริ่ม : </b></label>
                                <input type="text" id="date_search_start" class="form-control" readonly="" value="{{ date('01-m-Y') }}">
                            </div>
                        </div>
                        <div class="col-lg-2">    
                            <div class="form-group">
                                <label style="font-weight: bold;"><b>วันที่สิ้นสุด : </b></label>
                                <input type="text" id="date_search_end" class="form-control" readonly="" value="{{ date('t-m-Y') }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-lg-6">
                            <h4 class="">ตารางจัดเก็บใบเสร็จลูกค้า</h4>
                        </div>
                        <div class="col-lg-6">
                            <button class="btn float-right btn btn-info btn-add btn-lg"> <i class="me-2 mdi mdi-plus-circle"></i> สร้าง</button>
                        </div>
                    </div>
                    <div class="table-responsive m-t-40">
                        <table id="Table" class="display nowrap table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <td class="text-center" style="width: 5%;">ลำดับ</td>
                                    <td class="text-center" style="width: 25%;">ชื่อลูกค้า/งาน</td>
                                    <td class="text-center" style="width: 20%;">สลิป</td>
                                    <td class="text-center" style="width: 10%;">วันที่</td>
                                    <td class="text-center" style="width: 15%;">สถานะ</td>
                                    <td class="text-center" style="width: 10%;">ใบเสร็จ</td>
                                    <td class="text-center" style="width: 20%;">จัดการ</td>
                                </tr>
                            </thead>
                        </table>
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
                <h3 class="" id="myLargeModalLabel">สร้าง</h3>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form id="FormAdd">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="add_name">ชื่อลูกค้า/งาน</label>
                                <input type="text" name="name" id="add_name" class="form-control" required="">
                            </div>
                        </div>
                        <div class="col-lg-12"> 
                            <div class="form-group">
                                <label for="add_file"><b>สลิป</b></label>
                                <input type="file" id="add_file" name="file" class="dropify" data-max-file-size="2M">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="add_receipt_date">วันที่จ่าย</label>
                                <input type="text" name="receipt_date" id="add_receipt_date" class="form-control date_time-picker" readonly="">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="add_status">สถานะ</label>
                                <select name="status" id="add_status" class="form-control">
                                    <option value="" selected="">ไม่ได้กำหนด</option>
                                    <option value="ขอใบเสร็จ">ขอใบเสร็จ</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">ปิด</button>
                    <button type="submit" class="btn btn-success btn-lg btn-success">บันทึก</button>
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
                                <label for="edit_name">ชื่อลูกค้า/งาน</label>
                                <input type="text" name="name" id="edit_name" class="form-control" required="">
                            </div>
                        </div>
                        <div class="col-lg-12"> 
                            <div class="form-group">
                                <label for="edit_file"><b>สลิป</b></label>
                                <input type="file" id="edit_file" name="file" class="dropify" data-max-file-size="2M" >
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="edit_receipt_date">วันที่จ่าย</label>
                                <input type="text" name="receipt_date" id="edit_receipt_date" class="form-control date_time-picker" readonly="">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="edit_status">สถานะ</label>
                                <select name="status" id="edit_status" class="form-control">
                                    <option value="" selected="">ไม่ได้กำหนด</option>
                                    <option value="ขอใบเสร็จ">ขอใบเสร็จ</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">ปิด</button>
                    <button type="submit" class="btn btn-success btn-lg btn-success">บันทึก</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="ModalLook" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="" id="myLargeModalLabel">ดูภาพ</h3>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <input type="hidden" id="update_id">
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <img id="open_file" alt="pic" style="width: 100%">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">ปิด</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ModalUpload" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="" id="myLargeModalLabel">อัพโหลด</h3>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <input type="hidden" id="update_upload_id">
            <form id="FormUpload">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12"> 
                            <div class="form-group">
                                <label for="edit_receipt_file"><b>ใบเสร็จ</b></label>
                                <input type="file" id="edit_receipt_file" name="receipt_file" class="dropify" data-max-file-size="2M" >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">ปิด</button>
                    <button type="submit" class="btn btn-success btn-lg btn-success">บันทึก</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('js_bottom')
<script>

    get_table_list($("#date_search_start").val(), $("#date_search_end").val());

    $('#date_search_start').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        autoUpdateInput: false,
        locale: {
            format: 'DD-MM-YYYY'
        }, minDate: 0,
    });
    $('#date_search_end').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        autoUpdateInput: false,
        locale: {
            format: 'DD-MM-YYYY'
        }
    });

    $('#date_search_start').on('apply.daterangepicker', function (e, picker) {
        $(this).val(picker.startDate.format('DD-MM-YYYY'));
        get_table_list(picker.startDate.format('DD-MM-YYYY'), $('#date_search_end').val());
    })
    $('#date_search_end').on('apply.daterangepicker', function (e, picker) {
        $(this).val(picker.startDate.format('DD-MM-YYYY'));
        get_table_list($('#date_search_start').val(), picker.startDate.format('DD-MM-YYYY'));
    })

    var TableList;
    function get_table_list(date_search_start, date_search_end) {
        if (TableList != undefined) {
            TableList.DataTable().destroy();
        }
        TableList = $('#Table').dataTable({
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
            pageLength: 50,
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "language": {
                "info": "_START_-_END_ of _TOTAL_ entries",
                searchPlaceholder: "Search"
            },
            "ajax": {
                "url": url_gb + "/receipt/get/get_datatable",
                "data": function (d) {
                    d.date_search_start = date_search_start;
                    d.date_search_end = date_search_end;
                }
            },
            "columns": [
                {"data": "DT_RowIndex", "className": "text-center", "orderable": false, "searchable": false},
                {"data": "name", "orderable": false, },
                {"data": "file", "className": "text-center", "orderable": false, },
                {"data": "receipt_date", "className": "text-center"},
                {"data": "status", "className": "text-center"},
                {"data": "receipt_file", "className": "text-center"},
                {"data": "action", "className": "action text-right", "orderable": false, "searchable": false}
            ], "order": [[3, "desc"]],
            rowCallback: function (row, data, index) {

            },
            //แก้ไขชื่อ ข้อความต่างๆ ;
            "language": {
                "search": "ค้นหา",

                "paginate": {
                    "first": "หน้าแรก",
                    "previous": "ก่อนหน้า",
                    "next": "ต่อไป",
                    "last": "สุดท้าย"
                },
                "processing": "Processing...",
            }
        });
    }

    $('body').on('click', '.btn-add', function (e) {
        e.preventDefault();
        $('.date_time-picker').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            autoUpdateInput: false,
            locale: {
                format: 'DD-MM-YYYY'
            }, drops: 'up'
        });
        $('.date_time-picker').on('apply.daterangepicker', function (ev, picker) {
            $(this).val(picker.startDate.format('DD-MM-YYYY'));
        });

        $('#add_file').parent().find(".dropify-clear").trigger('click');
        $('#add_file').dropify();

        $('#ModalAdd').modal("show");
    });

    $('#FormAdd').validate({
        focusCleanup: true,
        rules: {
            name: {
                required: true,
            },
            receipt_date: {
                required: true,
            },
        },
        messages: {
            name: {
                required: "กรุณาระบุ",
            },
            receipt_date: {
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
                url: url_gb + "/receipt",
                dataType: 'json',
                data: new FormData(form),
                contentType: false,
                cache: false,
                processData: false,
            }).done(function (rec) {
                console.log(rec);
                btn.button("reset");
                if (rec.status == 1) {
                    TableList.api().ajax.reload();
                    form.reset();
                    swal(rec.title, rec.content, "success");
                    $('#ModalAdd').modal('hide');
                } else {
                    swal(rec.title, rec.content, "error");
                }
            }).fail(function () {
                swal("Error", "System error", "error");
                btn.button("reset");
            });
        }
    });

    $('body').on('click', '.btn-look_pic', function (e) {
        e.preventDefault();
        var btn = $(this);
        btn.button('loading');
        var id = $(this).data('id');

        $.ajax({
            method: "GET",
            url: url_gb + "/receipt/get/get_by_id/" + id,
            dataType: 'json'
        }).done(function (rec) {

            $('#open_file').attr('src', asset_gb + 'uploads/receipt/' + rec['receipt'].file)

            btn.button("reset");
            $('#ModalLook').modal("show");
        }).fail(function () {
            swal("system.system_alert", "system.system_error", "error");
            btn.button("reset");
        });
    });

    $('body').on('click', '.btn-edit', function (e) {
        e.preventDefault();
        var btn = $(this);
        btn.button('loading');
        var id = $(this).data('id');
        $('#update_id').val(id);

        $('.date_time-picker').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            autoUpdateInput: false,
            locale: {
                format: 'DD-MM-YYYY'
            }, drops: 'up'
        });
        $('.date_time-picker').on('apply.daterangepicker', function (ev, picker) {
            $(this).val(picker.startDate.format('DD-MM-YYYY'));
        });

        $.ajax({
            method: "GET",
            url: url_gb + "/receipt/get/get_by_id/" + id,
            dataType: 'json'
        }).done(function (rec) {

            $('#edit_name').val(rec['receipt'].name);

            var drEvent = $('#edit_file').dropify(
                    {
                        efaultFile: asset_gb + 'uploads/receipt/' + rec['receipt'].file
                    });
            drEvent = drEvent.data('dropify');
            drEvent.resetPreview();
            drEvent.clearElement();
            drEvent.settings.defaultFile = asset_gb + 'uploads/receipt/' + rec['receipt'].file;
            drEvent.destroy();
            drEvent.init();

            $('#edit_receipt_date').val(rec['receipt_date']);
            $('#edit_status').val(rec['receipt'].status);

            btn.button("reset");
            $('#ModalEdit').modal("show");
        }).fail(function () {
            swal("system.system_alert", "system.system_error", "error");
            btn.button("reset");
        });
    });

    $('#FormEdit').validate({
        rules: {
            name: {
                required: true,
            },
            receipt_date: {
                required: true,
            },
        },
        messages: {
            name: {
                required: "กรุณาระบุ",
            },
            receipt_date: {
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
                method: "POST",
                url: url_gb + "/receipt/update/update_data/" + id,
                dataType: 'json',
                data: new FormData(form),
                contentType: false,
                cache: false,
                processData: false,
            }).done(function (rec) {
                console.log(rec);
                btn.button("reset");
                if (rec.status == 1) {
                    TableList.api().ajax.reload();
                    form.reset();
                    swal(rec.title, rec.content, "success");
                    $('#ModalEdit').modal('hide');
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
                    url: url_gb + "/receipt/" + id,
                    data: {ID: id}
                }).done(function (rec) {
                    if (rec.status == 1) {
                        swal(rec.title, rec.content, "success");
                        TableList.api().ajax.reload();
                    } else {
                        swal("ระบบมีปัญหา", "กรุณาติดต่อผู้ดูแล", "error");
                    }
                }).fail(function (data) {
                    swal("ระบบมีปัญหา", "กรุณาติดต่อผู้ดูแล", "error");
                });
            }
        });
    });

    $('body').on('click', '.btn-upload', function (e) {
        e.preventDefault();
        var btn = $(this);
        btn.button('loading');
        var id = $(this).data('id');
        $('#update_upload_id').val(id);

        $.ajax({
            method: "GET",
            url: url_gb + "/receipt/get/get_by_id/" + id,
            dataType: 'json'
        }).done(function (rec) {


            var drEvent = $('#edit_receipt_file').dropify(
                    {
                        efaultFile: asset_gb + 'uploads/receipt/' + rec['receipt'].receipt_file
                    });
            drEvent = drEvent.data('dropify');
            drEvent.resetPreview();
            drEvent.clearElement();
            drEvent.settings.defaultFile = asset_gb + 'uploads/receipt/' + rec['receipt'].receipt_file;
            drEvent.destroy();
            drEvent.init();

            btn.button("reset");
            $('#ModalUpload').modal("show");
        }).fail(function () {
            swal("system.system_alert", "system.system_error", "error");
            btn.button("reset");
        });
    });

    $('#FormUpload').validate({
        rules: {

        },
        messages: {

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
            var id = $('#update_upload_id').val();
            btn.button("loading");
            $.ajax({
                method: "POST",
                url: url_gb + "/receipt/update/update_upload/" + id,
                dataType: 'json',
                data: new FormData(form),
                contentType: false,
                cache: false,
                processData: false,
            }).done(function (rec) {
                btn.button("reset");
                if (rec.status == 1) {
                    TableList.api().ajax.reload();
                    form.reset();
                    swal(rec.title, rec.content, "success");
                    $('#ModalUpload').modal('hide');
                } else {
                    swal(rec.title, rec.content, "error");
                }
            }).fail(function () {
                swal("Error", "System error", "error");
                btn.button("reset");
            });
        }
    });



</script>
@endsection
