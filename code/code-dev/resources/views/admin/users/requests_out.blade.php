@extends('admin.master')
@section('title','Agregar Usuario')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/users/1') }}" class="nav-link"><i class="fas fa-user-lock"></i> Usuarios</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/users/1') }}" class="nav-link"><i class="fas fa-user-lock"></i> Solicitudes Fuera de Tiempo: {{ $u->name.' '.$u->lastname}} (IBM: {{ $u->ibm}})</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                @if(kvfj(Auth::user()->permissions, 'user_requests_out'))
                    <div class="panel shadow">
                        <div class="header">
                            <h2 class="title"><i class="fas fa-plus-circle"></i> <strong>Habilitar Nueva Solicitud</strong></h2>
                        </div>

                        <div class="inside">
                            {!! Form::open(['url' => '/admin/usuario/'.$u->id.'/solicitudes_fuera_de_tiempo', 'files' => true]) !!}
                                <label for="name"><strong><sup style="color: red;">(*)</sup>  Jornada:</strong> </label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::select('journey', $journeys ,1,['class'=>'form-select']) !!}
                                </div>

                                <label for="name" class="mtop16"><strong><sup style="color: red;">(*)</sup> Cantidad de Dietas / Refacciones:</strong> </label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::number('amount_diets', null, ['class'=>'form-control', 'min'=>'0']) !!}
                                </div>

                                <label for="name" class="mtop16"><strong><sup style="color: red;">(*)</sup> Tiempo a Asignar:</strong> </label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::select('time', getTimeRequestsOut('list', null),null,['class'=>'form-select']) !!}
                                </div>

                                {!! Form::submit('Guardar', ['class'=>'btn btn-success mtop16']) !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
                @endif
            </div>

            <div class="col-md-9">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-hospital-user"></i> <strong>Listado de Solicitudes Habilitadas: </strong>{{ $u->name.' '.$u->lastname}} (IBM: {{ $u->ibm}}) </a>
                    </div>

                    <div class="inside">
                        <table id="table-modules" class="table table-striped table-hover mtop16" style="text-align:center;">
                            <thead>
                                <tr>
                                    <td><strong> FECHA HABILITADA</strong></td>
                                    <td><strong> JORNADA </strong></td>
                                    <td><strong> CANTIDAD DE DIETAS / REFACCIONES </strong></td>
                                    <td><strong> TIEMPO ASIGNADO</strong></td>
                                    <td><strong> ESTADO </strong></td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($solicitudes as $s)
                                    <tr>
                                        <td>{{ $s->created_at->format('d/m/Y')}}</td>
                                        <td>{{ $s->journey->name }}</td>
                                        <td>{{ $s->amount_diets }}</td>
                                        <td>{{ getTimeRequestsOut(null, $s->time_available) }}</td>
                                        <td>{{ $s->status }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
