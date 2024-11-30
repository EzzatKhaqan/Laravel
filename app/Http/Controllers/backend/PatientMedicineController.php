<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\PatientMedicineRequest;
use App\Models\Medicine;
use App\Models\Patient;
use App\Models\PatientMedicine;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PatientMedicineController extends Controller {

    public function index() {
        $result = [];
        $patients = PatientMedicine::withoutTrashed()->paginate(10);
        foreach ($patients as $pts) {
            $pt = Patient::withoutTrashed()->find($pts->patient_id)->first();
            $md = Medicine::withoutTrashed()->find($pts->medicine_id)->first();
            $temp = ["patient_name" => $pt->firstname,"medicine_name"=>$md->medicine_name,"qnt"=>$pts->qnt,"unt_price"=>$pts->unt_price,"total_price"=>$pts->total_price,"apply_date"=>$pts->apply_date,"patient_medicine_id"=>$pts->patient_medicine_id];
            array_push($result,$temp);
        }
        $pml = $patients;
        if(Session()->has("trash") || Session()->has("edit")){
            Session()->forget("trash");
            Session()->forget("edit");
        }
        return View("backend.patients.patient_medicine.index")->with("pml",$pml)->with("result",$result);
    }

    public function create() {
        $patients = Patient::withoutTrashed()->get();
        $medicines = Medicine::withoutTrashed()->get();
        if(Session()->has("edit")){
            Session()->forget("edit");
        }
        return View("backend.patients.patient_medicine.index")->with("patients", $patients)->with("medicines", $medicines);
    }

    public function store(PatientMedicineRequest $request) {
        $temp = $request->validated();
        PatientMedicine::create(['patient_id' => $temp['patient_id'], 'medicine_id' => $temp['medicine_id'], 'qnt' => $temp['qnt'], 'unt_price' => $temp['unt_price'], 'total_price' => $temp['total_price'], 'apply_date' => Carbon::now()->format('Y-m-d'),]);
        Session()->flash("success", "Patient Medicine Added Successfully");
        return redirect()->back();
    }

    public function show(PatientMedicine $patientMedicine) {
        //
    }

    public function edit(PatientMedicine $patientMedicine) {

        Session()->flash("edit");
        $p = Patient::withoutTrashed()->find($patientMedicine->patient_id)->first();
        $m = Medicine::withoutTrashed()->find($patientMedicine->medicine_id)->first();
        $patient = ["patient_name"=>$p->firstname,"medicine_name"=>$m->medicine_name];
        $patients = Patient::withoutTrashed()->get();
        $medicines = Medicine::withoutTrashed()->get();
        return View("backend.patients.patient_medicine.index")->with("patientMedicine", $patientMedicine)->with("patients",$patients)->with("patient", $patient)->with("medicines",$medicines);
    }

    public function update(PatientMedicineRequest $request, PatientMedicine $patientMedicine) {

        $temp = $request->validated();

        $pm = PatientMedicine::withoutTrashed()->find($patientMedicine->patient_medicine_id)->first();

        $pm->update([
            'patient_id' => $temp['patient_id'],
            'medicine_id' => $temp['medicine_id'],
            'qnt' => $temp['qnt'],
            'unt_price' => $temp['unt_price'],
            'total_price' => $temp['total_price'],
            'apply_date' => Carbon::now()->format('Y-m-d'),
        ]);
        Session()->flash("updated", "Patient Medicine Updated Successfully");
        if(Session()->has("edit")){
            Session()->forget("edit");
        }
        return redirect()->route('patient-medicine.index');
    }

    public function destroy(PatientMedicine $patientMedicine) {
        $patientMedicine->delete();

        Session()->flash("success", "Patient Medicine Deleted Successfully");
        return redirect()->back();
    }

    public function trash() {

        $result = [];
        $patients = PatientMedicine::onlyTrashed()->paginate(10);
        foreach ($patients as $pts) {
            $pt = Patient::withoutTrashed()->find($pts->patient_id)->first();
            $md = Medicine::withoutTrashed()->find($pts->medicine_id)->first();
            $temp = ["patient_name" => $pt->firstname,"medicine_name"=>$md->medicine_name,"qnt"=>$pts->qnt,"unt_price"=>$pts->unt_price,"total_price"=>$pts->total_price,"apply_date"=>$pts->apply_date,"patient_medicine_id"=>$pts->patient_medicine_id];
            array_push($result,$temp);
        }
        Session()->flash("trash");
        $pml = $patients;
        return View("backend.patients.patient_medicine.index")->with("pml",$pml)->with("result",$result);

    }

    public function restore(string $id) {
        PatientMedicine::onlyTrashed()->find($id)->restore();
        Session()->flash("success","Patient Medicine Restored Successfully");
        return redirect()->back();
    }

    public function delete(string $id) {
        PatientMedicine::onlyTrashed()->find($id)->forceDelete();
        Session()->flash("success","Patient Medicine Deleted Successfully");
        return redirect()->back();
    }
}
