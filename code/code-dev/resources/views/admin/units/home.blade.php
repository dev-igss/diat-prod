@extends('admin.master')
@section('title','Unidades')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/units/0') }}" class="nav-link"><i class="fas fa-hospital-user"></i> Unidades</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">        
        <div class="row">
            <div class="col-md-4">
                @if(kvfj(Auth::user()->permissions, 'unit_add'))
                    <div class="panel shadow">
                        <div class="header">
                            <h2 class="title"><i class="fas fa-plus-circle"></i> <strong> Agregar Unidad</strong></h2>
                        </div>

                        <div class="inside">
                            {!! Form::open(['url' => '/admin/unidad/agregar', 'files' => true]) !!}
                                <label for="name"><strong>Nombre de Unidad:</strong></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::text('name', null, ['class'=>'form-control']) !!}
                                </div>

                                <label for="code" class="mtop16"><strong>Código Administrativo:</strong></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::text('code', null, ['class'=>'form-control']) !!}
                                </div>

                                <label for="municipality_id"  class="mtop16"><strong>Municipio de Ubicación:</strong></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-layer-group"></i></span>
                                    <select name="municipality_id" id="idsupplier" style="width: 90%" >
                                        @foreach ($municipalities as $m)
                                            <option value=""></option>
                                            <option value="{{$m->id}}">{{$m->code.' - '.$m->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                {!! Form::submit('Guardar', ['class'=>'btn btn-success mtop16']) !!}
                            {!! Form::close() !!}                            
                        </div>
                    </div>
                @endif
            </div>
            
            <div class="col-md-8">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-hospital-user"></i><strong> Unidades Hospitalarias o Departamentales</strong></a>
                    </div>

                    <div class="inside">
                        <table class="table table-striped table-hover mtop16" id="table-modules">
                            <thead>
                                <tr> 
                                    <td width="140px"><strong>OPCIONES</strong></td>
                                    <td><strong>NOMBRE</strong></td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($units as $unit)
                                    @if(Auth::user()->role == "0" )
                                        <tr>
                                            <td>
                                            <div class="opts">
                                                @if(kvfj(Auth::user()->permissions, 'unit_edit'))
                                                    <a href="{{ url('/admin/unidad/'.$unit->id.'/editar') }}" data-toogle="tooltrip" data-placement="top" title="Editar"><i class="fas fa-edit"></i></a>
                                                @endif
                                                @if(kvfj(Auth::user()->permissions, 'unit_delete'))
                                                    <a href="{{ url('/admin/unidad/'.$unit->id.'/borrar') }}" data-toogle="tooltrip" data-placement="top" title="Eliminar"><i class="fas fa-trash-alt"></i></a>
                                                @endif
                                            </div>
                                            </td>
                                            <td>{{ $unit->name }}</td>
                                        </tr>
                                    @else
                                        @foreach($assig_unit as $au)
                                            @if($au->user_id == Auth::user()->id && $au->unit_id == $unit->id)
                                                <tr>
                                                    <td>
                                                        <div class="opts">
                                                            @if(kvfj(Auth::user()->permissions, 'unit_edit'))
                                                                <a href="{{ url('/admin/unidad/'.$unit->id.'/editar') }}" data-toogle="tooltrip" data-placement="top" title="Editar"><i class="fas fa-edit"></i></a>
                                                            @endif
                                                            @if(kvfj(Auth::user()->permissions, 'unit_delete'))
                                                                <a href="{{ url('/admin/unidad/'.$unit->id.'/borrar') }}" data-toogle="tooltrip" data-placement="top" title="Eliminar"><i class="fas fa-trash-alt"></i></a>
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td>{{ $unit->name }}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>        
    </div>
@endsection