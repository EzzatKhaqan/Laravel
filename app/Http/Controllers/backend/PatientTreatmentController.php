<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\PatientTreatment;
use App\Models\staff;
use App\Models\Treatment;
use Illuminate\Http\Request;

class PatientTreatmentController extends Controller
{

    public function index()
    {
        $patientTreatment = PatientTreatment::withoutTrashed()->paginate(10);

        $viewBag = [];
        foreach($patientTreatment as $pt) {
            $p = Patient::where("patient_id",$pt->patient_id)->first();
            $s = Staff::where("staff_id",$pt->staff_id)->first();
            $t = Treatment::where("id",$pt->treatment_id)->first();
            $temp = ["patient_name"=>$p->firstname,"staff_name"=>$s->firstname,"treatment_name"=>$t->treatment_name,
                "treatment_date"=>$pt->treatment_date,"treatment_result"=>$pt->treatment_result,"id"=>$pt->id];

            array_push($viewBag,$temp);
        }
        if(Session("edit") || Session("trash")){
            Session()->forget("edit");
            Session()->forget("trash");
        }

        return View("backend.patients.patient_treatment.index",compact("viewBag","patientTreatment"));
    }

    public function create()
    {
        $patients = Patient::withoutTrashed()->get();
        $staffs =  Staff::withoutTrashed()->get();
        $treatments = Treatment::withoutTrashed()->get();

        if(Session("edit") || Session("trash")){
            Session()->forget("edit");
            Session()->forget("trash");
        }
        return View("backend.patients.patient_treatment.index", compact("patients", "staffs"),compact("treatments"));
    }

    public function store(Request $request)
    {

        $cred = $request->validate([
            'patient_id' => "required",
            'staff_id' => "required",
            'treatment_id' => "required",
            'treatment_date'=>'required',
        ]);

        PatientTreatment::create($cred);
        Session()->flash("success", "Patient Treatment Added Successfully");
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(PatientTreatment $patientTreatment)
    {
        //
    }

    public function edit(PatientTreatment $patientTreatment)
    {
        $patients = Patient::withoutTrashed()->get();
        $staffs = Staff::withoutTrashed()->get();
        $treatments = Treatment::withoutTrashed()->get();
//        $patientTreatments = PatientTreatment::withoutTrashed()->get();
        $patient = Patient::withoutTrashed()->where("patient_id",$patientTreatment->patient_id)->first();
        $staff = Staff::withoutTrashed()->where("staff_id",$patientTreatment->staff_id)->first();
        $treatment = Treatment::withoutTrashed()->where("id",$patientTreatment->treatment_id)->first();
        $viewBag = ["patient_id"=>$patientTreatment->patient_id,"patient_name"=>$patient->firstname,"staff_id"=>$patientTreatment->staff_id,"staff_name"=>$staff->firstname,
            "treatment_name"=>$treatment->treatment_name,"treatment_date"=>$patientTreatment->treatment_date,
            "treatment_result"=>$patientTreatment->treatment_result,"treatment_id"=>$patientTreatment->treatment_id,"id"=>$patientTreatment->id];

        Session()->flash("edit");
        return View("backend.patients.patient_treatment.index",
            compact("viewBag"),compact("patients","staffs","treatments"));
    }

    public function update(Request $request, PatientTreatment $patientTreatment)
    {
        $cred = $request->validate([
            'patient_id' => "required",
            'staff_id' => "required",
            'treatment_id' => "required",
            'treatment_date'=>'required',
            'treatment_result'=>'required'
        ]);

        $patientTreatment->update($cred);
        Session()->flash("success", "Patient Treatment Updated Successfully");
        return redirect()->route('patient-treatment.index');
    }

    public function destroy(PatientTreatment $patientTreatment)
    {
        $patientTreatment->delete();
        Session()->flash("success", "Patient Treatment Deleted Successfully");
        return redirect()->back();
    }

    public function trash() {
        $patientTreatment = PatientTreatment::onlyTrashed()->paginate(10);

        $viewBag = [];
        foreach($patientTreatment as $pt) {
            $p = Patient::where("patient_id",$pt->patient_id)->first();
            $s = Staff::where("staff_id",$pt->staff_id)->first();
            $t = Treatment::where("id",$pt->treatment_id)->first();
            $temp = ["patient_name"=>$p->firstname,"staff_name"=>$s->firstname,"treatment_name"=>$t->treatment_name,
                "treatment_date"=>$pt->treatment_date,"treatment_result"=>$pt->treatment_result,"id"=>$pt->id];

            array_push($viewBag,$temp);
        }
        Session()->flash("trash");
        return View("backend.patients.patient_treatment.index",compact("viewBag","patientTreatment"));
    }

    public function restore(string $id) {
        PatientTreatment::onlyTrashed()->find($id)->restore();
        Session()->flash("success","Patient Treatment Restored Successfully");
        return redirect()->back();
    }

    public function delete(string $id) {
        PatientTreatment::onlyTrashed()->find($id)->forceDelete();
        Session()->flash("success","Patient Treatment Restored Successfully");
        return redirect()->back();
    }
}
