<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Apointmenty;
use App\Models\ApointmentyDoctor;
use App\Models\Doctor;
use App\Models\Section;
use App\Traits\uploadImage;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DoctorController extends Controller
{
    //traits
    use uploadImage;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $doctors = Doctor::with(['section'])->orderBy('created_at', 'DESC')
            ->paginate(20);
        return view('backend.admin.doctor.index', compact('doctors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $doctor = new Doctor();
        $sections = Section::all();
        $apointmenties = Apointmenty::all();
        $checked = [];
        return view('backend.admin.doctor.create', compact('doctor', 'sections', 'apointmenties', 'checked'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $this->checkRequest($request);
        DB::beginTransaction();
        try {
            $request->merge([
                'status' => 'active',
                //'days' => implode(',', $request->days),
                'password' => $request->input('identity'),
            ]);
            //upload image
            $data = $this->uploadImage($request, 'image', 'name', 'doctors', 'upload_image');

            $doctor = Doctor::create($data);
            // foreach ($request->days as $k => $val) {
            //     DB::table('apointmenty_doctors')->insert([
            //         'doctor_id' => $doctor->id,
            //         'apointmenty_id' => $val
            //     ]);
            // }

            $doctor->apointmenty()->attach($request->days);

            DB::commit();
            return redirect()->route('doctor.index')->with('success', __("Operation accomplished successfully"));
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', "Add failed ");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Doctor $doctor)
    {
        return view('backend.admin.doctor.show', compact('doctor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Doctor $doctor)
    {
        $sections = Section::all();
        $apointmenties = Apointmenty::all();
        $checked = $doctor->apointmenty()->pluck('apointmenty_id')->toArray();

        return view('backend.admin.doctor.edit', compact('doctor', 'sections', 'apointmenties', 'checked'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Doctor $doctor)
    {
        $this->checkRequest($request);

        DB::beginTransaction();
        try {
            $old_image = $doctor->image;
            $data = $request->except('image');
            // Check img
            if ($request->hasFile('image')) {
                $photo = $request->file('image');
                //name this is doctor name
                $name = Str::slug($request->input('name'));
                $filename = $name . '.' . $photo->getClientOriginalExtension();
                $data['image'] = $request->file('image')->storeAs('image', $filename, 'upload_image');
            }
            if ($old_image && isset($data['image'])) {
                Storage::disk('image')->delete($old_image);
            }
            $doctor->update($data);

            $doctor->apointmenty()->sync($request->days);

            DB::commit();
            return redirect()->route('doctor.index')->with('success', __("Operation accomplished successfully"));
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', "Add failed ");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Doctor $doctor)
    {
        DB::beginTransaction();
        try {
            $this->deleteImage($doctor->image, 'upload_image');
            $doctor->apointmenty()->detach($doctor->id);
            $doctor->delete();
            DB::commit();
            return redirect()->route('doctor.index')->with('success', __("Operation accomplished successfully"));
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', "Add failed ");
        }
    }

    public function UpdateStatus(Request $request, Doctor $doctor)
    {
        $request->validate([
            'status' => 'required|in:active,inactive',
        ]);
        $doctor->update([
            'status' => $request->input('status'),
        ]);
        return redirect()->route('doctor.index')->with('success', __("Operation accomplished successfully"));
    }

    public function UpdatePassword(Request $request, Doctor $doctor)
    {
        $password = $request->input('password');
        $request->validate([
            'password' => 'required|min:8',
            'current-password' => 'required|same:password',
        ]);

        $doctor->update([
            'password' => Hash::make($password),
        ]);
        return redirect()->route('doctor.index')->with('success', __("Operation accomplished successfully"));
    }

    protected function checkRequest(Request $request)
    {
        return $request->validate([
            'section_id' => 'required|exists:sections,id',
            'name' => 'required|string|min:3',
            'email' => 'required|string|email',
            'identity' => 'required|string|min:9',
            'phone' => 'nullable|string',
            'days' => 'required|array',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:1000',
        ]);
    }
}

// $data = $request->except('image');
// // Check img
// if (!$request->hasFile('image')) {
//        $data['image']='';
//     } else {
//         $photo = $request->file('image');
//         //name this is classroom name
//         $name = Str::slug($request->input('name'));
//         $filename = $name . '.' . $photo->getClientOriginalExtension();
//         $data['image'] = $request->file('image')->storeAs('doctors', $filename, 'upload_image');
// }
