@extends('layouts.app_layout')

@section('css_bottom')
<style>
    .row_success{
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
                    <div class="row mb-2">
                        <div class="col-lg-6">
                            <h4 class="card-title">ตารางจัดการงาน</h4>
                        </div>
                        <div class="col-lg-6">
                            <button class="btn float-right btn-primary btn-add"> สร้าง</button>
                        </div>
                    </div>
                    <div class="table-responsive m-t-40">
                        <table id="Table" class="display nowrap table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <td class="text-center" rowspan="2">ลำดับ</td>
                                    <td class="text-center" rowspan="2">วันที่เปิดงาน</td>
                                    <td class="text-center" rowspan="2">ชื่อเพจ/ชื่องาน</td>
                                    <td class="text-center" rowspan="2">แพ็คเกจ</td>
                                    <td class="text-center" colspan="2">บริษัท</td>
                                    <td class="text-center" colspan="2">{{ $setting_system->name1 }}</td>
                                    <td class="text-center" colspan="2">{{ $setting_system->name2 }}</td>
                                    <td class="text-center" colspan="2">{{ $setting_system->name3 }}</td>
                                    <td class="text-center" colspan="2">{{ $setting_system->name4 }}</td>
                    				<td class="text-center" rowspan="2">ความคืบหน้า</td>
                                    <td class="text-center" rowspan="2">ยอดไลค์</td>
                                    <td class="text-center" rowspan="2">สถานะไลค์</td>
                      				<td class="text-center" rowspan="2">ลิงค์เพจ</td>
									<td class="text-center" rowspan="2">สรุปงาน</td>
									<td class="text-center" rowspan="2">จัดการ</td>
                                </tr>
                                <tr>
                                    <td class="text-center">ช่อง</td>
                                    <td class="text-center">ช่อง</td>
                                    <td class="text-center">สถานะ</td>
                                    <td class="text-center">จำนวนภาพ</td>
                                    <td class="text-center">สถานะ</td>
                                    <td class="text-center">จำนวนภาพ</td>
                                    <td class="text-center">สถานะ</td>
                                    <td class="text-center">จำนวนภาพ</td>
                                    <td class="text-center">สถานะ</td>
                                    <td class="text-center">จำนวนภาพ</td>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <td class="text-center" colspan="7">รวม</td>
                                    <td class="text-center" id="sum_qty_1">0</td>
                                    <td class="text-center"></td>
                                    <td class="text-center" id="sum_qty_2">0</td>
                                    <td class="text-center"></td>
                                    <td class="text-center" id="sum_qty_3">0</td>
                                    <td class="text-center"></td>
                                    <td class="text-center" id="sum_qty_4">0</td>
                                    <td class="text-center" colspan="6"></td>
                                </tr>
                            </tfoot>
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
                        <div class="col-lg-9">
                            <div class="form-group">
                                <label for="add_pade_name">ชื่อเพจ/ชื่องาน</label>
                                <input type="text" name="pade_name" id="add_pade_name" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="add_pade_date">วันที่เปิดงาน</label>
                                <input type="text" name="pade_date" id="add_pade_date" class="form-control date_time-picker" readonly="">
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="form-group">
                                <label for="add_name">แพ็คเกจ</label>
                                <select class="form-control error_put_border package" style="width: 100%;" name="package" id="add_package">
                                    <option disabled="" selected="">กรุณาเลือก</option>
                                    @foreach($packages as $package)      
                                    <option value="{{ $package->name }}" data-price="{{ $package->price }}">{{ $package->name }}</option>     
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="add_price">ราคา</label>
                                <input type="text" name="price" id="add_price" class="form-control price" readonly="">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="add_company_text_1">บริษัท 1</label>
                                <input type="text" name="company_text_1" id="add_company_text_1" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="add_company_text_2">บริษัท 2</label>
                                <input type="text" name="company_text_2" id="add_company_text_2" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-12 table-responsive m-t-40">
                            <table class="display nowrap table table-bordered">
                                <thead>
                                    <tr>
                                        <td>ฟรีแลนซ์</td>
                                        <td>สถานะ</td>
                                        <td>จำนวนภาพ</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">{{ $setting_system->name1 }}</td>
                                        <td>
                                            <select class="form-control error_put_border" style="width: 100%;" name="a_text" id="add_a_text">
                                                <option value="" selected="">ไม่เลือก</option>
                                                @foreach($status_manage_tasks as $status_manage_task)      
                                                <option value="{{ $status_manage_task->name }}">{{ $status_manage_task->name }}</option>     
                                                @endforeach
                                            </select>
                                        </td>
                                        <td><input type="number" name="a_number" id="add_a_number" class="form-control"></td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">{{ $setting_system->name2 }}</td>
                                        <td>
                                            <select class="form-control error_put_border" style="width: 100%;" name="b_text" id="add_b_text">
                                                <option value="" selected="">ไม่เลือก</option>
                                                @foreach($status_manage_tasks as $status_manage_task)      
                                                <option value="{{ $status_manage_task->name }}">{{ $status_manage_task->name }}</option>     
                                                @endforeach
                                            </select>
                                        </td>
                                        <td><input type="number" name="b_number" id="add_b_number" class="form-control"></td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">{{ $setting_system->name3 }}</td>
                                        <td>
                                            <select class="form-control error_put_border" style="width: 100%;" name="c_text" id="add_c_text">
                                                <option value="" selected="">ไม่เลือก</option>
                                                @foreach($status_manage_tasks as $status_manage_task)      
                                                <option value="{{ $status_manage_task->name }}">{{ $status_manage_task->name }}</option>     
                                                @endforeach
                                            </select>
                                        </td>
                                        <td><input type="number" name="c_number" id="add_c_number" class="form-control"></td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">{{ $setting_system->name4 }}</td>
                                        <td>
                                            <select class="form-control error_put_border" style="width: 100%;" name="d_text" id="add_d_text">
                                                <option value="" selected="">ไม่เลือก</option>
                                                @foreach($status_manage_tasks as $status_manage_task)      
                                                <option value="{{ $status_manage_task->name }}">{{ $status_manage_task->name }}</option>     
                                                @endforeach
                                            </select>
                                        </td>
                                        <td><input type="number" name="d_number" id="add_d_number" class="form-control"></td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">{{ $setting_system->name5 }}</td>
                                        <td>
                                            <select class="form-control error_put_border" style="width: 100%;" name="e_text" id="add_e_text">
                                                <option value="" selected="">ไม่เลือก</option>
                                                @foreach($status_manage_tasks as $status_manage_task)      
                                                <option value="{{ $status_manage_task->name }}">{{ $status_manage_task->name }}</option>     
                                                @endforeach
                                            </select>
                                        </td>
                                        <td><input type="number" name="e_number" id="add_e_number" class="form-control"></td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">{{ $setting_system->name6 }}</td>
                                        <td>
                                            <select class="form-control error_put_border" style="width: 100%;" name="f_text" id="add_f_text">
                                                <option value="" selected="">ไม่เลือก</option>
                                                @foreach($status_manage_tasks as $status_manage_task)      
                                                <option value="{{ $status_manage_task->name }}">{{ $status_manage_task->name }}</option>     
                                                @endforeach
                                            </select>
                                        </td>
                                        <td><input type="number" name="f_number" id="add_f_number" class="form-control"></td>
                                    </tr>
                                </tbody>
                            </table>    
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="add_status_progress">ความคืบหน้า</label>
                                <select name="status_progress" id="add_status_progress" class="form-control">
                                    <option value="" selected="">ไม่เลือก</option>
                                    <option value="รอจ่ายงาน">รอจ่ายงาน</option>
                                    <option value="รอแก้ไข">รอแก้ไข</option>
                                    <option value="ครบแล้ว">ครบแล้ว</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="add_amount_like">ยอดไลค์</label>
                                <input type="number" name="amount_like" id="add_amount_like" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="add_status_like">สถานะไลค์</label>
                                <select name="status_like" id="add_status_like" class="form-control">
                                    <option value="" selected="">ไม่เลือก</option>
                                    <option value="กำลังดำเนินการ">กำลังดำเนินการ</option>
                                    <option value="เรียบร้อย">เรียบร้อย</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="form-group">
                                <label for="add_link_page">ลิงค์เพจ</label>
                                <input type="text" name="link_page" id="add_link_page" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="add_status_work">สรุปงาน</label>
                                <select name="status_work" id="add_status_work" class="form-control">
                                    <option value="" selected="">ไม่เลือก</option>
                                    <option value="รอเงิน">รอเงิน</option>
                                    <option value="ยิงโฆษณา">ยิงโฆษณา</option>
                                    <option value="สรุปส่งงานแล้ว">สรุปส่งงานแล้ว</option>
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
                        <div class="col-lg-9">
                            <div class="form-group">
                                <label for="edit_pade_name">ชื่อเพจ/ชื่องาน</label>
                                <input type="text" name="pade_name" id="edit_pade_name" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="edit_pade_date">วันที่เปิดงาน</label>
                                <input type="text" name="pade_date" id="edit_pade_date" class="form-control date_time-picker" readonly="">
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="form-group">
                                <label for="edit_name">แพ็คเกจ</label>
                                <select class="form-control error_put_border package" style="width: 100%;" name="package" id="edit_package">
                                    <option disabled="" selected="">กรุณาเลือก</option>
                                    @foreach($packages as $package)      
                                    <option value="{{ $package->name }}" data-price="{{ $package->price }}">{{ $package->name }}</option>     
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="edit_price">ราคา</label>
                                <input type="text" name="price" id="edit_price" class="form-control price" readonly="">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="edit_company_text_1">บริษัท 1</label>
                                <input type="text" name="company_text_1" id="edit_company_text_1" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="edit_company_text_2">บริษัท 2</label>
                                <input type="text" name="company_text_2" id="edit_company_text_2" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-12 table-responsive m-t-40">
                            <table class="display nowrap table table-bordered">
                                <thead>
                                    <tr>
                                        <td>ฟรีแลนซ์</td>
                                        <td>สถานะ</td>
                                        <td>จำนวนภาพ</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">{{ $setting_system->name1 }}</td>
                                        <td>
                                            <select class="form-control error_put_border" style="width: 100%;" name="a_text" id="edit_a_text">
                                                <option value="" selected="">ไม่เลือก</option>
                                                @foreach($status_manage_tasks as $status_manage_task)      
                                                <option value="{{ $status_manage_task->name }}">{{ $status_manage_task->name }}</option>     
                                                @endforeach
                                            </select>
                                        </td>
                                        <td><input type="number" name="a_number" id="edit_a_number" class="form-control"></td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">{{ $setting_system->name2 }}</td>
                                        <td>
                                            <select class="form-control error_put_border" style="width: 100%;" name="b_text" id="edit_b_text">
                                                <option value="" selected="">ไม่เลือก</option>
                                                @foreach($status_manage_tasks as $status_manage_task)      
                                                <option value="{{ $status_manage_task->name }}">{{ $status_manage_task->name }}</option>     
                                                @endforeach
                                            </select>
                                        </td>
                                        <td><input type="number" name="b_number" id="edit_b_number" class="form-control"></td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">{{ $setting_system->name3 }}</td>
                                        <td>
                                            <select class="form-control error_put_border" style="width: 100%;" name="c_text" id="edit_c_text">
                                                <option value="" selected="">ไม่เลือก</option>
                                                @foreach($status_manage_tasks as $status_manage_task)      
                                                <option value="{{ $status_manage_task->name }}">{{ $status_manage_task->name }}</option>     
                                                @endforeach
                                            </select>
                                        </td>
                                        <td><input type="number" name="c_number" id="edit_c_number" class="form-control"></td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">{{ $setting_system->name4 }}</td>
                                        <td>
                                            <select class="form-control error_put_border" style="width: 100%;" name="d_text" id="edit_d_text">
                                                <option value="" selected="">ไม่เลือก</option>
                                                @foreach($status_manage_tasks as $status_manage_task)      
                                                <option value="{{ $status_manage_task->name }}">{{ $status_manage_task->name }}</option>     
                                                @endforeach
                                            </select>
                                        </td>
                                        <td><input type="number" name="d_number" id="edit_d_number" class="form-control"></td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">{{ $setting_system->name5 }}</td>
                                        <td>
                                            <select class="form-control error_put_border" style="width: 100%;" name="e_text" id="edit_e_text">
                                                <option value="" selected="">ไม่เลือก</option>
                                                @foreach($status_manage_tasks as $status_manage_task)      
                                                <option value="{{ $status_manage_task->name }}">{{ $status_manage_task->name }}</option>     
                                                @endforeach
                                            </select>
                                        </td>
                                        <td><input type="number" name="e_number" id="edit_e_number" class="form-control"></td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">{{ $setting_system->name6 }}</td>
                                        <td>
                                            <select class="form-control error_put_border" style="width: 100%;" name="f_text" id="edit_f_text">
                                                <option value="" selected="">ไม่เลือก</option>
                                                @foreach($status_manage_tasks as $status_manage_task)      
                                                <option value="{{ $status_manage_task->name }}">{{ $status_manage_task->name }}</option>     
                                                @endforeach
                                            </select>
                                        </td>
                                        <td><input type="number" name="f_number" id="edit_f_number" class="form-control"></td>
                                    </tr>
                                </tbody>
                            </table>    
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="edit_status_progress">ความคืบหน้า</label>
                                <select name="status_progress" id="edit_status_progress" class="form-control">
                                    <option value="" selected="">ไม่เลือก</option>
                                    <option value="รอจ่ายงาน">รอจ่ายงาน</option>
                                    <option value="รอแก้ไข">รอแก้ไข</option>
                                    <option value="ครบแล้ว">ครบแล้ว</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="edit_amount_like">ยอดไลค์</label>
                                <input type="number" name="amount_like" id="edit_amount_like" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="edit_status_like">สถานะไลค์</label>
                                <select name="status_like" id="edit_status_like" class="form-control">
                                    <option value="" selected="">ไม่เลือก</option>
                                    <option value="กำลังดำเนินการ">กำลังดำเนินการ</option>
                                    <option value="เรียบร้อย">เรียบร้อย</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="form-group">
                                <label for="edit_link_page">ลิงค์เพจ</label>
                                <input type="text" name="link_page" id="edit_link_page" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="edit_status_work">สรุปงาน</label>
                                <select name="status_work" id="edit_status_work" class="form-control">
                                    <option value="" selected="">ไม่เลือก</option>
                                    <option value="รอเงิน">รอเงิน</option>
                                    <option value="ยิงโฆษณา">ยิงโฆษณา</option>
                                    <option value="สรุปส่งงานแล้ว">สรุปส่งงานแล้ว</option>
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

    $('body').on('change', '.package', function () {
        $(this).closest('.modal-body').find('.price').val($(this).find(':selected').data('price'));
    });

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
        pageLength: 30,
        "lengthMenu": [[10, 30, 50, -1], [10, 30, 50, "All"]],
        "language": {
            "info": "_START_-_END_ of _TOTAL_ entries",
            searchPlaceholder: "Search"
        },
        "ajax": {
            "url": url_gb + "/manage_task/get/get_datatable",
            "data": function (d) {
                //d.myKey = "myValue";
                // d.custom = $('#myInput').val();
                // etc
            }
        },
        "columns": [
            {"data": "DT_RowIndex", "className": "text-center", "orderable": false, "searchable": false},
            {"data": "pade_date", "className": "text-center"},
            {"data": "pade_name", "className": "text-left"},
            {"data": "package", "className": "text-left"},
            {"data": "company_text_1", "className": "text-center"},
            {"data": "company_text_2", "className": "text-center"},
            {"data": "a_text", "className": "text-center"},
            {"data": "a_number", "className": "text-center"},
            {"data": "b_text", "className": "text-center"},
            {"data": "b_number", "className": "text-center"},
            {"data": "c_text", "className": "text-center"},
            {"data": "c_number", "className": "text-center"},
            {"data": "d_text", "className": "text-center"},
            {"data": "d_number", "className": "text-center"},
            {"data": "status_progress", "className": "text-center"},
            {"data": "amount_like", "className": "text-right"},
            {"data": "status_like", "className": "text-center"},
     		{"data": "link_page", "className": "text-center"},
			{"data": "status_work", "className": "text-center"},
			{"data": "action", "className": "action text-center", "orderable": false, "searchable": false},
        ], "order": [[1, "desc"]],
        rowCallback: function (row, data, index) {
            if (data['status_work'] === 'สรุปส่งงานแล้ว') {
                $(row).addClass('row_success');
            }
        }, drawCallback: function () {
            var api = this.api();
            var sum_qty_1 = 0;
            var sum_qty_2 = 0;
            var sum_qty_3 = 0;
            var sum_qty_4 = 0;
            var sum_qty_5 = 0;
            var sum_qty_6 = 0;
            api.column(8).data().reduce(function (a, value) {
                sum_qty_1 = Number(sum_qty_1) + Number(value);
            }, 0)
            api.column(10).data().reduce(function (a, value) {
                sum_qty_2 = Number(sum_qty_2) + Number(value);
            }, 0)
            api.column(12).data().reduce(function (a, value) {
                sum_qty_3 = Number(sum_qty_3) + Number(value);
            }, 0)
            api.column(14).data().reduce(function (a, value) {
                sum_qty_4 = Number(sum_qty_4) + Number(value);
            }, 0)
            api.column(16).data().reduce(function (a, value) {
                sum_qty_5 = Number(sum_qty_5) + Number(value);
            }, 0)
            api.column(18).data().reduce(function (a, value) {
                sum_qty_6 = Number(sum_qty_6) + Number(value);
            }, 0)
            $('#sum_qty_1').html(sum_qty_1);
            $('#sum_qty_2').html(sum_qty_2);
            $('#sum_qty_3').html(sum_qty_3);
            $('#sum_qty_4').html(sum_qty_4);
            $('#sum_qty_5').html(sum_qty_5);
            $('#sum_qty_6').html(sum_qty_6);
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

            $('#edit_pade_name').val(rec['manage_task'].pade_name);
            $('#edit_pade_date').val(rec['pade_date']);
            $('#edit_package').val(rec['manage_task'].package);
            $('#edit_price').val(rec['manage_task'].price);

            $('#edit_company_text_1').val(rec['manage_task'].company_text_1);
            $('#edit_company_text_2').val(rec['manage_task'].company_text_2);

            $('#edit_a_text').val(rec['manage_task'].a_text);
            $('#edit_a_number').val(rec['manage_task'].a_number);

            $('#edit_b_text').val(rec['manage_task'].b_text);
            $('#edit_b_number').val(rec['manage_task'].b_number);

            $('#edit_c_text').val(rec['manage_task'].c_text);
            $('#edit_c_number').val(rec['manage_task'].c_number);

            $('#edit_d_text').val(rec['manage_task'].d_text);
            $('#edit_d_number').val(rec['manage_task'].d_number);

            $('#edit_e_text').val(rec['manage_task'].e_text);
            $('#edit_e_number').val(rec['manage_task'].e_number);

            $('#edit_f_text').val(rec['manage_task'].f_text);
            $('#edit_f_number').val(rec['manage_task'].f_number);

            $('#edit_status_progress').val(rec['manage_task'].status_progress);
            $('#edit_amount_like').val(rec['manage_task'].amount_like);
            $('#edit_status_like').val(rec['manage_task'].status_like);
            $('#edit_link_page').val(rec['manage_task'].link_page);
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
