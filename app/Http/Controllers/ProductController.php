<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Type;
use App\Models\SubType;
use App\Models\Color;
use App\Models\Size;
use App\Http\Requests\ProductStoreRequest;
use App\Repositories\ProductRepository;

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

}
