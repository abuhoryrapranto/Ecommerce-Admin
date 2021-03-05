<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Type;
use App\Models\SubType;
use App\Models\Color;
use App\Models\Size;
use App\Models\ProductImage;
use App\Models\Product;
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

        $image = $request->file('thumbnail');
        $image_name = null;

        if($image) {
            $image_name = time()."-".$image->getClientOriginalName();

            $destinationPath = public_path('thumbnail');

            $resize_image = Image::make($image->getRealPath());

            $resize_image->resize(200, 200, function($constraint){
            $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_name);
        }

        $data = $productRepository->saveProduct($request, $image_name);
        if($data == true)
            return redirect('product/add-images')->with('msg', 'Product added successfully. If you want add feature images for this product upload it'); 
        return redirect()->back()->with('failedMsg', 'Product not save successfully. Maybe, Somethings happens in conection.');
        
    }

    public function addImages() {
        return view('pages.products.add_images');
    }

    public function saveImages(Request $request) {

        $data = [];
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
        Session::forget('product-saved-successfully');
        return redirect('product/add-new')->with('msg', 'Product and Fearture Images uploaded successfully.');
        //dd($images);
    }

    public function processFeatureImages($data) {
        $images = $data->map(function($item) {
            return $item->url;
        });
        return $images;
    }

    public function getAllActiveProducts() {
        $products = Product::with('brand', 'type', 'subtype', 'productImages', 'productOptions')->where('status', 'active')->orderByDesc('id')->paginate(18);

        $data = array();

        foreach($products as $row) {
            $newData = array(
                'slug' => $row->slug,
                'name' => $row->name,
                'brand' => $row->brand->name,
                'type' => $row->type->name,
                'sub_type' => $row->subType->name,
                'thumbnail' => $row->thumbnail,
                'main_price' => $row->main_price,
                'offer_price' => $row->offer_price,
                'description' => $row->description,
                'feature_images' => $row->productImages,//$this->processFeatureImages($row->productImages)
                'options' => $row->productOptions
            );
            array_push($data, $newData);
        }

        return view('pages.products.active_products_list', ['products' => $data]);
    }

}
