<?php

namespace App\Http\Controllers\ServiceCenterCabinet\Admin;

use App\Models\Comments;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{

    public function allComments()
    {
        $list_comments = Comments::all()->sortByDesc('id');
        $list_comments->load('service_center');
        //dd($list_comments);
        return view('service_center_cabinet.admin.comments.list_comments', compact('list_comments'));
    }


    public function getComment($id)
    {
        return view('service_center_cabinet.admin.comments.comment');
    }
}
