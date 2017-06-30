<?php

namespace App\Http\Controllers;

use App\Models\FormRequest;
use App\Models\ServiceCenter;
use App\Models\UserRequest;
use App\Services\UserRequestService;
use Auth;
use Mail;
use Validator;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Mail\HelpPickUpServiceCenter;

class FormsController extends Controller
{
    /**
     * @var UserRequestService
     */
    private $requestService;

    /**
     * FormsController constructor.
     * @param UserRequestService $requestService
     */
    public function __construct(UserRequestService $requestService)
    {

        $this->requestService = $requestService;
    }


    /**
     * Обработака формы "Помощь в подборе сервисного центра"
     * @param Request $request
     * @return string
     */
    public function mainHelpRequest(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required|min:2',
            'phone' => 'required'
        ]);

        if($validator->fails()) {
            return json_encode(['status' => 400, $validator->failed()]);
        }

        $data = [
            'user_name' => $request->name,
            'phone' => $request->phone,
            'status' => 'Новая',
            'created_at' => Carbon::now()
        ];

        //DB::table('form_requests')->insert($data);
        UserRequest::create($data);

        // send the email
        Mail::send('site.emails.help', ['data' => $data], function ($message) {
            $message->from('info@boot.com.ua', 'BOOT');
            $message->to('maldini2@ukr.net')->cc('info@boot.com.ua')->subject('Помощь в подборе сервисного центра');
        });

//        $content = [
//            'title'=> 'Itsolutionstuff.com mail',
//            'body'=> 'The body of your message.',
//            'button' => 'Click Here'
//        ];
//
//        Mail::to('maldini2@ukr.net')->send(new HelpPickUpServiceCenter($content));

        return json_encode(["status" => 200]);
    }


    /**
     * Форма связи со страници сервисного центра
     * @param Request $request
     * @return string
     */
    public function ScRequest(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required|min:2',
            'phone' => 'required'
        ]);

        if ($validator->fails()) {
            return json_encode(['status' => 400, $validator->failed()]);
        }

        $data = [
            'r_id' => $this->requestService->generateRequestID(),
            'service_center_id' => $request->service_center,
            'user_id' => (Auth::user() && Auth::user()->roleUser()) ? Auth::user()->id : null,
            'city' => $request->city,
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'manufacturer' => $request->manufacturer,
            'services' => $request->service,
            'cost_of_work_min' => $request->cost_of_work_min,
            'cost_of_work_max' => $request->cost_of_work_max,
            'task_description' => isset($request->task_description) ? $request->task_description : null,
            'payment_method' => $request->payment_type,
            'exit_master' => $request->exit_master,
            'status' => 'Ожидает подтверждения',
            'created_at' => Carbon::now()
        ];

        FormRequest::create($data);

        $service_center = ServiceCenter::find($request->service_center);
        $service_center->load('service_phones', 'service_emails');

        $user = $service_center->user;

        // Отправляем письмо сервисному центру
        Mail::send('site.emails.request_sc', compact('data', 'service_center', 'user'), function ($message) use ($service_center) {
            $message->from('info@boot.com.ua', 'BOOT');
            $message->to('maldini2@ukr.net')->to('do@generalse.com')->subject('Новая заявка для сервисного центра ' . $service_center->service_name);
        });

        // Отправляем письмо оператору
        Mail::send('site.emails.request_sc', compact('data', 'service_center', 'user'), function ($message) use ($service_center) {
            $message->from('info@boot.com.ua', 'BOOT');
            $message->to(config('mail.support_email'))->subject('Новая заявка для сервисного центра ' . $service_center->service_name);
        });

        return json_encode(["status" => 200]);
    }

    public function html()
    {
//        $user = 'Dfcz';
//        Mail::send('site.emails.index', compact('user'), function ($message) {
//            $message->from('info@boot.com.ua', 'BOOT');
//            $message->to(config('mail.support_email'))->to('do@generalse.com')->subject('Новая заявка для сервисного центра ');
//        });
        return view('site.emails.thanks_sc_register');
    }
}
