<!DOCTYPE html>
<html lang="en">

<head>

    <head>
        <meta charset="UTF-8">
        <title>Reporte Comunidades y Hermanas</title>
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
                padding-left: 5px;
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
                    <p>Reporte Comunidades @if ($status)
                            @if ($status == 1)
                                Abiertas
                            @else
                                Cerradas
                            @endif
                        @endif de la Compañía
                        @if ($from && $to)
                            ({{ date('d.m.Y', strtotime($from)) }} -
                            {{ date('d.m.Y', strtotime($to)) }})
                        @endif - Provincia Ecuador
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

            </div>
            <?php
            use App\Http\Controllers\Secretary\Community\CommunityDaughterController;
            $count = 1;
            ?>

            @foreach ($data as $index)
                <p style="text-align: center;"><strong>{{ $count++ }}.
                        {{ $index->community->comm_name }}, {{ $index->parish }}</strong>
                </p>

                <?php
                $listDaughters = CommunityDaughterController::reportStaticOrder($index->community->id, $index->community->comm_level);
                ?>
                @if ($listDaughters)
                    <table>
                        <tr>
                            <th>Nro</th>
                            <th style="text-align: center">Apellidos</th>
                            <th style="text-align: center">Nombres</th>
                            <th style="text-align: center">Nombre en Comunidad</th>
                            <th style="text-align: center">Fecha nacimiento</th>
                            <th style="text-align: center">Fecha vocación</th>
                            <th style="text-align: center">Fecha del último destino</th>
                        </tr>
                        {{ $countTwo = 1 }}
                        @foreach ($listDaughters as $daughter)
                            <tr>
                                <td width="4%">{{ $countTwo++ }}</td>
                                <td width="15%">
                                    {{ $daughter['profile']['user']['lastname'] }}
                                </td>
                                <td width="15%">
                                    {{ $daughter['profile']['user']['name'] }}
                                </td>
                                <td width="15%">
                                    {{ $daughter['profile']['user']['fullnamecomm'] }}
                                </td>
                                <td width="10%" style="text-align: center">
                                    {{ date('d.m.Y', strtotime($daughter['profile']['date_birth'])) }}<br>
                                </td>
                                <td width="10%" style="text-align: center">
                                    @if ($daughter['profile']['date_vocation'] != null)
                                        {{ date('d.m.Y', strtotime($daughter['profile']['date_vocation'])) }}<br>
                                    @endif
                                </td>
                                <td width="10%" style="text-align: center">
                                    @if ($daughter['transfer_date_adission'] != null)
                                        {{ date('d.m.Y', strtotime($daughter['transfer_date_adission'])) }}<br>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </table>
                @endif
            @endforeach
        </div>
    </main>

    <footer>

    </footer>

</body>

</html>
