<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ambulances;
use Illuminate\Http\Request;

class AmbulanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $ambulances = Ambulances::orderBy('created_at', 'DESC')
        ->paginate(20);
        return view('backend.admin.ambulances.index', compact('ambulances'));
    }

    /**
     * create a newly created resource in storage.
     */
    public function create()
    {
        $ambulance=new Ambulances();
        return view('backend.admin.ambulances.create',compact('ambulance'));
    }

    public function store(Request $request)
    {
        $request->merge([
            'status'=>'active',
        ]);
           $this->checkRequest($request);
           Ambulances::create($request->all());
           return redirect()->route('ambulance.index')->with('add', __("The storage  was completed successfully"));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $ambulance=Ambulances::findOrFail($id);
        return view('backend.admin.ambulances.edit', compact('ambulance'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $ambulance=Ambulances::findOrFail($id);
        $this->checkRequest($request);
           $ambulance->update($request->all());
           return redirect()->route('ambulance.index')->with('update', __("The modification process was completed successfully"));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $ambulances=Ambulances::findOrFail($id);
        $ambulances->delete();
        return redirect()->route('ambulance.index')->with('destroy', __("The deletion was completed successfully"));
    }

    public function UpdateStatus(Request $request, $id)
    {
        $ambulance=Ambulances::findOrFail($id);

        $request->validate([
            'status' => 'required|in:active,inactive',
        ]);
        $ambulance->update([
            'status' => $request->input('status'),
        ]);
        return redirect()->route('ambulance.index')->with('success', __("Operation accomplished successfully"));
    }

    protected function checkRequest(Request $request){
        return  $request->validate([
            'car_number' => 'required|string',
            'car_model' => 'required|string',
            'car_year_made' => 'required|date|before:today',
        ]);
    }
}
