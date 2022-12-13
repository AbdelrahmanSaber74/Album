<?php 

namespace App\trait ;
use Illuminate\Http\Request;

trait uploadImage {


    public function uploadImage (request $request , $folderName) {

      $image = $request->file('photo')->getClientOriginalName();
      $path = $request->file('photo')->storeAs('images' , $image , 'public');

        return $image;

    }
}

?>