@extends('layouts.panel')
@section('content')

  <div class="card shadow">
      <div class="card-header border-0">
        <div class="row align-items-center">
          <div class="col">
            <h3 class="mb-0">Reserva # {{ $appointment->id }}</h3>
          </div>
        </div>
      </div>

      <div class="card-body">
          <ul>
              <li>
                <strong>Fecha: </strong> {{ $appointment->schedule_date }}
              </li>
              <li>
                <strong>Hora: </strong> {{ $appointment->schedule_time_12 }}
              </li>
              <li>
                <strong>Escenario: </strong> {{ $appointment->escenario->name }}
              </li>
              <li>
                <strong>Usuario: </strong> {{ $appointment->user->name }}
              </li>
              <li>
                <strong>Rol: </strong> {{ $appointment->user->role }}
              </li>
              <li>
                <strong>Motivo: </strong> {{ $appointment->motivo }}
              </li>
              <li>
                <strong>Estado </strong> 
                  @if($appointment->status == 'Cancelada')
                    <span class="badge badge-warning">Cancelada</span>
                  @else
                    <span class="badge badge-success">{{ $appointment->status }}</span>
                  @endif  
              </li>
          </ul>  
          @if ($appointment->status == 'Cancelada')
              <div class="alert alert-info">
                <strong>Acerca de la cancelación:</strong>
                <ul>
                    @if($appointment->cancellation)
                    
                    <li>
                      <strong>Fecha de cancelación: </strong>
                      {{ $appointment->cancellation->created_at }}
                    </li>
                    <li>
                      <strong>¿Quién cancelo la reserva? </strong>
                      {{ $appointment->cancellation->cancelled_by->name }}
                    </li>
                    <li>
                      <strong>Motivo de cancelación: </strong>
                      {{ $appointment->cancellation->justification }}
                    </li>
                  @else
                    <li> * Esta reservación fue cancelada antes de su confirmación.</li> 
                  @endif
                </ul>            
              </div>
          @endif
          <a href="{{ url('/appointments') }}" class="btn btn-sm btn-success"> Volver</a> 

          @if ($appointment->status == 'Reservada' )

            <form action="{{ url('/appointments/'.$appointment->id.'/confirm') }}" method="POST" class="d-inline-block">
                @csrf
                <button class="btn btn-sm btn-success" type="submit" title="Confirmar reserva">Confirmar</button>
            </form> 

          @endif



          
  </div>
           
  </div>            
@endsection
