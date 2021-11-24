<?php

namespace App\Http\Controllers;

use App\Components\MenuRecursive;
use App\Models\Menu;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MenuController extends Controller
{
    private $menuRecursive;
    private $menu;
    public function __construct(MenuRecursive $menuRecursive, Menu $menu)
    {
        $this->menuRecursive = $menuRecursive;
        $this->menu = $menu;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $menus = DB::table('menus')->paginate(5);
        return view('admin.menus.list',compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $optionSelect = $this->menuRecursive->menuRecursiveCreate();
        return view('admin.menus.create',compact('optionSelect'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $menu = new Menu();
        $menu->name = $request->name;
        $menu->parent_id = $request->parent_id;
        $menu->slug = Str::slug($request->name);
        $menu->save();
        return redirect()->route('menus.list');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $menuIdEdit = Menu::find($id);
        $optionSelect = $this->menuRecursive->menuRecursiveEdit($menuIdEdit->parent_id);
        return view('admin.menus.edit',compact('menuIdEdit','optionSelect'));
    }

    /**
     * @param Request $request
     * @param $id
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $menu = Menu::find($id);
        $menu->name = $request->name;
        $menu->parent_id = $request->parent_id;
        $menu->slug = Str::slug($request->name);
        $menu->save();
        return redirect()->route('menus.list')->with('message','Update menu successfully!');
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        Menu::find($id)->delete();
        return redirect()->route('menus.list')->with('danger','Delete menu successfully!');
    }
}
