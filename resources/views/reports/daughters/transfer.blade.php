<!DOCTYPE html>
<html lang="en">

<head>

    <head>
        <meta charset="UTF-8">
        <title>Transferencia Hermana {{ $user->name }}</title>
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
                top: 0cm;
                left: 0cm;
                right: 0cm;
                height: 2.5cm;
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
                height: 1.5cm;
                background-color: #e5e7ee;
                color: white;
                text-align: center;
                /* line-height: 35px; */
            }

            * {
                box-sizing: border-box;
            }

            /* Create two equal columns that floats next to each other */
            .column {
                float: left;
                padding: 10px;
                height: auto;
                /* Should be removed. Only for demonstration */
            }

            /* Clear floats after the columns */
            .row:after {
                content: "";
                display: table;
                clear: both;
            }

            p.main {
                text-align: justify;
            }

            div.a {
                text-align: justify;
            }

            table,
            td,
            th {
                border: 1px solid black;
                padding-left: 15px;
                text-align: left;
            }

            table {
                border-collapse: collapse;
                width: 100%;
                align-items: center;
            }

            th {
                height: 20px;
            }
        </style>
    </head>
</head>

<body>
    <header>

        <div style="margin-top:0.2cm; margin-block-start: 0.2cm; color: #000000">
            <p style="font-size:medium; margin-top:0.5cm;">
                Compañía Hijas de la Caridad de San Vicente de Paúl ©
            <p>Transferencia de la Hermana - Estado: @if ($transfer->status == 1)
                    Activo
                @elseif ($transfer->status == 0)
                    Cerrado
                @endif
            </p>
            </p>
        </div>
    </header>

    <main>
        <div style="font-size: small; margin-top: 30px">

            <strong>Datos de la Hermana que solicita el Permiso: </strong>
            <ul>
                <li><strong>Nombres: </strong> {{ $user->name }}</li>
                <li><strong>Apellidos: </strong> {{ $user->lastname }}</li>
                @if ($user->profile->date_birth)
                    <li><strong>Fecha de Nacimiento: </strong>
                        {{ date('Y-m-d', strtotime($user->profile->date_birth)) }}</li>
                @endif
                @if ($user->profile->date_vocation)
                    <li><strong>Fecha de Vocación: </strong>
                        {{ date('Y-m-d', strtotime($user->profile->date_vocation)) }}</li>
                @endif
                @if ($user->profile->date_vote)
                    <li><strong>Fecha de Votos: </strong>
                        {{ date('Y-m-d', strtotime($user->profile->date_vote)) }}</li>
                @endif
            </ul>
            <strong>Detalles del Cambio: </strong>
            <?php
            use App\Http\Controllers\AddressController;
            ?>
            <div class="a">
                <ul>
                    <li><strong>Motivo del Cambio: </strong> {{ $transfer->transfer_reason }}</li>
                    {{-- <li><strong>Dirección Destino: </strong> {{ $permit->address->address }},
                    {{ AddressController::showActualAddress($permit->address->political_division_id) }}.</li> --}}
                    <li><strong>Fecha Inicio: </strong>
                        {{ date('Y-m-d', strtotime($transfer->transfer_date_adission)) }}</li>
                    @if ($transfer->transfer_date_relocated)
                        <li><strong>Fecha de Relocalización: </strong>
                            {{ date('Y-m-d', strtotime($transfer->transfer_date_relocated)) }}</li>
                    @endif
                    <li><strong>Comunidad Destino: </strong>
                        {{ $transfer->community->comm_name }}</li>
                    @if ($lastTransfer)
                        <li><strong>Comunidad Anterior: </strong>
                            {{ $lastTransfer->community->comm_name }}</li>
                    @endif
                    <li style=" text-align: justify; padding-right: 10px"><strong>Observaciones : </strong>
                        {!! $transfer->transfer_observation !!}
                    </li>
                </ul>
            </div>

            <strong>Nombramientos ({{ count($appointments) }}): </strong>

            @foreach ($appointments as $appointment)
                <div class="a">
                    <ul>
                        <li><strong>Nombre: </strong> {{ $appointment->appointment_level->name }}</li>
                        <li><strong>Fecha Inicio: </strong>
                            {{ date('Y-m-d', strtotime($appointment->date_appointment)) }}</li>
                        @if ($appointment->date_end_appointment)
                            <li><strong>Fecha Fin: </strong>
                                {{ date('Y-m-d', strtotime($appointment->date_end_appointment)) }}</li>
                        @endif

                    </ul>
                </div>
            @endforeach

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
