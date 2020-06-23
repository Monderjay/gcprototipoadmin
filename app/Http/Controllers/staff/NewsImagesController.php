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


    public function store(Request $request, $id)
    {
        //
        if($request->hasFile('featured-image')) {

            $imageNew = new NewsImage();
            $imageMedium = new NewsImage();
            $imageSmall = new NewsImage();

            $file = $request->file('featured-image');
            $originalName = str_replace(' ','',pathinfo($file->getClientOriginalName(),PATHINFO_FILENAME));
            $fileName = uniqid() . '-'.$originalName; //Renombrar la Imagen


            $fileNameLarge = $fileName.'.webp';
            $fileNameMedium = $fileName.'_640x360.webp';
            $fileNameSmall = $fileName.'_320x160.webp';

            $path = public_path('images/news_images/'. $fileNameLarge);
            $pathMedium = public_path('images/news_images_medium/'. $fileNameMedium);
            $pathSmall = public_path('images/news_images_small/'. $fileNameSmall);

            $imageSave = Image::make($file->getRealPath())
                ->resize(1280, 720)->sharpen();

            $imageMediumSave = Image::make($file->getRealPath())
                ->resize(640, 360)->sharpen();

            $imageSmallSave = Image::make($file->getRealPath())
                ->resize(320, 160)->sharpen();


            //Crear 1 registro en la tabla de users
            if ($imageSave->save($path,72,'webp') && $imageMediumSave->save($pathMedium,72,'webp') && $imageSmallSave->save($pathSmall,72,'webp')) {

                $newsImages = NewsImage::where('news_id', $id)->get(); //Imagenes de la noticia


                $images = File::files(public_path() . '/images/news_images'); //Imagenes guardadas

                $fullPath = public_path() . '/images/news_images/';

                $imagesSmall = File::files(public_path() . '/images/news_images_small'); //Imagenes small guardadas

                $fullPathSmall = public_path() . '/images/news_images_small/';

                $imagesMedium = File::files(public_path() . '/images/news_images_medium'); //Imagenes medium guardadas

                $fullPathMedium = public_path() . '/images/news_images_medium/';

                foreach ($images as $image) {
                    foreach ($newsImages as $img) {
                        if ($img->image == pathinfo($image)['basename'] && $img->featured) {
                            $deleted = File::delete($fullPath . $img->image);
                        } else {
                            $deleted = true;
                        }
                        if ($img->featured){
                            NewsImage::destroy($img->id);
                        }
                    }
                }

                foreach ($imagesSmall as $image) {
                    foreach ($newsImages as $img) {
                        if ($img->size == "small" && $img->image == pathinfo($image)['basename']){
                            $deletedSmall = File::delete($fullPathSmall . $img->image);
                            NewsImage::destroy($img->id);
                        }
                        else {
                            $deletedSmall = true;
                        }
                    }
                }

                foreach ($imagesMedium as $image) {
                    foreach ($newsImages as $img) {
                        if ($img->size == "medium" && $img->image == pathinfo($image)['basename']) {
                            $deletedMedium = File::delete($fullPathMedium . $img->image);
                            NewsImage::destroy($img->id);
                        } else {
                            $deletedMedium = true;
                        }
                    }
                }

                $imageNew->image = $fileNameLarge;
                $imageNew->news_id = $id;
                $imageNew->size = "large";
                NewsImage::where('news_id', $id)->update([
                    'featured' => false
                ]);
                $imageNew->featured = true;
                $imageNew->save();

                $imageMedium->image = $fileNameMedium;
                $imageMedium->size = "medium";
                $imageMedium->news_id = $id;
                $imageMedium->save();

                $imageSmall->image = $fileNameSmall;
                $imageSmall->size = "small";
                $imageSmall->news_id = $id;
                $imageSmall->save();


                if ($imageSmall && $imagesSmall && $imageNew && $deleted && $deletedMedium && $deletedSmall) {

                    $notification = "!La imagen  se ha reemplazado correctamente¡";
                    return back()->with(compact('notification'));
                }else{
                    $notificationFaill = "La imagen no se ha podido reemplazar :(";
                    return back()->with(compact('notificationFaill'));
                }

            }
        }

    }




    public function destroy($id)
    {
        //
        $image = NewsImage::find($id);
        $images = File::files(public_path() . '/images/news_images');
        $fullPath = public_path() . '/images/news_images/' . $image->image;

        if ($image->image != null) {
            $deleted = true;
            foreach ($images as $img) {

                if ($image->image == pathinfo($img)['basename']) {
                    $deleted = File::delete($fullPath);
                } else {
                    $deleted = true;
                }

            }


            if ($deleted) {
                //Eliminar el registro
                $image->delete();

                $notification = "!La imagen  se ha eliminado correctamente¡";
                return back()->with(compact('notification'));
            }else{
                $notificationFaill = "La imagen no se ha podido eliminar :(";
                return back()->with(compact('notificationFaill'));
            }

        }
    }


}
