<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Components\Recursive;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    private $category;
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $categories = DB::table('categories')->paginate(5);
        return view('admin.categories.list',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $htmlOption = $this->getCategory($parent_id = '');
        return view('admin.categories.create', compact('htmlOption'));
    }

    public function getCategory($parent_id): string
    {
        $data = Category::all();
        $recursive = new Recursive($data);
        $htmlOption = $recursive->categoryRecusive($parent_id);
        return $htmlOption;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $category = new Category();
        $category->name = $request->name;
        $category->parent_id = $request->parent_id;
        $category->slug = Str::slug($request->name);
        $category->save();
        return redirect()->route('categories.list')->with('message','Add category successfully');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $category = Category::find($id);
        $htmlOption = $this->getCategory($category->parent_id);
        return view('admin.categories.edit',compact('category','htmlOption'));
    }

    public function update(Request $request,$id): RedirectResponse
    {
        $category = Category::find($id);
        $category->name = $request->name;
        $category->parent_id = $request->parent_id;
        $category->slug = Str::slug($request->name);
        $category->save();
//        $this->category->find($id)->update([
//            'name' => $request->name,
//            'parent_id' => $request->parent_id,
//            'slug' => Str::slug($request->name)
//        ]);
        return redirect()->route('categories.list')->with('message','Update category successfully');
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        Category::find($id)->delete();
        return redirect()->route('categories.list')->with('error','Category is deleted');
    }


}
