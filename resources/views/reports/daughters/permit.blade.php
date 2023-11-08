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
                border: none;
                padding-left: -2px;
                text-align: left;
            }

            table {
                border: none;
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
    <?php
    use App\Http\Controllers\AddressController;
    ?>
    <header>
        <div style=" margin-block-start: 0.2cm; color: #000000">
            <br>
            <br>
            <div>
                <div style=" height: 30px;">
                    <p style="font-size:medium; margin-top:0.5cm;">

                        <strong>PROVINCIA DE: </strong>ECUADOR
                    </p>
                    <small>AUTORIZACIÓN PARA RESIDIR FUERA DE UNA CASA DE LA COMPAÑÍA <br> Estado: @if ($permit->status == 1)
                            Activo
                        @elseif ($permit->status == 0)
                            Cerrado
                        @endif
                    </small>
                </div>

            </div>
        </div>
    </header>

    <main>
        <div>
            <div style="font-size: medium; margin-top: 30px">
                <br>
                <br>
                <br>

                <table>
                    <tr>
                        <td> <strong>Apellidos: </strong></td>
                        <td> {{ strtoupper($user->lastname) }}</td>
                    </tr>
                    <tr>
                        <td> <strong>Nombres: </strong></td>
                        <td> {{ strtoupper($user->name) }}</td>
                    </tr>

                    @foreach ([1, 2, 3, 4, 5, 6] as $number)
                        <tr>
                            <td></td>
                            <td></td>
                        </tr>
                    @endforeach

                    @if ($user->profile->date_birth)
                        <tr>
                            <td> <strong>Fecha de Nacimiento: </strong> </td>
                            <td> {{ date('d-m-Y', strtotime($user->profile->date_birth)) }}</td>
                        </tr>
                    @endif

                    @if ($user->profile->date_vocation)
                        <tr>
                            <td> <strong>Fecha de Vocación: </strong></td>
                            <td> {{ date('d-m-Y', strtotime($user->profile->date_vocation)) }}</td>
                        </tr>
                    @endif

                    @if ($user->profile->date_vote)
                        <tr>
                            <td> <strong>Fecha de Votos: </strong></td>
                            <td> {{ date('d-m-Y', strtotime($user->profile->date_vote)) }}</td>
                        </tr>
                    @endif

                    @foreach ([1, 2, 3, 4, 5, 6] as $number)
                        <tr>
                            <td></td>
                            <td></td>
                        </tr>
                    @endforeach

                    <tr>
                        <td> <strong>Destino: </strong></td>
                        <td> {{ $permit->address->address }}
                            {{ AddressController::showActualAddressPermit($permit->address->political_division_id) }}.
                        </td>
                    </tr>

                    @foreach ([1, 2, 3, 4, 5, 6] as $number)
                        <tr>
                            <td></td>
                            <td></td>
                        </tr>
                    @endforeach

                    <tr>
                        <td> <strong>Fecha del Consejo en el que se dió la autorización: </strong></td>
                        <td> {{ date('d-m-Y', strtotime($permit->date_general)) }}</td>
                    </tr>

                    @foreach ([1, 2, 3, 4, 5, 6] as $number)
                        <tr>
                            <td></td>
                            <td></td>
                        </tr>
                    @endforeach

                    <tr>
                        <td> <strong>Motivo de esta petición: </strong> </td>
                        <td> {{ $permit->reason }}</td>
                    </tr>

                    @foreach ([1, 2, 3, 4, 5, 6] as $number)
                        <tr>
                            <td></td>
                            <td></td>
                        </tr>
                    @endforeach

                    <tr>
                        <td> <strong>Fecha efectiva de la marcha: </strong> </td>
                        <td> {{ date('d-m-Y', strtotime($permit->date_out)) }}</td>
                    </tr>

                </table>
                <br>
                <br>
                {{-- <strong>Fecha del consejo provicial en el que se autoriza el Permiso: </strong>
                {{ date('d-m-Y', strtotime($permit->date_province)) }} --}}

                Dirección de la Hermana fuera de la Comunidad en
                {{ AddressController::showActualCompleteAddressPermit($permit->address->political_division_id) }}.
                <br>
                @if ($user->profile->cellphone)
                    Teléfono: {{ $user->profile->cellphone }}
                @endif
                <br>
                <br>
                {{-- <strong>Fecha de integración a la Comunidad: </strong>
                {{ date('d-m-Y', strtotime($permit->date_in)) }}
                <br>
                <br> --}}
                <strong>Observaciones: </strong>
                <div>{!! $permit->description !!}</div>
                <br>
                <br>
                <br>
                <strong>Fecha: </strong>{{ date('d.m.Y', strtotime($permit->date_province)) }}
                <br>
                <br>
                <br>
                <br>

            </div>
        </div>
    </main>

    <footer>
        <p
            style="font-size:15px; margin-left:0.40cm;  margin-right:0.40cm; margin-bottom:0.20cm; margin-top:0.20cm; color:#111631">

            @if ($visitator)
                Sor {{ $visitator['profile']->user->name }} {{ strtoupper($visitator['profile']->user->lastname) }}
                <br>
                Hija de la Caridad
            @endif

        </p>
    </footer>

</body>

</html>
