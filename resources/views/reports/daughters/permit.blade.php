<!DOCTYPE html>
<html lang="en">

<head>

    <head>
        <meta charset="UTF-8">
        <title>Permiso Hermana {{ $user->name }}</title>
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
                    <small>Permiso de la Hermana - Estado: @if ($permit->status == 1)
                            Activo
                        @elseif ($permit->status == 0)
                            Cerrado
                        @endif - Provincia Ecuador
                    </small>
                </div>

            </div>
        </div>
    </header>

    <main>
        <div class="a">
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
                <strong>Detalles del Permiso: </strong>
                <?php
                use App\Http\Controllers\AddressController;
                ?>

                <ul>
                    <li><strong>Motivo del Permiso: </strong> {{ $permit->reason }}</li>
                    <li><strong>Dirección Destino: </strong> {{ $permit->address->address }},
                        {{ AddressController::showActualAddress($permit->address->political_division_id) }}.</li>
                    <li><strong>Fecha del consejo provicial en el que se autoriza el Permiso: </strong>
                        {{ date('Y-m-d', strtotime($permit->date_province)) }}</li>
                    <li><strong>Fecha del consejo general que aprueba el Permiso: </strong>
                        {{ date('Y-m-d', strtotime($permit->date_general)) }}</li>
                    <li><strong>Fecha de Salida: </strong>
                        {{ date('Y-m-d', strtotime($permit->date_out)) }}</li>
                    <li><strong>Fecha de integración a la Comunidad: </strong>
                        {{ date('Y-m-d', strtotime($permit->date_in)) }}</li>
                    <li><strong>Observaciones : </strong>
                        <div class="a">{!! $permit->description !!}</div>
                    </li>
                </ul>
            </div>
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
