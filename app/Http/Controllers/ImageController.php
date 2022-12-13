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

        $validated = $request->validate([
            'name' => 'required|max:255',
            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ] );

        image::create([
        'name' =>$request->name ,
        'album_id' => $request->album_id ,
        'path' => $image ,
        ]);

        return redirect()->back()->with('Add' , 'تم اضافة الصورة بنجاح');
    }

}
