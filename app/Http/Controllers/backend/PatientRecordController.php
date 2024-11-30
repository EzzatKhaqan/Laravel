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
        $patientRecords = PatientRecord::withoutTrashed()->paginate(10);

        $result = [];
        foreach($patientRecords as $patientRecord){
            $p = Patient::where("patient_id",$patientRecord->patient_id)->first();
            $s = Staff::where("staff_id",$patientRecord->staff_id)->first();

            $temp = ["patient_name"=>$p->firstname,
                     "staff_name"=>$s->firstname,
                     "result"=>$patientRecord->result,
                     "time_out"=>$patientRecord->time_out,
                     "time_in"=>$patientRecord->time_in,
                     "sickness"=>$patientRecord->sickness,
                     "patient_id"=>$patientRecord->patient_id,
                     "staff_id"=>$patientRecord->staff_id,
                     "patient_record_id"=>$patientRecord->patient_record_id,];
            array_push($result,$temp);
        }
        if(Session()->has('trash')){
            Session()->forget('trash');
        }
        return View("backend.patients.patient_records.patient_records")->with("result", $result)->with("patientRecords",$patientRecords);
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

    public function show(PatientRecord $patientRecord)
    {
        $patient = Patient::where("patient_id","=",$patientRecord->patient_id)->first();
        $staff = Staff::where("staff_id","=",$patientRecord->staff_id)->first();
        return View("backend/patients/patient_records/History")->with("patientRecord",$patientRecord)->with("staff",$staff)->with("patient",$patient);
    }

    public function edit(PatientRecord $patient_record)
    {
        $patient = Patient::where("patient_id","=",$patient_record->patient_id)->first();
        $staff = Staff::where("staff_id","=",$patient_record->staff_id)->first();
        $patients = Patient::all();
        $staffs = Staff::all();
        return View("backend/patients/patient_records/patient_record_Edit")->with("patient_record", $patient_record)->
        with("patient", $patient)->with("staff",$staff)->with("patients", $patients)->with("staffs", $staffs);
    }

    public function update(Request $request, PatientRecord $patientRecord)
    {
        $currentTime = Carbon::now()->format("H:i:s");

        PatientRecord::where("patient_record_id","=",$patientRecord->patient_record_id)->first()->update([
            "patient_id" => $request->patient_id,
            "staff_id" => $request->staff_id,
            "sickness"=> $request->sickness,
            "result"=> $request->result,
            "time_in"=>$patientRecord->time_in,
            "time_out"=> $currentTime,
        ]);
        Session()->flash("success", "Record updated successfully");
        return redirect()->route('patient-record.index');
    }

    public function destroy(PatientRecord $patientRecord)
    {
        $patientRecord->delete();
        Session()->flash("success", "Record deleted successfully");
        return redirect()->route('patient-record.index');
    }

    public function trash(){

        $patientRecords = PatientRecord::onlyTrashed()->paginate(10);
        $result = [];
        foreach($patientRecords as $patientRecord){
            $p = Patient::where("patient_id",$patientRecord->patient_id)->first();
            $s = Staff::where("staff_id",$patientRecord->staff_id)->first();

            $temp = ["patient_name"=>$p->firstname,
                "staff_name"=>$s->firstname,
                "result"=>$patientRecord->result,
                "time_out"=>$patientRecord->time_out,
                "time_in"=>$patientRecord->time_in,
                "sickness"=>$patientRecord->sickness,
                "patient_id"=>$patientRecord->patient_id,
                "staff_id"=>$patientRecord->staff_id,
                "patient_record_id"=>$patientRecord->patient_record_id,];
            array_push($result,$temp);
        }
        Session()->flash("trash","Trash");
        return View("backend.patients.patient_records.patient_records")->with("result", $result)->with("patientRecords",$patientRecords);
    }

    public function restore(string $id){

        PatientRecord::where("patient_record_id","=",$id)->restore();
        Session()->flash("action", "Record restored successfully");
        return redirect()->back();
    }

    public function delete(string $id){

        PatientRecord::where("patient_record_id","=",$id)->forceDelete();
        Session()->flash("action", "Record deleted successfully");
        return redirect()->back();

    }

}
