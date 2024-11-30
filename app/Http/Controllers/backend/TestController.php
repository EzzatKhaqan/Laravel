<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Test;
use Illuminate\Http\Request;

class TestController extends Controller
{

    public function index()
    {

        $tests = Test::withoutTrashed()->paginate(10);

        if(Session()->has("edit") || Session()->has("trash")){
            Session()->forget("edit");
            Session()->forget("trash");
        }
        return View("backend.laboratory.index",compact("tests"));
    }

    public function create()
    {
        if(Session()->has("edit")){
            Session()->forget("edit");
        }
        return View("backend.laboratory.index");
    }

    public function store(Request $request)
    {
        $credintial = $request->validate([
            "test_name"=>"required|string",
            "desc"=>"required|string",
            "test_price"=>"required|numeric"
        ]);

        Test::create($credintial);

        Session()->flash("success","Test Added Successfully");
        return redirect()->back();
    }

    public function show(Test $latboratory)
    {
        //
    }

    public function edit(Test $test)
    {
        Session()->flash("edit");
        return View("backend.laboratory.index",compact("test"));
    }

    public function update(Request $request, Test $test)
    {

        $cred = $request->validate([
            'test_name'=>"required|string",
            'desc'=> "required|string",
            'test_price'=>"required|numeric"
        ]);
        $test->update($cred);
        Session()->flash("success","Test Updated Successfully");
        return redirect()->route("test.index");
    }

    public function destroy(Test $test)
    {
        $test->delete();
        Session()->flash("success","Test Deleted Successfully");
        return redirect()->back();
    }

    public function trash() {
        $tests = Test::onlyTrashed()->paginate(10);

        if(Session()->has("edit")){
            Session()->forget("edit");
        }
        Session()->flash("trash");
        return View("backend.laboratory.index",compact("tests"));
    }

    public function restore(string $id) {
        Test::onlyTrashed()->find($id)->restore();
        Session()->flash("success","Test Restored Successfully");
        return redirect()->back();
    }

    public function delete(string $id) {
        Test::onlyTrashed()->find($id)->forceDelete();
        Session()->flash("success","Test Deleted Successfully");
        return redirect()->back();
    }
}
