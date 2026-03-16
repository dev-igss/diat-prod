@extends('admin.master')
@section('title','Jornadas')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/journeys') }}" class="nav-link"><i class="fas fa-clock"></i> Jornadas</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-5">
                @if(kvfj(Auth::user()->permissions, 'journey_add'))
                    <div class="panel shadow">
                        <div class="header">
                            <h2 class="title"><i class="fas fa-plus-circle"></i> <strong>Agregar Jornada </strong></h2>
                        </div>

                        <div class="inside">
                                {!! Form::open(['url' => '/admin/jornada/agregar']) !!}
                                    <label for="name"><strong>Nombre:</strong></label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                        {!! Form::text('name', null, ['class'=>'form-control']) !!}
                                    </div>

                                    <label for="unit_id"  class="mtop16"><strong>Hora de Inicio:</strong></label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                        {{ Form::time('start_time', Carbon\Carbon::now()->format('H:i'), ['class'=>'form-input']) }}
                                    </div>

                                    <label for="unit_id"  class="mtop16"><strong>Hora de Finalización:</strong></label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                        {{ Form::time('end_time', Carbon\Carbon::now()->format('H:i'), ['class'=>'form-input']) }}
                                    </div>

                                    {!! Form::submit('Guardar', ['class'=>'btn btn-success mtop16']) !!}

                                {!! Form::close() !!}
                        </div>
                    </div>
                @endif
            </div>

            <div class="col-md-7">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-clock"></i> <strong>   Jornadas </strong></a>
                    </div>

                    <div class="inside">
                        <table id="table-modules" class="table table-striped table-hover mtop16">
                            <thead>
                                <tr>
                                    <td width="140px"><strong>OPCIONES</strong></td>
                                    <td width="48px"><strong>NOMBRE</strong></td>
                                    <td><strong>HORARIO</strong></td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($journeys as $j)
                                    <tr>
                                        <td>
                                        <div width="48" class="opts">
                                            @if(kvfj(Auth::user()->permissions, 'journey_edit'))
                                                <a href="{{ url('/admin/jornada/'.$j->id.'/editar') }}" data-toogle="tooltrip" data-placement="top" title="Editar"><i class="fas fa-edit"></i></a>
                                            @endif
                                            @if(kvfj(Auth::user()->permissions, 'journey_delete'))
                                                <a href="{{ url('/admin/jornada/'.$j->id.'/borrar') }}" data-toogle="tooltrip" data-placement="top" title="Eliminar"><i class="fas fa-trash-alt"></i></a>
                                            @endif
                                        </div>
                                        </td>
                                        <td width="200">{{ $j->name }}</td>
                                        <td width="50">{{ $j->start_time.' - '.$j->end_time}}</td>
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