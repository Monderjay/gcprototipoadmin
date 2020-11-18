<?php

namespace App\Http\Controllers;

use App\Address;
use App\User;
use App\Role;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Collection;
use File;

class FoundersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Obtiene todos los fundadores
        $founders = User::where('role_id',1)->orderBy('id','desc')->paginate(5);
        return view('founders.index')->with(compact('founders'));

        /*$founders = DB::table('users')
           ->join('roles', 'users.role_id', '=', 'roles.id')
           ->join('addresses', 'users.id', '=', 'addresses.user_id')
           ->where('roles.name','Fundador')
           ->select('users.*', 'roles.name as role','addresses.street','addresses.colony','city',
               'addresses.interior_number','addresses.outdoor_number','addresses.phone',
               'addresses.cellphone','addresses.post_code','addresses.user_id')
           ->orderBy('id','desc')
           ->paginate(5);
       */
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Muestra el formulario para registrar un fundador
        return view('founders.create');
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

        $founder = new User();
        $address = new Address();

        $founder->name = $request->input('name');
        $founder->first_name = $request->input('first_name');
        $founder->last_name = $request->input('last_name');
        $founder->age = $request->input('age');
        $founder->gender = $request->input('gender');
        $founder->email = $request->input('email');
        $founder->password = bcrypt($request->input('password'));
        $founder->role_id = 1;
        $founder->save();

        $address->street = $request->input('street');
        $address->outdoor_number = $request->input('outdoor_numer');
        $address->interior_number = $request->input('interior_number');
        $address->colony = $request->input('colony');
        $address->city = $request->input('city');
        $address->post_code = $request->input('post_code');
        $address->cellphone = $request->input('cellphone');
        $address->phone = $request->input('phone');

        $founder->address()->save($address);

        if ($founder){
            $notification ="!Registro Exitoso¡";
            return redirect('/admin/founder')->with(compact('notification'));
        }
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
        $founder = User::find($id);
        $address = $founder->address;
        return view('founders.edit')->with(compact('founder','address'));
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
        $founder = User::find($id);

        $founder->name = $request->input('name');
        $founder->first_name = $request->input('first_name');
        $founder->last_name = $request->input('last_name');
        $founder->age = $request->input('age');
        $founder->gender = $request->input('gender');
        $founder->email = $request->input('email');
        $founder->password = $request->input('password');
        $founder->role_id = 1;
        $founder->save();

        $address->street = $request->input('street');
        $address->outdoor_number = $request->input('outdoor_numer');
        $address->interior_number = $request->input('interior_number');
        $address->colony = $request->input('colony');
        $address->city = $request->input('city');
        $address->post_code = $request->input('post_code');
        $address->cellphone = $request->input('cellphone');
        $address->phone = $request->input('phone');

        $founder->address()->save($address);

        if ($founder){
            $notification ="!Registro Modificado con Exito¡";
            return redirect('/admin/founder')->with(compact('notification'));
        }
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
        $founder = User::find($id);
        $founder->name = $request->input('name');
        $founder->first_name = $request->input('first_name');
        $founder->last_name = $request->input('last_name');
        $founder->age = $request->input('age');
        $founder->gender = $request->input('gender');
        $founder->email = $request->input('email');
        $founder->password = bcrypt($request->input('password')) ;

        $founder->role_id = 1;

        if($founder->save()){
            $notification = "!Cambios Guardados con exito¡";
            return back()->with(compact('notification'));
        }
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
        $founder = User::find($id);

        if ($founder->role->name === "Fundador") {
            if ($founder->cover_image != null || $founder->porfile_image != null) {
                if (substr($founder->cover_image, 0, 4) == "http") {
                    $deleted = true;
                } else {
                    $fullPath = public_path() . '/images/cover_images/' . $founder->cover_image;
                    $deleted = File::delete($fullPath);
                }

                if (substr($founder->porfile_image, 0, 4) == "http") {
                    $deleted = true;
                } else {
                    $fullPath = public_path() . '/images/porfile_images/' . $founder->porfile_image;
                    $deleted = File::delete($fullPath);
                }
                //Eliminar el registro
                if ($deleted) {
                    $founder->address()->delete();
                    $founder->delete();
                    $notification = "!El Fundador se ha eliminado correctamente¡";
                    return back()->with(compact('notification'));
                }
            } else {
                $founder->address()->delete();
                $founder->delete();

                $notification = "!El Fundador se ha eliminado correctamente¡";
                return back()->with(compact('notification'));
            }
        }
    }

}
