@extends('admin.master')
@section('title','Categorías')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/diets') }}" class="nav-link"><i class="fas fa-utensils"></i> Dietas</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-5">
                <div class="panel shadow">

                    <div class="header">
                        <h2 class="title"><i class="fas fa-edit"></i> <strong> Editar Dieta</strong></h2>
                    </div>

                    <div class="inside">
                        {!! Form::open(['url' => '/admin/dieta/'.$diet->id.'/editar']) !!}
                                <label for="name"><strong>Nombre:</strong></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::text('name', $diet->name, ['class'=>'form-control']) !!}
                                </div>

                            {!! Form::submit('Guardar', ['class'=>'btn btn-success mtop16']) !!}

                        {!! Form::close() !!}
                    </div>

                </div>
            </div>
        </div>

        
    </div>

@endsection