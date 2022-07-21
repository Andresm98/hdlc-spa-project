<!DOCTYPE html>
<html lang="en">

<head>

    <head>
        <meta charset="UTF-8">
        <title>Reporte Comunidades</title>
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
                    <p>Reporte Comunidades @if ($status)
                            @if ($status == 1)
                                Abiertas
                            @else
                                Cerradas
                            @endif
                        @endif de la Compañía
                        @if ($from && $to)
                            ({{ date('Y-m-d', strtotime($from)) }} -
                            {{ date('Y-m-d', strtotime($to)) }})
                        @endif

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
                <strong>Comunidades registradas: </strong> En esta plantilla se encuentran los registros de las
                comunidades
                que se encuentran en la provincia Ecuador, debe tener en cuenta que los registros son mostrados de
                manera secuencial. Para reportes personalizados por favor seleccione los filtros necesarios.
                <br>
                Nro. de comunidades @if ($pastoral)
                    pastoral <strong>{{ $pastoral->name }}</strong>
                @endif encontradas: {{ count($data) }}.
                <br>
            </div>
            <table>
                <tr>
                    <th>Nro</th>
                    <th>Nombre</th>
                    <th>Pastoral</th>
                    <th>Fechas Actividad</th>
                    {{-- <th>Fecha de Nacimiento</th> --}}
                </tr>
                {{ $count = 1 }}
                @foreach ($data as $community)
                    <tr>
                        <td width="7%">{{ $count++ }}</td>
                        <td width="25%">{{ $community->comm_name }}</td>
                        <td>{{ $community->pastoral->name }}</td>
                        <td>
                            @if ($community->comm_status == 1)
                                Abierta <br>
                                ({{ date('Y-m-d', strtotime($community->date_fndt_comm)) }})
                                - Presente
                            @else
                                Cerrada <br>
                                ({{ date('Y-m-d', strtotime($community->date_fndt_comm)) }}) hasta
                                ({{ date('Y-m-d', strtotime($community->date_close)) }})
                            @endif
                        </td>
                        {{-- <td>Pendiente</td> --}}
                    </tr>

                    {{-- Hermanas --}}
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
