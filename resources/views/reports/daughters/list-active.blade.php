<!DOCTYPE html>
<html lang="en">

<head>

    <head>
        <meta charset="UTF-8">
        <title>Reporte Hermanas @if ($type == 1)
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
                position: fixed;
                margin-bottom: 0.01cm;
                top: 0cm;
                left: 0cm;
                right: 0cm;
                height: 2.2cm;
                background-color: #ffffff;
                color: white;
                text-align: center;
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
    <header>
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
                        ; Provincia Ecuador
                    </small>
                </div>

            </div>
        </div>
    </header>

    <main>
        {{-- Address --}}
        <div style="font-size: small;">

            {{-- Info Family --}}

            <div style="margin-bottom:5px;">
                <strong>Hermanas registradas: </strong> En esta plantilla se encuentran los registros de las hermanas
                que se encuentran activas en la compañía, debe tener en cuenta que los registros son mostrados de
                acuerdo a los filtros anteriormente seleccionados.
                <br>
                Nro. de hermanas registradas: {{ count($data) }}.
                <br>
            </div>
            <table>
                <tr>
                    <th>Nro</th>
                    <th>Hermana</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Fecha de Nacimiento</th>
                    <th>Fecha de Admisión</th>
                    @if ($type == 2)
                        <th>Fecha de Envío</th>
                    @elseif ($type == 3)
                        <th>Fecha de Envío</th>
                        <th>Fecha de Votos</th>
                    @endif
                </tr>
                {{ $count = 1 }}
                @foreach ($data as $daughter)
                    <tr>
                        <td width="7%">{{ $count++ }}</td>
                        <td>{{ $daughter->fullnamecomm }}</td>
                        <td>{{ $daughter->name }}</td>
                        <td>{{ $daughter->lastname }}</td>
                        @if ($daughter->profile)
                            <td>
                                {{ date('Y-m-d', strtotime($daughter->profile->date_birth)) }}
                            </td>
                            <td>
                                {{ date('Y-m-d', strtotime($daughter->profile->date_admission)) }}
                            </td>
                            @if ($type == 2)
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
                            @endif
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
