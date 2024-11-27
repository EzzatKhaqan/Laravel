<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StaffController extends Controller {

    public function index() {

        $staff = \App\Models\Staff::withoutTrashed()->paginate(10);
        $list = "stafflist";
        return view('backend.staff.staff', compact('list'))->with('staff', $staff);
    }

    public function create() {
        return view('backend.staff.staff');
    }

    public function store(Request $request) {
        $request->validate(['firstname' => 'required|string', 'lastname' => 'required|string', 'position' => 'required|string', 'select' => 'required|string', 'gender' => 'required', 'salary' => 'required|numeric', 'address' => 'string', 'phone' => 'required|string', 'dob' => 'required|date', 'image' => 'mimes:jpeg,jpg,png|max:3500']);

        $file = $request->file('image');
        $image = '';

        if ($request->hasFile('image')) {
            $image = hash('sha256', time()) . $file->getClientOriginalName() . '.' . $file->getClientOriginalExtension();
            $file->move('images/staff', $image);
        }
        \App\Models\staff::create(['firstname' => $request->firstname, 'lastname' => $request->lastname, 'staff_type' => $request['select'], 'position' => $request->position, 'gender' => $request['gender'], 'photo' => $image, 'address' => $request->address, 'phone' => $request->phone, 'DOB' => $request->dob, 'net_salary' => $request->salary,]);

        Session()->flash('success', 'StaffController added successfully');
        return redirect()->back();
    }

    public function show(string $id) {
        //        dd($id);
    }

    public function edit(string $id) {
        $staff = \App\Models\Staff::where("staff_id", '=', $id)->first();
        return View('backend.staff.staffEdit')->with('staff', $staff);
    }

    public function update(Request $request, string $id) {
        $staff = \App\Models\Staff::where("staff_id", '=', $id)->first();
        $image = '';
        if ($request->hasFile('image')) {
            $file = $request->file('image');

            if (!empty($staff->photo)) {
                $filepath = public_path('images/staff/' . $staff->photo);
                if (file_exists($filepath)) {
                    try {
                        unlink($filepath);
                    } catch (\Exception $e) {
                    }
                }

            }
            $image = hash('sha256', time()) . $file->getClientOriginalName() . '.' . $file->getClientOriginalExtension();
            $file->move('images/staff', $image);

        } else {
            if(!empty($staff->photo)) {
                $image = $staff->photo;
            }else{
                $image = "";
            }
        }

        $staff->where('staff_id', "=", $id)->update([
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'staff_type' => $request['select'],
                'position' => $request->position,
                'gender' => $request->gender,
                'photo' => $image,
                'address' => $request->address,
                'phone' => $request->phone,
                'DOB' => $request->dob,
                'net_salary' => $request->salary
            ]);

        Session()->flash('updated', "StaffController updated successfully");
        return redirect()->route('staff.index');
    }

    public function destroy(string $id) {
        \App\Models\Staff::where('staff_id', '=', $id)->delete();

        return redirect()->route('staff.index');
    }

    public function trash() {

        $staff = \App\Models\Staff::onlyTrashed()->paginate(10);
        return View("backend..staff.staffTrash")->with('staff', $staff);
    }

    public function restore(string $id) {

        \App\Models\Staff::onlyTrashed()->where("staff_id", '=', $id)->restore();

        return redirect()->route('staff.index');
    }

    public function delete(string $id) {
        \App\Models\Staff::onlyTrashed()->where("staff_id", '=', $id)->forceDelete();
        return redirect()->route('staff.trash');
    }

}
