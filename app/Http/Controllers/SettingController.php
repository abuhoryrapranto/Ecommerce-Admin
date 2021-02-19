<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SettingStoreRequest;
use App\Repositories\SettingRepository;

class SettingController extends Controller 
{
    public function saveBrand(Request $request, SettingRepository $settingRepository) {

        $this->validate($request, [
            'brand_name'     => 'required|string'
        ]);

        $data = $settingRepository->saveBrand($request);
        if($data)
            return redirect()->back()->with('msg', 'Brand save successfully.'); 
        return redirect()->back()->with('failedMsg', 'Brand not save successfully. Maybe, Somethings happens in conection.');
    }

    public function saveType(Request $request, SettingRepository $settingRepository) {

        $this->validate($request, [
            'type_name'     => 'required|string'
        ]);

        $data = $settingRepository->saveType($request);
        if($data)
            return redirect()->back()->with('msg', 'Type save successfully.'); 
        return redirect()->back()->with('failedMsg', 'Type not save successfully. Maybe, Somethings happens in conection.');
    }

    public function saveSubType(Request $request, SettingRepository $settingRepository) {

        $this->validate($request, [
            'sub_type_name'     => 'required|string'
        ]);

        $data = $settingRepository->saveSubType($request);
        if($data)
            return redirect()->back()->with('msg', 'SubType save successfully.'); 
        return redirect()->back()->with('failedMsg', 'Sub Type not save successfully. Maybe, Somethings happens in conection.');
    }
}
