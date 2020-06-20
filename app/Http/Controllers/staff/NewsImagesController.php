<?php

namespace App\Http\Controllers\Staff;
use App\Http\Controllers\Controller;
use App\News;
use App\NewsImage;
use Illuminate\Http\Request;
use File;
use Intervention\Image\ImageManagerStatic as Image;

class NewsImagesController extends Controller
{

    public function index($id)
    {
        //
        $news = News::find($id);

        if ($news == null ){
            $news = News::onlyTrashed()
                ->where('id', $id)
                ->first();
            if ($news == null){
                return back();
            }else{
                $images = $news->images()->orderBy('featured','desc')->get();

                return view('news.news_images.index')->with(compact('images','news'));
            }
        }else{
            $images = $news->images()->orderBy('featured','desc')->get();

            return view('news.news_images.index')->with(compact('images','news','id'));
        }


    }

    public function create()
    {
        //
        return view('news.news_images.create');
    }


    public function store(Request $request, $id)
    {
        //
        if($request->hasFile('featured-image')) {

            $image = new NewsImage();
            $file = $request->file('featured-image');
            $originalName = pathinfo($file->getClientOriginalName(),PATHINFO_FILENAME);
            $fileName = uniqid() . '-'.$originalName.'.webp'; //Renombrar la Imagen
            $path = public_path('images/news_images/'. $fileName);

            $imageSave = Image::make($file->getRealPath())
                ->resize(1280, 720)->sharpen();

            //Crear 1 registro en la tabla de users
            if ($imageSave->save($path,72,'webp')) {
                $image->image = $fileName;
                $image->news_id = $id;
                NewsImage::where('news_id',$id)->update([
                    'featured' => false
                ]);
                $image->featured = true;

                if ($image->save()){
                    $notification = "!La imagen se cargado correctamente :D";
                    return back()->with(compact('notification'));
                }else{
                    $notificationFaill = "!La imagen no se cargado correctamente :C";
                    return back()->with(compact('notificationFaill'));
                }
            }

        }
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //

    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
        $image = NewsImage::find($id);

        if ($image->image != null) {

            if (substr($image->image, 0, 4) == "http") {
                $deleted = true;
            } else {
                $images = File::files(public_path() . '/images/news_images');

                $fullPath = public_path() . '/images/news_images/' . $image->image;
                foreach ($images as $key => $img) {
                    if ($image->image == pathinfo($img)['basename']) {
                        $deleted = File::delete($fullPath);
                    } else {
                        $deleted = true;
                    }
                }
            }
            //Eliminar el registro
            if ($deleted) {
                $image->delete();

                $notification = "!La imagen se ha eliminado correctamente¡";
                return back()->with(compact('notification'));
            }else{
                $notificationFaill = "La imagen no se ha podido eliminar :(";
                return back()->with(compact('notificationFaill'));
            }
        }
    }


    public  function imageFeatured($id, $image){
        NewsImage::where('news_id',$id)->update([
            'featured' => false
        ]);

        $image = NewsImage::find($image);
        $image->featured = true;
        if ($image->save()){
            return back();
        }
    }
}
