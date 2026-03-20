<?php set_time_limit(0);
ini_set("memory_limit",-1);
ini_set('max_execution_time', 0); ?>
@extends('admin.master')
@section('title','Solicitud de Dietas')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/diet_requests') }}" class="nav-link"><i class="fas fa-file-alt"></i> Solicitudes de Dietas</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="panel shadow">

        <div class="header">
                <h2 class="title"><i class="fas fa-file-alt"></i> <strong> Solicitudes de Dietas</strong></h2>
                <ul>
                    <li>
                        <a href="#"><i class="fas fa-chevron-down"></i> Filtar</a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{url('/admin/solicitud_dietas/1')}}"><i class="fas fa-check-circle"></i> Registradas</a></li>
                            <li><a href="{{url('/admin/solicitud_dietas/2')}}"><i class="fas fa-check-circle"></i> Servidas</a></li>
                            <li><a href="{{url('/admin/solicitud_dietas/anuladas')}}"><i class="fas fa-trash-alt"></i> Anuladas</a></li>
                            <li><a href="{{url('/admin/solicitud_dietas/todas')}}"><i class="fas fa-boxes"></i> Todas</a></li>
                        </ul>
                    </li>
                    @if(kvfj(Auth::user()->permissions, 'diet_request_print_journey'))
                        <li>
                            <a href="#" data-action="impresion_lote" data-path="admin/solicitud_dieta" class="btn-deleted" data-toogle="tooltrip" data-placement="top"><i class="fas fa-file-invoice"></i> Impresión por Lote</a>
                        </li>
                    @endif
                    @if(kvfj(Auth::user()->permissions, 'diet_request_print_journey'))
                        <li>
                            <a href="#" data-action="impresion_cocineta" data-path="admin/solicitud_dieta" class="btn-deleted" data-toogle="tooltrip" data-placement="top"><i class="fas fa-file-invoice"></i> Impresión Cocinetas</a>
                        </li>
                    @endif


                    @if(kvfj(Auth::user()->permissions, 'diet_request_add'))
                        <li>
                            <a href="{{ url('/admin/solicitud_dieta/solicitar') }}" ><i class="fas fa-plus-circle"></i> Nueva Solicitud</a>
                        </li>
                    @endif
                </ul>
            </div>

            <div class="inside">
                <table id="table-modules" class="table table-striped table-hover mtop16">
                    <thead>
                        <tr>
                            <td><strong> OPCIONES </strong></td>
                            <td><strong> NO. </strong></td>
                            <td><strong> SOLICITADA </strong></td>
                            <td><strong> JORNADA </strong></td>
                            <td><strong> SERVICIO </strong></td>
                            <td><strong> DIETAS</strong></td>
                            <td><strong> ESTADO </strong></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($diet_requests as $dr)
                            <tr>
                                <td>
                                    <div class="opts">
                                        @if(kvfj(Auth::user()->permissions, 'diet_request_view') && $dr->status != '3')
                                            <a href="{{ url('/admin/solicitud_dieta/'.$dr->id.'/detalles') }}" data-toogle="tooltrip" data-placement="top" title="Ver Detalles"><i class="fas fa-eye"></i></a>
                                        @endif
                                        @if(kvfj(Auth::user()->permissions, 'diet_request_print') && $dr->status != '2' && $dr->status != '3')
                                            <a href="{{ url('/admin/solicitud_dieta/'.$dr->id.'/imprimir') }}" target="_blank" data-toogle="tooltrip" data-placement="top" title="Generar PDF"><i class="fas fa-file-pdf"></i></a>
                                        @endif
                                        @if(kvfj(Auth::user()->permissions, 'diet_request_served') && $dr->status != '2' && $dr->status != '3')
                                            <a href="#" data-action="servida" data-servicio="{{ $dr->service->name  }}" data-dietas="{{ $dr->total_diets }}" data-path="admin/solicitud_dieta" data-object="{{ $dr->id }}" class="btn-deleted" data-toogle="tooltrip" data-placement="top" title="Dietas Servidas" ><i class="fas fa-clipboard-check"></i></a>
                                        @endif
                                        @if(kvfj(Auth::user()->permissions, 'diet_request_change_diets_served') && $dr->status == '2')
                                            <a href="#" data-action="cambio_dietas_servidas" data-path="admin/solicitud_dieta" data-dietas-served="{{ $dr->diets_served }}" data-object="{{ $dr->id }}" class="btn-deleted" data-toogle="tooltrip" data-placement="top" title="Cambiar Dietas Servidas" ><i class="fas fa-file-pen"></i></a>
                                        @endif
                                        @if(kvfj(Auth::user()->permissions, 'diet_request_delete') && $dr->status != '2' && $dr->status != '3')
                                            <a href="#" data-action="anular" data-path="admin/solicitud_dieta" data-object="{{ $dr->id }}" class="btn-deleted" data-toogle="tooltrip" data-placement="top" title="Anular Solicitud" ><i class="fas fa-trash-alt"></i></a>
                                        @endif
                                    </div>
                                </td>
                                <td>{{ $dr->id }}</td>
                                <td>{{ $dr->created_at->format('d-m-Y H:i') }}</td>
                                <td>
                                    @if($dr->idjourney == 4)
                                        Refacción
                                    @else
                                        {{ $dr->journey->name }}
                                    @endif
                                    
                                </td>
                                <td>{{ $dr->service->name }}<br>
                                    {{ $dr->user->ibm.' - '.$dr->user->name.' '.$dr->user->lastname }}
                                </td>
                                <td>
                                    Solicitadas: {{ $dr->total_diets }}
                                    <br>
                                    @if($dr->status == '2')
                                        Servidas: {{ $dr->diets_served}}
                                    @endif
                                </td>
                                <td>{{ getDietStatusArray(null, $dr->status) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
