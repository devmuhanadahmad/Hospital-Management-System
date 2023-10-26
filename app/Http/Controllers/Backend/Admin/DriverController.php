<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ambulances;
use App\Models\Driver;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $drivers = Driver::with('ambulances')->orderBy('created_at', 'DESC')
        ->paginate(20);
       // dd($drivers);
        return view('backend.admin.driver.index', compact('drivers'));
    }

    /**
     * create a newly created resource in storage.
     */
    public function create()
    {
        $driver=new Driver();
        $ambulances=Ambulances::where('status','active')->get();
        return view('backend.admin.driver.create',compact('driver','ambulances'));
    }

    public function store(Request $request)
    {
        $request->merge([
            'status'=>'active',
        ]);
           $this->checkRequest($request);
           Driver::create($request->all());
           return redirect()->route('driver.index')->with('add', __("The storage  was completed successfully"));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $driver=Driver::findOrFail($id);
        $ambulances=Ambulances::where('status','active')->get();
        return view('backend.admin.driver.edit', compact('driver','ambulances'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $driver=Driver::findOrFail($id);
        $this->checkRequest($request);
           $driver->update($request->all());
           return redirect()->route('driver.index')->with('update', __("The modification process was completed successfully"));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $driver=Driver::findOrFail($id);
        $driver->delete();
        return redirect()->route('driver.index')->with('destroy', __("The deletion was completed successfully"));
    }

    public function UpdateStatus(Request $request, $id)
    {
        $driver=Driver::findOrFail($id);

        $request->validate([
            'status' => 'required|in:active,inactive',
        ]);
        $driver->update([
            'status' => $request->input('status'),
        ]);
        return redirect()->route('driver.index')->with('success', __("Operation accomplished successfully"));
    }

    protected function checkRequest(Request $request){
        return  $request->validate([
            'ambulance_id'=>'required|numeric|exists:ambulances,id',
            'name' => 'required|string:min:3',
            'phone' => 'required|string|min:10',
            'notes' => 'nullable|string',
        ]);
    }
}

