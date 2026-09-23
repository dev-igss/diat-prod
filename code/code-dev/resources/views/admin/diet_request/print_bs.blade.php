<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>SPS-1071 - Solicitud de refrigerio para donadores</title>
<style>
    @page { margin: 0; }

    body {
        margin: 0;
        padding: 0.3in 0.55in 0.2in 0.55in;
        font-family: Helvetica, Arial, sans-serif;
        font-size: 11pt;
        color: #000;
    }

    table { width: 100%; border-collapse: collapse; }
    td { padding: 0; vertical-align: bottom; }

    /* Encabezado */
    .encabezado td { vertical-align: middle; }
    .col-logo { width: 0.9in; height: 0.85in; }
    .col-logo img { width: 0.8in; }
    .col-codigo {
        width: 0.9in;
        vertical-align: top !important;
        text-align: right;
        font-family: "Times New Roman", Times, serif;
        font-weight: bold;
        font-size: 12pt;
    }
    .institucion { text-align: center; }
    .nombre { font-weight: bold; font-size: 12.5pt; }
    .unidad { font-weight: bold; font-size: 9.5pt; padding-top: 2px; }

    /* Título */
    .titulo {
        text-align: center;
        font-weight: bold;
        font-size: 12.5pt;
        line-height: 1.25;
        margin: 0.1in 0 0.2in 0;
    }

    /* Campos */
    .campo { margin-bottom: 0.17in; }
    .etiqueta { white-space: nowrap; width: 1%; padding-right: 4px; }
    .linea { border-bottom: 1px solid #000; }
    .texto-final { white-space: nowrap; padding-left: 4px; }
    .dato {
        text-align: center;
        font-size: 11pt;
        padding-bottom: 1px;
    }

    /* Firma */
    .atentamente { margin: 0.2in 0 0.3in 0; }
    .leyenda { padding-top: 4px; padding-left: 1.05in; }
</style>
</head>
<body>

    {{-- Encabezado --}}
    <table class="encabezado">
        <tr>
            <td class="col-logo">
                <img src="{{ public_path('img/logo-igss.png') }}" alt="">
            </td>
            <td class="institucion">
                <div class="nombre">INSTITUTO GUATEMALTECO DE SEGURIDAD SOCIAL</div>
                <div class="unidad">Banco de Sangre</div>
            </td>
            <td class="col-codigo">SPS-1071</td>
        </tr>
    </table>

    {{-- Título --}}
    <div class="titulo">
        SOLICITUD DE REFRIGERIO PARA<br>
        DONADORES DEL BANCO DE SANGRE
    </div>

    {{-- Fecha (alineada a la derecha) --}}
    <table class="campo">
        <tr>
            <td style="width: 4.55in;">&nbsp;</td>
            <td class="etiqueta">Fecha:</td>
            <td class="linea dato">{{ \Carbon\Carbon::parse($diet_request->created_at)->format('d-m-Y')  }}&nbsp;</td>
        </tr>
    </table>

    {{-- Cantidad --}}
    <table class="campo">
        <tr>
            <td class="etiqueta">Por este medio solicito la cantidad de:</td>
            <td class="linea dato" style="width: 1.6in;"> {{ $diet_request->total_diets }} &nbsp;</td>
            <td class="texto-final">refacciones para donadores de sangre.</td>
        </tr>
    </table>

    {{-- Nombre --}}
    <table class="campo">
        <tr>
            <td class="etiqueta">Nombre de la persona que solicita:</td>
            <td class="linea">&nbsp;</td>
        </tr>
    </table>

    {{-- Cargo --}}
    <table class="campo">
        <tr>
            <td class="etiqueta">Cargo:</td>
            <td class="linea">&nbsp;</td>
        </tr>
    </table>

    <div class="atentamente">Atentamente,</div>

    {{-- Firma y sello --}}
    <table>
        <tr>
            <td style="width: 2.25in;">&nbsp;</td>
            <td class="etiqueta">Firma y sello</td>
            <td class="linea">&nbsp;</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td colspan="2" class="leyenda">Personal responsable del servicio solicitante</td>
        </tr>
    </table>

</body>
</html>
