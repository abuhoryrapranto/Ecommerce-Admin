<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Hash;

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

    public function saveAdmin(Request $request) {
        $this->validate($request,[
            'full_name' =>'required',
            'email' => 'email|required',
            'phone' => 'numeric|digits:10',
            'password' => 'min:6'
        ]);

        $data = new Admin;
        $data->full_name = $request->full_name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->password = Hash::make($request->password);
        $data->save();

        return redirect()->back()->with('msg', 'Admin added successfully.');
    }
}
