<?php

namespace App\Http\Controllers;

use App\Models\Diagnostic;
use App\Models\DiagnosticRequest;
use App\Models\ServicesView;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

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
    public function postDiagnostic(Request $request)
    {
        $action = $request->action;
        $result = null;

        // выбран девай, показываем уникальные наблюдаю и знаю точно
        if($action == 'type_device'){
            $type_device = $request->type_device;
            $problem_know = Diagnostic::select(['problem_know'])
                ->distinct()
                ->where('type_device', $type_device)
                ->orderBy('problem_know')
                ->get()
                ->toArray();
            $result['problem_know'] = array_column($problem_know, 'problem_know');

            $problem_watching = Diagnostic::select(['problem_watching'])
                ->distinct()
                ->where('type_device', $type_device)
                ->orderBy('problem_watching')
                ->get()
                ->toArray();
            $result['problem_watching'] = array_column($problem_watching, 'problem_watching');

            $problem_description = Diagnostic::select(['problem_description'])
                ->distinct()
                ->where('type_device', $type_device)
                ->orderBy('problem_description')
                ->get()
                ->toArray();
            $result['problem_description'] = array_column($problem_description, 'problem_description');
            return $result;
        }

        /**********************************************/

        if($action == 'problem_know' || $action == 'problem_watching' || $action == 'problem_description'){
            $type_device = $request->type_device;
            $problem_know = $request->problem_know;
            $problem_watching = $request->problem_watching;
            $problem_description = $request->problem_description;

            if($problem_know !== false){
                $result_know = Diagnostic::select(['problem_know', 'problem_watching', 'problem_description'])
                    ->distinct()
                    ->where('type_device', $type_device)
                    ->where('problem_know', $problem_know)
                    ->get()
                    ->toArray();
                $result['problem_watching'] = array_unique(array_column($result_know, 'problem_watching'));
                $result['problem_description'] = array_unique(array_column($result_know, 'problem_description'));

                if($request->has('problem_watching')) {
                    $result_know = $result_know->where('problem_watching',$problem_watching);
                }
            }

            if($problem_watching !== false){
                $result_watching = Diagnostic::select(['problem_know', 'problem_watching', 'problem_description'])
                    ->distinct()
                    ->where('type_device', $type_device)
                    ->where('problem_watching',  $problem_watching)
                    ->get()
                    ->toArray();
                $result['problem_know'] = array_unique(array_column($result_watching, 'problem_know'));
                $result['problem_description'] = array_unique(array_column($result_watching, 'problem_description'));
            }

            if($problem_description !== false){
                $result_description = Diagnostic::select(['problem_know', 'problem_watching', 'problem_description'])
                    ->distinct()
                    ->where('type_device', $type_device)
                    ->where('problem_description', $problem_description)
                    ->get()
                    ->toArray();
                $result['problem_know'] = array_unique(array_column($result_description, 'problem_know'));
                $result['problem_watching'] = array_unique(array_column($result_description, 'problem_watching'));
            }
            return $result;
        }

        /**********************************************/

        // выбран "знаю точно", показываем "наблюдаю"
//        if($action == 'problem_know'){
//            $type_device = $request->type_device;
//            $problem_know = $request->problem_know;
//            $result = Diagnostic::select(['problem_watching'])
//                ->distinct()
//                ->where('type_device', $type_device)
//                ->where('problem_know',  $problem_know)
//                ->orderBy('problem_watching')
//                ->get()
//                ->toArray();
//            $result = array_column($result, 'problem_watching');
//            return $result;
//        }
//
//        //выбран "наблюдаю", показываем "знаю точно"
//        if($action == 'problem_watching'){
//            $type_device = $request->type_device;
//            $problem_watching = $request->problem_watching;
//            $result = Diagnostic::select(['problem_know'])
//                ->distinct()
//                ->where('type_device', $type_device)
//                ->where('problem_watching', $problem_watching)
//                ->orderBy('problem_know')
//                ->get()
//                ->toArray();
//            $result = array_column($result, 'problem_know');
//            return $result;
//        }
//
//        // выбран и "знаю точно" и "наблюдаю", показываем "описание дефекта"
//        if($action == 'problem_know_watching'){
//            $type_device = $request->type_device;
//            $problem_know = $request->problem_know;
//            $problem_watching = $request->problem_watching;
//            $result = Diagnostic::select(['problem_description'])
//                ->distinct()
//                ->where('type_device', $type_device)
//                ->where('problem_know', $problem_know)
//                ->where('problem_watching', $problem_watching)
//                ->orderBy('problem_description')
//                ->get()
//                ->toArray();
//            $result = array_column($result, 'problem_description');
//            return $result;
//        }
//
//        // показываем результатирущую таблицу диагностики
//        if($action == 'problem_description'){
//            $type_device = $request->type_device;
//            $problem_know = $request->problem_know;
//            $problem_watching = $request->problem_watching;
//            $problem_description = $request->problem_description;
//            $result = Diagnostic::select(['spare_part', 'percentage', 'services'])
//                ->where('type_device', $type_device)
//                ->where('problem_know', $problem_know)
//                ->where('problem_watching', $problem_watching)
//                ->where('problem_description', $problem_description)
//                ->orderBy('spare_part')
//                ->get()
//                ->toArray();
//
//            $list_result = [];
//            $i = 0;
//            foreach ($result as $value){
//                $list_result[$i]['percentage'] = $value['percentage'];
//                $list_result[$i]['services'] = $value['services'];
//                $list_result[$i]['spare_part'] = $value['spare_part'];
//                $list_result[$i]['min_price'] = DB::table('service_center_price')->where('title', $value['services'])->min('price_min');
//                $list_result[$i]['max_price'] = DB::table('service_center_price')->where('title', $value['services'])->max('price_max');
//                $i++;
//            }
//
//            // Пишем статистику просмотров диагностики
//            DiagnosticRequest::create([
//                'type_device' => $request->type_device,
//                'problem_know' => $request->problem_know,
//                'problem_watching' => $request->problem_watching,
//                'problem_description' => $request->problem_description,
//                'ip_address' => \Request::ip(),
//                'created_at' => Carbon::now()
//            ]);
//
//            return $list_result;
//        }

        //Перенаправляем на страницу каталога с фильтрацией по данным услугам
        if($action == 'pick_up_service'){
            //Пишем в статистику, что по таким услугам был запрос на подбор сервисного центр
            ServicesView::create([
                'user_id' => (Auth::user() && Auth::user()->roleUser()) ? Auth::user()->id : null,
                'type_device' => $request->type_device,
                'services' => $request->services,
                'date_view' => Carbon::now()->format('Y-m-d')
            ]);
            Session::put('pick_up_service', $request->service);
            return route('catalog');
        }
        return true;
    }
}
