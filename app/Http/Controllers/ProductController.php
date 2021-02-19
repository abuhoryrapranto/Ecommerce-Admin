<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Type;
use App\Models\SubType;
use App\Http\Requests\ProductStoreRequest;
use App\Repositories\ProductRepository;

class ProductController extends Controller
{
    public function addNew() {
        $brands = Brand::all();
        $types = Type::all();
        $sub_types = SubType::all();
        return view('pages.products.add_product', ['brands' => $brands, 'types' => $types, 'sub_types' => $sub_types]);
    }

    public function saveProduct(ProductStoreRequest $request, ProductRepository $productRepository) {
        $data = $productRepository->saveProduct($request);
        if($data == true)
            return redirect()->back()->with('msg', 'Product save successfully.'); 
        return redirect()->back()->with('failedMsg', 'Product not save successfully. Maybe, Somethings happens in conection.');
        
    }

}
