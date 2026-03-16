@extends('admin.master')
@section('title','Detalles de Solicitud')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/diet_requests/0') }}" class="nav-link"><i class="fas fa-server"></i> Solicitud de Dietas</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/diet_request/view') }}" class="nav-link"><i class="fas fa-plus-circle"></i> Detalles de Solicitud</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="panel shadow">

            <div class="header">
                <h2 class="title"><i class="fas fa-clipboard-list"></i> <strong> Detalle de la Solicitud</strong></h2>
                <ul>
                    @if(kvfj(Auth::user()->permissions, 'diet_request_served') && $diet_request->status != '2')
                        <a href="#" data-action="servida" data-path="admin/solicitud_dieta" data-object="{{ $diet_request->id }}" class="btn-deleted" data-toogle="tooltrip" data-placement="top" title="Dietas Servidas" ><i class="fas fa-clipboard-check"></i> Dietas Servidas</a>
                    @endif
                    @if(kvfj(Auth::user()->permissions, 'diet_request_print'))
                        <li>
                            <a href="{{ url('/admin/solicitud_dieta/'.$diet_request->id.'/imprimir') }}" target="_blank"><i class="fa fa-print"></i> Imprimir</a>
                        </li>
                    @endif
                </ul>
            </div>

            <div class="inside">

                <div class="row">
                    <div class="col-md-12">
                        <label for="idsupplier"><strong>Jornada:</strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-layer-group"></i></span>
                            @if($diet_request->idjourney == 4)
                                {!! Form::text('no_doc', 'Refacción', ['class'=>'form-control', 'readonly']) !!}
                            @else
                                {!! Form::text('no_doc', $diet_request->journey->name, ['class'=>'form-control', 'readonly']) !!}
                            @endif
                        </div>
                    </div>

                    <div class="col-md-4 mtop16">
                        <label for="type_doc"><strong>Servicio Solicitante:</strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-layer-group"></i></span>
                            {!! Form::text('no_doc', $diet_request->service->name, ['class'=>'form-control', 'readonly']) !!}

                        </div>
                    </div>

                    <div class="col-md-4 mtop16">
                        <label for="name"><strong>Solicitado Por:</strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::text('no_doc',' IBM: '.$diet_request->user->ibm.' - '.$diet_request->user->name.' '.$diet_request->user->lastname, ['class'=>'form-control', 'readonly']) !!}
                        </div>
                    </div>

                    <div class="col-md-4 mtop16">
                        <label for="name"><strong>Fecha y Hora Solicitud:</strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::text('no_doc',$diet_request->created_at, ['class'=>'form-control', 'readonly']) !!}
                        </div>
                    </div>
                </div>


                    <div class="row mtop16">
                        <div class="col-md-4 ">
                            <label for="type_doc"><strong>Estado de Solicitud:</strong></label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-layer-group"></i></span>
                                {!! Form::text('no_doc', getDietStatusArray(null, $diet_request->status), ['class'=>'form-control', 'readonly']) !!}

                            </div>
                        </div>
                        @if($diet_request->status == '2')
                            <div class="col-md-4 ">
                                <label for="type_doc"><strong>Servida Por:</strong></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-layer-group"></i></span>
                                    {!! Form::text('no_doc', $diet_request->user_served->ibm.' - '.$diet_request->user_served->name.' '.$diet_request->user_served->lastname, ['class'=>'form-control', 'readonly']) !!}

                                </div>
                            </div>

                            <div class="col-md-4 ">
                                <label for="name"><strong>Dietas Servidas:</strong></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::text('no_doc',$diet_request->diets_served, ['class'=>'form-control', 'readonly']) !!}
                                </div>
                            </div>
                        @endif
                    </div>



                <div class="row">
                    <div class="col-md-12 mtop16">

                        <table class="table table-striped table-hover" style="text-align: center;">
                            <thead>
                                <tr>
                                    <th rowspan="2"><strong> DIETA </strong></th>
                                    <th rowspan="2"><strong> CAMA </strong></th>
                                    <th colspan="5"><strong> CARACTERISTICAS</strong></th>
                                </tr>
                                <tr>
                                    <th>No. 1</th>
                                    <th>No. 2</th>
                                    <th>No. 3</th>
                                    <th>No. 4</th>
                                    <th>No. 5</th>
                                    <th>No. 6</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($details as $detail)
                                    <tr>
                                        <th>{{ $detail->diet->name }}</th>
                                        <th>{{ $detail->bed_number }}</th>
                                        <th>{{ getTypeDiet(null, $detail->type_pack) }}</th>
                                        <th>{{ getTypeDiet1(null, $detail->type_diet_1) }}</th>
                                        <th>{{ getTypeDietHiposodicas(null, $detail->type_diet_hiposodicas) }}</th>
                                        <th>{{ getTypeDietRenal(null, $detail->type_diet_renal) }}</th>
                                        <th>{{ getTypeDietDeViaje(null, $detail->type_diet_de_viaje) }}</th>
                                        <th>{{ getTypeDietDeViaje(null, $detail->type_diet_de_viaje) }}</th>
                                    </tr>

                                @endforeach
                                <tr>
                                    <td colspan="7"></td>
                                    <td><strong>TOTAL DIETAS: </strong>{{ $diet_request->total_diets }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
