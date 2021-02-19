<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;

class AdminController extends Controller
{
    public function getAllAdmin() {
        $admins = Admin::all();
        return view('pages.admin.admin_list', ['admins' => $admins]);
    }

    public function changeStatus($id, $status) {
        $data =  Admin::find($id);
        $data->status = $status;
        $data->save();

        if($status == 1) {
            return redirect()->back()->with('msg', 'Admin Activated Succesfully.');
        } else {
            return redirect()->back()->with('msg', 'Admin Deactivated Succesfully.');
        }
    }

    public function changeSuper($id, $status) {
        $data =  Admin::find($id);
        $data->is_super = $status;
        $data->save();

        if($status == 1) {
            return redirect()->back()->with('msg', 'Admin Make Super Succesfully.');
        } else {
            return redirect()->back()->with('msg', 'Admin Remove Super Succesfully.');
        }
    }
}
