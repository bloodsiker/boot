<?php

namespace App\Http\Controllers;

use App\Models\Diagnostic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DiagnosticsController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getIndex()
    {
        $data_seo = json_decode(DB::table('seo_meta')->where('title', 'diagnostics')->get());
        return view('site.diagnostics', compact('data_seo'));
    }


    /**
     * @param Request $request
     * @return array|bool|null
     */
    public function getDiagnostic(Request $request)
    {
        $action = 'problem_description';

        $result = null;

        if($action == 'type_device'){
            $type_device = 'phone';
            $result = Diagnostic::select(['problem_know'])
                ->distinct()
                ->where('type_device', $type_device)
                ->orderBy('problem_know')
                ->get()
                ->toArray();
            $result = array_column($result, 'problem_know');
            return $result;
        }

        if($action == 'problem_know'){
            $type_device = 'phone';
            $problem_know = 'Батарея';
            $result = Diagnostic::select(['problem_watching'])
                ->distinct()
                ->where('type_device', $type_device)
                ->where('problem_know', $problem_know)
                ->orderBy('problem_watching')
                ->get()
                ->toArray();
            $result = array_column($result, 'problem_watching');
            return $result;
        }

        if($action == 'problem_watching'){
            $type_device = 'phone';
            $problem_know = 'Батарея';
            $problem_watching = 'Проблемы с питанием';
            $result = Diagnostic::select(['problem_description'])
                ->distinct()
                ->where('type_device', $type_device)
                ->where('problem_know', $problem_know)
                ->where('problem_watching', $problem_watching)
                ->orderBy('problem_description')
                ->get()
                ->toArray();
            $result = array_column($result, 'problem_description');
            return $result;
        }

        if($action == 'problem_description'){
            $type_device = 'phone';
            $problem_know = 'Батарея';
            $problem_watching = 'Проблемы с питанием';
            $problem_description = 'Аккумулятор нагревается';
            $result = Diagnostic::select(['spare_part', 'percentage', 'services'])
                ->distinct()
                ->where('type_device', $type_device)
                ->where('problem_know', $problem_know)
                ->where('problem_watching', $problem_watching)
                ->where('problem_description', $problem_description)
                ->orderBy('spare_part')
                ->get()
                ->toArray();

            $service = array_column($result, 'services');

            $list = [];
            foreach ($service as $value){
                $sc = DB::table('service_center_price as sep')
                    ->join('service_centers as sc', 'sep.service_center_id', '=', 'sc.id')
                    ->where('sep.title', $value)
                    ->orderBy('sep.price', 'DESC')
                    ->get();
                array_push($list, $sc);
            }
            return $list;
        }
        return true;
    }
}
