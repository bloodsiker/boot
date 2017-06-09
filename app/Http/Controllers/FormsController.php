<?php

namespace App\Http\Controllers;

use App\Models\FormRequest;
use Mail;
use Validator;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        FormRequest::insert(
            [
                'pagename' => 'Главная страница',
                'city' => 'Днепр',
                'name' => $request->name,
                'phone' => $request->phone,
                'status' => 'Новая',
                'created_at' => Carbon::now()
            ]
        );

        // send the email
//        Mail::send('site.emails.help', $input, function($message)
//        {
//            $message->from('us@example.com', 'Laravel');
//            $message->to('maldini2@ukr.net')->subject('Помощь в подборе сервисного центра');
//        });

        return json_encode(["status" => 200]);
    }
}
