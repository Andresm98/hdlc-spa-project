<!DOCTYPE html>
<html lang="en">

<head>

    <head>
        <meta charset="UTF-8">
        <title>Reporte Hermanas Activas @if ($type == 1)
                Seminario
            @elseif ($type == 2)
                Jóvenes
            @elseif ($type == 3)
                con Votos
            @endif
        </title>
        {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
            integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> --}}


        <style>
            @page {
                margin: 0cm 0cm;
                font-size: 1em;
            }

            body {
                margin: 2.5cm 2cm 2cm;
                font-family: Arial, sans-serif;
            }

            header {
                /* position: fixed;
                margin-bottom: 0.01cm;
                top: 0cm;
                left: 0cm;
                right: 0cm;
                height: 2.2cm;
                background-color: #ffffff;
                color: white;
                text-align: center; */
                /* line-height: 15px; */
            }

            footer {
                position: fixed;
                bottom: 0cm;
                left: 0cm;
                right: 0cm;
                height: 2.0cm;
                background-color: #ffffff;
                color: white;
                text-align: center;
                /* line-height: 35px; */
            }

            * {
                box-sizing: border-box;
            }

            table,
            td,
            th {
                border: 1px solid black;
                padding-left: 15px;
                text-align: left;
                font-size: x-small;
            }

            table {
                border-collapse: collapse;
                width: 100%;
            }

            th {
                height: 20px;
            }
        </style>
    </head>
</head>

<body>
    {{-- <header>
        <div style=" margin-block-start: 0.2cm; color: #000000">
            <div>
                <div style="float: left;width: 10%; height: 30px;">
                    <p style="font-size:medium; margin-left:2.5cm; margin-bottom:2.0cm;">
                        <img height="60px" width="100px"
                            src="https://files-hdlc-frontend.s3.amazonaws.com/icon_hdlc.png" />
                    </p>
                </div>
                <div style="float: left;width: 90%; height: 30px;">
                    <p style="font-size:medium; margin-top:0.5cm;">
                        Compañía Hijas de la Caridad de San Vicente de Paúl ©
                    </p>
                    <small>Información Hermanas
                        @if ($type == 1)
                            Seminario
                        @elseif ($type == 2)
                            Jóvenes
                        @elseif ($type == 3)
                            con Votos
                        @endif de la Compañía
                        @if ($from != null || $to != null)
                            ({{ date('Y-m-d', strtotime($from)) }} -
                            {{ date('Y-m-d', strtotime($to)) }})
                        @endif
                        - Provincia Ecuador
                    </small>
                </div>

            </div>
        </div>
    </header> --}}
    <?php
    use Carbon\Carbon;
    ?>
    <div style=" margin-left: 40px; color: #000000">
        <h4 style="text-align: center; margin-right: 60px">LISTADO GENERAL: COMPAÑÍA DE LAS HIJAS DE LA CARIDAD DE SAN
            VICENTE DE PAÚL
            <br>
            PROVINCIA DEL ECUADOR
        </h4>

        <h4 style="text-align: center; margin-left: 80px; margin-right: 80px">
            DISTRIBUCIÓN ALFABÉTICA
        </h4>
    </div>

    <main>
        {{-- Address --}}
        <div style="font-size: small;">

            {{-- Info Family --}}

            <div style="margin-bottom:5px;">

            </div>

            <h5 style="text-align: right; margin-left: 80px; margin-right: 80px">
                {{ strtoupper(\Carbon\Carbon::parse(Carbon::now())->locale('es')->isoFormat('D MMMM YYYY')) }}
            </h5>
            <table>
                <tr>
                    <th>Nro</th>
                    {{-- <th>Hermana</th> --}}
                    <th>APELLIDOS Y NOMBRES</th>
                    <th colspan="3" style="font-size: 10px">F. NACIMIENTO</th>
                    <th colspan="3" style="font-size: 10px">F. VOCACIÓN</th>
                    <th style="font-size: 10px">N.C. IDENTIDAD</th>
                    <th style="font-size: 10px">Observac.</th>
                    {{-- @if ($type == 2)
                        <th>Fecha de Envío</th>
                    @elseif ($type == 3)
                        <th>Fecha de Envío</th>
                        <th>Fecha de Votos</th>
                    @endif --}}
                </tr>
                {{ $count = 1 }}
                @foreach ($data as $daughter)
                    <tr>
                        <td width="5%">{{ $count++ }}</td>
                        {{-- <td>{{ $daughter->fullnamecomm }}</td> --}}
                        <td width="55%">{{ strtoupper($daughter->lastname) }} {{ $daughter->name }}</td>
                        @if ($daughter->profile)
                            <td width="5%" style="text-align:left ">
                                {{ date('d', strtotime($daughter->profile->date_birth)) }}
                            </td>
                            <td width="5%" style="text-align:left">
                                {{ date('m', strtotime($daughter->profile->date_birth)) }}
                            </td>
                            <td width="5%" style="text-align:left">
                                {{ date('Y', strtotime($daughter->profile->date_birth)) }}
                            </td>
                            <td width="5%" style="text-align:left">
                                {{ date('d', strtotime($daughter->profile->date_vocation)) }}
                            </td>
                            <td width="5%" style="text-align:left">
                                {{ date('m', strtotime($daughter->profile->date_vocation)) }}
                            </td>
                            <td width="5%" style="text-align:left">
                                {{ date('Y', strtotime($daughter->profile->date_vocation)) }}
                            </td>
                            {{-- @if ($type == 2)
                                <td>
                                    {{ date('Y-m-d', strtotime($daughter->profile->date_send)) }}
                                </td>
                            @elseif ($type == 3)
                                <td>
                                    {{ date('Y-m-d', strtotime($daughter->profile->date_send)) }}
                                </td>
                                <td>
                                    {{ date('Y-m-d', strtotime($daughter->profile->date_vote)) }}
                                </td>
                            @endif --}}
                            <td width="5%" style="text-align:left">
                                @if ($daughter->profile->identity_card)
                                    {{ $daughter->profile->identity_card }}
                                @endif
                            </td>
                            <td></td>
                        @else
                            <td>Pendiente</td>
                            <td>Pendiente</td>
                        @endif
                    </tr>
                @endforeach

            </table>

            <hr>

        </div>
    </main>

    <footer>
        <p
            style="font-size:12px; margin-left:0.40cm;  margin-right:0.40cm; margin-bottom:0.20cm; margin-top:0.20cm; color:#111631">
            Fecha Impresión: {{ date('Y-m-d h:i:s a', time()) }}. Pichincha,
            Ecuador.
            Este documento fue generado en la plataforma privada de la
            Compañía Hijas de la Caridad de San Vicente de Paúl ©, Provincia Ecuador.
        </p>
    </footer>

</body>

</html>
