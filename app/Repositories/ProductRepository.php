<?php

namespace App\Repositories;

use App\Traits\GeneralTrait;
use App\Models\Product;
use App\Models\ProductOption;
use Illuminate\Support\Facades\DB;
use Session;


class ProductRepository {

    use GeneralTrait;

    public function saveProduct($item) {

        DB::beginTransaction();
        try {
            
        $data = new Product;
        $data->code = 'PD-'.$this->uniqueNumber(5);
        $data->name = $item->name;
        $data->slug = $this->uniqueSlug($item->name);
        $data->brand_id = $item->brand_id;
        $data->type_id = $item->type_id;
        $data->sub_type_id = $item->sub_type_id;
        $data->main_price = $item->main_price;
        $data->offer_price = $item->offer_price;
        $data->description = $item->description;
        $data->total_stock = $item->total_stock;
        $data->status = $item->status;
        $data->save();

        $opt = new ProductOption;
        $opt->product_id = $data->id;
        $opt->color = $item->color ? implode(',', $item->color) : null;
        $opt->size = $item->size ? implode(',', $item->size) : null;
        $opt->weight = $item->weight;
        $opt->custom = null;
        $opt->save();

        DB::commit();
        Session::put('product-saved-successfully', true);
        return true;

        } catch(\Exception $e) {
            DB::rollBack();
            //throw $e;
            return false;
        }
    }
}