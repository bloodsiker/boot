<?php

namespace App\Http\Controllers\Api;

use App\Models\Comments;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    public function commentsByServiceCenter($id)
    {
        $comments = Comments::where([['service_center_id', $id],['status', '=', '1']])->get()->sortByDesc('id');
        $header = Comments::rating($id);
        $response = [
            'header' => $header,
            'list' => $comments
        ];
        return response()->json($response, 200);
    }
}
