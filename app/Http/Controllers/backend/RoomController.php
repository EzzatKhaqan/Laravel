<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{

    public function index()
    {
        $rooms = Room::withoutTrashed()->get();

        if(Session("edit") || Session("trash")){
            Session()->forget("edit");
            Session()->forget("trash");
        }
        return View("backend.room.index",compact("rooms"));
    }

    public function create()
    {
        if(Session("edit") || Session("trash")){
            Session()->forget("edit");
            Session()->forget("trash");
        }
        return View("backend.room.index");
    }

    public function store(Request $request)
    {
        $cred = $request->validate([
            "room_number"=>"required|integer",
            "status"=>"required",
            "capacity"=>"required|integer",
        ]);

        Room::create($cred);
        Session()->flash("success","Room Added successfully");
        return redirect()->back();
    }

    public function show(Room $room)
    {
        //
    }

    public function edit(Room $room)
    {
        Session()->flash("edit");
        return View("backend.room.index",compact("room"));
    }

    public function update(Request $request, Room $room)
    {
        $cred = $request->validate([
            "room_number"=>"required|integer",
            "status"=>"required",
            "capacity"=>"required|integer",
        ]);

        $room->update($cred);
        Session()->flash("success","Room Updated successfully");
        return redirect()->route("room.index");
    }

    public function destroy(Room $room)
    {
        $room->delete();
        Session()->flash("success","Room Deleted Successfully");
        return redirect()->route("room.index");
    }

    public function trash() {
        $rooms = Room::onlyTrashed()->get();

        Session()->flash("trash");
        return View("backend.room.index",compact("rooms"));
    }

    public function restore(string $id) {
        Room::onlyTrashed()->find($id)->restore();
        Session()->flash("success","Room Restored Successfully");
        return redirect()->back();
    }

    public function delete(string $id) {
        Room::onlyTrashed()->find($id)->forceDelete();
        Session()->flash("success","Room Deleted Permanently");
        return redirect()->back();
    }
}
