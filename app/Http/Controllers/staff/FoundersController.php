<?php

namespace App\Http\Controllers\Staff;
use App\Http\Controllers\Controller;
use App\Address;
use App\User;
use App\Role;
use http\Env\Response;
use Illuminate\Http\Request;
use File;
use Illuminate\Support\Facades\Validator;

class FoundersController extends Controller
{

    public function index()
    {
        //Obtiene todos los fundadores
        $roles = Role::all();
        $role = $roles->where('name','Fundador');
        $id=$role[0]->id;
        $totalFounders = User::where('role_id',$role[0]->id)->count();

        $founders = User::where('role_id',$id)->orderBy('id','desc')->paginate(5);
        return view('founders.index')->with(compact('founders','totalFounders'));

    }


    public function create()
    {
        //Muestra el formulario para registrar un fundador
        return view('founders.create');
    }


    public function store(Request $request)
    {

        $rules = [
            'name' => 'required|regex:/^[a-zA-ZÁ-ÿ ]+$/',
            'first_name' => 'required|regex:/^[a-zA-ZÁ-ÿ ]+$/',
            'last_name' => 'required|regex:/^[a-zA-ZÁ-ÿ ]+$/',
            'birthdate' => 'required',
            'gender' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:8',
            'city' => 'required|regex:/^[a-zA-ZÁ-ÿ ]+$/',
            'zip' => 'required|numeric',
            'cellphone' => 'required|numeric',

            'street' => 'regex:/^[a-zA-ZÁ-ÿ ]+$/|nullable',
            'outdoor_number' => 'numeric|nullable',
            'interior_number' => 'numeric|nullable',
            'colony' => 'regex:/^[a-zA-ZÁ-ÿ ]+$/|nullable',
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

        ];

        $this->validate($request, $rules, $messages);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }


        //
        $founder = new User();
        $address = new Address();

        $founder->name = $request->input('name');
        $founder->first_name = $request->input('first_name');
        $founder->last_name = $request->input('last_name');
        $founder->birthdate = $request->input('birthdate');
        $founder->gender = $request->input('gender');
        $founder->email = $request->input('email');
        $founder->password = bcrypt($request->input('password'));

        $roles = Role::all();
        $role = $roles->where('name','Fundador');
        $id=$role[0]->id;
        $founder->role_id = $id;

        $address->street = $request->input('street');
        $address->outdoor_number = $request->input('outdoor_numer');
        $address->interior_number = $request->input('interior_number');
        $address->colony = $request->input('colony');
        $address->city = $request->input('city');
        $address->zip = $request->input('zip');
        $address->cellphone = $request->input('cellphone');
        $address->phone = $request->input('phone');

        if ($founder->save() && $founder->address()->save($address)){
            $notification ="!Registro Exitoso¡";
            return redirect('staff/founder')->with(compact('notification'));
        }else{
            $notificationFaill ="Registro Fallido :(";
            return redirect('staff/founder')->with(compact('notificationFaill'));
        }
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
        $founder = User::find($id);
        $address = $founder->address;
        return view('founders.edit')->with(compact('founder','address'));

    }


    public function update(Request $request, $id)
    {
        //
        $founder = User::find($id);
        $founder->name = $request->input('name');
        $founder->first_name = $request->input('first_name');
        $founder->last_name = $request->input('last_name');
        $founder->birthdate = $request->input('birthdate');
        $founder->gender = $request->input('gender');
        $founder->email = $request->input('email');

        if ($request->input('password') != null){
            $founder->password = bcrypt($request->input('password')) ;
        }

        $founder->address->street = $request->input('street');
        $founder->address->outdoor_number = $request->input('outdoor_number');
        $founder->address->interior_number = $request->input('interior_number');
        $founder->address->colony = $request->input('colony');
        $founder->address->city = $request->input('city');
        $founder->address->zip = $request->input('zip');
        $founder->address->cellphone = $request->input('cellphone');
        $founder->address->phone = $request->input('phone');

        if($founder->save() && $founder->address->save()){
            $notification = "!Cambios Guardados con exito¡";
            return back()->with(compact('notification'));
        }else{
            $notificationFaill = "No se Han podido Guardar los Cambios :(";
            return back()->with(compact('notificationFaill'));
        }
    }


    public function destroy($id)
    {
        //
        $founder = User::find($id);

        if ($founder->role->name === "Fundador") {
            if ($founder->delete()){
                $notification = "!El Fundador se ha eliminado correctamente¡";
                return back()->with(compact('notification'));
            }
        }
    }



    /*if ($founder->cover_image != null || $founder->porfile_image != null) {
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
        $founder->delete();
        $founder->address()->delete();
        $notification = "!El Fundador se ha eliminado correctamente¡";
        return back()->with(compact('notification'));
    }
    } else {
        $founder->address()->delete();
        $founder->delete();

        $notification = "!El Fundador se ha eliminado correctamente¡";
        return back()->with(compact('notification'));
    }*/

}
