<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Solicitud de Dietas - {{ $dr->id }}</title>
    <style>
    @page {
        margin: 1.5cm 1cm; /* Margen superior e inferior para que no pegue al borde */
    }
    body { 
        font-size: 11px; /* Bajamos un punto para asegurar que quepa todo */
        font-family: 'Roboto Slab', serif; 
        margin: 0; 
        padding: 0;
    }
    table { 
        border-collapse: collapse; 
        width: 100%; 
        table-layout: fixed; /* Mantiene las columnas alineadas */
    }
    th, td { 
        border: 1px solid black; 
        padding: 3px 5px; 
        height: 19px; /* Altura mínima por celda */
        word-wrap: break-word;
    }
    .header-table { border: none; margin-bottom: 10px; }
    .header-table td { border: none; padding: 0; }
    
    /* Clase para forzar celdas más altas en secciones vacías */
    .filler-cell {
        height: 35px; 
    }

        .header-container { width: 100%; height: 50px; position: relative; }
        .logo { position: absolute; left: 0; top: 0; }
        .title { text-align: center; font-weight: bold; font-size: 14px; margin-top: 10px; }
        .code { position: absolute; right: 0; top: 0; font-weight: bold; }
        .input-box { border: 1px solid black; padding: 2px 10px; display: inline-block; min-width: 100px; }
        .info-header { margin-top: 20px; width: 100%; }
        .text-left { text-align: left; }
    </style>
</style>
</head>
<body>

    <div class="header-container">
        <div class="logo">
            <img src="{{ public_path('img/Isotipo.png') }}" alt="" width="40px" height="40px">
        </div>
        <div class="title">SOLICITUD DE DIETAS DIARIAS</div>
        <div class="code">SPS-184</div>
    </div>

    <table style="border: none; margin-top: 20px;">
        <tr style="border: none;">
            <td style="border: none; text-align: left; width: 50%;">
                Tiempo de Alimentación: <span class="input-box">{{ $dr->journey->name }}</span>
            </td>
            <td style="border: none; text-align: right; width: 50%;">
                Fecha: <span class="input-box">{{ $dr->created_at->format('d/m/Y H:i') }}</span>
            </td>
        </tr>
    </table>

    <table>
        <tr>
            <th>Servicio</th>
            <td>{{ $dr->service->name }}</td>
            <th>Nombre Jefe</th>
            <td>{{ $dr->user->name . ' ' . $dr->user->lastname }}</td>
            <th>Firma</th>
            <td style="width: 100px;"></td>
        </tr>
    </table>

    <table>
        <thead>
            <tr>
                <th colspan="2">Tipo de Dietas</th>
                <th colspan="2">Número de las Camas</th>
                <th colspan="2">Total: {{ $dr->total_diets }}</th>
            </tr>
        </thead>
        <tbody>
            @php
                // Función auxiliar para renderizar filas dinámicas
                $renderDiet = function($id, $label, $rowspan_parent = null) use ($details, $subtotales) {
                    $camas = $details->get($id) ?? collect();
                    $chunks = $camas->chunk(8); // 8 camas por fila
                    $totalFilas = max($chunks->count(), 2); // Mínimo 2 filas según formato
                    $subtotal = $subtotales->get($id) ?? '';

                    $html = "<tr>";
                    if ($rowspan_parent) $html .= "<th rowspan='{$rowspan_parent}'>LÍQUIDAS</th>";
                    
                    $html .= "<th rowspan='{$totalFilas}'>{$label}</th>";
                    $html .= "<td colspan='2'>" . ($chunks->has(0) ? $chunks[0]->pluck('bed_number')->implode(', ') : '') . "</td>";
                    $html .= "<td rowspan='{$totalFilas}' colspan='2'>{$subtotal}</td>";
                    $html .= "</tr>";

                    for ($i = 1; $i < $totalFilas; $i++) {
                        $html .= "<tr><td colspan='2'>" . ($chunks->has($i) ? $chunks[$i]->pluck('bed_number')->implode(', ') : '') . "</td></tr>";
                    }
                    return $html;
                };
            @endphp

            {{-- SECCIÓN LÍQUIDAS --}}
            {!! $renderDiet(1, 'Claros', 4) !!} {{-- El 4 es el rowspan total de Líquidas (2 de Claros + 2 de Completos) --}}
            {!! $renderDiet(2, 'Completos') !!}

            {{-- DIETAS SIMPLES --}}
            @foreach([3=>'Blanda', 4=>'Papilla (licuada/puré)', 5=>'Picada', 6=>'Hipograsa', 7=>'Hiposódica'] as $id => $label)
                @php
                    $camas = $details->get($id) ?? collect();
                    $chunks = $camas->chunk(8);
                    $totalFilas = max($chunks->count(), 2);
                @endphp
                <tr>
                    <th colspan="2" rowspan="{{ $totalFilas }}">{{ $label }}</th>
                    <td colspan="2">{{ $chunks->has(0) ? $chunks[0]->pluck('bed_number')->implode(', ') : '' }}</td>
                    <td colspan="2" rowspan="{{ $totalFilas }}">{{ $subtotales->get($id) ?? '' }}</td>
                </tr>
                @for ($i = 1; $i < $totalFilas; $i++)
                    <tr><td colspan="2">{{ $chunks->has($i) ? $chunks[$i]->pluck('bed_number')->implode(', ') : '' }}</td></tr>
                @endfor
            @endforeach

            {{-- SECCIÓN DIABÉTICA (Agrupada) --}}
            @php
                $idsDiab = [8, 9, 10, 11];
                $labelsDiab = [8=>'1,500 Cal', 9=>'1,800 Cal', 10=>'2,000 Cal', 11=>'2,200 Cal'];
                $totalSumaDiab = 0;
                foreach($idsDiab as $id) $totalSumaDiab += ($subtotales->get($id) ?? 0);
            @endphp
            @foreach($idsDiab as $index => $id)
                @php
                    $camas = $details->get($id) ?? collect();
                    $chunks = $camas->chunk(8);
                    $totalFilas = max($chunks->count(), 1);
                @endphp
                <tr>
                    @if($index == 0) <th rowspan="{{ count($idsDiab) }}">DIABÉTICA</th> @endif
                    <th>{{ $labelsDiab[$id] }}</th>
                    <td colspan="2">{{ $camas->pluck('bed_number')->implode(', ') }}</td>
                    @if($index == 0) <td rowspan="{{ count($idsDiab) }}" colspan="2">{{ $totalSumaDiab > 0 ? $totalSumaDiab : '' }}</td> @endif
                </tr>
            @endforeach

            {{-- DIETAS PEDIÁTRICAS --}}
            @php
                $idsPed = [13=>'06 a 09 meses (papilla)', 14=>'09 a 12 meses (picada)', 15=>'01 a 07 años (libre)'];
            @endphp
            @foreach($idsPed as $id => $label)
                <tr>
                    @if($id == 13) <th rowspan="3">PEDIÁTRICAS</th> @endif
                    <th>{{ $label }}</th>
                    <td colspan="2">{{ ($details->get($id) ?? collect())->pluck('bed_number')->implode(', ') }}</td>
                    <td colspan="2">{{ $subtotales->get($id) ?? '' }}</td>
                </tr>
            @endforeach

            {{-- OTRAS (Especificar) --}}
            @php
                $idsOtras = [19,20,21,22,23,24,25,26,27,28,29];
                $detallesOtras = collect();
                foreach($idsOtras as $id) { 
                    if($details->has($id)) $detallesOtras = $detallesOtras->concat($details->get($id)); 
                }
                
                $listaOtras = $detallesOtras->map(fn($d) => $d->specify ? "$d->specify ($d->bed_number)" : $d->bed_number);
                $chunksOtras = $listaOtras->chunk(4);
                
                // Aumentamos el mínimo de 2 a 3 para que "estire" la tabla hacia el final de la hoja
                $filasOtras = max($chunksOtras->count(), 3); 
                $sumOtras = $subtotales_otras->first()->subtotal ?? 0;
            @endphp
            <tr>
                <th colspan="2" rowspan="{{ $filasOtras }}">OTRAS (Especificar)</th>
                <td colspan="2" class="filler-cell">{{ $chunksOtras->has(0) ? $chunksOtras[0]->implode(', ') : '' }}</td>
                <td colspan="2" rowspan="{{ $filasOtras }}">{{ $sumOtras > 0 ? $sumOtras : '' }}</td>
            </tr>
            @for ($i = 1; $i < $filasOtras; $i++)
                <tr><td colspan="2" class="filler-cell">{{ $chunksOtras->has($i) ? $chunksOtras[$i]->implode(', ') : '' }}</td></tr>
            @endfor

            {{-- NPO (Fila final) --}}
            <tr>
                <th colspan="2" style="height: 40px;">NPO</th>
                <td colspan="2">{{ ($details->get(18) ?? collect())->pluck('bed_number')->implode(', ') }}</td>
                <td colspan="2">{{ $subtotales->get(18) ?? '' }}</td>
            </tr>
        </tbody>
    </table>

</body>
</html>