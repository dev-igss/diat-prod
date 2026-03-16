@extends('admin.master')
@section('title','Reportes')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/reports') }}" class="nav-link"><i class="fas fa-file-excel"></i> Reportes </a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="page_user">
            <div class="row">
                <div class="col-md-4">
                    <div class="panel shadow mtop32">
                        <div class="header">
                            <h2 class="title"><i class="fas fa-file-excel"></i> Imprimir Lote de Solicitudes</h2>
                        </div>
                        <div class="inside">
                            {!! Form::open(['url' => '/admin/report/batch_printing']) !!}
    
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="name"><strong>Fecha a Imprimir:</strong></label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                            {{ Form::date('date', null, ['class' => 'form-control']) }}
                                        </div>
                                    </div>
                                </div>

                                <div class="row mtop16">
                                    <div class="col-md-12">
                                        <label for="name"><strong>Jornada de Dietas:</strong></label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                            {!! Form::select('type', getTypeDietArray('list', null),null,['class'=>'form-select']) !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="row mtop16">
                                    <div class="col-md-12">
                                        {!! Form::submit('Generar', ['class' => 'btn btn-primary']) !!}
                                    </div>
                                </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>    
                
                <div class="col-md-4">
                    <div class="panel shadow mtop32">
                        <div class="header">
                            <h2 class="title"><i class="fas fa-file-excel"></i> Generar Matriz</h2>
                        </div>
                        <div class="inside">
                            {!! Form::open(['url' => '/admin/report/headquarters_diets']) !!}
    
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="name"><strong>Desde:</strong></label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                            {{ Form::date('date_from', null, ['class' => 'form-control']) }}
                                        </div>
                                    </div>
                                </div>

                                <div class="row mtop16">
                                    <div class="col-md-12">
                                        <label for="name"><strong>Hasta:</strong></label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                            {{ Form::date('date_to', null, ['class' => 'form-control']) }}
                                        </div>
                                    </div>
                                </div>

                                <div class="row mtop16">
                                    <div class="col-md-12">
                                        {!! Form::submit('Generar', ['class' => 'btn btn-primary']) !!}
                                    </div>
                                </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div> 

            </div>
        </div>        
    </div>

@endsection