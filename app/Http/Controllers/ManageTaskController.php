<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ManageTask;
use App\Models\Package;
use App\Models\Freelance;

class ManageTaskController extends Controller {

    public function index() {
        $data['packages'] = Package::get();
        $data['freelances'] = Freelance::get();
        return view('manage_task', $data);
    }

    public function create() {
        // ฟังก์ชั่นนี้เอาไว้เรียก view หน้า add
    }

    public function store(Request $request) {

        $input_all = $request->all();

        if (isset($input_all['pade_date'])) {
            $input_all['pade_date'] = date('Y-m-d', strtotime($input_all['pade_date']));
        }

        $input_all['created_at'] = date('Y-m-d H:i:s');
        $input_all['created_by'] = \Auth::user()->id;
        $input_all['updated_at'] = date('Y-m-d H:i:s');
        $input_all['updated_by'] = \Auth::user()->id;

        $validator = Validator::make($request->all(), [
                    'pade_name' => 'required',
        ]);

        $return['title'] = 'เพิ่มข้อมูล';

        if ($validator->fails()) {
            $return['status'] = 0;
            $return['content'] = $validator->errors()->first();
            return $return;
        }

        \DB::beginTransaction();
        try {
            ManageTask::insert($input_all);
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
        $result['manage_task'] = ManageTask::find($id);
        $result['pade_date'] = date('d-m-Y', strtotime($result['manage_task']->pade_date));
        return json_encode($result);
    }

    public function update(Request $request, $id) {

        $input_all = $request->all();

        if (isset($input_all['pade_date'])) {
            $input_all['pade_date'] = date('Y-m-d', strtotime($input_all['pade_date']));
        }

        $input_all['updated_at'] = date('Y-m-d H:i:s');
        $input_all['updated_by'] = \Auth::user()->id;

        $validator = Validator::make($request->all(), [
                    'pade_name' => 'required',
        ]);

        $return['title'] = 'แก้ไขข้อมูล';

        if ($validator->fails()) {
            $return['status'] = 0;
            $return['content'] = $validator->errors()->first();
            return $return;
        }

        \DB::beginTransaction();
        try {

            ManageTask::where('id', $id)->update($input_all);

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
            ManageTask::where('id', $id)->delete();
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
        $result = ManageTask::whereBetween('pade_date', [$date_search_start, $date_search_end])->select();
        return \DataTables::of($result)
                        ->addIndexColumn()
                        ->editColumn('pade_date', function($rec) {
                            return DateThai($rec->pade_date);
                        })
                        ->editColumn('price', function($rec) {
                            return number_format($rec->price, 2);
                        })
                        ->editColumn('link_page', function($rec) {
                            return '<a href="' . $rec->link_page . '" target="_blank">' . $rec->link_page . '</a>';
                        })
                        ->addColumn('action', function($rec) {
                            $str = '
                          <button type="button" class="btn btn-edit btn-warning" data-id="' . $rec->id . '">แก้ไข</button>
                          <button type="button" class="btn btn-delete btn-danger" data-id="' . $rec->id . '" data-name="' . $rec->pade_name . '">ลบ</button>   
                            ';
                            return $str;
                        })->rawColumns(['action', 'link_page'])->make(true);
    }

    public function get_datatable_freelance(Request $request) {
        $date_search_start = $request->input('date_search_start');
        $date_search_end = $request->input('date_search_end');
        if ($date_search_start && $date_search_end) {
            $date_search_start = date('Y-m-d', strtotime($date_search_start));
            $date_search_end = date('Y-m-d', strtotime($date_search_end));
        }
        $result = ManageTask::whereBetween('pade_date', [$date_search_start, $date_search_end])->groupBy('freelance')
                ->selectRaw('freelance, sum(amount_image) as sum_amount_image')
                ->get();
        return \DataTables::of($result)->make(true);
    }

    public function get_datatable_package(Request $request) {
        $date_search_start = $request->input('date_search_start');
        $date_search_end = $request->input('date_search_end');
        if ($date_search_start && $date_search_end) {
            $date_search_start = date('Y-m-d', strtotime($date_search_start));
            $date_search_end = date('Y-m-d', strtotime($date_search_end));
        }
        $result = ManageTask::whereBetween('pade_date', [$date_search_start, $date_search_end])->groupBy('package')
                ->selectRaw('package, COUNT(id) as sum_amount_package')
                ->get();
        return \DataTables::of($result)->make(true);
    }

}
