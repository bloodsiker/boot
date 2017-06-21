<?php

namespace App\Http\Controllers;

use App\Models\FormRequest;
use Mail;
use Validator;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Mail\HelpPickUpServiceCenter;

class FormsController extends Controller
{
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
            'pagename' => 'Главная страница',
            'city' => 'Днепр',
            'name' => $request->name,
            'phone' => $request->phone,
            'status' => 'Новая',
            'created_at' => Carbon::now()
        ];

        DB::table('form_requests')->insert($data);

        // send the email
        Mail::send('site.emails.help', ['data' => $data], function ($message) use ($data) {
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
    public function scRequest(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required|min:2',
            'phone' => 'required'
        ]);

        if ($validator->fails()) {
            return json_encode(['status' => 400, $validator->failed()]);
        }

        DB::table('form_requests')->insert([
            'pagename' => 'Главная страница',
            'city' => 'Днепр',
            'service_id' => $request->id,
            'name' => $request->name,
            'phone' => $request->phone,
            'status' => 'Новая',
            'created_at' => Carbon::now()
        ]);

        return json_encode(["status" => 200]);
    }
}
