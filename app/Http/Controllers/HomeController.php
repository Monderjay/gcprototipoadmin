<?php

namespace App\Http\Controllers;

use App\News;
use App\User;
use File;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $news = News::all();
        return view('home');
    }

    public function show($id){
        $user = User::find($id);
        if (auth()->user()->id == $id){
            return view('general.porfile')->with(compact('user'));
        }
        else{
            return back();
        }
    }

    public function showNews($category,$clasification,$id){
        $news = News::find($id);

        return view('general.news')->with(compact('news'));
    }

    public function update(Request $request, $id)
    {
        //
        $user = User::find($id);
        $user->username = $request->input('username');
        $user->name = $request->input('name');
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->birthdate = $request->input('birthdate');
        $user->gender = $request->input('gender');
        $user->email = $request->input('email');
        if ($request->input('password') != null){
            $user->password = bcrypt($request->input('password')) ;
        }
        $user->description = $request->input('description');

        $user->address->street = $request->input('street');
        $user->address->outdoor_number = $request->input('outdoor_number');
        $user->address->interior_number = $request->input('interior_number');
        $user->address->colony = $request->input('colony');
        $user->address->city = $request->input('city');
        $user->address->zip = $request->input('zip');
        $user->address->cellphone = $request->input('cellphone');
        $user->address->phone = $request->input('phone');


        if ($request->hasFile('cover_image')) {
            if ($user->cover_image != null){

                if (substr($user->porfile_image,0,4)=="http"){
                    $deleted = true;
                } else {
                    $images = File::files(public_path(). '/images/cover_images');
                    $fullPath = public_path() . '/images/cover_images/' . $user->cover_image;
                    foreach ($images as $image){
                        if ($user->cover_image == pathinfo($image)['basename']){
                            $deleted = File::delete($fullPath);
                        }else{
                            $deleted = true;
                        }
                    }
                    //Eliminar el registro
                    if ($deleted) {
                        //Guardar la imagen en nuestro Proyecto
                        $file = $request->file('cover_image');
                        $fileName = uniqid() . '-' . $file->getClientOriginalName(); //Renombrar la Imagen
                        $path = public_path('images/cover_images/'. $fileName);

                        $imageSave = Image::make($file->getRealPath())
                            ->resize(1280, null, function ($constraint) {
                                $constraint->aspectRatio();
                            })->sharpen();


                        //Crear 1 registro en la tabla de users
                        if ($imageSave->save($path,72)) {
                            $user->cover_image = $fileName;
                        }
                    }
                }
            }else{
                //Guardar la imagen en nuestro Proyecto
                $file = $request->file('cover_image');
                $fileName = uniqid() . '-' . $file->getClientOriginalName(); //Renombrar la Imagen
                $path = public_path('images/cover_images/'. $fileName);

                $imageSave = Image::make($file->getRealPath())
                    ->resize(1280, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->sharpen();


                //Crear 1 registro en la tabla de users
                if ($imageSave->save($path,72)) {
                    $user->cover_image = $fileName;
                }
            }
        }

        if ($request->hasFile('porfile_image')) {
            if ($user->porfile_image != null){

                if (substr($user->porfile_image,0,4)=="http"){
                    $deleted = true;
                } else {
                    $images = File::files(public_path(). '/images/porfile_images');
                    $fullPath = public_path() . '/images/porfile_images/' . $user->porfile_image;
                    foreach ($images as $image){
                        //dd(pathinfo($image)['filename']);
                        if ($user->porfile_image == pathinfo($image)['basename']){
                            $deleted = File::delete($fullPath);
                        }else{
                            $deleted = true;
                        }
                    }
                    //Eliminar el registro
                    if ($deleted) {
                        //Guardar la imagen en nuestro Proyecto
                        $file = $request->file('porfile_image');

                        $fileName = uniqid() . '-' . $file->getClientOriginalName(); //Renombrar la Imagen
                        $path = public_path('images/porfile_images/'. $fileName);

                        $imageSave = Image::make($file->getRealPath())
                            ->resize(1280, null, function ($constraint) {
                                $constraint->aspectRatio();
                            })->sharpen();


                        //Crear 1 registro en la tabla de users
                        if ($imageSave->save($path,72)) {
                            $user->porfile_image = $fileName;
                        }
                    }
                }
            }else{
                //Guardar la imagen en nuestro Proyecto


                $file = $request->file('porfile_image');
                $fileName = uniqid() . '-' . $file->getClientOriginalName(); //Renombrar la Imagen
                $path = public_path('images/porfile_images/'. $fileName);

                $imageSave = Image::make($file->getRealPath())
                    ->resize(1280, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->sharpen();


                //Crear 1 registro en la tabla de users
                if ($imageSave->save($path,72)) {
                    $user->porfile_image = $fileName;
                }
            }
        }

        if($user->save() && $user->address->save()){
            $notification = "!Cambios Guardados con exito¡";
            return back()->with(compact('notification'));
        }
    }
}
