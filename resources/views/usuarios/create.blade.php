@extends('layouts.panel')

@section('content')

   <div class="card shadow">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">Nuevo Usuario</h3>
                </div>
                <div class="col text-right">
                  <a href="{{url('usuarios')}}" class="btn btn-sm btn-warning">
                  	Cancelar y volver
                  </a>
                </div>
              </div>
            </div>
           
           <div class="card-body">
              @if ($errors->any())
                <div class="alert alert-warning" role="alert">
                  <ul>
                    @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                </div>
              @endif

              <form action="{{ url('usuarios')}}" method="post">
                @csrf
                 <div class="form-group">
                   <label for="name">Nombre del Usuario</label>
                   <input type="text" name="name" class="form-control" value="{{ old('name')}}" required>
                 </div>
                 <div class="form-group">
                   <label for="email">E-mail</label>
                   <input type="text" name="email" class="form-control" value="{{ old('email')}}" required>
                 </div>
                  <div class="form-group">
                   <label for="cedula">Documento de Identidad</label>
                   <input type="text" name="cedula" class="form-control" value="{{ old('cedula')}}" required>
                 </div>
                 <div class="form-group">
                   <label for="address">Dirección</label>
                   <input type="text" name="address" class="form-control" value="{{ old('address')}}" required>
                 </div>

                 <div class="form-group">
                   <label for="password">Contraseña</label>
                   <input type="text" name="password" class="form-control" value="{{ str_random(6) }}">
                 </div>  

                 <button type="submit" class="btn btn-primary">
                   Guardar
                 </button>
             </form>
           </div>
          </div>

@endsection
