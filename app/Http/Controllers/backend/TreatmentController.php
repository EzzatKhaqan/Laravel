<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Treatment;
use Illuminate\Http\Request;

class TreatmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $treatments = Treatment::withoutTrashed()->paginate(10);
        if(Session("edit") || Session("trash")){
            Session()->forget("edit");
            Session()->forget("trash");
        }
        return View('backend.treatment.index', compact('treatments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(Session("edit") || Session("trash")){
            Session()->forget("edit");
            Session()->forget("trash");
        }
        return View("backend.treatment.index");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $cred = $request->validate([
            "treatment_name" => "required|string",
            "desc"=>"required|string",
            "price"=>"required|numeric",
        ]);

        Treatment::create($cred);
        Session()->flash("success","Treatment Added Successfully");
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Treatment $treatment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Treatment $treatment)
    {
        Session()->flash("edit");
        return View("backend.treatment.index",compact("treatment"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Treatment $treatment)
    {
        $cred = $request->validate([
            "treatment_name" => "required|string",
            "desc"=>"required|string",
            "price"=>"required|numeric",
        ]);
        $treatment->update($cred);
        Session()->flash("success","Treatment Updated Successfully");
        return redirect()->route('treatment.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Treatment $treatment)
    {
        $treatment->delete();
        Session()->flash("success","Treatment Deleted Successfully");
        return redirect()->back();
    }

    public function trash() {
        $treatments = Treatment::onlyTrashed()->paginate(10);
        Session()->flash("trash");
        return View("backend.treatment.index",compact("treatments"));
    }

    public function restore(string $id) {
        Treatment::where("id",$id)->restore();
        Session()->flash("success","Treatment Restored Successfully");
        return redirect()->back();

    }

    public function delete(string $id) {
        Treatment::where("id",$id)->forceDelete();
        Session()->flash("success","Treatment Deleted Successfully");
        return redirect()->back();
    }
}
