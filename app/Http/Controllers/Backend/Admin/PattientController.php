<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pattient;
use App\Traits\uploadImage;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PattientController extends Controller
{
       //traits
       use uploadImage;
       /**
        * Display a listing of the resource.
        */
       public function index(Request $request)
       {
           $pattients = Pattient::orderBy('created_at', 'DESC')
               ->paginate(20);
           return view('backend.admin.pattient.index', compact('pattients'));
       }

       /**
        * Show the form for creating a new resource.
        */
       public function create()
       {
           $pattient = new Pattient();
           return view('backend.admin.pattient.create', compact('pattient'));
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
                   'password' => Hash::make($request->input('identity')),
                ]);
               //upload image
               $data = $this->uploadImage($request, 'image', 'name', 'pattients', 'upload_image');

               $pattient = Pattient::create($data);


               DB::commit();
               return redirect()->route('pattient.index')->with('success', __("Operation accomplished successfully"));
           } catch (Exception $e) {
               DB::rollback();
               return redirect()->back()->with('error', "Add failed ");
           }
       }

       /**
        * Display the specified resource.
        */
       public function show(Pattient $pattient)
       {
           return view('backend.admin.pattient.show', compact('pattient'));
       }

       /**
        * Show the form for editing the specified resource.
        */
       public function edit ($id)
       {
           $pattient = Pattient::findOrFail($id);
           return view('backend.admin.pattient.edit', compact('pattient'));
       }

       /**
        * Update the specified resource in storage.
        */
       public function update(Request $request, $id)
       {
          $pattient = Pattient::findOrFail($id);

           $this->checkRequest($request);

           DB::beginTransaction();
           try {
               $old_image = $pattient->image;
               $data = $request->except('image');
               // Check img
               if ($request->hasFile('image')) {
                   $photo = $request->file('image');
                   //name this is pattient name
                   $name = Str::slug($request->input('name'));
                   $filename = $name . '.' . $photo->getClientOriginalExtension();
                   $data['image'] = $request->file('image')->storeAs('pattients', $filename, 'upload_image');
               }
               if ($old_image && isset($data['image'])) {
                   Storage::disk('upload_image')->delete($old_image);
               }
               $pattient->update($data);


              DB::commit();
               return redirect()->route('pattient.index')->with('success', __("Operation accomplished successfully"));
           } catch (Exception $e) {
               DB::rollback();
               return redirect()->back()->with('error', "Add failed ");
           }
       }

       /**
        * Remove the specified resource from storage.
        */
       public function destroy($id)
       {
        $pattient = Pattient::findOrFail($id);
           DB::beginTransaction();
           try {
               $this->deleteImage($pattient->image, 'upload_image');
               $pattient->delete();
               DB::commit();
               return redirect()->route('pattient.index')->with('success', __("Operation accomplished successfully"));
           } catch (Exception $e) {
               DB::rollback();
               return redirect()->back()->with('error', "Add failed ");
           }
       }

       public function UpdateStatus(Request $request, $id)
       {
        $pattient = Pattient::findOrFail($id);
           $request->validate([
               'status' => 'required|in:active,inactive',
           ]);
           $pattient->update([
               'status' => $request->input('status'),
           ]);
           return redirect()->route('pattient.index')->with('success', __("Operation accomplished successfully"));
       }

       public function UpdatePassword(Request $request, $id)
       {
        $pattient = Pattient::findOrFail($id);
           $password = $request->input('password');
           $request->validate([
               'password' => 'required|min:8',
               'current-password' => 'required|same:password',
           ]);

           $pattient->update([
               'password' => Hash::make($password),
           ]);
           return redirect()->route('pattient.index')->with('success', __("Operation accomplished successfully"));
       }

       protected function checkRequest(Request $request)
       {
           return $request->validate([
               'name' => 'required|string|min:3',
               'email' => 'required|string|email',
               'identity' => 'required|string|min:9',
               'phone' => 'nullable|string',
               'image' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:1000',
           ]);
       }
}
