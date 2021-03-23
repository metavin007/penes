@extends('layouts.app_layout')

@section('css_bottom')

@endsection

@section('body')

<div class="container-fluid">
    <div class="row page-titles">
        <div class="col-lg-3 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/profile') }}">ข้อมูลส่วนตัว</a></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">แก้ไขรหัสผ่าน</h2>
                    <hr/>
                    <form id="FormChangePassword">
                        <div class="row">
                            <div class="col-lg-12 col-md-6">
                                <div class="form-group">
                                    <label>อีเมล</label>
                                    <input class="form-control form-control" name="email" type="text" value="{{ \Auth::user()->email }}" readonly="">
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-6">
                                <div class="form-group">
                                    <label>รหัสเก่า</label>
                                    <input class="form-control form-control" type="text" name="old_password" id="old_password" placeholder="">
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-6">
                                <div class="form-group">
                                    <label>รหัสใหม่</label>
                                    <input class="form-control form-control" type="password" name="password" id="password" placeholder="">
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-6">
                                <div class="form-group">
                                    <label>ยืนยันรหัสใหม่</label>
                                    <input class="form-control form-control" type="password" name="password_confirm" placeholder="">
                                </div>  
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="pull-right">
                                    @csrf
                                    <button type="submit" class="btn btn-success float-right btn-lg">เปลี่ยนรหัสผ่าน</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js_bottom')
<script>
    $('#FormChangePassword').validate({
        focusCleanup: true,
        rules: {
            old_password: {
                required: true,
            },
            password: {
                required: true,
            },
            password_confirm: {
                required: true,
                equalTo: "#password"
            }
        },
        messages: {
            old_password: {
                required: 'กรุณาระบุ',
            },
            password: {
                required: 'กรุณาระบุ',
            },
            password_confirm: {
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
                url: url_gb + "/profile/change_password_profile",
                dataType: 'json',
                data: $(form).serialize()
            }).done(function (rec) {
                btn.button("reset");
                if (rec.status == 1) {
                    form.reset();
                    swal({
                        title: rec.title,
                        text: rec.content,
                        type: "success",
                    }).then(() => {
                        location.reload();
                    });
                } else {
                    btn.button("reset");
                    swal({
                        title: rec.title,
                        text: rec.content,
                        type: "error",
                    }).then(() => {
                        location.reload();
                    });
                }
            }).fail(function () {
                swal("system.system_alert", "system.system_error", "error");
                btn.button("reset");
            });
        }
    });
</script>
@endsection