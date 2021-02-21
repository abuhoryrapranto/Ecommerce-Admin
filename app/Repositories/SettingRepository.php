<?php

namespace App\Repositories;

use App\Models\Brand;
use App\Models\Type;
use App\Models\SubType;
use App\Models\Color;
use App\Models\Size;
use Illuminate\Support\Facades\DB;


class SettingRepository {

    public function saveBrand($item) {

        $data = new Brand;
        $data->name = $item->brand_name;
        $data->description = $item->brand_description;
        $data->save();

        return $data;
    }

    public function saveType($item) {

        $data = new Type;
        $data->name = $item->type_name;
        $data->description = $item->type_description;
        $data->save();
        return $data;
    }

    public function saveSubType($item) {

        $data = new SubType;
        $data->name = $item->sub_type_name;
        $data->description = $item->sub_type_description;
        $data->save();
        return $data;
    }

    public function getAllBrands() {
       return Brand::orderByDesc('status')->paginate(10);
    }

    public function deleteBrand($id) {
        return Brand::find($id)->delete();
    }

    public function brandStatusChange($id, $status) {
        $data = Brand::find($id);
        $data->status = $status;
        $data->save();
    }
}