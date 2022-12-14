<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Product;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $products = Product::all();
        $products = Product::orderBy('created_at', 'DESC')->search()->paginate(4);
        return view('products.list', compact('products'));

        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::get();
        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = new Product();
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->slug = $request->input('slug');
        $product->description = $request->input('description');
        $product->status = $request->input('status');
        $product->category_id = $request->input('danhmuc_id');
        
        

        // if($request->hasFile('image')){
        //     $image = $request->file('image');
        //     $path = $image->store('image', 'public');
        //     $product->image = $path;
        // }

        $get_image=$request->image;
        $path='public/uploads/product/';
        $get_name_image=$get_image->getClientOriginalName();
        $name_image=current(explode('.',$get_name_image));
        $new_image=$name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
        $get_image->move($path,$new_image);
        $product->image=$new_image;
        $request['login_image']=$new_image;



        // if ($request->hasFile('image')) {
        //     $file = $request->image;
        //     $fileExtension = $file->getClientOriginalExtension();//jpg,png l???y ra ?????nh d???ng file v?? tr??? v???
        //     $fileName = time();//45678908766 t???o t??n file theo th???i gian
        //     $newFileName = $fileName.'.'.$fileExtension;//45678908766.jpg
        //     $path = 'storage/'. $request->file('image')->store('image', 'public');//l??u file v??o m???c public/images v???i t?? m???i l?? $newFileName
        //     $product->image = $path;
        // }
        $product->save();

        Session::flash('success', 'T???o m???i th??nh c??ng');
        //tao moi xong quay ve trang danh sach task
        return redirect()->route('products.index');
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
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->slug = $request->input('slug');
        $product->description = $request->input('description');
        $product->status = $request->input('status');
       
        // if ($request->hasFile('image')) {

        //     //xoa anh cu neu co
        //     $currentImg = $product->image;
        //     if ($currentImg) {
        //         Storage::delete('/public/' . $currentImg);
        //     }
        //     // cap nhat anh moi
        //     $image = $request->file('image');
        //     $path = $image->store('image', 'public');
        //     $product->image = $path;
        // }

        $get_image=$request->image;
        if($get_image){
            $path='public/uploads/product/'.$product->image;
            if(file_exists($path)){
                unlink($path);
            }
        $path='public/uploads/product/';
        $get_name_image=$get_image->getClientOriginalName();
        $name_image=current(explode('.',$get_name_image));
        $new_image=$name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
        $get_image->move($path,$new_image);
        $product->image=$new_image;
        $request['login_image']=$new_image;     
        }
        $product->save();

        //dung session de dua ra thong bao
        Session::flash('success', 'C???p nh???t th??nh c??ng');
        //tao moi xong quay ve trang danh sach product
        return redirect()->route('products.list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $image = $product->image;

        //delete image
        // if ($image) {
        //     Storage::delete('/public/' . $image);
        // }
        $image = 'public/uploads/product/'.$product->image;
        if(file_exists($image)){
            unlink($image);
        }

        $product->delete();

        //dung session de dua ra thong bao
        Session::flash('success', 'X??a th??nh c??ng');
        //xoa xong quay ve trang danh sach product
        return redirect()->route('products.index');
    }
}
