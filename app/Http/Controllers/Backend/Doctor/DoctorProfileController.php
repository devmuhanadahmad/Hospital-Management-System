<?php

namespace App\Http\Controllers\Backend\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
class DoctorProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::guard('doctor')->user();
        return view('backend.doctor.profile.edit',compact('user'));
    }

    public function update(Request $request)
    {
        $user = $request->user();
        $old_image = $user->profile->image;
        $data = $request->except('image');

        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'birthday' => ['nullable', 'date', 'before:today'],
            'gender' => ['in:male,female'],
        ]);


        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name = Str::random(10);
            $filename = $name . '.' . $file->getClientOriginalExtension();
            $path = $request->file('image')->storeAs('doctorProfiles', $filename, 'upload_image');

            $data['image'] = $path;
        }
        if ($old_image && isset($data['image'])) {
            Storage::disk('upload_image')->delete($old_image);
        }

        $user->profile->fill($data)->save();

        return redirect()->route('doctor.profile.edit')
            ->with('success', 'Profile updated!');

    }
}
