<?php

namespace App\Http\Controllers\Admin;

use App\Models\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getIndex()
    {
        $pages = Page::all();
        return view('admin.pages.index', compact('pages'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
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

        if($page->update()){
            return redirect()->route('admin.pages')->with(['message' => 'Содержание страницы обновленно!']);
        }
        return redirect()->back()->with(['message' => 'Ошибка при редактировании страници']);

    }
}
