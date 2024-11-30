<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\PatientTest;
use App\Models\Staff;
use App\Models\Test;
use Illuminate\Http\Request;

class PatientTestController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {


        $patientTest = PatientTest::withoutTrashed()->paginate(10);
        $viewBag = [];
        foreach($patientTest as $pt) {

            $p = Patient::find($pt->patient_id)->first();
            $s = Staff::find($pt->staff_id)->first();
            $t = Test::find($pt->test_id)->first();
            $temp = ["patient_name"=>$p->firstname,"staff_name"=>$s->firstname,"test_name"=>$t->test_name,
                "test_date"=>$pt->test_date,"test_result"=>$pt->test_result,"patient_test_id"=>$pt->patient_test_id];

            array_push($viewBag,$temp);
        }
        if(Session("edit") || Session("trash")){
            Session()->forget("edit");
            Session()->forget("trash");
        }

        return View("backend.patients.patient_test.index",compact("viewBag","patientTest"));

    }


    public function create() {
        $patients = Patient::withoutTrashed()->get();
        $staffs =  Staff::withoutTrashed()->get();
        $tests = Test::withoutTrashed()->get();

        return View("backend.patients.patient_test.index", compact("patients", "staffs"),compact("tests"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {


        $cred = $request->validate([
            'patient_id' => "required",
            'staff_id' => "required",
            'test_id' => "required",
            'test_date'=>'required',
            'test_result'=>'required'
        ]);

        PatientTest::create($cred);
        Session()->flash("success", "Patient Test Added Successfully");
        return redirect()->back();
    }

    public function show(PatientTest $patientTest) {
        //
    }

    public function edit(PatientTest $patient_test) {

        $patients = Patient::withoutTrashed()->get();
        $staffs = Staff::withoutTrashed()->get();
        $tests = Test::withoutTrashed()->get();
        $patientTest = PatientTest::withoutTrashed()->get();
        $patient = Patient::withoutTrashed()->find($patient_test->patient_id)->first();
        $staff = Staff::withoutTrashed()->find($patient_test->staff_id)->first();
        $test = Test::withoutTrashed()->find($patient_test->test_id)->first();
        $viewBag = ["patient_id"=>$patient_test->patient_id,"patient_name"=>$patient->firstname,"staff_id"=>$patient_test->staff_id,"staff_name"=>$staff->firstname,
            "test_name"=>$test->test_name,"test_date"=>$patient_test->test_date,
            "test_result"=>$patient_test->test_result,"patient_test_id"=>$patient_test->patient_test_id,"test_id"=>$patient_test->test_id];

        Session()->flash("edit", "Patient Test Updated Successfully");
        return View("backend.patients.patient_test.index",
            compact("viewBag"),compact("patients","staffs","tests"));
    }

    public function update(Request $request, PatientTest $patientTest) {

        $cred = $request->validate([
            'patient_id' => "required",
            'staff_id' => "required",
            'test_id' => "required",
            'test_date'=>'required',
            'test_result'=>'required'
        ]);

        $patientTest->update($cred);
        Session()->flash("success", "Patient Test Updated Successfully");
        return redirect()->route('patient-test.index');
    }


    public function destroy(PatientTest $patientTest) {
        $patientTest->delete();
        return redirect()->back();
    }

    public function trash() {
        $patientTest = PatientTest::onlyTrashed()->paginate(10);
        $viewBag = [];
        foreach($patientTest as $pt) {

            $p = Patient::find($pt->patient_id)->first();
            $s = Staff::find($pt->staff_id)->first();
            $t = Test::find($pt->test_id)->first();
            $temp = ["patient_name"=>$p->firstname,"staff_name"=>$s->firstname,"test_name"=>$t->test_name,
                "test_date"=>$pt->test_date,"test_result"=>$pt->test_result,"patient_test_id"=>$pt->patient_test_id];

            array_push($viewBag,$temp);
        }

        Session()->flash("trash");
        return View("backend.patients.patient_test.index",compact("viewBag","patientTest"));
    }

    public function restore(string $id) {
        PatientTest::onlyTrashed()->find($id)->restore();
        Session()->flash("success", "Patient Test Restore Successfully");
        return redirect()->back();
    }

    public function delete(string $id) {
        PatientTest::onlyTrashed()->find($id)->forceDelete();
        Session()->flash("success", "Patient Test Deleted Successfully");
        return redirect()->back();
    }



}
