<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Admit;
use App\Models\Patient;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdmitController extends Controller
{

    public function index()
    {
        $viewBag = [];
        $admits = Admit::withoutTrashed()->get();

        foreach ($admits as $pa) {
            $p = Patient::where("patient_id",'=',$pa->patient_id)->first();

            $temp = ["patient_name"=>$p->firstname,"room_number"=>$pa->room_number,"in_date"=>$pa->in_date,"out_date"=>$pa->out_date,"status"=>$pa->status,"admit_id"=>$pa->admit_id];
            array_push($viewBag,$temp);
        }
        if(Session("edit") || Session("trash")){
            Session()->forget("edit");
            Session()->forget("trash");
        }
        return View("backend.patients.admit.index",compact('viewBag',"admits"));
    }

    public function create()
    {
        $patients = Patient::withoutTrashed()->get();
        $rooms = Room::withoutTrashed()->get();
        if(Session("edit") || Session("trash")){
            Session()->forget("edit");
            Session()->forget("trash");
        }
        return View("backend.patients.admit.index",compact("patients","rooms"));
    }

    public function store(Request $request)
    {
        $cred = $request->validate([
            "patient_id"=>"required",
            "room_number"=>"required"
        ]);


        $room = Room::where("room_number","=",$request->room_number)->first();

        if($room){
            if($room->status != "full"){
                Admit::create([
                    "patient_id" => $cred["patient_id"],
                    "room_number"=>$request->room_number,
                    "in_date"=>Carbon::now()->format('Y-m-d H:i:s'),
                    "status"=>"bed",
                ]);
                Session()->flash("success","Admit Added Successfully");

                return redirect()->back();
            }
            Session()->flash("error","Room has Not Enough Space!");
            return redirect()->back();
        }
        Session()->flash("error","Room Not Found!");
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Admit $admit)
    {
        //
    }

    public function edit(Admit $admit)
    {

        $patients = Patient::withoutTrashed()->get();
        $rooms = Room::withoutTrashed()->get();
        if(Session("trash")){
            Session()->forget("trash");
        }
        $patient = Patient::find($admit->patient_id)->first();

        Session()->flash("edit");
        return View("backend.patients.admit.index",compact("admit","patients"),compact("rooms","patient"));
    }

    public function update(Request $request, Admit $admit)
    {
        $cred = $request->validate([
            "patient_id"=>"required",
            "room_number"=>"required",
            "status"=>"required"
        ]);


        $room = Room::where("room_number","=",$request->room_number)->first();

        if($room){
            if($room->status != "full"){
                $admit->update([
                    "patient_id" => $cred["patient_id"],
                    "room_number"=>$request->room_number,
                    "in_date"=>Carbon::now()->format('Y-m-d H:i:s'),
                    "status"=>$cred["status"],
                ]);
                Session()->flash("success","Admit UpdatedS Successfully");
                return redirect()->route("admit.index");
            }
            Session()->flash("error","Room has Not Enough Space!");
            return redirect()->route("admit.index");
        }
        Session()->flash("error","Room Not Found!");
        return redirect()->route("admit.index");
    }

    public function destroy(Admit $admit)
    {
        $admit->delete();
        Session()->flash("success","Admit Deleted Successfully");
        return redirect()->back();
    }

    public function trash() {

        $viewBag = [];
        $admits = Admit::onlyTrashed()->get();

        foreach ($admits as $pa) {
            $p = Patient::where("patient_id",'=',$pa->patient_id)->first();

            $temp = ["patient_name"=>$p->firstname,"room_number"=>$pa->room_number,"in_date"=>$pa->in_date,"out_date"=>$pa->out_date,"status"=>$pa->status,"admit_id"=>$pa->admit_id];
            array_push($viewBag,$temp);
        }
        Session()->flash("trash");
        return View("backend.patients.admit.index",compact('viewBag',"admits"));

    }

    public function restore(string $id) {
        Admit::where("admit_id",'=',$id)->restore();
        Session()->flash("success","Admit Restored Successfully");
        return redirect()->back();
    }

    public function delete(string $id) {
        Admit::where("admit_id",$id)->forceDelete();
        Session()->flash("success","Admit Deleted Successfully");
        return redirect()->back();
    }
}
