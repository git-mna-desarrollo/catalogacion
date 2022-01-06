<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Historial Academico</title>
    <style>
        @page {
            margin: 0cm 0cm;
            font-family: Arial;
        }

        body {
            margin: 1cm 1cm 2cm;
            font-size: 9pt;
            font-family: Arial, Helvetica, sans-serif;
        }

        .bordes {
            /* border: #24486C 1px solid; */
            border: 1px solid;
            border-collapse: collapse;
        }

        /*estilos para tablas de datos*/
        table.datos {
            font-size: 8pt;
            table-layout: fixed;
            /*line-height:14px;*/
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
        }

        .datos th {
            /* height: 25px; */
            background-color: #616362;
            color: #fff;
        }

        .datos td {
            /* height: 20px; */
            padding-left: 6px;
            padding-top: 3px;
            padding-bottom: 3px;
            /* padding-right: 6px; */
        }

        .datos th,
        .datos td {
            border: 1px solid #000;
            /* padding: 5px; */
            /* text-align: center; */
        }

        table.datos_sb {
            font-size: 8pt;
            /*line-height:14px;*/
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
        }

        .datos_sb th {
            /* height: 25px; */
            background-color: #616362;
            color: #fff;
        }

        .datos_sb td {
            /* height: 20px; */
            padding-left: 0px;
        }

        .datos_sb th,
        .datos_sb td {
            border: 1px solid #fff;
            /* padding: 5px; */
            /* text-align: center; */
        }
        
        .titulos{
            font-weight: bold;
        }

        .contenidos{
            padding-left: 16px;
        }

        /* .datos tr:nth-child(even) {
            background-color: #f2f2f2;
        } */

        /*fin de estilos para tablas de datos*/
    </style>

</head>

<body>
    <header></header>
    <main>
        <div style="height: 1200px; background-color: #ffffff;">
        <table class="datos">
            <tr>
                <td width="20%">
                    <font size="22">
                    BOLIVIA
                    </font>
                </td>
                <td style="text-align: center;">
                    FUNDACION CULTURAL DEL BANCO CENTRAL DE BOLIVIA <br />
                    CENTRO DE CATALOGACION DE PATRIMONIO ARTISTICO <br />
                    MUSEO NACIONAL DE ARTE
                </td>
                <td width="20%">
                    INVENTARIO DE <br />
                    BIENES INMUEBLES
                </td>
            </tr>

        </table>

        <table class="datos">
            <tr>
                <td>
                    <span class="titulos">UBICACION </span><br />
                </td>
                <td colspan="2">
                    <span class="titulos">IDENTIFICACION</span><br />
                </td>
            </tr>
            <tr>
                <td>
                    <span class="titulos">01 LOCALIDAD </span><br />
                    <span class="contenidos">{{ $patrimonio->localidad }}</span>
                </td>
                <td colspan="2">
                    <span class="titulos">08 DESIGNACION / NOMBRE</span><br />
                    <span class="contenidos">{{ $patrimonio->nombre }}</span>
                </td>
            </tr>
    
            <tr>
                <td>
                    <span class="titulos">02 PROVINCIA</span><br />
                    <span class="contenidos">{{ $patrimonio->provincia }}</span>
                </td>
                <td>
                    <span class="titulos">09 ESPECIALIDAD</span><br />
                    <span class="contenidos">{{ $patrimonio->especialidad->nombre }}</span>
                </td>
                <td>
                    <span class="titulos">15 No. INVENTARIO</span><br />
                    <span class="contenidos">{{ $patrimonio->inventario }}</span>
                </td>
            </tr>
    
            <tr>
                <td>
                    <span class="titulos">03 DEPARTAMENTO</span><br />
                    <span class="contenidos">{{ $patrimonio->provincia }}</span>
                </td>
                <td>
                    <span class="titulos">10 ESTILO</span><br />
                    <span class="contenidos">
                        @if ($patrimonio->patrimonio_id != null)
                        {{ $patrimonio->estilo->nombre }}
                        @endif
                    </span>
                </td>
                <td>
                    <span class="titulos">16 CODIGO</span><br />
                    <span class="contenidos">{{ $patrimonio->codigo }}</span>
                </td>
            </tr>
    
            <tr>
                <td>
                    <span class="titulos">04 INMUEBLE</span><br />
                    <span class="contenidos">{{ $patrimonio->inmueble }}</span>
                </td>
                <td>
                    <span class="titulos">11 ESCUELA</span><br />
                    <span class="contenidos">{{ $patrimonio->escuela }}</span>
                </td>
                <td>
                    <span class="titulos">17 No. </span><br />
                    <span class="contenidos">{{ $patrimonio->codigo }}</span>
                </td>
            </tr>
    
            <tr>
                <td>
                    <span class="titulos">05 CALLE/No</span><br />
                    <span class="contenidos">{{ $patrimonio->calle }}</span>
                </td>
                <td>
                    <span class="titulos">12 EPOCA Y/O FECHA</span><br />
                    <span class="contenidos">{{ $patrimonio->epoca }}</span>
                </td>
                <td>
                    <span class="titulos">18 ORIGEN </span><br />
                    <span class="contenidos">{{ $patrimonio->codigo }}</span>
                </td>
            </tr>
    
            <tr>
                <td>
                    <span class="titulos">06 UBICACION EN EL INMUEBLE</span><br />
                    <span class="contenidos">{{ $patrimonio->calle }}</span>
                </td>
                <td>
                    <span class="titulos">13 AUTOR / ATRIBUCION</span><br />
                    <span class="contenidos">{{ $patrimonio->autor }}</span>
                </td>
                <td>
                    <span class="titulos">19 OBTENCION </span><br />
                    <span class="contenidos">{{ $patrimonio->obtencion }}</span>
                </td>
            </tr>
    
            <tr>
                <td>
                    <span class="titulos">07 RESPONSABLE</span><br />
                    <span class="contenidos">{{ $patrimonio->calle }}</span>
                </td>
                <td>
                    <span class="titulos">14 TECNICA Y MATERIAL</span><br />
                    <span class="contenidos">{{ $patrimonio->tecnicamaterial->nombre }}</span>
                </td>
                <td>
                    <span class="titulos">20 FECHA ADQUISICION </span><br />
                    <span class="contenidos">{{ $patrimonio->fecha_adquisicion_texto }}</span>
                </td>
            </tr>
    
        </table>
    
        <table class="datos">
            <tr>
                <td>
                    <table class="datos_sb">
                        <tr>
                            <td style="width: 355px; height: 550px; vertical-align: middle;">
                                @php
                                    $imagen = App\Imagen::where('patrimonio_id', $patrimonio->id)
                                                ->where('estado', 'Ficha')
                                                ->first();
                                @endphp
                                @if ($imagen)
                                    <img style="vertical-align: top;" width="100%" align="center" src="{{ asset("imagenes/$imagen->imagen") }}" /><br />
                                @endif
                            </td>
                        </tr>
                    </table>
                    <hr />
                    <span class="titulos">25 PROTECCION LEGAL</span>
                        @php
                        $estado = App\Estado::where('patrimonio_id', $patrimonio->id)
                        ->first();
                        @endphp
                    <table class="datos_sb">
                        <tr>
                            <td width="150px;">MONUMENTO NACIONAL </td>
                            <td>
                                @if ($estado != null && $estado->monumento_nacional == 'Si')
                                <label class="checkbox checkbox-outline checkbox-outline-2x checkbox-primary">
                                    <input type="checkbox" name="Checkboxes16" checked="checked" />
                                    <span></span>
    
                                </label>
                                @else
                                <label class="checkbox checkbox-outline checkbox-outline-2x checkbox-primary">
                                    <input type="checkbox" name="Checkboxes16" />
                                    <span></span>
    
                                </label>
                                @endif
                            </td>
                            <td style="padding-left: 10px;" width="100px;">INDIVIDUAL</td>
                            <td>
                                @if ($estado!= null && $estado->individual == 'Si')
                                <label class="checkbox checkbox-outline checkbox-outline-2x checkbox-primary">
                                    <input type="checkbox" name="Checkboxes16" checked="checked" />
                                    <span></span>
    
                                </label>
                                @else
                                <label class="checkbox checkbox-outline checkbox-outline-2x checkbox-primary">
                                    <input type="checkbox" name="Checkboxes16" />
                                    <span></span>
    
                                </label>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>RESOLUCION MUNICIPAL </td>
                            <td>
                                @if ($estado != null && $estado->resolucion_municipal == 'Si')
                                <label class="checkbox checkbox-outline checkbox-outline-2x checkbox-primary">
                                    <input type="checkbox" name="Checkboxes16" checked="checked" />
                                    <span></span>
    
                                </label>
                                @else
                                <label class="checkbox checkbox-outline checkbox-outline-2x checkbox-primary">
                                    <input type="checkbox" name="Checkboxes16" />
                                    <span></span>
    
                                </label>
                                @endif
    
                            </td>
                            <td style="padding-left: 10px;" width="100px;">DE CONJUNTO</td>
                            <td>
                                @if ($estado != null && $estado->conjunto == 'Si')
                                <label class="checkbox checkbox-outline checkbox-outline-2x checkbox-primary">
                                    <input type="checkbox" name="Checkboxes16" checked="checked" />
                                    <span></span>
    
                                </label>
                                @else
                                <label class="checkbox checkbox-outline checkbox-outline-2x checkbox-primary">
                                    <input type="checkbox" name="Checkboxes16" />
                                    <span></span>
    
                                </label>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>RESOL. ADM.</td>
                            <td>
                                @if ($estado != null && $estado->resolucion_administrativa == 'Si')
                                <label class="checkbox checkbox-outline checkbox-outline-2x checkbox-primary">
                                    <input type="checkbox" name="Checkboxes16" checked="checked" />
                                    <span></span>
    
                                </label>
                                @else
                                <label class="checkbox checkbox-outline checkbox-outline-2x checkbox-primary">
                                    <input type="checkbox" name="Checkboxes16" />
                                    <span></span>
    
                                </label>
                                @endif
                            </td>
                            <td style="padding-left: 10px;" width="100px;">NINGUNA</td>
                            <td>
                                @if ($estado != null && $estado->ninguna == 'Si')
                                <label class="checkbox checkbox-outline checkbox-outline-2x checkbox-primary">
                                    <input type="checkbox" name="Checkboxes16" checked="checked" />
                                    <span></span>
    
                                </label>
                                @else
                                <label class="checkbox checkbox-outline checkbox-outline-2x checkbox-primary">
                                    <input type="checkbox" name="Checkboxes16" />
                                    <span></span>
    
                                </label>
                                @endif
    
                            </td>
                        </tr>
    
                    </table>
                    </span>
                    <hr />
    
                    <span class="titulos">26 ESTADO DE CONSERVACION</span>
                    <table class="datos_sb">
                        <tr>
                            <td>EXCELENTE </td>
                            <td>
                                @if ($estado != null && $estado->estado_conservacion == 'Excelente')
                                <label class="checkbox checkbox-outline checkbox-outline-2x checkbox-primary">
                                    <input type="checkbox" name="Checkboxes16" checked="checked" />
                                    <span></span>
    
                                </label>
                                @else
                                <label class="checkbox checkbox-outline checkbox-outline-2x checkbox-primary">
                                    <input type="checkbox" name="Checkboxes16" />
                                    <span></span>
    
                                </label>
                                @endif
                            </td>
    
                            <td>BUENO </td>
                            <td>
                                @if ($estado != null && $estado->estado_conservacion == 'Bueno')
                                <label class="checkbox checkbox-outline checkbox-outline-2x checkbox-primary">
                                    <input type="checkbox" name="Checkboxes16" checked="checked" />
                                    <span></span>
    
                                </label>
                                @else
                                <label class="checkbox checkbox-outline checkbox-outline-2x checkbox-primary">
                                    <input type="checkbox" name="Checkboxes16" />
                                    <span></span>
    
                                </label>
                                @endif
                            </td>
    
                            <td>REGULAR </td>
                            <td>
                                @if ($estado != null && $estado->estado_conservacion == 'Regular')
                                <label class="checkbox checkbox-outline checkbox-outline-2x checkbox-primary">
                                    <input type="checkbox" name="Checkboxes16" checked="checked" />
                                    <span></span>
    
                                </label>
                                @else
                                <label class="checkbox checkbox-outline checkbox-outline-2x checkbox-primary">
                                    <input type="checkbox" name="Checkboxes16" />
                                    <span></span>
    
                                </label>
                                @endif
                            </td>
                        </tr>
    
                        <tr>
                            <td>MALO </td>
                            <td>
                                @if ($estado != null && $estado->estado_conservacion == 'Malo')
                                <label class="checkbox checkbox-outline checkbox-outline-2x checkbox-primary">
                                    <input type="checkbox" name="Checkboxes16" checked="checked" />
                                    <span></span>
    
                                </label>
                                @else
                                <label class="checkbox checkbox-outline checkbox-outline-2x checkbox-primary">
                                    <input type="checkbox" name="Checkboxes16" />
                                    <span></span>
    
                                </label>
                                @endif
                            </td>
    
                            <td>PESIMO </td>
                            <td>
                                @if ($estado != null && $estado->estado_conservacion == 'Pesimo')
                                <label class="checkbox checkbox-outline checkbox-outline-2x checkbox-primary">
                                    <input type="checkbox" name="Checkboxes16" checked="checked" />
                                    <span></span>
    
                                </label>
                                @else
                                <label class="checkbox checkbox-outline checkbox-outline-2x checkbox-primary">
                                    <input type="checkbox" name="Checkboxes16" />
                                    <span></span>
    
                                </label>
                                @endif
                            </td>
    
                            <td>FRAGMENTO </td>
                            <td>
                                @if ($estado != null && $estado->estado_conservacion == 'Fragmento')
                                <label class="checkbox checkbox-outline checkbox-outline-2x checkbox-primary">
                                    <input type="checkbox" name="Checkboxes16" checked="checked" />
                                    <span></span>
    
                                </label>
                                @else
                                <label class="checkbox checkbox-outline checkbox-outline-2x checkbox-primary">
                                    <input type="checkbox" name="Checkboxes16" />
                                    <span></span>
    
                                </label>
                                @endif
                            </td>
                        </tr>
    
                    </table>
                    </span>
                    <hr />
    
                    <span class="titulos">27 CONDICIONES DE SEGURIDAD</span>
                    <table class="datos_sb">
                        <tr>
                            <td>BUENA </td>
                            <td>
                                @if ($estado != null && $estado->condiciones_seguridad == 'Buena')
                                <label class="checkbox checkbox-outline checkbox-outline-2x checkbox-primary">
                                    <input type="checkbox" name="Checkboxes16" checked="checked" />
                                    <span></span>
    
                                </label>
                                @else
                                <label class="checkbox checkbox-outline checkbox-outline-2x checkbox-primary">
                                    <input type="checkbox" name="Checkboxes16" />
                                    <span></span>
    
                                </label>
                                @endif
                            </td>
    
                            <td>RAZONABLE </td>
                            <td>
                                @if ($estado != null && $estado->condiciones_seguridad == 'Razonable')
                                <label class="checkbox checkbox-outline checkbox-outline-2x checkbox-primary">
                                    <input type="checkbox" name="Checkboxes16" checked="checked" />
                                    <span></span>
    
                                </label>
                                @else
                                <label class="checkbox checkbox-outline checkbox-outline-2x checkbox-primary">
                                    <input type="checkbox" name="Checkboxes16" />
                                    <span></span>
    
                                </label>
                                @endif
                            </td>
    
                            <td>NINGUNA </td>
                            <td>
                                @if ($estado != null && $estado->condiciones_seguridad == 'Ninguna')
                                <label class="checkbox checkbox-outline checkbox-outline-2x checkbox-primary">
                                    <input type="checkbox" name="Checkboxes16" checked="checked" />
                                    <span></span>
    
                                </label>
                                @else
                                <label class="checkbox checkbox-outline checkbox-outline-2x checkbox-primary">
                                    <input type="checkbox" name="Checkboxes16" />
                                    <span></span>
    
                                </label>
                                @endif
                            </td>
                        </tr>
    
                    </table>
                    </span>
    
                </td>
                <td style="vertical-align: top;">
                    <table class="datos_sb" style="vertical-align: top;">
                        <tr>
                            <td style="height: 100px; vertical-align: top;">
                                <span class="titulos">21 MARCAS / INSCRIPCIONES</span>
                                <span class="contenidos">{{ $patrimonio->tecnicamaterial->nombre }}</span>
                            </td>
                        </tr>
                    </table>
                    <hr />
                    <table class="datos_sb">
                        <tr>
                            <td>
                                <span class="titulos">22 DIMENCIONES</span>
                                <table class="datos_sb">
                                    <tr>
                                        <td>ALTO </td>
                                        <td>{{ $patrimonio->alto }}</td>
                                        <td style="padding-left: 60px;">LARGO </td>
                                        <td>{{ $patrimonio->largo }}</td>
                                    </tr>
                                    <tr>
                                        <td>ANCHO </td>
                                        <td>{{ $patrimonio->ancho }}</td>
                                        <td style="padding-left: 60px;">PROFUNDIDAD </td>
                                        <td>{{ $patrimonio->profundidad }}</td>
                                    </tr>
                                    <tr>
                                        <td>DIAMETRO </td>
                                        <td>{{ $patrimonio->diametro }}</td>
                                        <td style="padding-left: 60px;">PESO </td>
                                        <td>{{ $patrimonio->peso }}</td>
                                    </tr>
                                    <tr>
                                        <td>CIRCUNFERENCIA </td>
                                        <td>{{ $patrimonio->circunferencia }}</td>
                                        <td> </td>
                                        <td> </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <hr />
                    <table class="datos_sb" style="vertical-align: top;">
                        <tr>
                            <td style="height: 500px; vertical-align: top;">
                                <span class="titulos">23 DESCRIPCION</span>
                                <span class="contenidos">{{ $patrimonio->descripcion }}</span>                            
                            </td>
                        </tr>
                    </table>
                    
    
                    <hr />
    
                    <span class="titulos">24 ARCHIVO FOTOGRAFICO</span>
                    <table class="datos_sb">
                        <tr>
                            <td>No. DE ROLLO </td>
                            <td>{{ $patrimonio->rollo }}</td>
                            <td style="padding-left: 60px;">No. DE TOMA</td>
                            <td>{{ $patrimonio->toma }}</td>
                        </tr>
                        <tr>
                            <td>FOTOGRAFO </td>
                            <td>{{ $patrimonio->fotografo }}</td>
                            <td style="padding-left: 60px;"> </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>FECHA </td>
                            <td>{{ $patrimonio->fecha_fotografia }}</td>
                            <td style="padding-left: 60px;"> </td>
                            <td></td>
                        </tr>
    
                    </table>
    
                </td>
            </tr>
        </table>
        </div>
        <div style="page-break-after: always;"></div>
        <table class="datos" style="vertical-align: top;">
            <tr>
                <td>
                    <span class="titulos">ANALISIS HISTORICO ARTISITICO</span>
                </td>
            </tr>
            <tr>
                <td style="height: 140px; vertical-align: top;">
                    <span class="titulos">28 ESPECIFICACIONES SOBRE ES ESTADO DE CONSERVACION</span><br />
                    <span class="contenidos">{{ $patrimonio->especificacion_conservacion }}</span>
                </td>
            </tr>
            <tr>
                <td style="height: 140px; vertical-align: top;">
                    <span class="titulos">29 INTERVENCIONES REALIZADAS</span><br />
                    <span class="contenidos">{{ $patrimonio->intervenciones_realizadas }}</span>
                </td>
            </tr>
            <tr>
                <td style="height: 140px; vertical-align: top;">
                    <span class="titulos">30 CARACTERISTICAS TECNICAS</span><br />
                    <span class="contenidos">{{ $patrimonio->caracteristicas_tecnicas }}</span>
                </td>
            </tr>
            <tr>
                <td style="height: 140px; vertical-align: top;">
                    <span class="titulos">31 CARACTERISTICAS ICONOGRAFICAS / ORNAMENTALES</span><br />
                    <span class="contenidos">{{ $patrimonio->caracteristicas_iconograficas }}</span>
                </td>
            </tr>
            <tr>
                <td style="height: 140px; vertical-align: top;">
                    <span class="titulos">32 DATOS HISTORICOS</span><br />
                    <span class="contenidos">{{ $patrimonio->datos_historicos }}</span>
                </td>
            </tr>
            <tr>
                <td style="height: 140px; vertical-align: top;">
                    <span class="titulos">33 REFERENCIAS BIBLIOGRAFICAS / ARCHIVISTAS</span><br />
                    <span class="contenidos">{{ $patrimonio->referencias_bibliograficas }}</span>
                </td>
            </tr>
            <tr>
                <td style="height: 150px; vertical-align: top;">
                    <span class="titulos">34 OBSERVACIONES</span><br />
                    <span class="contenidos">{{ $patrimonio->observaciones }}</span>
                </td>
            </tr>
            <tr>
                <td style="height: 140px; vertical-align: top;">
                    <table class="datos_sb">
                        <tr>
                            <td><span class="titulos">CATALOGO</span> </td>
                            <td>{{ $patrimonio->catalogo }}</td>
                            <td style="padding-left: 60px;"><span class="titulos">ELABORO</span> </td>
                            <td>{{ $patrimonio->elaboro }}</td>
                        </tr>
                        <tr>
                            <td><span class="titulos">FECHA </td>
                            <td>{{ $patrimonio->fecha_catalogo }}</td>
                            <td style="padding-left: 60px;"><span class="titulos">FECHA</span></td>
                            <td>{{ $patrimonio->fecha_elaboro }}</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td style="padding-left: 60px;"><span class="titulos">REVISO</span> </td>
                            <td>{{ $patrimonio->reviso }}</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td style="padding-left: 60px;"><span class="titulos">FECHA</span></td>
                            <td>{{ $patrimonio->fecha_reviso }}</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

    </main>


</body>

</html>