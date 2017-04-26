<?php

namespace App\Http\Controllers\Api;

use App\Models\Comments;
use App\Models\ServiceCenter;
use App\Models\UserRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CatalogController extends Controller
{
    public function getIndex()
    {
        $service_center = ServiceCenter::all();
        $service_center->load('city', 'metro', 'district', 'tags', 'manufacturers');
        $service_center->map(function ($comment) {
            $comment['comments'] = Comments::count_comment($comment->id);
            return $comment;
        });
        $service_center->map(function ($rating) {
            $total_rating = Comments::rating($rating->id, 'total');
            $rating['rating'] = $total_rating;
            return $rating;
        });
        //dd($service_center);
        return response()->json($service_center, 200);
    }

    public function getServiceCenter($id)
    {
        $service_center = ServiceCenter::find($id);
        $service_center->load('city', 'metro', 'district', 'tags', 'manufacturers', 'advantages', 'price', 'personal', 'certificate', 'service_photo');
        $service_center['count_clients'] = UserRequest::count_request($id);
        $service_center['total_rating'] = Comments::rating($id, 'total');
        $service_center['total_comments'] = Comments::count_comment($id);
        //dd($service_center);
        return response()->json($service_center, 200);
    }


}
