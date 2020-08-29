@extends('layouts.panel')

@section('content')

   <div class="card shadow">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">Reserva de Escenario</h3>
                </div>
                <div class="col text-right">
                  <a href="/home" class="btn btn-sm btn-warning">
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

              <form action="{{ url('appointments')}}" method="post">
                @csrf
                 <div class="form-group">
                   <label for="escenario">Escenario</label>
                      <select name="escenario_id" id="escenario" class="form-control" required>
                        @foreach($escenarios as $escenario)
                          <option value="{{ $escenario->id }}" @if( old('escenario_id') == $escenario->id) selected @endif> {{$escenario->name}} </option>
                        @endforeach
                      </select>
                 </div>

                 <div class="form-group">
                   <label for="">Fecha</label>
                   <div class="input-group input-group-alternative">
                      <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="ni ni-calendar-grid-58"></i>
                      </span>
                    </div>
                    <input class="form-control datepicker" placeholder="Seleccionar fecha" id="date" name="schedule_date" type="text" 
                    value="{{ old('schedule_date', date('Y-m-d')) }}" 
                    data-date-format="yyyy-mm-dd" 
                    data-date-start-date="{{date('Y-m-d')}}" 
                    data-date-end-date="+20d">
                   </div>  
                                      
                 </div>
                 <div class="form-group">
                   <label for="">Hora de reserva</label>
                      <div id="hours">
                        @if ($intervals)
                          @foreach( $intervals['morning'] as $key => $interval)
                              <div class="custom-control custom-radio mb-3">
                                  <input name="schedule_time" value="{{$interval['start']}}" class="custom-control-input" id="intervalMorning{{$key}}" type="radio" required>
                                 <label class="custom-control-label" for="intervalMorning{{$key}}">{{$interval['start']}} - {{$interval['end']}}</label>
                              </div>

                          @endforeach
                          @foreach( $intervals['afternoon'] as $key => $interval)
                              <div class="custom-control custom-radio mb-3">
                                  <input name="schedule_time" value="{{$interval['start']}}" class="custom-control-input" id="intervalAfternoon{{$key}}" type="radio" required>
                                 <label class="custom-control-label" for="intervalAfternoon{{$key}}">{{$interval['start']}} - {{$interval['end']}}</label>
                              </div>
                          @endforeach

                        @else
                          <div class="alert alert-secondary" role="alert">
                            Selecciona un Escenario y fecha para ver su disponibilidad.
                          </div>
                        @endif


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
    <script src="{{ asset('/js/appointments/create.js')}}"></script>
@endsection
