@extends('admin.master')
@section('title','Agregar')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/kardex/all') }}" class="nav-link"><i class="fas fa-server"></i> Solicitud de Dietas</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/kardex/income/add') }}" class="nav-link"><i class="fas fa-plus-circle"></i> Registrar Solicitud Fuera de Tiempo</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="panel shadow">

            <div class="header">
                <h2 class="title"><i class="fas fa-plus-circle"></i> <strong> Registrar Solicitud Fuera de Tiempo</strong></h2>
            </div>

            <div class="inside">
                {!!Form::open(array('url'=>'/admin/solicitud_dieta/solicitar','method'=>'POST', 'autocomplete'=>'off'))!!}
                {{Form::token()}}
                {!! Form::hidden('route', Route::currentRouteName(), ['class'=>'form-control']) !!}
                <div class="row">
                    <div class="col-md-6">
                        <label for="idsupplier"><strong><sup style="color: red;">(*)</sup> Jornada: </strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-layer-group"></i></span>
                            <select name="idjourney" id="idsupplier" style="width: 90%" >
                                @foreach ($journeys as $j)
                                    <option value=""></option>
                                    <option value="{{$j->id}}">{{$j->name.' '.$j->start_time.' - '.$j->end_time}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6 ">
                        <label for="name"><strong> Dietas Disponibles: </strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::text('cantidad_dietas', $cantidad_dietas, ['class'=>'form-control', 'readonly', 'id'=>'cantidad_dietas']) !!}
                            {!! Form::hidden('solicitud_fuera_tiempo', $solicitud_fuera_tiempo, ['class'=>'form-control', 'readonly']) !!}
                            {!! Form::hidden('solicitud_fuera_id', $solicitud_fuera_id, ['class'=>'form-control', 'readonly']) !!}

                        </div>
                    </div>

                    <div class="col-md-6 mtop16">
                        <label for="name"><strong><sup style="color: red;">(*)</sup> Solicitante: </strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::text('name', $user, ['class'=>'form-control', 'readonly']) !!}
                        </div>
                    </div>

                    <div class="col-md-6 mtop16">
                        <label for="type_doc"><strong><sup style="color: red;">(*)</sup> Servicio: </strong></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-layer-group"></i></span>
                            <select name="idservice" id="idservice" style="width: 92%" >
                                @foreach ($services as $s)
                                    <option value=""></option>
                                    <option value="{{$s->id}}">{{$s->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                </div>

                    <div class="row">
                        <div class="col-md-3 mtop16">
                            <label><strong> Dieta: </strong></label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-layer-group"></i></span>
                                <select name="pidarticulo" id="pidarticulo" style="width: 85%" >
                                    @foreach ($diets as $d)
                                        <option value=""></option>
                                        <option value="{{ $d->id }}">{{ $d->name }}</option>
                                    @endforeach
                                </select>

                            </div> 
                        </div>


                        <div class="col-md-2 mtop16">
                            <label for="cantidad"><strong><sup style="color: red;">(*)</sup> Número de Cama: </strong></label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-layer-group"></i></span>
                                {!! Form::number('pcantidad', null, ['class'=>'form-control', 'id' => 'pcantidad', 'min'=>'1']) !!}
                            </div>
                        </div>

                        <div class="col-md-2 mtop16">
                            <label><strong> Tipo Dieta: </strong></label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-layer-group"></i></span>
                                {!! Form::select('pidarticulo1', getTypeDiet('list', null), null,['class'=>'form-select', 'id' => 'pidarticulo1']) !!}
                            </div>
                        </div>

                        <div class="col-md-3 mtop16" id="div-tipo-dietas-1">
                            <label for="cantidad"><strong> Tipo Dieta: </strong></label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-layer-group"></i></span>
                                {!! Form::select('pidarticulo2', getTypeDiet1('list', null), null,['class'=>'form-select', 'id' => 'pidarticulo2']) !!}
                            </div>
                        </div>

                        <div class="col-md-3 mtop16" id="div-tipo-dietas-hiposodicas">
                            <label for="cantidad"><strong> Tipo Dieta Hiposodica: </strong></label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-layer-group"></i></span>
                                {!! Form::select('pidarticulo3', getTypeDietHiposodicas('list', null), null,['class'=>'form-select', 'id' => 'pidarticulo3']) !!}
                            </div>
                        </div>

                        <div class="col-md-3 mtop16" id="div-tipo-dietas-renal">
                            <label for="cantidad"><strong> Tipo Dieta Renal: </strong></label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-layer-group"></i></span>
                                {!! Form::select('pidarticulo4', getTypeDietRenal('list', null), null,['class'=>'form-select', 'id' => 'pidarticulo4']) !!}
                            </div>
                        </div>

                        <div class="col-md-3 mtop16" id="div-tipo-dietas-de-viaje">
                            <label for="cantidad"><strong> Tipo Dieta De Viaje: </strong></label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-layer-group"></i></span>
                                {!! Form::select('pidarticulo5', getTypeDietDeViaje('list', null), null,['class'=>'form-select', 'id' => 'pidarticulo5']) !!}
                            </div>
                        </div>

                        <div class="col-md-3 mtop16" id="div-tipo-dietas-pediatricas">
                            <label for="cantidad"><strong> Tipo Dieta Pediatrica: </strong></label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-layer-group"></i></span>
                                {!! Form::select('pidarticulo6', getTypeDietPediatricas('list', null), null,['class'=>'form-select', 'id' => 'pidarticulo6']) !!}
                            </div> 
                        </div>

                        <div class="col-md-1" style="margin-top: 48px;">
                        <div class="form-group">
                            <button type="button" id="bt_add" class="btn btn-primary">
                                Agregar
                            </button>
                        </div>
                    </div>

                    <div class="card-body table-responsive">
                        <table id="detalles" class= "table table-striped table-bordered table-condensed table-hover">
                            <thead style="background-color: #c3f3ea; text-align:center;">
                                <th rowspan="2"><strong> ELIMINAR </strong></th>
                                <th rowspan="2"><strong> DIETA </strong></th>
                                <th rowspan="2"><strong> CAMA </strong></th>
                                <th colspan="6"><strong> CARACTERISTICAS </strong></th>
                                <tr>
                                    <th>NO.1</th>
                                    <th>NO.2</th>
                                    <th>NO.3</th>
                                    <th>NO.4</th>
                                    <th>NO.5</th>
                                    <th>NO.6</th>
                                </tr>
                            </thead>

                            <tbody>

                            </tbody>
                        </table>
                    </div>

                    <div class=" col-md-6 " id="guardar">
                        <div class="form-group">
                            <input name="_token" value="{{ csrf_token() }}" type="hidden"></input>
                            <button class="btn btn-primary" type="submit"> Guardar </button>
                            <button class="btn btn-danger" type="reset"> Cancelar </button>
                        </div>
                    </div>


                {!!Form::close()!!}
            </div>

        </div>
    </div>

    <script>

        $(document).ready(function(){
            $('#bt_add').click(function(){
            agregar();
            });

            var typediet = document.getElementById('pidarticulo');


            var tipo_dietas_1 = document.getElementById('div-tipo-dietas-1');
            tipo_dietas_1.hidden = false;
            var tipo_dietas_hiposodicas = document.getElementById('div-tipo-dietas-hiposodicas');
            tipo_dietas_hiposodicas.hidden = true;

            var tipo_dietas_renal = document.getElementById('div-tipo-dietas-renal');
            tipo_dietas_renal.hidden = true;

            var tipo_dietas_de_viaje = document.getElementById('div-tipo-dietas-de-viaje');
            tipo_dietas_de_viaje.hidden = true;

            var tipo_dietas_pediatricas = document.getElementById('div-tipo-dietas-pediatricas');
            tipo_dietas_pediatricas.hidden = true;

            $('#pidarticulo').change(function(){
                /*if(typediet.value  == 17){
                    bed.hidden = true;
                    especificar.hidden = false;
                }else{
                    bed.hidden = false;
                    especificar.hidden = true;
                }*/

                console.log(typediet.value);
                if(typediet.value  == 1 || typediet.value  == 2 || typediet.value  == 4 || typediet.value  == 5){
                    tipo_dietas_1.hidden = false;
                }else{
                    tipo_dietas_1.hidden = true;
                }

                if(typediet.value == 7){
                    tipo_dietas_hiposodicas.hidden = false;
                }else{
                    tipo_dietas_hiposodicas.hidden = true;
                }

                if(typediet.value == 20){
                    tipo_dietas_renal.hidden = false;
                }else{
                    tipo_dietas_renal.hidden = true;
                }

                if(typediet.value == 28 || typediet.value == 29){
                    tipo_dietas_de_viaje.hidden = false;
                }else{
                    tipo_dietas_de_viaje.hidden = true;
                }

                if(typediet.value == 13 || typediet.value  == 14 ){
                    tipo_dietas_pediatricas.hidden = false;
                }else{
                    tipo_dietas_pediatricas.hidden = true;
                }



            });
        });


        var cont=0, control_fuera = 1;
        total=0;
        subtotal=[];
        $("#guardar").hide();

        function agregar(){

            idarticulo=$("#pidarticulo").val();
            articulo=$("#pidarticulo option:selected").text();
            cantidad=$("#pcantidad").val();

            idcaracteristica1=$("#pidarticulo1").val();
            caracteristica1=$("#pidarticulo1 option:selected").text();
            idcaracteristica2=$("#pidarticulo2").val();
            caracteristica2=$("#pidarticulo2 option:selected").text();
            idcaracteristica3=$("#pidarticulo3").val();
            caracteristica3=$("#pidarticulo3 option:selected").text();
            idcaracteristica4=$("#pidarticulo4").val();
            caracteristica4=$("#pidarticulo4 option:selected").text();
            idcaracteristica5=$("#pidarticulo5").val();
            caracteristica5=$("#pidarticulo5 option:selected").text();
            idcaracteristica6=$("#pidarticulo6").val();
            caracteristica6=$("#pidarticulo6 option:selected").text();

            cantidad_dietas=$("#cantidad_dietas").val();

            if(control_fuera>cantidad_dietas){
                alert("¡Error! No puede ingresar mas dietas de las autorizadas para esta solicitud.")
            }else{
                if (idarticulo!="" && cantidad > 0){
                    var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+');">X</button></td><td><input type="hidden" name="idarticulo[]" value="'+idarticulo+'">'+articulo+'</td><td><input type="hidden" name="cantidad[]" value="'+cantidad+'">'+cantidad+'</td> <td><input type="hidden" name="idcaracteristica1[]" value="'+idcaracteristica1+'">'+caracteristica1+'</td> <td><input type="hidden" name="idcaracteristica2[]" value="'+idcaracteristica2+'">'+caracteristica2+'</td> <td><input type="hidden" name="idcaracteristica3[]" value="'+idcaracteristica3+'">'+caracteristica3+'</td> <td><input type="hidden" name="idcaracteristica4[]" value="'+idcaracteristica4+'">'+caracteristica4+'</td> <td><input type="hidden" name="idcaracteristica5[]" value="'+idcaracteristica5+'">'+caracteristica5+'</td> <td><input type="hidden" name="idcaracteristica6[]" value="'+idcaracteristica6+'">'+caracteristica6+'</td></tr></tr>';
                    cont++;
                    limpiar();
                    evaluar();
                    $('#detalles').append(fila);
                }else{
                    alert("¡Error! Al ingresar el detalle de la dieta, revise los datos de la misma.")
                }
            }


        }

        function limpiar(){
            $("#pcantidad").val("");
            $("#pidarticulo1").val("");
            $("#pidarticulo2").val("");
            $("#pidarticulo3").val("");
            $("#pidarticulo4").val("");
            $("#pidarticulo5").val("");
            $("#pidarticulo6").val("");
        }

        function evaluar()
        {
            if (cont >0){
                $("#guardar").show();
            }else{
                $("#guardar").hide();
            }
        }

        function eliminar(index){
            $("#fila" + index).remove();
            control_fuera--;
            evaluar();
        }

    </script>

@endsection
