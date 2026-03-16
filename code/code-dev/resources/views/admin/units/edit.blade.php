@extends('admin.master')
@section('title','Categorías')

@section('breadcrumb')
    <li class="breadcrumb-item">
    <a href="{{ url('/admin/units/0') }}" class="nav-link"><i class="fas fa-hospital-user"></i> Unidades</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-5">
                <div class="panel shadow">

                    <div class="header">
                        <h2 class="title"><i class="fas fa-edit"></i><strong> Editar Unidad</strong></h2>
                    </div>

                    <div class="inside"> 
                        {!! Form::open(['url' => '/admin/unit/'.$unit->id.'/edit', 'files' => true]) !!}
                                <label for="name"><strong>Nombre de Unidad:</strong></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::text('name', $unit->name, ['class'=>'form-control']) !!}
                                </div>

                                <label for="code" class="mtop16"><strong>Código Administrativo:</strong></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::text('code', $unit->code, ['class'=>'form-control']) !!}
                                </div>

                                <label for="phone" class="mtop16"><strong>PBX de Unidad:</strong></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::text('phone', $unit->phone, ['class'=>'form-control']) !!}
                                </div>

                                <label for="address" class="mtop16"><strong>Dirección:</strong></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::text('address', $unit->address, ['class'=>'form-control']) !!}
                                </div>

                                <label for="municipality_id"  class="mtop16"><strong>Municipio de Ubicación:</strong></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-layer-group"></i></span>
                                    {!! Form::select('municipality_id', $municipalities,$unit->municipality_id,['class'=>'form-select']) !!}
                                </div>

                                <label for="type_unit" class="mtop16"><strong>Tipo de Unidad:</strong></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-layer-group"></i></span>
                                    {!! Form::select('type', getUnitsArray(),$unit->type_unit,['class'=>'form-select']) !!}
                                </div>
                                
                            {!! Form::submit('Guardar', ['class'=>'btn btn-success mtop16']) !!}

                        {!! Form::close() !!}
                    </div>

                </div>
            </div>
        </div>

        
    </div>

@endsection