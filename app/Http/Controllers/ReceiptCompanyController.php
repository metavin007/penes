<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ReceiptCompany;

class ReceiptCompanyController extends Controller {

    public function index() {
        if (\Gate::allows('isCEO')) {
            return view('receipt_company');
        } else {
            abort(503);
        }
    }

    public function create() {
        // ฟังก์ชั่นนี้เอาไว้เรียก view หน้า add
    }

    public function store(Request $request) {

        $input_all = $request->all();

        if (isset($input_all['receipt_date'])) {
            $input_all['receipt_date'] = date('Y-m-d', strtotime($input_all['receipt_date']));
        }

        $dir = 'uploads/file_doc_1/';
        if (isset($input_all['file_doc_1'])) {
            $extension_file = $request->file('file_doc_1')->getClientOriginalExtension();
            $input_all['file_doc_1'] = uniqid() . '_' . time() . '.' . $extension_file;
            $request->file('file_doc_1')->move($dir, $input_all['file_doc_1']);
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

        $dir = 'uploads/file_doc_1/';
        if (isset($input_all['file_doc_1'])) {
            $extension_file = $request->file('file_doc_1')->getClientOriginalExtension();
            $input_all['file_doc_1'] = uniqid() . '_' . time() . '.' . $extension_file;
            $request->file('file_doc_1')->move($dir, $input_all['file_doc_1']);

            $receipt = ReceiptCompany::find($id);
            if ($receipt) {
                \File::delete(public_path('uploads/file_doc_1/' . $receipt->file_doc_1));
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
                \File::delete(public_path('uploads/file_doc_1/' . $receipt->file_doc_1));
                \File::delete(public_path('uploads/file_doc_2/' . $receipt->file_doc_2));
                \File::delete(public_path('uploads/file_doc_3/' . $receipt->file_doc_3));
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

    public function get_datatable(Request $request) {
        $date_search_start = $request->input('date_search_start');
        $date_search_end = $request->input('date_search_end');
        if ($date_search_start && $date_search_end) {
            $date_search_start = date('Y-m-d', strtotime($date_search_start));
            $date_search_end = date('Y-m-d', strtotime($date_search_end));
        }
        $result = ReceiptCompany::whereBetween('receipt_date', [$date_search_start, $date_search_end])->select();
        return \DataTables::of($result)
                        ->addIndexColumn()
                        ->editColumn('file_doc_1', function($rec) {
                            if ($rec->file_doc_1) {
                                $str = '
                          <button type="button" class="btn btn-look_pic btn-info" data-id="' . $rec->id . '"><i class="me-2 mdi mdi-eye"></i> ดูภาพ</button>
                          <button type="button" class="btn btn-info"><a style="color:white;" href="' . asset('uploads/file_doc_1/' . $rec->file_doc_1) . '" download=""><i class="me-2 mdi mdi-download"></i>ดาวน์โหลดสลิป</a></button>   
                            ';
                            } else {
                                $str = '';
                            }
                            return $str;
                        })
                        ->editColumn('receipt_date', function($rec) {
                            return DateThai($rec->receipt_date);
                        })
                        ->editColumn('file_doc_2', function($rec) {
                            if ($rec->file_doc_2) {
                                if ($rec->status == 'บุคคคลทั่วไป') {
                                    $str = '
                                        <button type="button" class="btn btn-info" "><a style="color:white;" href="' . asset('uploads/file_doc_2/' . $rec->file_doc_2) . '" download=""><i class="me-2 mdi mdi-download"></i>ดาวน์โหลดเอกสาร </a></button>   
                                    ';
                                } else {
                                    $str = '
                                        <button type="button" class="btn btn-info" "><a style="color:white;" href="' . asset('uploads/file_doc_2/' . $rec->file_doc_2) . '" download=""><i class="me-2 mdi mdi-download"></i>ดาวน์โหลดเอกสาร </a></button>   
                                    ';
                                }
                            } else {
                                $str = '';
                            }
                            return $str;
                        })
                        ->editColumn('file_doc_3', function($rec) {
                            if ($rec->file_doc_3) {
                                $str = '
                                    <button type="button" class="btn btn-success" "><a style="color:white;" href="' . asset('uploads/file_doc_3/' . $rec->file_doc_3) . '" download=""><i class="me-2 mdi mdi-download"></i>ดาวน์โหลดใบหักณที่จ่าย </a></button>   
                                    ';
                            } else {
                                $str = '';
                            }
                            return $str;
                        })
                        ->editColumn('status', function($rec) {
                            if ($rec->status) {
                                return $rec->status;
                            } else {
                                return '';
                            }
                        })
                        ->addColumn('action', function($rec) {
                            $str = '
                          <button type="button" class="btn btn-upload_doc_2 btn-outline-success" data-id="' . $rec->id . '"><i class="me-2 mdi mdi-file-pdf"></i>อัพเอกสาร</button>      
                          <button type="button" class="btn btn-upload_doc_3 btn-outline-success" data-id="' . $rec->id . '"><i class="me-2 mdi mdi-file-pdf"></i>อัพใบหักณที่จ่าย</button>      
                          <button type="button" class="btn btn-edit btn-warning" data-id="' . $rec->id . '">แก้ไข</button>
                          <button type="button" class="btn btn-delete btn-danger" data-id="' . $rec->id . '" data-name="' . $rec->name . '">ลบ</button>   
                            ';

                            return $str;
                        })->rawColumns(['file_doc_1', 'file_doc_2', 'file_doc_3', 'status', 'action'])->make(true);
    }

    public function update_upload_file_doc_2(Request $request, $id) {

        $input_all = $request->all();

        $dir = 'uploads/file_doc_2/';
        if (isset($input_all['file_doc_2'])) {
            $extension_file = $request->file('file_doc_2')->getClientOriginalExtension();
            $input_all['file_doc_2'] = uniqid() . '_' . time() . '.' . $extension_file;
            $request->file('file_doc_2')->move($dir, $input_all['file_doc_2']);

            $receipt = ReceiptCompany::find($id);
            if ($receipt && $receipt->file_doc_2) {
                \File::delete(public_path('uploads/file_doc_2/' . $receipt->file_doc_2));
            }
        }

        $input_all['updated_at'] = date('Y-m-d H:i:s');
        $input_all['updated_by'] = \Auth::user()->id;

        $validator = Validator::make($request->all(), [
//                    'name' => 'required',
        ]);

        $return['title'] = 'อัพโหลดข้อมูล';

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

    public function update_upload_file_doc_3(Request $request, $id) {

        $input_all = $request->all();

        $dir = 'uploads/file_doc_3/';
        if (isset($input_all['file_doc_3'])) {
            $extension_file = $request->file('file_doc_3')->getClientOriginalExtension();
            $input_all['file_doc_3'] = uniqid() . '_' . time() . '.' . $extension_file;
            $request->file('file_doc_3')->move($dir, $input_all['file_doc_3']);

            $receipt = ReceiptCompany::find($id);
            if ($receipt && $receipt->file_doc_3) {
                \File::delete(public_path('uploads/file_doc_3/' . $receipt->file_doc_3));
            }
        }

        $input_all['updated_at'] = date('Y-m-d H:i:s');
        $input_all['updated_by'] = \Auth::user()->id;

        $validator = Validator::make($request->all(), [
//                    'name' => 'required',
        ]);

        $return['title'] = 'อัพโหลดข้อมูล';

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

}
