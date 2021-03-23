@extends('layouts.app_layout')

@section('css_bottom')

@endsection

@section('body')

<div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-6 col-8 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('setting_system') }}">ตั้งค่าชื่อฟรีแลนซ์</a></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">ตั้งค่าชื่อฟรีแลนซ์</h4>
                    <form id="FormEdit">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="add_name1">ชื่อ1</label>
                                    <input type="text" name="name1" id="add_name1" class="form-control" value="{{ $setting_system->name1 }}" required="">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="add_name2">ชื่อ2</label>
                                    <input type="text" name="name2" id="add_name2" class="form-control" value="{{ $setting_system->name2 }}" required="">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="add_name3">ชื่อ3</label>
                                    <input type="text" name="name3" id="add_name1" class="form-control" value="{{ $setting_system->name3 }}" required="">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="add_name4">ชื่อ4</label>
                                    <input type="text" name="name4" id="add_name4" class="form-control" value="{{ $setting_system->name4 }}" required="">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="add_name5">ชื่อ5</label>
                                    <input type="text" name="name5" id="add_name5" class="form-control" value="{{ $setting_system->name5 }}" required="">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="add_name6">ชื่อ6</label>
                                    <input type="text" name="name6" id="add_name6" class="form-control" value="{{ $setting_system->name6 }}" required="">
                                </div>
                            </div>
                        </div>
                        <hr/>
                        <div class="row">
                            <div class="col-lg-12 text-right">
                                <button type="submit" class="btn btn-lg btn-success">บันทึก</button>
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

    $('#FormEdit').validate({
        rules: {
            add_name1: {
                required: true,
            }, add_name2: {
                required: true,
            }, add_name3: {
                required: true,
            }, add_name4: {
                required: true,
            }, add_name5: {
                required: true,
            }, add_name6: {
                required: true,
            }
        },
        messages: {
            add_name1: {
                required: "กรุณาระบุ",
            }, add_name2: {
                required: "กรุณาระบุ",
            }, add_name3: {
                required: "กรุณาระบุ",
            }, add_name4: {
                required: "กรุณาระบุ",
            }, add_name5: {
                required: "กรุณาระบุ",
            }, add_name6: {
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
                url: url_gb + "/setting_system/post/update_setting/1",
                dataType: 'json',
                data: $(form).serialize()
            }).done(function (rec) {
                console.log(rec);
                btn.button("reset");
                if (rec.status == 1) {
                    form.reset();
                    swal(rec.title, rec.content, "success").then(function (result) {
                        window.location.href = url_gb + '/setting_system';
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

</script>
@endsection
