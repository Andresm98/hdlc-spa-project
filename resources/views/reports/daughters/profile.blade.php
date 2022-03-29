<!DOCTYPE html>
<html lang="en">

<head>

    <head>
        <meta charset="UTF-8">
        <title>Reporte Hermana {{ $data->get('profile')->user->name }}</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
            integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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

        </style>
    </head>
</head>

<body>
    <header>

        <div style="margin-top:0.2cm; margin-block-start: 0.2cm; color: #000000">
            <p style="font-size:20px margin-top:0.2cm;">
                Compañía Hijas de la Caridad de San Vicente de Paúl ©
            </p>
            <p>Perfil de Hermana</p>
        </div>
        {{-- <p>Impreso por: {{ auth()->user()->name }}, {{ auth()->user()->title }}.</p> --}}

    </header>

    <main>
        {{-- Profile --}}
        <div class="row">
            <div class="column" style="background-color:rgb(255, 255, 255);    width: 70%;">
                <ul>
                    {{-- User --}}
                    <li style="margin-top:10px;"><strong>Nombres y Apellidos:</strong>
                        {{ $data->get('profile')->user->name }}
                        {{ $data->get('profile')->user->lastname }}</li>

                    {{-- Profile --}}
                    <li><strong>Cédula de Identidad:</strong> {{ $data->get('profile')->identity_card }}</li>
                    <li><strong>Fecha de Nacimiento:
                        </strong>{{ date('m-d-Y', strtotime($data->get('profile')->date_birth)) }}
                    </li>
                    <li><strong>Fecha de Vocación: </strong>
                        {{ date('m-d-Y', strtotime($data->get('profile')->date_vocation)) }}</li>
                    <li><strong>Fecha de Adesión: </strong>
                        {{ date('m-d-Y', strtotime($data->get('profile')->date_admission)) }}</li>
                    <li><strong>Celular: </strong>{{ $data->get('profile')->cellphone }}</li>
                    <li><strong>Teléfono: </strong>{{ $data->get('profile')->phone }}</li>
                    <li><strong>Correo electrónico: </strong>
                        <p style="color: rgb(44, 47, 226);"> {{ $data->get('profile')->user->email }} </p>
                    </li>


                </ul>
            </div>
            <div class="column" style="background-color:rgb(255, 255, 255); width: 30%;">
                @if ($data->get('image'))
                    <img style="  border-radius: 10%; margin-left: 20px; margin-top: 25px;"
                        src="{{ $data->get('image') }}" alt="" width="140" height="220">
                @else
                    <img src="https://www.daughtersofcharity.com/wp-content/uploads/2021/05/DOC-SEAS-Logo-footer-236x300.png"
                        alt="" width="170" height="270" style=" border-radius:
                        10%; margin-left: 20px; margin-top: 25px; margin-bottom: 5px;">
                @endif
            </div>
        </div>
        <hr>
        {{-- Address --}}
        <strong>Dirección: </strong>
        <p class="main">
            {{ $data->get('profile')->address->address }}.
            ({{ $data->get('address')['data_province'] }} -
            {{ $data->get('address')['data_canton'] }},
            {{ $data->get('address')['data_parish'] }}).
        </p>
        {{-- End Adress --}}
        <strong>Observaciones: </strong>
        {!! $data->get('profile')->observation !!}
        {{-- End Profile --}}

        <hr>

        {{-- Info Family --}}
        @if ($data->get('info_family'))
            <div style="margin-bottom:10px;">
                <strong>Información de Contacto: </strong>
            </div>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th style="font-size:14px;">
                            Nombres Padre
                        </th>
                        <th style="font-size:14px;">
                            Nombres Madre
                        </th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td style="font-size:13px;">{{ $data->get('info_family')->names_father }}</td>

                        <td style="font-size:13px;">{{ $data->get('info_family')->names_mother }}</td>
                    </tr>
                </tbody>

                <thead>
                    <tr style="height: 15px;">
                        <th style="font-size:14px;">
                            Número de Hermanos
                        </th>
                        <th style="font-size:14px;">
                            Número de Hermanas
                        </th>
                        <th style="font-size:14px;">
                            Lugar en la Familia
                        </th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td style="font-size:13px;">{{ $data->get('info_family')->nr_sisters }}</td>
                        <td style="font-size:13px;">{{ $data->get('info_family')->nr_brothers }}</td>
                        <td style="font-size:13px;">{{ $data->get('info_family')->place_of_family }}</td>
                    </tr>
                </tbody>

            </table>
            {{-- Info Break --}}
            @if ($data->get('info_family')->info_family_break)
                <div style="margin-bottom:10px;">
                    <strong>Información de Contacto en donde la hermana hace sus días de descanso: </strong>
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr style="height: 15px;">
                            <th style="font-size:14px;">
                                Nombres Completos del Familiar
                            </th>
                            <th style="font-size:14px;">
                                Parentesco con el Familiar
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td style="font-size:13px;">
                                {{ $data->get('info_family')->info_family_break->name_family_member }}</td>
                            <td style="font-size:13px;">{{ $data->get('info_family')->info_family_break->relation }}
                            </td>
                        </tr>
                    </tbody>

                    <thead>
                        <tr style="height: 15px;">
                            <th style="font-size:14px;">
                                Celular
                            </th>
                            <th style="font-size:14px;">
                                Teléfono
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td style="font-size:13px;">{{ $data->get('info_family')->info_family_break->cellphone }}
                            </td>
                            <td style="font-size:13px;">{{ $data->get('info_family')->info_family_break->phone }}
                            </td>
                        </tr>
                    </tbody>
                    {{-- Info Break --}}

                    {{-- End Info Break --}}
                </table>
            @endif
            {{-- End Info Break --}}
        @endif
        {{-- End Info Family --}}


    </main>

    <footer>
        <p
            style="font-size:12px; margin-left:0.40cm;  margin-right:0.40cm; margin-bottom:0.20cm; margin-top:0.20cm; color:#111631">
            Fecha Impresión: {{ date('m-d-Y h:i:s a', time()) }}. Pichincha,
            Ecuador.
            Este documento fue generado en la plataforma privada de la
            Compañía Hijas de la Caridad de San Vicente de Paúl ©, Provincia Ecuador.
        </p>
    </footer>

</body>

</html>
