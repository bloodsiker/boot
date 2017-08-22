<?php

namespace App\Http\Controllers\ServiceCenterCabinet;

use App\Models\FormRequest;
use App\Models\RequestStatus;
use App\Models\ServiceCenter;
use Auth;
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
        $allRequests = FormRequest::select('id',  'service_center_id', 'email', 'name', 'created_at', 'phone', 'services', 'status_id', 'manufacturer', 'favorite')
            ->whereIn('service_center_id', $array_id)->orderBy('id', 'desc')->get();
        $allRequests->load('status', 'service_center');
        return view('service_center_cabinet.messages', compact('allRequests'));
    }


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
                'form_request_message.created_at')
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
     * @param Request $request
     */
    public function changeStatus(Request $request)
    {
        $user_request = FormRequest::find(107);
        $user_request->status_id = $request->status_id = 3; //Отклонена, В работе
        $user_request->cancel_comment = isset($request->cancel_comment) ? $request->cancel_comment : null;
        $user_request->deadline = isset($request->deadline) ? $request->deadline : null;
        if($user_request->update()){

            $service_center = ServiceCenter::find($user_request->service_center_id);
            $service_center->load('service_phones', 'service_emails');
            $user = $service_center->user;

            $status = RequestStatus::find($user_request->status_id);

            if($status->status == 'В работе' || $status->status == 'Отклонена'){
                // Уведомляем пользователя о том, что в заявке изменился статус
                Mail::send('site.emails.user_request_sc', compact('user_request', 'service_center', 'user', 'status'), function ($message) use ($user_request, $status) {
                    $message->from('info@boot.com.ua', 'BOOT');
                    $message->to($user_request->email)->subject('Ваша заявка перешла в статус ' . $status->status);
                });
            }
        }

    }
}
