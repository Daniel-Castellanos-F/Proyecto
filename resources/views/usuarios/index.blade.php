@extends('layouts.panel')

@section('content')

   <div class="card shadow">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">Usuarios</h3>
                </div>
                <div class="col text-right">
                  <a href="{{url('usuarios/create')}}" class="btn btn-sm btn-primary">
                  	Nuevo Usuario
                  </a>
                </div>
              </div>
            </div>

            
              <div class="card-body">
                  @if (session('notification'))
                    <div class="alert alert-success" role="alert">
                      {{ session('notification') }}
                    </div>
                  @endif
              </div>

            <div class="table-responsive">
              <!-- Projects table -->
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Documento de Identidad</th>
                    <th scope="col">Opciones</th>
                  </tr>
                </thead>
                <tbody>

                @foreach ($usuarios as $usuario)
                  <tr>
                    <th scope="row">
                      {{ $usuario->name }}
                    </th>
                    <td>
                      {{ $usuario->email }}
                    </td>
                    <td>
                      {{ $usuario->cedula }}
                    </td>
                    <td>
                      
                      <form action="{{ url('/usuarios/'.$usuario->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <a href="{{ url('/usuarios/'.$usuario->id.'/edit') }}" class="btn btn-sm btn-primary">Editar</a>
                        <button class="btn btn-sm btn-warning" type="submit">Eliminar</button>
                      </form>
                      
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <div class="card-body">
                {{ $usuarios->links() }}
            </div>
            </div>
            
@endsection
