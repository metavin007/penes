<?php

namespace App\Exports;

use App\Models\SparePart;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Collection;

class DashboardExport implements FromCollection {

    /**
     * @return \Illuminate\Support\Collection
     */
    protected $dash_board;

    public function __construct(array $dash_board) {
        $this->dash_board = $dash_board;
    }

    public function collection() {
        if ($this->dash_board['form_question_id']) {

            $form_question = \App\Models\FormQuestion::with('format_top')->where('id', $this->dash_board['form_question_id'])->first();

            $result_questions = \App\Models\ResultQuestion::where('form_question_id', $this->dash_board['form_question_id'])->get();

            $ar[0] = ['เลขที่', 'หัวข้อ'];

            $ar[1] = [$form_question->code, $form_question->format_top->name];

            $ar[2] = [''];

            $ar[3] = ['ตารางบันทึกผลการสอบถาม'];
            
            $ar[4] = ['ลำดับ', 'แบบสอบถามเลขที่', 'เลขที่', 'เพศ', 'อายุ', 'มากที่สุด', 'มาก', 'ปานกลาง', 'น้อย', 'น้อยที่สุด'];

            if (count($result_questions) > 0) {
                foreach ($result_questions as $key => $result_question) {
                    $ar[] = [
                        $key + 1,
                        $form_question->code,
                        $result_question->code,
                        $result_question->sex,
                        $result_question->age,
                        $result_question->degree_5,
                        $result_question->degree_4,
                        $result_question->degree_3,
                        $result_question->degree_2,
                        $result_question->degree_1
                    ];
                }
            }

            $all_sum_degree_5 = 0;
            $all_sum_degree_4 = 0;
            $all_sum_degree_3 = 0;
            $all_sum_degree_2 = 0;
            $all_sum_degree_1 = 0;
            if (count($result_questions) > 0) {
                foreach ($result_questions as $key => $value) {
                    $all_sum_degree_5 = $all_sum_degree_5 + $value->degree_5;
                    $all_sum_degree_4 = $all_sum_degree_4 + $value->degree_4;
                    $all_sum_degree_3 = $all_sum_degree_3 + $value->degree_3;
                    $all_sum_degree_2 = $all_sum_degree_2 + $value->degree_2;
                    $all_sum_degree_1 = $all_sum_degree_1 + $value->degree_1;
                }
            }
            
            $ar[] = ['', '', '', '', 'รวม', $all_sum_degree_5, $all_sum_degree_4, $all_sum_degree_3, $all_sum_degree_2, $all_sum_degree_1];
            
            return new Collection($ar);
        }
    }

}
