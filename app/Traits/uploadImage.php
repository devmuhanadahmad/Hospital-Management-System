<?php
namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
trait uploadImage{
    public function uploadImage($request, $name, $nameInput, $foldername, $disk)
    {
        $data = $request->except($name);
        // Check img
        if (!$request->hasFile($name)) {
             $data['image']= '';
        }else{

            $photo = $request->file($name);
            //name this is classroom name
            $name = Str::slug($request->input($nameInput));
            $filename = $name . '.' . $photo->getClientOriginalExtension();
             $data['image']= $photo->storeAs($foldername, $filename, $disk);
        }

        return $data;
    }
    public function deleteImage( $name, $disk)
    {
        if($name){
            Storage::disk($disk)->delete($name);
        }
        return null;
    }
}
