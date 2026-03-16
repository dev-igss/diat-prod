@extends('admin.master')
@section('title','Reportes')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/reports') }}" class="nav-link"><i class="fas fa-file-excel"></i> Reportes </a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="panel shadow">

            <div class="header">
                <h2 class="title"><i class="fas fa-file-excel"></i> Reportes</h2>
            </div>

            <div class="inside">
                
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <td>GENERAR</td>
                            <td>TIPO DE REPORTE</td>
                        </tr>
                    </thead>
                    <tbody>
                        @if(kvfj(Auth::user()->permissions, 'report_bitacora'))
                            <tr>
                                <td>
                                    <a href="{{ url('/admin/report_bitacora') }}" data-toogle="tooltrip" data-placement="top" title="Generar"><i class="fas fa-print"></i></a>
                                </td>
                                <td>Archivo .pdf con la bitacora del sistema</td>
                            </tr>
                        @endif

                        @if(kvfj(Auth::user()->permissions, 'report_user'))
                            <tr>
                                <td>
                                    <a href="{{ url('/admin/report_listado_extensiones') }}" data-toogle="tooltrip" data-placement="top" title="Generar"><i class="fas fa-print"></i></a>
                                </td>
                                <td>Listado de extensiones telefonicas - Archivo .pdf</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

        </div>
    </div>

@endsection