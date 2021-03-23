<?php

namespace App\Repositories;

use App\Traits\GeneralTrait;
use App\Models\Product;
use App\Models\ProductOption;
use Illuminate\Support\Facades\DB;
use Session;


class ProductRepository {

    use GeneralTrait;

    public function saveProduct($item, $image_name) {

        DB::beginTransaction();
        try {
            
        $data = new Product;
        $data->code = 'PD-'.$this->uniqueNumber(5);
        $data->name = $item->name;
        $data->slug = $this->uniqueSlug($item->name);
        $data->brand_id = $item->brand_id;
        $data->type_id = $item->type_id;
        $data->sub_type_id = $item->sub_type_id;
        $data->thumbnail = $image_name;
        $data->main_price = $item->main_price;
        $data->offer_price = $item->offer_price;
        $data->description = $item->description;
        $data->total_stock = $item->total_stock;
        $data->status = 'unpublished';
        $data->is_feature = 'no';
        $data->save();

        $opt = new ProductOption;
        $opt->product_id = $data->id;
        $opt->color = $item->color ? implode(',', $item->color) : null;
        $opt->size = $item->size ? implode(',', $item->size) : null;
        $opt->weight = $item->weight;
        $opt->custom = null;
        $opt->save();

        DB::commit();
        Session::put('product-saved-successfully', $data->id);
        return true;

        } catch(\Exception $e) {
            DB::rollBack();
            //throw $e;
            return false;
        }
    }

    public function getAllActiveProducts() {

        return Product::select('products.code', 
                                'products.slug',
                                'products.name', 
                                'products.thumbnail', 
                                'products.main_price', 
                                'products.offer_price', 
                                'products.description', 
                                'brands.name as brand_name', 
                                'types.name as type_name', 
                                'sub_types.name as sub_type_name',
                                'product_images.url',
                                'product_images.type',
                                'product_images.color'
                            )
                        ->leftJoin('brands', 'brands.id', '=', 'products.brand_id')
                        ->leftJoin('types', 'types.id', '=', 'products.type_id')
                        ->leftJoin('sub_types', 'sub_types.id', '=', 'products.sub_type_id')
                        ->leftJoin('product_images', 'product_images.product_id', '=', 'products.id')
                        ->where('products.status', 'active')
                        ->get();
    }
}