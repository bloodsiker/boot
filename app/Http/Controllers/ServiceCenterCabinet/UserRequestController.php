<?php

namespace App\Http\Controllers\ServiceCenterCabinet;

use App\Models\FormRequest;
use App\Models\ServiceCenter;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mail;

class UserRequestController extends Controller
{

    /**
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function allRequest()
    {
        $service_centers = Auth::user()->service_centers->toArray();
        $array_id = array_column($service_centers, 'id');
        $all = FormRequest::whereIn('service_center_id', $array_id)->orderBy('id', 'desc')->get();
        $all->load('service_center');

        return response($all);
    }


    /**
     * @param Request $request
     */
    public function changeStatus(Request $request)
    {
        $user_request = FormRequest::find(59);
        $user_request->status = $request->status = 'В работе'; //Отклонена, В работе
        $user_request->cancel_comment = isset($request->cancel_comment) ? $request->cancel_comment : null;
        $user_request->deadline = isset($request->deadline) ? $request->deadline : null;
        if($user_request->update()){

            $service_center = ServiceCenter::find($user_request->service_center_id);
            $service_center->load('service_phones', 'service_emails');
            $user = $service_center->user;

            if($user_request->status == 'В работе' || $user_request->status == 'Отклонена'){
                // Уведомляем пользователя о том, что в заявке изменился статус
                Mail::send('site.emails.user_request_sc', compact('user_request', 'service_center', 'user'), function ($message) use ($user_request) {
                    $message->from('info@boot.com.ua', 'BOOT');
                    $message->to($user_request->email)->subject('Ваша заявка перешла в статус ' . $user_request->status);
                });
            }
        }

    }
}
