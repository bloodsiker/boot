<?php

namespace App\Http\Controllers\Admin;

use App\Models\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function getIndex()
    {
        $pages = Page::all();
        return view('admin.pages.index', compact('pages'));
    }

    public function getEdit($id)
    {
        $page = Page::find($id);
        return view('admin.pages.edit', compact('page'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postEdit(Request $request, $id)
    {
        $page = Page::find($id);
        $page->name = $request->name;
        $page->content = $request->content;
        $page->enabled = $request->enabled;

        $message = 'Ошибка при редактировании страници';
        if($page->update()){
            $message = 'Содержание страницы обновленно!';
            return redirect()->route('admin.pages')->with(['message' => $message]);
        }
        return redirect()->back()->with(['message' => $message]);

    }
}
