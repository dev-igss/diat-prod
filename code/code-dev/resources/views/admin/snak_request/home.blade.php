<?php set_time_limit(0);
ini_set("memory_limit",-1);
ini_set('max_execution_time', 0); ?>
@extends('admin.master')
@section('title','Solicitud de Refacciones')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/diet_requests') }}" class="nav-link"><i class="fas fa-file-alt"></i> Solicitudes de Refacciones de Banco de Sangre</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                @if(kvfj(Auth::user()->permissions, 'snak_request_add'))
                    @if($solicitud_fuera_tiempo == 1)
                        <div class="panel shadow">
                            <div class="header">
                                <h2 class="title"><i class="fas fa-plus-circle"></i><strong> Solicitud Fuera de Tiempo</strong></h2>
                            </div>

                            <div class="inside">
                                {!! Form::open(['url' => '/admin/solicitud_refaccion/solicitar', 'files' => true]) !!}
                                    <label for="name"> <strong><sup style="color: red;">(*)</sup> Servicio: </strong></label> 
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-layer-group"></i></span>
                                        <select name="idservice" id="idservice" style="width: 90%" >
                                            @foreach ($services as $s)
                                                <option value=""></option>
                                                <option value="{{$s->id}}">{{$s->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    {!! Form::hidden('route', Route::currentRouteName(), ['class'=>'form-control']) !!}

                                    <label for="name" class="mtop16"> <strong><sup style="color: red;">(*)</sup> Refacciones Disponibles: </strong></label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                        {!! Form::text('cantidad_dietas', $cantidad_dietas, ['class'=>'form-control', 'readonly', 'id'=>'cantidad_dietas']) !!}
                                        {!! Form::hidden('solicitud_fuera_tiempo', $solicitud_fuera_tiempo, ['class'=>'form-control', 'readonly']) !!}
                                        {!! Form::hidden('solicitud_fuera_id', $solicitud_fuera_id, ['class'=>'form-control', 'readonly']) !!}
                                    </div>

                                    <label for="name" class="mtop16"> <strong><sup style="color: red;">(*)</sup> Cantidad: </strong></label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                        {!! Form::number('amount', null, ['class'=>'form-control']) !!}
                                    </div>

                                    

                                    {!! Form::submit('Guardar', ['class'=>'btn btn-success mtop16']) !!}
                                {!! Form::close() !!}
                            </div>
                        </div>

                    @else
                        <div class="panel shadow">
                            <div class="header">
                                <h2 class="title"><i class="fas fa-plus-circle"></i><strong> Realizar Solicitud</strong></h2>
                            </div>

                            <div class="inside">
                                {!! Form::open(['url' => '/admin/solicitud_refaccion/solicitar', 'files' => true]) !!}
                                    <label for="name"> <strong><sup style="color: red;">(*)</sup> Servicio: </strong></label> 
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-layer-group"></i></span>
                                        <select name="idservice" id="idservice" style="width: 85%" >
                                            @foreach ($services as $s)
                                                <option value=""></option>
                                                <option value="{{$s->id}}">{{$s->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    {!! Form::hidden('route', Route::currentRouteName(), ['class'=>'form-control']) !!}
                                
                                    <label for="name" class="mtop16"> <strong><sup style="color: red;">(*)</sup> Cantidad: </strong></label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                        {!! Form::text('amount', null, ['class'=>'form-control']) !!}
                                    </div>

                                    

                                    {!! Form::submit('Guardar', ['class'=>'btn btn-success mtop16']) !!}
                                {!! Form::close() !!}
                            </div>
                        </div>
                    @endif
                @endif
            </div>

            <div class="col-md-9">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-bed"></i><strong> Solicitudes de Refacciones</strong></h2>
                        
                    </div>

                    <div class="inside">
                        <table id="table-modules" class="table table-bordered table-striped" style="background-color:#EDF4FB;">
                            <thead>
                                <tr>
                                    <td><strong> ID </strong></td>
                                    <td><strong> SOLICITADA </strong></td>
                                    <td><strong> JORNADA </strong></td>
                                    <td><strong> SERVICIO </strong></td>
                                    <td><strong> REFACCIONES</strong></td>
                                    <td><strong> ESTADO </strong></td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($snak_requests as $sr)
                                    <tr>
                                        <td>{{ $sr->id}}</td>
                                        <td>{{ $sr->created_at->format('d-m-Y H:i') }}</td>
                                        <td> Refacción </td>
                                        <td>{{ $sr->service->name }}<br>
                                            {{ $sr->user->ibm.' - '.$sr->user->name.' '.$sr->user->lastname }}
                                        </td>
                                        <td>
                                            Solicitadas: {{ $sr->total_diets }}
                                            <br>
                                            @if($sr->status == '2')
                                                Servidas: {{ $sr->diets_served}}
                                            @endif
                                        </td>
                                        <td>{{ getDietStatusArray(null, $sr->status) }}</td>
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
