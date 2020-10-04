@extends('layouts.panel')

@section('content')

    <div class="row justify-content-center">
        
    </div>


    <div class="row">
            <div class="col-md-12 mb-4">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <h3 class="text-black mb-0">Bienvenido! Por favor selecciona una opcionde menu lateral izquierdo.</h3>
                    </div>
                </div>
            </div>

            @if (auth()->user()->role == 'admin')
                <div class="col-xl-6 mb-5 mb-xl-0">
                    <div class="card">
                      <div class="card-header bg-transparent">
                        <div class="row align-items-center">
                          <div class="col">
                            <h5 class="text-uppercase ls-1 mb-1">Notificacion general</h5>
                            <h2 class="text-black mb-0">Enviar a todos los usuario</h2>
                          </div>
                        </div>
                      </div>

                      <div class="card-body"> 
                        @if (session('notification'))
                          <div class="alert alert-success" role="alert">
                            {{ session('notification') }}
                          </div>
                        @endif

                        <form action=" {{url('/fcm/send')}} " method="post">
                            @csrf
                            <div class="form-group">
                              <label for="title">Título</label>
                              <input value="{{config('app.name')}}" type="text" class="form-control" name="title" id="title" required="">
                            </div>
                            <div class="form-group">
                              <label for="body">Mensaje</label>
                              <textarea name="body" id="body" rows="2" class="form-control" required=""></textarea>
                            </div>
                            <button class="btn btn-primary">Enviar notificación</button>
                        </form> 
                      </div>
                    </div>
                </div>

                <div class="col-xl-6">
                    <div class="card shadow">
                      <div class="card-header bg-transparent">
                        <div class="row align-items-center">
                          <div class="col">
                            <h5 class="text-uppercase ls-1 mb-1">Total reservas</h5>
                            <h2 class="mb-0">Según el día de la semana</h2>
                          </div>
                        </div>
                      </div>
                      <div class="card-body">
                        <!-- Chart -->
                        <div class="chart">
                          <canvas id="chart-orders" class="chart-canvas"></canvas>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
            @endif     
    </div>

@endsection

@section('scripts')
  <script>
    const appointmentsByDay = @json($appointmentsByDay);
  </script>
  <script src="{{ asset('js/charts/home.js')}}"></script>
@endsection