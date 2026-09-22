<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>SPS-1071 - Solicitud de refrigerio para donadores</title>
<style>
  /* Media carta horizontal: 8.5in x 5.5in */
  @page {
    size: 8.5in 5.5in;
    margin: 0;
  }

  * { box-sizing: border-box; }

  html, body {
    margin: 0;
    padding: 0;
    background: #d9d9d9;
    font-family: Arial, Helvetica, sans-serif;
    color: #000;
  }

  .hoja {
    width: 8.5in;
    height: 5.5in;
    margin: 0.3in auto;
    background: #fff;
    position: relative;
    padding: 0.35in 0.55in 0.3in 0.55in;
    box-shadow: 0 0 6px rgba(0,0,0,.3);
  }

  /* Encabezado */
  .codigo {
    position: absolute;
    top: 0.25in;
    right: 0.55in;
    font-family: "Times New Roman", Times, serif;
    font-weight: bold;
    font-size: 12pt;
  }

  .encabezado {
    display: flex;
    align-items: center;
    height: 0.9in;
  }

  .logo {
    width: 0.85in;
    height: 0.85in;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .logo img {
    max-width: 100%;
    max-height: 100%;
  }

  .institucion {
    flex: 1;
    text-align: center;
    padding-right: 0.85in; /* compensa el ancho del logo para centrar el texto */
  }

  .institucion .nombre {
    font-weight: bold;
    font-size: 12.5pt;
    margin: 0;
  }

  .institucion .unidad {
    font-weight: bold;
    font-size: 9.5pt;
    margin: 2px 0 0 0;
  }

  /* Título */
  .titulo {
    text-align: center;
    font-weight: bold;
    font-size: 12.5pt;
    line-height: 1.25;
    margin: 0.15in 0 0.25in 0;
  }

  /* Campos */
  .campo {
    display: flex;
    align-items: flex-end;
    font-size: 11pt;
    margin-bottom: 0.2in;
  }

  .campo .linea {
    border-bottom: 1px solid #000;
    height: 1.1em;
    margin: 0 4px;
  }

  .fecha {
    justify-content: flex-end;
  }

  .fecha .linea { width: 2.4in; margin-right: 0; }

  .cantidad .linea { width: 1.6in; }

  .flex-linea .linea { flex: 1; margin-right: 0; }

  /* Firma */
  .atentamente {
    font-size: 11pt;
    margin: 0.25in 0 0.3in 0;
  }

  .firma {
    margin-left: 2.25in;
    font-size: 11pt;
  }

  .firma .fila {
    display: flex;
    align-items: flex-end;
  }

  .firma .linea {
    border-bottom: 1px solid #000;
    width: 3.1in;
    height: 1.1em;
    margin-left: 4px;
  }

  .firma .leyenda {
    margin: 4px 0 0 1.05in;
  }

  @media print {
    html, body { background: #fff; }
    .hoja {
      margin: 0;
      box-shadow: none;
    }
  }
</style>
</head>
<body>

<div class="hoja">
  <div class="codigo">SPS-1071</div>

  <div class="encabezado">
    <div class="logo">
      <!-- Coloca aquí el archivo del logo del IGSS -->
      <img src="logo-igss.png" alt="">
    </div>
    <div class="institucion">
      <p class="nombre">INSTITUTO GUATEMALTECO DE SEGURIDAD SOCIAL</p>
      <p class="unidad">Banco de Sangre</p>
    </div>
  </div>

  <div class="titulo">
    SOLICITUD DE REFRIGERIO PARA<br>
    DONADORES DEL BANCO DE SANGRE
  </div>

  <div class="campo fecha">
    Fecha:<span class="linea"></span>
  </div>

  <div class="campo cantidad">
    Por este medio solicito la cantidad de:<span class="linea"></span>refacciones para donadores de sangre.
  </div>

  <div class="campo flex-linea">
    Nombre de la persona que solicita:<span class="linea"></span>
  </div>

  <div class="campo flex-linea">
    Cargo:<span class="linea"></span>
  </div>

  <div class="atentamente">Atentamente,</div>

  <div class="firma">
    <div class="fila">
      Firma y sello<span class="linea"></span>
    </div>
    <div class="leyenda">Personal responsable del servicio solicitante</div>
  </div>
</div>

</body>
</html>
