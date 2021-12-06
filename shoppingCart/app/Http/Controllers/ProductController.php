<?php

namespace App\Http\Controllers;

use App\Components\Recursive;
use App\Http\Requests\CreateProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductTag;
use App\Models\Tag;
use App\Traits\StorageImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    use StorageImageTrait;
    private $category;
    private $product;
    private $productImage;
    private $tag;
    private $productTag;

    public function __construct(Category $category, Product $product, ProductImage $productImage, Tag $tag, ProductTag $productTag)
    {
        $this->category = $category;
        $this->product = $product;
        $this->productImage = $productImage;
        $this->tag = $tag;
        $this->productTag = $productTag;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->product->latest()->paginate(5);
        return view('admin.products.list',compact('products'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $htmlOption = $this->getCategory($parent_id = '');
        return view('admin.products.create',compact('htmlOption'));
    }

    public function getCategory($parent_id): string
    {
        $data = $this->category->all();
        $recursive = new Recursive($data);
        $htmlOption = $recursive->categoryRecusive($parent_id);
        return $htmlOption;
    }

    /**
     * @param Request $request
     * @return false|string
     */
    public function store(CreateProductRequest $request)
    {
        try {
            DB::beginTransaction();
            $dataProductCreate = [
                'name' => $request->name,
                'price' => $request->price,
                'description' => $request->description,
                'user_id' => auth()->id(),
                'category_id' => $request->category_id
            ];
            $dataUploadImage = $this->storageTraitUpload($request,'image','product');
            if (!empty($dataUploadImage)) {
                $dataProductCreate['image_name'] = $dataUploadImage['file_name'];
                $dataProductCreate['image'] = $dataUploadImage['file_path'];
            }
            $product = $this->product->create($dataProductCreate);

            if ($request->hasFile('images')) {
                foreach ($request->images as $fileItem) {
                    $dataProductImageDetail = $this->storageTraitUploadMultiple($fileItem,'product');
                    $product->images()->create([
                        'images' => $dataProductImageDetail['file_path'],
                        'images_name' => $dataProductImageDetail['file_name']
                    ]);
                }
            }
            if (!empty($request->tags)) {
                foreach($request->tags as $tagItem) {
                    $tagInstance = $this->tag->firstOrCreate(['name' => $tagItem]);
                    $tagIds[] = $tagInstance->id;
                }
            }
            $product->tags()->attach($tagIds);
            DB::commit();
            return redirect()->route('products.list');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Message: ' . $e->getMessage() . 'Line: ' . $e->getLine());
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $product = $this->product->find($id);
        $htmlOption = $this->getCategory($product->category_id);
        return view('admin.products.edit',compact('htmlOption','product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $dataProductUpdate = [
                'name' => $request->name,
                'price' => $request->price,
                'description' => $request->description,
                'user_id' => auth()->id(),
                'category_id' => $request->category_id
            ];
            $dataUploadImage = $this->storageTraitUpload($request,'image','product');
            if (!empty($dataUploadImage)) {
                $dataProductUpdate['image_name'] = $dataUploadImage['file_name'];
                $dataProductUpdate['image'] = $dataUploadImage['file_path'];
            }
            $this->product->find($id)->update($dataProductUpdate);
            $product = $this->product->find($id);

            if ($request->hasFile('images')) {
                $this->productImage->where('product_id',$id)->delete();
                foreach ($request->images as $fileItem) {
                    $dataProductImageDetail = $this->storageTraitUploadMultiple($fileItem,'product');
                    $product->images()->create([
                        'images' => $dataProductImageDetail['file_path'],
                        'images_name' => $dataProductImageDetail['file_name']
                    ]);
                }
            }
            if (!empty($request->tags)) {
                foreach($request->tags as $tagItem) {
                    $tagInstance = $this->tag->firstOrCreate(['name' => $tagItem]);
                    $tagIds[] = $tagInstance->id;
                }
            }
            $product->tags()->sync($tagIds);
            DB::commit();
            return redirect()->route('products.list');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Message: ' . $e->getMessage() . 'Line: ' . $e->getLine());
        }
    }

    /**
     * @param $id
     */
    public function destroy($id)
    {
        try {
            $this->product->find($id)->delete();
            return response()->json([
                'code' => 200,
                'message' => 'success'
            ],200);
        } catch (\Exception $e) {
            Log::error('Message: ' . $e->getMessage() . 'Line: ' . $e->getLine());
            return response()->json([
                'code' => 500,
                'message' => 'failed'
            ],500);
        }
    }
}
