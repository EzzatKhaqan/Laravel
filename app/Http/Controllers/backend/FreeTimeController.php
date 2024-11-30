<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\FreeTime;
use App\Models\staff;
use Illuminate\Http\Request;

class FreeTimeController extends Controller
{
    public function index()
    {

        $freetimes = FreeTime::withoutTrashed()->paginate(10);
        $result = [];
        foreach ($freetimes as $freetime) {
            $s = Staff::where("staff_id","=",$freetime->staff_id)->first();
            $temp = ["firstname"=>$s->firstname,"lastname"=>$s->lastname,"freetime_date"=>$freetime->over_time_date,"hours"=>$freetime->hours,"id"=>$freetime->id];

            array_push($result, $temp);
        }

        if(Session()->has("edit") || Session()->has("trash")){
            Session()->forget("edit");
            Session()->forget("trash");
        }
        return View("backend.staff.schedule.freetime")->with("result",$result);

    }

    public function create()
    {
        $staffs = Staff::withoutTrashed()->paginate(10);
        return View("backend.staff.schedule.freetime")->with("staffs", $staffs);
    }

    public function store(Request $request)
    {
        $request->validate([
            "staff"=>'required',
            'freetime_hours'=>'required|max:12|min:0',
            'freetime_date'=>'required'
        ]);
        FreeTime::create([
            "staff_id"=>$request->staff,
            "free_time_date"=>$request->freetime_date,
            "hours"=>$request->freetime_hours,
        ]);
        Session()->flash("success","Freetime added successfully");
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(FreeTime $freetime)
    {
        //
    }

    public function edit(FreeTime $freetime)
    {
        Session()->flash("edit");
        $staff = Staff::withoutTrashed()->where("staff_id","=",$freetime->staff_id)->first();
        $staffs = Staff::withoutTrashed()->get();

        return View("backend.staff.schedule.freetime")->with("freetime",$freetime)->with("staff",$staff)->with("staffs",$staffs);
    }

    public function update(Request $request, FreeTime $freetime)
    {
        $request->validate([
            "staff"=>'required',
            'freetime_hours'=>'required|max:12|min:0',
            'freetime_date'=>'required'
        ]);
        $freetime->staff_id = $request->staff;
        $freetime->free_time_date = $request->freetime_date;
        $freetime->hours = $request->freetime_hours;
        $freetime->save();

        Session()->flash("edit","Freetime updated successfully");
        return redirect()->route('freetime.index');
    }

    public function destroy(FreeTime $freetime)
    {
        $freetime->delete();
        Session()->flash("success","Freetime deleted successfully");
        return redirect()->back();
    }

    public function trash(){
        $freetimes = FreeTime::onlyTrashed()->get();
        $result = [];
        foreach ($freetimes as $freetime) {
            $s = Staff::where("staff_id","=",$freetime->staff_id)->first();
            $temp = ["firstname"=>$s->firstname,"lastname"=>$s->lastname,"freetime_date"=>$freetime->free_time_date,"hours"=>$freetime->hours,"id"=>$freetime->id];

            array_push($result, $temp);
        }

        Session()->flash("trash");
        if(Session()->has("edit")){
            Session()->forget("edit");
        }
        return View("backend.staff.schedule.freetime")->with("result",$result);
    }

    public function restore(string $id){

        FreeTime::onlyTrashed()->find($id)->restore();
        Session()->flash("trash","Freetime restored successfully");
        return redirect()->back();
    }

    public function delete(string $id){

        FreeTime::onlyTrashed()->find($id)->forceDelete();
        Session()->flash("trash","Freetime deleted successfully");
        return redirect()->back();
    }
}
