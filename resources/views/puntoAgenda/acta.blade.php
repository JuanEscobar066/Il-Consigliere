<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Acta de Consejo</title>
</head>

<body>
  <div class="row">
    <div class="col-md-6 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <div id="acta" class="acta">
            <div>
              <p style="margin-top:0pt; margin-bottom:0pt; text-align:right; font-size:9pt;"><span style="font-family:'Times New Roman';">&nbsp;</span></p>
              <p style="margin-top:0pt; margin-bottom:0pt; text-align:right; font-size:9pt;"><span style="font-family:'Times New Roman';">&nbsp;</span></p>
              <p style="margin-top:0pt; margin-bottom:0pt; text-align:right; font-size:9pt;"><span style="font-family:'Times New Roman';">Carrera Ingeniería en Computación-SJ</span></p>
              <p style="margin-top:0pt; margin-bottom:0pt; text-align:right; font-size:9pt;"><span style="font-family:'Times New Roman';">Acta ICSJ-{{$sesion->fecha}}-Sesión&nbsp;</span><span style="font-family:'Times New Roman'; color:#ff0000;">{{$sesion->tipo_sesion}}</span></p>
              <p style="margin-top:0pt; margin-bottom:0pt; text-align:right; font-size:9pt;"><span style="font-family:'Times New Roman';">Teléfono: 2550-9300</span></p>
              <p style="margin-top:0pt; margin-bottom:0pt; text-align:right; font-size:9pt;"><span style="font-family:'Times New Roman';">&nbsp;</span></p>
            </div>
            <p style="margin-top:0pt; margin-bottom:0pt; text-align:center; font-size:14pt;"><strong><span style="font-family:'Times New Roman';">ACTA ICSJ-{{$sesion->fecha}}</span></strong></p>
            <p style="margin-top:0pt; margin-bottom:0pt; text-align:center; font-size:14pt;"><strong><span style="font-family:'Times New Roman';">SESIÓN&nbsp;</span></strong><strong><span style="font-family:'Times New Roman'; color:#ff0000;">ORDINARIA</span></strong></p>
            <p style="margin-top:0pt; margin-bottom:0pt; font-size:12pt;"><span style="font-family:'Times New Roman';">&nbsp;</span></p>
            <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; font-size:12pt;"><span style="font-family:'Times New Roman';">Sesión&nbsp;</span><span style="font-family:'Times New Roman'; color:#ff0000;">{{$sesion->tipo_sesion}}</span><span style="font-family:'Times New Roman';">&nbsp;celebrada el {{$sesion->fecha}} a las {{$sesion->hora}}&nbsp;</span><span style="font-family:'Times New Roman';">en {{$sesion->lugar}}&nbsp;</span><span style="font-family:'Times New Roman';">del&nbsp;</span><span style="font-family:'Times New Roman'; color:#ff0000;">Centro Académico de San José</span><span style="font-family:'Times New Roman';">. Carrera Ingeniería en Computación,&nbsp;</span><span style="font-family:'Times New Roman'; color:#ff0000;">Centro Académico de San José</span><span style="font-family:'Times New Roman';">.</span></p>
            <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; font-size:12pt;"><span style="font-family:'Times New Roman';">&nbsp;</span></p>
            <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; font-size:12pt;"><strong><span style="font-family:'Times New Roman';">Preside la Sesión</span></strong></p>
            <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; font-size:12pt;"><strong><span style="font-family:'Times New Roman';">&nbsp;</span></strong></p>
            <table style="margin-left:69.2pt; border-collapse:collapse;" cellspacing="0" cellpadding="0">
              <tbody>
              @foreach($presidentes as $p)
                <tr>
                  <td style="width:174.55pt; padding-right:5.4pt; padding-left:5.4pt; vertical-align:top;">
                    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; font-size:12pt;"><span style="font-family:'Times New Roman';">{{$p}}</span></p>
                  </td>
                </tr>
              @endforeach
              </tbody>
            </table>
            <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; font-size:12pt;"><span style="font-family:'Times New Roman';">&nbsp;</span></p>
            <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; font-size:12pt;"><strong><span style="font-family:'Times New Roman';">Representación docente presente</span></strong></p>
            <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; font-size:8pt;"><strong><span style="font-family:'Times New Roman';">&nbsp;</span></strong></p>
            <table style="margin-left:69.2pt; border-collapse:collapse;" cellspacing="0" cellpadding="0">
              <tbody>
                <tr>
                  <td style="width:223.1pt; padding-right:5.4pt; padding-left:5.4pt; vertical-align:top;">
                    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; font-size:12pt;"><span style="font-family:'Times New Roman';"></span></p>
                  </td>
                </tr>
                @foreach($miembrosPresentes as $m)
                <tr style="height:15.6pt;">
                  <td style="width:223.1pt; padding-right:5.4pt; padding-left:5.4pt; vertical-align:top;">
                    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; font-size:12pt;"><span style="font-family:'Times New Roman';">{{$m}}</span></p>
                  </td>
                </tr>                
                @endforeach
              </tbody>
            </table>
            <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; font-size:12pt;"><strong><span style="font-family:'Times New Roman';">&nbsp;</span></strong></p>
            <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; font-size:12pt;"><strong><span style="font-family:'Times New Roman';">Representación docente ausente justificado</span></strong></p>
            <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; font-size:12pt;"><strong><span style="font-family:'Times New Roman';">&nbsp;</span></strong></p>
            <table style="margin-left:69.2pt; border-collapse:collapse;" cellspacing="0" cellpadding="0">
              <tbody>
                @foreach($miembrosAusentes as $m)
                <tr>
                  <td style="width:223.1pt; padding-right:5.4pt; padding-left:5.4pt; vertical-align:top;">
                    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; font-size:12pt;"><span style="font-family:'Times New Roman';">{{$m}}</span></p>
                  </td>
                </tr>
                @endforeach                
              </tbody>
            </table>
            <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; font-size:8pt;"><strong><span style="font-family:'Times New Roman';">&nbsp;</span></strong></p>
            <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; font-size:12pt;"><strong><span style="font-family:'Times New Roman';">&nbsp;</span></strong></p>
            <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; font-size:12pt;"><strong><span style="font-family:'Times New Roman';">Representación estudiantil presente</span></strong></p>
            <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; font-size:8pt;"><strong><span style="font-family:'Times New Roman';">&nbsp;</span></strong></p>
            <table style="margin-left:69.2pt; border-collapse:collapse;" cellspacing="0" cellpadding="0">
              <tbody>
              @foreach($estudiantesPresentes as $e)
                <tr>
                  <td style="width:223.1pt; padding-right:5.4pt; padding-left:5.4pt; vertical-align:top;">
                    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; font-size:12pt;"><span style="font-family:'Times New Roman';">{{$e}}</span></p>
                  </td>
                </tr>                
              @endforeach    
              </tbody>
            </table>
            <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; font-size:12pt;"><span style="font-family:'Times New Roman';">&nbsp;</span></p>
            <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; font-size:12pt;"><strong><span style="font-family:'Times New Roman';">Secretaría de Actas</span></strong></p>
            <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; font-size:8pt;"><span style="font-family:'Times New Roman';">&nbsp;</span></p>
            <table style="margin-left:69.2pt; border-collapse:collapse;" cellspacing="0" cellpadding="0">
              <tbody>
              @foreach($secretarios as $s)
                <tr>
                  <td style="width:125.55pt; padding-right:5.4pt; padding-left:5.4pt; vertical-align:top;">
                    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; font-size:12pt;"><span style="font-family:'Times New Roman';">{{$s}}</span></p>
                  </td>
                  <td style="width:95.5pt; border-bottom-style:solid; border-bottom-width:0.75pt; padding-right:5.4pt; padding-left:5.4pt; vertical-align:top;">
                    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; font-size:12pt;"><span style="font-family:'Times New Roman';">&nbsp;</span></p>
                  </td>
                </tr>
                <tr>
                  <td style="width:125.55pt; padding-right:5.4pt; padding-left:5.4pt; vertical-align:top;">
                    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; font-size:12pt;"><span style="font-family:'Times New Roman';">&nbsp;</span></p>
                  </td>
                  <td style="width:95.5pt; border-top-style:solid; border-top-width:0.75pt; padding-right:5.4pt; padding-left:5.4pt; vertical-align:top;">
                    <p style="margin-top:0pt; margin-bottom:0pt; text-align:center; font-size:10pt;"><strong><em><span style="font-family:'Times New Roman';">Firma</span></em></strong></p>
                  </td>
                </tr>
              @endforeach    
              </tbody>
            </table>
            <p style="margin-top:0pt; margin-bottom:0pt; font-size:12pt;"><span style="font-family:'Times New Roman';">&nbsp;</span></p>
            <p style="margin-top:0pt; margin-bottom:10pt; line-height:115%; font-size:12pt;">
              <br style="page-break-before:always; clear:both;">
            </p>
            <p style="margin-top:0pt; margin-bottom:0pt; text-align:center; font-size:16pt;"><strong><span style="font-family:'Times New Roman';">AGENDA</span></strong></p>
            <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; font-size:12pt; background-color:#ffffff;"><span style="font-family:'Times New Roman';">&nbsp;</span></p>
            <ol style="margin:0pt; padding-left:0pt;" type="1">
              <li style="margin-left:32pt; text-align:justify; padding-left:4pt; font-family:'Times New Roman'; font-size:12pt;">Solicitud de apoyo para xxx</li>
            </ol>
            <p style="margin-top:0pt; margin-left:36pt; margin-bottom:0pt; text-align:justify; font-size:12pt;"><span style="font-family:'Times New Roman';">&nbsp;</span></p>
            <ol style="margin:0pt; padding-left:0pt;" type="1" start="2">
              <li style="margin-left:32pt; text-align:justify; padding-left:4pt; font-family:'Times New Roman'; font-size:12pt;">Solicitud de apoyo al Ing. xxx</li>
            </ol>
            <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; font-size:12pt;"><span style="font-family:'Times New Roman';">&nbsp;</span></p>
            <ol style="margin:0pt; padding-left:0pt;" type="1" start="3">
              <li style="margin-left:32pt; text-align:justify; padding-left:4pt; font-family:'Times New Roman'; font-size:12pt;">Solicitud de apoyo al Ing. xxx</li>
            </ol>
            <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; font-size:12pt;"><span style="font-family:'Times New Roman';">&nbsp;</span></p>
            <ol style="margin:0pt; padding-left:0pt;" type="1" start="4">
              <li style="margin-left:32pt; text-align:justify; padding-left:4pt; font-family:'Times New Roman'; font-size:12pt;">Solicitud de apoyo al Ing. xx</li>
            </ol>
            <p style="margin-top:0pt; margin-left:36pt; margin-bottom:0pt; text-align:justify; font-size:12pt;"><span style="font-family:'Times New Roman';">&nbsp;</span></p>
            <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; font-size:12pt;"><strong><span style="font-family:'Times New Roman';">Comprobación de Quorum x personas presentes de las xx personas convocadas.</span></strong></p>
            <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; font-size:12pt;"><strong><span style="font-family:'Times New Roman';">&nbsp;</span></strong></p>
            <p style="margin-top:0pt; margin-bottom:0pt; font-size:12pt;"><strong><span style="font-family:'Times New Roman';">Hora de inicio: xx:xx&nbsp;</span></strong><strong><span style="font-family:'Times New Roman'; color:#ff0000;">a</span></strong><strong><span style="font-family:'Times New Roman';">.m.</span></strong></p>
            <p style="margin-top:0pt; margin-bottom:0pt; font-size:12pt;"><strong><span style="font-family:'Times New Roman';">______________________________________________________________________</span></strong></p>
            <p style="margin-top:0pt; margin-bottom:10pt; line-height:115%; font-size:12pt;">
              <br style="page-break-before:always; clear:both;">
            </p>
            <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; font-size:12pt;"><strong><span style="font-family:'Times New Roman';">Artículo 1.</span></strong><span style="font-family:'Times New Roman';">&nbsp;</span><span style="font-family:'Times New Roman';">Solicitud de apoyo xxx</span></p>
            <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; font-size:12pt;"><span style="font-family:'Times New Roman';">&nbsp;</span></p>
            <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; font-size:12pt;"><span style="font-family:'Times New Roman';">Considerando que:</span></p>
            <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; font-size:12pt;"><span style="font-family:'Times New Roman';">&nbsp;</span></p>
            <ul style="margin:0pt; padding-left:0pt;" type="disc">
              <li style="margin-left:46.52pt; text-align:justify; line-height:115%; padding-left:7.48pt; font-family:serif; font-size:12pt;"><span style="font-family:'Times New Roman';">Mediante oficio xxx</span></li>
              <li style="margin-left:46.52pt; text-align:justify; line-height:115%; padding-left:7.48pt; font-family:serif; font-size:12pt;"><span style="font-family:'Times New Roman';">xxx</span></li>
              <li style="margin-left:46.52pt; margin-bottom:10pt; text-align:justify; line-height:115%; padding-left:7.48pt; font-family:serif; font-size:12pt;"><span style="font-family:'Times New Roman';">Debido al xxx</span></li>
            </ul>
            <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; font-size:12pt; background-color:#ffffff;"><span style="font-family:'Times New Roman';">&nbsp;</span></p>
            <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; font-size:12pt; background-color:#ffffff;"><span style="font-family:'Times New Roman';">Se somete a votación, y se obtiene como resultado&nbsp;</span><strong><span style="font-family:'Times New Roman'; color:#ff0000;">ÚNANIME</span></strong><span style="font-family:'Times New Roman';">&nbsp;lo siguiente:</span></p>
            <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; font-size:12pt; background-color:#ffffff;"><span style="font-family:'Times New Roman';">&nbsp;</span></p>
            <table style="margin-left:111.75pt; border-collapse:collapse;" cellspacing="0" cellpadding="0">
              <tbody>
                <tr>
                  <td style="width:81.3pt; padding-right:5.4pt; padding-left:5.4pt; vertical-align:top;">
                    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; font-size:12pt;"><span style="font-family:'Times New Roman';">Votos a favor:</span></p>
                  </td>
                  <td style="width:31.75pt; padding-right:5.4pt; padding-left:5.4pt; vertical-align:top;">
                    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; font-size:12pt;"><span style="font-family:'Times New Roman'; color:#ff0000;">0</span></p>
                  </td>
                </tr>
                <tr>
                  <td style="width:81.3pt; padding-right:5.4pt; padding-left:5.4pt; vertical-align:top;">
                    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; font-size:12pt;"><span style="font-family:'Times New Roman';">Votos en contra:</span></p>
                  </td>
                  <td style="width:31.75pt; padding-right:5.4pt; padding-left:5.4pt; vertical-align:top;">
                    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; font-size:12pt;"><span style="font-family:'Times New Roman'; color:#ff0000;">0</span></p>
                  </td>
                </tr>
                <tr>
                  <td style="width:81.3pt; padding-right:5.4pt; padding-left:5.4pt; vertical-align:top;">
                    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; font-size:12pt;"><span style="font-family:'Times New Roman';">Abstención:</span></p>
                  </td>
                  <td style="width:31.75pt; padding-right:5.4pt; padding-left:5.4pt; vertical-align:top;">
                    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; font-size:12pt;"><span style="font-family:'Times New Roman'; color:#ff0000;">0</span></p>
                  </td>
                </tr>
              </tbody>
            </table>
            <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; font-size:12pt; background-color:#ffffff;"><span style="font-family:'Times New Roman';">&nbsp;</span></p>
            <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; font-size:12pt; background-color:#ffffff;"><strong><span style="font-family:'Times New Roman';">Por lo tanto;</span></strong></p>
            <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; font-size:12pt; background-color:#ffffff;"><strong><span style="font-family:'Times New Roman';">Se acuerda:</span></strong><span style="font-family:'Times New Roman';">&nbsp;</span><span style="font-family:'Times New Roman';">Brindar el apoyo xxxxx.</span></p>
            <p style="margin-top:0pt; margin-bottom:0pt; text-align:right; font-size:12pt; background-color:#ffffff;"><strong><span style="font-family:'Times New Roman';">ACUERDO FIRME</span></strong></p>
            <p style="margin-top:0pt; margin-bottom:10pt; line-height:115%; font-size:12pt;">
              <br style="page-break-before:always; clear:both;">
            </p>
            <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; font-size:12pt;"><strong><span style="font-family:'Times New Roman';">Artículo 2.</span></strong><span style="font-family:'Times New Roman';">&nbsp;</span><span style="font-family:'Times New Roman';">Solicitud de apoyo al Ing. xxxx</span></p>
            <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; font-size:12pt;"><span style="font-family:'Times New Roman';">&nbsp;</span></p>
            <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; font-size:12pt; background-color:#ffffff;"><span style="font-family:'Times New Roman';">Se somete a votación, y se obtiene como resultado lo siguiente:</span></p>
            <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; font-size:12pt; background-color:#ffffff;"><span style="font-family:'Times New Roman';">&nbsp;</span></p>
            <table style="margin-left:111.75pt; border-collapse:collapse;" cellspacing="0" cellpadding="0">
              <tbody>
                <tr>
                  <td style="width:81.3pt; padding-right:5.4pt; padding-left:5.4pt; vertical-align:top;">
                    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; font-size:12pt;"><span style="font-family:'Times New Roman';">Votos a favor:</span></p>
                  </td>
                  <td style="width:31.75pt; padding-right:5.4pt; padding-left:5.4pt; vertical-align:top;">
                    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; font-size:12pt;"><span style="font-family:'Times New Roman'; color:#ff0000;">0</span></p>
                  </td>
                </tr>
                <tr>
                  <td style="width:81.3pt; padding-right:5.4pt; padding-left:5.4pt; vertical-align:top;">
                    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; font-size:12pt;"><span style="font-family:'Times New Roman';">Votos en contra:</span></p>
                  </td>
                  <td style="width:31.75pt; padding-right:5.4pt; padding-left:5.4pt; vertical-align:top;">
                    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; font-size:12pt;"><span style="font-family:'Times New Roman'; color:#ff0000;">0</span></p>
                  </td>
                </tr>
                <tr style="height:4pt;">
                  <td style="width:81.3pt; padding-right:5.4pt; padding-left:5.4pt; vertical-align:top;">
                    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; font-size:12pt;"><span style="font-family:'Times New Roman';">Abstención:</span></p>
                  </td>
                  <td style="width:31.75pt; padding-right:5.4pt; padding-left:5.4pt; vertical-align:top;">
                    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; font-size:12pt;"><span style="font-family:'Times New Roman'; color:#ff0000;">0</span></p>
                  </td>
                </tr>
              </tbody>
            </table>
            <p style="margin-top:0pt; margin-bottom:0pt; font-size:11pt;"><span style="font-family:'Times New Roman';">&nbsp;</span></p>
            <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; font-size:12pt; background-color:#ffffff;"><strong><span style="font-family:'Times New Roman';">Por lo tanto;</span></strong></p>
            <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; font-size:12pt;"><strong><span style="font-family:'Times New Roman';">Se acuerda:</span></strong><span style="font-family:'Times New Roman';">&nbsp;</span><span style="font-family:'Times New Roman';">Brindar el apoyo al Ing. xxx.</span></p>
            <p style="margin-top:0pt; margin-bottom:0pt; text-align:right; font-size:12pt; background-color:#ffffff;"><strong><span style="font-family:'Times New Roman';">ACUERDO FIRME</span></strong></p>
            <p style="margin-top:0pt; margin-bottom:0pt; text-align:right; font-size:12pt; background-color:#ffffff;"><strong><span style="font-family:'Times New Roman';">&nbsp;</span></strong></p>
            <p style="margin-top:0pt; margin-bottom:0pt; text-align:right; font-size:12pt; background-color:#ffffff;"><strong><span style="font-family:'Times New Roman';">&nbsp;</span></strong></p>
            <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; font-size:12pt;"><strong><span style="font-family:'Times New Roman';">Artículo 3</span></strong><span style="font-family:'Times New Roman';">.&nbsp;</span><span style="font-family:'Times New Roman';">Solicitud de apoyo al Ing. xxxx</span></p>
            <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; font-size:12pt;"><span style="font-family:'Times New Roman';">&nbsp;</span></p>
            <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; font-size:12pt; background-color:#ffffff;"><span style="font-family:'Times New Roman';">Se somete a votación, y se obtiene como resultado lo siguiente:</span></p>
            <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; font-size:12pt; background-color:#ffffff;"><span style="font-family:'Times New Roman';">&nbsp;</span></p>
            <table style="margin-left:111.75pt; border-collapse:collapse;" cellspacing="0" cellpadding="0">
              <tbody>
                <tr>
                  <td style="width:81.3pt; padding-right:5.4pt; padding-left:5.4pt; vertical-align:top;">
                    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; font-size:12pt;"><span style="font-family:'Times New Roman';">Votos a favor:</span></p>
                  </td>
                  <td style="width:31.75pt; padding-right:5.4pt; padding-left:5.4pt; vertical-align:top;">
                    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; font-size:12pt;"><span style="font-family:'Times New Roman'; color:#ff0000;">8</span></p>
                  </td>
                </tr>
                <tr>
                  <td style="width:81.3pt; padding-right:5.4pt; padding-left:5.4pt; vertical-align:top;">
                    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; font-size:12pt;"><span style="font-family:'Times New Roman';">Votos en contra:</span></p>
                  </td>
                  <td style="width:31.75pt; padding-right:5.4pt; padding-left:5.4pt; vertical-align:top;">
                    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; font-size:12pt;"><span style="font-family:'Times New Roman'; color:#ff0000;">0</span></p>
                  </td>
                </tr>
                <tr>
                  <td style="width:81.3pt; padding-right:5.4pt; padding-left:5.4pt; vertical-align:top;">
                    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; font-size:12pt;"><span style="font-family:'Times New Roman';">Abstención:</span></p>
                  </td>
                  <td style="width:31.75pt; padding-right:5.4pt; padding-left:5.4pt; vertical-align:top;">
                    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; font-size:12pt;"><span style="font-family:'Times New Roman'; color:#ff0000;">0</span></p>
                  </td>
                </tr>
              </tbody>
            </table>
            <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; font-size:12pt;"><span style="font-family:'Times New Roman';">&nbsp;</span></p>
            <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; font-size:12pt; background-color:#ffffff;"><strong><span style="font-family:'Times New Roman';">Por lo tanto;</span></strong></p>
            <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; font-size:12pt;"><strong><span style="font-family:'Times New Roman';">Se acuerda:</span></strong><strong><span style="font-family:'Times New Roman';">&nbsp;</span></strong><span style="font-family:'Times New Roman';">Brindar el apoyo al Ing. xxxx.</span></p>
            <p style="margin-top:0pt; margin-bottom:0pt; text-align:right; font-size:12pt; background-color:#ffffff;"><strong><span style="font-family:'Times New Roman';">ACUERDO FIRME</span></strong></p>
            <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; font-size:11pt;"><span style="font-family:'Times New Roman';">&nbsp;</span></p>
            <p style="margin-top:0pt; margin-bottom:10pt; line-height:115%; font-size:12pt;">
              <br style="page-break-before:always; clear:both;">
            </p>
            <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; font-size:12pt;"><strong><span style="font-family:'Times New Roman';">Artículo 4.</span></strong><span style="font-family:'Times New Roman';">&nbsp;</span><span style="font-family:'Times New Roman';">Solicitud de apoyo al Ing. xxxxx</span></p>
            <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; font-size:12pt;"><span style="font-family:'Times New Roman';">&nbsp;</span></p>
            <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; font-size:12pt; background-color:#ffffff;"><span style="font-family:'Times New Roman';">Se somete a votación, y se obtiene como resultado lo siguiente:</span></p>
            <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; font-size:12pt; background-color:#ffffff;"><span style="font-family:'Times New Roman';">&nbsp;</span></p>
            <table style="margin-left:111.75pt; border-collapse:collapse;" cellspacing="0" cellpadding="0">
              <tbody>
                <tr>
                  <td style="width:81.3pt; padding-right:5.4pt; padding-left:5.4pt; vertical-align:top;">
                    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; font-size:12pt;"><span style="font-family:'Times New Roman';">Votos a favor:</span></p>
                  </td>
                  <td style="width:31.75pt; padding-right:5.4pt; padding-left:5.4pt; vertical-align:top;">
                    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; font-size:12pt;"><span style="font-family:'Times New Roman'; color:#ff0000;">8</span></p>
                  </td>
                </tr>
                <tr>
                  <td style="width:81.3pt; padding-right:5.4pt; padding-left:5.4pt; vertical-align:top;">
                    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; font-size:12pt;"><span style="font-family:'Times New Roman';">Votos en contra:</span></p>
                  </td>
                  <td style="width:31.75pt; padding-right:5.4pt; padding-left:5.4pt; vertical-align:top;">
                    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; font-size:12pt;"><span style="font-family:'Times New Roman'; color:#ff0000;">0</span></p>
                  </td>
                </tr>
                <tr>
                  <td style="width:81.3pt; padding-right:5.4pt; padding-left:5.4pt; vertical-align:top;">
                    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; font-size:12pt;"><span style="font-family:'Times New Roman';">Abstención:</span></p>
                  </td>
                  <td style="width:31.75pt; padding-right:5.4pt; padding-left:5.4pt; vertical-align:top;">
                    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; font-size:12pt;"><span style="font-family:'Times New Roman'; color:#ff0000;">0</span></p>
                  </td>
                </tr>
              </tbody>
            </table>
            <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; font-size:12pt;"><span style="font-family:'Times New Roman';">&nbsp;</span></p>
            <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; font-size:12pt; background-color:#ffffff;"><strong><span style="font-family:'Times New Roman';">Por lo tanto;</span></strong></p>
            <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; font-size:12pt;"><strong><span style="font-family:'Times New Roman';">Se acuerda:&nbsp;</span></strong><span style="font-family:'Times New Roman';">Brindar el apoyo al Ing. xxxx</span></p>
            <p style="margin-top:0pt; margin-bottom:0pt; text-align:right; font-size:12pt;"><strong><span style="font-family:'Times New Roman';">ACUERDO FIRME</span></strong></p>
            <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; font-size:12pt;"><span style="font-family:'Times New Roman';">&nbsp;</span></p>
            <p style="margin-top:0pt; margin-left:18pt; margin-bottom:0pt; text-align:justify; font-size:12pt;"><span style="font-family:'Times New Roman';">&nbsp;</span></p>
            <p style="margin-top:0pt; margin-left:18pt; margin-bottom:0pt; text-align:justify; font-size:12pt;"><span style="font-family:'Times New Roman';">&nbsp;</span></p>
            <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; font-size:12pt;"><span style="font-family:'Times New Roman';">Finaliza la sesión a las xx:xx</span><span style="font-family:'Times New Roman'; color:#ff0000;">&nbsp;a</span><span style="font-family:'Times New Roman';">.m.</span></p>
            <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; font-size:12pt;"><span style="font-family:'Times New Roman';">&nbsp;</span></p>
            <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; font-size:12pt;"><span style="font-family:'Times New Roman';">&nbsp;</span></p>
            <p style="margin-top:0pt; margin-left:18pt; margin-bottom:0pt; text-align:justify; font-size:12pt;"><strong><em><span style="font-family:'Times New Roman';">&nbsp;</span></em></strong></p>
            <p style="margin-top:0pt; margin-left:18pt; margin-bottom:0pt; font-size:12pt;"><span style="font-family:'Times New Roman';">&nbsp;</span></p>
            <p style="margin-top:0pt; margin-left:18pt; margin-bottom:0pt; font-size:12pt;"><span style="font-family:'Times New Roman';">&nbsp;</span></p>
            <p style="margin-top:0pt; margin-left:18pt; margin-bottom:0pt; font-size:12pt;"><span style="font-family:'Times New Roman';">&nbsp;</span></p>
            <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; font-size:12pt;"><span style="font-family:'Times New Roman';">&nbsp;</span></p>
            <p style="margin-top:0pt; margin-bottom:0pt; text-align:center; font-size:12pt;"><span style="font-family:'Times New Roman';">____________________________________</span></p>
            @foreach($presidentes as $p)
            <p style="margin-top:0pt; margin-bottom:0pt; text-align:center; font-size:12pt;"><span style="font-family:'Times New Roman';">Máster {{$p}}</span></p>
            <p style="margin-top:0pt; margin-bottom:0pt; text-align:center; font-size:12pt;"><span style="font-family:'Times New Roman';">Presidente del Consejo</span></p>
            <p style="margin-top:0pt; margin-bottom:0pt; text-align:center; font-size:12pt;"><span style="font-family:'Times New Roman';">Carrera Ingeniería en Computación</span></p>
            <p style="margin-top:0pt; margin-bottom:0pt; text-align:center; font-size:12pt;"><span style="font-family:'Times New Roman';">Centro Académico de San José</span></p>
            @endforeach
            <div>
              <table style="width:100%; border-collapse:collapse;" cellspacing="0" cellpadding="0">
                <tbody>
                  <tr>
                    <td style="width:35.1pt; border-top:2.25pt solid #808080; border-right:2.25pt solid #808080; padding-right:4.28pt; padding-left:5.4pt; vertical-align:top;">
                      <p style="margin-top:0pt; margin-bottom:0pt; text-align:right; font-size:16pt;"><strong><span style="font-family:'Times New Roman'; color:#4f81bd;">1</span></strong></p>
                    </td>
                    <td style="width:386.1pt; border-top:2.25pt solid #808080; border-left:2.25pt solid #808080; padding-right:5.4pt; padding-left:4.28pt; vertical-align:top;">
                      <p style="margin-top:0pt; margin-bottom:0pt; font-size:10pt;"><span style="font-family:'Times New Roman';">&nbsp;</span></p>
                    </td>
                  </tr>
                </tbody>
              </table>
              <p style="margin-top:0pt; margin-bottom:0pt; font-size:10pt;"><span style="font-family:'Times New Roman';">&nbsp;</span></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>