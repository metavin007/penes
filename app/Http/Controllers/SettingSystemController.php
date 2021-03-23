<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SettingSystem;

class SettingSystemController extends Controller {

    public function pade_setting() {
        $data['setting_system'] = SettingSystem::find(1);
        return view('setting_system', $data);
    }

    public function update_setting(Request $request, $id) {

        $input_all = $request->all();
        $input_all['updated_at'] = date('Y-m-d H:i:s');
        $input_all['updated_by'] = \Auth::user()->id;

        $validator = Validator::make($request->all(), [
                    'name1' => 'required',
                    'name2' => 'required',
                    'name3' => 'required',
                    'name4' => 'required',
                    'name5' => 'required',
                    'name6' => 'required',
        ]);

        $return['title'] = 'แก้ไขข้อมูล';

        if ($validator->fails()) {
            $return['status'] = 0;
            $return['content'] = $validator->errors()->first();
            return $return;
        }

        \DB::beginTransaction();
        try {
            SettingSystem::where('id', $id)->update($input_all);
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

}
