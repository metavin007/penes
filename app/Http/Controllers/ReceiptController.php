<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Receipt;

class ReceiptController extends Controller {

    public function index() {
        return view('receipt');
    }

    public function create() {
        // ฟังก์ชั่นนี้เอาไว้เรียก view หน้า add
    }

    public function store(Request $request) {

        $input_all = $request->all();

        if (isset($input_all['receipt_date'])) {
            $input_all['receipt_date'] = date('Y-m-d', strtotime($input_all['receipt_date']));
        }

        $dir = 'uploads/receipt/';
        if (isset($input_all['file'])) {
            $extension_file = $request->file('file')->getClientOriginalExtension();
            $input_all['file'] = uniqid() . '_' . time() . '.' . $extension_file;
            $request->file('file')->move($dir, $input_all['file']);
        }

        $input_all['created_at'] = date('Y-m-d H:i:s');
        $input_all['created_by'] = \Auth::user()->id;
        $input_all['updated_at'] = date('Y-m-d H:i:s');
        $input_all['updated_by'] = \Auth::user()->id;

        $validator = Validator::make($request->all(), [
                    'name' => 'required',
        ]);

        $return['title'] = 'เพิ่มข้อมูล';

        if ($validator->fails()) {
            $return['status'] = 0;
            $return['content'] = $validator->errors()->first();
            return $return;
        }

        \DB::beginTransaction();
        try {
            Receipt::insert($input_all);
            \DB::commit();
            $return['status'] = 1;
            $return['content'] = 'สำเร็จ';
        } catch (Exception $e) {
            \DB::rollBack();
            $return['status'] = 0;
            $return['content'] = 'ไม่สำเร็จ' . $e->getMessage();
        }
        return $return;
    }

    public function get_by_id($id) {
        $result['receipt'] = Receipt::find($id);
        $result['receipt_date'] = date('d-m-Y', strtotime($result['receipt']->receipt_date));
        return json_encode($result);
    }

    public function update_data(Request $request, $id) {

        $input_all = $request->all();

        if (isset($input_all['receipt_date'])) {
            $input_all['receipt_date'] = date('Y-m-d', strtotime($input_all['receipt_date']));
        }

        $dir = 'uploads/receipt/';
        if (isset($input_all['file'])) {
            $extension_file = $request->file('file')->getClientOriginalExtension();
            $input_all['file'] = uniqid() . '_' . time() . '.' . $extension_file;
            $request->file('file')->move($dir, $input_all['file']);

            $receipt = receipt::find($id);
            if ($receipt) {
                \File::delete(public_path('uploads/receipt/' . $receipt->file));
            }
        }

        $input_all['updated_at'] = date('Y-m-d H:i:s');
        $input_all['updated_by'] = \Auth::user()->id;

        $validator = Validator::make($request->all(), [
                    'name' => 'required',
        ]);

        $return['title'] = 'แก้ไขข้อมูล';

        if ($validator->fails()) {
            $return['status'] = 0;
            $return['content'] = $validator->errors()->first();
            return $return;
        }

        \DB::beginTransaction();
        try {

            Receipt::where('id', $id)->update($input_all);

            \DB::commit();
            $return['status'] = 1;
            $return['content'] = 'สำเร็จ';
        } catch (Exception $e) {
            \DB::rollBack();
            $return['status'] = 0;
            $return['content'] = 'ติด Validation : ' . json_encode($validator->failed());
        }
        return $return;
    }

    public function destroy($id) {
        $return['title'] = 'ลบข้อมูล';
        \DB::beginTransaction();
        try {

            $receipt = receipt::find($id);
            if ($receipt) {
                \File::delete(public_path('uploads/receipt/' . $receipt->file));
            }

            Receipt::where('id', $id)->delete();

            \DB::commit();
            $return['status'] = 1;
            $return['content'] = 'สำเร็จ';
        } catch (Exception $e) {
            \DB::rollBack();
            $return['status'] = 0;
            $return['content'] = 'ไม่สำเร็จ' . $e->getMessage();
        }
        return $return;
    }

    public function get_datatable() {
        $result = Receipt::select();
        return \DataTables::of($result)
                        ->addIndexColumn()
                        ->editColumn('file', function($rec) {
                            if ($rec->file) {
                                $str = '
                          <button type="button" class="btn btn-look_pic btn-info" data-id="' . $rec->id . '"><i class="me-2 mdi mdi-eye"></i> ดูภาพ</button>
                          <button type="button" class="btn btn-info"><a style="color:white;" href="' . asset('uploads/receipt/' . $rec->file) . '" download=""><i class="me-2 mdi mdi-download"></i>ดาวห์โหลด</a></button>   
                            ';
                            } else {
                                $str = '';
                            }
                            return $str;
                        })
                        ->editColumn('receipt_date', function($rec) {
                            return DateThai($rec->receipt_date);
                        })
                        ->editColumn('receipt_file', function($rec) {
                            if ($rec->receipt_file) {
                                $str = '
                                        <button type="button" class="btn btn-success" "><a style="color:white;" href="' . asset('uploads/receipt_file/' . $rec->receipt_file) . '" download=""><i class="me-2 mdi mdi-download"></i>โหลดใบเสร็จ </a></button>   
                                    ';
                            } else {
                                $str = '';
                            }
                            return $str;
                        })
                        ->editColumn('status', function($rec) {
                            if ($rec->status == 'ขอใบเสร็จ') {
                                return '<div role="alert" style ="color: #0e7b1b ;">ขอใบเสร็จ</div>';
                            } else {
                                return '';
                            }
                        })
                        ->addColumn('action', function($rec) {

                            if ($rec->status == 'ขอใบเสร็จ') {
                                $str = '<button type="button" class="btn btn-upload btn-outline-success" data-id="' . $rec->id . '"><i class="me-2 mdi mdi-file-pdf"></i> อัพใบเสร็จ</button>';
                                } else {
                                $str = '';
                            }
                           

                            $str .= '
                          <button type="button" class="btn btn-edit btn-warning" data-id="' . $rec->id . '">แก้ไข</button>
                          <button type="button" class="btn btn-delete btn-danger" data-id="' . $rec->id . '" data-name="' . $rec->name . '">ลบ</button>   
                            ';
                            
                            return $str;
                        })->rawColumns(['file','receipt_file', 'status', 'action'])->make(true);
    }

    public function update_upload(Request $request, $id) {

        $input_all = $request->all();

        $dir = 'uploads/receipt_file/';
        if (isset($input_all['receipt_file'])) {
            $extension_file = $request->file('receipt_file')->getClientOriginalExtension();
            $input_all['receipt_file'] = uniqid() . '_' . time() . '.' . $extension_file;
            $request->file('receipt_file')->move($dir, $input_all['receipt_file']);

            $receipt = receipt::find($id);
            if ($receipt && $receipt->receipt_file) {
                \File::delete(public_path('uploads/receipt_file/' . $receipt->receipt_file));
            }
        }

        $input_all['updated_at'] = date('Y-m-d H:i:s');
        $input_all['updated_by'] = \Auth::user()->id;

        $validator = Validator::make($request->all(), [
//                    'name' => 'required',
        ]);

        $return['title'] = 'แก้ไขข้อมูล';

        if ($validator->fails()) {
            $return['status'] = 0;
            $return['content'] = $validator->errors()->first();
            return $return;
        }

        \DB::beginTransaction();
        try {

            Receipt::where('id', $id)->update($input_all);

            \DB::commit();
            $return['status'] = 1;
            $return['content'] = 'สำเร็จ';
        } catch (Exception $e) {
            \DB::rollBack();
            $return['status'] = 0;
            $return['content'] = 'ติด Validation : ' . json_encode($validator->failed());
        }
        return $return;
    }

}
