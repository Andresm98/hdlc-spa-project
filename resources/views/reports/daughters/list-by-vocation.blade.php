<!DOCTYPE html>
<html lang="en">

<head>

    <head>
        <meta charset="UTF-8">
        <title>Reportes por Vocación</title>
        <style>
            @page {
                margin: 0cm 0cm;
                font-size: 1em;
            }

            body {
                margin: 2.3cm 2cm 1cm 2cm;
                font-family: Arial, sans-serif;
            }

            header {
                position: fixed;
                top: 0cm;
                left: 0cm;
                right: 0cm;
                height: 2cm;
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
                padding-left: 2px;
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
                <div style="float: left;width: 90%; height: 30px; text-align: center;">
                    <p style="font-size:medium; margin-top:0.5cm;">
                        COMPAÑÍA HIJAS DE LA CARIDAD DE SAN VICENTE DE PAÚL
                    </p>
                    <small>HERMANAS CON VOZ PASIVA
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

            </div>

            @foreach ($data as $key => $row)
                <h2 style=" text-align: center;">
                    {{ $key }} AÑOS DE VOCACIÓN</h2>
                <table>
                    <tr>
                        <th rowspan="2" style="text-align: center">No. ORD.</th>
                        <th rowspan="2" style="text-align: center">NOMBRES Y APELLIDOS DE SOR</th>
                        <th colspan="3" style="text-align: center">FECHA DE NACIMIENTO</th>
                        <th colspan="3" style="text-align: center">FECHA DE VOCACIÓN</th>
                        <th rowspan="2" style="text-align: center">AÑOS DE VOCACIÓN</th>
                    </tr>
                    <tr>
                        <th style="text-align: center">DÍA</th>
                        <th style="text-align: center">MES</th>
                        <th style="text-align: center">AÑO</th>
                        <th style="text-align: center">DÍA</th>
                        <th style="text-align: center">MES</th>
                        <th style="text-align: center">AÑO</th>
                    </tr>
                    {{ $count = 1 }}
                    @foreach ($row as $inside)
                        <tr>
                            <td style="text-align:center" width="4%">{{ $count++ }}</td>
                            <td>{{ strtoupper($inside['daughter']->lastname) }}
                                {{ strtoupper($inside['daughter']->name) }}</td>
                            @if ($inside['daughter']->profile)
                                <td style="text-align:center" width="6%">
                                    {{ date('d', strtotime($inside['daughter']->profile->date_birth)) }}
                                </td>
                                <td style="text-align:center" width="6%">
                                    {{ date('m', strtotime($inside['daughter']->profile->date_birth)) }}
                                </td>
                                <td style="text-align:center" width="6%">
                                    {{ date('Y', strtotime($inside['daughter']->profile->date_birth)) }}
                                </td>

                                <td style="text-align:center" width="6%">
                                    {{ date('d', strtotime($inside['daughter']->profile->date_vocation)) }}
                                </td>
                                <td style="text-align:center" width="6%">
                                    {{ date('m', strtotime($inside['daughter']->profile->date_vocation)) }}
                                </td>
                                <td style="text-align:center" width="6%">
                                    {{ date('Y', strtotime($inside['daughter']->profile->date_vocation)) }}
                                </td>
                            @else
                                <td>Pendiente</td>
                            @endif
                            <td width="5%" style="text-align:center">{{ $inside['year'] }}</td>
                        </tr>
                    @endforeach
                </table>
            @endforeach

        </div>
    </main>

</body>

</html>
