<div class="sidebar shadow">
    <div class="section-top">
        <div class="logo">
            <img src="{{url('static/imagenes/Isotipo.png')}}" class="img-fluid">
        </div>

        <div class="user">
            <span class="subtitle">Bienvenido: {{ Auth::user()->name }} {{ Auth::user()->lastname }}</span> <br>
            <span class="subtitle">IBM: {{ Auth::user()->ibm }} </span>
            <div class="salir">
                Salir
                <a href="{{url('/logout')}}" data-toogle="tooltrip" data-placement="top" title="Salir">
                    <i class="fas fa-sign-out-alt"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="main">
        <ul>

            @if(kvfj(Auth::user()->permissions, 'dashboard'))
                <li>
                    <a href="{{ url('/admin') }}" class="lk-dashboard"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                </li>
            @endif

            @if(kvfj(Auth::user()->permissions, 'municipalities'))
                <li>
                    <a href="{{ url('admin/municipios') }}" class="lk-municipalities"><i class="fas fa-globe-americas"></i> Municipios</a>
                </li>
            @endif

            @if(kvfj(Auth::user()->permissions, 'units'))
                <li>
                    <a href="{{ url('admin/unidades') }}" class="lk-units lk-unit_add lk-unit_edit lk-unit_delete"><i class="fas fa-hospital-alt"></i> Unidades</a>
                </li>
            @endif

            @if(kvfj(Auth::user()->permissions, 'reports'))
                <li>
                    <a href="{{ url('/admin/reportes') }}" class="lk-reports "><i class="fas fa-file-excel"></i> Reportes</a>
                </li>
            @endif

            @if(kvfj(Auth::user()->permissions, 'diet_requests'))
                <li>
                    <a href="{{ url('/admin/solicitud_dietas/1') }}" class="lk-diet_requests lk-diet_request_add lk-diet_request_view lk-diet_request_delete lk-diet_request_served lk-diet_request_change_diets_served lk-diet_request_report"><i class="fas fa-receipt"></i> Solicitud de Dietas</a>
                </li>
            @endif

            @if(kvfj(Auth::user()->permissions, 'snak_requests'))
                <li>
                    <a href="{{ url('/admin/solicitud_refacciones') }}" class="lk-snak_requests lk-snak_request_add"><i class="fas fa-receipt"></i> Solicitud de Refacciones</a>
                </li>
            @endif

            @if(kvfj(Auth::user()->permissions, 'serviceg_list'))
                <li>
                    <a href="{{ url('/admin/servicios_general') }}" class="lk-serviceg_list lk-serviceg_add lk-serviceg_edit  lk-service_list lk-service_add lk-service_edit"><i class="fas fa-bed"></i>Servicios</a>
                </li>
            @endif

            @if(kvfj(Auth::user()->permissions, 'journeys'))
                <li>
                    <a href="{{ url('/admin/jornadas') }}" class="lk-journeys lk-journey_add lk-journey_edit lk-journey_delete"><i class="fas fa-clock"></i> Jornadas</a>
                </li>
            @endif

            @if(kvfj(Auth::user()->permissions, 'diets'))
                <li>
                    <a href="{{ url('/admin/dietas') }}" class="lk-diets lk-diet_add lk-diet_edit lk-diet_delete"><i class="fas fa-utensils"></i> Dietas</a>
                </li>
            @endif

            <!--@if(kvfj(Auth::user()->permissions, 'reports'))
                <li>
                    <a href="{{ url('/admin/reports') }}" class="lk-reports lk-report_informatica lk-report_user lk-report_bitacora "><i class="fas fa-file-pdf"></i> Reportes</a>
                </li>
            @endif -->

            @if(kvfj(Auth::user()->permissions, 'bitacoras'))
                <li>
                    <a href="{{ url('/admin/bitacoras') }}" class="lk-bitacoras "><i class="fas fa-clipboard-list"></i> Bitacoras</a>
                </li>
            @endif

            @if(kvfj(Auth::user()->permissions, 'user_list'))
                <li>
                    <a href="{{ url('/admin/usuarios') }}" class="lk-user_add lk-user_list lk-user_edit lk-user_permissions lk-user_requests_out lk-user_assignments"><i class="fas fa-user-lock"></i> Usuarios</a>
                </li>
            @endif

            @if(kvfj(Auth::user()->permissions, 'user_info'))
                <li>
                    <a href="{{ url('/admin/usuario/cuenta/informacion') }}" class="lk-user_add lk-user_list lk-user_edit lk-user_permissions lk-user_assignments lk-user_info lk-user_change_password"><i class="fas fa-id-card"></i> Información de Cuenta</a>
                </li>
            @endif
        </ul>
    </div>

</div>
