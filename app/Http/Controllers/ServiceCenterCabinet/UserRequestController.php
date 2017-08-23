<?php

namespace App\Http\Controllers\ServiceCenterCabinet;

use App\Models\FormRequest;
use App\Models\FormRequestMessage;
use App\Models\RequestStatus;
use App\Models\ServiceCenter;
use Auth;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mail;

class UserRequestController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getRequests()
    {
        $serviceCenters = Auth::user()->service_centers->toArray();
        $array_id = array_column($serviceCenters, 'id');
        $allRequests = FormRequest::select('id', 'r_id', 'service_center_id', 'email', 'name', 'created_at', 'phone', 'services', 'status_id', 'manufacturer', 'favorite')
            ->whereIn('service_center_id', $array_id)->orderBy('id', 'desc')->get();
        $allRequests->load('status', 'service_center');
        return view('service_center_cabinet.requests', compact('allRequests'));
    }


    /**
     * Информация о заявке
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getRequest($id)
    {
        $requestInfo = FormRequest::find($id);
        $requestInfo['messages'] = DB::table('form_request_message')
            ->leftJoin('users', function ($join) {
                $join->on('users.id', '=', 'form_request_message.user_id')
                    ->whereNotNull('form_request_message.user_id');
            })

            ->leftJoin('service_centers', function ($join) {
                $join->on('service_centers.id', '=', 'form_request_message.service_center_id')
                    ->whereNotNull('form_request_message.service_center_id');
            })
            ->select('form_request_message.id',
                'users.name as user_name',
                'service_centers.service_name',
                'form_request_message.message',
                'form_request_message.sys_info',
                'form_request_message.created_at')
            ->where('form_request_message.request_id', $requestInfo->id)
            ->get();
        return view('service_center_cabinet.view_request', compact('requestInfo'));
    }


    /**
     * Update messages
     * @param Request $request
     * @return string
     */
    public function putRequests(Request $request)
    {
        if($request->has('favorite')){
            $message = FormRequest::find($request->id);
            $message->favorite = $request->favorite;
            $message->update();
            return json_encode(["status" => 200]);
        }

    }


    /**
     * Отправка сообщение в переписке внутри заявки
     * @param Request $request
     * @param $r_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendMessageByRequest(Request $request, $r_id)
    {
        $user_request = FormRequest::where('r_id', $r_id)->with('service_center')->first();

        $data = [
            'request_id' => $user_request->id,
            'service_center_id' => $user_request->service_center_id,
            'message' => $request->message,
            'created_at' => Carbon::now(),
        ];

        $send_ok = FormRequestMessage::create($data);

        if($send_ok){
            Mail::send('site.emails.sc_message_from_request', compact('data', 'r_id'), function ($message) use ($r_id, $user_request) {
                $message->from('info@boot.com.ua', 'BOOT');
                $message->to($user_request->email)->subject('Новое сообщение от сервисного центра по заявке #' . $r_id);
            });
        }
        return redirect()->back();
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changeStatus(Request $request)
    {
        $user_request = FormRequest::find($request->id);

        $message = null;

        // аявка Принята или отклонена
        if($request->status_id == 2 || $request->status_id == 3){
            $user_request->status_id = $request->status_id;
            $user_request->cancel_comment = isset($request->cancel_comment) ? $request->cancel_comment : null;

            if($user_request->update()){

                $status = RequestStatus::find($user_request->status_id);

                $data = [
                    'request_id' => $user_request->id,
                    'service_center_id' => $user_request->service_center_id,
                    'sys_info' => 1,
                    'message' => 'Изменил статус заявки на (' . $status->status . ')',
                    'created_at' => Carbon::now(),
                ];

                FormRequestMessage::create($data);

                $service_center = ServiceCenter::find($user_request->service_center_id);
                $service_center->load('service_phones', 'service_emails');
                $user = $service_center->user;
                // Уведомляем пользователя о том, что в заявке изменился статус
                Mail::send('site.emails.user_request_sc', compact('user_request', 'service_center', 'user', 'status'), function ($message) use ($user_request, $status) {
                    $message->from('info@boot.com.ua', 'BOOT');
                    $message->to($user_request->email)->subject('Ваша заявка перешла в статус ' . $status->status);
                });
                $message = "Заявка перешла в статус (" . $status->status . "). Клиент проинформирован о смене статуса в заявке.";
            }
        }

        // Выполнена заявка
        if($request->status_id == 4){
            $user_request->status_id = $request->status_id;
            $user_request->cost_of_work_end = $request->cost_of_work_end;

            if($user_request->update()){

                $status = RequestStatus::find($user_request->status_id);

                $data = [
                    'request_id' => $user_request->id,
                    'service_center_id' => $user_request->service_center_id,
                    'sys_info' => 1,
                    'message' => 'Изменил статус заявки на (' . $status->status . ') и установил окончательную стоимость работы ' . $user_request->cost_of_work_end . 'ГРН',
                    'created_at' => Carbon::now(),
                ];

                FormRequestMessage::create($data);

                $service_center = ServiceCenter::find($user_request->service_center_id);
                $service_center->load('service_phones', 'service_emails');
                $user = $service_center->user;
                // Уведомляем пользователя о том, что в заявке изменился статус
                Mail::send('site.emails.user_request_sc', compact('user_request', 'service_center', 'user', 'status'), function ($message) use ($user_request, $status) {
                    $message->from('info@boot.com.ua', 'BOOT');
                    $message->to($user_request->email)->subject('Ваша заявка перешла в статус ' . $status->status);
                });
                $message = "Заявка перешла в статус (" . $status->status . "). Клиент проинформирован о смене статуса в заявке.";
            }
        }


        // Задаем дедлайн
        if($request->add_deadline == true){
            $user_request->deadline = isset($request->deadline) ? Carbon::parse($request->deadline)->format('Y-m-d') : null;

            $user_request->update();

            $data = [
                'request_id' => $user_request->id,
                'service_center_id' => $user_request->service_center_id,
                'sys_info' => 1,
                'message' => 'Выставил  ориентировочное время выполнения работы (' . $user_request->deadline . ')',
                'created_at' => Carbon::now(),
            ];

            FormRequestMessage::create($data);

            if(isset($request->client_notification)){

                // Уведомляем пользователя о том, что в заявке изменился статус
                Mail::send('site.emails.request_add_deadline', compact('user_request'), function ($message) use ($user_request) {
                    $message->from('info@boot.com.ua', 'BOOT');
                    $message->to($user_request->email)->subject('Исполнитель выставил ориентировочное время выполнения работы');
                });
            }
            $message = "Вы выставили оринтировочное время на выполнение работы.";
        }
        return redirect()->back()->with(['message' => $message]);
    }
}
