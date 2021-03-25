<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller {

    public function index() {
        return view('user');
    }

    public function create() {
        // ฟังก์ชั่นนี้เอาไว้เรียก view หน้า add
    }

    public function store(Request $request) {

        $input_all = $request->all();

        $input_all['created_at'] = date('Y-m-d H:i:s');
        $input_all['created_by'] = \Auth::user()->id;
        $input_all['updated_at'] = date('Y-m-d H:i:s');
        $input_all['updated_by'] = \Auth::user()->id;
        $input_all['password'] = Hash::make($input_all['password']);

        unset($input_all['password_confirm']);

        $validator = Validator::make($request->all(), [
                    'email' => 'required|email|unique:users',
                    'password' => 'required|min:6',
                        ], [
                    'email.unique' => 'อีเมลนี้มีอยู่ในระบบแล้ว',
        ]);

        $return['title'] = 'เพิ่มข้อมูล';

        if ($validator->fails()) {
            $return['status'] = 0;
            $return['content'] = $validator->errors()->first();
            return $return;
        }

        \DB::beginTransaction();
        try {
            User::insert($input_all);
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
        $result = User::where('id', $id)->first();
        return json_encode($result);
    }

    public function update(Request $request, $id) {

        $input_all = $request->all();
        $input_all['updated_at'] = date('Y-m-d H:i:s');
        $input_all['updated_by'] = \Auth::user()->id;

        $validator = Validator::make($request->all(), [
                    'email' => 'required|unique:users,email,' . $id,
                        ], [
                    'email.unique' => 'อีเมลนี้มีอยู่ในระบบแล้ว',
        ]);

        $return['title'] = 'แก้ไขข้อมูล';

        if ($validator->fails()) {
            $return['status'] = 0;
            $return['content'] = $validator->errors()->first();
            return $return;
        }

        \DB::beginTransaction();
        try {
            User::where('id', $id)->update($input_all);
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

    public function change_password(Request $request, $id) {

        $input_all = $request->all();
        $input_all['updated_at'] = date('Y-m-d H:i:s');
        $input_all['updated_by'] = \Auth::user()->id;
        $user_id = $input_all['update_id'];
        unset($input_all['update_id']);

        $validator = Validator::make($request->all(), [
                    'password' => 'required|string|min:6',
        ]);

        $return['title'] = 'เปลี่ยนรหัสผ่าน';
        if ($validator->fails()) {
            $return['status'] = 0;
            $return['content'] = $validator->errors()->first();
            return $return;
        }

        \DB::beginTransaction();
        try {
            $input_all['password'] = Hash::make($input_all['password']);
            User::where('id', $user_id)->update($input_all);
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
            User::where('id', $id)->delete();
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
        $result = User::where('id', '!=', 1)->select();
        return \DataTables::of($result)
                        ->addIndexColumn()
                        ->editColumn('first_name', function ($rec) {
                            $str = $rec->first_name . ' ' . $rec->last_name;
                            return $str;
                        })
                        ->editColumn('created_at', function($rec) {
                            return DateThai($rec->created_at);
                        })->addColumn('action', function ($rec) {
                            if ($rec->id != 1) {
                                $str = ' 
                                    <button class="btn btn-edit btn-warning" data-id="' . $rec->id . '">แก้ไข</button>    
                                    <button class="btn btn-change_password btn-warning" data-id="' . $rec->id . '">เปลี่ยนรหัสผ่าน</button>
                                    <button class="btn btn-delete btn-danger" data-id="' . $rec->id . '" data-name="' . $rec->first_name . ' ' . $rec->last_name . '">ลบ</button>    
                                    ';
                                return $str;
                            }
                        })
                        ->rawColumns(['action'])->make(true);
    }

}
