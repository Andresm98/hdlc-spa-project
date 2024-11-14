<!DOCTYPE html>
<html lang="en">

<head>

    <head>
        <meta charset="UTF-8">
        <title>Reporte Transferencias</title>
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
            td {
                height: 40px;
                border: 1px solid black;
                font-size: 12px;
                padding-left: 15px;
            },
            th {
                height: 20px;
                border: 1px solid black;
                font-size: 12px;
            }

            table {
                border-collapse: collapse;
                width: 100%;
                align-items: center;
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
                    <small>Información de Cambios en la Compañía @if ($from != null || $to != null)
                            , Fechas de Transferencia: ({{ date('Y-m-d', strtotime($from)) }} -
                            {{ date('Y-m-d', strtotime($to)) }})
                        @endif - Provincia Ecuador
                    </small>
                </div>

            </div>
        </div>
    </header>

    <main>
        <div style="font-size: small;">
            <div style="margin-bottom:5px;">
            </div>
            <?php
            use App\Http\Controllers\Secretary\Daughter\TransferController;
            ?>
            <table>
                <tr>
                    <th>Nro</th>
                    <th>NOMBRES Y APELLIDOS</th>
                    <th>AÑO NAC.</th>
                    <th>FECHA VOCACIÓN</th>
                    <th>PROCEDE DE:</th>
                    <th>VA A:</th>
                    <th>MOTIVO DEL CAMBIO</th>
                    <th>FECHA DEL CAMBIO</th>
                    <th>FECHA DE INSTALACIÓN</th>

                </tr>
                {{ $count = 1 }}
                @foreach ($data as $transfer)
                    <tr>
                        <td width="5%">{{ $count++ }}</td>
                        <td width="16%">
                            {{ $transfer->profile->user->name }}<br>
                            {{ $transfer->profile->user->lastname }}<br>
                        </td>
                        <td width="5%">
                            {{ date('Y', strtotime($transfer->profile->date_birth)) }}
                        </td>
                        <td width="9%">
                            @if ($transfer->profile->date_vocation !== null)
                                {{ date('Y-m-d', strtotime($transfer->profile->date_vocation)) }}
                            @endif
                        </td>
                        <td width="15%">
                            <?php
                            $lastTransfer = TransferController::theLastTransferStatic($transfer->profile->user->id, $transfer->id);
                            ?>
                            @if ($lastTransfer)
                                {{ $lastTransfer->community->comm_name }}
                            @endif

                        </td>
                        <td width="15%">{{ $transfer->community->comm_name }}</td>

                        <td idth="15%">
                            {{ $transfer->transfer_reason }}
                        </td>
                        <td width="10%">{{ date('Y-m-d', strtotime($transfer->transfer_date_adission)) }}</td>
                        <td width="10%">

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
            Compañía Hijas de la Caridad de San Vicente de Paúl, Provincia Ecuador.
        </p>
    </footer>

</body>

</html>
