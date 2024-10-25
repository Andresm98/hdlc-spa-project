<!DOCTYPE html>
<html lang="en">

<head>

    <head>
        <meta charset="UTF-8">
        <title>Reporte Hermanas Fallecidas</title>
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
                        Compañía Hijas de la Caridad de San Vicente de Paúl
                    </p>

                    <small>Información Hermanas Fallecidas en la Compañía @if ($from != null || $to != null)
                            ({{ date('Y-m-d', strtotime($from)) }} -
                            {{ date('Y-m-d', strtotime($to)) }})
                        @endif - Provincia Ecuador
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
            <table>
                <tr>
                    <th>Nro</th>
                    <th>Nombre en Comunidad</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Fecha de Nacimiento</th>
                    <th>Fecha de Vocación</th>
                    <th>Fecha de Fallecimiento</th>
                    <th>Comunidad Fallecimiento</th>
                </tr>
                {{ $count = 1 }}
                @foreach ($data as $daughter)
                    <tr>
                        <td width="4%">{{ $count++ }}</td>
                        <td>{{ $daughter->fullnamecomm }}</td>
                        <td>{{ $daughter->name }}</td>
                        <td>{{ $daughter->lastname }}</td>
                        @if ($daughter->profile)
                            <td>
                                {{ date('Y-m-d', strtotime($daughter->profile->date_birth)) }}
                            </td>
                            <td>
                                @if ($daughter->profile->date_vocation)
                                    {{ date('Y-m-d', strtotime($daughter->profile->date_vocation)) }}
                                @endif
                            </td>
                            <td>
                                {{ date('Y-m-d', strtotime($daughter->profile->date_death)) }}
                            </td>
                            <td width="20%">
                                @if (count($daughter->profile->transfers) > 0)
                                    <?php
                                    $list;
                                    $list = $daughter->profile
                                        ->transfers()
                                        ->whereDate('transfer_date_adission', '<', now())
                                        ->orderBy('transfer_date_adission', 'desc')
                                        ->get();
                                    ?>
                                    {{ $list->first()->community->comm_name }}
                                @endif
                            </td>
                        @else
                            <td>Pendiente</td>
                            <td>Pendiente</td>
                            <td>Pendiente</td>
                        @endif
                    </tr>
                @endforeach
            </table>
        </div>
    </main>

    <footer>

    </footer>

</body>

</html>
