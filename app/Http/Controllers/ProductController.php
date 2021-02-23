<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Type;
use App\Models\SubType;
use App\Models\Color;
use App\Models\Size;
use App\Models\ProductImage;
use App\Http\Requests\ProductStoreRequest;
use App\Repositories\ProductRepository;
use Image;
use DB;
use Session;

class ProductController extends Controller
{
    public function addNew() {
        $brands = Brand::where('status', 1)->get();
        $types = Type::where('status', 1)->get();
        $sub_types = SubType::where('status', 1)->get();
        $colors = Color::where('status', 1)->get();
        $sizes = Size::where('status', 1)->get();
        return view('pages.products.add_product', [
                                                    'brands' => $brands, 
                                                    'types' => $types, 
                                                    'sub_types' => $sub_types,
                                                    'colors' => $colors,
                                                    'sizes' => $sizes
                                                ]
        );
    }

    public function saveProduct(ProductStoreRequest $request, ProductRepository $productRepository) {
        $data = $productRepository->saveProduct($request);
        if($data == true)
            return redirect('product/add-images')->with('msg', 'Product save successfully. If you want add images for this product upload it'); 
        return redirect()->back()->with('failedMsg', 'Product not save successfully. Maybe, Somethings happens in conection.');
        
    }

    public function addImages() {
        return view('pages.products.add_images');
    }

    public function saveImages(Request $request) {

        $data = [];
        //$images = [];
        $photo = $request->all();
        $destinationPath = public_path('products');
        foreach($photo['photo'] as $row) {
            $data[] = [
                'product_id' => Session::get('product-saved-successfully'),
                'url' => time()."-".$row['name']->getClientOriginalName(),
                'type' => 'feature',
                'color' => $row['color']
            ];
            $images = time()."-".$row['name']->getClientOriginalName();

            $resize_image = Image::make($row['name']->getRealPath());

            $resize_image->resize(500, 500, function($constraint){
            $constraint->aspectRatio();
            })->save($destinationPath . '/' . $images);
        }
        
        DB::table('product_images')->insert($data);
        return redirect()->back()->with('msg', 'Images upload successfully.');
        //dd($images);
    }

}
