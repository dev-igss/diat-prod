@extends('admin.master')
@section('title','Dashboard')

@section('content')
    <div class="container-fluid">
        @if(kvfj(Auth::user()->permissions, 'dashboard_small_stats'))
            <div class="panel shadow">
                <div class="header">
                    <h2 class="title"><i class="fas fa-chart-bar"></i> Estadísticas Rápidas</h2>
                </div>
            </div>

            <div class="row mtop16">
                

                
            </div>
        @endif
    </div>

@endsection