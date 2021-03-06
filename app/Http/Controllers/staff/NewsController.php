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
use Spatie\Sitemap\SitemapGenerator;

class NewsController extends Controller
{
    public function eliminar_tildes($cadena){
        //Codificamos la cadena en formato utf8 en caso de que nos de errores
        $cadena = str_replace(
            array("´", "'"),
            array('', ''),
            $cadena
        );

        //Ahora reemplazamos las letras
        $cadena = str_replace(
            array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
            array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
            $cadena
        );

        $cadena = str_replace(
            array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
            array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
            $cadena );

        $cadena = str_replace(
            array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
            array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
            $cadena );

        $cadena = str_replace(
            array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
            array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
            $cadena );

        $cadena = str_replace(
            array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
            array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
            $cadena );

        $cadena = str_replace(
            array('ñ', 'Ñ', 'ç', 'Ç'),
            array('n', 'N', 'c', 'C'),
            $cadena
        );

        $cadena = str_replace(
            array(' '),
            array('-'),
            $cadena
        );

        return $cadena;
    }

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
            $originalName = str_replace(' ','',pathinfo($file->getClientOriginalName(),PATHINFO_FILENAME));
            $fileName = uniqid() . '-'.$originalName.'.webp'; //Renombrar la Imagen
            $path = public_path('images/news_images/'. $fileName);

            $ext = explode('.',$file->getClientOriginalName());
            $ext=$ext[count($ext)-1];


            if ($ext == "jpg" || $ext == "png" || $ext == "jpeg"){
                $imageSave = Image::make($file->getRealPath())
                    ->resize(1280, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->sharpen();

                //Crear 1 registro en la tabla de users
                if ($imageSave->save($path,72,'webp')) {
                    $image->image = $fileName;
                    $image->news_id = null;
                    $image->save();
                    $name = auth()->user()->email;
                    session()->push($name, $image);
                    $CKEditorFuncNum = $request->input('CKEditorFuncNum');
                    $url = '/images/news_images/'.$fileName;
                    $msg = 'Image cargada correctamente'.$fileName;
                    $re = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

                    // Render HTML output
                    @header('Content-type: text/html; charset=utf-8');
                    echo $re;
                }
            }elseif ($ext == "gif"){
                $path = public_path().'/images/news_images';

                $moved = $file->move($path,$fileName);
                //dd($moved);
                //Crear 1 registro en la tabla de product_images
                if ($moved){
                    $image->image = $fileName;
                    $image->news_id = null;
                    $image->save();
                    $name = auth()->user()->email;
                    session()->push($name, $image);
                    $CKEditorFuncNum = $request->input('CKEditorFuncNum');
                    $url = '/images/news_images/'.$fileName;
                    $msg = 'Image cargada correctamente';
                    $re = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url')</script>";

                    // Render HTML output
                    @header('Content-type: text/html; charset=utf-8');
                    echo $re;
                }
            }else{
                $CKEditorFuncNum = $request->input('CKEditorFuncNum');
                $msg = 'Formato no valido';
                $re = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '', '$msg')</script>";
                // Render HTML output
                @header('Content-type: text/html; charset=utf-8');
                echo $re;
            }

        }
    }

    public function index()
    {
        $news = News::with('user')->orderBy('id','desc')->paginate(40);
        $totalNews = News::with('user')->count();
        return view('news.index')->with(compact('news','totalNews'));
    }

    public function create()
    {
        $now = Carbon::now();
        $date = $now->format('Y-m-d\TH:i');
        $categories = Category::all();
        $clasifications = Clasification::all();
        return view('news.create')->with(compact('categories','clasifications','date'));
    }

    public function store(Request $request)
    {

        $rules = [
            'title' => 'unique:news',

        ];

        $messages = [
            'title.unique' => 'El título ingresado ya existe.',

        ];

        $this->validate($request, $rules, $messages);


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

        $news->font = $request->input('font');

        $cadena = strtolower($this->eliminar_tildes($news->title));

        $news->slug = preg_replace("/[^a-zA-Z0-9\_\-]+/", "", $cadena);



        $news->user_id = auth()->user()->id;

        $news->save();

        $id = $news->id;

        if($request->hasFile('featured_image')) {

            $image = new NewsImage();
            $imageMedium = new NewsImage();
            $imageSmall = new NewsImage();

            $file = $request->file('featured_image');
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
            if ($imageSave->save($path,72,'webp')) {
                $image->image = $fileNameLarge;
                $image->size = "large";
                $image->news_id = $id;

                $imageMedium->size = "large";
                NewsImage::where('news_id',$id)->update([
                    'featured' => false
                ]);
                $image->featured = true;
            }


            if ($imageMediumSave->save($pathMedium,72,'webp')) {
                $imageMedium->image = $fileNameMedium;
                $imageMedium->size = "medium";
                $imageMedium->news_id = $id;
                $imageMedium->save();
            }

            if ($imageSmallSave->save($pathSmall,72,'webp')) {
                $imageSmall->image = $fileNameSmall;
                $imageSmall->news_id = $id;
                $imageSmall->size = "small";
                $imageSmall->save();
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
        //dd($clasificationSelected);

        foreach ($categories as $category){
            if ($category->name != $news->category->name){
                $categorySelected->push($category->name);
            }
        }

        //dd($news->calification);

        return view('news.edit')->with(compact('news','categories','clasifications','date','clasificationSelected','categorySelected'));
    }



    public function update(Request $request, $id)
    {
        $rules = [
            'title' => 'unique:news,title,' . $id,
        ];

        $messages = [
            'title.unique' => 'El título ingresado ya existe.',
        ];


        $this->validate($request, $rules, $messages);
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
        $news->font = $request->input('font');

        $cadena = strtolower($this->eliminar_tildes($news->title));

        $news->slug = preg_replace("/[^a-zA-Z0-9\_\-]+/", "", $cadena);


        if ($request->hasFile('featured_image')) {

            $image = NewsImage::where('news_id', $id)->where('featured', true)->first();
            $imageMedium = NewsImage::where('news_id', $id)->where('size', 'medium')->first();
            $imageSmall = NewsImage::where('news_id', $id)->where('size', 'small')->first();

            $file = $request->file('featured_image');
            $originalName = str_replace(' ','',pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
            $fileName = uniqid() . '-' . $originalName; //Renombrar la Imagen

            $fileNameLarge = $fileName . '.webp';
            $fileNameMedium = $fileName . '_640x360.webp';
            $fileNameSmall = $fileName . '_320x160.webp';

            $path = public_path('images/news_images/' . $fileNameLarge);
            $pathMedium = public_path('images/news_images_medium/' . $fileNameMedium);
            $pathSmall = public_path('images/news_images_small/' . $fileNameSmall);


            if ($image != null) {

                $images = File::files(public_path() . '/images/news_images');

                $fullPath = public_path() . '/images/news_images/' . $image->image;


                foreach ($images as $img) {

                    if ($image->image == pathinfo($img)['basename']) {
                        $deleted = File::delete($fullPath);
                    }
                }

                $imageSave = Image::make($file->getRealPath())
                    ->resize(1280, 720)->sharpen();

                //Crear 1 registro en la tabla de users
                if ($imageSave->save($path, 72, 'webp')) {

                    NewsImage::where('news_id', $id)->update([
                        'featured' => false
                    ]);

                    $image->featured = true;
                    $image->image = $fileNameLarge;
                    $image->size = "large";
                    $image->save();
                }
            }


            if ($imageMedium != null) {

                $images = File::files(public_path() . '/images/news_images_medium');
                $fullPath = public_path() . '/images/news_images_medium/' . $imageMedium->image;

                foreach ($images as $img) {

                    if ($imageMedium->image == pathinfo($img)['basename']) {
                        $deleted = File::delete($fullPath);
                    }
                }

            } else {
                $imageMedium = new NewsImage();
            }


            $imageMediumSave = Image::make($file->getRealPath())
                ->resize(640, 360)->sharpen();

            if ($imageMediumSave->save($pathMedium, 72, 'webp')) {
                $imageMedium->image = $fileNameMedium;
                $imageMedium->size = "medium";
                $imageMedium->news_id = $id;
                $imageMedium->save();
            }


            if ($imageSmall != null) {
                $images = File::files(public_path() . '/images/news_images_small');
                $fullPath = public_path() . '/images/news_images_small/' . $imageSmall->image;

                foreach ($images as $img) {

                    if ($imageSmall->image == pathinfo($img)['basename']) {

                        $deleted = File::delete($fullPath);
                    } else {
                        $deleted = true;
                    }
                }
            } else {
                $imageSmall = new NewsImage();
            }

            $imageSmallSave = Image::make($file->getRealPath())
                ->resize(320, 160)->sharpen();

            if ($imageSmallSave->save($pathSmall, 72, 'webp')) {
                $imageSmall->image = $fileNameSmall;
                $imageSmall->size = "small";
                $imageSmall->news_id = $id;
                $imageSmall->save();
            }
        }


        $emailAuthor = auth()->user()->email;
        if (session($emailAuthor)) {
            foreach (session($emailAuthor) as $item) {
                $images = NewsImage::find($item->id);
                $images->news_id = $news->id;
                $images->save();
            }
            Session::forget($emailAuthor);
        }


        if ($news->save() || $images) {
            $notification = "Noticia Modificada con Exito, Ahora puede Verificar sus Imagenes";
            return redirect('/staff/news')->with(compact('notification'));
        } else {
            $notificationFaill = "La Noticia no pudo Modificarse :(";
            return redirect('/staff/news')->with(compact('notificationFaill'));

        }
    }




    public function destroy($id)
    {
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
