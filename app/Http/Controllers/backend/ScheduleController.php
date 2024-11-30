<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Models\staff;
use Illuminate\Http\Request;

class ScheduleController extends Controller {

    public function index() {
        $schedules = Schedule::withoutTrashed()->paginate(10);
        $result = [];

        $weekday = ["0" => "Saturday", "1" => "Sunday", "2" => "Monday", "3" => "Tuesday", "4" => "Wednesday", "5" => "Thursday", "6" => "Friday"];
        foreach ($schedules as $schedule) {
            $s = Staff::where("staff_id", "=", $schedule->staff_id)->first();
            $temp = ["firstname" => $s->firstname, "lastname" => $s->lastname, "weekday" => $weekday[$schedule->weekday], "start_time" => $schedule->start_time, "start_date" => $schedule->start_date, "end_time" => $schedule->end_time, "end_date" => $schedule->end_date, "schedule_id" => $schedule->schedule_id, "phone" => $s->phone];
            array_push($result, $temp);
        }


        if (Session()->has('add') || Session()->has('action') || Session()->has('trash')) {
            Session()->forget("add");
            Session()->forget("action");
            Session()->forget("trash");
        }
        return View("backend.staff.schedule.schedule")->with("result", $result);
    }

    public function create() {
        $staff = Staff::withoutTrashed()->paginate(100);
        Session()->flash('add');
        return View("backend.staff.schedule.schedule")->with("staff", $staff);
    }

    public function store(Request $request) {
        $request->validate(['staff' => 'required', 'weekday' => 'required', 'start_date' => 'required', 'start_time' => 'required', 'end_time' => 'required', 'end_date' => 'required']);

        Schedule::create(['staff_id' => $request->staff, 'weekday' => $request->weekday, 'start_time' => $request->start_time, 'start_date' => $request->start_date, 'end_time' => $request->end_time, 'end_date' => $request->end_date, "expired" => false]);

        Session()->flash('add');
        Session()->flash("success", "Schedule Added Successfully");
        return redirect()->back();

    }

    public function show(Schedule $schedule) {
        dd("Show");
    }

    public function edit(Schedule $schedule) {
        $staff = Staff::withoutTrashed()->get();

        $st = Staff::where("staff_id", "=", $schedule->staff_id)->first();
        return View("backend.staff.schedule.editSchedule", compact("st"))->with("schedule", $schedule)->with("staff", $staff);
    }

    public function update(Request $request, Schedule $schedule) {

        $schedule->staff_id = $request->staff;
        $schedule->weekday = $request->weekday;
        $schedule->start_time = $request->start_time;
        $schedule->start_date = $request->start_date;
        $schedule->end_time = $request->end_time;
        $schedule->end_date = $request->end_date;
        $schedule->save();

        Session()->flash("success", "Schedule updated successfully");
        return redirect()->back();
    }

    public function destroy(Schedule $schedule) {
        $schedule->delete();
        return redirect()->route('schedule.index');
    }

    public function trash() {
        $schedules = Schedule::onlyTrashed()->paginate(10);
        $result = [];
        $weekday = ["0" => "Saturday", "1" => "Sunday", "2" => "Monday", "3" => "Tuesday", "4" => "Wednesday", "5" => "Thursday", "6" => "Friday"];
        foreach ($schedules as $schedule) {
            $s = Staff::where("staff_id", "=", $schedule->staff_id)->first();
            $temp = ["firstname" => $s->firstname, "lastname" => $s->lastname, "weekday" => $weekday[$schedule->weekday], "start_time" => $schedule->start_time, "start_date" => $schedule->start_date, "end_time" => $schedule->end_time, "end_date" => $schedule->end_date, "schedule_id" => $schedule->schedule_id, "phone" => $s->phone];
            array_push($result, $temp);
        }

        Session()->flash("trash");

        return View("backend.staff.schedule.schedule")->with("result",$result)->with("schedules",$schedules);
    }

    public function restore(string $id) {
        Schedule::onlyTrashed()->where("schedule_id","=",$id)->restore();
        Session()->flash("action","Item Restored successfully");
        return redirect()->back();
    }

    public function delete(string $id) {
        Schedule::where("schedule_id","=",$id)->onlyTrashed()->forceDelete();
        Session()->flash("action","Item deleted successfully");
        return redirect()->back();
    }
}
