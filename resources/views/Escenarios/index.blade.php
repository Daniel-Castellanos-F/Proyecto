@extends('layouts.panel')

@section('content')

   <div class="card shadow">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">Escenarios</h3>
                </div>
                <div class="col text-right">
                  <a href="{{url('Escenarios/create')}}" class="btn btn-sm btn-primary">
                  	Nuevo Escenario
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
                    <th scope="col">Descripción</th>
                    <th scope="col">Dirección</th>
                    <th scope="col">Opciones</th>
                  </tr>
                </thead>
                <tbody>

                @foreach ($Escenarios as $Escenario)
                  <tr>
                    <th scope="row">
                      {{ $Escenario->name }}
                    </th>
                    <td style="white-space: pre-line;">
                      {{ $Escenario->description }}
                    </td>
                    <td>
                      {{ $Escenario->address }}
                    </td>
                    <td>
                      
                      <form action="{{ url('/Escenarios/'.$Escenario->id) }}" method="POST">
                        @csrf
                        @method('DELETE')                       
                  
                        @if (auth()->user()->role =='admin')
                          <a href="{{ url('/Escenarios/'.$Escenario->id.'/edit') }}" class="btn btn-sm btn-primary">Editar</a>
                          {{--<a href="{{ url('/schedule/'.$Escenario->id.'/') }}" class="btn btn-sm btn-primary">Horarios</a>--}}
                          <!-- .$Escenario->id.'/'-->
                          <button class="btn btn-sm btn-warning" type="submit">Eliminar</button>
                        @else
                           <a href="{{ url('/Escenarios/'.$Escenario->id.'/edit') }}" class="btn btn-sm btn-primary">Ver</a>

                        @endif
                      </form>
                      
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>

@endsection


