<?php

namespace App\Http\Controllers\Crm;

use App\Models\FormRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RequestHelpController extends Controller
{
    public function getIndex()
    {
        $requests = FormRequest::all()->sortByDesc('id');
        return view('crm_cabinet.request.help', compact('requests'));
    }
}
