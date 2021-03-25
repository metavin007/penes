@extends('layouts.app_layout')

@section('css_bottom')
<style>
    /*จัดการ*/
    .row_status_1{
        color: #e49900;
    }
    /*แจ้งต่อบริการ*/
    .row_status_2{
     color: #f00;
    background-color: #ffffff;
    }
    /*ชำระแล้ว*/
    .row_status_3{
    color: #078002;
    background-color: #ffff;
    }
    /*ไม่ต่อบริการ*/
    .row_status_4 {
    color: #716c6c7a;
   background-color: #eeeeee;
}
</style>
@endsection

@section('body')

<div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-6 col-8 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/customer_google_ads') }}">ตารางลูกค้า google ads</a></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-lg-6">
                            <h4 class=""> ตารางลูกค้า Google Ads </h4>
                        </div>
                        <div class="col-lg-6">
                            <button class="btn float-right btn-info btn-add btn-lg"> สร้าง</button>
                        </div>
                    </div>
                    <div class="table-responsive m-t-40">
                        <table id="Table" class="display nowrap table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <td class="text-center">ลำดับ</td>
                                    <td class="text-center">ชื่อธุรกิจ</td>
                                    <td class="text-center">ราคา</td>
                                    <td class="text-center">ชำระล่วงหน้า</td>
                                    <td class="text-center">วันที่สิ้นสุดบริการ</td>
                                    <td class="text-center">ข้อมูลติดต่อ</td>
                                    <td class="text-center">สถานะ</td>
                                    <td class="text-center">จัดการโฆษณา</td>
                                    <td class="text-center">จัดการ</td>
                                    <td class="text-center">ชื่อเว๊ป</td>
                                    <td class="text-center">วันหมดอายุเว๊ปไซด์</td>
                             
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
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="text-center" id="myLargeModalLabel">เพิ่มงาน</h3>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form id="FormAdd">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="add_name">ชื่องาน</label>
                                <input type="text" name="name" id="add_name" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="add_price">ราคา</label>
                                <input type="number" name="price" id="add_price" class="form-control text-right">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="add_prepay">ชำระล่วงหน้า</label>
                                <select name="prepay" id="add_prepay" class="form-control">
                                    <option selected="" disabled="">กรุณาเลือก</option>
                                    <option value="1 เดือน">1 เดือน</option>
                                    <option value="3 เดือน">3 เดือน</option>
                                    <option value="6 เดือน">6 เดือน</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="add_service_end_date">วันที่สิ้นสุดบริการ</label>
                                <input type="text" name="service_end_date" id="add_service_end_date" class="form-control date_time-picker" readonly="">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="add_manage_ads">จัดการโฆษณา</label>
                                <textarea class="form-control" name="manage_ads" id="add_manage_ads" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="add_contact">ข้อมูลติดต่อ</label>
                                <textarea class="form-control" name="contact" id="add_contact" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="add_link_web">ชื่อเว็บ</label>
                                <input type="text" name="link_web" id="add_link_web" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="add_expired_web_date">วันหมดอายุเว็บไซด์</label>
                                <input type="text" name="expired_web_date" id="add_expired_web_date" class="form-control date_time-picker" readonly="">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="add_status">สถานะ</label>
                                <select name="status" id="add_status" class="form-control">
                                    <option value="" selected="">ไม่เลือก</option>
                                    <option value="แจ้งเติมเงิน">แจ้งเติมเงิน</option>
                                    <option value="แจ้งต่อบริการ">แจ้งต่อบริการ</option>
                                    <option value="ชำระแล้ว">ชำระแล้ว</option>
                                    <option value="ไม่ต่อบริการ">ไม่ต่อบริการ</option>
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
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="text-center" id="myLargeModalLabel">จัดการงาน</h3>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <input type="hidden" id="update_id">
            <form id="FormEdit">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="edit_name">ชื่องาน</label>
                                <input type="text" name="name" id="edit_name" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="edit_price">ราคา</label>
                                <input type="number" name="price" id="edit_price" class="form-control text-right">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="edit_prepay">ชำระล่วงหน้า</label>
                                <select name="prepay" id="edit_prepay" class="form-control">
                                    <option selected="" disabled="">กรุณาเลือก</option>
                                    <option value="1 เดือน">1 เดือน</option>
                                    <option value="3 เดือน">3 เดือน</option>
                                    <option value="6 เดือน">6 เดือน</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="edit_service_end_date">วันที่สิ้นสุดบริการ</label>
                                <input type="text" name="service_end_date" id="edit_service_end_date" class="form-control date_time-picker" readonly="">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="edit_manage_ads">จัดการโฆษณา</label>
                                <textarea class="form-control" name="manage_ads" id="edit_manage_ads" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="edit_contact">ข้อมูลติดต่อ</label>
                                <textarea class="form-control" name="contact" id="edit_contact" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="edit_link_web">ชื่อเว็บ</label>
                                <input type="text" name="link_web" id="edit_link_web" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="edit_expired_web_date">วันหมดอายุเว็บไซด์</label>
                                <input type="text" name="expired_web_date" id="edit_expired_web_date" class="form-control date_time-picker" readonly="">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="edit_status">สถานะ</label>
                                <select name="status" id="edit_status" class="form-control">
                                    <option value="" selected="">ไม่เลือก</option>
                                    <option value="แจ้งเติมเงิน">แจ้งเติมเงิน</option>
                                    <option value="แจ้งต่อบริการ">แจ้งต่อบริการ</option>
                                    <option value="ชำระแล้ว">ชำระแล้ว</option>
                                    <option value="ไม่ต่อบริการ">ไม่ต่อบริการ</option>
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
            "url": url_gb + "/customer_google_adses/get/get_datatable",
            "data": function (d) {
                //d.myKey = "myValue";
                // d.custom = $('#myInput').val();
                // etc
            }
        },
        "columns": [
            {"data": "DT_RowIndex", "className": "text-center", "orderable": false, "searchable": false},
            {"data": "name", "orderable": false},
            {"data": "price", "className": "text-right", "orderable": false},
            {"data": "prepay", "className": "text-center", "orderable": false},
            {"data": "service_end_date", "className": "text-center"},
            {"data": "contact", "className": "text-right", "orderable": false},
             {"data": "status", "className": "text-center"},
             {"data": "manage_ads", "className": "text-center", "orderable": false},
            {"data": "action", "className": "action text-center", "orderable": false, "searchable": false},
            {"data": "link_web", "className": "text-center", "orderable": false},
            {"data": "expired_web_date", "className": "text-center"},
           
        ], "order": [[4, "asc"]],
        rowCallback: function (row, data, index) {
            if (data['status'] === 'แจ้งเติมเงิน') {
                $(row).addClass('row_status_1');
            } else if (data['status'] === 'แจ้งต่อบริการ') {
                $(row).addClass('row_status_2');
            } else if (data['status'] === 'ชำระแล้ว') {
                $(row).addClass('row_status_3');
            } else if (data['status'] === 'ไม่ต่อบริการ') {
                $(row).addClass('row_status_4');
            }
        }
    });

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
        $('#ModalAdd').modal("show");
    });

    $('#FormAdd').validate({
        focusCleanup: true,
        rules: {
            name: {
                required: true,
            },
            price: {
                required: true,
            },
        },
        messages: {
            name: {
                required: "กรุณาระบุ",
            },
            price: {
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
                url: url_gb + "/customer_google_adses",
                dataType: 'json',
                data: $(form).serialize()
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
            url: url_gb + "/customer_google_adses/get/get_by_id/" + id,
            dataType: 'json'
        }).done(function (rec) {

            $('#edit_name').val(rec['customer_google_ads'].name);
            $('#edit_price').val(rec['customer_google_ads'].price);
            $('#edit_prepay').val(rec['customer_google_ads'].prepay);
            $('#edit_service_end_date').val(rec['service_end_date']);
            $('#edit_manage_ads').val(rec['customer_google_ads'].manage_ads);
            $('#edit_contact').val(rec['customer_google_ads'].contact);
            $('#edit_link_web').val(rec['customer_google_ads'].link_web);
            $('#edit_expired_web_date').val(rec['expired_web_date']);
            $('#edit_status').val(rec['customer_google_ads'].status);

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
            price: {
                required: true,
            },
        },
        messages: {
            name: {
                required: "กรุณาระบุ",
            },
            price: {
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
                url: url_gb + "/customer_google_adses/" + id,
                dataType: 'json',
                data: $(form).serialize()
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
            text: "ตรวจสอบให้แน่ใจก่อนลบข้อมูล",
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
                    url: url_gb + "/customer_google_adses/" + id,
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
