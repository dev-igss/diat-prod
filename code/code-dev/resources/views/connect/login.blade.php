@extends('connect.master')

@section('title','Inicio de Sesión')

@section('content')
    <div class="box box_login shadow">

        <div class="header">
            <a href="{{url('/')}}">
                <img src="{{url('/static/imagenes/igss.png')}}" alt="">
            </a>
        </div>

        <div class="inside">
            {!! Form::open(['url' => '/inicio_sesion']) !!}

            <label for="ibm"><strong>IBM:</strong></label>
            <div class="input-group">
                <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-address-card"></i></div>
                </div>
                {!! Form::text('ibm', null, ['class' => 'form-control'])!!}
            </div>

            <label for="password" class="mtop16"><strong>Contraseña:</strong></label>
            <div class="input-group">
                <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-lock"></i></div>
                </div>
                {!! Form::password('password', ['class' => 'form-control'])!!}
            </div>

            {!! Form::submit('Ingresar', ['class' => 'btn btn-success mtop16']) !!}
            {!! Form::close() !!}

            @if(Session::has('message'))
                <div class="container">
                    <div class="mtop16 alert alert-{{ Session::get('typealert') }}" style="display:none;">
                        {{ Session::get('message') }}
                        @if( $errors->any() )
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        <script>
                            $('.alert').slideDown();
                            setTimeout(function(){ $('.alert').slideUp(); },10000);
                        </script>
                    </div>
                </div>
            @endif

            <div class="footer mtop16">
                <!-- <a href="{{url('/recover')}}">Recuperar Contraseña</a> -->
            </div>
        </div>

        
    </div>
@stop