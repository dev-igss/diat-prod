<?php

    Route::prefix('/admin')->group(function(){

        //Dashboard
        Route::get('/','Admin\DashboardController@getDashboard')->name('dashboard'); 

        //Municipalities
        Route::get('/municipios','Admin\MunicipalitiesController@getMunicipality')->name('municipalities');

        //Units
        Route::get('/unidades', 'Admin\UnitsController@getHome')->name('units');
        Route::post('/unidad/agregar', 'Admin\UnitsController@postUnitAdd')->name('unit_add');
        Route::get('/unidad/{id}/editar', 'Admin\UnitsController@getUnitEdit')->name('unit_edit');
        Route::post('/unidad/{id}/editar', 'Admin\UnitsController@postUnitEdit')->name('unit_edit');
        Route::get('/unidad/{id}/borrar', 'Admin\UnitsController@getUnitDelete')->name('unit_delete');

        //Diet Requests
        Route::get('/solicitud_dietas/{status}', 'Admin\DietRequestsController@getHome')->name('diet_requests');
        Route::get('/solicitud_dieta/solicitar', 'Admin\DietRequestsController@getDietRequestAdd')->name('diet_request_add');
        Route::post('/solicitud_dieta/solicitar', 'Admin\DietRequestsController@postDietRequestAdd')->name('diet_request_add');
        Route::get('/solicitud_dieta/{id}/servida/{cantidad}', 'Admin\DietRequestsController@getDietRequestServida')->name('diet_request_served');
        Route::get('/solicitud_dieta/{id}/cambio_dietas_servidas/{cantidad}', 'Admin\DietRequestsController@getDietRequestChangeDietsServida')->name('diet_request_change_diets_served');
        Route::get('/solicitud_dieta/{id}/detalles', 'Admin\DietRequestsController@getDietRequestView')->name('diet_request_view');
        Route::get('/solicitud_dieta/{id}/imprimir', 'Admin\DietRequestsController@getDietRequestPdf')->name('diet_request_view');
        Route::get('/solicitud_dieta/impresion_lote/{jornada}', 'Admin\DietRequestsController@getDietRequestPdfLote')->name('diet_request_view');
        Route::get('/solicitud_dieta/impresion_cocineta/{jornada}', 'Admin\DietRequestsController@getDietRequestPdfCocineta')->name('diet_request_view');
        Route::get('/solicitud_dieta/{id}/anular', 'Admin\DietRequestsController@getDietRequestDelete')->name('diet_request_delete');
        
        Route::get('/reportes', 'Admin\DietRequestsController@getReports')->name('reports');
        Route::post('/reporte/reporte_del_dia','Admin\ReportController@postReportHeadquartersDiets')->name('report_day');
        Route::post('/reporte/reporte_del_mes','Admin\ReportController@postReportHeadquartersDietsMonth')->name('report_month');
        
        Route::get('/solicitud_refacciones', 'Admin\DietRequestsController@getSnak')->name('snak_requests');
        Route::post('/solicitud_refaccion/solicitar', 'Admin\DietRequestsController@postDietRequestAdd')->name('snak_request_add');

        //Services
        Route::get('/servicios_general', 'Admin\ServicesController@getHome')->name('serviceg_list');
        Route::post('/servicios_general/agregar', 'Admin\ServicesController@postServicesGeneralAdd')->name('serviceg_add');
        Route::get('/servicios_general/{id}/editar', 'Admin\ServicesController@getServicesGeneralEdit')->name('serviceg_edit');
        Route::post('/servicios_general/{id}/editar', 'Admin\ServicesController@postServicesGeneralEdit')->name('serviceg_edit');
        Route::get('/servicios_general/{id}/servicios','Admin\ServicesController@getServicesGeneralServices')->name('service_list');
        Route::post('/servicios_general/servicios/agregar','Admin\ServicesController@postServicesGeneralServicesAdd')->name('service_add');
        Route::get('/servicios_general/servicios/{id}/editar','Admin\ServicesController@getServicesGeneralServicesEdit')->name('service_edit');
        Route::post('/servicios_general/servicios/{id}/editar','Admin\ServicesController@postServicesGeneralServicesEdit')->name('service_edit');

        //Journeys
        Route::get('/jornadas', 'Admin\JourneysController@getHome')->name('journeys');
        Route::post('/jornada/agregar', 'Admin\JourneysController@postJourneyAdd')->name('journey_add');
        Route::get('/jornada/{id}/editar', 'Admin\JourneysController@getJourneyEdit')->name('journey_edit');
        Route::post('/jornada/{id}/editar', 'Admin\JourneysController@postJourneyEdit')->name('journey_edit');
        Route::get('/jornada/{id}/borrar', 'Admin\JourneysController@getJourneyDelete')->name('journey_delete');

        //Diets
        Route::get('/dietas', 'Admin\DietsController@getHome')->name('diets');
        Route::post('/dieta/agregar', 'Admin\DietsController@postDietAdd')->name('diet_add');
        Route::get('/dieta/{id}/editar', 'Admin\DietsController@getDietEdit')->name('diet_edit');
        Route::post('/dieta/{id}/editar', 'Admin\DietsController@postDietEdit')->name('diet_edit');
        Route::get('/dieta/{id}/borrar', 'Admin\DietsController@getDietDelete')->name('diet_delete');

        //Bitacora
        Route::get('/bitacoras','Admin\BitacoraController@getBitacora')->name('bitacoras');

        //Users
        Route::get('/usuarios', 'Admin\UserController@getUsers')->name('user_list');
        Route::post('/usuario/agregar', 'Admin\UserController@postUserAdd')->name('user_add');
        Route::get('/usuario/{id}/editar', 'Admin\UserController@getUserEdit')->name('user_edit');
        Route::post('/usuario/{id}/editar', 'Admin\UserController@postUserEdit')->name('user_edit');
        Route::post('/usuario/{id}/reiniciar_contrasena','Admin\UserController@postResetPassword')->name('user_reset_password');
        Route::get('/usuario/{id}/suspender', 'Admin\UserController@getUserBanned')->name('user_banned');
        Route::get('/usuario/{id}/permisos', 'Admin\UserController@getUserPermissions')->name('user_permissions');
        Route::post('/usuario/{id}/permisos', 'Admin\UserController@postUserPermissions')->name('user_permissions');
        Route::get('/usuario/{id}/solicitudes_fuera_de_tiempo', 'Admin\UserController@getUserRequestsOut')->name('user_requests_out');
        Route::post('/usuario/{id}/solicitudes_fuera_de_tiempo', 'Admin\UserController@postUserRequestsOut')->name('user_requests_out');
        Route::get('/usuario/cuenta/informacion','Admin\UserController@getAccountInfo')->name('user_info');
        Route::post('/usuario/cuenta/cambiar/contrasena','Admin\UserController@postAccountChangePassword')->name('user_change_password');

        Route::get('/diat/api/load/diets', 'Admin\DietsController@getDiets')->name('diet_request_add');


    });
