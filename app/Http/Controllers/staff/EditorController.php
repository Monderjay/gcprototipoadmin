<?php

namespace App\Http\Controllers\Staff;

use App\Address;
use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use Illuminate\Http\Request;

class EditorController extends Controller
{

    public function index()
    {
        //Obtiene todos los Editores
        $founder ="Editor";
        $editors=User::with('role')
            ->whereHas('role', function ($query) use ($founder) {
                $query->where('roles.name', '=', $founder);
            })
            ->paginate(10);

        $totalEditors = $editors->count();

        return view('editor.index')->with(compact('editors', 'totalEditors'));

    }


    public function create()
    {
        //
        return view('editor.create');
    }


    public function store(Request $request)
    {
        //
        $rules = [
            'name' => 'required|regex:/^[a-zA-ZÁ-ÿ ]+$/',
            'first_name' => 'required|regex:/^[a-zA-ZÁ-ÿ ]+$/',
            'last_name' => 'required|regex:/^[a-zA-ZÁ-ÿ ]+$/',
            'gender' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:8',
            'city' => 'required|regex:/^[a-zA-ZÁ-ÿ ]+$/',
            'zip' => 'numeric',
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
            'gender.required' => 'Debe agregar su Genero.',
            'email.required' => 'Debe agregar su Correo.',
            'password.required' => 'Debe agregar su Contraseña.',
            'city.required' => 'Debe agregar su Ciudad.',
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
            'password.min' => 'La contraseña debe tener almenos 8 caracteres.',

        ];

        $this->validate($request, $rules, $messages);


        //
        $editor = new User();
        $address = new Address();

        $editor->name = $request->input('name');
        $editor->first_name = $request->input('first_name');
        $editor->last_name = $request->input('last_name');
        $editor->birthdate = $request->input('birthdate');
        $editor->gender = $request->input('gender');
        $editor->email = $request->input('email');
        $editor->password = bcrypt($request->input('password'));

        $role = Role::where('name','Editor')->first();
        $editor->role_id =$role->id;

        $address->street = $request->input('street');
        $address->outdoor_number = $request->input('outdoor_numer');
        $address->interior_number = $request->input('interior_number');
        $address->colony = $request->input('colony');
        $address->city = $request->input('city');
        $address->zip = $request->input('zip');
        $address->cellphone = $request->input('cellphone');
        $address->phone = $request->input('phone');

        if ($editor->save() && $editor->address()->save($address)){
            $notification ="!Registro Exitoso¡";
            return redirect('staff/editor')->with(compact('notification'));
        }else{
            $notificationFaill ="Registro Fallido :(";
            return redirect('staff/editor')->with(compact('notificationFaill'));
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
