@extends('admin.master')
@section('title','Generar Reportes')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/diet_requests') }}" class="nav-link"><i class="fas fa-file-excel"></i> Generar Reportes</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-file-excel"></i> <strong> Generar Reportes</strong></h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mtop16">
                @if(kvfj(Auth::user()->permissions, 'report_day'))
                    <div class="col-md-4">
                        <div class="panel shadow">
                            <div class="header">
                                <h2 class="title"><i class="fas fa-file-excel"></i> <strong> Reporte del Día</strong></h2>
                            </div>

                            {!! Form::open(['url' => '/admin/reporte/reporte_del_dia', 'files' => true]) !!}
                                <div class="inside">
                                    <label for="name"><strong>Seleccione la fecha: </strong></label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                        {!! Form::date('date_in', Carbon\Carbon::today()->format('Y-m-d'), ['class'=>'form-control']) !!}
                                        

                                    </div>

                                </div>

                                <div class=" col-md-6 " >
                                    <div class="form-group">
                                        <input name="_token" value="{{ csrf_token() }}" type="hidden"></input>
                                        <button class="btn btn-primary" type="submit"> Generar </button>
                                    </div>
                                </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                @endif

                @if(kvfj(Auth::user()->permissions, 'report_week'))
                    <div class="col-md-4">
                        <div class="panel shadow">
                            <div class="header">
                                <h2 class="title"><i class="fas fa-file-excel"></i> <strong> Reporte de la Semana</strong></h2>
                            </div>

                            {!! Form::open(['url' => '/admin/reporte/reporte_de_la_semana', 'files' => true]) !!}
                                <div class="inside">
                                    <label for="name"><strong>Seleccione el mes: </strong></label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                        {!! Form::select('week_in', getMonths('list', null),0,['class'=>'form-select' ]) !!}                                        
                                    </div>

                                </div>

                                <div class=" col-md-6 " >
                                    <div class="form-group">
                                        <input name="_token" value="{{ csrf_token() }}" type="hidden"></input>
                                        <button class="btn btn-primary" type="submit"> Generar </button>
                                    </div>
                                </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                @endif

                @if(kvfj(Auth::user()->permissions, 'report_month'))
                    <div class="col-md-4">
                        <div class="panel shadow">
                            <div class="header">
                                <h2 class="title"><i class="fas fa-file-excel"></i> <strong> Reporte del Mes</strong></h2>
                            </div>

                            {!! Form::open(['url' => '/admin/reporte/reporte_del_mes', 'files' => true]) !!}
                                <div class="inside">
                                    <label for="name"><strong>Seleccione el mes: </strong></label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                        {!! Form::select('month_in', getMonths('list', null),0,['class'=>'form-select' ]) !!}                                        
                                    </div>

                                </div>

                                <div class=" col-md-6 " >
                                    <div class="form-group">
                                        <input name="_token" value="{{ csrf_token() }}" type="hidden"></input>
                                        <button class="btn btn-primary" type="submit"> Generar </button>
                                    </div>
                                </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                @endif

                
            </div>
                    

    </div>
@endsection
