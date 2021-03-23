<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CustomerGoogleAds;

class CustomerGoogleAdsController extends Controller {

    public function index() {
        return view('customer_google_ads');
    }

    public function create() {
        // ฟังก์ชั่นนี้เอาไว้เรียก view หน้า add
    }

    public function store(Request $request) {

        $input_all = $request->all();

        if (isset($input_all['service_end_date'])) {
            $input_all['service_end_date'] = date('Y-m-d', strtotime($input_all['service_end_date']));
        }

        if (isset($input_all['expired_web_date'])) {
            $input_all['expired_web_date'] = date('Y-m-d', strtotime($input_all['expired_web_date']));
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
            CustomerGoogleAds::insert($input_all);
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
        $result['customer_google_ads'] = CustomerGoogleAds::find($id);
        $result['service_end_date'] = date('d-m-Y', strtotime($result['customer_google_ads']->service_end_date));
        $result['expired_web_date'] = date('d-m-Y', strtotime($result['customer_google_ads']->expired_web_date));
        return json_encode($result);
    }

    public function update(Request $request, $id) {

        $input_all = $request->all();

        if (isset($input_all['service_end_date'])) {
            $input_all['service_end_date'] = date('Y-m-d', strtotime($input_all['service_end_date']));
        }

        if (isset($input_all['expired_web_date'])) {
            $input_all['expired_web_date'] = date('Y-m-d', strtotime($input_all['expired_web_date']));
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

            CustomerGoogleAds::where('id', $id)->update($input_all);

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
            CustomerGoogleAds::where('id', $id)->delete();
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
        $result = CustomerGoogleAds::select();
        return \DataTables::of($result)
                        ->addIndexColumn()
                        ->editColumn('service_end_date', function($rec) {
                            return date('d-m-Y', strtotime($rec->service_end_date));
                        })
                        ->editColumn('expired_web_date', function($rec) {
                            return date('d-m-Y', strtotime($rec->expired_web_date));
                        })
                        ->editColumn('price', function($rec) {
                            return number_format($rec->price, 2);
                        })
                        ->editColumn('manage_ads', function($rec) {
                            return '<button type="button" class="btn btn-inverse"><a style="color:white;" href="' . $rec->manage_ads . '" target="_blank">จัดการ</a></button>';
                        })
                        ->editColumn('link_web', function($rec) {
                            return '<a href="' . $rec->link_web . '" target="_blank">' . $rec->link_web . '</a>';
                        })
                        ->addColumn('action', function($rec) {
                            $str = '
                          <button type="button" class="btn btn-edit btn-warning" data-id="' . $rec->id . '">แก้ไข</button>
                          <button type="button" class="btn btn-delete btn-danger" data-id="' . $rec->id . '" data-name="' . $rec->name . '">ลบ</button>   
                            ';
                            return $str;
                        })->rawColumns(['action', 'manage_ads','link_web'])->make(true);
    }

}
