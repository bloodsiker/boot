<?php

namespace App\Http\Controllers\UserProfile;

use App\Models\FormRequest;
use App\Models\FormRequestMessage;
use App\Models\ServiceCenter;
use Auth;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserRequestController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getIndex()
    {
        $data_seo = json_decode(DB::table('seo_meta')->where('title', 'user_requests')->get());
        $list_request = FormRequest::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();
        $list_request->load('service_center');
        $list_request->load('status');

        return view('user_profile.requests.index', compact('data_seo', 'list_request', 'service_center'));
    }


    /**
     * @param $r_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getRequestByRid($r_id)
    {
        $data_seo = json_decode(DB::table('seo_meta')->where('title', 'user_requests')->get());
        $user_request = FormRequest::where('r_id', $r_id)->with('status')->first();

        $service_center = ServiceCenter::find($user_request->service_center_id);
        $service_center->load('service_phones', 'service_emails');
        //dd($service_center);

        $user_request['messages'] = DB::table('form_request_message')
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
                'users.avatar',
                'service_centers.service_name',
                'service_centers.logo',
                'form_request_message.message',
                'form_request_message.created_at')
            ->where('form_request_message.request_id', $user_request->id)
            ->get();

        return view('user_profile.requests.request', compact('data_seo','user_request', 'service_center'));
    }


    /**
     * @param Request $request
     * @param $r_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendMessageByRequest(Request $request, $r_id)
    {
        $user_request = FormRequest::where('r_id', $r_id)->with('service_center')->first();

        FormRequestMessage::create(
            [
                'request_id' => $user_request->id,
                'user_id' => Auth::user()->id,
                'message' => $request->message,
                'created_at' => Carbon::now(),
            ]
        );
        return redirect()->back();
    }


    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function findRequestByRid(Request $request)
    {
        $data_seo = json_decode(DB::table('seo_meta')->where('title', 'user_find_request')->get());

        $result = 0;
        if($request->has('r_id')){
            $user_request = FormRequest::where('r_id', $request->r_id)->first();
            if($user_request){
                $user_request->load('service_center');
                $user_request->load('status');
                $result = 1;
            } else {
                $result = 2;
            }
        }

        return view('user_profile.requests.find_request', compact('data_seo', 'user_request', 'result'));
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function bindRequestToUser(Request $request)
    {
        $user_request = FormRequest::find($request->request_id);
        $user_request->user_id = Auth::id();
        $user_request->update();

        return redirect()->route('user.requests')->with(['message' => 'Заявка привязана к вашему аккаунту']);
    }
}
