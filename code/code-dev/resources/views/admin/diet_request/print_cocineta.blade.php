<!DOCTYPE>
<html>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title> Solicitud de Dietas por Cocineta </title>
    <style>

        table {
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        .total_td {
            border: 3px solid black;
        }

        .borde_table {
            border: 3px solid black;
        }

        th,
        td {
            padding: 5px;
        }

        .page_break {
            page-break-after: always;
        }
    </style>

    <body>
        
        <!--cocineta no.1-->
        <table width="100%"  style=" margin-top:0px;  font-size: 12px;" class="borde_table" >
            
            <TR class="total_td">
                <TH  colspan="7">Cocineta No.1</TH>
            </TR>

            <TR class="total_td">
                <th style="text-align: left;" ><strong>Fecha: {{ \Carbon\Carbon::parse($hoy)->format('d-m-Y') }}</strong></th>
                <th>D </th>
                <th style="background-color: rgb(180, 180, 180);"> @if($jornada == 1) X @endif</th>
                <th>A </th>
                <th style="background-color: rgb(180, 180, 180);"> @if($jornada == 2) X @endif</th>
                <th>C </th>
                <th style="background-color: rgb(180, 180, 180);"> @if($jornada == 3) X @endif</th>
            </TR>

            <TR class="total_td">
                <TH style="font-size: 10px;" colspan="7">Medi, Ciru, Trauma MUJERES Gine, PP, AR, Sept</TH>
            </TR>

            <TR class="total_td">
                <th colspan="3" width="10%"></th>
                <th>PEDIA</th>
                <th>ALA 1</th>
                <th>ALA 2</th>
                <th>TOTAL</th>
            </TR>

            @foreach($dietas as $d)
                <tr>
                    <th colspan="3">{{$d->name}}</th>
                    <th>
                        @foreach($cocineta1 as $c1)
                            @foreach($c1['conteo_c1_ped_totales'] as $ped_totales)
                                @if($ped_totales->dieta == $d->id)                                    

                                    {{ $ped_totales->total_dietas.', '}}
                                @endif
                            @endforeach

                            @foreach($c1['conteo_c1_ped_semp'] as $ped_semp)
                                @if($ped_semp->dieta == $d->id)                                    

                                    @if($ped_semp->carac1 == 0 || $ped_semp->carac1 == 1 || $ped_semp->carac1 == 2) 
                                        
                                            @if($ped_semp->dieta == 1 || $ped_semp->dieta == 2 || $ped_semp->dieta == 4 || $ped_semp->dieta ==5)
                                                @if($ped_semp->carac2 == 1)
                                                    {{ '('.$ped_semp->total_dietas.' D), ' }}
                                                @endif

                                                @if($ped_semp->carac2 == 2)
                                                    {{ '('.$ped_semp->total_dietas.' H), ' }}
                                                @endif

                                                @if($ped_semp->carac2 == 3)
                                                    {{ '('.$ped_semp->total_dietas.' DH), ' }}
                                                @endif
                                            @endif

                                            @if($ped_semp->dieta == 7)
                                                @if($ped_semp->carac3 == 1)
                                                    {{ '('.$ped_semp->total_dietas.' BF), ' }}
                                                @endif

                                                @if($ped_semp->carac3 == 2)
                                                    {{ '('.$ped_semp->total_dietas.' AF), ' }}
                                                @endif

                                                @if($ped_semp->carac3 == 3)
                                                    {{ '('.$ped_semp->total_dietas.' BP), ' }}
                                                @endif

                                                @if($ped_semp->carac3 == 4)
                                                    {{ '('.$ped_semp->total_dietas.' AP), ' }}
                                                @endif
                                            @endif

                                            @if($ped_semp->dieta == 20)
                                                @if($ped_semp->carac4 == 1)
                                                    {{ '('.$ped_semp->total_dietas.' D), ' }}
                                                @endif
                                            @endif

                                            @if($ped_semp->dieta == 28 || $ped_semp->dieta == 29)
                                                @if($ped_semp->carac3 == 1)
                                                    {{ '('.$ped_semp->total_dietas.' L), ' }}
                                                @endif

                                                @if($ped_semp->carac3 == 2)
                                                    {{ '('.$ped_semp->total_dietas.' B), ' }}
                                                @endif

                                                @if($ped_semp->carac3 == 3)
                                                    {{ '('.$ped_semp->total_dietas.' D), ' }}
                                                @endif

                                                @if($ped_semp->carac3 == 4)
                                                    {{ '('.$ped_semp->total_dietas.' H), ' }}
                                                @endif

                                                @if($ped_semp->carac3 == 5)
                                                    {{ '('.$ped_semp->total_dietas.' DH), ' }}
                                                @endif

                                                @if($ped_semp->carac3 == 6)
                                                    {{ '('.$ped_semp->total_dietas.' P), ' }}
                                                @endif
                                            @endif
                                        
                                    @endif 
                                @endif
                            @endforeach

                            @if($c1['conteo_c1_ped_emp'])
                                @foreach($c1['conteo_c1_ped_emp'] as $ped_emp)
                                    @if($ped_emp->dieta == $d->id)
                                        @if($ped_emp->carac2 == 0 && $ped_emp->carac3 == 0 && $ped_emp->carac4 == 0 && $ped_emp->carac5 == 0)
                                            {{ '('.$ped_emp->total_dietas.' emp), '}}
                                        @else
                                            @if($ped_emp->dieta == 1 || $ped_emp->dieta == 2 || $ped_emp->dieta == 4 || $ped_emp->dieta ==5)
                                                @if($ped_emp->carac2 == 1)
                                                    {{ '('.$ped_emp->total_dietas.' D-emp), ' }}
                                                @endif

                                                @if($ped_emp->carac2 == 2)
                                                    {{ '('.$ped_emp->total_dietas.' H-emp), ' }}
                                                @endif

                                                @if($ped_emp->carac2 == 3)
                                                    {{ '('.$ped_emp->total_dietas.' DH-emp), ' }}
                                                @endif
                                            @endif

                                            @if($ped_emp->dieta == 7)
                                                @if($ped_emp->carac3 == 1)
                                                    {{ '('.$ped_emp->total_dietas.' BF-emp), ' }}
                                                @endif

                                                @if($ped_emp->carac3 == 2)
                                                    {{ '('.$ped_emp->total_dietas.' AF-emp), ' }}
                                                @endif

                                                @if($ped_emp->carac3 == 3)
                                                    {{ '('.$ped_emp->total_dietas.' BP-emp), ' }}
                                                @endif

                                                @if($ped_emp->carac3 == 4)
                                                    {{ '('.$ped_emp->total_dietas.' AP-emp), ' }}
                                                @endif
                                            @endif

                                            @if($ped_emp->dieta == 20)
                                                @if($ped_emp->carac4 == 1)
                                                    {{ '('.$ped_emp->total_dietas.' D-emp), ' }}
                                                @endif
                                            @endif

                                            @if($ped_emp->dieta == 28 || $ped_emp->dieta == 29)
                                                @if($ped_emp->carac3 == 1)
                                                    {{ '('.$ped_emp->total_dietas.' L-emp), ' }}
                                                @endif

                                                @if($ped_emp->carac3 == 2)
                                                    {{ '('.$ped_emp->total_dietas.' B-emp), ' }}
                                                @endif

                                                @if($ped_emp->carac3 == 3)
                                                    {{ '('.$ped_emp->total_dietas.' D-emp), ' }}
                                                @endif

                                                @if($ped_emp->carac3 == 4)
                                                    {{ '('.$ped_emp->total_dietas.' H-emp), ' }}
                                                @endif

                                                @if($ped_emp->carac3 == 5)
                                                    {{ '('.$ped_emp->total_dietas.' DH-emp), ' }}
                                                @endif

                                                @if($ped_emp->carac3 == 6)
                                                    {{ '('.$ped_emp->total_dietas.' P-emp), ' }}
                                                @endif
                                            @endif
                                        @endif 
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                    </th>
                        
                    <th>
                        @foreach($cocineta1 as $c1)
                            @foreach($c1['conteo_c1_ala1_totales'] as $ala1_totales)
                                @if($ala1_totales->dieta == $d->id)
                                    {{ $ala1_totales->total_dietas.', '}}
                                @endif
                            @endforeach

                            @foreach($c1['conteo_c1_ala1_semp'] as $ala1_semp)
                                @if($ala1_semp->dieta == $d->id)
                                    
                                        @if($ala1_semp->dieta == 1 || $ala1_semp->dieta == 2 || $ala1_semp->dieta == 4 || $ala1_semp->dieta ==5)
                                            @if($ala1_semp->carac2 == 1)
                                                {{ '('.$ala1_semp->total_dietas.' D), ' }}
                                            @endif

                                            @if($ala1_semp->carac2 == 2)
                                                {{ '('.$ala1_semp->total_dietas.' H), ' }}
                                            @endif

                                            @if($ala1_semp->carac2 == 3)
                                                {{ '('.$ala1_semp->total_dietas.' DH), ' }}
                                            @endif
                                        @endif

                                        @if($ala1_semp->dieta == 7)
                                            @if($ala1_semp->carac3 == 1)
                                                {{ '('.$ala1_semp->total_dietas.' BF), ' }}
                                            @endif

                                            @if($ala1_semp->carac3 == 2)
                                                {{ '('.$ala1_semp->total_dietas.' AF), ' }}
                                            @endif

                                            @if($ala1_semp->carac3 == 3)
                                                {{ '('.$ala1_semp->total_dietas.' BP), ' }}
                                            @endif

                                            @if($ala1_semp->carac3 == 4)
                                                {{ '('.$ala1_semp->total_dietas.' AP), ' }}
                                            @endif
                                        @endif

                                        @if($ala1_semp->dieta == 20)
                                            @if($ala1_semp->carac4 == 1)
                                                {{ '('.$ala1_semp->total_dietas.' D), ' }}
                                            @endif
                                        @endif

                                        @if($ala1_semp->dieta == 28 || $ala1_semp->dieta == 29)
                                            @if($ala1_semp->carac3 == 1)
                                                {{ '('.$ala1_semp->total_dietas.' L), ' }}
                                            @endif

                                            @if($ala1_semp->carac3 == 2)
                                                {{ '('.$ala1_semp->total_dietas.' B), ' }}
                                            @endif

                                            @if($ala1_semp->carac3 == 3)
                                                {{ '('.$ala1_semp->total_dietas.' D), ' }}
                                            @endif

                                            @if($ala1_semp->carac3 == 4)
                                                {{ '('.$ala1_semp->total_dietas.' H), ' }}
                                            @endif

                                            @if($ala1_semp->carac3 == 5)
                                                {{ '('.$ala1_semp->total_dietas.' DH), ' }}
                                            @endif

                                            @if($ala1_semp->carac3 == 6)
                                                {{ '('.$ala1_semp->total_dietas.' P), ' }}
                                            @endif
                                        @endif
                                @endif
                            @endforeach

                            @if($c1['conteo_c1_ala1_emp'])
                                @foreach($c1['conteo_c1_ala1_emp'] as $ala1_emp)
                                    @if($ala1_emp->dieta == $d->id)
                                        @if($ala1_emp->carac2 == 0 && $ala1_emp->carac3 == 0 && $ala1_emp->carac4 == 0 && $ala1_emp->carac5 == 0)
                                            {{ '('.$ala1_emp->total_dietas.' emp), '}}
                                        @else
                                            @if($ala1_emp->dieta == 1 || $ala1_emp->dieta == 2 || $ala1_emp->dieta == 4 || $ala1_emp->dieta ==5)
                                                @if($ala1_emp->carac2 == 1)
                                                    {{ '('.$ala1_emp->total_dietas.' D-emp), ' }}
                                                @endif

                                                @if($ala1_emp->carac2 == 2)
                                                    {{ '('.$ala1_emp->total_dietas.' H-emp), ' }}
                                                @endif

                                                @if($ala1_emp->carac2 == 3)
                                                    {{ '('.$ala1_emp->total_dietas.' DH-emp), ' }}
                                                @endif
                                            @endif

                                            @if($ala1_emp->dieta == 7)
                                                @if($ala1_emp->carac3 == 1)
                                                    {{ '('.$ala1_emp->total_dietas.' BF-emp), ' }}
                                                @endif

                                                @if($ala1_emp->carac3 == 2)
                                                    {{ '('.$ala1_emp->total_dietas.' AF-emp), ' }}
                                                @endif

                                                @if($ala1_emp->carac3 == 3)
                                                    {{ '('.$ala1_emp->total_dietas.' BP-emp), ' }}
                                                @endif

                                                @if($ala1_emp->carac3 == 4)
                                                    {{ '('.$ala1_emp->total_dietas.' AP-emp), ' }}
                                                @endif
                                            @endif

                                            @if($ala1_emp->dieta == 20)
                                                @if($ala1_emp->carac4 == 1)
                                                    {{ '('.$ala1_emp->total_dietas.' D-emp), ' }}
                                                @endif
                                            @endif

                                            @if($ala1_emp->dieta == 28 || $ala1_emp->dieta == 29)
                                                @if($ala1_emp->carac3 == 1)
                                                    {{ '('.$ala1_emp->total_dietas.' L-emp), ' }}
                                                @endif

                                                @if($ala1_emp->carac3 == 2)
                                                    {{ '('.$ala1_emp->total_dietas.' B-emp), ' }}
                                                @endif

                                                @if($ala1_emp->carac3 == 3)
                                                    {{ '('.$ala1_emp->total_dietas.' D-emp), ' }}
                                                @endif

                                                @if($ala1_emp->carac3 == 4)
                                                    {{ '('.$ala1_emp->total_dietas.' H-emp), ' }}
                                                @endif

                                                @if($ala1_emp->carac3 == 5)
                                                    {{ '('.$ala1_emp->total_dietas.' DH-emp), ' }}
                                                @endif

                                                @if($ala1_emp->carac3 == 6)
                                                    {{ '('.$ala1_emp->total_dietas.' P-emp), ' }}
                                                @endif
                                            @endif
                                        @endif 
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                    </th>
                    <th>
                        @foreach($cocineta1 as $c1)
                            @foreach($c1['conteo_c1_ala2_totales'] as $ala2_totales)
                                @if($ala2_totales->dieta == $d->id)
                                    {{ $ala2_totales->total_dietas.', '}}
                                @endif
                            @endforeach

                            @foreach($c1['conteo_c1_ala2_semp'] as $ala2_semp)
                                @if($ala2_semp->dieta == $d->id)
                                        @if($ala2_semp->dieta == 1 || $ala2_semp->dieta == 2 || $ala2_semp->dieta == 4 || $ala2_semp->dieta ==5)
                                            @if($ala2_semp->carac2 == 1)
                                                {{ '('.$ala2_semp->total_dietas.' D), ' }}
                                            @endif

                                            @if($ala2_semp->carac2 == 2)
                                                {{ '('.$ala2_semp->total_dietas.' H), ' }}
                                            @endif

                                            @if($ala2_semp->carac2 == 3)
                                                {{ '('.$ala2_semp->total_dietas.' DH), ' }}
                                            @endif
                                        @endif

                                        @if($ala2_semp->dieta == 7)
                                            @if($ala2_semp->carac3 == 1)
                                                {{ '('.$ala2_semp->total_dietas.' BF), ' }}
                                            @endif

                                            @if($ala2_semp->carac3 == 2)
                                                {{ '('.$ala2_semp->total_dietas.' AF), ' }}
                                            @endif

                                            @if($ala2_semp->carac3 == 3)
                                                {{ '('.$ala2_semp->total_dietas.' BP), ' }}
                                            @endif

                                            @if($ala2_semp->carac3 == 4)
                                                {{ '('.$ala2_semp->total_dietas.' AP), ' }}
                                            @endif
                                        @endif

                                        @if($ala2_semp->dieta == 20)
                                            @if($ala2_semp->carac4 == 1)
                                                {{ '('.$ala2_semp->total_dietas.' D), ' }}
                                            @endif
                                        @endif

                                        @if($ala2_semp->dieta == 28 || $ala2_semp->dieta == 29)
                                            @if($ala2_semp->carac3 == 1)
                                                {{ '('.$ala2_semp->total_dietas.' L), ' }}
                                            @endif

                                            @if($ala2_semp->carac3 == 2)
                                                {{ '('.$ala2_semp->total_dietas.' B), ' }}
                                            @endif

                                            @if($ala2_semp->carac3 == 3)
                                                {{ '('.$ala2_semp->total_dietas.' D), ' }}
                                            @endif

                                            @if($ala2_semp->carac3 == 4)
                                                {{ '('.$ala2_semp->total_dietas.' H), ' }}
                                            @endif

                                            @if($ala2_semp->carac3 == 5)
                                                {{ '('.$ala2_semp->total_dietas.' DH), ' }}
                                            @endif

                                            @if($ala2_semp->carac3 == 6)
                                                {{ '('.$ala2_semp->total_dietas.' P), ' }}
                                            @endif
                                        @endif
                                @endif
                            @endforeach

                            @if($c1['conteo_c1_ala2_emp'])
                                @foreach($c1['conteo_c1_ala2_emp'] as $ala2_emp)
                                    @if($ala2_emp->dieta == $d->id)
                                        @if($ala2_emp->carac2 == 0 && $ala2_emp->carac3 == 0 && $ala2_emp->carac4 == 0 && $ala2_emp->carac5 == 0)
                                            {{ '('.$ala2_emp->total_dietas.' emp), '}}
                                        @else
                                            @if($ala2_emp->dieta == 1 || $ala2_emp->dieta == 2 || $ala2_emp->dieta == 4 || $ala2_emp->dieta ==5)
                                                @if($ala2_emp->carac2 == 1)
                                                    {{ '('.$ala2_emp->total_dietas.' D-emp), ' }}
                                                @endif

                                                @if($ala2_emp->carac2 == 2)
                                                    {{ '('.$ala2_emp->total_dietas.' H-emp), ' }}
                                                @endif

                                                @if($ala2_emp->carac2 == 3)
                                                    {{ '('.$ala2_emp->total_dietas.' DH-emp), ' }}
                                                @endif
                                            @endif

                                            @if($ala2_emp->dieta == 7)
                                                @if($ala2_emp->carac3 == 1)
                                                    {{ '('.$ala2_emp->total_dietas.' BF-emp), ' }}
                                                @endif

                                                @if($ala2_emp->carac3 == 2)
                                                    {{ '('.$ala2_emp->total_dietas.' AF-emp), ' }}
                                                @endif

                                                @if($ala2_emp->carac3 == 3)
                                                    {{ '('.$ala2_emp->total_dietas.' BP-emp), ' }}
                                                @endif

                                                @if($ala2_emp->carac3 == 4)
                                                    {{ '('.$ala2_emp->total_dietas.' AP-emp), ' }}
                                                @endif
                                            @endif

                                            @if($ala2_emp->dieta == 20)
                                                @if($ala2_emp->carac4 == 1)
                                                    {{ '('.$ala2_emp->total_dietas.' D-emp), ' }}
                                                @endif
                                            @endif

                                            @if($ala2_emp->dieta == 28 || $ala2_emp->dieta == 29)
                                                @if($ala2_emp->carac3 == 1)
                                                    {{ '('.$ala2_emp->total_dietas.' L-emp), ' }}
                                                @endif

                                                @if($ala2_emp->carac3 == 2)
                                                    {{ '('.$ala2_emp->total_dietas.' B-emp), ' }}
                                                @endif

                                                @if($ala2_emp->carac3 == 3)
                                                    {{ '('.$ala2_emp->total_dietas.' D-emp), ' }}
                                                @endif

                                                @if($ala2_emp->carac3 == 4)
                                                    {{ '('.$ala2_emp->total_dietas.' H-emp), ' }}
                                                @endif

                                                @if($ala2_emp->carac3 == 5)
                                                    {{ '('.$ala2_emp->total_dietas.' DH-emp), ' }}
                                                @endif

                                                @if($ala2_emp->carac3 == 6)
                                                    {{ '('.$ala2_emp->total_dietas.' P-emp), ' }}
                                                @endif
                                            @endif
                                        @endif 
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                    </th>
                    <th>
                        @foreach($cocineta1 as $c1)
                            @foreach($c1['total_c1_sum_alas'] as $sum_alas)
                                @if($sum_alas->dieta == $d->id)
                                    {{ $sum_alas->total }}
                                @endif
                            @endforeach
                        @endforeach
                    </th>
                </tr>            
            @endforeach

            <tr class="total_td">
                <th colspan="3"><strong>TOTAL</strong></th>
                <th>
                    @foreach($cocineta1 as $c1)
                        @foreach($c1['total_c1_ped'] as $ped)                            
                            {{ $ped->total }}
                        @endforeach
                    @endforeach
                </th>
                <th>
                    @foreach($cocineta1 as $c1)
                        @foreach($c1['total_c1_ala1'] as $ala1)                            
                            {{ $ala1->total }}
                        @endforeach
                    @endforeach
                </th>
                <th>
                    @foreach($cocineta1 as $c1)
                        @foreach($c1['total_c1_ala2'] as $ala2)                            
                            {{ $ala2->total }}
                        @endforeach
                    @endforeach
                </th>
                <th>
                    @foreach($cocineta1 as $c1)
                        @foreach($c1['total_c1'] as $t)                            
                            {{ $t->total }}
                        @endforeach
                    @endforeach
                </th>
            </tr>


        </table>
        <!--<p><strong>Generado: </strong> {{ \Carbon\Carbon::parse($hoy)->format('d/m/Y').' - '.\Carbon\Carbon::parse($hora_actual)->format('H.i').' Hrs.' }}</p>-->
        <div class="page_break"></div>
        <!--cocineta no.2-->

        <table width="100%"  style=" margin-top:0px;  font-size: 12px;"  class="borde_table">
                
            <TR class="total_td">
                <TH  colspan="7">Cocineta No.2</TH>
            </TR>

            <TR class="total_td">
                <th style="text-align: left;">Fecha: {{ \Carbon\Carbon::parse($hoy)->format('d-m-Y') }}</th>
                <th>D </th>
                <th style="background-color: rgb(180, 180, 180);"> @if($jornada == 1) X @endif</th>
                <th>A </th>
                <th style="background-color: rgb(180, 180, 180);"> @if($jornada == 2) X @endif</th>
                <th>C </th>
                <th style="background-color: rgb(180, 180, 180);"> @if($jornada == 3) X @endif</th>
            </TR>

            <TR class="total_td">
                <TH style="font-size: 10px;" colspan="7">Medi, Ciru, Trauma HOMBRES</TH>
            </TR>

            <TR class="total_td"> 
                <th colspan="4"></th>
                <th>ALA 1</th>
                <th>ALA 2</th>
                <th>TOTAL</th>
            </TR>

            @foreach($dietas as $d)
                <tr>
                    <th colspan="4">{{$d->name}}</th>
                    <th>
                        @foreach($cocineta2 as $c2)
                            @foreach($c2['conteo_c2_ala1_totales'] as $ala1_totales)
                                @if($ala1_totales->dieta == $d->id)                                    

                                    {{ $ala1_totales->total_dietas.', '}}
                                @endif
                            @endforeach

                            @foreach($c2['conteo_c2_ala1_semp'] as $ala1_semp)
                                @if($ala1_semp->dieta == $d->id)
                                    
                                    @if($ala1_semp->dieta == 1 || $ala1_semp->dieta == 2 || $ala1_semp->dieta == 4 || $ala1_semp->dieta ==5)
                                        @if($ala1_semp->carac2 == 1)
                                            {{ '('.$ala1_semp->total_dietas.' D), ' }}
                                        @endif

                                        @if($ala1_semp->carac2 == 2)
                                            {{ '('.$ala1_semp->total_dietas.' H), ' }}
                                        @endif

                                        @if($ala1_semp->carac2 == 3)
                                            {{ '('.$ala1_semp->total_dietas.' DH), ' }}
                                        @endif
                                    @endif

                                    @if($ala1_semp->dieta == 7)
                                        @if($ala1_semp->carac3 == 1)
                                            {{ '('.$ala1_semp->total_dietas.' BF), ' }}
                                        @endif

                                        @if($ala1_semp->carac3 == 2)
                                            {{ '('.$ala1_semp->total_dietas.' AF), ' }}
                                        @endif

                                        @if($ala1_semp->carac3 == 3)
                                            {{ '('.$ala1_semp->total_dietas.' BP), ' }}
                                        @endif

                                        @if($ala1_semp->carac3 == 4)
                                            {{ '('.$ala1_semp->total_dietas.' AP), ' }}
                                        @endif
                                    @endif

                                    @if($ala1_semp->dieta == 20)
                                        @if($ala1_semp->carac4 == 1)
                                            {{ '('.$ala1_semp->total_dietas.' D), ' }}
                                        @endif
                                    @endif

                                    @if($ala1_semp->dieta == 28 || $ala1_semp->dieta == 29)
                                        @if($ala1_semp->carac5 == 1)
                                            {{ '('.$ala1_semp->total_dietas.' L), ' }}
                                        @endif

                                        @if($ala1_semp->carac5 == 2)
                                            {{ '('.$ala1_semp->total_dietas.' B), ' }}
                                        @endif

                                        @if($ala1_semp->carac5 == 3)
                                            {{ '('.$ala1_semp->total_dietas.' D), ' }}
                                        @endif

                                        @if($ala1_semp->carac5 == 4)
                                            {{ '('.$ala1_semp->total_dietas.' H), ' }}
                                        @endif

                                        @if($ala1_semp->carac5 == 5)
                                            {{ '('.$ala1_semp->total_dietas.' DH), ' }}
                                        @endif

                                        @if($ala1_semp->carac5 == 6)
                                            {{ '('.$ala1_semp->total_dietas.' P), ' }}
                                        @endif
                                    @endif
                                    
                                @endif
                            @endforeach

                            @if($c2['conteo_c2_ala1_emp'])
                                @foreach($c2['conteo_c2_ala1_emp'] as $ala1_emp)
                                    @if($ala1_emp->dieta == $d->id)
                                        @if($ala1_emp->carac2 == 0 && $ala1_emp->carac3 == 0 && $ala1_emp->carac4 == 0 && $ala1_emp->carac5 == 0)
                                            {{ '('.$ala1_emp->total_dietas.' emp), '}}
                                        @else   
                                            @if($ala1_emp->dieta == 1 || $ala1_emp->dieta == 2 || $ala1_emp->dieta == 4 || $ala1_emp->dieta ==5)
                                                @if($ala1_emp->carac2 == 1)
                                                    {{ '('.$ala1_emp->total_dietas.' D-emp), ' }}
                                                @endif

                                                @if($ala1_emp->carac2 == 2)
                                                    {{ '('.$ala1_emp->total_dietas.' H-emp), ' }}
                                                @endif

                                                @if($ala1_emp->carac2 == 3)
                                                    {{ '('.$ala1_emp->total_dietas.' DH-emp), ' }}
                                                @endif
                                            @endif

                                            @if($ala1_emp->dieta == 7)
                                                @if($ala1_emp->carac3 == 1)
                                                    {{ '('.$ala1_emp->total_dietas.' BF-emp), ' }}
                                                @endif

                                                @if($ala1_emp->carac3 == 2)
                                                    {{ '('.$ala1_emp->total_dietas.' AF-emp), ' }}
                                                @endif

                                                @if($ala1_emp->carac3 == 3)
                                                    {{ '('.$ala1_emp->total_dietas.' BP-emp), ' }}
                                                @endif

                                                @if($ala1_emp->carac3 == 4)
                                                    {{ '('.$ala1_emp->total_dietas.' AP-emp), ' }}
                                                @endif
                                            @endif

                                            @if($ala1_emp->dieta == 20)
                                                @if($ala1_emp->carac4 == 1)
                                                    {{ '('.$ala1_emp->total_dietas.' D-emp), ' }}
                                                @endif
                                            @endif

                                            @if($ala1_emp->dieta == 28 || $ala1_emp->dieta == 29)
                                                @if($ala1_emp->carac5 == 1)
                                                    {{ '('.$ala1_emp->total_dietas.' L-emp), ' }}
                                                @endif

                                                @if($ala1_emp->carac5 == 2)
                                                    {{ '('.$ala1_emp->total_dietas.' B-emp), ' }}
                                                @endif

                                                @if($ala1_emp->carac5 == 3)
                                                    {{ '('.$ala1_emp->total_dietas.' D-emp), ' }}
                                                @endif

                                                @if($ala1_emp->carac5 == 4)
                                                    {{ '('.$ala1_emp->total_dietas.' H-emp), ' }}
                                                @endif

                                                @if($ala1_emp->carac5 == 5)
                                                    {{ '('.$ala1_emp->total_dietas.' DH-emp), ' }}
                                                @endif

                                                @if($ala1_emp->carac5 == 6)
                                                    {{ '('.$ala1_emp->total_dietas.' P-emp), ' }}
                                                @endif
                                            @endif
                                        @endif
                                        
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                    </th>
                    <th>
                        @foreach($cocineta2 as $c2)
                            @foreach($c2['conteo_c2_ala2_totales'] as $ala2_totales)
                                @if($ala2_totales->dieta == $d->id)                                    

                                    {{ $ala2_totales->total_dietas.', '}}
                                @endif
                            @endforeach

                            @foreach($c2['conteo_c2_ala2_semp'] as $ala2_semp)
                                @if($ala2_semp->dieta == $d->id)
                                    
                                    @if($ala2_semp->dieta == 1 || $ala2_semp->dieta == 2 || $ala2_semp->dieta == 4 || $ala2_semp->dieta ==5)
                                        @if($ala2_semp->carac2 == 1)
                                            {{ '('.$ala2_semp->total_dietas.' D), ' }}
                                        @endif

                                        @if($ala2_semp->carac2 == 2)
                                            {{ '('.$ala2_semp->total_dietas.' H), ' }}
                                        @endif

                                        @if($ala2_semp->carac2 == 3)
                                            {{ '('.$ala2_semp->total_dietas.' DH), ' }}
                                        @endif
                                    @endif

                                    @if($ala2_semp->dieta == 7)
                                        @if($ala2_semp->carac3 == 1)
                                            {{ '('.$ala2_semp->total_dietas.' BF), ' }}
                                        @endif

                                        @if($ala2_semp->carac3 == 2)
                                            {{ '('.$ala2_semp->total_dietas.' AF), ' }}
                                        @endif

                                        @if($ala2_semp->carac3 == 3)
                                            {{ '('.$ala2_semp->total_dietas.' BP), ' }}
                                        @endif

                                        @if($ala2_semp->carac3 == 4)
                                            {{ '('.$ala2_semp->total_dietas.' AP), ' }}
                                        @endif
                                    @endif

                                    @if($ala2_semp->dieta == 20)
                                        @if($ala2_semp->carac4 == 1)
                                            {{ '('.$ala2_semp->total_dietas.' D), ' }}
                                        @endif
                                    @endif

                                    @if($ala2_semp->dieta == 28 || $ala2_semp->dieta == 29)
                                        @if($ala2_semp->carac3 == 1)
                                            {{ '('.$ala2_semp->total_dietas.' L), ' }}
                                        @endif

                                        @if($ala2_semp->carac3 == 2)
                                            {{ '('.$ala2_semp->total_dietas.' B), ' }}
                                        @endif

                                        @if($ala2_semp->carac3 == 3)
                                            {{ '('.$ala2_semp->total_dietas.' D), ' }}
                                        @endif

                                        @if($ala2_semp->carac3 == 4)
                                            {{ '('.$ala2_semp->total_dietas.' H), ' }}
                                        @endif

                                        @if($ala2_semp->carac3 == 5)
                                            {{ '('.$ala2_semp->total_dietas.' DH), ' }}
                                        @endif

                                        @if($ala2_semp->carac3 == 6)
                                            {{ '('.$ala2_semp->total_dietas.' P), ' }}
                                        @endif
                                    @endif
                                     
                                @endif
                            @endforeach

                            @if($c2['conteo_c2_ala2_emp'])
                                @foreach($c2['conteo_c2_ala2_emp'] as $ala2_emp)
                                    @if($ala2_emp->dieta == $d->id)
                                        @if($ala2_emp->carac2 == 0 && $ala2_emp->carac3 == 0 && $ala2_emp->carac4 == 0 && $ala2_emp->carac5 == 0)
                                            {{ '('.$ala2_emp->total_dietas.' emp), '}}
                                        @else
                                            @if($ala2_emp->dieta == 1 || $ala2_emp->dieta == 2 || $ala2_emp->dieta == 4 || $ala2_emp->dieta ==5)
                                                @if($ala2_emp->carac2 == 1)
                                                    {{ '('.$ala2_emp->total_dietas.' D-emp), ' }}
                                                @endif

                                                @if($ala2_emp->carac2 == 2)
                                                    {{ '('.$ala2_emp->total_dietas.' H-emp), ' }}
                                                @endif

                                                @if($ala2_emp->carac2 == 3)
                                                    {{ '('.$ala2_emp->total_dietas.' DH-emp), ' }}
                                                @endif
                                            @endif

                                            @if($ala2_emp->dieta == 7)
                                                @if($ala2_emp->carac3 == 1)
                                                    {{ '('.$ala2_emp->total_dietas.' BF-emp), ' }}
                                                @endif

                                                @if($ala2_emp->carac3 == 2)
                                                    {{ '('.$ala2_emp->total_dietas.' AF-emp), ' }}
                                                @endif

                                                @if($ala2_emp->carac3 == 3)
                                                    {{ '('.$ala2_emp->total_dietas.' BP-emp), ' }}
                                                @endif

                                                @if($ala2_emp->carac3 == 4)
                                                    {{ '('.$ala2_emp->total_dietas.' AP-emp), ' }}
                                                @endif
                                            @endif

                                            @if($ala2_emp->dieta == 20)
                                                @if($ala2_emp->carac4 == 1)
                                                    {{ '('.$ala2_emp->total_dietas.' D-emp), ' }}
                                                @endif
                                            @endif

                                            @if($ala2_emp->dieta == 28 || $ala2_emp->dieta == 29)
                                                @if($ala2_emp->carac5 == 1)
                                                    {{ '('.$ala2_emp->total_dietas.' L-emp), ' }}
                                                @endif

                                                @if($ala2_emp->carac5 == 2)
                                                    {{ '('.$ala2_emp->total_dietas.' B-emp), ' }}
                                                @endif

                                                @if($ala2_emp->carac5 == 3)
                                                    {{ '('.$ala2_emp->total_dietas.' D-emp), ' }}
                                                @endif

                                                @if($ala2_emp->carac5 == 4)
                                                    {{ '('.$ala2_emp->total_dietas.' H-emp), ' }}
                                                @endif

                                                @if($ala2_emp->carac5 == 5)
                                                    {{ '('.$ala2_emp->total_dietas.' DH-emp), ' }}
                                                @endif

                                                @if($ala2_emp->carac5 == 6)
                                                    {{ '('.$ala2_emp->total_dietas.' P-emp), ' }}
                                                @endif
                                            @endif
                                        @endif 
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                    </th>
                    <th>
                        @foreach($cocineta2 as $c2)
                            @foreach($c2['total_c2_sum_alas'] as $sum_alas)
                                @if($sum_alas->dieta == $d->id)
                                    {{ $sum_alas->total }}
                                @endif
                            @endforeach
                        @endforeach
                    </th>
                </tr>
            
            @endforeach           

            


            <tr class="total_td">
                <th colspan="4"><strong>TOTAL</strong></th>
                <th>
                    @foreach($cocineta2 as $c2)
                        @foreach($c2['total_c2_ala1'] as $ala1)                            
                            {{ $ala1->total }}
                        @endforeach
                    @endforeach
                </th>
                <th>
                    @foreach($cocineta2 as $c2)
                        @foreach($c2['total_c2_ala2'] as $ala2)                            
                            {{ $ala2->total }}
                        @endforeach
                    @endforeach
                </th>
                <th>
                    @foreach($cocineta2 as $c2)
                        @foreach($c2['total_c2'] as $t)                            
                            {{ $t->total }}
                        @endforeach
                    @endforeach
                </th>
            </tr>


        </table>
        <!--<p><strong>Generado: </strong> {{ \Carbon\Carbon::parse($hoy)->format('d/m/Y').' - '.\Carbon\Carbon::parse($hora_actual)->format('H.i').' Hrs.' }}</p>-->
        <div class="page_break"></div>
        <!--edificio D-->

        <table width="100%"  style=" margin-top:0px;  font-size: 12px;"  class="borde_table">
                
            <TR class="total_td">
                <TH  colspan="7">EDIFICIO D</TH>
            </TR>

            <TR class="total_td">
                <th style="text-align: left;">Fecha: {{ \Carbon\Carbon::parse($hoy)->format('d-m-Y') }} </th>
                <th>D </th>
                <th style="background-color: rgb(180, 180, 180);"> @if($jornada == 1) X @endif</th>
                <th>A </th>
                <th style="background-color: rgb(180, 180, 180);"> @if($jornada == 2) X @endif</th>
                <th>C </th>
                <th style="background-color: rgb(180, 180, 180);"> @if($jornada == 3) X @endif</th>
            </TR>

            <TR class="total_td">
                <TH style="font-size: 10px;" colspan="7">MHCD, MMCD, CHCD, CMCD, THCD, TMCD</TH>
            </TR>

            <TR class="total_td"> 
                <th colspan="4"></th>
                <!--<th>SOTANO</th>-->
                <th>NIVEL 1</th>
                <th>NIVEL 2</th>
                <th>TOTAL</th>
            </TR>

            @foreach($dietas as $d)
                <tr>
                    <th colspan="4">{{$d->name}}</th>
                    <!--<th>
                        @foreach($cocinetaED as $ced)
                            @foreach($ced['conteo_edificiod_sotano_totales'] as $sotano_totales)
                                @if($sotano_totales->dieta == $d->id)                                    

                                    {{ $sotano_totales->total_dietas.', '}}
                                @endif
                            @endforeach

                            @foreach($ced['conteo_edificiod_sotano_semp'] as $sotano_semp)
                                @if($sotano_semp->dieta == $d->id)
                                        @if($sotano_semp->dieta == 1 || $sotano_semp->dieta == 2 || $sotano_semp->dieta == 4 || $sotano_semp->dieta ==5)
                                            @if($sotano_semp->carac2 == 1)
                                                {{ '('.$sotano_semp->total_dietas.' D), ' }}
                                            @endif

                                            @if($sotano_semp->carac2 == 2)
                                                {{ '('.$sotano_semp->total_dietas.' H), ' }}
                                            @endif

                                            @if($sotano_semp->carac2 == 3)
                                                {{ '('.$sotano_semp->total_dietas.' DH), ' }}
                                            @endif
                                        @endif

                                        @if($sotano_semp->dieta == 7)
                                            @if($sotano_semp->carac3 == 1)
                                                {{ '('.$sotano_semp->total_dietas.' BF), ' }}
                                            @endif

                                            @if($sotano_semp->carac3 == 2)
                                                {{ '('.$sotano_semp->total_dietas.' AF), ' }}
                                            @endif

                                            @if($sotano_semp->carac3 == 3)
                                                {{ '('.$sotano_semp->total_dietas.' BP), ' }}
                                            @endif

                                            @if($sotano_semp->carac3 == 4)
                                                {{ '('.$sotano_semp->total_dietas.' AP), ' }}
                                            @endif
                                        @endif

                                        @if($sotano_semp->dieta == 20)
                                            @if($sotano_semp->carac4 == 1)
                                                {{ '('.$sotano_semp->total_dietas.' D), ' }}
                                            @endif
                                        @endif

                                        @if($sotano_semp->dieta == 28 || $sotano_semp->dieta == 29)
                                            @if($sotano_semp->carac5 == 1)
                                                {{ '('.$sotano_semp->total_dietas.' L), ' }}
                                            @endif

                                            @if($sotano_semp->carac5 == 2)
                                                {{ '('.$sotano_semp->total_dietas.' B), ' }}
                                            @endif

                                            @if($sotano_semp->carac5 == 3)
                                                {{ '('.$sotano_semp->total_dietas.' D), ' }}
                                            @endif

                                            @if($sotano_semp->carac5 == 4)
                                                {{ '('.$sotano_semp->total_dietas.' H), ' }}
                                            @endif

                                            @if($sotano_semp->carac5 == 5)
                                                {{ '('.$sotano_semp->total_dietas.' DH), ' }}
                                            @endif

                                            @if($sotano_semp->carac5 == 6)
                                                {{ '('.$sotano_semp->total_dietas.' P), ' }}
                                            @endif
                                        @endif
                                @endif
                            @endforeach

                            @if($ced['conteo_edificiod_sotano_emp'])
                                @foreach($ced['conteo_edificiod_sotano_emp'] as $sotano_emp)
                                    @if($sotano_emp->dieta == $d->id)
                                        @if($sotano_emp->carac2 == 0 && $sotano_emp->carac3 == 0 && $sotano_emp->carac4 == 0 && $sotano_emp->carac5 == 0)
                                            {{ '('.$sotano_emp->total_dietas.' emp), '}}
                                        @else
                                            @if($sotano_emp->dieta == 1 || $sotano_emp->dieta == 2 || $sotano_emp->dieta == 4 || $sotano_emp->dieta ==5)
                                                @if($sotano_emp->carac2 == 1)
                                                    {{ '('.$sotano_emp->total_dietas.' D-emp), ' }}
                                                @endif

                                                @if($sotano_emp->carac2 == 2)
                                                    {{ '('.$sotano_emp->total_dietas.' H-emp), ' }}
                                                @endif

                                                @if($sotano_emp->carac2 == 3)
                                                    {{ '('.$sotano_emp->total_dietas.' DH-emp), ' }}
                                                @endif
                                            @endif

                                            @if($sotano_emp->dieta == 7)
                                                @if($sotano_emp->carac3 == 1)
                                                    {{ '('.$sotano_emp->total_dietas.' BF-emp), ' }}
                                                @endif

                                                @if($sotano_emp->carac3 == 2)
                                                    {{ '('.$sotano_emp->total_dietas.' AF-emp), ' }}
                                                @endif

                                                @if($sotano_emp->carac3 == 3)
                                                    {{ '('.$sotano_emp->total_dietas.' BP-emp), ' }}
                                                @endif

                                                @if($sotano_emp->carac3 == 4)
                                                    {{ '('.$sotano_emp->total_dietas.' AP-emp), ' }}
                                                @endif
                                            @endif

                                            @if($sotano_emp->dieta == 20)
                                                @if($sotano_emp->carac4 == 1)
                                                    {{ '('.$sotano_emp->total_dietas.' D-emp), ' }}
                                                @endif
                                            @endif

                                            @if($sotano_emp->dieta == 28 || $sotano_emp->dieta == 29)
                                                @if($sotano_emp->carac5 == 1)
                                                    {{ '('.$sotano_emp->total_dietas.' L-emp), ' }}
                                                @endif

                                                @if($sotano_emp->carac5 == 2)
                                                    {{ '('.$sotano_emp->total_dietas.' B-emp), ' }}
                                                @endif

                                                @if($sotano_emp->carac5 == 3)
                                                    {{ '('.$sotano_emp->total_dietas.' D-emp), ' }}
                                                @endif

                                                @if($sotano_emp->carac5 == 4)
                                                    {{ '('.$sotano_emp->total_dietas.' H-emp), ' }}
                                                @endif

                                                @if($sotano_emp->carac5 == 5)
                                                    {{ '('.$sotano_emp->total_dietas.' DH-emp), ' }}
                                                @endif

                                                @if($sotano_emp->carac5 == 6)
                                                    {{ '('.$sotano_emp->total_dietas.' P-emp), ' }}
                                                @endif
                                            @endif
                                        @endif 
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                    </th>-->
                    <th>
                        @foreach($cocinetaED as $ced)
                            @foreach($ced['conteo_edificiod_ala1_totales'] as $ala1_totales)
                                @if($ala1_totales->dieta == $d->id)                                    

                                    {{ $ala1_totales->total_dietas.', '}}
                                @endif
                            @endforeach
                            @foreach($ced['conteo_edificiod_ala1_semp'] as $ala1_semp)
                                @if($ala1_semp->dieta == $d->id)
                                    
                                        @if($ala1_semp->dieta == 1 || $ala1_semp->dieta == 2 || $ala1_semp->dieta == 4 || $ala1_semp->dieta ==5)
                                            @if($ala1_semp->carac2 == 1)
                                                {{ '('.$ala1_semp->total_dietas.' D), ' }}
                                            @endif

                                            @if($ala1_semp->carac2 == 2)
                                                {{ '('.$ala1_semp->total_dietas.' H), ' }}
                                            @endif

                                            @if($ala1_semp->carac2 == 3)
                                                {{ '('.$ala1_semp->total_dietas.' DH), ' }}
                                            @endif
                                        @endif

                                        @if($ala1_semp->dieta == 7)
                                            @if($ala1_semp->carac3 == 1)
                                                {{ '('.$ala1_semp->total_dietas.' BF), ' }}
                                            @endif

                                            @if($ala1_semp->carac3 == 2)
                                                {{ '('.$ala1_semp->total_dietas.' AF), ' }}
                                            @endif

                                            @if($ala1_semp->carac3 == 3)
                                                {{ '('.$ala1_semp->total_dietas.' BP), ' }}
                                            @endif

                                            @if($ala1_semp->carac3 == 4)
                                                {{ '('.$ala1_semp->total_dietas.' AP), ' }}
                                            @endif
                                        @endif

                                        @if($ala1_semp->dieta == 20)
                                            @if($ala1_semp->carac4 == 1)
                                                {{ '('.$ala1_semp->total_dietas.' D), ' }}
                                            @endif
                                        @endif

                                        @if($ala1_semp->dieta == 28 || $ala1_semp->dieta == 29)
                                            @if($ala1_semp->carac5 == 1)
                                                {{ '('.$ala1_semp->total_dietas.' L), ' }}
                                            @endif

                                            @if($ala1_semp->carac5 == 2)
                                                {{ '('.$ala1_semp->total_dietas.' B), ' }}
                                            @endif

                                            @if($ala1_semp->carac5 == 3)
                                                {{ '('.$ala1_semp->total_dietas.' D), ' }}
                                            @endif

                                            @if($ala1_semp->carac5 == 4)
                                                {{ '('.$ala1_semp->total_dietas.' H), ' }}
                                            @endif

                                            @if($ala1_semp->carac5 == 5)
                                                {{ '('.$ala1_semp->total_dietas.' DH), ' }}
                                            @endif

                                            @if($ala1_semp->carac5 == 6)
                                                {{ '('.$ala1_semp->total_dietas.' P), ' }}
                                            @endif
                                        @endif
                                @endif
                            @endforeach

                            @if($ced['conteo_edificiod_ala1_emp'])
                                @foreach($ced['conteo_edificiod_ala1_emp'] as $ala1_emp)
                                    @if($ala1_emp->dieta == $d->id)
                                        @if($ala1_emp->carac2 == 0 && $ala1_emp->carac3 == 0 && $ala1_emp->carac4 == 0 && $ala1_emp->carac5 == 0)
                                            {{ '('.$ala1_emp->total_dietas.' emp), '}}
                                        @else
                                            @if($ala1_emp->dieta == 1 || $ala1_emp->dieta == 2 || $ala1_emp->dieta == 4 || $ala1_emp->dieta ==5)
                                                @if($ala1_emp->carac2 == 1)
                                                    {{ '('.$ala1_emp->total_dietas.' D-emp), ' }}
                                                @endif

                                                @if($ala1_emp->carac2 == 2)
                                                    {{ '('.$ala1_emp->total_dietas.' H-emp), ' }}
                                                @endif

                                                @if($ala1_emp->carac2 == 3)
                                                    {{ '('.$ala1_emp->total_dietas.' DH-emp), ' }}
                                                @endif
                                            @endif

                                            @if($ala1_emp->dieta == 7)
                                                @if($ala1_emp->carac3 == 1)
                                                    {{ '('.$ala1_emp->total_dietas.' BF-emp), ' }}
                                                @endif

                                                @if($ala1_emp->carac3 == 2)
                                                    {{ '('.$ala1_emp->total_dietas.' AF-emp), ' }}
                                                @endif

                                                @if($ala1_emp->carac3 == 3)
                                                    {{ '('.$ala1_emp->total_dietas.' BP-emp), ' }}
                                                @endif

                                                @if($ala1_emp->carac3 == 4)
                                                    {{ '('.$ala1_emp->total_dietas.' AP-emp), ' }}
                                                @endif
                                            @endif

                                            @if($ala1_emp->dieta == 20)
                                                @if($ala1_emp->carac4 == 1)
                                                    {{ '('.$ala1_emp->total_dietas.' D-emp), ' }}
                                                @endif
                                            @endif

                                            @if($ala1_emp->dieta == 28 || $ala1_emp->dieta == 29)
                                                @if($ala1_emp->carac5 == 1)
                                                    {{ '('.$ala1_emp->total_dietas.' L-emp), ' }}
                                                @endif

                                                @if($ala1_emp->carac5 == 2)
                                                    {{ '('.$ala1_emp->total_dietas.' B-emp), ' }}
                                                @endif

                                                @if($ala1_emp->carac5 == 3)
                                                    {{ '('.$ala1_emp->total_dietas.' D-emp), ' }}
                                                @endif

                                                @if($ala1_emp->carac5 == 4)
                                                    {{ '('.$ala1_emp->total_dietas.' H-emp), ' }}
                                                @endif

                                                @if($ala1_emp->carac5 == 5)
                                                    {{ '('.$ala1_emp->total_dietas.' DH-emp), ' }}
                                                @endif

                                                @if($ala1_emp->carac5 == 6)
                                                    {{ '('.$ala1_emp->total_dietas.' P-emp), ' }}
                                                @endif
                                            @endif
                                        @endif 
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                    </th>
                    <th>
                        @foreach($cocinetaED as $ced)
                            @foreach($ced['conteo_edificiod_ala2_totales'] as $ala2_totales)
                                @if($ala2_totales->dieta == $d->id)                                    

                                    {{ $ala2_totales->total_dietas.', '}}
                                @endif
                            @endforeach
                            @foreach($ced['conteo_edificiod_ala2_semp'] as $ala2_semp)
                                @if($ala2_semp->dieta == $d->id)
                                    
                                        @if($ala2_semp->dieta == 1 || $ala2_semp->dieta == 2 || $ala2_semp->dieta == 4 || $ala2_semp->dieta ==5)
                                            @if($ala2_semp->carac2 == 1)
                                                {{ '('.$ala2_semp->total_dietas.' D), ' }}
                                            @endif

                                            @if($ala2_semp->carac2 == 2)
                                                {{ '('.$ala2_semp->total_dietas.' H), ' }}
                                            @endif

                                            @if($ala2_semp->carac2 == 3)
                                                {{ '('.$ala2_semp->total_dietas.' DH), ' }}
                                            @endif
                                        @endif

                                        @if($ala2_semp->dieta == 7)
                                            @if($ala2_semp->carac3 == 1)
                                                {{ '('.$ala2_semp->total_dietas.' BF), ' }}
                                            @endif

                                            @if($ala2_semp->carac3 == 2)
                                                {{ '('.$ala2_semp->total_dietas.' AF), ' }}
                                            @endif

                                            @if($ala2_semp->carac3 == 3)
                                                {{ '('.$ala2_semp->total_dietas.' BP), ' }}
                                            @endif

                                            @if($ala2_semp->carac3 == 4)
                                                {{ '('.$ala2_semp->total_dietas.' AP), ' }}
                                            @endif
                                        @endif

                                        @if($ala2_semp->dieta == 20)
                                            @if($ala2_semp->carac4 == 1)
                                                {{ '('.$ala2_semp->total_dietas.' D), ' }}
                                            @endif
                                        @endif

                                        @if($ala2_semp->dieta == 28 || $ala2_semp->dieta == 29)
                                            @if($ala2_semp->carac5 == 1)
                                                {{ '('.$ala2_semp->total_dietas.' L), ' }}
                                            @endif

                                            @if($ala2_semp->carac5 == 2)
                                                {{ '('.$ala2_semp->total_dietas.' B), ' }}
                                            @endif

                                            @if($ala2_semp->carac5 == 3)
                                                {{ '('.$ala2_semp->total_dietas.' D), ' }}
                                            @endif

                                            @if($ala2_semp->carac5 == 4)
                                                {{ '('.$ala2_semp->total_dietas.' H), ' }}
                                            @endif

                                            @if($ala2_semp->carac5 == 5)
                                                {{ '('.$ala2_semp->total_dietas.' DH), ' }}
                                            @endif

                                            @if($ala2_semp->carac5 == 6)
                                                {{ '('.$ala2_semp->total_dietas.' P), ' }}
                                            @endif
                                        @endif
                                @endif
                            @endforeach

                            @if($ced['conteo_edificiod_ala2_emp'])
                                @foreach($ced['conteo_edificiod_ala2_emp'] as $ala2_emp)
                                    @if($ala2_emp->dieta == $d->id)
                                        @if($ala2_emp->carac2 == 0 && $ala2_emp->carac3 == 0 && $ala2_emp->carac4 == 0 && $ala2_emp->carac5 == 0)
                                            {{ '('.$ala2_emp->total_dietas.' emp), '}}
                                        @else
                                            @if($ala2_emp->dieta == 1 || $ala2_emp->dieta == 2 || $ala2_emp->dieta == 4 || $ala2_emp->dieta ==5)
                                                @if($ala2_emp->carac2 == 1)
                                                    {{ '('.$ala2_emp->total_dietas.' D-emp), ' }}
                                                @endif

                                                @if($ala2_emp->carac2 == 2)
                                                    {{ '('.$ala2_emp->total_dietas.' H-emp), ' }}
                                                @endif

                                                @if($ala2_emp->carac2 == 3)
                                                    {{ '('.$ala2_emp->total_dietas.' DH-emp), ' }}
                                                @endif
                                            @endif

                                            @if($ala2_emp->dieta == 7)
                                                @if($ala2_emp->carac3 == 1)
                                                    {{ '('.$ala2_emp->total_dietas.' BF-emp), ' }}
                                                @endif

                                                @if($ala2_emp->carac3 == 2)
                                                    {{ '('.$ala2_emp->total_dietas.' AF-emp), ' }}
                                                @endif

                                                @if($ala2_emp->carac3 == 3)
                                                    {{ '('.$ala2_emp->total_dietas.' BP-emp), ' }}
                                                @endif

                                                @if($ala2_emp->carac3 == 4)
                                                    {{ '('.$ala2_emp->total_dietas.' AP-emp), ' }}
                                                @endif
                                            @endif

                                            @if($ala2_emp->dieta == 20)
                                                @if($ala2_emp->carac4 == 1)
                                                    {{ '('.$ala2_emp->total_dietas.' D-emp), ' }}
                                                @endif
                                            @endif

                                            @if($ala2_emp->dieta == 28 || $ala2_emp->dieta == 29)
                                                @if($ala2_emp->carac5 == 1)
                                                    {{ '('.$ala2_emp->total_dietas.' L-emp), ' }}
                                                @endif

                                                @if($ala2_emp->carac5 == 2)
                                                    {{ '('.$ala2_emp->total_dietas.' B-emp), ' }}
                                                @endif

                                                @if($ala2_emp->carac5 == 3)
                                                    {{ '('.$ala2_emp->total_dietas.' D-emp), ' }}
                                                @endif

                                                @if($ala2_emp->carac5 == 4)
                                                    {{ '('.$ala2_emp->total_dietas.' H-emp), ' }}
                                                @endif

                                                @if($ala2_emp->carac5 == 5)
                                                    {{ '('.$ala2_emp->total_dietas.' DH-emp), ' }}
                                                @endif

                                                @if($ala2_emp->carac5 == 6)
                                                    {{ '('.$ala2_emp->total_dietas.' P-emp), ' }}
                                                @endif
                                            @endif
                                        @endif 
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                    </th>
                    <th>
                        @foreach($cocinetaED as $ced)
                            @foreach($ced['total_edificiod_sum_alas'] as $sum_alas)
                                @if($sum_alas->dieta == $d->id)
                                    {{ $sum_alas->total }}
                                @endif
                            @endforeach
                        @endforeach
                    </th>
                </tr>
            
            @endforeach

            


            <tr class="total_td">
                <th colspan="4"><strong>TOTAL</strong></th>
                <!--<th> 
                    @foreach($cocinetaED as $ced)
                        @foreach($ced['total_edificiod_sotano'] as $sotano)                            
                            {{ $sotano->total }}
                        @endforeach
                    @endforeach
                </th>-->
                
                <th> 
                    @foreach($cocinetaED as $ced)
                        @foreach($ced['total_edificiod_ala1'] as $ala1)                            
                            {{ $ala1->total }}
                        @endforeach
                    @endforeach
                </th>
                <th>
                    @foreach($cocinetaED as $ced)
                        @foreach($ced['total_edificiod_ala2'] as $ala2)                            
                            {{ $ala2->total }}
                        @endforeach
                    @endforeach
                </th>
                <th>
                    @foreach($cocinetaED as $ced)
                        @foreach($ced['total_edificiod'] as $t)                            
                            {{ $t->total }}
                        @endforeach
                    @endforeach
                </th>
            </tr>


        </table>
        <!--<p><strong>Generado: </strong> {{ \Carbon\Carbon::parse($hoy)->format('d/m/Y').' - '.\Carbon\Carbon::parse($hora_actual)->format('H.i').' Hrs.' }}</p>-->
        <div class="page_break"></div>
        <!--emergencias-->
        <table width="100%"  style=" margin-top:0px;  font-size: 12px;"  class="borde_table">
                
            <TR class="total_td">
                <TH  colspan="7">EMERGENCIAS/INTERMEDIOS/UCIA</TH>
            </TR>

            <TR class="total_td">
                <th style="text-align: left;">Fecha: {{ \Carbon\Carbon::parse($hoy)->format('d-m-Y') }}</th>
                <th>D </th>
                <th style="background-color: rgb(180, 180, 180);"> @if($jornada == 1) X @endif</th>
                <th>A </th>
                <th style="background-color: rgb(180, 180, 180);"> @if($jornada == 2) X @endif</th>
                <th>C </th>
                <th style="background-color: rgb(180, 180, 180);"> @if($jornada == 3) X @endif</th>
            </TR>

            <TR class="total_td"> 
                <th colspan="4"></th>
                <th colspan="3">TOTAL</th>
            </TR>
            @foreach($dietas as $d)
                <tr>
                    <th colspan="4">{{$d->name}}</th>
                    <th colspan="3">
                        @foreach($cocinetaEM as $cem)
                            @foreach($cem['conteo_emer_totales'] as $ala_totales)
                                @if($ala_totales->dieta == $d->id)                                    

                                    {{ $ala_totales->total_dietas.', '}}
                                @endif
                            @endforeach
                            @foreach($cem['conteo_emer_semp'] as $ala_semp)
                                @if($ala_semp->dieta == $d->id)
                                    
                                        @if($ala_semp->dieta == 1 || $ala_semp->dieta == 2 || $ala_semp->dieta == 4 || $ala_semp->dieta ==5)
                                            @if($ala_semp->carac2 == 1)
                                                {{ '('.$ala_semp->total_dietas.' D), ' }}
                                            @endif

                                            @if($ala_semp->carac2 == 2)
                                                {{ '('.$ala_semp->total_dietas.' H), ' }}
                                            @endif

                                            @if($ala_semp->carac2 == 3)
                                                {{ '('.$ala_semp->total_dietas.' DH), ' }}
                                            @endif
                                        @endif

                                        @if($ala_semp->dieta == 7)
                                            @if($ala_semp->carac3 == 1)
                                                {{ '('.$ala_semp->total_dietas.' BF), ' }}
                                            @endif

                                            @if($ala_semp->carac3 == 2)
                                                {{ '('.$ala_semp->total_dietas.' AF), ' }}
                                            @endif

                                            @if($ala_semp->carac3 == 3)
                                                {{ '('.$ala_semp->total_dietas.' BP), ' }}
                                            @endif

                                            @if($ala_semp->carac3 == 4)
                                                {{ '('.$ala_semp->total_dietas.' AP), ' }}
                                            @endif
                                        @endif

                                        @if($ala_semp->dieta == 20)
                                            @if($ala_semp->carac4 == 1)
                                                {{ '('.$ala_semp->total_dietas.' D), ' }}
                                            @endif
                                        @endif

                                        @if($ala_semp->dieta == 28 || $ala_semp->dieta == 29)
                                            @if($ala_semp->carac5 == 1)
                                                {{ '('.$ala_semp->total_dietas.' L), ' }}
                                            @endif

                                            @if($ala_semp->carac5 == 2)
                                                {{ '('.$ala_semp->total_dietas.' B), ' }}
                                            @endif

                                            @if($ala_semp->carac5 == 3)
                                                {{ '('.$ala_semp->total_dietas.' D), ' }}
                                            @endif

                                            @if($ala_semp->carac5 == 4)
                                                {{ '('.$ala_semp->total_dietas.' H), ' }}
                                            @endif

                                            @if($ala_semp->carac5 == 5)
                                                {{ '('.$ala_semp->total_dietas.' DH), ' }}
                                            @endif

                                            @if($ala_semp->carac5 == 6)
                                                {{ '('.$ala_semp->total_dietas.' P), ' }}
                                            @endif
                                        @endif
                                @endif
                            @endforeach

                            @if($cem['conteo_emer_emp'])
                                @foreach($cem['conteo_emer_emp'] as $ala_emp)
                                    @if($ala_emp->dieta == $d->id)
                                        @if($ala_emp->carac2 == 0 && $ala_emp->carac3 == 0 && $ala_emp->carac4 == 0 && $ala_emp->carac5 == 0)
                                            {{ '('.$ala_emp->total_dietas.' emp), '}}
                                        @else
                                            @if($ala_emp->dieta == 1 || $ala_emp->dieta == 2 || $ala_emp->dieta == 4 || $ala_emp->dieta ==5)
                                                @if($ala_emp->carac2 == 1)
                                                    {{ '('.$ala_emp->total_dietas.' D-emp), ' }}
                                                @endif

                                                @if($ala_emp->carac2 == 2)
                                                    {{ '('.$ala_emp->total_dietas.' H-emp), ' }}
                                                @endif

                                                @if($ala_emp->carac2 == 3)
                                                    {{ '('.$ala_emp->total_dietas.' DH-emp), ' }}
                                                @endif
                                            @endif

                                            @if($ala_emp->dieta == 7)
                                                @if($ala_emp->carac3 == 1)
                                                    {{ '('.$ala_emp->total_dietas.' BF-emp), ' }}
                                                @endif

                                                @if($ala_emp->carac3 == 2)
                                                    {{ '('.$ala_emp->total_dietas.' AF-emp), ' }}
                                                @endif

                                                @if($ala_emp->carac3 == 3)
                                                    {{ '('.$ala_emp->total_dietas.' BP-emp), ' }}
                                                @endif

                                                @if($ala_emp->carac3 == 4)
                                                    {{ '('.$ala_emp->total_dietas.' AP-emp), ' }}
                                                @endif
                                            @endif

                                            @if($ala_emp->dieta == 20)
                                                @if($ala_emp->carac4 == 1)
                                                    {{ '('.$ala_emp->total_dietas.' D-emp), ' }}
                                                @endif
                                            @endif

                                            @if($ala_emp->dieta == 28 || $ala_emp->dieta == 29)
                                                @if($ala_emp->carac5 == 1)
                                                    {{ '('.$ala_emp->total_dietas.' L-emp), ' }}
                                                @endif

                                                @if($ala_emp->carac5 == 2)
                                                    {{ '('.$ala_emp->total_dietas.' B-emp), ' }}
                                                @endif

                                                @if($ala_emp->carac5 == 3)
                                                    {{ '('.$ala_emp->total_dietas.' D-emp), ' }}
                                                @endif

                                                @if($ala_emp->carac5 == 4)
                                                    {{ '('.$ala_emp->total_dietas.' H-emp), ' }}
                                                @endif

                                                @if($ala_emp->carac5 == 5)
                                                    {{ '('.$ala_emp->total_dietas.' DH-emp), ' }}
                                                @endif

                                                @if($ala_emp->carac5 == 6)
                                                    {{ '('.$ala_emp->total_dietas.' P-emp), ' }}
                                                @endif
                                            @endif
                                        @endif 
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                    </th>
                </tr>
            
            @endforeach

            <tr class="total_td">
                <th colspan="4"><strong>TOTAL</strong></th>
                <th colspan="3">
                    @foreach($cocinetaEM as $cem)
                        @foreach($cem['total_emer'] as $t)                            
                            {{ $t->total }}
                        @endforeach
                    @endforeach
                </th>
            </tr>


        </table>        
        <!--<p><strong>Generado: </strong> {{ \Carbon\Carbon::parse($hoy)->format('d/m/Y').' - '.\Carbon\Carbon::parse($hora_actual)->format('H.i').' Hrs.' }}</p>-->
    </body>
</html>
