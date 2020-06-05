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
        $rules = [
            'username' => 'required|unique:users',

            'name' => 'required|regex:/^[a-zA-ZÁ-ÿ]+$/',
            'first_name' => 'required|regex:/^[a-zA-ZÁá-ÿ]+$/',
            'last_name' => 'required|regex:/^[a-zA-ZÁá-ÿ]+$/',
            'birthdate' => 'required',
            'gender' => 'required',
            'email' => 'required|email|unique:users,email,$this->id,id',
            'password' => 'required|confirmed|min:8',
            'city' => 'required|regex:/^[a-zA-Z]+$/',
            'zip' => 'required|numeric',
            'cellphone' => 'required|numeric',

            'street' => 'regex:/^[a-zA-Z]+$/|nullable',
            'outdoor_number' => 'numeric|nullable',
            'interior_number' => 'numeric|nullable',
            'colony' => 'regex:/^[a-zA-Z]+$/|nullable',
            'phone' => 'numeric|nullable',
        ];

        $messages = [
            'name.required' => 'Debe agregar su nombre.',
            'first_name.required' => 'Debe agregar su Apellido Paterno.',
            'last_name.required' => 'Debe agregar su Apellido Materno.',
            'birthdate.required' => 'Debe agregar su Fecha de Nacimiento.',
            'gender.required' => 'Debe agregar su Genero.',
            'email.required' => 'Debe agregar su Correo.',
            'password.required' => 'Debe agregar su Contraseña.',
            'city.required' => 'Debe agregar su Ciudad.',
            'zip.required' => 'Debe agregar su Código Postal.',
            'cellphone.required' => 'Debe agregar su Número de Celular.',

            'street.regex' => 'La calle debe de ser Texto.',
            'outdoor_number.numeric' => 'El número exterior debe de ser numerico.',
            'interior_number.numeric' => 'El número interior debe de ser numerico.',
            'colony.regex' => 'La colonia debe de ser un Texto.',
            'phone.numeric' => 'El numero celular debe ser numerico.',

            'name.regex' => 'El nombre debe de ser un texto.',
            'first_name.regex' => 'El Apellido Paterno debe de ser un texto.',
            'last_name.regex' => 'El Apellido Materno debe de ser un texto.',
            'email.unique' => 'EL correo ingresado ya existe.',
            'password.confirmed' => 'Las contraseñas no coincide.',
            'city.regex' => 'La ciudade debe ser un texto.',
            'zip.numeric' => 'EL Código Postal debe de ser numerico.',
            'cellphone.numeric' => 'EL Número celular debe de ser numerico.',

            'email.email' => 'El correo electronico ddebe tener un formato valido.',
            'password.min:8' => 'La contraseña debe tener almenos 8 caracteres.',

            'username.required' => 'Debe Proporcionar un nombre de Usuario.',
            'username.unique' => 'El nombre de usuario ya existe.',

        ];

        $this->validate($request, $rules, $messages);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

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
