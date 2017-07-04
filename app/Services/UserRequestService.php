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
     * Send email notification of overdue requests
     */
    public function notificationEmail()
    {
        $list = FormRequest::where('status_id', 1)->where('notif_email', 0)->get();
        $now_time = Carbon::now();
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
                Mail::send('site.emails.overdue_request_sc', compact('req', 'service_center', 'user'), function ($message) use ($user, $req) {
                    $message->from('info@boot.com.ua', 'BOOT');
                    $message->to($user->email)->subject("У вас просроченная заявка #{$req->r_id}. Примите меры!");
                });

                DB::table('form_requests')
                    ->where('id', $req->id)
                    ->update(['notif_email' => 1]);
            }
        }
    }

}