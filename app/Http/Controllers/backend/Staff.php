<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Staff extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = "stafflist";
        return view('backend.staff',compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.staff');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'position'=> 'required|string',
            'select'=> 'required|string',
            'gender'=> 'required',
            'salary'=> 'required|numeric',
            'address'=> 'string',
            'phone'=> 'required|string',
            'dob'=> 'required|date',
        ]);

        $file = $request->file('image');
        $image = '';

        dd($file);
        if(isset($file)){
            dd($request->all());
            $image = hash(time()).'.'.$file->getClientOriginalExtension();
            $file->move('images/staff',$image);
        }

        \App\Models\staff::create([
            'firstname'=>$request->firstname,
            'lastname'=> $request->lastname,
            'staff_type'=> $request->select,
            'position'=> $request->position,
            'gender'=> $request['gender'],
            'photo'=> "null",
            'address'=> $request->address,
            'phone'=> $request->phone,
            'dob'=> $request->dob,
            'net_salary'=> $request->salary,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
