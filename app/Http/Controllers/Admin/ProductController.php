<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends BaseAdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('photos')->get();
        return view('admin.product.index',[
            'user' => auth()->user(),
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.product.create',[
            'categories' => $categories,
            'user' => auth()->user()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|min:3|unique:products,name',
            'category' => 'required',
            'price' => 'required|numeric|min:3',
            'count' => 'required|numeric',
            'discount' => 'required|numeric',
            'photo' => 'required|image',
            'description' => 'required',
        ]);

        $product =  Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'count' => $request->count,
            'discount' => $request->discount,
            'description' => $request->description
        ]);

        $product->category()->sync($request->category);

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $photoName = time().random_int(111,999).'.jpg';
            $path = "uploads/products/{$product->id}/main";
            $file->move($path,$photoName);
            $product->photos()->create([
                'path' => $photoName,
                'caption' => $product->name,
                'main' => 1
            ]);
        }

        return redirect()->route('admin.product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.product.edit',[
           'user' => auth()->user(),
           'product' => $product,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $this->validate($request,[
            'name' => 'required|min:3',
            'category' => 'required',
            'price' => 'required|numeric|min:3',
            'count' => 'required|numeric',
            'discount' => 'required|numeric',
            'description' => 'required',
        ]);

        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'count' => $request->count,
            'discount' => $request->discount,
            'description' => $request->description
        ]);

        $product->category()->sync($request->category);

        if ($request->hasFile('photo')) {
            $oldPhoto = $product->photos()->where('main',1)->first();
            $oldPhotoPath = "uploads/products/{$product->id}/main/{$oldPhoto->path}";

            if (File::exists($oldPhotoPath)){
                File::delete($oldPhotoPath);
            }
            $file = $request->file('photo');
            $photoName = time().random_int(111,999).'.jpg';
            $path = "uploads/products/{$product->id}/main";

            $file->move($path,$photoName);
            $product->photos()->update([
                'path' => $photoName,
                'caption' => $product->name,
            ]);
        }

        return redirect()->route('admin.product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        $product->category()->detach();
        $product->photos()->delete();
        $path = public_path("uploads/products/{$product->id}");
        if (File::exists($path)) {
            File::deleteDirectory($path);
        }

        return redirect()->route('admin.product.index');
    }
}
