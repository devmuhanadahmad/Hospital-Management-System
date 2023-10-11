<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sections = Section::orderBy('created_at', 'DESC')
        ->paginate(20);
        return view('backend.admin.section.index', compact('sections'));
    }

    /**
     * create a newly created resource in storage.
     */
    public function create()
    {
        $section=new Section();
        return view('backend.admin.section.create',compact('section'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:3',
            'notes' => 'nullable|string',
        ]);
           Section::create($request->all());
           return redirect()->route('section.index')->with('add', __("The storage  was completed successfully"));
    }

    /**
     * Display the specified resource.
     */
    public function show(Section $section)
    {
        return view('backend.admin.section.show',compact('section'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Section $section)
    {
        return view('backend.admin.section.edit', compact('section'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Section $section)
    {
        $request->validate([
            'name' => 'required|string|min:3',
            'notes' => 'nullable|string',
        ]);
           $section->update($request->all());
           return redirect()->route('section.index')->with('update', __("The modification process was completed successfully"));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Section $section)
    {
        $section->delete();
        return redirect()->route('section.index')->with('destroy', __("The deletion was completed successfully"));
    }
}
