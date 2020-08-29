@extends('layouts.panel')

@section('content')
  <div class="card shadow">
      <div class="card-header border-0">
        <div class="row align-items-center">
          <div class="col">
            <h3 class="mb-0">Cancelar reserva</h3>
          </div>
        </div>
      </div>

      <div class="card-body">
          @if (session('notification'))
            <div class="alert alert-success" role="alert">
              {{ session('notification') }}
            </div>
          @endif

          @if ( $role == 'admin')
              <h3> 
                Estás a punto de cancelar la reserva realizada por <strong style="text-decoration: underline"> {{ $appointment->user->name }} </strong>
                para <strong style="text-decoration: underline"> {{ $appointment->escenario->name }} </strong>
                el día <strong style="text-decoration: underline"> {{ $appointment->schedule_date }} </strong>
                (hora {{ $appointment->schedule_time_12 }}) 
              </h3>
          @else
              <h3> 
                Estás a punto de cancelar tu reserva para 
                <strong style="text-decoration: underline"> {{ $appointment->escenario->name }} </strong> 
                el día <strong style="text-decoration: underline"> {{ $appointment->schedule_date }} </strong>
                (hora {{ $appointment->schedule_time_12 }}) 
              </h3>
          @endif

          <form action="{{ url('/appointments/'.$appointment->id.'/cancel') }}" method="POST">
              @csrf            
              <div class="form-group">
                  <label for="justification">Por favor cuéntanos el motivo de la cancelación</label>
                  <textarea required id="justification" name="justification" rows="3" class="form-control"> </textarea>
              </div>
              
              <button class="btn btn-sm btn-warning" type="submit">Cancelar reserva</button>
              <a href="{{ url('/appointments') }}" class="btn btn-sm btn-primary">Volver al listado sin cancelar</a>

          </form>
      </div>
           
  </div>            
@endsection
