<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\OverTime;
use App\Models\staff;
use Illuminate\Http\Request;

class OverTimeController extends Controller
{
    public function index()
    {

        $overtimes = Overtime::withoutTrashed()->paginate(10);
        $result = [];
        foreach ($overtimes as $overtime) {
            $s = Staff::where("staff_id","=",$overtime->staff_id)->first();
            $temp = ["firstname"=>$s->firstname,"lastname"=>$s->lastname,"overtime_date"=>$overtime->over_time_date,"hours"=>$overtime->hours,"id"=>$overtime->id];

            array_push($result, $temp);
        }

        if(Session()->has("edit") || Session()->has("trash")){
            Session()->forget("edit");
            Session()->forget("trash");
        }
        return View("backend.staff.schedule.overtime")->with("result",$result);

    }

    public function create()
    {
        $staffs = Staff::withoutTrashed()->paginate(10);
        return View("backend.staff.schedule.overtime")->with("staffs", $staffs);
    }

    public function store(Request $request)
    {
        $request->validate([
            "staff"=>'required',
            'overtime_hours'=>'required|max:12|min:0',
            'overtime_date'=>'required'
        ]);
        OverTime::create([
            "staff_id"=>$request->staff,
            "over_time_date"=>$request->overtime_date,
            "hours"=>$request->overtime_hours,
        ]);
        Session()->flash("success","Overtime added successfully");
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(OverTime $overTime)
    {
        //
    }

    public function edit(OverTime $overtime)
    {
        Session()->flash("edit");
        $staff = Staff::withoutTrashed()->where("staff_id","=",$overtime->staff_id)->first();
        $staffs = Staff::withoutTrashed()->get();

        return View("backend.staff.schedule.overtime")->with("overtime",$overtime)->with("staff",$staff)->with("staffs",$staffs);
    }

    public function update(Request $request, OverTime $overtime)
    {
        $request->validate([
            "staff"=>'required',
            'overtime_hours'=>'required|max:12|min:0',
            'overtime_date'=>'required'
        ]);
        $overtime->staff_id = $request->staff;
        $overtime->over_time_date = $request->overtime_date;
        $overtime->hours = $request->overtime_hours;
        $overtime->save();

        Session()->flash("edit","Overtime updated successfully");
        return redirect()->route('overtime.index');
    }

    public function destroy(OverTime $overtime)
    {
        $overtime->delete();
        Session()->flash("success","Overtime deleted successfully");
        return redirect()->back();
    }

    public function trash(){
        $overtimes = Overtime::onlyTrashed()->get();
        $result = [];
        foreach ($overtimes as $overtime) {
            $s = Staff::where("staff_id","=",$overtime->staff_id)->first();
            $temp = ["firstname"=>$s->firstname,"lastname"=>$s->lastname,"overtime_date"=>$overtime->over_time_date,"hours"=>$overtime->hours,"id"=>$overtime->id];

            array_push($result, $temp);
        }

        Session()->flash("trash");
        if(Session()->has("edit")){
            Session()->forget("edit");
        }
        return View("backend.staff.schedule.overtime")->with("result",$result);
    }

    public function restore(string $id){

        OverTime::onlyTrashed()->find($id)->restore();
        Session()->flash("trash","Overtime restored successfully");
        return redirect()->back();
    }

    public function delete(string $id){

        OverTime::onlyTrashed()->find($id)->forceDelete();
        Session()->flash("trash","Overtime deleted successfully");
        return redirect()->back();
    }

}
