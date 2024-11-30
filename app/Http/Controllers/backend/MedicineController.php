<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MedicineRequest;
use App\Models\Medicine;

class MedicineController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {

        $medicines = Medicine::withoutTrashed()->paginate(10);
        if(Session()->has("edit") || Session()->has("trash")){
            Session()->forget("edit");
            Session()->forget("trash");
        }
        return View("backend.medicine.medicine")->with("medicines",$medicines);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        return View("backend.medicine.medicine");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MedicineRequest $request) {
        $temp = $request->validated();

        Medicine::create($temp);
        Session()->flash("success","Drug Added Successfully");
        return redirect()->back();

    }

    /**
     * Display the specified resource.
     */
    public function show(Medicine $medicine) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Medicine $medicine) {


        Session()->flash("edit");
        return View("backend.medicine.medicine")->with("medicine",$medicine);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MedicineRequest $request, Medicine $medicine) {

        $request->validated();

        $medicine->medicine_name = $request->medicine_name;
        $medicine->desc = $request->description;
        $medicine->unt_price = $request->unt_price;
        $medicine->qnt = $request->qnt;
        $medicine->save();

        Session()->flash("updated","Item Updated Successfully");
        return redirect()->route("medicine.index");


    }

    public function destroy(Medicine $medicine) {

        $medicine->delete();
        return redirect()->back();
    }

    public function trash() {

        $medicines = Medicine::onlyTrashed()->paginate(10);
        if(Session()->has("edit")){
            Session()->forget("edit");
        }
        Session()->flash("trash");
        return View("backend.medicine.medicine")->with("medicines",$medicines);
    }

    public function restore(string $id) {
        Medicine::onlyTrashed()->find($id)->restore();
        return redirect()->back();

    }

    public function delete(string $id) {

        Medicine::onlyTrashed()->find($id)->forceDelete();
        return redirect()->back();

    }


}
