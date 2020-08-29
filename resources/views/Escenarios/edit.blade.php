@extends('layouts.panel')

@section('content')

   <div class="card shadow">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">Editar escenario</h3>
                </div>
                <div class="col text-right">
                  <a href="{{url('Escenarios')}}" class="btn btn-sm btn-warning">
                  	Cancelar y volver
                  </a>
                </div>
              </div>
            </div>
           
           <div class="card-body">
            {{--
              @if ($errors->any())
                <div class="alert alert-warning" role="alert">
                  <ul>
                    @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                </div>
              @endif
              --}}
              <form action="{{ url('Escenarios/'.$Escenario->id)}}" method="post">
                @csrf
                @method('PUT')
                  <div class="row">
                    <div class="col">
                       <div class="form-group">
                           <label for="name">Nombre del Escenario</label>
                           <input type="text" name="name" class="form-control" value="{{ old('name', $Escenario->name) }}" required>
                        </div>
                        <div class="form-group">
                           <label for="address">Dirección</label>
                           <input type="text" name="address" class="form-control" value="{{ old('address', $Escenario->address) }}" required>
                        </div>

                    </div>
                    <div class="col">
                        <div class="form-group">
                           <label for="description">Descripción</label>
                           <input type="text" name="description" class="form-control" value="{{ old('description', $Escenario->description) }}" required>
                        </div>
                         <button type="submit" class="btn btn-primary">
                          Guardar
                        </button>
                    </div>   
                  </div>  
             </form>

             <form action="{{ url('/schedule') }}" method="post">
              @csrf
              <div class="card shadow">
                  <div class="card-header border-0">
                    <div class="row align-items-center">
                      <div class="col">
                        <h3 class="mb-0">Horario del escenario </h3>
                      </div>             
                      <div class="col text-right">
                        <button type="submit" class="btn btn-sm btn-primary">
                          Guardar cambios
                        </button>
                      </div>
                    </div>
                  </div>
     
                  <div class="card-body">
                      @if (session('notification'))
                        <div class="alert alert-success" role="alert">
                          {{ session('notification') }}
                        </div>
                      @endif
                      @if (session('errors'))
                        <div class="alert alert-danger" role="alert">
                          los cambios se han guardado pero tener en cuenta que:
                          <ul>
                            @foreach (session('errors') as $error)
                              <li> {{  $error  }} </li>
                            @endforeach
                          </ul>
                        </div>
                      @endif
                  </div>

                  <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                      <thead class="thead-light">
                        <tr>
                          <th scope="col">Dia</th>
                          <th scope="col">Activo</th>
                          <th scope="col">Mañana</th>
                          <th scope="col">Tarde</th>
                          <th scope="col"> </th>
                        </tr>
                      </thead>
                      <tbody>
                          @foreach ($workDays as $key => $workDay )
                            <tr>
                              <th> {{ $days[$key] }}</th>
                              <td>
                                <label class="custom-toggle">
                                  <input type="checkbox" name="active[]" value="{{ $key }}"
                                  @if($workDay->active) checked @endif>
                                    <span class="custom-toggle-slider rounded-circle"></span>
                                </label>
                              </td>

                              <td>
                                  <div class="row">
                                    <div class="col">
                                      <select class="form-control" name="morning_start[]">
                                        @for ($i=6; $i<=11; $i++)
                                          <option value="{{ ($i<10 ? '0' : '' ). $i }}:00" 
                                              @if($i.':00 AM' == $workDay->morning_start) selected @endif>
                                              {{ $i }}:00 AM
                                          </option>
                                          {{--<option value="{{ ($i<10 ? '0' : '' ). $i }}:30" 
                                              @if($i.':30 AM' == $workDay->morning_start) selected @endif>
                                              {{ $i }}:30 AM
                                          </option>--}}
                                        @endfor                             
                                      </select>                                
                                    </div>
                                    <div class="col">
                                      <select class="form-control" name="morning_end[]">
                                        @for ($i=6; $i<=11; $i++)
                                          <option value="{{ ($i<10 ? '0' : '' ). $i }}:00" 
                                            @if($i.':00 AM' == $workDay->morning_end) selected @endif>
                                            {{ $i }}:00 AM
                                          </option>
                                          {{--<option value="{{ ($i<10 ? '0' : '' ). $i }}:30" 
                                            @if($i.':30 AM' == $workDay->morning_end) selected @endif>
                                            {{ $i }}:30 AM
                                          </option>--}}
                                        @endfor                             
                                      </select>                                
                                    </div>
                                  </div>
                              </td>
                              <td>
                                <div class="row">
                                    <div class="col">
                                      <select class="form-control" name="afternoon_start[]">
                                        @for ($i=1; $i<=11; $i++)
                                          <option value="{{ $i+12 }}:00"
                                              @if($i.':00 PM' == $workDay->afternoon_start) selected @endif>
                                              {{ $i }}:00 PM
                                            </option>
                                          {{--<option value="{{ $i+12 }}:30"
                                              @if($i.':30 PM' == $workDay->afternoon_start) selected @endif>
                                              {{ $i }}:30 PM
                                            </option>--}}
                                        @endfor                             
                                      </select>                                
                                    </div>
                                    <div class="col">
                                      <select class="form-control" name="afternoon_end[]">
                                        @for ($i=1; $i<=11; $i++)
                                          <option value="{{ $i+12 }}:00"
                                            @if($i.':00 PM' == $workDay->afternoon_end) selected @endif>
                                            {{ $i }}:00 PM
                                          </option>
                                          {{--<option value="{{ $i+12 }}:30"
                                            @if($i.':30 PM' == $workDay->afternoon_end) selected @endif>
                                            {{ $i }}:30 PM
                                          </option>--}}
                                        @endfor                             
                                      </select>                                
                                    </div>
                                  </div>
                              </td>
                              <td>
                                <select class="form-control" name="escenario_id[]">          
                                    <option value="{{ $Escenario->id }}">{{ $Escenario->id }}</option>
                                </select> 
                              </td>
                            </tr> 
                          @endforeach
                      </tbody>
                    </table>
                  </div>
              </div>
            </form>
           </div>
          </div>
@endsection
