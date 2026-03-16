@extends('admin.master')
@section('title','Municipios del País')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/municipalities') }}" class="nav-link"><i class="fas fa-globe-americas"></i> Municipios del País</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="panel shadow">

            <div class="header">
                <h2 class="title"><i class="fas fa-globe-americas"></i> <strong>Municipios del País</strong> </h2>
            </div>

            <div class="inside">
                
                <table id="table-modules" class="table table-striped table-hover">
                    <thead>
                        <tr> 
                            <td><strong>CODIGO</strong></td>
                            <td><strong>MUNICIPIO</strong></td>
                            <td><strong>DEPARTAMENTO</strong></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($municipalities as $m)
                            <tr>
                                <td>{{$m->code}}</td>
                                <td>{{$m->name}}</td>
                                <td>{{$m->department }}</td>
                            </tr>
                        @endforeach             
                    </tbody>
                </table>
            </div>

        </div>
    </div>

@endsection