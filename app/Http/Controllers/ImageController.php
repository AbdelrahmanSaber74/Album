<?php

namespace App\Http\Controllers;
use App\Models\image;
use App\trait\uploadImage;
use Illuminate\Http\Request;

class ImageController extends Controller
{

    use uploadImage;

    public function storeImg(request $request)
    {
        // $image = $request->file('photo')->getClientOriginalName();
        // $path = $request->file('photo')->storeAs('images' , $image , 'public');

        $image = $this->uploadImage($request , 'images');
        image::create([
        'name' =>$request->name ,
         'album_id' => $request->album_id ,
        'path' => $image ,
        ]);
        return redirect()->back()->with('Add' , 'تم اضافة الصورة بنجاح');
    }

}
