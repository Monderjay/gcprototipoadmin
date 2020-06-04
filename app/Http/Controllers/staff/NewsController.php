<?php

namespace App\Http\Controllers\Staff;
use App\Http\Controllers\Controller;
use App\Category;
use App\Clasification;
use App\News;
use App\NewsImage;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Session;
use Intervention\Image\ImageManagerStatic as Image;
use File;
class NewsController extends Controller
{
    public function upload(Request $request)
    {
        if($request->hasFile('upload')) {
            $name = auth()->user()->email;

            if (session('$name')){
                return session('$name');
            }else{
                session('$name','images');
            }

            $image = new NewsImage();
            $file = $request->file('upload');
            $fileName = uniqid() . '-' . $file->getClientOriginalName(); //Renombrar la Imagen
            $path = public_path('images/news_images/'. $fileName);

            $imageSave = Image::make($file->getRealPath())
                ->resize(1280, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->sharpen();

            //Crear 1 registro en la tabla de users
            if ($imageSave->save($path,72)) {
                $image->image = $fileName;
                $image->news_id = null;
                $image->save();
                $name = auth()->user()->email;
                //session($name)->push($image);
                session()->push($name, $image);
                $CKEditorFuncNum = $request->input('CKEditorFuncNum');
                $url = '/images/news_images/'.$fileName;
                $msg = 'Image cargada correctamente'.$fileName;
                $re = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

                // Render HTML output
                @header('Content-type: text/html; charset=utf-8');
                echo $re;
            }

        }
    }

    public function index()
    {
        //
        $news = News::with('user')->orderBy('id','desc')->paginate(10);
        $totalNews = News::with('user')->count();
        return view('news.index')->with(compact('news','totalNews'));
    }

    public function create()
    {
        //
        $now = Carbon::now();
        $date = $now->format('Y-m-d\TH:i');
        $categories = Category::all();
        $clasifications = Clasification::all();
        return view('news.create')->with(compact('categories','clasifications','date'));
    }

    public function store(Request $request)
    {
        //
        $news = new News();
        $category = Category::where('name',$request->input('category'))->first();
        $clasification = Clasification::where('name',$request->input('clasification'))->first();

        if ($request->input('clasification') == "Noticias" || $request->input('clasification') == "Retro"){
            $news->calification = null;
            $news->about = $request->input('about');
            if ($request->input('featured')!=null){
                $news->featured = true;
            }else{
                $news->featured = false;
            }
        }else if($request->input('clasification') == "Reseñas"){
            $news->about = $request->input('about');
            $news->calification = $request->input('calification');

            if ($request->input('featured')!=null){
                $news->featured = true;
            }else{
                $news->featured = false;
            }

        }else{
            $news->calification = null;
            $news->featured = false;

        }


        $news->title = $request->input('title');
        $news->description = $request->input('description');

        $news->category_id= $category->id;
        $news->clasification_id =$clasification->id;

        $news->introduction = $request->input('introduction');


        $news->user_id = auth()->user()->id;

        $news->save();

        $id = $news->id;

        if($request->hasFile('featured_image')) {

            $image = new NewsImage();
            $file = $request->file('featured_image');
            $fileName = uniqid() . '-' . $file->getClientOriginalName(); //Renombrar la Imagen



            //dd($file->getClientOriginalExtension());
            if ($file->getClientOriginalExtension() != "gif"){
                $path = public_path('images/news_images/'. $fileName);
                $imageSave = Image::make($file->getRealPath())
                    ->resize(1280, 720)->sharpen();
                //Crear 1 registro en la tabla de users
                if ($imageSave->save($path,72)) {
                    $image->image = $fileName;
                    $image->news_id = $id;
                    NewsImage::where('news_id',$id)->update([
                        'featured' => false
                    ]);
                    $image->featured = true;
                }
            }else{
                $path = public_path().'/images/news_images';

                $moved = $file->move($path,$fileName);
                //dd($moved);
                //Crear 1 registro en la tabla de product_images
                if ($moved){
                    $image -> image = $fileName;
                    $image->news_id = $id;
                    NewsImage::where('news_id',$id)->update([
                        'featured' => false
                    ]);
                    $image->featured = true;
                }
            }


        }

        $emailAuthor = auth()->user()->email;
        if (session($emailAuthor)){
            foreach (session($emailAuthor) as $item) {
                $images = NewsImage::find($item->id);
                $images->news_id = $news->id;
                $images->save();
            }
            Session::forget($emailAuthor);
        }

        if ($news && $image->save() || $images && $image->save()){
            $notification = "Noticia Registrada Correctamente :D";
            return redirect('/staff/news')->with(compact('notification'));
        }else{
            $notificationFaill = "La noticia no pudo se guardada :(";
            return redirect('staff/news')->with(compact('notificationFaill'));
        }

    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
        $news = News::find($id);
        $date = date('Y-m-d\TH:i',strtotime($news->updated_at));
        $categories = Category::all();
        $clasifications = Clasification::all();
        $clasificationSelected = collect();
        $categorySelected = collect();
        foreach ($clasifications as $clasification){
            if ($clasification->name != $news->clasification->name){
                $clasificationSelected->push($clasification->name);
            }
        }

        foreach ($categories as $category){
            if ($category->name != $news->category->name){
                $categorySelected->push($category->name);
            }
        }

        return view('news.edit')->with(compact('news','categories','clasifications','date','clasificationSelected','categorySelected'));
    }


    public function update(Request $request, $id)
    {
        //
        $news = News::find($id);
        $category = Category::where('name', $request->input('category'))->first();
        $clasification = Clasification::where('name', $request->input('clasification'))->first();

        if ($request->input('clasification') == "Noticias" || $request->input('clasification') == "Retro") {
            $news->calification = null;
            $news->about = $request->input('about');
            if ($request->input('featured') != null) {
                $news->featured = true;
            } else {
                $news->featured = false;
            }
        } else if ($request->input('clasification') == "Reseñas") {
            $news->about = $request->input('about');
            if ($request->input('featured') != null) {
                $news->featured = true;
            } else {
                $news->featured = false;
            }
            $news->calification = $request->input('calification');
        } else {
            $news->featured = false;
            $news->calification = null;
        }

        if ($request->input('clasification') == "Reseñas") {
            $news->calification = $request->input('calification');
        } else {
            $news->calification = null;
        }

        $news->title = $request->input('title');
        $news->introduction = $request->input('introduction');
        $news->about = $request->input('about');
        $news->category_id = $category->id;
        $news->clasification_id = $clasification->id;
        $news->description = $request->input('description');

        if($request->hasFile('featured_image')) {

            $image = NewsImage::where('news_id',$id)->where('featured',true)->first();

            if ($image != null){

                if (substr($image,0,4)=="http"){
                    $deleted = true;
                } else {
                    $images = File::files(public_path(). '/images/news_images');
                    $fullPath = public_path() . '/images/news_images/' . $image;
                    foreach ($images as $img){
                        if ($image->name == pathinfo($img)['basename']){
                            $deleted = File::delete($fullPath);
                        }else{
                            $deleted = true;
                        }
                    }

                    if ($deleted) {
                        //Guardar la imagen en nuestro Proyecto
                        $file = $request->file('featured_image');
                        $fileName = uniqid() . '-' . $file->getClientOriginalName(); //Renombrar la Imagen
                        $path = public_path('images/news_images/'. $fileName);

                        $imageSave = Image::make($file->getRealPath())
                            ->resize(1280, null, function ($constraint) {
                                $constraint->aspectRatio();
                            })->sharpen();


                        //Crear 1 registro en la tabla de users
                        if ($imageSave->save($path,72)) {

                            NewsImage::where('news_id',$id)->update([
                                'featured' => false
                            ]);

                            $image->featured = true;
                            $image->image = $fileName;
                            $image->save();
                        }
                    }
                }
            }else{
                //Guardar la imagen en nuestro Proyecto
                $file = $request->file('featured_image');
                $fileName = uniqid() . '-' . $file->getClientOriginalName(); //Renombrar la Imagen
                $path = public_path('images/news_images/'. $fileName);

                $imageSave = Image::make($file->getRealPath())
                    ->resize(1280, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->sharpen();
                //->resize(1280,720)->fill();


                //Crear 1 registro en la tabla de users
                if ($imageSave->save($path,72)) {
                    $image = new NewsImage();
                    $image->image = $fileName;
                    $image->featured = true;
                    $image->news_id=$id;
                    $image->save();
                }
            }
        }

        $emailAuthor = auth()->user()->email;
        if (session($emailAuthor)){
            foreach (session($emailAuthor) as $item) {
                $images = NewsImage::find($item->id);
                $images->news_id = $news->id;
                $images->save();
            }
            Session::forget($emailAuthor);
        }

        if ($news->save() || $images){
            $notification ="Noticia Modificada con Exito, Ahora puede Verificar sus Imagenes";
            return redirect('/staff/news')->with(compact('notification'));
        }else{
            $notificationFaill ="La Noticia no pudo Modificarse :(";
            return redirect('/staff/news')->with(compact('notificationFaill'));

        }
    }


    public function destroy($id)
    {
        //
        $news = News::find($id);
        if ($news->delete()){
            $notification = "!La noticia se ha eliminado correctamente¡";
            return back()->with(compact('notification'));
        }else{
            $notificationFaill = "La noticia no se ha podido eliminar :(";
            return back()->with(compact('notificationFaill'));
        }
    }
}
