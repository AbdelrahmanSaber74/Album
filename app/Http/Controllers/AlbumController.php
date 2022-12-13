<?php

namespace App\Http\Controllers;
use App\Models\Album;
use App\Models\image;
use Illuminate\Http\Request;
use App\DataTable\AlbumDataTable;
class AlbumController extends Controller
{

    public function index () {

        $allImage = image::all()->count();

        $album_1 = image::where('album_id' , 1)->count();
        $album_2 = image::where('album_id' , 2)->count();
        $album_3 = image::where('album_id' , 3)->count();
        $album_4 = image::where('album_id' , 4)->count();


            $percent_1 = number_format( ($album_1 / $allImage) * 100 , 2 )   ;
            $percent_2 = number_format( ($album_2 / $allImage) * 100 , 2 )   ;
            $percent_3 = number_format( ($album_3 / $allImage) * 100 , 2 )   ;
            $percent_4 = number_format( ($album_4 / $allImage) * 100 , 2 )   ;
    
            
            $chartjs = app()->chartjs
            ->name('pieChartTest')
            ->type('pie')
            ->size(['width' => 500, 'height' => 300])
            ->labels(['Books' , 'Study' , 'Cars' , 'Empty'])
            ->datasets([
                [
                    'backgroundColor' => ['#f94f6c', '#049868' ,'#f76c2f' ,'#0161e8' ],
                    'hoverBackgroundColor' => ['#f94f6c', '#049868' , '#f76c2f' , '#0161e8'],
                    'data' => [$percent_1 , $percent_2 ,$percent_3 ,$percent_4 ]

                ]
            ])
            ->options([]);
    

        
        $albums = album::all();

        return view('index' , compact('albums' , 'chartjs'));

 }

    public function imagesAlbum($id)
    {
        $album = album::find($id) ;
        $images = image::where('album_id' , $id)->get();
        return view('images_album' , compact('album' , 'images'));
    }

  
    public function store(request $request){

        $validated = $request->validate([
            'name' => 'required|max:50',
        ], [
            'name.required' =>  'يرجي اضافة اسم الاليوم' ,
            'name.max' =>  'اسم الالبوم تعدي العدد المسوح' ,
        ]);
    

        Album::create([
            'name' => $request->name ,
        ]) ;
            return redirect()->back()->with('Add' , 'تم اضافة الالبوم بنجاح');
    }

    public function update(request $request)
    {



        $id = $request->pro_id;
        $album = Album::find($id);


        $validated = $request->validate([
            'name' => 'required|max:255',
        ]);

        $album->update([
            'name' => $request->name,
        ]);

        return redirect()->back()->with('updata' , 'تم تعديل الالبوم بنجاح');

    }


    public function destory(request $request)
    {
        $id = $request->pro_id;
        album::find($id)->delete();
        return redirect()->back()->with('delete' , 'تم حذف الالبوم بنجاح');

    }

    public function transfer(Request $request){

    $pro_id = $request->pro_id ;
    $album_transfer_id = $request->album_transfer_id ;
    $imgs = image::where('album_id' , $pro_id)->get();

    foreach ($imgs as $img ) {
        $img->update([
            'album_id' => $album_transfer_id ,
        ]);
    }

   return redirect()->back()->with('transfer' , 'تم نقل الالبوم بنجاح');

    }
        

 
}
    
