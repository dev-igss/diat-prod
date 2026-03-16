<?php
    function getUnitsArray(){
        $a = [
            '0' => 'Unidad Hospitalaria',
            '1' => 'Unidad Departamental'
        ];

        return $a;
    }

    function getRoleUserArray($mode, $id){
        $roles = [
            '0' => 'Administrador del Sistema',
            '1' => 'Administrador de Unidad',
            '2' => 'Jefe de Alimentacion',
            '3' => 'Encargado de Dietistas', 
            '4' => 'Dietista',
            '5' => 'Jefe de Servicio'
        ];
 
        if(!is_null($mode)):
            return $roles;
        else:
            return $roles[$id];
        endif;
    }

    function getDietStatusArray($mode, $id){
        $roles = [
            '0' => 'Pre-Solicitud',
            '1' => 'Registrada',
            '2' => 'Servida',
            '3' => 'Anulada'
        ];

        if(!is_null($mode)):
            return $roles;
        else:
            return $roles[$id];
        endif;
    }

    function getTypeDiet($mode, $id){
        $roles = [
            '0' => 'Sin Selección',
            '1' => 'Ingreso',
            '2' => 'Egreso',
            '3' => 'Empacada',
            '4' => 'Ingreso/Empacada',
            '5' => 'Egreso/Empacada',
        ];

        if(!is_null($mode)):
            return $roles;
        else:
            return $roles[$id];
        endif;
    }

    function getTypeDiet1($mode, $id){
        $roles = [
            '0' => 'Sin Selección',
            '1' => 'Diabetica',
            '2' => 'Hiposodica',
            '3' => 'Diabetica/Hiposodica',
            '4' => 'Sin Lacteos'
        ];

        if(!is_null($mode)):
            return $roles;
        else:
            return $roles[$id];
        endif;
    }

    function getTypeDietHiposodicas($mode, $id){
        $roles = [
            '0' => 'Sin Selección',
            '1' => 'Baja en Fosforo',
            '2' => 'Alta en Fosforo',
            '3' => 'Baja en Potasio',
            '4' => 'Alta en Potasio'
        ];

        if(!is_null($mode)):
            return $roles;
        else:
            return $roles[$id];
        endif;
    }

    function getTypeDietRenal($mode, $id){
        $roles = [
            '0' => 'Sin Selección',
            '1' => 'Diabetica'
        ];

        if(!is_null($mode)):
            return $roles;
        else:
            return $roles[$id];
        endif;
    }

    function getTypeDietDeViaje($mode, $id){
        $roles = [
            '0' => 'Sin Selección',
            '1' => 'Libre',
            '2' => 'Blanda',
            '3' => 'Diabética',
            '4' => 'Hiposodica',
            '5' => 'Diabética/Hiposodica',
            '6' => 'Papilla',
            '7' => 'Renal'
        ];

        if(!is_null($mode)):
            return $roles;
        else:
            return $roles[$id];
        endif;
    }

    
    function getTypeDietPediatricas($mode, $id){
        $roles = [
            '0' => 'Sin Selección',
            '1' => 'Diabética', 
            '2' => 'Hiposódica',
            '3' => 'Renal',
            '4' => 'Renal Diabética',
            '5' => 'Baja en Purinas',
            '6' => 'Bajo en Fosforo',
            '7' => 'Alto en Fosforo',
            '8' => 'Baja en Potasio',
            '9' => 'Alto en Potasio',
            '10' => 'Celiaca',
            '11' => 'Controlada en Acido Úrico',
            '12' => 'Sin Lácteos',
            '13' => 'Refacciones Extras'
        ];

        if(!is_null($mode)):
            return $roles;
        else:
            return $roles[$id];
        endif;
    }

    function getUserStatusArray($mode, $id){
        $status = [
            '0' => 'Suspendido',
            '1' => 'Activo'
        ];

        if(!is_null($mode)):
            return $status;
        else:
            return $status[$id];
        endif;
    }

    function getTimeRequestsOut($mode, $id){
        $roles = [
            '0' => 'Sin Seleccionar',
            '1' => '5 min.',
            '2' => '10 min.',
            '3' => '15 min.',
            '4' => '20 min.',
            '5' => '25 min.',
            '6' => '30 min.'
        ];

        if(!is_null($mode)):
            return $roles;
        else:
            return $roles[$id];
        endif;
    }

    //Key Value From JSON
    function kvfj($json, $key){
        if($json == null):
            return null;
        else:
            $json = $json;
            $json = json_decode($json, true);

            if(array_key_exists($key, $json)):
                return $json[$key];
            else:
                return null;
            endif;
        endif;
    }

    function user_permissions(){
        $p = [
            'dashboard' => [
                'icon' => '<i class="fas fa-tachometer-alt"></i>',
                'title' => 'Módulo de Dashboard',
                'keys' => [
                    'dashboard' => 'Puede ver el dashboard.',
                    'dashboard_small_stats' => 'Puede ver las estadísticas rápidas.'
                ]
            ],
            'municipalities' => [
                'icon' => '<i class="fas fa-globe-americas"></i>',
                'title' => 'Módulo de Municipios',
                'keys' => [
                    'municipalities' => 'Puede ver el listado de municipios del Pais.'
                ]
            ],
            'units' => [
                'icon' => '<i class="fas fa-hospital-alt"></i>',
                'title' => 'Módulo de Unidades Medicas o Departamentales',
                'keys' => [
                    'units' => 'Puede ver el listado de unidades.',
                    'unit_add' => 'Puede agregar nuevas unidades.',
                    'unit_edit' => 'Puede editar unidades.',
                    'unit_delete' => 'Puede eliminar unidades.',
                    'unit_search' => 'Puede buscar unidades.'
                ]
            ],
            'diets' => [
                'icon' => '<i class="fas fa-utensils"></i>',
                'title' => 'Módulo de Dietas',
                'keys' => [
                    'diets' => 'Puede ver el listado de dietas.',
                    'diet_add' => 'Puede agregar nuevas dietas.',
                    'diet_edit' => 'Puede editar dietas.',
                    'diet_delete' => 'Puede eliminar dietas.'
                ]
            ],
            'services' => [
                'icon' => '<i class="fas fa-laptop-medical"></i>',
                'title' => 'Módulo de Servicios',
                'keys' => [
                    'serviceg_list' => 'Puede ver el listado de servicios general.',
                    'serviceg_add' => 'Puede agregar servicios genereales.',
                    'serviceg_edit' => 'Puede editar servicios generales.',
                    'service_list' => 'Puede ver el listado de servicios .',
                    'service_add' => 'Puede agregar servicios.',
                    'service_edit' => 'Puede editar servicios.'
                ]
            ],
            'journeys' => [
                'icon' => '<i class="fas fa-clock"></i>',
                'title' => 'Módulo de Jornadas',
                'keys' => [
                    'journeys' => 'Puede ver el listado de jornadas.',
                    'journey_add' => 'Puede agregar nuevos jornadas.',
                    'journey_edit' => 'Puede editar jornadas.',
                    'journey_delete' => 'Puede eliminar jornadas.'
                ]
            ],
            'diet_request' => [
                'icon' => '<i class="fas fa-file-alt"></i>',
                'title' => 'Módulo de Solicitudes de Dietas',
                'keys' => [
                    'diet_requests' => 'Puede ver el listado de solicitudes de dietas.',
                    'diet_request_add' => 'Puede agregar nuevas solicitudes de dietas.',
                    'diet_request_view' => 'Puede ver el detalle de solicitudes de dietas.',
                    'diet_request_print' => 'Puede imprimir solicitudes de dietas.',
                    'diet_request_print_journey' => 'Puede imprimir solicitudes de dietas por jornada.',
                    'diet_request_served' => 'Puede marcar como servidas las solicitudes de dietas.',
                    'diet_request_change_diets_served' => 'Puede modificar la cantidad de dietas servidas.',
                    'diet_request_delete' => 'Puede eliminar solicitudes de dietas.'
                ]
            ],
            'reports' => [
                'icon' => '<i class="fas fa-file-excel"></i>',
                'title' => 'Módulo de Reportes',
                'keys' => [
                    'reports' => 'Puede generar reportes.',
                    'report_day' => 'Puede generar reporte por día.',
                    'report_month' => 'Puede generar reporte por mes.'
                 ]
            ],
            'snak_request' => [
                'icon' => '<i class="fas fa-file-alt"></i>',
                'title' => 'Módulo de Solicitudes de Refacciones',
                'keys' => [
                    'snak_requests' => 'Puede ver el listado de solicitudes de refacciones.',
                    'snak_request_add' => 'Puede agregar nuevas solicitudes de refacciones.'
                ]
            ],
            'bitacoras' => [
                'icon' => '<i class="fas fa-clipboard-list"></i> ',
                'title' => 'Módulo de Bitacoras',
                'keys' => [
                    'bitacoras' => 'Puede ver el listado de bitacoras.'
                ]
            ],
            'users' => [
                'icon' => '<i class="fas fa-user-lock"></i> ',
                'title' => 'Módulo de Usuarios',
                'keys' => [
                    'user_list' => 'Puede ver el listado de usuarios.',
                    'user_add' => 'Puede agregar nuevos usuarios.',
                    'user_edit' => 'Puede editar usuarios.',
                    'user_search' => 'Puede buscar usuarios.',
                    'user_banned' => 'Puede suspender usuarios.',
                    'user_delete' => 'Puede eliminar usuarios.',
                    'user_reset_password' => 'Puede restablecer contraseña de usuarios.',
                    'user_permissions' => 'Puede administrar los permisos de los usuarios.',
                    'user_requests_out' => 'Puede habilitar solicitudes de dietas, fuera del tiempo establecido',
                    'user_info' => 'Puede ver información de su cuenta',
                    'user_change_password' => 'Puede cambiar su contraseña de inicio de sesión'

                ]
            ]

        ];

        return $p;
    }

    function getUserYears(){
        $ya = date('Y');
        $ym = $ya - 18;
        $yo = $ym - 62;

        return [$ym, $yo];
    }

    function getMonths($mode, $key){
        $m = [
            '01' => 'Enero',
            '02' => 'Febrero',
            '03' => 'Marzo',
            '04' => 'Abril',
            '05' => 'Mayo',
            '06' => 'Junio',
            '07' => 'Julio',
            '08' => 'Agosto',
            '09' => 'Septiembre',
            '10' => 'Octubre',
            '11' => 'Noviembre',
            '12' => 'Diciembre'
        ];

        if($mode == "list"){
            return $m;
        }else{
            return $m[$key];
        }
    }

?>
