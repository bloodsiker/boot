<?php

namespace App\Http\Controllers\Crm;

use App\Models\User;
use App\Models\UserRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RequestController extends Controller
{
    public function getIndex()
    {
        $requests = UserRequest::all()->sortByDesc('id');
        $requests->load('service');

        return view('crm_cabinet.request.index', compact('requests'));
    }

    public function getRequestInfo(Request $request)
    {
        $requestInfo = UserRequest::find($request->id);
        $requestInfo->load('service');

        return response()->json(['request' => $requestInfo], 200);
    }

    public function postRequestEdit(Request $request)
    {
        $requestInfo = UserRequest::find($request->id);
        $requestInfo->comment = $request->comment;
        $requestInfo->status = $request->status;
        $requestInfo->update();

        return response()->json(['comment' => $requestInfo->comment, 'status' => $requestInfo->status], 200);
    }
}
