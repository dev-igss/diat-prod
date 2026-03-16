@extends('admin.master')
@section('title','Categorías')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/journeys') }}" class="nav-link"><i class="fas fa-clock"></i> Jornadas</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-5">
                <div class="panel shadow">

                    <div class="header">
                        <h2 class="title"><i class="fas fa-edit"></i> <strong> Editar Jornada</strong></h2>
                    </div>

                    <div class="inside">
                        {!! Form::open(['url' => '/admin/jornada/'.$journey->id.'/editar']) !!}
                                <label for="name"><strong>Nombre:</strong></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::text('name', $journey->name, ['class'=>'form-control']) !!}
                                </div>

                                <label for="unit_id"  class="mtop16"><strong>Hora de Inicio:</strong></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {{ Form::time('start_time', $journey->start_time, ['class'=>'form-input']) }}
                                </div>

                                <label for="unit_id"  class="mtop16"><strong>Hora de Finalización:</strong></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {{ Form::time('end_time', $journey->end_time, ['class'=>'form-input']) }}
                                </div>

                            {!! Form::submit('Guardar', ['class'=>'btn btn-success mtop16']) !!}

                        {!! Form::close() !!}
                    </div>

                </div>
            </div>
        </div>

        
    </div>

@endsection