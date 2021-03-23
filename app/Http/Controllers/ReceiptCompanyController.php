<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ReceiptCompany;

class ReceiptCompanyController extends Controller {

    public function index() {
        return view('receipt_company');
    }

    public function create() {
        // ฟังก์ชั่นนี้เอาไว้เรียก view หน้า add
    }

    public function store(Request $request) {

        $input_all = $request->all();

        if (isset($input_all['receipt_date'])) {
            $input_all['receipt_date'] = date('Y-m-d', strtotime($input_all['receipt_date']));
        }

        $dir = 'uploads/receipt_company/';
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
            ReceiptCompany::insert($input_all);
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
        $result['receipt'] = ReceiptCompany::find($id);
        $result['receipt_date'] = date('d-m-Y', strtotime($result['receipt']->receipt_date));
        return json_encode($result);
    }

    public function update_data(Request $request, $id) {

        $input_all = $request->all();

        if (isset($input_all['receipt_date'])) {
            $input_all['receipt_date'] = date('Y-m-d', strtotime($input_all['receipt_date']));
        }

        $dir = 'uploads/receipt_company/';
        if (isset($input_all['file'])) {
            $extension_file = $request->file('file')->getClientOriginalExtension();
            $input_all['file'] = uniqid() . '_' . time() . '.' . $extension_file;
            $request->file('file')->move($dir, $input_all['file']);

            $receipt = ReceiptCompany::find($id);
            if ($receipt) {
                \File::delete(public_path('uploads/receipt_company/' . $receipt->file));
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

            ReceiptCompany::where('id', $id)->update($input_all);

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

            $receipt = ReceiptCompany::find($id);
            if ($receipt) {
                \File::delete(public_path('uploads/receipt_company/' . $receipt->file));
            }

            ReceiptCompany::where('id', $id)->delete();

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
        $result = ReceiptCompany::select();
        return \DataTables::of($result)
                        ->addIndexColumn()
                        ->editColumn('file', function($rec) {
                            if ($rec->file) {
                                $str = '
                          <button type="button" class="btn btn-look_pic btn-info" data-id="' . $rec->id . '">ดูภาพ</button>
                          <button type="button" class="btn btn-inverse"><a style="color:white;" href="' . asset('uploads/receipt_company/' . $rec->file) . '" download="">ดาวห์โหลด</a></button>   
                            ';
                            } else {
                                $str = '';
                            }
                            return $str;
                        })
                        ->editColumn('receipt_date', function($rec) {
                            return date('d-m-Y', strtotime($rec->receipt_date));
                        })
                        ->addColumn('action', function($rec) {
                            $str = '
                          <button type="button" class="btn btn-edit btn-warning" data-id="' . $rec->id . '">แก้ไข</button>
                          <button type="button" class="btn btn-delete btn-danger" data-id="' . $rec->id . '" data-name="' . $rec->name . '">ลบ</button>   
                            ';
                            return $str;
                        })->rawColumns(['file', 'status', 'action'])->make(true);
    }

}
