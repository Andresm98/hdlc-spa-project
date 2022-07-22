<!DOCTYPE html>
<html lang="en">

<head>

    <head>
        <meta charset="UTF-8">
        <title>Reporte Hermana {{ $data->get('profile')->user->name }}</title>
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
            td {
                height: 40px;
                border: 1px solid black;
                font-size: 12px;
                padding-left: 15px;
            }

            ,
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
                </div>
            </div>
        </div>

    </header>

    <main>

        <div style=" margin-block-start: 0.2cm; color: #000000">
            <div>
                <div style="float: left;width: 70%; height: 30px;">
                    <div style="text-align: center">
                        <p style="font-size:medium;">
                            Formulario de Datos Personales, Familiares y Comunitarios de Hermanas
                        </p>
                        <small>Provincia Ecuador</small>
                    </div>
                </div>
                <div style="float: left;width: 30%; height: 30px;">
                    @if ($data->get('image'))
                        <img style="  border-radius: 10%; margin-left: 20px; margin-top: 25px;"
                            src="{{ $data->get('image') }}" alt="" width="140" height="180">
                    @else
                        <img src="https://files-hdlc-frontend.s3.amazonaws.com/logo_daughter.png" alt=""
                            width="170" height="220"
                            style=" border-radius:
                            10%; margin-left: 20px; margin-top: 25px; margin-bottom: 5px;">
                    @endif
                </div>
            </div>
        </div>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <div style="font-size: small; margin-top:15px;">
            <div style="text-align: center; margin-top:5px; margin-bottom:5px;">
                <small>INFORMACIÓN PERSONAL</small>
            </div>
            <table>
                <tr>
                    <th>APELLIDOS</th>
                    <th>NOMBRES</th>
                    <th>COMUNIDAD ACTUAL</th>
                </tr>
                <tr>
                    <td width="33.33%" height="50px">{{ $data->get('profile')->user->name }}</td>
                    <td width="33.33%" height="50px">{{ $data->get('profile')->user->lastname }}</td>
                    <td width="33.33%" height="50px">
                        @if (null !== $data->get('transfer'))
                            {{ $data->get('transfer')->community->comm_name }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>AÑOS DE VOCACIÓN</th>
                    <th>OFICIO QUE DESEMPEÑA</th>
                    <th>En el Consejo Doméstico que función desempeña</th>
                </tr>
                <tr>
                    <td width="33.33%" height="50px">
                        <?php
                        // Declare and define two dates
                        $date1 = strtotime($data->get('profile')->date_vocation);
                        $date2 = strtotime('now');

                        // Formulate the Difference between two dates
                        $diff = abs($date2 - $date1);

                        // To get the year divide the resultant date into
                        // total seconds in a year (365*60*60*24)
                        $years = floor($diff / (365 * 60 * 60 * 24));

                        ?>
                        {{ $years }}
                    </td>
                    <td width="33.33%" height="50px">
                        @if (null !== $data->get('appointments'))
                            @if (count($data->get('appointments')) != 0)
                                <div id="appointments">
                                    @foreach ($data->get('appointments') as $appointments)
                                        {{ $appointments->appointment_level->name }}
                                    @endforeach
                                </div>
                            @endif
                        @endif
                    </td>
                    <td width="33.33%" height="50px">
                    </td>
                </tr>
                <tr>
                    <th>Cédula de Identidad</th>
                    <th>Carnet IESS Nro.</th>
                    <th>LICENCIA DE CONDUCIR.</th>
                </tr>
                <tr>
                    <td width="33.33%" height="50px">
                        {{ $data->get('profile')->identity_card }}
                    </td>
                    <td width="33.33%" height="50px">
                        {{ $data->get('profile')->iess_card }}
                    </td>
                    <td width="33.33%" height="50px">
                        {{ $data->get('profile')->driver_license }}
                    </td>
                </tr>

                <tr>
                    <th>SALUD</th>
                    <th>ENFERMEDADES CRÓNICAS</th>
                    <th>OTROS PROBLEMAS DE SALUD</th>
                </tr>
                <tr>
                    <td width="33.33%" height="50px">
                        @if (null !== $data->get('healths'))
                            {!! $data->get('healths')->actual_health !!}
                        @endif
                    </td>
                    <td width="33.33%" height="50px">
                        @if (null !== $data->get('healths'))
                            {!! $data->get('healths')->chronic_diseases !!}
                        @endif
                    </td>
                    <td width="33.33%" height="50px">
                        @if (null !== $data->get('healths'))
                            {!! $data->get('healths')->other_health_problems !!}
                        @endif
                    </td>
                </tr>
            </table>
        </div>

        <div style="font-size: small; margin-top:15px;">
            <div style="text-align: center; margin-top:5px; margin-bottom:5px;">
                <small>INFORMACIÓN FAMILIAR</small>
            </div>
            <table>
                <tr>
                    <th>NOMBRES Y APELLIDOS DEL PADRE</th>
                    <th>NOMBRES Y APELLIDOS DE LA MADRE</th>
                    <th>Nro. de Hermanos incluido usted</th>
                    <th>Nro. de Hermanos</th>
                    <th>Lugar que ocupa en la familia</th>
                </tr>
                <tr>
                    <td width="35%" height="50px">
                        @if ($data->get('info_family'))
                            {{ $data->get('info_family')->names_father }}
                        @endif
                    </td>
                    <td width="35%" height="50px">
                        @if ($data->get('info_family'))
                            {{ $data->get('info_family')->names_mother }}
                        @endif
                    </td>
                    <td width="10%" height="50px">
                        @if ($data->get('info_family'))
                            {{ $data->get('info_family')->nr_sisters }}
                        @endif
                    </td>
                    <td width="10%" height="50px">
                        @if ($data->get('info_family'))
                            {{ $data->get('info_family')->nr_brothers }}
                        @endif
                    </td>
                    <td width="10%" height="50px">
                        @if ($data->get('info_family'))
                            {{ $data->get('info_family')->place_of_family }}
                        @endif
                    </td>
                </tr>

                <tr>
                    <th>EN CASO DE EMERGENCIA COMUNICARSE CON:</th>
                    <th>Dirección</th>
                    <th>Relación</th>
                    <th>Teléfono Convencional</th>
                    <th>Teléfono Celular</th>
                </tr>
                <tr>
                    <td width="35%" height="50px">
                        @if ($data->get('info_family'))
                            {{ $data->get('info_family')->info_family_break->name_family_member }}
                        @endif
                    </td>
                    <td width="35%" height="50px">

                    </td>
                    <td width="10%" height="50px">
                        @if ($data->get('info_family'))
                            {{ $data->get('info_family')->info_family_break->relation }}
                        @endif
                    </td>
                    <td width="10%" height="50px">
                        @if ($data->get('info_family'))
                            {{ $data->get('info_family')->info_family_break->phone }}
                        @endif
                    </td>
                    <td width="10%" height="50px">
                        @if ($data->get('info_family'))
                            {{ $data->get('info_family')->info_family_break->cellphone }}
                        @endif
                    </td>
                </tr>
            </table>
        </div>


        @if (null !== $data->get('academic_trainings'))
            @if (count($data->get('academic_trainings')) != 0)
                <div style="font-size: small; margin-top:15px;">
                    <div style="text-align: center; margin-top:5px; margin-bottom:5px;">
                        <small>INFORMACIÓN ACADÉMICA</small>
                    </div>
                    <table>
                        <tr>
                            <th>TÍTULOS OBTENIDOS:</th>
                            <th>CENTRO DE ESTUDIOS</th>
                            <th>NIVEL ACADÉMICO</th>
                        </tr>
                        @foreach ($data->get('academic_trainings') as $academic)
                            <tr>
                                <td>
                                    {!! $academic->name_title !!}
                                </td>
                                <td>
                                    {!! $academic->institution !!}
                                </td>
                                <td>
                                    {!! $academic->observation !!}
                                </td>
                            </tr>
                        @endforeach



                    </table>
                </div>
            @endif
        @endif

        @if (null !== $data->get('sacraments'))
            @if (count($data->get('sacraments')) != 0)
                <div style="font-size: small; margin-top:15px;">
                    <div style="text-align: center; margin-top:5px; margin-bottom:5px;">
                        <small>SACRAMENTOS</small>
                    </div>
                    <table>
                        <tr>
                            <th>SACRAMENTO</th>
                            <th>FECHA</th>
                            <th>OBSERVACIONES</th>
                        </tr>

                        @foreach ($data->get('sacraments') as $sacrament)
                            <tr>
                                <td>
                                    {!! $sacrament->sacrament_name !!}
                                </td>
                                <td>
                                    {{ date('Y-m-d', strtotime($sacrament->sacrament_date)) }}
                                </td>
                                <td>
                                    {!! $sacrament->observation !!}
                                </td>
                            </tr>
                        @endforeach

                    </table>
                </div>
            @endif
        @endif

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
