<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $patients = Patient::withoutTrashed()->paginate(10);

        $patientList = "PL";
        return View("backend.patients.patients",compact('patientList'))->with("patients", $patients);
    }


    public function create()
    {
        return View('backend.patients.patients');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'firstname'=>'required|string',
            'lastname'=>'required|string',
            'gender'=>'required|string',
            'address'=>'required|string',
            'phone'=>'required|string',
            'dob'=>'date'
        ]);

        \App\Models\Patient::create([
            'firstname'=>$request->firstname,
            'lastname'=>$request->lastname,
            'gender'=>$request->gender,
            'address'=>$request->address,
            'phone'=>$request->phone,
            'DOB'=>$request->dob
        ]);
        Session()->flash('success',"patient added successfully");
        return redirect()->route('patient.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(Patient $patient)
    {
        //
    }

    public function edit(string $id)
    {
        $patient = Patient::withoutTrashed()->where("patient_id",$id)->first();

        return View('backend.patients.patientEdit')->with("patient", $patient);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'firstname'=>'required|string',
            'lastname'=>'required|string',
            'gender'=>'required|string',
            'address'=>'required|string',
            'phone'=>'required|string',
            'dob'=>'date'
        ]);

        Patient::where("patient_id",$id)->update([
            'firstname'=>$request->firstname,
            'lastname'=>$request->lastname,
            'gender'=>$request->gender,
            'address'=>$request->address,
            'phone'=>$request->phone,
            'DOB'=>$request->dob
        ]);
        return redirect()->route('patient.index');
    }


    public function destroy(string $id)
    {
        Patient::withTrashed()->where('patient_id',$id)->delete();
        return redirect()->back();
    }

    public function trash() {
        $patients = Patient::onlyTrashed()->paginate(10);
        return View('backend.patients.patientTrash')->with("patients", $patients);
    }
    public function delete(string $id){
        Patient::withTrashed()->where('patient_id',$id)->forceDelete();
        return redirect()->back();
    }

    public function restore(string $id) {
        Patient::onlyTrashed()->where("patient_id",$id)->restore();
        return redirect()->back();
    }
}
