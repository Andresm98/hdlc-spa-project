<!DOCTYPE html>
<html lang="en">

<head>

    <head>
        <meta charset="UTF-8">
        <title>Reporte General Comunidades</title>
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
                    <p style="font-size:large; margin-top:0.9cm;">
                    <h4>COMUNIDADES CON AÑOS DE FUNDACIÓN @if ($status)
                            @if ($status == 1)
                                Abiertas
                            @else
                                Cerradas
                            @endif
                        @endif
                        @if ($from && $to)
                            ({{ date('Y-m-d', strtotime($from)) }} -
                            {{ date('Y-m-d', strtotime($to)) }})
                        @endif
                    </h4>
                </div>
            </div>
        </div>
    </header>

    <main>
        {{-- Address --}}
        <div style="font-size: small;">

            {{-- Info Family --}}

            <div style="margin-bottom:5px;">

            </div>
            <table>
                <tr>
                    <th>Nro</th>
                    <th>Ciudad</th>
                    <th>Provincia</th>
                    <th>Comunidades</th>
                    <th>Dirección</th>
                    <th>Fechas de Apertura</th>
                </tr>
                {{ $count = 1 }}
                @foreach ($data as $obj)
                    <tr>
                        <td width="7%">{{ $count++ }}</td>
                        <td width="15%">{{ $obj->parish }}</td>
                        <td width="15%">{{ $obj->province}}</td>
                        <td width="25%">{{ $obj->community->comm_name }}</td>
                        <td width="25%">{{ $obj->community->address->address }}</td>
                        <td>
                            {{ date('d.m.Y', strtotime($obj->community->date_fndt_comm)) }}
                        </td>
                        {{-- <td>
                            @if ($obj->community->comm_status == 1)
                                Presente
                            @else
                                {{ date('Y-m-d', strtotime($obj->community->date_close)) }}
                            @endif
                        </td> --}}
                    </tr>
                @endforeach
            </table>
            <hr>
        </div>
    </main>

    <footer>

    </footer>

</body>

</html>
