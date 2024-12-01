<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Patient;
use App\Models\PatientTreatment;
use App\Models\staff;
use App\Models\Treatment;
use Illuminate\Http\Request;

class AppointmentController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {

        $appointments = Appointment::withoutTrashed()->paginate(10);

        $viewBag = [];
        foreach ($appointments as $ap) {
            $p = Patient::where("patient_id", $ap->patient_id)->first();
            $s = Staff::where("staff_id", $ap->staff_id)->first();
            $temp = ["patient_name" => $p->firstname, "staff_name" => $s->firstname, "id" => $ap->id, "appointment_date" => $ap->appointment_date, "appointment_time" => $ap->appointment_time];
            array_push($viewBag, $temp);
        }
        if (Session("edit") || Session("trash")) {
            Session()->forget("edit");
            Session()->forget("trash");
        }

        return View("backend.appointment.index", compact("viewBag", "appointments"));
    }

    public function create() {
        $patients = Patient::withoutTrashed()->get();
        $staffs = Staff::withoutTrashed()->get();

        if (Session("edit") || Session("trash")) {
            Session()->forget("edit");
            Session()->forget("trash");
        }
        return View("backend.appointment.index", compact("patients", "staffs"));
    }


    public function store(Request $request) {
        $cred = $request->validate(['patient_id' => "required|numeric", 'staff_id' => "required|numeric", "appointment_date" => "required|date", 'appointment_time' => 'required',]);

        Appointment::create($cred);
        Session()->flash("success", "Appointment Added Successfully");
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Appointment $appointment) {
        //
    }

    public function edit(Appointment $appointment) {
        $appointments = Appointment::withoutTrashed()->paginate(10);

        $p = Patient::where("patient_id", $appointment->patient_id)->first();
        $s = Staff::where("staff_id", $appointment->staff_id)->first();
        $viewBag = ["patient_id"=>$appointment->patient_id,"patient_name" => $p->firstname,"staff_id"=>$appointment->staff_id ,"staff_name" => $s->firstname, "id" => $appointment->id, "appointment_date" => $appointment->appointment_date, "appointment_time" => $appointment->appointment_time];
        $patients = Patient::withoutTrashed()->get();
        $staffs = Staff::withoutTrashed()->get();
        if (Session("edit") || Session("trash")) {
            Session()->forget("edit");
            Session()->forget("trash");
        }
        Session()->flash("edit");
        return View("backend.appointment.index", compact("viewBag", "appointments"),compact("patients","staffs"));
    }

    public function update(Request $request, Appointment $appointment) {
        $cred = $request->validate(['patient_id' => "required|numeric", 'staff_id' => "required|numeric", "appointment_date" => "required|date", 'appointment_time' => 'required',]);

        $appointment->update($cred);
        Session()->flash("success", "Appointment Updated Successfully");
        return redirect()->route('appointment.index');
    }

    public function destroy(Appointment $appointment) {
        $appointment->delete();
        Session()->flash("success", "Appointment Deleted Successfully");
        return redirect()->back();
    }

    public function trash() {
        $appointments = Appointment::onlyTrashed()->paginate(10);

        $viewBag = [];
        foreach ($appointments as $ap) {
            $p = Patient::where("patient_id", $ap->patient_id)->first();
            $s = Staff::where("staff_id", $ap->staff_id)->first();
            $temp = ["patient_name" => $p->firstname, "staff_name" => $s->firstname, "id" => $ap->id, "appointment_date" => $ap->appointment_date, "appointment_time" => $ap->appointment_time];
            array_push($viewBag, $temp);
        }
        if (Session("edit") || Session("trash")) {
            Session()->forget("edit");
            Session()->forget("trash");
        }

        Session()->flash("trash");
        return View("backend.appointment.index", compact("viewBag", "appointments"));
    }

    public function restore(string $id) {
        Appointment::onlyTrashed()->find($id)->restore();
        Session()->flash("success", "Appointment Restored Successfully");
        return redirect()->back();
    }

    public function delete(string $id) {
        Appointment::onlyTrashed()->find($id)->forceDelete();
        Session()->flash("success", "Appointment Deleted Successfully");
        return redirect()->back();
    }
}
