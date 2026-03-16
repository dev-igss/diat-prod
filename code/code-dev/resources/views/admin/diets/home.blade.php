@extends('admin.master')
@section('title','Dietas')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/diets') }}" class="nav-link"><i class="fas fa-utensils"></i> Dietas</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-5">
                @if(kvfj(Auth::user()->permissions, 'diet_add'))
                    <div class="panel shadow">
                        <div class="header">
                            <h2 class="title"><i class="fas fa-plus-circle"></i> <strong> Agregar Dieta</strong></h2>
                        </div>

                        <div class="inside">
                                {!! Form::open(['url' => '/admin/dieta/agregar']) !!}
                                    <label for="name"><strong>Nombre:</strong></label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                        {!! Form::text('name', null, ['class'=>'form-control']) !!}
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
                        <h2 class="title"><i class="fas fa-utensils"></i> <strong> Dietas</strong></a>
                    </div>

                    <div class="inside">
                        <table id="table-modules" class="table table-striped table-hover mtop16">
                            <thead>
                                <tr>
                                    <td width="140px"><strong>OPCIONES</strong></td>
                                    <td width="48px"><strong>NOMBRE</strong></td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($diets as $d)
                                    <tr>
                                        <td>
                                        <div width="48" class="opts">
                                            @if(kvfj(Auth::user()->permissions, 'diet_edit'))
                                                <a href="{{ url('/admin/dieta/'.$d->id.'/editar') }}" data-toogle="tooltrip" data-placement="top" title="Editar"><i class="fas fa-edit"></i></a>
                                            @endif
                                            @if(kvfj(Auth::user()->permissions, 'diet_delete'))
                                                <a href="{{ url('/admin/dieta/'.$d->id.'/borrar') }}" data-toogle="tooltrip" data-placement="top" title="Eliminar"><i class="fas fa-trash-alt"></i></a>
                                            @endif
                                        </div>
                                        </td>
                                        <td width="200">{{ $d->name }}</td>
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