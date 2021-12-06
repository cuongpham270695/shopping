<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSliderRequest;
use App\Models\Slider;
use App\Traits\StorageImageTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SliderController extends Controller
{
    use StorageImageTrait;
    private $slider;
    public function __construct(Slider $slider)
    {
        $this->slider = $slider;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $sliders = DB::table('sliders')->orderBy('created_at','desc')->paginate(5);
        return view('admin.sliders.list',compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('admin.sliders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateSliderRequest $request)
    {
        try {
            $slider = new Slider;
            $slider->name = $request->name;
            $slider->description = $request->description;
            $imageSlider = $this->storageTraitUpload($request,'image_path','slider');
            if (!empty($imageSlider)) {
                $slider['image_name'] = $imageSlider['file_name'];
                $slider['image_path'] = $imageSlider['file_path'];
            }
            $slider->save();
            return redirect()->route('sliders.list');
        } catch (\Exception $e) {
            Log::error('Error' . $e->getMessage() . 'Line' . $e->getLine());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $slider = $this->slider->find($id);
        return view('admin.sliders.edit',compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        try {
            $slider = Slider::find($id);
            $slider->name = $request->name;
            $slider->description = $request->description;
            $imageSlider = $this->storageTraitUpload($request,'image_path','slider');
            if (!empty($imageSlider)) {
                $slider['image_name'] = $imageSlider['file_name'];
                $slider['image_path'] = $imageSlider['file_path'];
            }
            $slider->save();
            return redirect()->route('sliders.list');
        } catch (\Exception $e) {
            Log::error('Error' . $e->getMessage() . 'Line' . $e->getLine());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {
            Slider::find($id)->delete();
            return response()->json([
                'code' => 200,
                'message' => 'Delete success'
            ],200);
        } catch (\Exception $e) {
            Log::error('Error' . $e->getMessage() . 'Line' . $e->getLine());
            return response()->json([
                'code' => 500,
                'message' => 'Delete failed'
            ],500);
        }
    }
}
