@extends('layouts.app_layout')

@section('css_bottom')
<style>
    .row_success_1{
        color: #fff;
        background-color: #00b99c;
    }
    .row_success_2{
        color: #fff;
        background-color: #00b99c;
    }
</style>
@endsection

@section('body')

<div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-6 col-8 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/manage_task') }}">ตารางจัดการงาน</a></li>
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
                            <h4 class="card-title">ตารางวางแผนการทำงาน</h4>
                        </div>
                        <div class="col-lg-6">
                            <button class="btn float-right btn-primary btn-add"> สร้าง</button>
                        </div>
                    </div>
                    <div class="table-responsive m-t-40">
                        <table id="Table" class="display nowrap table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <td class="text-center">ลำดับ</td>
                                    <td class="text-center">วันที่</td>
                                    <td class="text-center">ชื่องาน</td>
                                    <td class="text-center">แพ็คเกจ</td>
                                    <td class="text-center">คนทำงาน</td>
                                    <td class="text-center">จำนวนภาพ</td>
                                    <td class="text-center">สถานะภาพ</td>
                                    <td class="text-center">จัดการ</td>
                                    <td class="text-center">ลิงค์เพจ</td>
                                    <td class="text-center">จำนวนไลค์</td>
                                    <td class="text-center">สถานะไลค์</td>
                                    <td class="text-center">สรุปงานทั้งหมด</td>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-lg-4">
                            <h4 class="card-title">ตารางสรุปคนทำงาน</h4>
                        </div>
                    </div>
                    <div class="table-responsive m-t-40">
                        <table id="Table_freelance" class="display nowrap table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <td class="text-center">คนทำงาน</td>
                                    <td class="text-center">จำนวน</td>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-lg-4">
                            <h4 class="card-title">ตารางสรุปขายแพ็คเกจ</h4>
                        </div>
                    </div>
                    <div class="table-responsive m-t-40">
                        <table id="Table_package" class="display nowrap table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <td class="text-center">แพ็คเกจ</td>
                                    <td class="text-center">จำนวน</td>
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
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="card-title" id="myLargeModalLabel">เพิ่ม</h3>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form id="FormAdd">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="add_pade_date">วันที่เปิดงาน</label>
                                <input type="text" name="pade_date" id="add_pade_date" class="form-control date_time-picker" readonly="">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="add_pade_name">ชื่อเพจ/ชื่องาน</label>
                                <input type="text" name="pade_name" id="add_pade_name" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="add_package">แพ็คเกจ</label>
                                <select class="form-control error_put_border package" style="width: 100%;" name="package" id="add_package">
                                    <option value="" selected="">ไม่เลือก</option>
                                    @foreach($packages as $package)      
                                    <option value="{{ $package->name }}" data-price="{{ $package->price }}">{{ $package->name }}</option>     
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="add_freelance">คนทำงาน</label>
                                <select class="form-control error_put_border package" style="width: 100%;" name="freelance" id="add_freelance">
                                    <option value="" selected="">ไม่เลือก</option>
                                    @foreach($freelances as $freelance)      
                                    <option value="{{ $freelance->name }}" >{{ $freelance->name }}</option>     
                                    @endforeach
                                </select>
                            </div>
                        </div> 
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="add_amount_image">จำนวนภาพ</label>
                                <input type="number" name="amount_image" id="add_amount_image" class="form-control text-right">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="add_status_image">สถานะภาพ</label>
                                <select name="status_image" id="add_status_image" class="form-control">
                                    <option value="" selected="">ไม่เลือก</option>
                                    <option value="ดำเนินการ">ดำเนินการ</option>
                                    <option value="รอแก้ภาพ">รอแก้ภาพ</option>
                                    <option value="ภาพครบแล้ว">ภาพครบแล้ว</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="add_link_page">ลิงค์เพจ</label>
                                <input type="text" name="link_page" id="add_link_page" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="add_amount_like">จำนวนไลค์</label>
                                <input type="number" name="amount_like" id="add_amount_like" class="form-control text-right">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="add_status_like">สถานะไลค์</label>
                                <select name="status_like" id="add_status_like" class="form-control">
                                    <option value="" selected="">ไม่เลือก</option>
                                    <option value="ดำเนินการ">ดำเนินการ</option>
                                    <option value="ไลน์ครบแล้ว">ไลน์ครบแล้ว</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="add_status_work">สรุปงาน</label>
                                <select name="status_work" id="add_status_work" class="form-control">
                                    <option value="" selected="">ไม่เลือก</option>
                                    <option value="ดำเนินการ">ดำเนินการ</option>
                                    <option value="กำลังยิงโฆษณา">กำลังยิงโฆษณา</option>
                                    <option value="งานสำเร็จแล้ว">งานสำเร็จแล้ว</option>
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
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="card-title" id="myLargeModalLabel">แก้ไข</h3>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <input type="hidden" id="update_id">
            <form id="FormEdit">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="edit_pade_date">วันที่เปิดงาน</label>
                                <input type="text" name="pade_date" id="edit_pade_date" class="form-control date_time-picker" readonly="">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="edit_pade_name">ชื่อเพจ/ชื่องาน</label>
                                <input type="text" name="pade_name" id="edit_pade_name" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="edit_package">แพ็คเกจ</label>
                                <select class="form-control error_put_border package" style="width: 100%;" name="package" id="edit_package">
                                    <option value="" selected="">ไม่เลือก</option>
                                    @foreach($packages as $package)      
                                    <option value="{{ $package->name }}" data-price="{{ $package->price }}">{{ $package->name }}</option>     
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="edit_freelance">คนทำงาน</label>
                                <select class="form-control error_put_border package" style="width: 100%;" name="freelance" id="edit_freelance">
                                    <option value="" selected="">ไม่เลือก</option>
                                    @foreach($freelances as $freelance)      
                                    <option value="{{ $freelance->name }}" >{{ $freelance->name }}</option>     
                                    @endforeach
                                </select>
                            </div>
                        </div> 
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="edit_amount_image">จำนวนภาพ</label>
                                <input type="number" name="amount_image" id="edit_amount_image" class="form-control text-right">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="edit_status_image">สถานะภาพ</label>
                                <select name="status_image" id="edit_status_image" class="form-control">
                                    <option value="" selected="">ไม่เลือก</option>
                                    <option value="ดำเนินการ">ดำเนินการ</option>
                                    <option value="รอแก้ภาพ">รอแก้ภาพ</option>
                                    <option value="ภาพครบแล้ว">ภาพครบแล้ว</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="edit_link_page">ลิงค์เพจ</label>
                                <input type="text" name="link_page" id="edit_link_page" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="edit_amount_like">จำนวนไลค์</label>
                                <input type="number" name="amount_like" id="edit_amount_like" class="form-control text-right">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="edit_status_like">สถานะไลค์</label>
                                <select name="status_like" id="edit_status_like" class="form-control">
                                    <option value="" selected="">ไม่เลือก</option>
                                    <option value="ดำเนินการ">ดำเนินการ</option>
                                    <option value="ไลน์ครบแล้ว">ไลน์ครบแล้ว</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="edit_status_work">สรุปงาน</label>
                                <select name="status_work" id="edit_status_work" class="form-control">
                                    <option value="" selected="">ไม่เลือก</option>
                                    <option value="ดำเนินการ">ดำเนินการ</option>
                                    <option value="กำลังยิงโฆษณา">กำลังยิงโฆษณา</option>
                                    <option value="งานสำเร็จแล้ว">งานสำเร็จแล้ว</option>
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

@endsection

@section('js_bottom')
<script>

    get_table_list($("#date_search_start").val(), $("#date_search_end").val());
    get_table_freelance($("#date_search_start").val(), $("#date_search_end").val());
    get_table_package($("#date_search_start").val(), $("#date_search_end").val());

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
        get_table_freelance(picker.startDate.format('DD-MM-YYYY'), $('#date_search_end').val());
        get_table_package(picker.startDate.format('DD-MM-YYYY'), $('#date_search_end').val());
    })
    $('#date_search_end').on('apply.daterangepicker', function (e, picker) {
        $(this).val(picker.startDate.format('DD-MM-YYYY'));
        get_table_list($('#date_search_start').val(), picker.startDate.format('DD-MM-YYYY'));
        get_table_freelance($('#date_search_start').val(), picker.startDate.format('DD-MM-YYYY'));
        get_table_package($('#date_search_start').val(), picker.startDate.format('DD-MM-YYYY'));
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
            "lengthMenu": [[10, 30, 50, -1], [10, 30, 50, "All"]],
            "language": {
                "info": "_START_-_END_ of _TOTAL_ entries",
                searchPlaceholder: "Search"
            },
            "ajax": {
                "url": url_gb + "/manage_task/get/get_datatable",
                "data": function (d) {
                    d.date_search_start = date_search_start;
                    d.date_search_end = date_search_end;
                }
            },
            "columns": [
                {"data": "DT_RowIndex", "className": "text-center status_image", "orderable": false, "searchable": false},
                {"data": "pade_date", "className": "text-center status_image"},
                {"data": "pade_name", "className": "text-left status_image", "orderable": false},
                {"data": "package", "className": "text-left status_image", "orderable": false},
                {"data": "freelance", "className": "text-center status_image", "orderable": false},
                {"data": "amount_image", "className": "text-center status_image", "orderable": false},
                {"data": "status_image", "className": "text-center status_image"},
                {"data": "action", "className": "action text-center", "orderable": false, "searchable": false},
                {"data": "link_page", "className": "text-center status_work", "orderable": false},
                {"data": "amount_like", "className": "text-center status_work", "orderable": false},
                {"data": "status_like", "className": "text-center status_work"},
                {"data": "status_work", "className": "text-center status_work"},
            ], "order": [[1, "desc"]],
            rowCallback: function (row, data, index) {
                if (data['status_image'] === 'ภาพครบแล้ว') {
                    $(row).find('.status_image').addClass('row_success_1');
                }
                if (data['status_work'] === 'งานสำเร็จแล้ว') {
                    $(row).find('.status_work').addClass('row_success_2');
                }
            }, drawCallback: function () {
            }
        });
    }

    var Table_freelance;
    function get_table_freelance(date_search_start, date_search_end) {
        if (Table_freelance != undefined) {
            Table_freelance.DataTable().destroy();
        }
        Table_freelance = $('#Table_freelance').dataTable({
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
            "lengthMenu": [[10, 30, 50, -1], [10, 30, 50, "All"]],
            "language": {
                "info": "_START_-_END_ of _TOTAL_ entries",
                searchPlaceholder: "Search"
            },
            "ajax": {
                "url": url_gb + "/manage_task/get/get_datatable_freelance",
                "data": function (d) {
                    d.date_search_start = date_search_start;
                    d.date_search_end = date_search_end;
                }
            },
            "columns": [
                {"data": "freelance", "className": "text-center", "orderable": false},
                {"data": "sum_amount_image", "className": "text-center"},
            ], "order": [[1, "desc"]]
        });
    }

    var Table_package;
    function get_table_package(date_search_start, date_search_end) {
        if (Table_package != undefined) {
            Table_package.DataTable().destroy();
        }
        Table_package = $('#Table_package').dataTable({
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
            "lengthMenu": [[10, 30, 50, -1], [10, 30, 50, "All"]],
            "language": {
                "info": "_START_-_END_ of _TOTAL_ entries",
                searchPlaceholder: "Search"
            },
            "ajax": {
                "url": url_gb + "/manage_task/get/get_datatable_package",
                "data": function (d) {
                    d.date_search_start = date_search_start;
                    d.date_search_end = date_search_end;
                }
            },
            "columns": [
                {"data": "package", "className": "text-center", "orderable": false},
                {"data": "sum_amount_package", "className": "text-center"},
            ], "order": [[1, "desc"]]
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
            }
        });
        $('.date_time-picker').on('apply.daterangepicker', function (ev, picker) {
            $(this).val(picker.startDate.format('DD-MM-YYYY'));
        });
        $('#ModalAdd').modal("show");
    });

    $('#FormAdd').validate({
        focusCleanup: true,
        rules: {
            pade_name: {
                required: true,
            }
        },
        messages: {
            pade_name: {
                required: "กรุณาระบุ",
            }
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
                url: url_gb + "/manage_task",
                dataType: 'json',
                data: $(form).serialize()
            }).done(function (rec) {
                console.log(rec);
                btn.button("reset");
                if (rec.status == 1) {
                    TableList.api().ajax.reload();
                    Table_freelance.api().ajax.reload();
                    Table_package.api().ajax.reload();
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
            }
        });
        $('.date_time-picker').on('apply.daterangepicker', function (ev, picker) {
            $(this).val(picker.startDate.format('DD-MM-YYYY'));
        });

        $.ajax({
            method: "GET",
            url: url_gb + "/manage_task/get/get_by_id/" + id,
            dataType: 'json'
        }).done(function (rec) {

            $('#edit_pade_date').val(rec['pade_date']);
            $('#edit_pade_name').val(rec['manage_task'].pade_name);
            $('#edit_package').val(rec['manage_task'].package);
            $('#edit_freelance').val(rec['manage_task'].freelance);
            $('#edit_amount_image').val(rec['manage_task'].amount_image);
            $('#edit_status_image').val(rec['manage_task'].status_image);
            $('#edit_link_page').val(rec['manage_task'].link_page);
            $('#edit_amount_like').val(rec['manage_task'].amount_like);
            $('#edit_status_like').val(rec['manage_task'].status_like);
            $('#edit_status_work').val(rec['manage_task'].status_work);

            btn.button("reset");
            $('#ModalEdit').modal("show");
        }).fail(function () {
            swal("system.system_alert", "system.system_error", "error");
            btn.button("reset");
        });
    });

    $('#FormEdit').validate({
        rules: {
            pade_name: {
                required: true,
            }
        },
        messages: {
            pade_name: {
                required: "กรุณาระบุ",
            }
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
                url: url_gb + "/manage_task/" + id,
                dataType: 'json',
                data: $(form).serialize()
            }).done(function (rec) {
                console.log(rec);
                btn.button("reset");
                if (rec.status == 1) {
                    TableList.api().ajax.reload();
                    Table_freelance.api().ajax.reload();
                    Table_package.api().ajax.reload();
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
                    url: url_gb + "/manage_task/" + id,
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

</script>
@endsection
