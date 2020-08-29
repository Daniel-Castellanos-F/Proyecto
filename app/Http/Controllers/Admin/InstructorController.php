<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\User;

use App\Http\Controllers\Controller;

class InstructorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $instructores =User::instructores()->paginate(10);
        return view('instructores.index',compact('instructores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('instructores.create');
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
                'role' =>'instructor',
                'password' => bcrypt($request->input('password'))
            ]
        );

        $notification = 'El Instructor se ha registrado correctamente.';
        return redirect('/instructores')->with(compact('notification'));
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
        $instructor = User::instructores()->findOrFail($id);
        return view('instructores.edit', compact('instructor'));
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

        $user = User::instructores()->findOrFail($id);

        $data = $request->only('name','email','cedula','address');
        $password = $request->input('password');
        if($password)
            $data['password'] = bcrypt($password);

        $user->fill($data);
        $user->save();
           
        $notification = 'El informacion del Instructor se ha actualizado correctamente.';
        return redirect('/instructores')->with(compact('notification'));
    }

    public function destroy($id)
    {
        $instructor = User::instructores()->findOrFail($id);
        $instructorName = $instructor->name;
        $instructor->delete();

        $notification = "El Instructor  $instructorName se ha eliminado correctamente.";
        return redirect('/instructores')->with(compact('notification'));
    }
}
