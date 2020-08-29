@extends('layouts.panel')

@section('content')

   <div class="card shadow">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">Nuevo escenario</h3>
                </div>
                <div class="col text-right">
                  <a href="{{url('Escenarios')}}" class="btn btn-sm btn-warning">
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

              <form action="{{ url('Escenarios')}}" method="post">
                @csrf
                  <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="name">Nombre del Escenario</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name')}}" required>
                        </div>

                        <div class="form-group">
                            <label for="address">Dirección</label>
                            <input type="text" name="address" class="form-control" value="{{ old('address')}}" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="description">Descripción</label>
                            <input type="text" name="description" class="form-control" value="{{ old('description')}}" required>
                        </div>  
                    </div>

                    <div class="col">
                      <div id="map" style="height: 400px; width: 400px">

                        <!-- Clave API-->
                        <!-- AIzaSyDTV2iNTn-PjD9VK5BMs8apRQiNyoMlAbs -->



                      </div>    
                    </div>
                  </div>                                             

                  <button type="submit" class="btn btn-primary">
                   Guardar
                  </button>
             </form>
           </div>
          </div>

@endsection

@section('scripts')
    <script src="{{ asset('/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{ asset('/js/appointments/Mapas.js')}}"></script>
    <!--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBRvfhIw8v2pzzfRU6ZLGM9j-kJdjAWVJw=iniciarMap">
    </script>-->
@endsection