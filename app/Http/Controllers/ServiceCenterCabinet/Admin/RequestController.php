<?php

namespace App\Http\Controllers\ServiceCenterCabinet\Admin;

use App\Models\FormRequest;
use App\Models\ServiceCenter;
use App\Models\UserRequest;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Заявки от клиентов
 * Class RequestController
 * @package App\Http\Controllers\ServiceCenterCabinet\Admin
 */
class RequestController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getMessages()
    {
        return view('service_center_cabinet.admin.messages');
    }


    /**
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function allRequest()
    {
        $all = FormRequest::select('id', 'email', 'name', 'created_at', 'phone', 'services', 'status_id', 'manufacturer', 'favorite', 'service_center_id')
            ->orderBy('id', 'desc')->get();
        $all->load('status', 'service_center');

        return response($all);
    }


    /**
     * Заявки на помощь в подборе
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getHelpRequests()
    {
        $allRequests = UserRequest::select('*')->orderBy('id', 'desc')->get();
        return view('service_center_cabinet.admin.help-request.list_requests', compact('allRequests'));
    }



    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getHelpRequest($id)
    {
        $requestInfo = UserRequest::find($id);
        return view('service_center_cabinet.admin.help-request.view_request', compact('requestInfo'));
    }


    /**
     * Изменяем статус заявки в помощь на подборе
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changeStatusByHelpRequest(Request $request)
    {
        $help_request = UserRequest::find($request->id);

        $message = '';

        if($request->status == 'Не отвечает'){
            $help_request->status = $request->status;
            $help_request->update();
            $message = 'Вы перевели заявку в статус (Не отвечает)';
        }


        if($request->status == 'Закрыта'){
            $help_request->status = $request->status;
            $help_request->operator_comment = $request->operator_comment;
            $help_request->update();
            $message = 'Вы закрыли заявку!';
        }

        return redirect()->back()->with(['message' => $message]);
    }






    /**
     * Заявки для сервисных центров
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getRequestsBySc()
    {
        $allRequests = FormRequest::select('id', 'email', 'name', 'created_at', 'phone', 'services', 'status_id', 'manufacturer', 'favorite', 'service_center_id')
            ->orderBy('id', 'desc')->get();
        $allRequests->load('status', 'service_center');
        //dd($allRequests);
        return view('service_center_cabinet.admin.sc-request.list_requests', compact('allRequests'));
    }

    /**
     * Просмотр заявки
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getRequestBySc($id)
    {
        $requestInfo = FormRequest::find($id);
        $requestInfo->load('status', 'service_center');
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
        $sc = ServiceCenter::find($requestInfo->service_center->id);
        $sc->load('service_phones', 'service_emails', 'city', 'metro', 'district');
        return view('service_center_cabinet.admin.sc-request.view_request', compact('requestInfo', 'sc'));
    }


    /**
     * Изменение статуса заявок
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changeStatusByRequest(Request $request)
    {
        $sc_request = FormRequest::find($request->id);

        if($request->status_id == 5){
            $sc_request->status_id = $request->status_id;
            $sc_request->update();
            $message = 'Вы перевели заявку в статус (В обработке)';
        }


        if($request->status_id == 3){
            $sc_request->status_id = $request->status_id;
            $sc_request->cancel_comment = $request->cancel_comment;
            $sc_request->update();
            $message = 'Вы отклонили заявку!';
        }

        return redirect()->back()->with(['message' => $message]);
    }
}
