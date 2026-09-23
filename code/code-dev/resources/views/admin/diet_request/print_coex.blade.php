<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<style>
    @page { margin: 0; }

    body {
        margin: 0;
        padding: 0.3in 0.6in 0.2in 0.5in;
        font-family: Helvetica, Arial, sans-serif;
        color: #000;
    }

    table { width: 100%; border-collapse: collapse; }
    td { padding: 0; }

    /* Encabezado */
    .encabezado td { vertical-align: top; }
    .col-logo { width: 1.25in; }
    .col-logo img { width: 1.1in; }

    .institucion {
        font-weight: bold;
        font-size: 13pt;
        padding-top: 0.12in;
        padding-bottom: 3px;
        border-bottom: 1px solid #000;
    }
    .hospital {
        font-size: 9pt;
        padding-top: 5px;
    }
    .servicio {
        text-align: center;
        font-weight: bold;
        font-size: 11.5pt;
        padding-top: 4px;
    }
    .vale {
        text-align: center;
        font-weight: bold;
        font-size: 11.5pt;
        padding-top: 0.12in;
    }

    /* Tabla del vale */
    .contenedor-vale {
        margin: 0.15in 0 0 0.7in;
    }
    .vale-tabla td {
        border: 1px solid #000;
        vertical-align: top;
        height: 0.52in;
        padding: 5px 7px;
        font-family: "Times New Roman", Times, serif;
    }
    .etiqueta {
        font-weight: bold;
        font-size: 10.5pt;
    }
    .texto-fijo {
        font-size: 10pt;
        padding-top: 1px;
    }

    /* Para imprimir datos de la base de datos dentro de las celdas */
    .dato {
        font-family: Helvetica, Arial, sans-serif;
        font-size: 10pt;
        padding-top: 4px;
    }
</style>
</head>
<body>


    <table class="encabezado">
        <tr>
            <td class="col-logo">
                <img src="{{ url('img/Isotipo.png') }}" alt="" width="50" height="50">
            </td>
            <td>
                <div class="institucion">Instituto Guatemalteco de Seguridad Social</div>
                <div class="hospital">Hospital General IGSS Quetzaltenango.</div>
                <div class="servicio">SERVICIO DE NUTRICIÓN Y DIETÉTICA</div>
                <div class="vale">VALE INTERNO DE REFACCIONES/ALIMENTACIÓN</div>
            </td>
        </tr>
    </table>


    <div class="contenedor-vale">
        <table class="vale-tabla">
            <tr>
                <td style="width: 50%;">
                    <div class="etiqueta">SERVICIO O ÁREA QUE ENTREGA</div>
                    <div class="texto-fijo">Servicio de Nutrición y Dietética</div>
                </td>
                <td colspan="2">
                    <div class="etiqueta">FECHA</div>
                    <div class="dato"> {{ \Carbon\Carbon::parse($diet_request->created_at)->format('d-m-Y')  }} </div> 
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <div class="etiqueta">JUSTIFICACIÓN/ ACTIVIDAD</div>
                    <div class="dato"> </div> 
                </td>
                <td style="width: 26%;">
                    <div class="etiqueta">CANTIDAD</div>
                    <div class="dato"> {{ $diet_request->total_diets }} </div> 
                </td>
            </tr>
            <tr>
                <td>
                    <div class="etiqueta">NOMBRE DE QUIEN ENTREGA</div>
                    <div class="dato"></div> 
                </td>
                <td style="width: 24%;">
                    <div class="etiqueta">IBM</div>
                    <div class="dato"></div> 
                </td>
                <td>
                    <div class="etiqueta">FIRMA Y SELLO</div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="etiqueta">NOMBRE DE QUIEN RECIBE</div>
                    <div class="dato"></div> 
                </td>
                <td>
                    <div class="etiqueta">IBM</div>
                    <div class="dato"></div> 
                </td>
                <td>
                    <div class="etiqueta">FIRMA Y SELLO</div>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <div class="etiqueta">OBSERVACIONES</div>
                    <div class="dato"> </div> 
                </td>
            </tr>
        </table>
    </div>

</body>
</html>
