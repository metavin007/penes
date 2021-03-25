<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Models\User;

class ProfileController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        return view('pro_file');
    }

    public function update_profile(Request $request) {

        $input_all = $request->all();

        $validator = Validator::make($request->all(), [
                    'first_name' => 'required',
                    'last_name' => 'required',
        ]);

        $return['title'] = 'แก้ไขข้อมูล';

        if ($validator->fails()) {
            $return['status'] = 0;
            $return['content'] = $validator->errors()->first();
            return $return;
        }

        \DB::beginTransaction();
        try {
            User::where('id', \Auth::user()->id)->update($input_all);
            \DB::commit();
            $return['status'] = 1;
            $return['content'] = 'สำเร็จ';
        } catch (Exception $e) {
            \DB::rollBack();
            $return['status'] = 0;
            $return['content'] = 'ไม่สำรเร็จ' . $e->getMessage();
        }

        return $return;
    }

    public function change_password_profile(Request $request) {

        $old_password = $request->input('old_password');
        $password = $request->input('password');

        $validator = Validator::make($request->all(), [
                    'old_password' => 'required',
                    'password' => 'required',
        ]);

        $return['title'] = 'เปลี่ยนรหัสผ่าน';

        if ($validator->fails()) {
            $return['status'] = 0;
            $return['content'] = $validator->errors()->first();
            return $return;
        }

        \DB::beginTransaction();
        try {

            $user = User::select('password')->where('id', \Auth::user()->id)->first();

            if (\Hash::check($old_password, $user->password)) {
                $new_password = \Hash::make($password);
                $data_update = [
                    'password' => $new_password,
                ];
                User::where('id', \Auth::user()->id)->update($data_update);
                \DB::commit();
                $return['status'] = 1;
                $return['content'] = 'สำเร็จ';
            } else {
                \DB::rollBack();
                $return['status'] = 0;
                $return['content'] = 'รหัสเก่าไม่ถูกต้อง';
            }
        } catch (Exception $e) {
            \DB::rollBack();
            $return['status'] = 0;
            $return['content'] = 'ไม่สำเร็จ' . $e->getMessage();
        }

        return $return;
    }

}
