<?php

namespace App\Services;

use App\Models\FormRequest;
use App\Models\ServiceCenter;
use Carbon\Carbon;
use DB;
use Mail;

class UserRequestService
{

    /**
     * Generate random r_id and check unique
     * @return mixed
     */
    public function generateRequestID()
    {
        $r_id = random_int(0, 999999999);

        $check_id = FormRequest::checkID($r_id)->first();

        if($check_id){
            self::generateRequestID();
        }
        return (int)$r_id;
    }


    /**
     * Если время на реагирования заявки (20 мин) истекло, уведомляем сервисный центер и оператора об этом.
     * Send email notification of overdue requests
     */
    public function notificationEmail()
    {
        $list = FormRequest::where('status_id', 1)->where('notif_email', 0)->get();
        $now_time = Carbon::now();
        $addTime = '20 мин';
        foreach ($list as $req){
            $request_time = Carbon::parse($req->created_at)->addSeconds(1200);
            if($request_time < $now_time){

                $service_center = ServiceCenter::find($req->service_center_id);
                $service_center->load('service_phones', 'service_emails');

                $user = $service_center->user;

                // Оператору
                Mail::send('site.emails.overdue_request_operator', compact('req', 'service_center', 'user'), function ($message) {
                    $message->from('info@boot.com.ua', 'BOOT');
                    // partners@boot.com.ua
                    $message->to(config('mail.support_email'))->subject('Просроченная заявка, примите меры!');
                });

                // Сервисному центру
                Mail::send('site.emails.overdue_request_sc', compact('req', 'service_center', 'user', 'addTime'), function ($message) use ($user, $req) {
                    $message->from('info@boot.com.ua', 'BOOT');
                    $message->to($user->email)->subject("У вас просроченная заявка #{$req->r_id}. Примите меры!");
                });

                DB::table('form_requests')
                    ->where('id', $req->id)
                    ->update(['notif_email' => 1]);
            }
        }
    }



    /**
     * Если время на реагирования (4 часа) заявки со статусом В обработке(5) - истекло, уведомляем сервисный центер об этом.
     */
    public function notificationEmailOverdueRequest()
    {
        $list = FormRequest::where('status_id', 5)->where('notif_email', '<>', 2)->get();
        $now_time = Carbon::now();
        $addTime = '4 часа';
        foreach ($list as $req){
            $request_time = Carbon::parse($req->created_at)->addSeconds(14400);
            if($request_time < $now_time){

                $service_center = ServiceCenter::find($req->service_center_id);
                $service_center->load('service_phones', 'service_emails');

                $user = $service_center->user;

                // Сервисному центру
                Mail::send('site.emails.overdue_request_sc', compact('req', 'service_center', 'user', 'addTime'), function ($message) use ($user, $req) {
                    $message->from('info@boot.com.ua', 'BOOT');
                    $message->to($user->email)->subject("У вас просроченная заявка #{$req->r_id}. Примите меры!");
                });

                DB::table('form_requests')
                    ->where('id', $req->id)
                    ->update(['notif_email' => 2]);
            }
        }
    }

}