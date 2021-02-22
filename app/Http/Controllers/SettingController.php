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

    public function getAllBrands(SettingRepository $settingRepository) {
        $brands = $settingRepository->getAllBrands();
        return view('pages.settings.brand', ['brands' => $brands]);
    }

    public function deleteBrand(SettingRepository $settingRepository, $id) {
        $brand = $settingRepository->deleteBrand($id);
        if($brand)
            return redirect()->back()->with('msg', 'Brand Deleted.');
        return redirect()->back()->with('msg', 'Something happened!');
    }

    public function brandStatusChange(SettingRepository $settingRepository, $id, $status) {
        $brand = $settingRepository->brandStatusChange($id, $status);
        if($status == 1)
            return redirect()->back()->with('msg', 'Brand Activated.');
        return redirect()->back()->with('msg', 'Brand Deactivated!');
    }

    public function getAllTypes(SettingRepository $settingRepository) {
        $types = $settingRepository->getAllTypes();
        return view('pages.settings.type', ['types' => $types]);
    }

    public function deleteType(SettingRepository $settingRepository, $id) {
        $type = $settingRepository->deleteType($id);
        if($type)
            return redirect()->back()->with('msg', 'Type Deleted.');
        return redirect()->back()->with('msg', 'Something happened!');
    }

    public function typeStatusChange(SettingRepository $settingRepository, $id, $status) {
        $type = $settingRepository->typeStatusChange($id, $status);
        if($status == 1)
            return redirect()->back()->with('msg', 'Type Activated.');
        return redirect()->back()->with('msg', 'Type Deactivated!');
    }

    public function getAllSubTypes(SettingRepository $settingRepository) {
        $subtypes = $settingRepository->getAllSubTypes();
        return view('pages.settings.subtype', ['subtypes' => $subtypes]);
    }

    public function deleteSubType(SettingRepository $settingRepository, $id) {
        $type = $settingRepository->deleteSubType($id);
        if($type)
            return redirect()->back()->with('msg', 'Subtype Deleted.');
        return redirect()->back()->with('msg', 'Something happened!');
    }

    public function subTypeStatusChange(SettingRepository $settingRepository, $id, $status) {
        $type = $settingRepository->subTypeStatusChange($id, $status);
        if($status == 1)
            return redirect()->back()->with('msg', 'Subtype Activated.');
        return redirect()->back()->with('msg', 'Subtype Deactivated!');
    }
}
