<!DOCTYPE>
<html>
<?php set_time_limit(0);
ini_set("memory_limit",-1);
ini_set('max_execution_time', 0); ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title> Solicitud de Dietas </title>

    <style>

        table {
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 5px;
        }
        .page-break {
            page-break-after: always;
        }
    </style>

    @foreach($diet_request as $dr) 

        <body style="font-size: 14px; font-family: 'Roboto Slab', serif;">



                <div style="float: left; margin-top: -25px;" >
                    <img src="{{ url('img/Isotipo.png') }}" alt="" width="50" height="50">
                </div>

                <div style="text-align: center; margin-top: -25px;">
                    <span><strong> SOLICITUD DE DIETAS DIARIAS </strong> </span>
                </div>

                <div style="float: right; margin-top: 0px;">
                    <span><strong> SPS-184 </strong> </span>
                </div>

                <br><br>

                <div style="float: left; margin-top: 5px; margin-left: 0px; width:300px;height:25px;" >
                    Tiempo de Alimentacion: <input type="text" style="border:1px solid #000000;width:150px; text-align: center; margin-top: -25px; margin-left: 150px;" value="{{ $dr->journey->name }}">
                </div>

                <div style="float: right; margin-top: 5px; margin-right: 50px; width:150px;height:25px;">
                    Fecha: <input type="text" style="border:1px solid #000000;width:150px; text-align: center; margin-top: -25px; margin-left: 45px;" value="{{ \Carbon\Carbon::parse($dr->created_at)->format('d-m-Y')  }}">
                </div>

                <table width="100%"  style=" margin-top:40px; text-align: center; font-size: 12px;" >
                    <TR>
                        <TH  style="width: 50px;" >Servicio</TH>
                        <TD colspan="1" style="width: 25px;"> {{ $dr->service->name }} </TD>
                        <TH  style="width: 50px;" ALIGN="center">Nombre Jefe</TH>
                        <TD colspan="1" style="width: 75px;"> {{ $dr->user->name.' '.$dr->user->lastname }}</TD>
                        <TH  style="width: 50px;">Firma</TH>
                        <TD colspan="1" style="width: 75px;"></TD>
                    </TR>

                    <tr>
                        <th colspan="2"> Tipo de Dietas</th>
                        <th colspan="2"> Numero de las Camas</th>
                        <th colspan="1"> Total</th>
                        <th colspan="1"> {{ $dr->total_diets}}</th>
                    </tr>

                    <TR>
                        <TH ROWSPAN="4" style="width: 150px;">LÍQUIDAS</TH>
                        <TH ROWSPAN="2" style="width: 150px;">Claros</TH>
                        <TD colspan="2"  style="width: 100px;">
                            @foreach($dr->details as $d)
                                @if($d->iddiet == "1" && $d->iddiet_request == $dr->id)
                                    @if(!$loop->last )
                                        @if($d->type_pack == 0)
                                            @switch($d->type_diet_1)
                                                @case(1)
                                                    {{ $d->bed_number.' (I-D), '  }}
                                                @break

                                                @case(2)
                                                    {{ $d->bed_number.' (I-H), '  }}
                                                @break

                                                @case(3)
                                                    {{ $d->bed_number.' (I-DH), '  }}
                                                @break

                                                @case(4)
                                                    {{ $d->bed_number.' (I-SL), '  }}
                                                @break

                                                @default
                                                    {{ $d->bed_number.', '  }}
                                            @endswitch
                                        @endif

                                        @if($d->type_pack == 1)
                                            @switch($d->type_diet_1)
                                                @case(1)
                                                    {{ $d->bed_number.' (I-D), '  }}
                                                @break

                                                @case(2)
                                                    {{ $d->bed_number.' (I-H), '  }}
                                                @break

                                                @case(3)
                                                    {{ $d->bed_number.' (I-DH), '  }}
                                                @break

                                                @case(4)
                                                    {{ $d->bed_number.' (I-SL), '  }}
                                                @break

                                                @default
                                                    {{ $d->bed_number.' (I), '  }}
                                            @endswitch
                                        @endif

                                        @if($d->type_pack == 2)
                                            @switch($d->type_diet_1)
                                                @case(1)
                                                    {{ $d->bed_number.' (E-D), '  }}
                                                @break

                                                @case(2)
                                                    {{ $d->bed_number.' (E-H), '  }}
                                                @break

                                                @case(3)
                                                    {{ $d->bed_number.' (E-DH), '  }}
                                                @break

                                                @case(4)
                                                    {{ $d->bed_number.' (E-SL), '  }}
                                                @break

                                                @default
                                                    {{ $d->bed_number.' (E), '  }}
                                            @endswitch
                                        @endif

                                        @if($d->type_pack == 3)
                                            @switch($d->type_diet_1)
                                                @case(1)
                                                    <strong>{{ $d->bed_number.' (D), '  }}</strong>
                                                @break

                                                @case(2)
                                                    <strong>{{ $d->bed_number.' (H), '  }}</strong>
                                                @break

                                                @case(3)
                                                    <strong>{{ $d->bed_number.' (DH), '  }}</strong>
                                                @break

                                                @case(4)
                                                    {{ $d->bed_number.' (SL), '  }}
                                                @break

                                                @default
                                                    <strong>{{ $d->bed_number}}</strong>
                                            @endswitch
                                        @endif

                                        @if($d->type_pack == 4)
                                            @switch($d->type_diet_1)
                                                @case(1)
                                                    <strong>{{ $d->bed_number.' (I-D), '  }}</strong>
                                                @break

                                                @case(2)
                                                    <strong>{{ $d->bed_number.' (I-H), '  }}</strong>
                                                @break

                                                @case(3)
                                                    <strong>{{ $d->bed_number.' (I-DH), '  }}</strong>
                                                @break

                                                @case(4)
                                                    <strong>{{ $d->bed_number.' (I-SL), '  }}</strong>
                                                @break

                                                @default
                                                    <strong>{{ $d->bed_number.' (I), '}}</strong>
                                            @endswitch
                                        @endif

                                        @if($d->type_pack == 5)
                                            @switch($d->type_diet_1)
                                                @case(1)
                                                    <strong>{{ $d->bed_number.' (E-D),'   }}</strong>
                                                @break

                                                @case(2)
                                                    <strong>{{ $d->bed_number.' (E-H), '  }}</strong>
                                                @break

                                                @case(3)
                                                    <strong>{{ $d->bed_number.' (E-DH), '  }}</strong>
                                                @break

                                                @case(4)
                                                    <strong>{{ $d->bed_number.' (E-SL), '  }}</strong>
                                                @break

                                                @default
                                                    <strong>{{ $d->bed_number.' (E), '}}</strong>
                                            @endswitch
                                        @endif

                                    @else
                                        @if($d->type_pack == 0)
                                            @switch($d->type_diet_1)
                                                @case(1)
                                                    {{ $d->bed_number.' (I-D)'  }}
                                                @break

                                                @case(2)
                                                    {{ $d->bed_number.' (I-H)'  }}
                                                @break

                                                @case(3)
                                                    {{ $d->bed_number.' (I-DH)'  }}
                                                @break

                                                @case(4)
                                                    {{ $d->bed_number.' (I-SL), '  }}
                                                @break

                                                @default
                                                    {{ $d->bed_number  }}
                                            @endswitch
                                        @endif

                                        @if($d->type_pack == 1)
                                            @switch($d->type_diet_1)
                                                @case(1)
                                                    {{ $d->bed_number.' (I-D)'  }}
                                                @break

                                                @case(2)
                                                    {{ $d->bed_number.' (I-H)'  }}
                                                @break

                                                @case(3)
                                                    {{ $d->bed_number.' (I-DH)'  }}
                                                @break

                                                @case(4)
                                                    {{ $d->bed_number.' (I-SL), '  }}
                                                @break

                                                @default
                                                    {{ $d->bed_number.' (I)'  }}
                                            @endswitch
                                        @endif

                                        @if($d->type_pack == 2)
                                            @switch($d->type_diet_1)
                                                @case(1)
                                                    {{ $d->bed_number.' (E-D)'  }}
                                                @break

                                                @case(2)
                                                    {{ $d->bed_number.' (E-H)'  }}
                                                @break

                                                @case(3)
                                                    {{ $d->bed_number.' (E-DH)'  }}
                                                @break

                                                @case(4)
                                                    {{ $d->bed_number.' (E-SL), '  }}
                                                @break

                                                @default
                                                    {{ $d->bed_number.' (E)'  }}
                                            @endswitch
                                        @endif

                                        @if($d->type_pack == 3)
                                            @switch($d->type_diet_1)
                                                @case(1)
                                                    <strong>{{ $d->bed_number.' (D)'  }}</strong>
                                                @break

                                                @case(2)
                                                    <strong>{{ $d->bed_number.' (H)'  }}</strong>
                                                @break

                                                @case(3)
                                                    <strong>{{ $d->bed_number.' (DH)'  }}</strong>
                                                @break

                                                @case(4)
                                                    <strong>{{ $d->bed_number.' (SL), '  }}</strong>
                                                @break

                                                @default
                                                    <strong>{{ $d->bed_number}}</strong>
                                            @endswitch
                                        @endif

                                        @if($d->type_pack == 4)
                                            @switch($d->type_diet_1)
                                                @case(1)
                                                    <strong>{{ $d->bed_number.' (I-D)'  }}</strong>
                                                @break

                                                @case(2)
                                                    <strong>{{ $d->bed_number.' (I-H)'  }}</strong>
                                                @break

                                                @case(3)
                                                    <strong>{{ $d->bed_number.' (I-DH)'  }}</strong>
                                                @break

                                                @case(4)
                                                    <strong>{{ $d->bed_number.' (I-SL), '  }}</strong>
                                                @break

                                                @default
                                                    <strong>{{ $d->bed_number.' (I)'}}</strong>
                                            @endswitch
                                        @endif

                                        @if($d->type_pack == 5)
                                            @switch($d->type_diet_1)
                                                @case(1)
                                                    <strong>{{ $d->bed_number.' (E-D)'  }}</strong>
                                                @break

                                                @case(2)
                                                    <strong>{{ $d->bed_number.' (E-H)'  }}</strong>
                                                @break

                                                @case(3)
                                                    <strong>{{ $d->bed_number.' (E-DH)'  }}</strong>
                                                @break

                                                @case(4)
                                                    <strong>{{ $d->bed_number.' (E-SL), '  }}</strong>
                                                @break

                                                @default
                                                    <strong>{{ $d->bed_number.' (E)'}}</strong>
                                            @endswitch
                                        @endif
                                    

                                    @endif
                                @endif
                            @endforeach
                        </TD>
                        <TD ROWSPAN="2" colspan="2" ALIGN="center" style="width: 10px;">
                            @foreach($subtotales as $s)
                                @if($s->iddiet == "1" && $s->iddiet_request == $dr->id)
                                    {{ $s->subtotal }}
                                @endif
                            @endforeach
                        </TD>
                    </TR>

                    <TR>
                        <TD colspan="2"></TD>
                    </TR>

                    <TR>
                        <TH ROWSPAN="2">Completos</TH>
                        <TD colspan="2">
                            @foreach($dr->details as $d)
                                @if($d->iddiet == "2" && $d->iddiet_request == $dr->id)
                                    @if(!$loop->last)
                                        @if($d->type_pack == 0)
                                            @switch($d->type_diet_1)
                                                @case(1)
                                                    {{ $d->bed_number.' (I-D), '  }}
                                                @break

                                                @case(2)
                                                    {{ $d->bed_number.' (I-H), '  }}
                                                @break

                                                @case(3)
                                                    {{ $d->bed_number.' (I-DH), '  }}
                                                @break

                                                @case(4)
                                                    {{ $d->bed_number.' (I-SL), '  }}
                                                @break

                                                @default
                                                    {{ $d->bed_number.', '  }}
                                            @endswitch
                                        @endif


                                        @if($d->type_pack == 1)
                                            @switch($d->type_diet_1)
                                                @case(1)
                                                    {{ $d->bed_number.' (I-D), '  }}
                                                @break

                                                @case(2)
                                                    {{ $d->bed_number.' (I-H), '  }}
                                                @break

                                                @case(3)
                                                    {{ $d->bed_number.' (I-DH), '  }}
                                                @break

                                                @case(4)
                                                    {{ $d->bed_number.' (I-SL), '  }}
                                                @break

                                                @default
                                                    {{ $d->bed_number.' (I), '  }}
                                            @endswitch
                                        @endif

                                        @if($d->type_pack == 2)
                                            @switch($d->type_diet_1)
                                                @case(1)
                                                    {{ $d->bed_number.' (E-D), '  }}
                                                @break

                                                @case(2)
                                                    {{ $d->bed_number.' (E-H), '  }}
                                                @break

                                                @case(3)
                                                    {{ $d->bed_number.' (E-DH), '  }}
                                                @break

                                                @case(4)
                                                    {{ $d->bed_number.' (E-SL), '  }}
                                                @break

                                                @default
                                                    {{ $d->bed_number.' (E), '  }}
                                            @endswitch
                                        @endif

                                        @if($d->type_pack == 3)
                                            @switch($d->type_diet_1)
                                                @case(1)
                                                    <strong>{{ $d->bed_number.' (D), '  }}</strong>
                                                @break

                                                @case(2)
                                                    <strong>{{ $d->bed_number.' (H), '  }}</strong>
                                                @break

                                                @case(3)
                                                    <strong>{{ $d->bed_number.' (DH), '  }}</strong>
                                                @break

                                                @case(4)
                                                    <strong>{{ $d->bed_number.' (SL), '  }}</strong>
                                                @break


                                                @default
                                                    <strong>{{ $d->bed_number.', '}}</strong>
                                            @endswitch
                                        @endif

                                        @if($d->type_pack == 4)
                                            @switch($d->type_diet_1)
                                                @case(1)
                                                    <strong>{{ $d->bed_number.' (I-D), '  }}</strong>
                                                @break

                                                @case(2)
                                                    <strong>{{ $d->bed_number.' (I-H), '  }}</strong>
                                                @break

                                                @case(3)
                                                    <strong>{{ $d->bed_number.' (I-DH), '  }}</strong>
                                                @break

                                                @case(4)
                                                    <strong>{{ $d->bed_number.' (I-SL), '  }}</strong>
                                                @break


                                                @default
                                                    <strong>{{ $d->bed_number.' (I), '}}</strong>
                                            @endswitch
                                        @endif

                                        @if($d->type_pack == 5)
                                            @switch($d->type_diet_1)
                                                @case(1)
                                                    <strong>{{ $d->bed_number.' (E-D),'   }}</strong>
                                                @break

                                                @case(2)
                                                    <strong>{{ $d->bed_number.' (E-H), '  }}</strong>
                                                @break

                                                @case(3)
                                                    <strong>{{ $d->bed_number.' (E-DH), '  }}</strong>
                                                @break

                                                @case(4)
                                                    <strong>{{ $d->bed_number.' (E-SL), '  }}</strong>
                                                @break


                                                @default
                                                    <strong>{{ $d->bed_number.' (E), '}}</strong>
                                            @endswitch
                                        @endif

                                    @else

                                        @if($d->type_pack == 0)
                                            @switch($d->type_diet_1)
                                                @case(1)
                                                    {{ $d->bed_number.' (I-D)'  }}
                                                @break

                                                @case(2)
                                                    {{ $d->bed_number.' (I-H)'  }}
                                                @break

                                                @case(3)
                                                    {{ $d->bed_number.' (I-DH)'  }}
                                                @break

                                                @case(4)
                                                    {{ $d->bed_number.' (I-SL), '  }}
                                                @break

                                                @default
                                                    {{ $d->bed_number }}
                                            @endswitch
                                        @endif

                                        @if($d->type_pack == 1)
                                            @switch($d->type_diet_1)
                                                @case(1)
                                                    {{ $d->bed_number.' (I-D)'  }}
                                                @break

                                                @case(2)
                                                    {{ $d->bed_number.' (I-H)'  }}
                                                @break

                                                @case(3)
                                                    {{ $d->bed_number.' (I-DH)'  }}
                                                @break

                                                @case(4)
                                                    {{ $d->bed_number.' (I-SL), '  }}
                                                @break

                                                @default
                                                    {{ $d->bed_number.' (I)'  }}
                                            @endswitch
                                        @endif

                                        @if($d->type_pack == 2)
                                            @switch($d->type_diet_1)
                                                @case(1)
                                                    {{ $d->bed_number.' (E-D)'  }}
                                                @break

                                                @case(2)
                                                    {{ $d->bed_number.' (E-H)'  }}
                                                @break

                                                @case(3)
                                                    {{ $d->bed_number.' (E-DH)'  }}
                                                @break

                                                @case(4)
                                                    {{ $d->bed_number.' (E-SL), '  }}
                                                @break

                                                @default
                                                    {{ $d->bed_number.' (E)'  }}
                                            @endswitch
                                        @endif

                                        @if($d->type_pack == 3)
                                            @switch($d->type_diet_1)
                                                @case(1)
                                                    <strong>{{ $d->bed_number.' (D)'  }}</strong>
                                                @break

                                                @case(2)
                                                    <strong>{{ $d->bed_number.' (H)'  }}</strong>
                                                @break

                                                @case(3)
                                                    <strong>{{ $d->bed_number.' (DH)'  }}</strong>
                                                @break

                                                @case(4)
                                                    <strong>{{ $d->bed_number.' (I-SL), '  }}</strong>
                                                @break


                                                @default
                                                    <strong>{{ $d->bed_number}}</strong>
                                            @endswitch
                                        @endif

                                        @if($d->type_pack == 4)
                                            @switch($d->type_diet_1)
                                                @case(1)
                                                    <strong>{{ $d->bed_number.' (I-D)'  }}</strong>
                                                @break

                                                @case(2)
                                                    <strong>{{ $d->bed_number.' (I-H)'  }}</strong>
                                                @break

                                                @case(3)
                                                    <strong>{{ $d->bed_number.' (I-DH)'  }}</strong>
                                                @break

                                                @case(4)
                                                    <strong>{{ $d->bed_number.' (I-SL), '  }}</strong>
                                                @break


                                                @default
                                                    <strong>{{ $d->bed_number.' (I)'}}</strong>
                                            @endswitch
                                        @endif

                                        @if($d->type_pack == 5)
                                            @switch($d->type_diet_1)
                                                @case(1)
                                                    <strong>{{ $d->bed_number.' (E-D)'  }}</strong>
                                                @break

                                                @case(2)
                                                    <strong>{{ $d->bed_number.' (E-H)'  }}</strong>
                                                @break

                                                @case(3)
                                                    <strong>{{ $d->bed_number.' (E-DH)'  }}</strong>
                                                @break

                                                @case(4)
                                                    <strong>{{ $d->bed_number.' (E-SL), '  }}</strong>
                                                @break


                                                @default
                                                    <strong>{{ $d->bed_number.' (E)'}}</strong>
                                            @endswitch
                                        @endif                           

                                    @endif
                                @endif
                            @endforeach
                        </TD>
                        <TD ROWSPAN="2" colspan="2" ALIGN="center">
                            @foreach($subtotales as $s)
                                @if($s->iddiet == "2" && $s->iddiet_request == $dr->id)
                                    {{ $s->subtotal }}
                                @endif
                            @endforeach
                        </TD>
                    </TR>

                    <TR>
                        <TD colspan="2"></TD>
                    </TR>

                    <TR>
                        <TH ROWSPAN="3" colspan="2" ALIGN="center">Blanda</TH>
                        <TD colspan="2">
                            @foreach($dr->details as $d)
                                @if($d->iddiet == "3" && $d->iddiet_request == $dr->id)
                                    @if(!$loop->last)
                                        @switch($d->type_pack)
                                            @case(1)
                                                {{ $d->bed_number.' (I), '  }}
                                            @break

                                            @case(2)
                                                {{ $d->bed_number.' (E), '  }}
                                            @break

                                            @case(3)
                                                <strong> {{ $d->bed_number.', '}} </strong>
                                            @break

                                            @case(4)
                                                <strong> {{ $d->bed_number.' (I), '  }} </strong>
                                            @break

                                            @case(5)
                                                <strong> {{ $d->bed_number.' (E), '  }} </strong>
                                            @break

                                            @default
                                                {{ $d->bed_number.', '}}
                                        @endswitch
                                    @else
                                        @switch($d->type_pack)
                                            @case(1)
                                                {{ $d->bed_number.' (I)'  }}
                                            @break

                                            @case(2)
                                                {{ $d->bed_number.' (E)'  }}
                                            @break

                                            @case(3)
                                                <strong> {{ $d->bed_number}} </strong>
                                            @break

                                            @case(4)
                                                <strong> {{ $d->bed_number.' (I)'  }} </strong>
                                            @break

                                            @case(5)
                                                <strong> {{ $d->bed_number.' (E)'  }} </strong>
                                            @break

                                            @default
                                                {{ $d->bed_number}}
                                        @endswitch
                                    
                                    @endif
                                @endif
                            @endforeach
                        </TD>
                        <TD ROWSPAN="3" colspan="2">
                            @foreach($subtotales as $s)
                                @if($s->iddiet == "3" && $s->iddiet_request == $dr->id)
                                    {{ $s->subtotal }}
                                @endif
                            @endforeach
                        </TD>

                    </TR>

                    <TR>
                        <TD colspan="2"></TD>
                    </TR>

                    <TR>
                        <TD colspan="2"></TD>
                    </TR>


                    <TR>
                        <TH ROWSPAN="2" colspan="2" ALIGN="center">Papilla (licuada/puré)</TH>
                        <TD colspan="2">
                            @foreach($dr->details as $d)
                                @if($d->iddiet == "4" && $d->iddiet_request == $dr->id)
                                    @if(!$loop->last)

                                        @if($d->type_pack == 0)
                                            @switch($d->type_diet_1)
                                                @case(1)
                                                    {{ $d->bed_number.' (D), '  }}
                                                @break

                                                @case(2)
                                                    {{ $d->bed_number.' (H), '  }}
                                                @break

                                                @case(3)
                                                    {{ $d->bed_number.' (DH), '  }}
                                                @break

                                                @case(4)
                                                    {{ $d->bed_number.' (SL), '  }}
                                                @break

                                                @default
                                                    {{ $d->bed_number.', '  }}
                                            @endswitch
                                        @endif

                                        @if($d->type_pack == 1)
                                            @switch($d->type_diet_1)
                                                @case(1)
                                                    {{ $d->bed_number.' (I-D), '  }}
                                                @break

                                                @case(2)
                                                    {{ $d->bed_number.' (I-H), '  }}
                                                @break

                                                @case(3)
                                                    {{ $d->bed_number.' (I-DH), '  }}
                                                @break

                                                @case(4)
                                                    {{ $d->bed_number.' (I-SL), '  }}
                                                @break

                                                @default
                                                    {{ $d->bed_number.' (I), '  }}
                                            @endswitch
                                        @endif

                                        @if($d->type_pack == 2)
                                            @switch($d->type_diet_1)
                                                @case(1)
                                                    {{ $d->bed_number.' (E-D), '  }}
                                                @break

                                                @case(2)
                                                    {{ $d->bed_number.' (E-H), '  }}
                                                @break

                                                @case(3)
                                                    {{ $d->bed_number.' (E-DH), '  }}
                                                @break

                                                @case(4)
                                                    {{ $d->bed_number.' (E-SL), '  }}
                                                @break

                                                @default
                                                    {{ $d->bed_number.' (E), '  }}
                                            @endswitch
                                        @endif

                                        @if($d->type_pack == 3)
                                            @switch($d->type_diet_1)
                                                @case(1)
                                                    <strong>{{ $d->bed_number.' (D), '  }}</strong>
                                                @break

                                                @case(2)
                                                    <strong>{{ $d->bed_number.' (H), '  }}</strong>
                                                @break

                                                @case(3)
                                                    <strong>{{ $d->bed_number.' (DH), '  }}</strong>
                                                @break

                                                @case(4)
                                                    <strong>{{ $d->bed_number.' (SL), '  }}</strong>
                                                @break


                                                @default
                                                    <strong>{{ $d->bed_number.', ' }}</strong>
                                            @endswitch
                                        @endif

                                        @if($d->type_pack == 4)
                                            @switch($d->type_diet_1)
                                                @case(1)
                                                    <strong>{{ $d->bed_number.' (I-D), '  }}</strong>
                                                @break

                                                @case(2)
                                                    <strong>{{ $d->bed_number.' (I-H), '  }}</strong>
                                                @break

                                                @case(3)
                                                    <strong>{{ $d->bed_number.' (I-DH), '  }}</strong>
                                                @break

                                                @case(4)
                                                    <strong>{{ $d->bed_number.' (I-SL), '  }}</strong>
                                                @break


                                                @default
                                                    <strong>{{ $d->bed_number.' (I), '}}</strong>
                                            @endswitch
                                        @endif

                                        @if($d->type_pack == 5)
                                            @switch($d->type_diet_1)
                                                @case(1)
                                                    <strong>{{ $d->bed_number.' (E-D),'   }}</strong>
                                                @break

                                                @case(2)
                                                    <strong>{{ $d->bed_number.' (E-H), '  }}</strong>
                                                @break

                                                @case(3)
                                                    <strong>{{ $d->bed_number.' (E-DH), '  }}</strong>
                                                @break

                                                @case(4)
                                                    <strong>{{ $d->bed_number.' (E-SL), '  }}</strong>
                                                @break


                                                @default
                                                    <strong>{{ $d->bed_number.' (E), '}}</strong>
                                            @endswitch
                                        @endif

                                    @else

                                        @if($d->type_pack == 0)
                                            @switch($d->type_diet_1)
                                                @case(1)
                                                    {{ $d->bed_number.' (D)'  }}
                                                @break

                                                @case(2)
                                                    {{ $d->bed_number.' (H)'  }}
                                                @break

                                                @case(3)
                                                    {{ $d->bed_number.' (DH)'  }}
                                                @break

                                                @case(4)
                                                    {{ $d->bed_number.' (SL), '  }}
                                                @break

                                                @default
                                                    {{ $d->bed_number  }}
                                            @endswitch
                                        @endif

                                        @if($d->type_pack == 1)
                                            @switch($d->type_diet_1)
                                                @case(1)
                                                    {{ $d->bed_number.' (I-D)'  }}
                                                @break

                                                @case(2)
                                                    {{ $d->bed_number.' (I-H)'  }}
                                                @break

                                                @case(3)
                                                    {{ $d->bed_number.' (I-DH)'  }}
                                                @break

                                                @case(4)
                                                    {{ $d->bed_number.' (I-SL), '  }}
                                                @break

                                                @default
                                                    {{ $d->bed_number.' (I)'  }}
                                            @endswitch
                                        @endif

                                        @if($d->type_pack == 2)
                                            @switch($d->type_diet_1)
                                                @case(1)
                                                    {{ $d->bed_number.' (E-D)'  }}
                                                @break

                                                @case(2)
                                                    {{ $d->bed_number.' (E-H)'  }}
                                                @break

                                                @case(3)
                                                    {{ $d->bed_number.' (E-DH)'  }}
                                                @break

                                                @case(4)
                                                    {{ $d->bed_number.' (I-SL), '  }}
                                                @break

                                                @default
                                                    {{ $d->bed_number.' (E)'  }}
                                            @endswitch
                                        @endif

                                        @if($d->type_pack == 3)
                                            @switch($d->type_diet_1)
                                                @case(1)
                                                    <strong>{{ $d->bed_number.' (D)'  }}</strong>
                                                @break

                                                @case(2)
                                                    <strong>{{ $d->bed_number.' (H)'  }}</strong>
                                                @break

                                                @case(3)
                                                    <strong>{{ $d->bed_number.' (DH)'  }}</strong>
                                                @break

                                                @case(4)
                                                    <strong>{{ $d->bed_number.' (SL), '  }}</strong>
                                                @break


                                                @default
                                                    <strong>{{ $d->bed_number}}</strong>
                                            @endswitch
                                        @endif

                                        @if($d->type_pack == 4)
                                            @switch($d->type_diet_1)
                                                @case(1)
                                                    <strong>{{ $d->bed_number.' (I-D)'  }}</strong>
                                                @break

                                                @case(2)
                                                    <strong>{{ $d->bed_number.' (I-H)'  }}</strong>
                                                @break

                                                @case(3)
                                                    <strong>{{ $d->bed_number.' (I-DH)'  }}</strong>
                                                @break

                                                @case(4)
                                                    <strong>{{ $d->bed_number.' (I-SL), '  }}</strong>
                                                @break


                                                @default
                                                    <strong>{{ $d->bed_number.' (I)'}}</strong>
                                            @endswitch
                                        @endif

                                        @if($d->type_pack == 5)
                                            @switch($d->type_diet_1)
                                                @case(1)
                                                    <strong>{{ $d->bed_number.' (E-D)'  }}</strong>
                                                @break

                                                @case(2)
                                                    <strong>{{ $d->bed_number.' (E-H)'  }}</strong>
                                                @break

                                                @case(3)
                                                    <strong>{{ $d->bed_number.' (E-DH)'  }}</strong>
                                                @break

                                                @case(4)
                                                    <strong>{{ $d->bed_number.' (E-SL), '  }}</strong>
                                                @break


                                                @default
                                                    <strong>{{ $d->bed_number.' (E)'}}</strong>
                                            @endswitch
                                        @endif


                                    @endif
                                @endif
                            @endforeach
                        </TD>
                        <TD ROWSPAN="2" colspan="2">
                            @foreach($subtotales as $s)
                                @if($s->iddiet == "4" && $s->iddiet_request == $dr->id)
                                    {{ $s->subtotal }}
                                @endif
                            @endforeach
                        </TD>

                    </TR>

                    <TR>
                        <TD colspan="2"></TD>
                    </TR>

                    <TR>
                        <TH ROWSPAN="2" colspan="2" ALIGN="center">Picada</TH>
                        <TD colspan="2">
                            @foreach($dr->details as $d)
                                @if($d->iddiet == "5" && $d->iddiet_request == $dr->id)
                                    @if(!$loop->last)


                                        @if($d->type_pack == 1)
                                            @switch($d->type_diet_1)
                                                @case(1)
                                                    {{ $d->bed_number.' (I-D), '  }}
                                                @break

                                                @case(2)
                                                    {{ $d->bed_number.' (I-H), '  }}
                                                @break

                                                @case(3)
                                                    {{ $d->bed_number.' (I-DH), '  }}
                                                @break

                                                @case(4)
                                                    {{ $d->bed_number.' (I-SL), '  }}
                                                @break

                                                @default
                                                    {{ $d->bed_number.' (I), '  }}
                                            @endswitch
                                        @endif

                                        @if($d->type_pack == 2)
                                            @switch($d->type_diet_1)
                                                @case(1)
                                                    {{ $d->bed_number.' (E-D), '  }}
                                                @break

                                                @case(2)
                                                    {{ $d->bed_number.' (E-H), '  }}
                                                @break

                                                @case(3)
                                                    {{ $d->bed_number.' (E-DH), '  }}
                                                @break

                                                @case(4)
                                                    {{ $d->bed_number.' (E-SL), '  }}
                                                @break

                                                @default
                                                    {{ $d->bed_number.' (E), '  }}
                                            @endswitch
                                        @endif

                                        @if($d->type_pack == 3)
                                            @switch($d->type_diet_1)
                                                @case(1)
                                                    <strong>{{ $d->bed_number.' (D), '  }}</strong>
                                                @break

                                                @case(2)
                                                    <strong>{{ $d->bed_number.' (H), '  }}</strong>
                                                @break

                                                @case(3)
                                                    <strong>{{ $d->bed_number.' (DH), '  }}</strong>
                                                @break

                                                @case(4)
                                                    <strong>{{ $d->bed_number.' (SL), '  }}</strong>
                                                @break


                                                @default
                                                    <strong>{{ $d->bed_number}}</strong>
                                            @endswitch
                                        @endif

                                        @if($d->type_pack == 4)
                                            @switch($d->type_diet_1)
                                                @case(1)
                                                    <strong>{{ $d->bed_number.' (I-D), '  }}</strong>
                                                @break

                                                @case(2)
                                                    <strong>{{ $d->bed_number.' (I-H), '  }}</strong>
                                                @break

                                                @case(3)
                                                    <strong>{{ $d->bed_number.' (I-DH), '  }}</strong>
                                                @break

                                                @case(4)
                                                    <strong>{{ $d->bed_number.' (I-SL), '  }}</strong>
                                                @break


                                                @default
                                                    <strong>{{ $d->bed_number.' (I), '}}</strong>
                                            @endswitch
                                        @endif

                                        @if($d->type_pack == 5)
                                            @switch($d->type_diet_1)
                                                @case(1)
                                                    <strong>{{ $d->bed_number.' (E-D),'   }}</strong>
                                                @break

                                                @case(2)
                                                    <strong>{{ $d->bed_number.' (E-H), '  }}</strong>
                                                @break

                                                @case(3)
                                                    <strong>{{ $d->bed_number.' (E-DH), '  }}</strong>
                                                @break

                                                @case(4)
                                                    <strong>{{ $d->bed_number.' (E-SL), '  }}</strong>
                                                @break


                                                @default
                                                    <strong>{{ $d->bed_number.' (E), '}}</strong>
                                            @endswitch
                                        @endif

                                        @if($d->type_pack == 0 && $d->type_diet_1 == 0)
                                            {{ $d->bed_number.', '  }}
                                        @endif

                                    @else

                                        @if($d->type_pack == 1)
                                            @switch($d->type_diet_1)
                                                @case(1)
                                                    {{ $d->bed_number.' (I-D)'  }}
                                                @break

                                                @case(2)
                                                    {{ $d->bed_number.' (I-H)'  }}
                                                @break

                                                @case(3)
                                                    {{ $d->bed_number.' (I-DH)'  }}
                                                @break

                                                @case(4)
                                                    {{ $d->bed_number.' (I-SL), '  }}
                                                @break

                                                @default
                                                    {{ $d->bed_number.' (I)'  }}
                                            @endswitch
                                        @endif

                                        @if($d->type_pack == 2)
                                            @switch($d->type_diet_1)
                                                @case(1)
                                                    {{ $d->bed_number.' (E-D)'  }}
                                                @break

                                                @case(2)
                                                    {{ $d->bed_number.' (E-H)'  }}
                                                @break

                                                @case(3)
                                                    {{ $d->bed_number.' (E-DH)'  }}
                                                @break

                                                @case(4)
                                                    {{ $d->bed_number.' (E-SL), '  }}
                                                @break

                                                @default
                                                    {{ $d->bed_number.' (E)'  }}
                                            @endswitch
                                        @endif

                                        @if($d->type_pack == 3)
                                            @switch($d->type_diet_1)
                                                @case(1)
                                                    <strong>{{ $d->bed_number.' (D)'  }}</strong>
                                                @break

                                                @case(2)
                                                    <strong>{{ $d->bed_number.' (H)'  }}</strong>
                                                @break

                                                @case(3)
                                                    <strong>{{ $d->bed_number.' (DH)'  }}</strong>
                                                @break

                                                @case(4)
                                                    <strong>{{ $d->bed_number.' (SL), '  }}</strong>
                                                @break


                                                @default
                                                    <strong>{{ $d->bed_number}}</strong>
                                            @endswitch
                                        @endif

                                        @if($d->type_pack == 4)
                                            @switch($d->type_diet_1)
                                                @case(1)
                                                    <strong>{{ $d->bed_number.' (I-D)'  }}</strong>
                                                @break

                                                @case(2)
                                                    <strong>{{ $d->bed_number.' (I-H)'  }}</strong>
                                                @break

                                                @case(3)
                                                    <strong>{{ $d->bed_number.' (I-DH)'  }}</strong>
                                                @break

                                                @case(4)
                                                    <strong>{{ $d->bed_number.' (I-SL), '  }}</strong>
                                                @break


                                                @default
                                                    <strong>{{ $d->bed_number.' (I)'}}</strong>
                                            @endswitch
                                        @endif

                                        @if($d->type_pack == 5)
                                            @switch($d->type_diet_1)
                                                @case(1)
                                                    <strong>{{ $d->bed_number.' (E-D)'  }}</strong>
                                                @break

                                                @case(2)
                                                    <strong>{{ $d->bed_number.' (E-H)'  }}</strong>
                                                @break

                                                @case(3)
                                                    <strong>{{ $d->bed_number.' (E-DH)'  }}</strong>
                                                @break

                                                @case(4)
                                                    <strong>{{ $d->bed_number.' (E-SL), '  }}</strong>
                                                @break


                                                @default
                                                    <strong>{{ $d->bed_number.' (E)'}}</strong>
                                            @endswitch
                                        @endif

                                        @if($d->type_pack == 0 && $d->type_diet_1 == 0)
                                            {{ $d->bed_number  }}
                                        @endif


                                    @endif
                                @endif
                            @endforeach
                        </TD>
                        <TD ROWSPAN="2" colspan="2">
                            @foreach($subtotales as $s)
                                @if($s->iddiet == "5" && $s->iddiet_request == $dr->id)
                                    {{ $s->subtotal }}
                                @endif
                            @endforeach
                        </TD>

                    </TR>

                    <TR>
                        <TD colspan="2"></TD>
                    </TR>

                    <TR>
                        <TH ROWSPAN="2" colspan="2" ALIGN="center">Hipograsa</TH>
                        <TD colspan="2">
                            @foreach($dr->details as $d)
                                @if($d->iddiet == "6" && $d->iddiet_request == $dr->id)
                                    @if(!$loop->last)
                                        @switch($d->type_pack)
                                            @case(1)
                                                {{ $d->bed_number.' (I), '  }}
                                            @break

                                            @case(2)
                                                {{ $d->bed_number.' (E), '  }}
                                            @break

                                            @case(3)
                                                <strong> {{ $d->bed_number.', '}} </strong>
                                            @break

                                            @case(4)
                                                <strong> {{ $d->bed_number.' (I), '  }} </strong>
                                            @break

                                            @case(5)
                                                <strong> {{ $d->bed_number.' (E), '  }} </strong>
                                            @break

                                            @default
                                                {{ $d->bed_number.', '}}
                                        @endswitch

                                    @else
                                        @switch($d->type_pack)
                                            @case(1)
                                                {{ $d->bed_number.' (I)'  }}
                                            @break

                                            @case(2)
                                                {{ $d->bed_number.' (E)'  }}
                                            @break

                                            @case(3)
                                                <strong> {{ $d->bed_number}} </strong>
                                            @break

                                            @case(4)
                                                <strong> {{ $d->bed_number.' (I)'  }} </strong>
                                            @break

                                            @case(5)
                                                <strong> {{ $d->bed_number.' (E)'  }} </strong>
                                            @break

                                            @default
                                                {{ $d->bed_number}}
                                        @endswitch
                                    
                                    @endif
                                @endif
                            @endforeach
                        </TD>
                        <TD ROWSPAN="2" colspan="2">
                            @foreach($subtotales as $s)
                                @if($s->iddiet == "6" && $s->iddiet_request == $dr->id)
                                    {{ $s->subtotal }}
                                @endif
                            @endforeach
                        </TD>

                    </TR>

                    <TR>
                        <TD colspan="2"></TD>
                    </TR>

                    <TR>
                        <TH ROWSPAN="2" colspan="2" ALIGN="center">Hiposódica</TH>
                        <TD colspan="2">
                            @foreach($dr->details as $d)
                                @if($d->iddiet == "7" && $d->iddiet_request == $dr->id)
                                    @if(!$loop->last )
                                        @if($d->type_pack == 0)
                                            @switch($d->type_diet_hiposodicas)
                                                @case(1)
                                                    {{ $d->bed_number.' (I-BF), '  }}
                                                @break

                                                @case(2)
                                                    {{ $d->bed_number.' (I-AF), '  }}
                                                @break

                                                @case(3)
                                                    {{ $d->bed_number.' (I-BK), '  }}
                                                @break

                                                @case(4)
                                                    {{ $d->bed_number.' (I-AK), '  }}
                                                @break

                                                @default
                                                    {{ $d->bed_number.', '  }}
                                            @endswitch
                                        @endif

                                        @if($d->type_pack == 1)
                                            @switch($d->type_diet_hiposodicas)
                                                @case(1)
                                                    {{ $d->bed_number.' (I-BF), '  }}
                                                @break

                                                @case(2)
                                                    {{ $d->bed_number.' (I-AF), '  }}
                                                @break

                                                @case(3)
                                                    {{ $d->bed_number.' (I-BK), '  }}
                                                @break

                                                @case(4)
                                                    {{ $d->bed_number.' (I-AK), '  }}
                                                @break

                                                @default
                                                    {{ $d->bed_number.' (I), '  }}
                                            @endswitch
                                        @endif

                                        @if($d->type_pack == 2)
                                            @switch($d->type_diet_hiposodicas)
                                                @case(1)
                                                    {{ $d->bed_number.' (E-BF), '  }}
                                                @break

                                                @case(2)
                                                    {{ $d->bed_number.' (E-AF), '  }}
                                                @break

                                                @case(3)
                                                    {{ $d->bed_number.' (E-BK), '  }}
                                                @break

                                                @case(4)
                                                    {{ $d->bed_number.' (E-AK), '  }}
                                                @break

                                                @default
                                                    {{ $d->bed_number.' (E), '  }}
                                            @endswitch
                                        @endif

                                        @if($d->type_pack == 3)
                                            @switch($d->type_diet_hiposodicas)
                                                @case(1)
                                                    <strong>{{ $d->bed_number.' (BF), '  }}</strong>
                                                @break

                                                @case(2)
                                                    <strong>{{ $d->bed_number.' (AF), '  }}</strong>
                                                @break

                                                @case(3)
                                                    <strong>{{ $d->bed_number.' (BK), '  }}</strong>
                                                @break

                                                @case(4)
                                                    <strong>{{ $d->bed_number.' (AK), '  }}</strong>
                                                @break

                                                @default
                                                    <strong>{{ $d->bed_number.', '}}</strong>
                                            @endswitch
                                        @endif

                                        @if($d->type_pack == 4)
                                            @switch($d->type_diet_hiposodicas)
                                                @case(1)
                                                    <strong>{{ $d->bed_number.' (I-BF), '  }}</strong>
                                                @break

                                                @case(2)
                                                    <strong>{{ $d->bed_number.' (I-AF), '  }}</strong>
                                                @break

                                                @case(3)
                                                    <strong>{{ $d->bed_number.' (I-BK), '  }}</strong>
                                                @break

                                                @case(4)
                                                    <strong>{{ $d->bed_number.' (I-AK), '  }}</strong>
                                                @break

                                                @default
                                                    <strong>{{ $d->bed_number.' (I), '}}</strong>
                                            @endswitch
                                        @endif

                                        @if($d->type_pack == 5)
                                            @switch($d->type_diet_hiposodicas)
                                                @case(1)
                                                    <strong>{{ $d->bed_number.' (E-BF),'   }}</strong>
                                                @break

                                                @case(2)
                                                    <strong>{{ $d->bed_number.' (E-AF), '  }}</strong>
                                                @break

                                                @case(3)
                                                    <strong>{{ $d->bed_number.' (E-BK), '  }}</strong>
                                                @break

                                                @case(3)
                                                    <strong>{{ $d->bed_number.' (E-AK), '  }}</strong>
                                                @break

                                                @default
                                                    <strong>{{ $d->bed_number.' (E), '}}</strong>
                                            @endswitch
                                        @endif

                                    @else
                                        @if($d->type_pack == 0)
                                            @switch($d->type_diet_hiposodicas)
                                                @case(1)
                                                    {{ $d->bed_number.' (I-BF)'  }}
                                                @break

                                                @case(2)
                                                    {{ $d->bed_number.' (I-AF)'  }}
                                                @break

                                                @case(3)
                                                    {{ $d->bed_number.' (I-BK)'  }}
                                                @break

                                                @case(4)
                                                    {{ $d->bed_number.' (I-AK)'  }}
                                                @break

                                                @default
                                                    {{ $d->bed_number }}
                                            @endswitch
                                        @endif

                                        @if($d->type_pack == 1)
                                            @switch($d->type_diet_hiposodicas)
                                                @case(1)
                                                    {{ $d->bed_number.' (I-BF)'  }}
                                                @break

                                                @case(2)
                                                    {{ $d->bed_number.' (I-AF)'  }}
                                                @break

                                                @case(3)
                                                    {{ $d->bed_number.' (I-BK)'  }}
                                                @break

                                                @case(4)
                                                    {{ $d->bed_number.' (I-AK)'  }}
                                                @break

                                                @default
                                                    {{ $d->bed_number.' (I)'  }}
                                            @endswitch
                                        @endif

                                        @if($d->type_pack == 2)
                                            @switch($d->type_diet_hiposodicas)
                                                @case(1)
                                                    {{ $d->bed_number.' (E-BF)'  }}
                                                @break

                                                @case(2)
                                                    {{ $d->bed_number.' (E-AF)'  }}
                                                @break

                                                @case(3)
                                                    {{ $d->bed_number.' (E-BK)'  }}
                                                @break

                                                @case(4)
                                                    {{ $d->bed_number.' (E-AK)'  }}
                                                @break

                                                @default
                                                    {{ $d->bed_number.' (E)'  }}
                                            @endswitch
                                        @endif

                                        @if($d->type_pack == 3)
                                            @switch($d->type_diet_hiposodicas)
                                                @case(1)
                                                    <strong>{{ $d->bed_number.' (BF)'  }}</strong>
                                                @break

                                                @case(2)
                                                    <strong>{{ $d->bed_number.' (AF)'  }}</strong>
                                                @break

                                                @case(3)
                                                    <strong>{{ $d->bed_number.' (BK)'  }}</strong>
                                                @break

                                                @case(3)
                                                    <strong>{{ $d->bed_number.' (AK)'  }}</strong>
                                                @break

                                                @default
                                                    <strong>{{ $d->bed_number}}</strong>
                                            @endswitch
                                        @endif

                                        @if($d->type_pack == 4)
                                            @switch($d->type_diet_hiposodicas)
                                                @case(1)
                                                    <strong>{{ $d->bed_number.' (I-BF)'  }}</strong>
                                                @break

                                                @case(2)
                                                    <strong>{{ $d->bed_number.' (I-AF)'  }}</strong>
                                                @break

                                                @case(3)
                                                    <strong>{{ $d->bed_number.' (I-BK)'  }}</strong>
                                                @break

                                                @case(3)
                                                    <strong>{{ $d->bed_number.' (I-AK)'  }}</strong>
                                                @break

                                                @default
                                                    <strong>{{ $d->bed_number.' (I)'}}</strong>
                                            @endswitch
                                        @endif

                                        @if($d->type_pack == 5)
                                            @switch($d->type_diet_hiposodicas)
                                                @case(1)
                                                    <strong>{{ $d->bed_number.' (E-BF)'  }}</strong>
                                                @break

                                                @case(2)
                                                    <strong>{{ $d->bed_number.' (E-AF)'  }}</strong>
                                                @break

                                                @case(3)
                                                    <strong>{{ $d->bed_number.' (E-BK)'  }}</strong>
                                                @break

                                                @case(4)
                                                    <strong>{{ $d->bed_number.' (E-AK)'  }}</strong>
                                                @break

                                                @default
                                                    <strong>{{ $d->bed_number.' (E)'}}</strong>
                                            @endswitch
                                        @endif                                   

                                    @endif
                                @endif
                            @endforeach
                        </TD>
                        <TD ROWSPAN="2" colspan="2">
                            @foreach($subtotales as $s)
                                @if($s->iddiet == "7" && $s->iddiet_request == $dr->id)
                                    {{ $s->subtotal }}
                                @endif
                            @endforeach
                        </TD>

                    </TR>

                    <TR>
                        <TD colspan="2"></TD>
                    </TR>

                    <TR>
                        <TH ROWSPAN="4">DIABÉTICA</TH>
                        <TH> 1,500 Calorías</TH>
                        <TD colspan="2">
                            @foreach($dr->details as $d)
                                @if($d->iddiet == "8" && $d->iddiet_request == $dr->id)
                                    @if(!$loop->last)
                                        @switch($d->type_pack)
                                            @case(1)
                                                {{ $d->bed_number.' (I), '  }}
                                            @break

                                            @case(2)
                                                {{ $d->bed_number.' (E), '  }}
                                            @break

                                            @case(3)
                                                <strong> {{ $d->bed_number.', '}} </strong>
                                            @break

                                            @case(4)
                                                <strong> {{ $d->bed_number.' (I), '  }} </strong>
                                            @break

                                            @case(5)
                                                <strong> {{ $d->bed_number.' (E), '  }} </strong>
                                            @break

                                            @default
                                                {{ $d->bed_number.', '}}
                                        @endswitch

                                    @else
                                        @switch($d->type_pack)
                                            @case(1)
                                                {{ $d->bed_number.' (I)'  }}
                                            @break

                                            @case(2)
                                                {{ $d->bed_number.' (E)'  }}
                                            @break

                                            @case(3)
                                                <strong> {{ $d->bed_number}} </strong>
                                            @break

                                            @case(4)
                                                <strong> {{ $d->bed_number.' (I)'  }} </strong>
                                            @break

                                            @case(5)
                                                <strong> {{ $d->bed_number.' (E)'  }} </strong>
                                            @break

                                            @default
                                                {{ $d->bed_number}}
                                        @endswitch

                                    @endif
                                @endif
                            @endforeach
                        </TD>
                        <TD ROWSPAN="4" colspan="2" ALIGN="center">
                            @foreach($subtotales_diabeticas as $s)
                                @if($s->iddiet_request == $dr->id)
                                    @if($s->subtotal > 0)
                                        {{ $s->subtotal }}
                                    @endif
                                @endif
                            @endforeach
                        </TD>
                    </TR>

                    <TR>
                        <TH> 1,800 Calorías</TH>
                        <TD colspan="2">
                            @foreach($dr->details as $d)
                                @if($d->iddiet == "9" && $d->iddiet_request == $dr->id)
                                    @if(!$loop->last)
                                        @switch($d->type_pack)
                                            @case(1)
                                                {{ $d->bed_number.' (I), '  }}
                                            @break

                                            @case(2)
                                                {{ $d->bed_number.' (E), '  }}
                                            @break

                                            @case(3)
                                                <strong> {{ $d->bed_number.', '}} </strong>
                                            @break

                                            @case(4)
                                                <strong> {{ $d->bed_number.' (I), '  }} </strong>
                                            @break

                                            @case(5)
                                                <strong> {{ $d->bed_number.' (E), '  }} </strong>
                                            @break

                                            @default
                                                {{ $d->bed_number.', '}}
                                        @endswitch

                                    @else
                                        @switch($d->type_pack)
                                            @case(1)
                                                {{ $d->bed_number.' (I)'  }}
                                            @break

                                            @case(2)
                                                {{ $d->bed_number.' (E)'  }}
                                            @break

                                            @case(3)
                                                <strong> {{ $d->bed_number}} </strong>
                                            @break

                                            @case(4)
                                                <strong> {{ $d->bed_number.' (I)'  }} </strong>
                                            @break

                                            @case(5)
                                                <strong> {{ $d->bed_number.' (E)'  }} </strong>
                                            @break

                                            @default
                                                {{ $d->bed_number}}
                                        @endswitch
                                    
                                    @endif
                                @endif
                            @endforeach
                        </TD>
                    </TR>

                    <TR>
                        <TH> 2,000 Calorías</TH>
                        <TD colspan="2">
                            @foreach($dr->details as $d)
                                @if($d->iddiet == "10" && $d->iddiet_request == $dr->id)
                                    @if(!$loop->last)
                                        @switch($d->type_pack)
                                            @case(1)
                                                {{ $d->bed_number.' (I), '  }}
                                            @break

                                            @case(2)
                                                {{ $d->bed_number.' (E), '  }}
                                            @break

                                            @case(3)
                                                <strong> {{ $d->bed_number.', '}} </strong>
                                            @break

                                            @case(4)
                                                <strong> {{ $d->bed_number.' (I), '  }} </strong>
                                            @break

                                            @case(5)
                                                <strong> {{ $d->bed_number.' (E), '  }} </strong>
                                            @break

                                            @default
                                                {{ $d->bed_number.', '}}
                                        @endswitch

                                    @else
                                        @switch($d->type_pack)
                                            @case(1)
                                                {{ $d->bed_number.' (I)'  }}
                                            @break

                                            @case(2)
                                                {{ $d->bed_number.' (E)'  }}
                                            @break

                                            @case(3)
                                                <strong> {{ $d->bed_number}} </strong>
                                            @break

                                            @case(4)
                                                <strong> {{ $d->bed_number.' (I)'  }} </strong>
                                            @break

                                            @case(5)
                                                <strong> {{ $d->bed_number.' (E)'  }} </strong>
                                            @break

                                            @default
                                                {{ $d->bed_number}}
                                        @endswitch

                                        
                                    @endif
                                @endif
                            @endforeach
                        </TD>
                    </TR>

                    <TR>
                        <TH> 2,200 Calorías</TH>
                        <TD colspan="2">
                            @foreach($dr->details as $d)
                                @if($d->iddiet == "11" && $d->iddiet_request == $dr->id)
                                    @if(!$loop->last )

                                        @switch($d->type_pack)
                                            @case(1)
                                                {{ $d->bed_number.' (I), '  }}
                                            @break

                                            @case(2)
                                                {{ $d->bed_number.' (E), '  }}
                                            @break

                                            @case(3)
                                                <strong> {{ $d->bed_number.', '}} </strong>
                                            @break

                                            @case(4)
                                                <strong> {{ $d->bed_number.' (I), '  }} </strong>
                                            @break

                                            @case(5)
                                                <strong> {{ $d->bed_number.' (E), '  }} </strong>
                                            @break

                                            @default
                                                {{ $d->bed_number.', '}}
                                        @endswitch

                                    @else
                                        @switch($d->type_pack)
                                            @case(1)
                                                {{ $d->bed_number.' (I)'  }}
                                            @break

                                            @case(2)
                                                {{ $d->bed_number.' (E)'  }}
                                            @break

                                            @case(3)
                                                <strong> {{ $d->bed_number}} </strong>
                                            @break

                                            @case(4)
                                                <strong> {{ $d->bed_number.' (I)'  }} </strong>
                                            @break

                                            @case(5)
                                                <strong> {{ $d->bed_number.' (E)'  }} </strong>
                                            @break

                                            @default
                                                {{ $d->bed_number}}
                                        @endswitch
                                    
                                    @endif
                                @endif
                            @endforeach
                        </TD>
                    </TR>

                    <TR>
                        <TH ROWSPAN="5" colspan="2" ALIGN="center">Libre</TH>
                        <TD colspan="2">
                            @foreach($dr->details as $d)
                                @if($d->iddiet == "12" && $d->iddiet_request == $dr->id)
                                    @if(!$loop->last)

                                        @switch($d->type_pack)
                                            @case(1)
                                                {{ $d->bed_number.' (I), '  }}
                                            @break

                                            @case(2)
                                                {{ $d->bed_number.' (E), '  }}
                                            @break

                                            @case(3)
                                                <strong> {{ $d->bed_number.', '}} </strong>
                                            @break

                                            @case(4)
                                                <strong> {{ $d->bed_number.' (I), '  }} </strong>
                                            @break

                                            @case(5)
                                                <strong> {{ $d->bed_number.' (E), '  }} </strong>
                                            @break

                                            @default
                                                {{ $d->bed_number.', '}}
                                        @endswitch

                                    @else
                                        @switch($d->type_pack)
                                            @case(1)
                                                {{ $d->bed_number.' (I)'  }}
                                            @break

                                            @case(2)
                                                {{ $d->bed_number.' (E)'  }}
                                            @break

                                            @case(3)
                                                <strong> {{ $d->bed_number}} </strong>
                                            @break

                                            @case(4)
                                                <strong> {{ $d->bed_number.' (I)'  }} </strong>
                                            @break

                                            @case(5)
                                                <strong> {{ $d->bed_number.' (E)'  }} </strong>
                                            @break

                                            @default
                                                {{ $d->bed_number}}
                                        @endswitch
                                    
                                    @endif
                                @endif
                            @endforeach
                        </TD>
                        <TD ROWSPAN="5" colspan="2">
                            @foreach($subtotales as $s)
                                @if($s->iddiet == "12" && $s->iddiet_request == $dr->id)
                                    {{ $s->subtotal }}
                                @endif
                            @endforeach
                        </TD>

                    </TR>

                    <TR>
                        <TD colspan="2"></TD>
                    </TR>

                    <TR>
                        <TD colspan="2"></TD>
                    </TR>

                    <TR>
                        <TD colspan="2"></TD>
                    </TR>

                    <TR>
                        <TD colspan="2"></TD>
                    </TR>

                    <TR>
                        <TH ROWSPAN="9">PEDIATRICAS</TH>
                        <TH ROWSPAN="3">06 a 09 meses (papilla)</TH>
                        <TD colspan="2">
                            @foreach($dr->details as $d)
                                @if($d->iddiet == "13" && $d->iddiet_request == $dr->id)
                                @if(!$loop->last)
                                
                                @if($d->type_pack == 0)
                                    @switch($d->type_diet_pediatricas)
                                        @case(1)
                                            {{ $d->bed_number.' (D), '  }}
                                        @break

                                        @case(2)
                                            {{ $d->bed_number.' (H), '  }}
                                        @break

                                        @case(3)
                                            {{ $d->bed_number.' (R), '  }}
                                        @break

                                        @case(4)
                                            {{ $d->bed_number.' (RD), '  }}
                                        @break

                                        @case(5)
                                            {{ $d->bed_number.' (BP), '  }}
                                        @break

                                        @case(6)
                                            {{ $d->bed_number.' (BF), '  }}
                                        @break

                                        @case(7)
                                            {{ $d->bed_number.' (AF), '  }}
                                        @break

                                        @case(8)
                                            {{ $d->bed_number.' (BK), '  }}
                                        @break

                                        @case(9)
                                            {{ $d->bed_number.' (AK), '  }}
                                        @break

                                        @case(10)
                                            {{ $d->bed_number.' (C), '  }}
                                        @break

                                        @case(11)
                                            {{ $d->bed_number.' (AU), '  }}
                                        @break

                                        @case(12)
                                            {{ $d->bed_number.' (SL), '  }}
                                        @break

                                        @case(13)
                                            {{ $d->bed_number.' (RE), '  }}
                                        @break

                                        @default
                                            {{ $d->bed_number.', '  }}
                                    @endswitch
                                @endif

                                @if($d->type_pack == 1)
                                    @switch($d->type_diet_pediatricas)
                                        @case(1)
                                            {{ $d->bed_number.' (I-D), '  }}
                                        @break

                                        @case(2)
                                            {{ $d->bed_number.' (I-H), '  }}
                                        @break

                                        @case(3)
                                            {{ $d->bed_number.' (I-R), '  }}
                                        @break

                                        @case(4)
                                            {{ $d->bed_number.' (I-RD), '  }}
                                        @break

                                        @case(5)
                                            {{ $d->bed_number.' (I-BP), '  }}
                                        @break

                                        @case(6)
                                            {{ $d->bed_number.' (I-BF), '  }}
                                        @break

                                        @case(7)
                                            {{ $d->bed_number.' (I-AF), '  }}
                                        @break

                                        @case(8)
                                            {{ $d->bed_number.' (I-BK), '  }}
                                        @break

                                        @case(9)
                                            {{ $d->bed_number.' (I-AK), '  }}
                                        @break

                                        @case(10)
                                            {{ $d->bed_number.' (I-C), '  }}
                                        @break

                                        @case(11)
                                            {{ $d->bed_number.' (I-AU), '  }}
                                        @break

                                        @case(12)
                                            {{ $d->bed_number.' (I-SL), '  }}
                                        @break

                                        @case(13)
                                            {{ $d->bed_number.' (I-RE), '  }}
                                        @break

                                        @default
                                            {{ $d->bed_number.' (I),'  }}
                                    @endswitch
                                @endif

                                @if($d->type_pack == 2)
                                    @switch($d->type_diet_pediatricas)
                                        @case(1)
                                            {{ $d->bed_number.' (E-D), '  }}
                                        @break

                                        @case(2)
                                            {{ $d->bed_number.' (E-H), '  }}
                                        @break

                                        @case(3)
                                            {{ $d->bed_number.' (E-R), '  }}
                                        @break

                                        @case(4)
                                            {{ $d->bed_number.' (E-RD), '  }}
                                        @break

                                        @case(5)
                                            {{ $d->bed_number.' (E-BP), '  }}
                                        @break

                                        @case(6)
                                            {{ $d->bed_number.' (E-BF), '  }}
                                        @break

                                        @case(7)
                                            {{ $d->bed_number.' (E-AF), '  }}
                                        @break

                                        @case(8)
                                            {{ $d->bed_number.' (E-BK), '  }}
                                        @break

                                        @case(9)
                                            {{ $d->bed_number.' (E-AK), '  }}
                                        @break

                                        @case(10)
                                            {{ $d->bed_number.' (E-C), '  }}
                                        @break

                                        @case(11)
                                            {{ $d->bed_number.' (E-AU), '  }}
                                        @break

                                        @case(12)
                                            {{ $d->bed_number.' (E-SL), '  }}
                                        @break

                                        @case(13)
                                            {{ $d->bed_number.' (E-RE), '  }}
                                        @break

                                        @default
                                            {{ $d->bed_number.' (E),'  }}
                                    @endswitch
                                @endif

                                @if($d->type_pack == 3)
                                    @switch($d->type_diet_pediatricas)
                                        @case(1)
                                            <strong> {{ $d->bed_number.' (D), '  }} </strong>
                                        @break

                                        @case(2)
                                            <strong> {{ $d->bed_number.' (H), '  }} </strong>
                                        @break

                                        @case(3)
                                            <strong> {{ $d->bed_number.' (R), '  }} </strong>
                                        @break

                                        @case(4)
                                            <strong> {{ $d->bed_number.' (RD), '  }} </strong>
                                        @break

                                        @case(5)
                                            <strong> {{ $d->bed_number.' (BP), '  }} </strong>
                                        @break

                                        @case(6)
                                            <strong> {{ $d->bed_number.' (BF), '  }} </strong>
                                        @break

                                        @case(7)
                                            <strong> {{ $d->bed_number.' (AF), '  }} </strong>
                                        @break

                                        @case(8)
                                            <strong> {{ $d->bed_number.' (BK), '  }} </strong>
                                        @break

                                        @case(9)
                                            <strong> {{ $d->bed_number.' (AK), '  }} </strong>
                                        @break

                                        @case(10)
                                            <strong> {{ $d->bed_number.' (C), '  }} </strong>
                                        @break

                                        @case(11)
                                            <strong> {{ $d->bed_number.' (AU), '  }} </strong>
                                        @break

                                        @case(12)
                                            <strong> {{ $d->bed_number.' (SL), '  }} </strong>
                                        @break

                                        @case(13)
                                            <strong> {{ $d->bed_number.' (RE), '  }} </strong>
                                        @break

                                        @default
                                            <strong> {{ $d->bed_number.', '  }} </strong>
                                    @endswitch
                                @endif

                                @if($d->type_pack == 4)
                                    @switch($d->type_diet_pediatricas)
                                        @case(1)
                                            <strong> {{ $d->bed_number.' (I-D), '  }} </strong>
                                        @break

                                        @case(2)
                                            <strong> {{ $d->bed_number.' (I-H), '  }} </strong>
                                        @break

                                        @case(3)
                                            <strong> {{ $d->bed_number.' (I-R), '  }} </strong>
                                        @break

                                        @case(4)
                                            <strong> {{ $d->bed_number.' (I-RD), '  }} </strong>
                                        @break

                                        @case(5)
                                            <strong> {{ $d->bed_number.' (I-BP), '  }} </strong>
                                        @break

                                        @case(6)
                                            <strong> {{ $d->bed_number.' (I-BF), '  }} </strong>
                                        @break

                                        @case(7)
                                            <strong> {{ $d->bed_number.' (I-AF), '  }} </strong>
                                        @break

                                        @case(8)
                                            <strong> {{ $d->bed_number.' (I-BK), '  }} </strong>
                                        @break

                                        @case(9)
                                            <strong> {{ $d->bed_number.' (I-AK), '  }} </strong>
                                        @break

                                        @case(10)
                                            <strong> {{ $d->bed_number.' (I-C), '  }} </strong>
                                        @break

                                        @case(11)
                                            <strong> {{ $d->bed_number.' (I-AU), '  }} </strong>
                                        @break

                                        @case(12)
                                            <strong> {{ $d->bed_number.' (I-SL), '  }} </strong>
                                        @break

                                        @case(13)
                                            <strong> {{ $d->bed_number.' (I-RE), '  }} </strong>
                                        @break

                                        @default
                                            <strong> {{ $d->bed_number.' (I), '  }} </strong>
                                    @endswitch
                                @endif

                                @if($d->type_pack == 5)
                                    @switch($d->type_diet_pediatricas)
                                        @case(1)
                                            <strong> {{ $d->bed_number.' (E-D), '  }} </strong>
                                        @break

                                        @case(2)
                                            <strong> {{ $d->bed_number.' (E-H), '  }} </strong>
                                        @break

                                        @case(3)
                                            <strong> {{ $d->bed_number.' (E-R), '  }} </strong>
                                        @break

                                        @case(4)
                                            <strong> {{ $d->bed_number.' (E-RD), '  }} </strong>
                                        @break

                                        @case(5)
                                            <strong> {{ $d->bed_number.' (E-BP), '  }} </strong>
                                        @break

                                        @case(6)
                                            <strong> {{ $d->bed_number.' (E-BF), '  }} </strong>
                                        @break

                                        @case(7)
                                            <strong> {{ $d->bed_number.' (E-AF), '  }} </strong>
                                        @break

                                        @case(8)
                                            <strong> {{ $d->bed_number.' (E-BK), '  }} </strong>
                                        @break

                                        @case(9)
                                            <strong> {{ $d->bed_number.' (E-AK), '  }} </strong>
                                        @break

                                        @case(10)
                                            <strong> {{ $d->bed_number.' (E-C), '  }} </strong>
                                        @break

                                        @case(11)
                                            <strong> {{ $d->bed_number.' (E-AU), '  }} </strong>
                                        @break

                                        @case(12)
                                            <strong> {{ $d->bed_number.' (E-SL), '  }} </strong>
                                        @break

                                        @case(13)
                                            <strong> {{ $d->bed_number.' (E-RE), '  }} </strong>
                                        @break

                                        @default
                                            <strong> {{ $d->bed_number.' (E), '  }} </strong>
                                    @endswitch
                                @endif

                            @else
                                @if($d->type_pack == 0)
                                    @switch($d->type_diet_pediatricas)
                                        @case(1)
                                            {{ $d->bed_number.' (D)'  }}
                                        @break

                                        @case(2)
                                            {{ $d->bed_number.' (H)'  }}
                                        @break

                                        @case(3)
                                            {{ $d->bed_number.' (R)'  }}
                                        @break

                                        @case(4)
                                            {{ $d->bed_number.' (RD)'  }}
                                        @break

                                        @case(5)
                                            {{ $d->bed_number.' (BP)'  }}
                                        @break

                                        @case(6)
                                            {{ $d->bed_number.' (BF)'  }}
                                        @break

                                        @case(7)
                                            {{ $d->bed_number.' (AF)'  }}
                                        @break

                                        @case(8)
                                            {{ $d->bed_number.' (BK)'  }}
                                        @break

                                        @case(9)
                                            {{ $d->bed_number.' (AK)'  }}
                                        @break

                                        @case(10)
                                            {{ $d->bed_number.' (C)'  }}
                                        @break

                                        @case(11)
                                            {{ $d->bed_number.' (AU)'  }}
                                        @break

                                        @case(12)
                                            {{ $d->bed_number.' (SL)'  }}
                                        @break

                                        @case(13)
                                            {{ $d->bed_number.' (RE)'  }}
                                        @break

                                        @default
                                            {{ $d->bed_number.''  }}
                                    @endswitch
                                @endif

                                @if($d->type_pack == 1)
                                    @switch($d->type_diet_pediatricas)
                                        @case(1)
                                            {{ $d->bed_number.' (I-D)'  }}
                                        @break

                                        @case(2)
                                            {{ $d->bed_number.' (I-H)'  }}
                                        @break

                                        @case(3)
                                            {{ $d->bed_number.' (I-R)'  }}
                                        @break

                                        @case(4)
                                            {{ $d->bed_number.' (I-RD)'  }}
                                        @break

                                        @case(5)
                                            {{ $d->bed_number.' (I-BP)'  }}
                                        @break

                                        @case(6)
                                            {{ $d->bed_number.' (I-BF)'  }}
                                        @break

                                        @case(7)
                                            {{ $d->bed_number.' (I-AF)'  }}
                                        @break

                                        @case(8)
                                            {{ $d->bed_number.' (I-BK)'  }}
                                        @break

                                        @case(9)
                                            {{ $d->bed_number.' (I-AK)'  }}
                                        @break

                                        @case(10)
                                            {{ $d->bed_number.' (I-C)'  }}
                                        @break

                                        @case(11)
                                            {{ $d->bed_number.' (I-AU)'  }}
                                        @break

                                        @case(12)
                                            {{ $d->bed_number.' (I-SL)'  }}
                                        @break

                                        @case(13)
                                            {{ $d->bed_number.' (I-RE)'  }}
                                        @break

                                        @default
                                            {{ $d->bed_number.' (I)'  }}
                                    @endswitch
                                @endif

                                @if($d->type_pack == 2)
                                    @switch($d->type_diet_pediatricas)
                                        @case(1)
                                            {{ $d->bed_number.' (E-D)'  }}
                                        @break

                                        @case(2)
                                            {{ $d->bed_number.' (E-H)'  }}
                                        @break

                                        @case(3)
                                            {{ $d->bed_number.' (E-R)'  }}
                                        @break

                                        @case(4)
                                            {{ $d->bed_number.' (E-RD)'  }}
                                        @break

                                        @case(5)
                                            {{ $d->bed_number.' (E-BP)'  }}
                                        @break

                                        @case(6)
                                            {{ $d->bed_number.' (E-BF)'  }}
                                        @break

                                        @case(7)
                                            {{ $d->bed_number.' (E-AF)'  }}
                                        @break

                                        @case(8)
                                            {{ $d->bed_number.' (E-BK)'  }}
                                        @break

                                        @case(9)
                                            {{ $d->bed_number.' (E-AK)'  }}
                                        @break

                                        @case(10)
                                            {{ $d->bed_number.' (E-C)'  }}
                                        @break

                                        @case(11)
                                            {{ $d->bed_number.' (E-AU)'  }}
                                        @break

                                        @case(12)
                                            {{ $d->bed_number.' (E-SL)'  }}
                                        @break

                                        @case(13)
                                            {{ $d->bed_number.' (E-RE)'  }}
                                        @break

                                        @default
                                            {{ $d->bed_number.' (E)'  }}
                                    @endswitch
                                @endif

                                @if($d->type_pack == 3)
                                    @switch($d->type_diet_pediatricas)
                                        @case(1)
                                            <strong> {{ $d->bed_number.' (D)'  }} </strong>
                                        @break

                                        @case(2)
                                            <strong> {{ $d->bed_number.' (H)'  }} </strong>
                                        @break

                                        @case(3)
                                            <strong> {{ $d->bed_number.' (R)'  }} </strong>
                                        @break

                                        @case(4)
                                            <strong> {{ $d->bed_number.' (RD)'  }} </strong>
                                        @break

                                        @case(5)
                                            <strong> {{ $d->bed_number.' (BP)'  }} </strong>
                                        @break

                                        @case(6)
                                            <strong> {{ $d->bed_number.' (BF)'  }} </strong>
                                        @break

                                        @case(7)
                                            <strong> {{ $d->bed_number.' (AF)'  }} </strong>
                                        @break

                                        @case(8)
                                            <strong> {{ $d->bed_number.' (BK)'  }} </strong>
                                        @break

                                        @case(9)
                                            <strong> {{ $d->bed_number.' (AK)'  }} </strong>
                                        @break

                                        @case(10)
                                            <strong> {{ $d->bed_number.' (C)'  }} </strong>
                                        @break

                                        @case(11)
                                            <strong> {{ $d->bed_number.' (AU)'  }} </strong>
                                        @break

                                        @case(12)
                                            <strong> {{ $d->bed_number.' (SL)'  }} </strong>
                                        @break

                                        @case(13)
                                            <strong> {{ $d->bed_number.' (RE)'  }} </strong>
                                        @break

                                        @default
                                            <strong> {{ $d->bed_number.''  }} </strong>
                                    @endswitch
                                @endif

                                @if($d->type_pack == 4)
                                    @switch($d->type_diet_pediatricas)
                                        @case(1)
                                            <strong> {{ $d->bed_number.' (I-D)'  }} </strong>
                                        @break

                                        @case(2)
                                            <strong> {{ $d->bed_number.' (I-H)'  }} </strong>
                                        @break

                                        @case(3)
                                            <strong> {{ $d->bed_number.' (I-R)'  }} </strong>
                                        @break

                                        @case(4)
                                            <strong> {{ $d->bed_number.' (I-RD)'  }} </strong>
                                        @break

                                        @case(5)
                                            <strong> {{ $d->bed_number.' (I-BP)'  }} </strong>
                                        @break

                                        @case(6)
                                            <strong> {{ $d->bed_number.' (I-BF)'  }} </strong>
                                        @break

                                        @case(7)
                                            <strong> {{ $d->bed_number.' (I-AF)'  }} </strong>
                                        @break

                                        @case(8)
                                            <strong> {{ $d->bed_number.' (I-BK)'  }} </strong>
                                        @break

                                        @case(9)
                                            <strong> {{ $d->bed_number.' (I-AK)'  }} </strong>
                                        @break

                                        @case(10)
                                            <strong> {{ $d->bed_number.' (I-C)'  }} </strong>
                                        @break

                                        @case(11)
                                            <strong> {{ $d->bed_number.' (I-AU)'  }} </strong>
                                        @break

                                        @case(12)
                                            <strong> {{ $d->bed_number.' (I-SL)'  }} </strong>
                                        @break

                                        @case(13)
                                            <strong> {{ $d->bed_number.' (I-RE)'  }} </strong>
                                        @break

                                        @default
                                            <strong> {{ $d->bed_number.' (I)'  }} </strong>
                                    @endswitch
                                @endif

                                @if($d->type_pack == 5)
                                    @switch($d->type_diet_pediatricas)
                                        @case(1)
                                            <strong> {{ $d->bed_number.' (E-D)'  }} </strong>
                                        @break

                                        @case(2)
                                            <strong> {{ $d->bed_number.' (E-H)'  }} </strong>
                                        @break

                                        @case(3)
                                            <strong> {{ $d->bed_number.' (E-R)'  }} </strong>
                                        @break

                                        @case(4)
                                            <strong> {{ $d->bed_number.' (E-RD)'  }} </strong>
                                        @break

                                        @case(5)
                                            <strong> {{ $d->bed_number.' (E-BP)'  }} </strong>
                                        @break

                                        @case(6)
                                            <strong> {{ $d->bed_number.' (E-BF)'  }} </strong>
                                        @break

                                        @case(7)
                                            <strong> {{ $d->bed_number.' (E-AF)'  }} </strong>
                                        @break

                                        @case(8)
                                            <strong> {{ $d->bed_number.' (E-BK)'  }} </strong>
                                        @break

                                        @case(9)
                                            <strong> {{ $d->bed_number.' (E-AK)'  }} </strong>
                                        @break

                                        @case(10)
                                            <strong> {{ $d->bed_number.' (E-C)'  }} </strong>
                                        @break

                                        @case(11)
                                            <strong> {{ $d->bed_number.' (E-AU)'  }} </strong>
                                        @break

                                        @case(12)
                                            <strong> {{ $d->bed_number.' (E-SL)'  }} </strong>
                                        @break

                                        @case(13)
                                            <strong> {{ $d->bed_number.' (E-RE)'  }} </strong>
                                        @break

                                        @default
                                            <strong> {{ $d->bed_number.' (E) '  }} </strong>
                                    @endswitch
                                @endif
                            
                            @endif
                                @endif
                            @endforeach
                        </TD>
                        <TD ROWSPAN="3" colspan="2" ALIGN="center">
                            @foreach($subtotales as $s)
                                @if($s->iddiet == "13" && $s->iddiet_request == $dr->id)
                                    {{ $s->subtotal }}
                                @endif
                            @endforeach
                        </TD>
                    </TR>

                    <TR>
                        <TD colspan="2"></TD>
                    </TR>

                    <TR>
                        <TD colspan="2"></TD>
                    </TR>

                    <TR>
                        <TH ROWSPAN="3">09 a 12 meses (picada)</TH>
                        <TD colspan="2">
                            @foreach($dr->details as $d)
                                @if($d->iddiet == "14" && $d->iddiet_request == $dr->id)
                                @if(!$loop->last)
                                
                                @if($d->type_pack == 0)
                                    @switch($d->type_diet_pediatricas)
                                        @case(1)
                                            {{ $d->bed_number.' (D), '  }}
                                        @break

                                        @case(2)
                                            {{ $d->bed_number.' (H), '  }}
                                        @break

                                        @case(3)
                                            {{ $d->bed_number.' (R), '  }}
                                        @break

                                        @case(4)
                                            {{ $d->bed_number.' (RD), '  }}
                                        @break

                                        @case(5)
                                            {{ $d->bed_number.' (BP), '  }}
                                        @break

                                        @case(6)
                                            {{ $d->bed_number.' (BF), '  }}
                                        @break

                                        @case(7)
                                            {{ $d->bed_number.' (AF), '  }}
                                        @break

                                        @case(8)
                                            {{ $d->bed_number.' (BK), '  }}
                                        @break

                                        @case(9)
                                            {{ $d->bed_number.' (AK), '  }}
                                        @break

                                        @case(10)
                                            {{ $d->bed_number.' (C), '  }}
                                        @break

                                        @case(11)
                                            {{ $d->bed_number.' (AU), '  }}
                                        @break

                                        @case(12)
                                            {{ $d->bed_number.' (SL), '  }}
                                        @break

                                        @case(13)
                                            {{ $d->bed_number.' (RE), '  }}
                                        @break

                                        @default
                                            {{ $d->bed_number.', '  }}
                                    @endswitch
                                @endif

                                @if($d->type_pack == 1)
                                    @switch($d->type_diet_pediatricas)
                                        @case(1)
                                            {{ $d->bed_number.' (I-D), '  }}
                                        @break

                                        @case(2)
                                            {{ $d->bed_number.' (I-H), '  }}
                                        @break

                                        @case(3)
                                            {{ $d->bed_number.' (I-R), '  }}
                                        @break

                                        @case(4)
                                            {{ $d->bed_number.' (I-RD), '  }}
                                        @break

                                        @case(5)
                                            {{ $d->bed_number.' (I-BP), '  }}
                                        @break

                                        @case(6)
                                            {{ $d->bed_number.' (I-BF), '  }}
                                        @break

                                        @case(7)
                                            {{ $d->bed_number.' (I-AF), '  }}
                                        @break

                                        @case(8)
                                            {{ $d->bed_number.' (I-BK), '  }}
                                        @break

                                        @case(9)
                                            {{ $d->bed_number.' (I-AK), '  }}
                                        @break

                                        @case(10)
                                            {{ $d->bed_number.' (I-C), '  }}
                                        @break

                                        @case(11)
                                            {{ $d->bed_number.' (I-AU), '  }}
                                        @break

                                        @case(12)
                                            {{ $d->bed_number.' (I-SL), '  }}
                                        @break

                                        @case(13)
                                            {{ $d->bed_number.' (I-RE), '  }}
                                        @break

                                        @default
                                            {{ $d->bed_number.' (I),'  }}
                                    @endswitch
                                @endif

                                @if($d->type_pack == 2)
                                    @switch($d->type_diet_pediatricas)
                                        @case(1)
                                            {{ $d->bed_number.' (E-D), '  }}
                                        @break

                                        @case(2)
                                            {{ $d->bed_number.' (E-H), '  }}
                                        @break

                                        @case(3)
                                            {{ $d->bed_number.' (E-R), '  }}
                                        @break

                                        @case(4)
                                            {{ $d->bed_number.' (E-RD), '  }}
                                        @break

                                        @case(5)
                                            {{ $d->bed_number.' (E-BP), '  }}
                                        @break

                                        @case(6)
                                            {{ $d->bed_number.' (E-BF), '  }}
                                        @break

                                        @case(7)
                                            {{ $d->bed_number.' (E-AF), '  }}
                                        @break

                                        @case(8)
                                            {{ $d->bed_number.' (E-BK), '  }}
                                        @break

                                        @case(9)
                                            {{ $d->bed_number.' (E-AK), '  }}
                                        @break

                                        @case(10)
                                            {{ $d->bed_number.' (E-C), '  }}
                                        @break

                                        @case(11)
                                            {{ $d->bed_number.' (E-AU), '  }}
                                        @break

                                        @case(12)
                                            {{ $d->bed_number.' (E-SL), '  }}
                                        @break

                                        @case(13)
                                            {{ $d->bed_number.' (E-RE), '  }}
                                        @break

                                        @default
                                            {{ $d->bed_number.' (E),'  }}
                                    @endswitch
                                @endif

                                @if($d->type_pack == 3)
                                    @switch($d->type_diet_pediatricas)
                                        @case(1)
                                            <strong> {{ $d->bed_number.' (D), '  }} </strong>
                                        @break

                                        @case(2)
                                            <strong> {{ $d->bed_number.' (H), '  }} </strong>
                                        @break

                                        @case(3)
                                            <strong> {{ $d->bed_number.' (R), '  }} </strong>
                                        @break

                                        @case(4)
                                            <strong> {{ $d->bed_number.' (RD), '  }} </strong>
                                        @break

                                        @case(5)
                                            <strong> {{ $d->bed_number.' (BP), '  }} </strong>
                                        @break

                                        @case(6)
                                            <strong> {{ $d->bed_number.' (BF), '  }} </strong>
                                        @break

                                        @case(7)
                                            <strong> {{ $d->bed_number.' (AF), '  }} </strong>
                                        @break

                                        @case(8)
                                            <strong> {{ $d->bed_number.' (BK), '  }} </strong>
                                        @break

                                        @case(9)
                                            <strong> {{ $d->bed_number.' (AK), '  }} </strong>
                                        @break

                                        @case(10)
                                            <strong> {{ $d->bed_number.' (C), '  }} </strong>
                                        @break

                                        @case(11)
                                            <strong> {{ $d->bed_number.' (AU), '  }} </strong>
                                        @break

                                        @case(12)
                                            <strong> {{ $d->bed_number.' (SL), '  }} </strong>
                                        @break

                                        @case(13)
                                            <strong> {{ $d->bed_number.' (RE), '  }} </strong>
                                        @break

                                        @default
                                            <strong> {{ $d->bed_number.', '  }} </strong>
                                    @endswitch
                                @endif

                                @if($d->type_pack == 4)
                                    @switch($d->type_diet_pediatricas)
                                        @case(1)
                                            <strong> {{ $d->bed_number.' (I-D), '  }} </strong>
                                        @break

                                        @case(2)
                                            <strong> {{ $d->bed_number.' (I-H), '  }} </strong>
                                        @break

                                        @case(3)
                                            <strong> {{ $d->bed_number.' (I-R), '  }} </strong>
                                        @break

                                        @case(4)
                                            <strong> {{ $d->bed_number.' (I-RD), '  }} </strong>
                                        @break

                                        @case(5)
                                            <strong> {{ $d->bed_number.' (I-BP), '  }} </strong>
                                        @break

                                        @case(6)
                                            <strong> {{ $d->bed_number.' (I-BF), '  }} </strong>
                                        @break

                                        @case(7)
                                            <strong> {{ $d->bed_number.' (I-AF), '  }} </strong>
                                        @break

                                        @case(8)
                                            <strong> {{ $d->bed_number.' (I-BK), '  }} </strong>
                                        @break

                                        @case(9)
                                            <strong> {{ $d->bed_number.' (I-AK), '  }} </strong>
                                        @break

                                        @case(10)
                                            <strong> {{ $d->bed_number.' (I-C), '  }} </strong>
                                        @break

                                        @case(11)
                                            <strong> {{ $d->bed_number.' (I-AU), '  }} </strong>
                                        @break

                                        @case(12)
                                            <strong> {{ $d->bed_number.' (I-SL), '  }} </strong>
                                        @break

                                        @case(13)
                                            <strong> {{ $d->bed_number.' (I-RE), '  }} </strong>
                                        @break

                                        @default
                                            <strong> {{ $d->bed_number.' (I), '  }} </strong>
                                    @endswitch
                                @endif

                                @if($d->type_pack == 5)
                                    @switch($d->type_diet_pediatricas)
                                        @case(1)
                                            <strong> {{ $d->bed_number.' (E-D), '  }} </strong>
                                        @break

                                        @case(2)
                                            <strong> {{ $d->bed_number.' (E-H), '  }} </strong>
                                        @break

                                        @case(3)
                                            <strong> {{ $d->bed_number.' (E-R), '  }} </strong>
                                        @break

                                        @case(4)
                                            <strong> {{ $d->bed_number.' (E-RD), '  }} </strong>
                                        @break

                                        @case(5)
                                            <strong> {{ $d->bed_number.' (E-BP), '  }} </strong>
                                        @break

                                        @case(6)
                                            <strong> {{ $d->bed_number.' (E-BF), '  }} </strong>
                                        @break

                                        @case(7)
                                            <strong> {{ $d->bed_number.' (E-AF), '  }} </strong>
                                        @break

                                        @case(8)
                                            <strong> {{ $d->bed_number.' (E-BK), '  }} </strong>
                                        @break

                                        @case(9)
                                            <strong> {{ $d->bed_number.' (E-AK), '  }} </strong>
                                        @break

                                        @case(10)
                                            <strong> {{ $d->bed_number.' (E-C), '  }} </strong>
                                        @break

                                        @case(11)
                                            <strong> {{ $d->bed_number.' (E-AU), '  }} </strong>
                                        @break

                                        @case(12)
                                            <strong> {{ $d->bed_number.' (E-SL), '  }} </strong>
                                        @break

                                        @case(13)
                                            <strong> {{ $d->bed_number.' (E-RE), '  }} </strong>
                                        @break

                                        @default
                                            <strong> {{ $d->bed_number.' (E), '  }} </strong>
                                    @endswitch
                                @endif

                            @else
                                @if($d->type_pack == 0)
                                    @switch($d->type_diet_pediatricas)
                                        @case(1)
                                            {{ $d->bed_number.' (D)'  }}
                                        @break

                                        @case(2)
                                            {{ $d->bed_number.' (H)'  }}
                                        @break

                                        @case(3)
                                            {{ $d->bed_number.' (R)'  }}
                                        @break

                                        @case(4)
                                            {{ $d->bed_number.' (RD)'  }}
                                        @break

                                        @case(5)
                                            {{ $d->bed_number.' (BP)'  }}
                                        @break

                                        @case(6)
                                            {{ $d->bed_number.' (BF)'  }}
                                        @break

                                        @case(7)
                                            {{ $d->bed_number.' (AF)'  }}
                                        @break

                                        @case(8)
                                            {{ $d->bed_number.' (BK)'  }}
                                        @break

                                        @case(9)
                                            {{ $d->bed_number.' (AK)'  }}
                                        @break

                                        @case(10)
                                            {{ $d->bed_number.' (C)'  }}
                                        @break

                                        @case(11)
                                            {{ $d->bed_number.' (AU)'  }}
                                        @break

                                        @case(12)
                                            {{ $d->bed_number.' (SL)'  }}
                                        @break

                                        @case(13)
                                            {{ $d->bed_number.' (RE)'  }}
                                        @break

                                        @default
                                            {{ $d->bed_number.''  }}
                                    @endswitch
                                @endif

                                @if($d->type_pack == 1)
                                    @switch($d->type_diet_pediatricas)
                                        @case(1)
                                            {{ $d->bed_number.' (I-D)'  }}
                                        @break

                                        @case(2)
                                            {{ $d->bed_number.' (I-H)'  }}
                                        @break

                                        @case(3)
                                            {{ $d->bed_number.' (I-R)'  }}
                                        @break

                                        @case(4)
                                            {{ $d->bed_number.' (I-RD)'  }}
                                        @break

                                        @case(5)
                                            {{ $d->bed_number.' (I-BP)'  }}
                                        @break

                                        @case(6)
                                            {{ $d->bed_number.' (I-BF)'  }}
                                        @break

                                        @case(7)
                                            {{ $d->bed_number.' (I-AF)'  }}
                                        @break

                                        @case(8)
                                            {{ $d->bed_number.' (I-BK)'  }}
                                        @break

                                        @case(9)
                                            {{ $d->bed_number.' (I-AK)'  }}
                                        @break

                                        @case(10)
                                            {{ $d->bed_number.' (I-C)'  }}
                                        @break

                                        @case(11)
                                            {{ $d->bed_number.' (I-AU)'  }}
                                        @break

                                        @case(12)
                                            {{ $d->bed_number.' (I-SL)'  }}
                                        @break

                                        @case(13)
                                            {{ $d->bed_number.' (I-RE)'  }}
                                        @break

                                        @default
                                            {{ $d->bed_number.' (I)'  }}
                                    @endswitch
                                @endif

                                @if($d->type_pack == 2)
                                    @switch($d->type_diet_pediatricas)
                                        @case(1)
                                            {{ $d->bed_number.' (E-D)'  }}
                                        @break

                                        @case(2)
                                            {{ $d->bed_number.' (E-H)'  }}
                                        @break

                                        @case(3)
                                            {{ $d->bed_number.' (E-R)'  }}
                                        @break

                                        @case(4)
                                            {{ $d->bed_number.' (E-RD)'  }}
                                        @break

                                        @case(5)
                                            {{ $d->bed_number.' (E-BP)'  }}
                                        @break

                                        @case(6)
                                            {{ $d->bed_number.' (E-BF)'  }}
                                        @break

                                        @case(7)
                                            {{ $d->bed_number.' (E-AF)'  }}
                                        @break

                                        @case(8)
                                            {{ $d->bed_number.' (E-BK)'  }}
                                        @break

                                        @case(9)
                                            {{ $d->bed_number.' (E-AK)'  }}
                                        @break

                                        @case(10)
                                            {{ $d->bed_number.' (E-C)'  }}
                                        @break

                                        @case(11)
                                            {{ $d->bed_number.' (E-AU)'  }}
                                        @break

                                        @case(12)
                                            {{ $d->bed_number.' (E-SL)'  }}
                                        @break

                                        @case(13)
                                            {{ $d->bed_number.' (E-RE)'  }}
                                        @break

                                        @default
                                            {{ $d->bed_number.' (E)'  }}
                                    @endswitch
                                @endif

                                @if($d->type_pack == 3)
                                    @switch($d->type_diet_pediatricas)
                                        @case(1)
                                            <strong> {{ $d->bed_number.' (D)'  }} </strong>
                                        @break

                                        @case(2)
                                            <strong> {{ $d->bed_number.' (H)'  }} </strong>
                                        @break

                                        @case(3)
                                            <strong> {{ $d->bed_number.' (R)'  }} </strong>
                                        @break

                                        @case(4)
                                            <strong> {{ $d->bed_number.' (RD)'  }} </strong>
                                        @break

                                        @case(5)
                                            <strong> {{ $d->bed_number.' (BP)'  }} </strong>
                                        @break

                                        @case(6)
                                            <strong> {{ $d->bed_number.' (BF)'  }} </strong>
                                        @break

                                        @case(7)
                                            <strong> {{ $d->bed_number.' (AF)'  }} </strong>
                                        @break

                                        @case(8)
                                            <strong> {{ $d->bed_number.' (BK)'  }} </strong>
                                        @break

                                        @case(9)
                                            <strong> {{ $d->bed_number.' (AK)'  }} </strong>
                                        @break

                                        @case(10)
                                            <strong> {{ $d->bed_number.' (C)'  }} </strong>
                                        @break

                                        @case(11)
                                            <strong> {{ $d->bed_number.' (AU)'  }} </strong>
                                        @break

                                        @case(12)
                                            <strong> {{ $d->bed_number.' (SL)'  }} </strong>
                                        @break

                                        @case(13)
                                            <strong> {{ $d->bed_number.' (RE)'  }} </strong>
                                        @break

                                        @default
                                            <strong> {{ $d->bed_number.''  }} </strong>
                                    @endswitch
                                @endif

                                @if($d->type_pack == 4)
                                    @switch($d->type_diet_pediatricas)
                                        @case(1)
                                            <strong> {{ $d->bed_number.' (I-D)'  }} </strong>
                                        @break

                                        @case(2)
                                            <strong> {{ $d->bed_number.' (I-H)'  }} </strong>
                                        @break

                                        @case(3)
                                            <strong> {{ $d->bed_number.' (I-R)'  }} </strong>
                                        @break

                                        @case(4)
                                            <strong> {{ $d->bed_number.' (I-RD)'  }} </strong>
                                        @break

                                        @case(5)
                                            <strong> {{ $d->bed_number.' (I-BP)'  }} </strong>
                                        @break

                                        @case(6)
                                            <strong> {{ $d->bed_number.' (I-BF)'  }} </strong>
                                        @break

                                        @case(7)
                                            <strong> {{ $d->bed_number.' (I-AF)'  }} </strong>
                                        @break

                                        @case(8)
                                            <strong> {{ $d->bed_number.' (I-BK)'  }} </strong>
                                        @break

                                        @case(9)
                                            <strong> {{ $d->bed_number.' (I-AK)'  }} </strong>
                                        @break

                                        @case(10)
                                            <strong> {{ $d->bed_number.' (I-C)'  }} </strong>
                                        @break

                                        @case(11)
                                            <strong> {{ $d->bed_number.' (I-AU)'  }} </strong>
                                        @break

                                        @case(12)
                                            <strong> {{ $d->bed_number.' (I-SL)'  }} </strong>
                                        @break

                                        @case(13)
                                            <strong> {{ $d->bed_number.' (I-RE)'  }} </strong>
                                        @break

                                        @default
                                            <strong> {{ $d->bed_number.' (I)'  }} </strong>
                                    @endswitch
                                @endif

                                @if($d->type_pack == 5)
                                    @switch($d->type_diet_pediatricas)
                                        @case(1)
                                            <strong> {{ $d->bed_number.' (E-D)'  }} </strong>
                                        @break

                                        @case(2)
                                            <strong> {{ $d->bed_number.' (E-H)'  }} </strong>
                                        @break

                                        @case(3)
                                            <strong> {{ $d->bed_number.' (E-R)'  }} </strong>
                                        @break

                                        @case(4)
                                            <strong> {{ $d->bed_number.' (E-RD)'  }} </strong>
                                        @break

                                        @case(5)
                                            <strong> {{ $d->bed_number.' (E-BP)'  }} </strong>
                                        @break

                                        @case(6)
                                            <strong> {{ $d->bed_number.' (E-BF)'  }} </strong>
                                        @break

                                        @case(7)
                                            <strong> {{ $d->bed_number.' (E-AF)'  }} </strong>
                                        @break

                                        @case(8)
                                            <strong> {{ $d->bed_number.' (E-BK)'  }} </strong>
                                        @break

                                        @case(9)
                                            <strong> {{ $d->bed_number.' (E-AK)'  }} </strong>
                                        @break

                                        @case(10)
                                            <strong> {{ $d->bed_number.' (E-C)'  }} </strong>
                                        @break

                                        @case(11)
                                            <strong> {{ $d->bed_number.' (E-AU)'  }} </strong>
                                        @break

                                        @case(12)
                                            <strong> {{ $d->bed_number.' (E-SL)'  }} </strong>
                                        @break

                                        @case(13)
                                            <strong> {{ $d->bed_number.' (E-RE)'  }} </strong>
                                        @break

                                        @default
                                            <strong> {{ $d->bed_number.' (E) '  }} </strong>
                                    @endswitch
                                @endif
                            
                            @endif
                                @endif
                            @endforeach
                        </TD>
                        <TD ROWSPAN="3" colspan="2" ALIGN="center">
                            @foreach($subtotales as $s)
                                @if($s->iddiet == "14" && $s->iddiet_request == $dr->id)
                                    {{ $s->subtotal }}
                                @endif
                            @endforeach
                        </TD>
                    </TR>

                    <TR>
                        <TD colspan="2"></TD>
                    </TR>

                    <TR>
                        <TD colspan="2"></TD>
                    </TR>

                    <TR>
                        <TH ROWSPAN="3">01 a 07 años (libre)</TH>
                        <TD colspan="2">
                            @foreach($dr->details as $d)
                                @if($d->iddiet == "15" && $d->iddiet_request == $dr->id)
                                    @if(!$loop->last)

                                        @switch($d->type_pack)
                                            @case(1)
                                                {{ $d->bed_number.' (I), '  }}
                                            @break

                                            @case(2)
                                                {{ $d->bed_number.' (E), '  }}
                                            @break

                                            @case(3)
                                                <strong> {{ $d->bed_number.', '}} </strong>
                                            @break

                                            @case(4)
                                                <strong> {{ $d->bed_number.' (I), '  }} </strong>
                                            @break

                                            @case(5)
                                                <strong> {{ $d->bed_number.' (E), '  }} </strong>
                                            @break

                                            @default
                                                {{ $d->bed_number.', '}}
                                        @endswitch

                                    @else
                                        @switch($d->type_pack)
                                            @case(1)
                                                {{ $d->bed_number.' (I)'  }}
                                            @break

                                            @case(2)
                                                {{ $d->bed_number.' (E)'  }}
                                            @break

                                            @case(3)
                                                <strong> {{ $d->bed_number}} </strong>
                                            @break

                                            @case(4)
                                                <strong> {{ $d->bed_number.' (I)'  }} </strong>
                                            @break

                                            @case(5)
                                                <strong> {{ $d->bed_number.' (E)'  }} </strong>
                                            @break

                                            @default
                                                {{ $d->bed_number}}
                                        @endswitch
                                    
                                    @endif
                                @endif
                            @endforeach
                        </TD>
                        <TD ROWSPAN="3" colspan="2" ALIGN="center">
                            @foreach($subtotales as $s)
                                @if($s->iddiet == "15" && $s->iddiet_request == $dr->id)
                                    {{ $s->subtotal }}
                                @endif
                            @endforeach
                        </TD>
                    </TR>

                    <TR>
                        <TD colspan="2"></TD>
                    </TR>

                    <TR>
                        <TD colspan="2"></TD>
                    </TR>

                    <TR>
                        <TH ROWSPAN="3" colspan="2" ALIGN="center">Dietas calculadas por Nutrición</TH>
                        <TD colspan="2">
                            @foreach($dr->details as $d)
                                @if($d->iddiet == "16" && $d->iddiet_request == $dr->id)
                                    @if(!$loop->last)

                                        @switch($d->type_pack)
                                            @case(1)
                                                {{ $d->bed_number.' (I), '  }}
                                            @break

                                            @case(2)
                                                {{ $d->bed_number.' (E), '  }}
                                            @break

                                            @case(3)
                                                <strong> {{ $d->bed_number.', '}} </strong>
                                            @break

                                            @case(4)
                                                <strong> {{ $d->bed_number.' (I), '  }} </strong>
                                            @break

                                            @case(5)
                                                <strong> {{ $d->bed_number.' (E), '  }} </strong>
                                            @break

                                            @default
                                                {{ $d->bed_number.', '}}
                                        @endswitch

                                    @else
                                        @switch($d->type_pack)
                                            @case(1)
                                                {{ $d->bed_number.' (I)'  }}
                                            @break

                                            @case(2)
                                                {{ $d->bed_number.' (E)'  }}
                                            @break

                                            @case(3)
                                                <strong> {{ $d->bed_number}} </strong>
                                            @break

                                            @case(4)
                                                <strong> {{ $d->bed_number.' (I)'  }} </strong>
                                            @break

                                            @case(5)
                                                <strong> {{ $d->bed_number.' (E)'  }} </strong>
                                            @break

                                            @default
                                                {{ $d->bed_number}}
                                        @endswitch
                                    
                                    @endif
                                @endif
                            @endforeach
                        </TD>
                        <TD ROWSPAN="3" colspan="2">
                            @foreach($subtotales as $s)
                                @if($s->iddiet == "16" && $s->iddiet_request == $dr->id)
                                    {{ $s->subtotal }}
                                @endif
                            @endforeach
                        </TD>

                    </TR>

                    <TR>
                        <TD colspan="2"></TD>
                    </TR>

                    <TR>
                        <TD colspan="2"></TD>
                    </TR>

                    <TR>
                        <TH ROWSPAN="3" colspan="2" ALIGN="center" >OTRAS (Especificar)</TH>
                        <TD colspan="2" height="15">
                            @foreach($dr->details as $d)
                                @if($d->iddiet >= 19 && $d->iddiet <= 29 && $d->iddiet_request == $dr->id)
                                    @if(!$loop->last )

                                        @switch($d->iddiet)
                                            @case(19)
                                                @switch($d->type_pack)
                                                    @case(1)
                                                        {{ $d->bed_number.' (I-DH),'  }}
                                                    @break

                                                    @case(2)
                                                        {{ $d->bed_number.' (E-DH),'  }}
                                                    @break

                                                    @case(3)
                                                        <strong> {{ $d->bed_number.' (DH),'  }} </strong>
                                                    @break

                                                    @case(4)
                                                        <strong> {{ $d->bed_number.' (I-DH),'  }} </strong>
                                                    @break

                                                    @case(5)
                                                        <strong> {{ $d->bed_number.' (E-DH),'  }} </strong>
                                                    @break

                                                    @default
                                                        {{ $d->bed_number." (DH)," }}
                                                @endswitch
                                            @break

                                            @case(20)
                                                @if($d->type_pack == 0)
                                                    @switch($d->type_diet_renal)
                                                        @case(1)
                                                            {{ $d->bed_number.' (RD), '  }}
                                                        @break

                                                        @default
                                                            {{ $d->bed_number.' (R), '  }}
                                                    @endswitch
                                                @endif

                                                @if($d->type_pack == 1)
                                                    @switch($d->type_diet_renal)
                                                        @case(1)
                                                            {{ $d->bed_number.' (I-RD), '  }}
                                                        @break

                                                        @default
                                                            {{ $d->bed_number.' (I-R), '  }}
                                                    @endswitch
                                                @endif

                                                @if($d->type_pack == 2)
                                                    @switch($d->type_diet_renal)
                                                        @case(1)
                                                            {{ $d->bed_number.' (E-RD), '  }}
                                                        @break

                                                        @default
                                                            {{ $d->bed_number.' (E-R), '  }}
                                                    @endswitch
                                                @endif

                                                @if($d->type_pack == 3)
                                                    @switch($d->type_diet_renal)
                                                        @case(1)
                                                            <strong>{{ $d->bed_number.' (RD), '  }}</strong>
                                                        @break

                                                        @default
                                                            <strong>{{ $d->bed_number.' (R), '}}</strong>
                                                    @endswitch
                                                @endif

                                                @if($d->type_pack == 4)
                                                    @switch($d->type_diet_renal)
                                                        @case(1)
                                                            <strong>{{ $d->bed_number.' (I-RD), '  }}</strong>
                                                        @break

                                                        @default
                                                            <strong>{{ $d->bed_number.' (I-R), '}}</strong>
                                                    @endswitch
                                                @endif

                                                @if($d->type_pack == 5)
                                                    @switch($d->type_diet_renal)
                                                        @case(1)
                                                            <strong>{{ $d->bed_number.' (E-RD), '  }}</strong>
                                                        @break

                                                        @default
                                                            <strong>{{ $d->bed_number.' (E-R), '}}</strong>
                                                    @endswitch
                                                @endif
                                            @break

                                            @case(21)
                                                @switch($d->type_pack)
                                                    @case(1)
                                                        {{ $d->bed_number.' (I-BP), '  }}
                                                    @break

                                                    @case(2)
                                                        {{ $d->bed_number.' (E-BP), '  }}
                                                    @break

                                                    @case(3)
                                                        <strong> {{ $d->bed_number.' (BP), '  }} </strong>
                                                    @break

                                                    @case(4)
                                                        <strong> {{ $d->bed_number.' (I-BP), '  }} </strong>
                                                    @break

                                                    @case(5)
                                                        <strong> {{ $d->bed_number.' (E-BP), '  }} </strong>
                                                    @break

                                                    @default
                                                        {{ $d->bed_number." (BP), " }}
                                                @endswitch
                                            @break

                                            @case(22)
                                                @switch($d->type_pack)
                                                    @case(1)
                                                        {{ $d->bed_number.' (I-BF), '  }}
                                                    @break

                                                    @case(2)
                                                        {{ $d->bed_number.' (E-BF), '  }}
                                                    @break

                                                    @case(3)
                                                        <strong> {{ $d->bed_number.' (BF), '  }} </strong>
                                                    @break

                                                    @case(4)
                                                        <strong> {{ $d->bed_number.' (I-BF), '  }} </strong>
                                                    @break

                                                    @case(5)
                                                        <strong> {{ $d->bed_number.' (E-BF), '  }} </strong>
                                                    @break

                                                    @default
                                                        {{ $d->bed_number." (BF), " }}
                                                @endswitch
                                            @break

                                            @case(23)
                                                @switch($d->type_pack)
                                                    @case(1)
                                                        {{ $d->bed_number.' (I-BK), '  }}
                                                    @break

                                                    @case(2)
                                                        {{ $d->bed_number.' (E-BK), '  }}
                                                    @break

                                                    @case(3)
                                                        <strong> {{ $d->bed_number.' (BK), '  }} </strong>
                                                    @break

                                                    @case(4)
                                                        <strong> {{ $d->bed_number.' (I-BK), '  }} </strong>
                                                    @break

                                                    @case(5)
                                                        <strong> {{ $d->bed_number.' (E-BK), '  }} </strong>
                                                    @break

                                                    @default
                                                        {{ $d->bed_number." (BK), " }}
                                                @endswitch
                                            @break

                                            @case(24)
                                                @switch($d->type_pack)
                                                    @case(1)
                                                        {{ $d->bed_number.' (I-C), '  }}
                                                    @break

                                                    @case(2)
                                                        {{ $d->bed_number.' (E-C), '  }}
                                                    @break

                                                    @case(3)
                                                        <strong> {{ $d->bed_number.' (C), '  }} </strong>
                                                    @break

                                                    @case(4)
                                                        <strong> {{ $d->bed_number.' (I-C), '  }} </strong>
                                                    @break

                                                    @case(5)
                                                        <strong> {{ $d->bed_number.' (E-C), '  }} </strong>
                                                    @break

                                                    @default
                                                        {{ $d->bed_number." (C), " }}
                                                @endswitch
                                            @break

                                            @case(25)
                                                @switch($d->type_pack)
                                                    @case(1)
                                                        {{ $d->bed_number.' (I-AU), '  }}
                                                    @break

                                                    @case(2)
                                                        {{ $d->bed_number.' (E-AU), '  }}
                                                    @break

                                                    @case(3)
                                                        <strong> {{ $d->bed_number.' (AU), '  }} </strong>
                                                    @break

                                                    @case(4)
                                                        <strong> {{ $d->bed_number.' (I-AU), '  }} </strong>
                                                    @break

                                                    @case(5)
                                                        <strong> {{ $d->bed_number.' (E-AU), '  }} </strong>
                                                    @break

                                                    @default
                                                        {{ $d->bed_number." (AU), " }}
                                                @endswitch
                                            @break

                                            @case(26)
                                                @switch($d->type_pack)
                                                    @case(1)
                                                        {{ $d->bed_number.' (I-AK), '  }}
                                                    @break

                                                    @case(2)
                                                        {{ $d->bed_number.' (E-AK), '  }}
                                                    @break

                                                    @case(3)
                                                        <strong> {{ $d->bed_number.' (AK), '  }} </strong>
                                                    @break

                                                    @case(4)
                                                        <strong> {{ $d->bed_number.' (I-AK), '  }} </strong>
                                                    @break

                                                    @case(5)
                                                        <strong> {{ $d->bed_number.' (E-AK), '  }} </strong>
                                                    @break

                                                    @default
                                                        {{ $d->bed_number." (AK), " }}
                                                @endswitch
                                            @break

                                            @case(27)
                                                @switch($d->type_pack)
                                                    @case(1)
                                                        {{ $d->bed_number.' (I-SL), '   }}
                                                    @break

                                                    @case(2)
                                                        {{ $d->bed_number.' (E-SL), '  }}
                                                    @break

                                                    @case(3)
                                                        <strong> {{ $d->bed_number.' (SL), '  }} </strong>
                                                    @break

                                                    @case(4)
                                                        <strong> {{ $d->bed_number.' (I-SL), '  }} </strong>
                                                    @break

                                                    @case(5)
                                                        <strong> {{ $d->bed_number.' (E-SL), '  }} </strong>
                                                    @break

                                                    @default
                                                        {{ $d->bed_number." (SL), " }}
                                                @endswitch
                                            @break

                                            @case(28)
                                                @if($d->type_pack == 0)
                                                    @switch($d->type_diet_de_viaje)
                                                        @case(1)
                                                            {{ $d->bed_number.' (DV-L), '  }}
                                                        @break

                                                        @case(2)
                                                            {{ $d->bed_number.' (DV-B), '  }}
                                                        @break

                                                        @case(3)
                                                            {{ $d->bed_number.' (DV-D), '  }}
                                                        @break

                                                        @case(4)
                                                            {{ $d->bed_number.' (DV-H), '  }}
                                                        @break

                                                        @case(5)
                                                            {{ $d->bed_number.' (DV-DH), '  }}
                                                        @break

                                                        @case(6)
                                                            {{ $d->bed_number.' (DV-P), '  }}
                                                        @break

                                                        @default
                                                            {{ $d->bed_number.' (DV), '  }}
                                                    @endswitch
                                                @endif

                                                @if($d->type_pack == 1)
                                                    @switch($d->type_diet_de_viaje)
                                                        @case(1)
                                                            {{ $d->bed_number.' (I-DV-L), '  }}
                                                        @break

                                                        @case(2)
                                                            {{ $d->bed_number.' (I-DV-B), '  }}
                                                        @break

                                                        @case(3)
                                                            {{ $d->bed_number.' (I-DV-D), '  }}
                                                        @break

                                                        @case(4)
                                                            {{ $d->bed_number.' (I-DV-H), '  }}
                                                        @break

                                                        @case(5)
                                                            {{ $d->bed_number.' (I-DV-DH), '  }}
                                                        @break

                                                        @case(6)
                                                            {{ $d->bed_number.' (I-DV-P), '  }}
                                                        @break

                                                        @default
                                                            {{ $d->bed_number.' (I-DV), '  }}
                                                    @endswitch
                                                @endif

                                                @if($d->type_pack == 2)
                                                    @switch($d->type_diet_de_viaje)
                                                        @case(1)
                                                            {{ $d->bed_number.' (E-DV-L), '  }}
                                                        @break

                                                        @case(2)
                                                            {{ $d->bed_number.' (E-DV-B), '  }}
                                                        @break

                                                        @case(3)
                                                            {{ $d->bed_number.' (E-DV-D), '  }}
                                                        @break

                                                        @case(4)
                                                            {{ $d->bed_number.' (E-DV-H), '  }}
                                                        @break

                                                        @case(5)
                                                            {{ $d->bed_number.' (E-DV-DH), '  }}
                                                        @break

                                                        @case(6)
                                                            {{ $d->bed_number.' (E-DV-P), '  }}
                                                        @break

                                                        @default
                                                            {{ $d->bed_number.' (E-DV), '  }}
                                                    @endswitch
                                                @endif

                                                @if($d->type_pack == 3)
                                                    @switch($d->type_diet_de_viaje)
                                                        @case(1)
                                                            <strong>{{ $d->bed_number.' (DV-L), '  }}</strong>
                                                        @break

                                                        @case(2)
                                                            <strong>{{ $d->bed_number.' (DV-B), '  }}</strong>
                                                        @break

                                                        @case(3)
                                                            <strong>{{ $d->bed_number.' (DV-D), '  }}</strong>
                                                        @break

                                                        @case(4)
                                                            <strong>{{ $d->bed_number.' (DV-H), '  }}</strong>
                                                        @break

                                                        @case(5)
                                                            <strong>{{ $d->bed_number.' (DV-DH), '  }}</strong>
                                                        @break

                                                        @case(6)
                                                            <strong>{{ $d->bed_number.' (DV-P), '  }}</strong>
                                                        @break

                                                        @default
                                                            <strong>{{ $d->bed_number.' (DV), '  }}</strong>

                                                    @endswitch
                                                @endif

                                                @if($d->type_pack == 4)
                                                    @switch($d->type_diet_de_viaje)
                                                        @case(1)
                                                            <strong>{{ $d->bed_number.' (I-DV-L), '  }}</strong>
                                                        @break

                                                        @case(2)
                                                            <strong>{{ $d->bed_number.' (I-DV-B), '  }}</strong>
                                                        @break

                                                        @case(3)
                                                            <strong>{{ $d->bed_number.' (I-DV-D), '  }}</strong>
                                                        @break

                                                        @case(4)
                                                            <strong>{{ $d->bed_number.' (I-DV-H), '  }}</strong>
                                                        @break

                                                        @case(5)
                                                            <strong>{{ $d->bed_number.' (I-DV-DH), '  }}</strong>
                                                        @break

                                                        @case(6)
                                                            <strong>{{ $d->bed_number.' (I-DV-P), '  }}</strong>
                                                        @break

                                                        @default
                                                            <strong>{{ $d->bed_number.' (I-DV), '  }}</strong>

                                                    @endswitch
                                                @endif

                                                @if($d->type_pack == 5)
                                                    @switch($d->type_diet_de_viaje)
                                                        @case(1)
                                                            <strong>{{ $d->bed_number.' (E-DV-L), '  }}</strong>
                                                        @break

                                                        @case(2)
                                                            <strong>{{ $d->bed_number.' (E-DV-B), '  }}</strong>
                                                        @break

                                                        @case(3)
                                                            <strong>{{ $d->bed_number.' (E-DV-D), '  }}</strong>
                                                        @break

                                                        @case(4)
                                                            <strong>{{ $d->bed_number.' (E-DV-H), '  }}</strong>
                                                        @break

                                                        @case(5)
                                                            <strong>{{ $d->bed_number.' (E-DV-DH), '  }}</strong>
                                                        @break

                                                        @case(6)
                                                            <strong>{{ $d->bed_number.' (E-DV-P), '  }}</strong>
                                                        @break

                                                        @default
                                                            <strong>{{ $d->bed_number.' (E-DV), '  }}</strong>
                                                    @endswitch
                                                @endif

                                            @break

                                            @case(29)
                                                @if($d->type_pack == 0)
                                                    @switch($d->type_diet_de_viaje)
                                                        @case(1)
                                                            {{ $d->bed_number.' (RE-L), '  }}
                                                        @break

                                                        @case(2)
                                                            {{ $d->bed_number.' (RE-B), '  }}
                                                        @break

                                                        @case(3)
                                                            {{ $d->bed_number.' (RE-D), '  }}
                                                        @break

                                                        @case(4)
                                                            {{ $d->bed_number.' (RE-H), '  }}
                                                        @break

                                                        @case(5)
                                                            {{ $d->bed_number.' (RE-DH), '  }}
                                                        @break

                                                        @case(6)
                                                            {{ $d->bed_number.' (RE-P), '  }}
                                                        @break

                                                        @default
                                                            {{ $d->bed_number.' (RE), '  }}
                                                    @endswitch
                                                @endif

                                                @if($d->type_pack == 1)
                                                    @switch($d->type_diet_de_viaje)
                                                        @case(1)
                                                            {{ $d->bed_number.' (I-RE-L), '  }}
                                                        @break

                                                        @case(2)
                                                            {{ $d->bed_number.' (I-RE-B), '  }}
                                                        @break

                                                        @case(3)
                                                            {{ $d->bed_number.' (I-RE-D), '  }}
                                                        @break

                                                        @case(4)
                                                            {{ $d->bed_number.' (I-RE-H), '  }}
                                                        @break

                                                        @case(5)
                                                            {{ $d->bed_number.' (I-RE-DH), '  }}
                                                        @break

                                                        @case(6)
                                                            {{ $d->bed_number.' (I-RE-P), '  }}
                                                        @break

                                                        @default
                                                            {{ $d->bed_number.' (I-RE), '  }}
                                                    @endswitch
                                                @endif

                                                @if($d->type_pack == 2)
                                                    @switch($d->type_diet_de_viaje)
                                                        @case(1)
                                                            {{ $d->bed_number.' (E-RE-L), '  }}
                                                        @break

                                                        @case(2)
                                                            {{ $d->bed_number.' (E-RE-B), '  }}
                                                        @break

                                                        @case(3)
                                                            {{ $d->bed_number.' (E-RE-D), '  }}
                                                        @break

                                                        @case(4)
                                                            {{ $d->bed_number.' (E-RE-H), '  }}
                                                        @break

                                                        @case(5)
                                                            {{ $d->bed_number.' (E-RE-DH), '  }}
                                                        @break

                                                        @case(6)
                                                            {{ $d->bed_number.' (E-RE-P), '  }}
                                                        @break

                                                        @default
                                                            {{ $d->bed_number.' (E-RE), '  }}
                                                    @endswitch
                                                @endif

                                                @if($d->type_pack == 3)
                                                    @switch($d->type_diet_de_viaje)
                                                        @case(1)
                                                            <strong>{{ $d->bed_number.' (RE-L), '  }}</strong>
                                                        @break

                                                        @case(2)
                                                            <strong>{{ $d->bed_number.' (RE-B), '  }}</strong>
                                                        @break

                                                        @case(3)
                                                            <strong>{{ $d->bed_number.' (RE-D), '  }}</strong>
                                                        @break

                                                        @case(4)
                                                            <strong>{{ $d->bed_number.' (RE-H), '  }}</strong>
                                                        @break

                                                        @case(5)
                                                            <strong>{{ $d->bed_number.' (RE-DH), '  }}</strong>
                                                        @break

                                                        @case(6)
                                                            <strong>{{ $d->bed_number.' (RE-P), '  }}</strong>
                                                        @break

                                                        @default
                                                            <strong>{{ $d->bed_number.' (RE), '  }}</strong>

                                                    @endswitch
                                                @endif

                                                @if($d->type_pack == 4)
                                                    @switch($d->type_diet_de_viaje)
                                                        @case(1)
                                                            <strong>{{ $d->bed_number.' (I-RE-L), '  }}</strong>
                                                        @break

                                                        @case(2)
                                                            <strong>{{ $d->bed_number.' (I-RE-B), '  }}</strong>
                                                        @break

                                                        @case(3)
                                                            <strong>{{ $d->bed_number.' (I-RE-D), '  }}</strong>
                                                        @break

                                                        @case(4)
                                                            <strong>{{ $d->bed_number.' (I-RE-H), '  }}</strong>
                                                        @break

                                                        @case(5)
                                                            <strong>{{ $d->bed_number.' (I-RE-DH), '  }}</strong>
                                                        @break

                                                        @case(6)
                                                            <strong>{{ $d->bed_number.' (I-RE-P), '  }}</strong>
                                                        @break

                                                        @default
                                                            <strong>{{ $d->bed_number.' (I-RE), '  }}</strong>

                                                    @endswitch
                                                @endif

                                                @if($d->type_pack == 5)
                                                    @switch($d->type_diet_de_viaje)
                                                        @case(1)
                                                            <strong>{{ $d->bed_number.' (E-RE-L), '  }}</strong>
                                                        @break

                                                        @case(2)
                                                            <strong>{{ $d->bed_number.' (E-RE-B), '  }}</strong>
                                                        @break

                                                        @case(3)
                                                            <strong>{{ $d->bed_number.' (E-RE-D), '  }}</strong>
                                                        @break

                                                        @case(4)
                                                            <strong>{{ $d->bed_number.' (E-RE-H), '  }}</strong>
                                                        @break

                                                        @case(5)
                                                            <strong>{{ $d->bed_number.' (E-RE-DH), '  }}</strong>
                                                        @break

                                                        @case(6)
                                                            <strong>{{ $d->bed_number.' (E-RE-P), '  }}</strong>
                                                        @break

                                                        @default
                                                            <strong>{{ $d->bed_number.' (E-RE), '  }}</strong>
                                                    @endswitch
                                                @endif

                                            @break
                                        @endswitch


                                    @else
                                        @switch($d->iddiet)
                                            @case(19)
                                                @switch($d->type_pack)
                                                    @case(1)
                                                        {{ $d->bed_number.' (I-DH)'  }}
                                                    @break

                                                    @case(2)
                                                        {{ $d->bed_number.' (E-DH)'  }}
                                                    @break

                                                    @case(3)
                                                        <strong> {{ $d->bed_number.' (DH)'  }} </strong>
                                                    @break

                                                    @case(4)
                                                        <strong> {{ $d->bed_number.' (I-DH)'  }} </strong>
                                                    @break

                                                    @case(5)
                                                        <strong> {{ $d->bed_number.' (E-DH)'  }} </strong>
                                                    @break

                                                    @default
                                                        {{ $d->bed_number." (DH)" }}
                                                @endswitch
                                            @break

                                            @case(20)
                                                @if($d->type_pack == 0)
                                                    @switch($d->type_diet_renal)
                                                        @case(1)
                                                            {{ $d->bed_number.' (RD)'  }}
                                                        @break

                                                        @default
                                                            {{ $d->bed_number.' (R)'  }}
                                                    @endswitch
                                                @endif

                                                @if($d->type_pack == 1)
                                                    @switch($d->type_diet_renal)
                                                        @case(1)
                                                            {{ $d->bed_number.' (I-RD)'  }}
                                                        @break

                                                        @default
                                                            {{ $d->bed_number.' (I-R)'  }}
                                                    @endswitch
                                                @endif

                                                @if($d->type_pack == 2)
                                                    @switch($d->type_diet_renal)
                                                        @case(1)
                                                            {{ $d->bed_number.' (E-RD)'  }}
                                                        @break

                                                        @default
                                                            {{ $d->bed_number.' (E-R)'  }}
                                                    @endswitch
                                                @endif

                                                @if($d->type_pack == 3)
                                                    @switch($d->type_diet_renal)
                                                        @case(1)
                                                            <strong>{{ $d->bed_number.' (RD)'  }}</strong>
                                                        @break

                                                        @default
                                                            <strong>{{ $d->bed_number.' (R)'}}</strong>
                                                    @endswitch
                                                @endif

                                                @if($d->type_pack == 4)
                                                    @switch($d->type_diet_renal)
                                                        @case(1)
                                                            <strong>{{ $d->bed_number.' (I-RD)'  }}</strong>
                                                        @break

                                                        @default
                                                            <strong>{{ $d->bed_number.' (I-R)'}}</strong>
                                                    @endswitch
                                                @endif

                                                @if($d->type_pack == 5)
                                                    @switch($d->type_diet_renal)
                                                        @case(1)
                                                            <strong>{{ $d->bed_number.' (E-RD)'  }}</strong>
                                                        @break

                                                        @default
                                                            <strong>{{ $d->bed_number.' (E-R)'}}</strong>
                                                    @endswitch
                                                @endif

                                            @break

                                            @case(21)
                                                @switch($d->type_pack)
                                                    @case(1)
                                                        {{ $d->bed_number.' (I-BP)'  }}
                                                    @break

                                                    @case(2)
                                                        {{ $d->bed_number.' (E-BP)'  }}
                                                    @break

                                                    @case(3)
                                                        <strong> {{ $d->bed_number.' (BP)'  }} </strong>
                                                    @break

                                                    @case(4)
                                                        <strong> {{ $d->bed_number.' (I-BP)'  }} </strong>
                                                    @break

                                                    @case(5)
                                                        <strong> {{ $d->bed_number.' (E-BP)'  }} </strong>
                                                    @break

                                                    @default
                                                        {{ $d->bed_number." (BP)" }}
                                                @endswitch
                                            @break

                                            @case(22)
                                                @switch($d->type_pack)
                                                    @case(1)
                                                        {{ $d->bed_number.' (I-BF)'  }}
                                                    @break

                                                    @case(2)
                                                        {{ $d->bed_number.' (E-BF)'  }}
                                                    @break

                                                    @case(3)
                                                        <strong> {{ $d->bed_number.' (BF)'  }} </strong>
                                                    @break

                                                    @case(4)
                                                        <strong> {{ $d->bed_number.' (I-BF)'  }} </strong>
                                                    @break

                                                    @case(5)
                                                        <strong> {{ $d->bed_number.' (E-BF)'  }} </strong>
                                                    @break

                                                    @default
                                                        {{ $d->bed_number." (BF)" }}
                                                @endswitch
                                            @break

                                            @case(23)
                                                @switch($d->type_pack)
                                                    @case(1)
                                                        {{ $d->bed_number.' (I-BK)'  }}
                                                    @break

                                                    @case(2)
                                                        {{ $d->bed_number.' (E-BK)'  }}
                                                    @break

                                                    @case(3)
                                                        <strong> {{ $d->bed_number.' (BK)'  }} </strong>
                                                    @break

                                                    @case(4)
                                                        <strong> {{ $d->bed_number.' (I-BK)'  }} </strong>
                                                    @break

                                                    @case(5)
                                                        <strong> {{ $d->bed_number.' (E-BK)'  }} </strong>
                                                    @break

                                                    @default
                                                        {{ $d->bed_number." (BK)" }}
                                                @endswitch
                                            @break

                                            @case(24)
                                                @switch($d->type_pack)
                                                    @case(1)
                                                        {{ $d->bed_number.' (I-C)'  }}
                                                    @break

                                                    @case(2)
                                                        {{ $d->bed_number.' (E-C)'  }}
                                                    @break

                                                    @case(3)
                                                        <strong> {{ $d->bed_number.' (C)'  }} </strong>
                                                    @break

                                                    @case(4)
                                                        <strong> {{ $d->bed_number.' (I-C)'  }} </strong>
                                                    @break

                                                    @case(5)
                                                        <strong> {{ $d->bed_number.' (E-C)'  }} </strong>
                                                    @break

                                                    @default
                                                        {{ $d->bed_number." (C)" }}
                                                @endswitch
                                            @break

                                            @case(25)
                                                @switch($d->type_pack)
                                                    @case(1)
                                                        {{ $d->bed_number.' (I-AU)'  }}
                                                    @break

                                                    @case(2)
                                                        {{ $d->bed_number.' (E-AU)'  }}
                                                    @break

                                                    @case(3)
                                                        <strong> {{ $d->bed_number.' (AU)'  }} </strong>
                                                    @break

                                                    @case(4)
                                                        <strong> {{ $d->bed_number.' (I-AU)'  }} </strong>
                                                    @break

                                                    @case(5)
                                                        <strong> {{ $d->bed_number.' (E-AU)'  }} </strong>
                                                    @break

                                                    @default
                                                        {{ $d->bed_number." (AU)" }}
                                                @endswitch
                                            @break

                                            @case(26)
                                                @switch($d->type_pack)
                                                    @case(1)
                                                        {{ $d->bed_number.' (I-AK)'  }}
                                                    @break

                                                    @case(2)
                                                        {{ $d->bed_number.' (E-AK)'  }}
                                                    @break

                                                    @case(3)
                                                        <strong> {{ $d->bed_number.' (AK)'  }} </strong>
                                                    @break

                                                    @case(4)
                                                        <strong> {{ $d->bed_number.' (I-AK)'  }} </strong>
                                                    @break

                                                    @case(5)
                                                        <strong> {{ $d->bed_number.' (E-AK)'  }} </strong>
                                                    @break

                                                    @default
                                                        {{ $d->bed_number." (AK)" }}
                                                @endswitch
                                            @break

                                            @case(27)
                                                @switch($d->type_pack)
                                                    @case(1)
                                                        {{ $d->bed_number.' (I-SL)'  }}
                                                    @break

                                                    @case(2)
                                                        {{ $d->bed_number.' (E-SL)'  }}
                                                    @break

                                                    @case(3)
                                                        <strong> {{ $d->bed_number.' (SL)'  }} </strong>
                                                    @break

                                                    @case(4)
                                                        <strong> {{ $d->bed_number.' (I-SL)'  }} </strong>
                                                    @break

                                                    @case(5)
                                                        <strong> {{ $d->bed_number.' (E-SL)'  }} </strong>
                                                    @break

                                                    @default
                                                        {{ $d->bed_number." (SL)" }}
                                                @endswitch
                                            @break

                                            @case(28)
                                                @if($d->type_pack == 0)
                                                    @switch($d->type_diet_de_viaje)
                                                        @case(1)
                                                            {{ $d->bed_number.' (DV-L)'  }}
                                                        @break

                                                        @case(2)
                                                            {{ $d->bed_number.' (DV-B)'  }}
                                                        @break

                                                        @case(3)
                                                            {{ $d->bed_number.' (DV-D)'  }}
                                                        @break

                                                        @case(4)
                                                            {{ $d->bed_number.' (DV-H)'  }}
                                                        @break

                                                        @case(5)
                                                            {{ $d->bed_number.' (DV-DH)'  }}
                                                        @break

                                                        @case(6)
                                                            {{ $d->bed_number.' (DV-P)'  }}
                                                        @break

                                                        @default
                                                            {{ $d->bed_number.' (DV)'  }}
                                                    @endswitch
                                                @endif

                                                @if($d->type_pack == 1)
                                                    @switch($d->type_diet_de_viaje)
                                                        @case(1)
                                                            {{ $d->bed_number.' (I-DV-L)'  }}
                                                        @break

                                                        @case(2)
                                                            {{ $d->bed_number.' (I-DV-B)'  }}
                                                        @break

                                                        @case(3)
                                                            {{ $d->bed_number.' (I-DV-D)'  }}
                                                        @break

                                                        @case(4)
                                                            {{ $d->bed_number.' (I-DV-H)'  }}
                                                        @break

                                                        @case(5)
                                                            {{ $d->bed_number.' (I-DV-DH)'  }}
                                                        @break

                                                        @case(6)
                                                            {{ $d->bed_number.' (I-DV-P)'  }}
                                                        @break

                                                        @default
                                                            {{ $d->bed_number.' (I-DV)'  }}
                                                    @endswitch
                                                @endif

                                                @if($d->type_pack == 2)
                                                    @switch($d->type_diet_de_viaje)
                                                        @case(1)
                                                            {{ $d->bed_number.' (E-DV-L)'  }}
                                                        @break

                                                        @case(2)
                                                            {{ $d->bed_number.' (E-DV-B)'  }}
                                                        @break

                                                        @case(3)
                                                            {{ $d->bed_number.' (E-DV-D)'  }}
                                                        @break

                                                        @case(4)
                                                            {{ $d->bed_number.' (E-DV-H)'  }}
                                                        @break

                                                        @case(5)
                                                            {{ $d->bed_number.' (E-DV-DH)'  }}
                                                        @break

                                                        @case(6)
                                                            {{ $d->bed_number.' (E-DV-P)'  }}
                                                        @break

                                                        @default
                                                            {{ $d->bed_number.' (E-DV)'  }}
                                                    @endswitch
                                                @endif

                                                @if($d->type_pack == 3)
                                                    @switch($d->type_diet_de_viaje)
                                                        @case(1)
                                                            <strong>{{ $d->bed_number.' (DV-L)'  }}</strong>
                                                        @break

                                                        @case(2)
                                                            <strong>{{ $d->bed_number.' (DV-B)'  }}</strong>
                                                        @break

                                                        @case(3)
                                                            <strong>{{ $d->bed_number.' (DV-D)'  }}</strong>
                                                        @break

                                                        @case(4)
                                                            <strong>{{ $d->bed_number.' (DV-H)'  }}</strong>
                                                        @break

                                                        @case(5)
                                                            <strong>{{ $d->bed_number.' (DV-DH)'  }}</strong>
                                                        @break

                                                        @case(6)
                                                            <strong>{{ $d->bed_number.' (DV-P)'  }}</strong>
                                                        @break

                                                        @default
                                                            <strong>{{ $d->bed_number.' (DV)'  }}</strong>

                                                    @endswitch
                                                @endif

                                                @if($d->type_pack == 4)
                                                    @switch($d->type_diet_de_viaje)
                                                        @case(1)
                                                            <strong>{{ $d->bed_number.' (I-DV-L)'  }}</strong>
                                                        @break

                                                        @case(2)
                                                            <strong>{{ $d->bed_number.' (I-DV-B)'  }}</strong>
                                                        @break

                                                        @case(3)
                                                            <strong>{{ $d->bed_number.' (I-DV-D)'  }}</strong>
                                                        @break

                                                        @case(4)
                                                            <strong>{{ $d->bed_number.' (I-DV-H)'  }}</strong>
                                                        @break

                                                        @case(5)
                                                            <strong>{{ $d->bed_number.' (I-DV-DH)'  }}</strong>
                                                        @break

                                                        @case(6)
                                                            <strong>{{ $d->bed_number.' (I-DV-P)'  }}</strong>
                                                        @break

                                                        @default
                                                            <strong>{{ $d->bed_number.' (I-DV)'  }}</strong>

                                                    @endswitch
                                                @endif

                                                @if($d->type_pack == 5)
                                                    @switch($d->type_diet_de_viaje)
                                                        @case(1)
                                                            <strong>{{ $d->bed_number.' (E-DV-L)'  }}</strong>
                                                        @break

                                                        @case(2)
                                                            <strong>{{ $d->bed_number.' (E-DV-B)'  }}</strong>
                                                        @break

                                                        @case(3)
                                                            <strong>{{ $d->bed_number.' (E-DV-D)'  }}</strong>
                                                        @break

                                                        @case(4)
                                                            <strong>{{ $d->bed_number.' (E-DV-H)'  }}</strong>
                                                        @break

                                                        @case(5)
                                                            <strong>{{ $d->bed_number.' (E-DV-DH)'  }}</strong>
                                                        @break

                                                        @case(6)
                                                            <strong>{{ $d->bed_number.' (E-DV-P)'  }}</strong>
                                                        @break

                                                        @default
                                                            <strong>{{ $d->bed_number.' (E-DV)'  }}</strong>
                                                    @endswitch
                                                @endif

                                            @break

                                            @case(29)
                                                @if($d->type_pack == 0)
                                                    @switch($d->type_diet_de_viaje)
                                                        @case(1)
                                                            {{ $d->bed_number.' (RE-L)'  }}
                                                        @break

                                                        @case(2)
                                                            {{ $d->bed_number.' (RE-B)'  }}
                                                        @break

                                                        @case(3)
                                                            {{ $d->bed_number.' (RE-D)'  }}
                                                        @break

                                                        @case(4)
                                                            {{ $d->bed_number.' (RE-H)'  }}
                                                        @break

                                                        @case(5)
                                                            {{ $d->bed_number.' (RE-DH)'  }}
                                                        @break

                                                        @case(6)
                                                            {{ $d->bed_number.' (RE-P)'  }}
                                                        @break

                                                        @default
                                                            {{ $d->bed_number.' (RE)'  }}
                                                    @endswitch
                                                @endif

                                                @if($d->type_pack == 1)
                                                    @switch($d->type_diet_de_viaje)
                                                        @case(1)
                                                            {{ $d->bed_number.' (I-RE-L)'  }}
                                                        @break

                                                        @case(2)
                                                            {{ $d->bed_number.' (I-RE-B)'  }}
                                                        @break

                                                        @case(3)
                                                            {{ $d->bed_number.' (I-RE-D)'  }}
                                                        @break

                                                        @case(4)
                                                            {{ $d->bed_number.' (I-RE-H)'  }}
                                                        @break

                                                        @case(5)
                                                            {{ $d->bed_number.' (I-RE-DH)'  }}
                                                        @break

                                                        @case(6)
                                                            {{ $d->bed_number.' (I-RE-P)'  }}
                                                        @break

                                                        @default
                                                            {{ $d->bed_number.' (I-RE)'  }}
                                                    @endswitch
                                                @endif

                                                @if($d->type_pack == 2)
                                                    @switch($d->type_diet_de_viaje)
                                                        @case(1)
                                                            {{ $d->bed_number.' (E-RE-L)'  }}
                                                        @break

                                                        @case(2)
                                                            {{ $d->bed_number.' (E-RE-B)'  }}
                                                        @break

                                                        @case(3)
                                                            {{ $d->bed_number.' (E-RE-D)'  }}
                                                        @break

                                                        @case(4)
                                                            {{ $d->bed_number.' (E-RE-H)'  }}
                                                        @break

                                                        @case(5)
                                                            {{ $d->bed_number.' (E-RE-DH)'  }}
                                                        @break

                                                        @case(6)
                                                            {{ $d->bed_number.' (E-RE-P)'  }}
                                                        @break

                                                        @default
                                                            {{ $d->bed_number.' (E-RE)'  }}
                                                    @endswitch
                                                @endif

                                                @if($d->type_pack == 3)
                                                    @switch($d->type_diet_de_viaje)
                                                        @case(1)
                                                            <strong>{{ $d->bed_number.' (RE-L)'  }}</strong>
                                                        @break

                                                        @case(2)
                                                            <strong>{{ $d->bed_number.' (RE-B)'  }}</strong>
                                                        @break

                                                        @case(3)
                                                            <strong>{{ $d->bed_number.' (RE-D)'  }}</strong>
                                                        @break

                                                        @case(4)
                                                            <strong>{{ $d->bed_number.' (RE-H)'  }}</strong>
                                                        @break

                                                        @case(5)
                                                            <strong>{{ $d->bed_number.' (RE-DH)'  }}</strong>
                                                        @break

                                                        @case(6)
                                                            <strong>{{ $d->bed_number.' (RE-P)'  }}</strong>
                                                        @break

                                                        @default
                                                            <strong>{{ $d->bed_number.' (RE)'  }}</strong>

                                                    @endswitch
                                                @endif

                                                @if($d->type_pack == 4)
                                                    @switch($d->type_diet_de_viaje)
                                                        @case(1)
                                                            <strong>{{ $d->bed_number.' (I-RE-L)'  }}</strong>
                                                        @break

                                                        @case(2)
                                                            <strong>{{ $d->bed_number.' (I-RE-B)'  }}</strong>
                                                        @break

                                                        @case(3)
                                                            <strong>{{ $d->bed_number.' (I-RE-D)'  }}</strong>
                                                        @break

                                                        @case(4)
                                                            <strong>{{ $d->bed_number.' (I-RE-H)'  }}</strong>
                                                        @break

                                                        @case(5)
                                                            <strong>{{ $d->bed_number.' (I-RE-DH)'  }}</strong>
                                                        @break

                                                        @case(6)
                                                            <strong>{{ $d->bed_number.' (I-RE-P)'  }}</strong>
                                                        @break

                                                        @default
                                                            <strong>{{ $d->bed_number.' (I-RE)'  }}</strong>

                                                    @endswitch
                                                @endif

                                                @if($d->type_pack == 5)
                                                    @switch($d->type_diet_de_viaje)
                                                        @case(1)
                                                            <strong>{{ $d->bed_number.' (E-RE-L)'  }}</strong>
                                                        @break

                                                        @case(2)
                                                            <strong>{{ $d->bed_number.' (E-RE-B)'  }}</strong>
                                                        @break

                                                        @case(3)
                                                            <strong>{{ $d->bed_number.' (E-RE-D)'  }}</strong>
                                                        @break

                                                        @case(4)
                                                            <strong>{{ $d->bed_number.' (E-RE-H)'  }}</strong>
                                                        @break

                                                        @case(5)
                                                            <strong>{{ $d->bed_number.' (E-RE-DH)'  }}</strong>
                                                        @break

                                                        @case(6)
                                                            <strong>{{ $d->bed_number.' (E-RE-P)'  }}</strong>
                                                        @break

                                                        @default
                                                            <strong>{{ $d->bed_number.' (E-RE)'  }}</strong>
                                                    @endswitch
                                                @endif

                                            @break

                                        @endswitch

                                        

                                    

                                        
                                    @endif
                                @endif
                            @endforeach
                        </TD>
                        <TD ROWSPAN="3" colspan="2">
                            @foreach($subtotales_otras as $s)
                                @if($s->iddiet_request == $dr->id)
                                    @if($s->subtotal > 0)
                                        {{ $s->subtotal }}
                                    @endif
                                @endif
                            @endforeach
                        </TD>

                    </TR>

                    <TR>
                        <TD colspan="2" height="15"></TD>
                    </TR>

                    <TR>
                        <TD colspan="2" height="15"></TD>
                    </TR>

                    <TR>
                        <TH ROWSPAN="1" colspan="2" ALIGN="center">NPO</TH>
                        <TD colspan="2">
                            @foreach($dr->details as $d)
                                @if($d->iddiet == "18" && $d->iddiet_request == $dr->id)
                                    @if(!$loop->last)
                                        {{ $d->bed_number.', ' }}
                                    @else
                                        {{ $d->bed_number }}
                                    
                                    @endif
                                @endif
                            @endforeach
                        </TD>
                        <TD ROWSPAN="1" colspan="2">
                            @foreach($subtotales as $s)
                                @if($s->iddiet == "18" && $s->iddiet_request == $dr->id)
                                    0
                                @endif
                            @endforeach
                        </TD>
                    </TR>

 

 


                    

                    

                    

                </TABLE>


        </body>
    @endforeach
</html>
