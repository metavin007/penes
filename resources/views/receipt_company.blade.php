@extends('layouts.app_layout')

@section('css_bottom')

@endsection

@section('body')

<div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-6 col-8 align-self-center">
            <ol class="breadcrumb">
                <!-- <li class="breadcrumb-item"><a href="{{ url('/receipt_company') }}">ตารางเก็บใบเสร็จบริษัท</a></li> -->
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
                                <label style="font-weight: bold;"><b>แสดงข้อมูลของวันที่ <i class="me-2 mdi mdi-calendar-clock"></i> </b></label>
                                <input type="text" id="date_search_start" class="form-control" readonly="" value="{{ date('01-m-Y') }}">
                            </div>
                        </div>
                        <div class="col-lg-2">    
                            <div class="form-group">
                                <label style="font-weight: bold;"><b>จนถึงวันที่ <i class="me-2 mdi mdi-calendar-clock"></i></b></label>
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
                            <h4 class="">ตารางจัดเก็บสลิปใบเสร็จบริษัท</h4>
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
                                    <td class="text-center" style="width: 20%;">สลิปจ่ายเงิน</td>
                                    <td class="text-center" style="width: 10%;">วันที่</td>
                                    <td class="text-center" style="width: 15%;">ใช้บัญชีไหนจ่าย</td>
                                    <td class="text-center" style="width: 15%;">เอกสารที่มี</td>
                                    <td class="text-center" style="width: 10%;">ส่งให้ลูกค้า</td>
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
                                <label for="add_file_doc_1"><b>สลิป</b></label>
                                <input type="file" id="add_file_doc_1" name="file_doc_1" class="dropify" data-max-file-size="2M">
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
                                <label for="add_status">ใช้บัญชีบุคคลหรือบริษัทจ่าย</label>
                                <select name="status" id="add_status" class="form-control">
                                    <option value="บุคคคลทั่วไป" selected="">บุคคคลทั่วไป</option>
                                    <option value="บริษัท">บริษัท</option>
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
                                <label for="edit_file_doc_1"><b>สลิป</b></label>
                                <input type="file" id="edit_file_doc_1" name="file_doc_1" class="dropify" data-max-file-size="2M" >
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
                                <label for="edit_status">ใช้บัญชีบุคคลหรือบริษัทจ่าย</label>
                                <select name="status" id="edit_status" class="form-control">
                                    <option value="บุคคคลทั่วไป" selected="">บุคคคลทั่วไป</option>
                                    <option value="บริษัท">บริษัท</option>
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

<div class="modal fade" id="ModalUploadDoc2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="" id="myLargeModalLabel">อัพโหลด</h3>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <input type="hidden" id="update_upload_doc_2_id">
            <form id="FormUploadDoc2">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12"> 
                            <div class="form-group">
                                <label for="edit_file_doc_2"><b>ใบเสร็จ</b></label>
                                <input type="file" id="edit_file_doc_2" name="file_doc_2" class="dropify" data-max-file-size="2M" >
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

<div class="modal fade" id="ModalUploadDoc3" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="" id="myLargeModalLabel">อัพโหลด</h3>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <input type="hidden" id="update_upload_doc_3_id">
            <form id="FormUploadDoc3">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12"> 
                            <div class="form-group">
                                <label for="edit_file_doc_3"><b>ใบเสร็จ</b></label>
                                <input type="file" id="edit_file_doc_3" name="file_doc_3" class="dropify" data-max-file-size="2M" >
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
            "lengthMenu": [[50, -1], [50, "ทั้งหมด"]],

            "ajax": {
                "url": url_gb + "/receipt_company/get/get_datatable",
                "data": function (d) {
                    d.date_search_start = date_search_start;
                    d.date_search_end = date_search_end;
                }
            },
            "columns": [
                {"data": "DT_RowIndex", "className": "text-center", "orderable": false, "searchable": false},
                {"data": "name", "orderable": false, },
                {"data": "file_doc_1", "className": "text-center", "orderable": false, },
                {"data": "receipt_date", "className": "text-center"},
                {"data": "status", "className": "text-center"},
                {"data": "file_doc_2", "className": "text-center"},
                {"data": "file_doc_3", "className": "text-center"},
                {"data": "action", "className": "action text-right", "orderable": false, "searchable": false}
            ], "order": [[3, "desc"]],
            rowCallback: function (row, data, index) {

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

        $('#add_file_doc_1').parent().find(".dropify-clear").trigger('click');
        $('#add_file_doc_1').dropify();

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
                url: url_gb + "/receipt_company",
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
            url: url_gb + "/receipt_company/get/get_by_id/" + id,
            dataType: 'json'
        }).done(function (rec) {

            $('#open_file').attr('src', asset_gb + 'uploads/file_doc_1/' + rec['receipt'].file_doc_1)

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
            url: url_gb + "/receipt_company/get/get_by_id/" + id,
            dataType: 'json'
        }).done(function (rec) {

            $('#edit_name').val(rec['receipt'].name);

            var drEvent = $('#edit_file_doc_1').dropify(
                    {
                        efaultFile: asset_gb + 'uploads/file_doc_1/' + rec['receipt'].file_doc_1
                    });
            drEvent = drEvent.data('dropify');
            drEvent.resetPreview();
            drEvent.clearElement();
            drEvent.settings.defaultFile = asset_gb + 'uploads/file_doc_1/' + rec['receipt'].file_doc_1;
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
                url: url_gb + "/receipt_company/update/update_data/" + id,
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
                    url: url_gb + "/receipt_company/" + id,
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

    $('body').on('click', '.btn-upload_doc_2', function (e) {
        e.preventDefault();
        var btn = $(this);
        btn.button('loading');
        var id = $(this).data('id');
        $('#update_upload_doc_2_id').val(id);

        $.ajax({
            method: "GET",
            url: url_gb + "/receipt_company/get/get_by_id/" + id,
            dataType: 'json'
        }).done(function (rec) {
            var drEvent = $('#edit_file_doc_2').dropify(
                    {
                        efaultFile: asset_gb + 'uploads/file_doc_2/' + rec['receipt'].file_doc_2
                    });
            drEvent = drEvent.data('dropify');
            drEvent.resetPreview();
            drEvent.clearElement();
            drEvent.settings.defaultFile = asset_gb + 'uploads/file_doc_2/' + rec['receipt'].file_doc_2;
            drEvent.destroy();
            drEvent.init();

            btn.button("reset");
            $('#ModalUploadDoc2').modal("show");
        }).fail(function () {
            swal("system.system_alert", "system.system_error", "error");
            btn.button("reset");
        });
    });

    $('body').on('click', '.btn-upload_doc_3', function (e) {
        e.preventDefault();
        var btn = $(this);
        btn.button('loading');
        var id = $(this).data('id');
        $('#update_upload_doc_3_id').val(id);

        $.ajax({
            method: "GET",
            url: url_gb + "/receipt_company/get/get_by_id/" + id,
            dataType: 'json'
        }).done(function (rec) {
            var drEvent = $('#edit_file_doc_3').dropify(
                    {
                        efaultFile: asset_gb + 'uploads/file_doc_3/' + rec['receipt'].file_doc_3
                    });
            drEvent = drEvent.data('dropify');
            drEvent.resetPreview();
            drEvent.clearElement();
            drEvent.settings.defaultFile = asset_gb + 'uploads/file_doc_3/' + rec['receipt'].file_doc_3;
            drEvent.destroy();
            drEvent.init();

            btn.button("reset");
            $('#ModalUploadDoc3').modal("show");
        }).fail(function () {
            swal("system.system_alert", "system.system_error", "error");
            btn.button("reset");
        });
    });

    $('#FormUploadDoc2').validate({
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
            var id = $('#update_upload_doc_2_id').val();
            btn.button("loading");
            $.ajax({
                method: "POST",
                url: url_gb + "/receipt_company/update/update_upload_file_doc_2/" + id,
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
                    $('#ModalUploadDoc2').modal('hide');
                } else {
                    swal(rec.title, rec.content, "error");
                }
            }).fail(function () {
                swal("Error", "System error", "error");
                btn.button("reset");
            });
        }
    });

    $('#FormUploadDoc3').validate({
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
            var id = $('#update_upload_doc_3_id').val();
            btn.button("loading");
            $.ajax({
                method: "POST",
                url: url_gb + "/receipt_company/update/update_upload_file_doc_3/" + id,
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
                    $('#ModalUploadDoc3').modal('hide');
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
