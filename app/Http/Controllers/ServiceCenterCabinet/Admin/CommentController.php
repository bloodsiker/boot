<?php

namespace App\Http\Controllers\ServiceCenterCabinet\Admin;

use App\Models\Comments;
use App\Models\ServiceCenter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mail;

class CommentController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function allComments()
    {
        $list_comments = Comments::all()->sortByDesc('id');
        $list_comments->load('service_center');
        return view('service_center_cabinet.admin.comments.list_comments', compact('list_comments'));
    }


    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getComment($id)
    {
        $comment = Comments::where('comments.id', $id)->with('service_center')
            ->leftJoin('users', function ($join) {
                $join->on('users.id', '=', 'comments.user_id')
                    ->whereNotNull('comments.user_id');
            })
            ->select('comments.*', 'users.avatar')
            ->first();
        return view('service_center_cabinet.admin.comments.comment', compact('comment'));
    }


    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function publishedComment(Request $request, $id)
    {
        $comment = Comments::where('id', $id)->first();
        $comment->status = $request->status;
        $comment->save();

        if($request->sc_notification == 1){
            $service_center = ServiceCenter::find($comment->service_center_id);
            $user = $service_center->user;
            Mail::send('site.emails.new_comment_sc', compact('comment', 'service_center'), function ($message) use ($service_center, $user) {
                $message->from('info@boot.com.ua', 'BOOT');
                $message->to($user->email)->subject('Новый комментарий к вашему сервисному центру ' . $service_center->service_name);
            });
        }
        return redirect()->back();
    }
}
