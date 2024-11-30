<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\PatientMedicineRequest;
use App\Models\Medicine;
use App\Models\Patient;
use App\Models\PatientMedicine;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PatientMedicineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $patients = Patient::withoutTrashed()->get();
        $medicines = Medicine::withoutTrashed()->get();

        return View("backend.patients.patient_medicine.index")->with("patients",$patients)->with("medicines",$medicines);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PatientMedicineRequest $request)
    {

        $temp = $request->validated();
        PatientMedicine::create([$temp,
            "apply_date"=>Carbon::now("Asia/Manila"),]);
        Session()->flash("success","Patient Medicine Added Successfully");
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(PatientMedicine $patientMedicine)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PatientMedicine $patientMedicine)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PatientMedicineRequest $request, PatientMedicine $patientMedicine)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PatientMedicine $patientMedicine)
    {
        //
    }
}
