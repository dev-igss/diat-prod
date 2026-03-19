<!DOCTYPE>
<html>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
    </style>

    @foreach($diet_request as $dr)
        <body style="font-size: 14px; font-family: 'Roboto Slab', serif;">
            <div style="float: left; margin-top: -25px;" >
                <img src="{{ url('img/Isotipo.png') }}" alt="" width="40px" height="40px">
            </div>

            <div style="text-align: center; margin-top: -25px;">
                <span><strong> SOLICITUD DE DIETAS DIARIAS </strong> </span>
            </div>

            <div style="float: right; margin-top: -85px;">
                <span><strong> SPS-184 </strong> </span>
            </div>

            <br><br>

            <div style="float: left; margin-top: 5px; margin-left: 0px; width:150px;height:25px;" >
                Tiempo de Alimentacion: <input type="text" style="border:1px solid #000000;width:150px;height:25px; text-align: center;" value="{{ $dr->journey->name }}">
            </div>

            <div style="float: right; margin-top: 5px; margin-right: 50px; width:150px;height:25px;">
                Fecha: <input type="text" style="border:1px solid #000000;width:150px;height:25px; text-align: center;" value="{{ $dr->created_at }}">
            </div>

            <table width="100%"  style=" margin-top:60px; text-align: center; font-size: 12px;" >
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
                        @foreach($details as $d)
                            @if($d->iddiet_request == $dr->id)
                                @if($d->iddiet == "1")
                                    @if(!$loop->last || $loop->count = 1)                                
                                        {{ $d->bed_number  }}
                                    @else
                                        {{ $d->bed_number.', ' }}
                                    @endif                            
                                @endif
                            @endif
                        @endforeach             
                    </TD>
                    <TD ROWSPAN="2" colspan="2" ALIGN="center" style="width: 10px;">
                        @foreach($subtotales as $s)
                            @if($s->iddiet_request == $dr->id)
                                @if($s->iddiet == "1")
                                    {{ $s->subtotal }}
                                @endif
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
                        @foreach($details as $d)
                            @if($d->iddiet_request == $dr->id)
                                @if($d->iddiet == "2")
                                    @if(!$loop->last || $loop->count = 1)                                
                                        {{ $d->bed_number  }}
                                    @else
                                        {{ $d->bed_number.', ' }}
                                    @endif                            
                                @endif
                            @endif
                        @endforeach 
                    </TD>
                    <TD ROWSPAN="2" colspan="2" ALIGN="center">
                        @foreach($subtotales as $s)
                            @if($s->iddiet_request == $dr->id)
                                @if($s->iddiet == "2")
                                    {{ $s->subtotal }}
                                @endif
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
                        @foreach($details as $d)
                            @if($d->iddiet_request == $dr->id)
                                @if($d->iddiet == "3")
                                    @if(!$loop->last || $loop->count = 1)                                
                                        {{ $d->bed_number  }}
                                    @else
                                        {{ $d->bed_number.', ' }}
                                    @endif                            
                                @endif
                            @endif
                        @endforeach 
                    </TD>
                    <TD ROWSPAN="3" colspan="2">
                        @foreach($subtotales as $s)
                            @if($s->iddiet_request == $dr->id)
                                @if($s->iddiet == "3")
                                    {{ $s->subtotal }}
                                @endif
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
                        @foreach($details as $d)
                            @if($d->iddiet_request == $dr->id)
                                @if($d->iddiet == "4")
                                    @if(!$loop->last || $loop->count = 1)                                
                                        {{ $d->bed_number  }}
                                    @else
                                        {{ $d->bed_number.', ' }}
                                    @endif                            
                                @endif
                            @endif
                        @endforeach
                    </TD>
                    <TD ROWSPAN="2" colspan="2">
                        @foreach($subtotales as $s)
                            @if($s->iddiet_request == $dr->id)
                                @if($s->iddiet == "4")
                                    {{ $s->subtotal }}
                                @endif
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
                        @foreach($details as $d)
                            @if($d->iddiet_request == $dr->id)
                                @if($d->iddiet == "5")
                                    @if(!$loop->last || $loop->count = 1)                                
                                        {{ $d->bed_number  }}
                                    @else
                                        {{ $d->bed_number.', ' }}
                                    @endif                            
                                @endif
                            @endif
                        @endforeach
                    </TD>
                    <TD ROWSPAN="2" colspan="2">                        
                        @foreach($subtotales as $s)
                            @if($s->iddiet_request == $dr->id)
                                @if($s->iddiet == "5")
                                    {{ $s->subtotal }}
                                @endif
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
                        @foreach($details as $d)
                            @if($d->iddiet_request == $dr->id)
                                @if($d->iddiet == "6")
                                    @if(!$loop->last || $loop->count = 1)                                
                                        {{ $d->bed_number  }}
                                    @else
                                        {{ $d->bed_number.', ' }}
                                    @endif                            
                                @endif
                            @endif
                        @endforeach
                    </TD>
                    <TD ROWSPAN="2" colspan="2">
                        @foreach($subtotales as $s)
                            @if($s->iddiet_request == $dr->id)
                                @if($s->iddiet == "6")
                                    {{ $s->subtotal }}
                                @endif
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
                        @foreach($details as $d)
                            @if($d->iddiet_request == $dr->id)
                                @if($d->iddiet == "7")
                                    @if(!$loop->last || $loop->count = 1)                                
                                        {{ $d->bed_number  }}
                                    @else
                                        {{ $d->bed_number.', ' }}
                                    @endif                            
                                @endif
                            @endif
                        @endforeach
                    </TD>
                    <TD ROWSPAN="2" colspan="2">
                        @foreach($subtotales as $s)
                            @if($s->iddiet_request == $dr->id)
                                @if($s->iddiet == "7")
                                    {{ $s->subtotal }}
                                @endif
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
                        @foreach($details as $d)
                            @if($d->iddiet_request == $dr->id)
                                @if($d->iddiet == "8")
                                    @if(!$loop->last || $loop->count = 1)                                
                                        {{ $d->bed_number  }}
                                    @else
                                        {{ $d->bed_number.', ' }}
                                    @endif                            
                                @endif
                            @endif
                        @endforeach
                    </TD>
                    <TD ROWSPAN="4" colspan="2" ALIGN="center">
                        <?php $sum_diabeticas = 0 ?>
                        @foreach($subtotales as $s)
                            @if($s->iddiet_request == $dr->id)
                                @if($s->iddiet == "8")
                                    <?php $sum_diabeticas += $s->subtotal ?>
                                @endif
                                @if($s->iddiet == "9")
                                    <?php $sum_diabeticas += $s->subtotal ?>
                                @endif
                                @if($s->iddiet == "10")
                                    <?php $sum_diabeticas += $s->subtotal ?>
                                @endif
                                @if($s->iddiet == "11")
                                    <?php $sum_diabeticas += $s->subtotal ?>
                                @endif
                            @endif
                        @endforeach 

                        @if($sum_diabeticas > 0)                    
                            {{ $sum_diabeticas }}
                        @endif
                    </TD>
                </TR>

                <TR>
                    <TH> 1,800 Calorías</TH>
                    <TD colspan="2">
                        @foreach($details as $d)
                            @if($d->iddiet_request == $dr->id)
                                @if($d->iddiet == "9")
                                    @if(!$loop->last || $loop->count = 1)                                
                                        {{ $d->bed_number  }}
                                    @else
                                        {{ $d->bed_number.', ' }}
                                    @endif                            
                                @endif
                            @endif
                        @endforeach
                    </TD>
                </TR>

                <TR>
                    <TH> 2,0000 Calorías</TH>
                    <TD colspan="2">
                        @foreach($details as $d)
                            @if($d->iddiet_request == $dr->id)
                                @if($d->iddiet == "10")
                                    @if(!$loop->last || $loop->count = 1)                                
                                        {{ $d->bed_number  }}
                                    @else
                                        {{ $d->bed_number.', ' }}
                                    @endif                            
                                @endif
                            @endif
                        @endforeach
                    </TD>
                </TR>

                <TR>
                    <TH> 2,200 Calorías</TH>
                    <TD colspan="2">
                        @foreach($details as $d)
                            @if($d->iddiet_request == $dr->id)
                                @if($d->iddiet == "11")
                                    @if(!$loop->last || $loop->count = 1)                                
                                        {{ $d->bed_number  }}
                                    @else
                                        {{ $d->bed_number.', ' }}
                                    @endif                            
                                @endif
                            @endif
                        @endforeach
                    </TD>
                </TR>

                <TR>
                    <TH ROWSPAN="5" colspan="2" ALIGN="center">Libre</TH>
                    <TD colspan="2">
                        @foreach($details as $d)
                            @if($d->iddiet_request == $dr->id)
                                @if($d->iddiet == "12")
                                    @if(!$loop->last || $loop->count = 1)                                
                                        {{ $d->bed_number  }}
                                    @else
                                        {{ $d->bed_number.', ' }}
                                    @endif                            
                                @endif
                            @endif
                        @endforeach
                    </TD>
                    <TD ROWSPAN="5" colspan="2">
                        @foreach($subtotales as $s)
                            @if($s->iddiet_request == $dr->id)
                                @if($s->iddiet == "12")
                                    {{ $s->subtotal }}
                                @endif
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
                        @foreach($details as $d)
                            @if($d->iddiet_request == $dr->id)
                                @if($d->iddiet == "13")
                                    @if(!$loop->last || $loop->count = 1)                                
                                        {{ $d->bed_number  }}
                                    @else
                                        {{ $d->bed_number.', ' }}
                                    @endif                            
                                @endif
                            @endif
                        @endforeach
                    </TD>
                    <TD ROWSPAN="3" colspan="2" ALIGN="center">
                        @foreach($subtotales as $s)
                            @if($s->iddiet_request == $dr->id)
                                @if($s->iddiet == "13")
                                    {{ $s->subtotal }}
                                @endif
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
                        @foreach($details as $d)
                            @if($d->iddiet_request == $dr->id)
                                @if($d->iddiet == "14")
                                    @if(!$loop->last || $loop->count = 1)                                
                                        {{ $d->bed_number  }}
                                    @else
                                        {{ $d->bed_number.', ' }}
                                    @endif                            
                                @endif
                            @endif
                        @endforeach
                    </TD>
                    <TD ROWSPAN="3" colspan="2" ALIGN="center">
                        @foreach($subtotales as $s)
                            @if($s->iddiet_request == $dr->id)
                                @if($s->iddiet == "14")
                                    {{ $s->subtotal }}
                                @endif
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
                        @foreach($details as $d)
                            @if($d->iddiet_request == $dr->id)
                                @if($d->iddiet == "15")
                                    @if(!$loop->last || $loop->count = 1)                                
                                        {{ $d->bed_number  }}
                                    @else
                                        {{ $d->bed_number.', ' }}
                                    @endif                            
                                @endif
                            @endif
                        @endforeach
                    </TD>
                    <TD ROWSPAN="3" colspan="2" ALIGN="center">
                        @foreach($subtotales as $s)
                            @if($s->iddiet_request == $dr->id)
                                @if($s->iddiet == "15")
                                    {{ $s->subtotal }}
                                @endif
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
                        @foreach($details as $d)
                            @if($d->iddiet_request == $dr->id)
                                @if($d->iddiet == "16")
                                    @if(!$loop->last || $loop->count = 1)                                
                                        {{ $d->bed_number  }}
                                    @else
                                        {{ $d->bed_number.', ' }}
                                    @endif                            
                                @endif
                            @endif
                        @endforeach
                    </TD>
                    <TD ROWSPAN="3" colspan="2">
                        @foreach($subtotales as $s)
                            @if($s->iddiet_request == $dr->id)
                                @if($s->iddiet == "16")
                                    {{ $s->subtotal }}
                                @endif
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
                    <TH ROWSPAN="3" colspan="2" ALIGN="center">OTRAS (Especificar)</TH>
                    <TD colspan="2">
                        @foreach($details as $d)
                            @if($d->iddiet_request == $dr->id)
                                @if($d->iddiet == "17")
                                    @if($loop->last || $loop->count = 1)
                                        {{ $d->specify }}
                                    @else
                                        {{ $d->specify.', ' }}
                                    @endif                            
                                @endif
                            @endif
                        @endforeach
                    </TD>
                    <TD ROWSPAN="3" colspan="2">
                        @foreach($subtotales as $s)
                            @if($s->iddiet_request == $dr->id)
                                @if($s->iddiet == "17")
                                    {{ $s->subtotal }}
                                @endif
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
                    <TH ROWSPAN="1" colspan="2" ALIGN="center">NPO</TH>
                    <TD colspan="2">
                        @foreach($details as $d)
                            @if($d->iddiet_request == $dr->id)
                                @if($d->iddiet == "18")
                                    @if(!$loop->last || $loop->count = 1)                                
                                        {{ $d->bed_number  }}
                                    @else
                                        {{ $d->bed_number.', ' }}
                                    @endif                            
                                @endif
                            @endif
                        @endforeach
                    </TD>
                    <TD ROWSPAN="1" colspan="2">
                        @foreach($subtotales as $s)
                            @if($s->iddiet_request == $dr->id)
                                @if($s->iddiet == "18")
                                    {{ $s->subtotal }}
                                @endif
                            @endif
                        @endforeach
                    </TD>
                </TR>



            </TABLE>





        </body>
    @endforeach
</html>