<?php

namespace App\Http\Controllers;

use App\Models\FormRequest;
use App\Models\ServiceCenter;
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

    public function __construct(UserRequestService $requestService)
    {

        $this->requestService = $requestService;
    }

    public function mainHelpRequest1(Request $request)
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
            'pagename' => 'Главная страница',
            'user_id' => Auth::user()->roleUser() ? Auth::user()->id : null,
            'city' => 'Днепр',
            'name' => $request->name,
            'phone' => $request->phone,
            'status' => 'Новая',
            'created_at' => Carbon::now()
        ];

        //DB::table('form_requests')->insert($data);
        FormRequest::create($data);

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
     * @param UserRequestService $requestService
     * @return string
     */
    public function mainHelpRequest(Request $request)
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
            'pagename' => 'Страница сервисного центра',
            'service_center_id' => $request->service_center,
            'user_id' => Auth::user()->roleUser() ? Auth::user()->id : null,
            'city' => 'Днепр',
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => 'example@ua.ua',
            'manufacturer' => 'Lenovo',
            'services' => 'Замена батареи',
            'cost_of_work' => random_int(10, 2000) . ' грн',
            'task_description' => isset($request->task_description) ? $request->task_description : null,
            'payment_method' => 'Наличные',
            'exit_master' => 'Да',
            'status' => 'Ожидает подтверждения',
            'created_at' => Carbon::now()
        ];

        FormRequest::create($data);

        $service_center = ServiceCenter::find($request->service_center);
        $service_center->load('service_phones', 'service_emails');

        $user = $service_center->user;

        Mail::send('site.emails.request_sc', compact('data', 'service_center', 'user'), function ($message) use ($service_center) {
            $message->from('info@boot.com.ua', 'BOOT');
            $message->to('maldini2@ukr.net')->subject('Новая заявка для сервисного центра ' . $service_center->service_name);
        });

        return json_encode(["status" => $user]);
    }
}
