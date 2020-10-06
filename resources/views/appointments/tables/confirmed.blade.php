<div class="table-responsive">
              <!-- Projects table -->
  <table class="table align-items-center table-flush">
    <thead class="thead-light">
      <tr>
        <th scope="col">Escenario</th>
        <th scope="col">Fecha</th>
        <th scope="col">Hora</th>
        <th scope="col">Estado</th>
        <th scope="col">Opciones</th>
      </tr>
    </thead>
    <tbody>

    @foreach ($confirmedAppointments as $appointment)
      <tr>
        <th scope="row">
          {{ $appointment->escenario->name }}
        </th>
        <td>
          {{ $appointment->schedule_date }}
        </td>
        <td>
          {{ $appointment->schedule_time_12 }}
        </td>
        <td>
          {{ $appointment->status }}
        </td>
        <td> 
          @if ( $role == 'admin' )     
            <a class="btn btn-sm btn-info" title="Ver reserva" href="{{ url('/appointments/'.$appointment->id) }}">Ver</a>
            
            <form action="{{ url('/appointments/'.$appointment->id.'/attended') }}" method="POST" class="d-inline-block">
                @csrf
                <button class="btn btn-sm btn-success" type="submit" title="Atender reserva">Atendida</button>
              </form>
          @endif  
            <a class="btn btn-sm btn-warning" title="Cancelar reserva" href="{{ url('/appointments/'.$appointment->id.'/cancel') }}">Cancelar</a> 
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

<div class="card-body">
    {{ $confirmedAppointments->links() }}
</div>