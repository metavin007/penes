@extends('layouts.app_layout')

@section('css_bottom')

@endsection

@section('body')

<div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-6 col-8 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/user') }}">ตารางพนักงาน</a></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-lg-6">
                            <h4 class="card-title">ตารางพนักงาน</h4>
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
                                    <td class="text-center">ชื่อ-นามสกุล</td>
                                    <td class="text-center">ชื่อเล่น</td>
                                    <td class="text-center">เบอร์มือถือ</td>
                                    <td class="text-center">อีเมล</td>
                                    <td class="text-center">แผนก</td>
                                    <td class="text-center">สิทธิผู้ใช้งาน</td>
                                    <td class="text-center">วันที่เพิ่มข้อมูล</td>
                                    <td class="text-center">จัดการ</td>
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
                <h3 class="card-title" id="myLargeModalLabel">เพิ่ม</h3>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form id="FormAdd">
                <div class="modal-body">
                    <h3 class="card-title text-center" id="myLargeModalLabel">ข้อมูลส่วนตัว</h3>
                    <hr/>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="add_code">รหัสพนักงาน</label>
                                <input class="form-control" name="code" id="add_code" type="text">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="add_pid">เลขประจำตัวประชาชน</label>
                                <input class="form-control" name="pid" id="add_pid" type="text">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="add_role">สิทธิผู้ใช้งาน</label>
                                <select name="role" id="add_role" class="form-control">
                                    <option selected="" disabled="">กรุณาเลือก</option>
                                    <option value="CEO">CEO</option>
                                    <option value="Admin">Admin</option>
                                    <option value="General">General</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="add_first_name">ชื่อ</label>
                                <input class="form-control" name="first_name" id="add_first_name" type="text">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="add_last_name">นามสกุล</label>
                                <input class="form-control" name="last_name" id="add_last_name" type="text">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="add_nick_name">ชื่อเล่น</label>
                                <input class="form-control" name="nick_name" id="add_nick_name" type="text">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-address">
                                <label for="add_address">ที่อยู่</label>
                                <textarea class="form-control" name="address" id="add_address"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="add_mobile">เบอร์มือถือ</label>
                                <input class="form-control" name="mobile" id="add_mobile" type="text">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="add_department">แผนก</label>
                                <input class="form-control" name="department" id="add_department" type="text">
                            </div>
                        </div>
                    </div>
                    <h3 class="card-title text-center" id="myLargeModalLabel">เข้าสู่ระบบ</h3>
                    <hr/>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="add_email">อีเมล</label>
                                <input class="form-control" name="email" id="add_email" type="text">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="password">รหัสผ่าน</label>
                                <input class="form-control" type="password" id="password" name="password">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="password_confirm">ยืนยันรหัสผ่าน</label>
                                <input class="form-control" type="password" id="password_confirm" name="password_confirm">
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
                <h3 class="card-title" id="myLargeModalLabel">แก้ไข</h3>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <input type="hidden" id="update_id">
            <form id="FormEdit">
                <div class="modal-body">
                    <h3 class="card-title text-center" id="myLargeModalLabel">ข้อมูลส่วนตัว</h3>
                    <hr/>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="edit_code">รหัสพนักงาน</label>
                                <input class="form-control" name="code" id="edit_code" type="text">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="edit_pid">เลขประจำตัวประชาชน</label>
                                <input class="form-control" name="pid" id="edit_pid" type="text">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="edit_role">สิทธิผู้ใช้งาน</label>
                                <select name="role" id="edit_role" class="form-control">
                                    <option selected="" disabled="">กรุณาเลือก</option>
                                    <option value="CEO">CEO</option>
                                    <option value="Admin">Admin</option>
                                    <option value="General">General</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="edit_first_name">ชื่อ</label>
                                <input class="form-control" name="first_name" id="edit_first_name" type="text">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="edit_last_name">นามสกุล</label>
                                <input class="form-control" name="last_name" id="edit_last_name" type="text">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="edit_nick_name">ชื่อเล่น</label>
                                <input class="form-control" name="nick_name" id="edit_nick_name" type="text">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-address">
                                <label for="edit_address">ที่อยู่</label>
                                <textarea class="form-control" name="address" id="edit_address"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="edit_mobile">เบอร์มือถือ</label>
                                <input class="form-control" name="mobile" id="edit_mobile" type="text">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="edit_department">แผนก</label>
                                <input class="form-control" name="department" id="edit_department" type="text">
                            </div>
                        </div>
                    </div>
                    <h3 class="card-title text-center" id="myLargeModalLabel">เข้าสู่ระบบ</h3>
                    <hr/>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="edit_email">อีเมล</label>
                                <input class="form-control" name="email" id="edit_email" type="text">
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

<div class="modal fade" id="ModalChangePassword" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="card-title" id="myLargeModalLabel">เปลี่ยนรหัสผ่าน</h3>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form id="FormChangePassword">
                <input type="hidden" id="update_password_id" name="update_id" value="">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="add_new_password">รหัสใหม่</label>
                                <input type="password" id="add_new_password" name="password" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-5 col-sm-5"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn pull-right waves-effect waves-light btn-lg btn-success">บันทึก</button>
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
            "url": url_gb + "/user/get/get_datatable",
            "data": function (d) {
                //d.myKey = "myValue";
                // d.custom = $('#myInput').val();
                // etc
            }
        },
        "columns": [
            {"data": "DT_RowIndex", "className": "text-center", "orderable": false, "searchable": false},
            {"data": "first_name", "className": "text-center"},
            {"data": "nick_name", "className": "text-center"},
            {"data": "mobile", "className": "text-center"},
            {"data": "email", "className": "text-center"},
            {"data": "department", "className": "text-center"},
            {"data": "role", "className": "text-center"},
            {"data": "created_at", "className": "text-center"},
            {"data": "action", "className": "action text-center", "orderable": false, "searchable": false}
        ], "order": [[3, "desc"]],
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
            first_name: {
                required: true,
            }, role: {
                required: true,
            }, email: {
                required: true,
            }, password: {
                required: true,
            }, password_confirm: {
                required: true,
                equalTo: "#password"
            }
        },
        messages: {
            first_name: {
                required: 'กรุณาระบุ',
            }, role: {
                required: 'กรุณาระบุ',
            }, email: {
                required: 'กรุณาระบุ',
            }, password: {
                required: 'กรุณาระบุ',
            }, password_confirm: {
                required: "กรุณาระบุ",
                equalTo: "รหัสไม่ตรงกับกับช่อง password",
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
                url: url_gb + "/user",
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
        $.ajax({
            method: "GET",
            url: url_gb + "/user/get/get_by_id/" + id,
            dataType: 'json'
        }).done(function (rec) {

            $('#edit_code').val(rec.code);
            $('#edit_pid').val(rec.pid);
            $('#edit_role').val(rec.role);
            $('#edit_first_name').val(rec.first_name);
            $('#edit_last_name').val(rec.last_name);
            $('#edit_nick_name').val(rec.nick_name);
            $('#edit_address').val(rec.address);
            $('#edit_mobile').val(rec.mobile);
            $('#edit_department').val(rec.department);

            $('#edit_email').val(rec.email);

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
                url: url_gb + "/user/" + id,
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
                    url: url_gb + "/user/" + id,
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


    // show modal change_password
    $('body').on('click', '.btn-change_password', function (e) {
        e.preventDefault();
        var btn = $(this);
        var id = $(this).data('id');
        $('#update_password_id').val(id);
        $('#ModalChangePassword').modal("show");
    });

    // edit change_password
    $('#FormChangePassword').validate({
        focusCleanup: true,
        rules: {
            password: {
                required: true,
                minlength: 6
            }
        },
        messages: {
            password: {
                required: "กรุณาระบุ",
                minlength: "กรุณากรอกอย่างน้อย 6 ตัวอักษร"
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
            var id = $('#update_password_id').val();
            btn.button("loading");
            $.ajax({
                method: "POST",
                url: url_gb + "/user/update/change_password/" + id,
                dataType: 'json',
                data: $(form).serialize()
            }).done(function (rec) {
                console.log(rec);
                btn.button("reset");
                if (rec.status == 1) {
                    TableList.api().ajax.reload();
                    form.reset();
                    swal(rec.title, rec.content, "success");
                    $('#ModalChangePassword').modal('hide');
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
