<?php

namespace App\Http\Controllers\Staff;
use App\Http\Controllers\Controller;
use App\News;
use App\NewsImage;
use App\User;
use Illuminate\Http\Request;
use File;

class LogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $totalDeleted = User::onlyTrashed()->count();
        $users = User::onlyTrashed()->orderBy('deleted_at','desc')->paginate(5);
        return view('logs.user-logs.index')->with(compact('users','totalDeleted'));
        //
    }

    public function showNews()
    {
        $totalDeleted = News::onlyTrashed()->count();
        $news = News::onlyTrashed()->orderBy('deleted_at','desc')->paginate(5);
        return view('logs.news-logs.index')->with(compact('news','totalDeleted'));
        //
    }

    public function restoreNews($id){
        $restore= News::withTrashed()
            ->where('id', $id)
            ->restore();
        if ($restore){
            $notification = "Noticia Restaurada Correctamente :D";
            return redirect('/staff/news')->with(compact('notification'));
        }else {
            $notificationFaill = "La noticia no se pudo Restaurar :(";
            return redirect('staff/news')->with(compact('notificationFaill'));
        }
    }

    public function restoreUser($id){
        $restore= User::withTrashed()
            ->where('id', $id)
            ->restore();
        if ($restore){
            $notification = "Usuario Restaurado Correctamente :D";
            return back()->with(compact('notification'));
        }else {
            $notificationFaill = "El Usuario no se pudo Restaurar :(";
            return back()->with(compact('notificationFaill'));
        }
    }



    public function deleteNews($id){
        $news = News::withTrashed()->where('id', $id);
        $newsImages = NewsImage::where('news_id',$id);

        //dd($news=$news->get()[0]);
        if ($news != null){
            $deleted = true;

            if ($news->get()[0]->images->count() > 0){
                $images = File::files(public_path() . '/images/news_images');

                foreach ($news->get()[0]->images as $image){
                    $fullPath = public_path() . '/images/news_images/' . $image->image;
                    if (substr($image->image,0,3)=="http"){
                        $image->image->delete();
                    }else{
                        foreach ($images as $img){
                            if ($image->image == pathinfo($img)['basename']) {
                                $deleted = File::delete($fullPath);
                            } else {
                                $deleted = true;
                            }
                        }
                    }
                }
                if ($deleted) {

                    $newsImages->delete();
                    $news->forceDelete();

                    $notification = "!La noticia se ha eliminado correctamente¡";
                    return back()->with(compact('notification'));
                }else{
                    $notificationFaill = "La noticia no se ha podido eliminar :(";
                    return back()->with(compact('notificationFaill'));
                }
            }else{
                if ($news->forceDelete()){
                    $notification = "!La noticia se ha eliminado correctamente¡";
                    return back()->with(compact('notification'));
                }else{
                    $notificationFaill = "La noticia no se ha podido eliminar :(";
                    return back()->with(compact('notificationFaill'));
                }

            }
        }else{
            $notificationFaill = "La noticia no existe";
            return back()->with(compact('notificationFaill'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
