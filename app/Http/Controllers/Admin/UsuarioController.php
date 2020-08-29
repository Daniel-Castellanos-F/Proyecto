<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\User;

use App\Http\Controllers\Controller;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios =User::usuarios()->paginate(10);
        return view('usuarios.index',compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('usuarios.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name'=> 'required|min:8',
            'email'=> 'required|email',
            'cedula' => 'required|min:7',
            'address' => 'nullable|min:5'

        ];
        $this->validate($request, $rules);

        User::create(
            $request->only('name','email','cedula','address')
            +[
                'role' =>'usuario',
                'password' => bcrypt($request->input('password'))
            ]
        );

        $notification = 'El Usuario se ha registrado correctamente.';
        return redirect('/usuarios')->with(compact('notification'));
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
    public function edit(User $usuario)
    {
        return view('usuarios.edit', compact('usuario'));
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
        $rules = [
            'name'=> 'required|min:8',
            'email'=> 'required|email',
            'cedula' => 'required|min:7',
            'address' => 'nullable|min:5'

        ];
        $this->validate($request, $rules);

        $user = User::usuarios()->findOrFail($id);

        $data = $request->only('name','email','cedula','address');
        $password = $request->input('password');
        if($password)
            $data['password'] = bcrypt($password);

        $user->fill($data);
        $user->save();
           
        $notification = 'El informacion del Usuario se ha actualizado correctamente.';
        return redirect('/usuarios')->with(compact('notification'));
    }

    public function destroy(User $usuario)
    {
        $usuarioName = $usuario->name;
        $usuario->delete();

        $notification ="El Usuario $usuarioName se ha eliminado correctamente.";
        return redirect('/usuarios')->with(compact('notification'));
    }
}
