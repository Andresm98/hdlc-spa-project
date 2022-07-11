<!DOCTYPE html>
<html lang="en">

<head>

    <head>
        <meta charset="UTF-8">
        <title>Reporte Nombramientos</title>
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
                background-color: #e5e7ee;
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
                background-color: #e5e7ee;
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
                <div style="float: left;width: 90%; height: 30px;">
                    <p style="font-size:medium; margin-top:0.5cm;">
                        Compañía Hijas de la Caridad de San Vicente de Paúl ©
                    <p>Información Nombramientos
                        @if ($level)
                            a nivel de <strong>{{ $level->name }}</strong>
                        @endif en la Compañía
                        @if ($from != null || $to != null)
                            , Fechas de Inicio: ({{ date('Y-m-d', strtotime($from)) }} -
                            {{ date('Y-m-d', strtotime($to)) }})
                        @endif
                    </p>
                    </p>
                </div>
                <div style="float: left;width: 10%; height: 30px;">
                    <p style="font-size:medium; margin-right:2.5cm; margin-bottom:2.0cm;">
                        <img height="60px" width="100px"
                            src="https://files-hdlc-frontend.s3.amazonaws.com/icon_hdlc.png" />
                    </p>
                </div>
            </div>
        </div>
    </header>

    <main>
        {{-- Address --}}
        <div style="font-size: small;">

            {{-- Info Family --}}

            <div style="margin-bottom:5px;">
                <strong>Nombramientos Registrados: </strong> En esta plantilla se encuentran los registros de los
                nombramientos @if ($level)
                    a nivel de {{ $level->name }}
                @endif
                que han sido registrados en la Compañía. Para reportes personalizados por favor seleccione los filtros
                necesarios.
                <br>
                Nro. de nombramientos registrados: {{ count($data) }}.
                <br>
            </div>
            <?php
            use App\Http\Controllers\Secretary\Transfer\TransferGlobalController;
            ?>
            <table>
                <tr>
                    <th>Nro</th>
                    <th>Hermana</th>
                    <th>Nombramiento</th>
                    <th>Fecha de Inicio y Fin del Nombramiento</th>
                    <th>Comunidad en donde cumple funciones</th>
                </tr>
                {{ $count = 1 }}
                @foreach ($data as $appointment)
                    <tr>
                        <td>{{ $count++ }}</td>
                        <td>
                            {{ $appointment->profile->user->name }}<br>
                            {{ $appointment->profile->user->lastname }}<br>
                            F.Nacimiento: {{ date('Y-m-d', strtotime($appointment->profile->date_birth)) }}<br>
                            @if ($appointment->profile->date_vocation != null)
                                F.Vocación: {{ date('Y-m-d', strtotime($appointment->profile->date_vocation)) }}<br>
                            @endif
                            @if ($appointment->profile->date_vote != null)
                                F.Votos: {{ date('Y-m-d', strtotime($appointment->profile->date_vote)) }}<br>
                            @endif
                        </td>
                        <td>{{ $appointment->appointment_level->name }}</td>
                        <td>{{ date('Y-m-d', strtotime($appointment->date_appointment)) }}
                            @if ($appointment->date_end_appointment != null)
                                -
                                {{ date('Y-m-d', strtotime($appointment->date_end_appointment)) }}
                            @endif
                            <br>
                            @if ($appointment->status == 1)
                                Activo
                            @else
                                Historial
                            @endif
                            <br>
                        </td>
                        <td>
                            @if ($appointment->community != null)
                                {{ $appointment->community->comm_name }}
                            @endif
                        </td>
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
