<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\PatientRecord;
use App\Models\staff;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PatientRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $patientRecords = PatientRecord::all();

//        dd($patientRecords);
//        $result = [];
//        foreach($patientRecords as $patientRecord){
//            $temp = [];
//            $p = Patient::where("patient_id",$patientRecord->patient_id)->first();
//            $s = Staff::where("staff_id",$patientRecord->staff_id)->first();
//            $sickness = array($patientRecord->sickness);
//            $result =  [$patientRecord->result];
//            $timeout = [$patientRecord->time_out];
//            $time_in = [$patientRecord->time_in];
//            $temp = ["patient_name"=>$p->firstname,
//                     "staff_name"=>$s->firstname,
//                     "result"=>$result,
//                     "time_out"=>$timeout,
//                     "time_in"=>$time_in,
//                     "sickness"=>$sickness,
//                     "patient_id"=>$patientRecord->patient_id,
//                     "staff_id"=>$patientRecord->staff_id];
//            array_push($result,$temp);
//        }
//        dd($result);
        return View("backend.patients.patient_records.patient_records")->with("patientRecords", $patientRecords);
    }



    public function create()
    {
        $patients = Patient::all();
        $staff = Staff::all();
        return View("backend/patients/patient_records/patient_records")->with("patients", $patients)->with("staff", $staff);
    }

    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required',
            'staff_id' => 'required',
        ]);

        $currentTime = Carbon::now()->format("H:i:s");
        $timeOut = "";
        PatientRecord::create([
            "patient_id" => $request->patient_id,
            "staff_id" => $request->staff_id,
            "sickness"=> $request->sickness,
            "result"=> $request->result,
            "time_in"=> $currentTime,

        ]);
        Session()->flash("success", "Record created successfully");
        return redirect()->back();

    }

    /**
     * Display the specified resource.
     */
    public function show(PatientRecord $patientRecord)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PatientRecord $patientRecord)
    {
        return View("backend/patinets/patinet_records/patient_record_Edit")->with("patientRecord", $patientRecord);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PatientRecord $patientRecord)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PatientRecord $patientRecord)
    {
        //
    }
}
