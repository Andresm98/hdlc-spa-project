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
                    <p style="font-size:medium;">
                        Compañía Hijas de la Caridad de San Vicente de Paúl ©
                    </p>
                    <small>Perfil de Hermana; Provincia Ecuador</small>
                </div>

            </div>
        </div>

    </header>

    <main>
        {{-- Profile --}}
        <div class="row">
            <div class="column" style="background-color:rgb(255, 255, 255); width: 70%;">
                <ul>
                    {{-- User --}}
                    <li style="margin-top:10px; font-size: small;"><strong>Nombres y Apellidos:</strong>
                        {{ $data->get('profile')->user->name }}
                        {{ $data->get('profile')->user->lastname }}</li>

                    {{-- Profile --}}
                    <li style="font-size: small;"><strong>Cédula de Identidad:</strong>
                        {{ $data->get('profile')->identity_card }}</li>
                    <li style="font-size: small;"><strong>Fecha de Nacimiento:
                        </strong>{{ date('Y-m-d', strtotime($data->get('profile')->date_birth)) }}
                    </li>
                    <li style="font-size: small;"><strong>Fecha de Vocación: </strong>
                        {{ date('Y-m-d', strtotime($data->get('profile')->date_vocation)) }}</li>
                    <li style="font-size: small;"><strong>Fecha de Admisión: </strong>
                        {{ date('Y-m-d', strtotime($data->get('profile')->date_admission)) }}</li>
                    @if ($data->get('profile')->date_death != null)
                        <li style="font-size: small;"><strong>Fecha de Muerte: </strong>
                            {{ date('Y-m-d', strtotime($data->get('profile')->date_death)) }}</li>
                    @endif
                    @if ($data->get('profile')->date_exit != null)
                        <li style="font-size: small;"><strong>Fecha de Salida: </strong>
                            {{ date('Y-m-d', strtotime($data->get('profile')->date_exit)) }}</li>
                    @endif
                    <li style="font-size: small;"><strong>Celular: </strong>{{ $data->get('profile')->cellphone }}
                    </li>
                    @if ($data->get('profile')->phone != null)
                        <li style="font-size: small;"><strong>Teléfono: </strong>{{ $data->get('profile')->phone }}
                        </li>
                    @endif
                    <li style="font-size: small;"><strong>Correo electrónico: </strong>
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
                        alt="" width="170" height="270"
                        style=" border-radius:
                        10%; margin-left: 20px; margin-top: 25px; margin-bottom: 5px;">
                @endif
            </div>
        </div>
        <hr>
        {{-- Address --}}
        <div style="font-size: small;">
            <strong>Dirección: </strong>
            <p class="main">
                {{ $data->get('profile')->address->address }}.
                ({{ $data->get('address')['data_province'] }} -
                {{ $data->get('address')['data_canton'] }},
                {{ $data->get('address')['data_parish'] }}).
            </p>
            {{-- End Adress --}}
            <strong>Observaciones: </strong>
            <div class="a">
                {!! $data->get('profile')->observation !!}
            </div>
            {{-- End Profile --}}
            <hr>

            {{-- Info Family --}}
            @if ($data->get('info_family'))
                <div style="margin-bottom:5px;">
                    <strong>Información Familiar: </strong>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>
                                Nombres Padre
                            </th>
                            <th>
                                Nombres Madre
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $data->get('info_family')->names_father }}</td>
                            <td>{{ $data->get('info_family')->names_mother }}</td>
                        </tr>
                    </tbody>

                </table>
                <table>
                    <thead>
                        <tr>
                            <th>
                                Número de Hermanos
                            </th>
                            <th>
                                Número de Hermanas
                            </th>
                            <th>
                                Lugar en la Familia
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>{{ $data->get('info_family')->nr_sisters }}</td>
                            <td>{{ $data->get('info_family')->nr_brothers }}</td>
                            <td>{{ $data->get('info_family')->place_of_family }}</td>
                        </tr>
                    </tbody>

                </table>
                {{-- Info Break --}}
                @if ($data->get('info_family')->info_family_break)
                    <div style="margin-bottom:10px;">
                        <strong>Información de Contacto en donde la hermana hace sus días de descanso: </strong>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>
                                    Nombres Completos del Familiar
                                </th>
                                <th>
                                    Parentesco con el Familiar
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    {{ $data->get('info_family')->info_family_break->name_family_member }}</td>
                                <td>
                                    {{ $data->get('info_family')->info_family_break->relation }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table>
                        <thead>
                            <tr>
                                <th>
                                    Número de Celular
                                </th>
                                <th>
                                    Número de Teléfono
                                </th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>
                                    {{ $data->get('info_family')->info_family_break->cellphone }}
                                </td>
                                <td>{{ $data->get('info_family')->info_family_break->phone }}
                                </td>
                            </tr>
                        </tbody>
                        {{-- Info Break --}}

                        {{-- End Info Break --}}
                    </table>
                @endif
                {{-- End Info Break --}}
                <hr>
            @endif
            {{-- End Info Family --}}

            {{-- Sacraments --}}
            @if (null !== $data->get('sacraments'))
                @if (count($data->get('sacraments')) != 0)
                    <strong style="margin-bottom: 10px;">Sacramentos: </strong> En la presente lista se encuentran
                    todos los sacramentos realizados por la hermana.
                    <br>
                    <br>
                    <div id="academic_trainings">
                        @foreach ($data->get('sacraments') as $sacrament)
                            <div class="a">
                                <ul style="border: 1px solid black;">
                                    <li style="margin-right: 10px"><strong>Nombre del Sacramento:
                                        </strong>{!! $sacrament->sacrament_name !!} </li>
                                    <li style="margin-right: 10px"><strong>Institución: </strong>{!! $sacrament->institution !!}
                                    </li>
                                    <li style="margin-right: 10px"><strong>Observaciones:
                                        </strong>{!! $sacrament->observation !!}
                                    </li>
                                    <li style="margin-right: 10px"><strong>Fecha:
                                        </strong>{{ date('y-m-d', strtotime($sacrament->sacrament_date)) }}
                                    </li>
                                </ul>
                            </div>
                        @endforeach
                    </div>
                    <hr>
                @endif
            @endif
            {{-- End Sacraments --}}

            {{-- Academic Training --}}
            @if (null !== $data->get('academic_trainings'))
                @if (count($data->get('academic_trainings')) != 0)
                    <strong style="margin-bottom: 10px;">Récord Académico: </strong> En la presente lista se encuentran
                    todos los registros relacionados al récord académico de la hermana.
                    <br>
                    <br>
                    <div id="academic_trainings">
                        @foreach ($data->get('academic_trainings') as $academic)
                            <div class="a">
                                <ul style="border:1px solid black;">
                                    <li style="margin-right: 10px"><strong>Nombre del Título:
                                        </strong>{!! $academic->name_title !!} </li>
                                    <li style="margin-right: 10px"><strong>Institución: </strong>{!! $academic->institution !!}
                                    </li>
                                    <li style="margin-right: 10px"><strong>Observaciones:
                                        </strong>{!! $academic->observation !!}
                                    </li>
                                    <li style="margin-right: 10px"><strong>Fecha:
                                        </strong>{{ date('y-m-d', strtotime($academic->date_title)) }}
                                    </li>
                                </ul>
                            </div>
                        @endforeach
                    </div>
                    <hr>
                @endif
            @endif
            {{-- End Academic Training --}}

            {{-- Health Status --}}
            @if (null !== $data->get('healths'))
                @if (count($data->get('healths')) != 0)
                    <strong style="margin-bottom: 10px;">Estados de Salud Actual: </strong> En la presente lista se
                    encuentran todos los registros relacionados al historial de los estados de salud de la hermana,
                    tenga en
                    cuenta que en esta lista solamente serán mostrados los registros del año en curso.
                    <br>
                    <br>
                    <div id="healths">
                        @foreach ($data->get('healths') as $health)
                            <div class="a">
                                <ul style="border: 1px solid black;">
                                    <li style="margin-right: 10px"><strong>Estado de salud:
                                        </strong>{!! $health->actual_health !!}
                                    </li>
                                    <li style="margin-right: 10px"><strong>Enfermedades crónicas:
                                        </strong>{!! $health->chronic_diseases !!} </li>
                                    <li style="margin-right: 10px"><strong>Otros problemas de salud:
                                        </strong>{!! $health->other_health_problems !!} </li>
                                    <li style="margin-right: 10px"><strong>Fecha:
                                        </strong>{{ date('y-m-d', strtotime($health->consult_date)) }}
                                    </li>
                                    {{-- <li>
                                <ul>
                                    <li>{{ $health->actual_health }}</li>
                                    <li>Feature 2</li>
                                    <li>Feature 3</li>
                                </ul>
                            </li> --}}
                                </ul>
                            </div>
                        @endforeach
                    </div>
                    <hr>
                @endif
            @endif
            {{-- End Health Status --}}

            {{-- Permits --}}
            <?php
            use App\Http\Controllers\AddressController;
            ?>

            @if (null !== $data->get('permits'))
                @if (count($data->get('permits')) != 0)
                    <strong style="margin-bottom: 10px;">Permisos </strong> En la presente lista se emcuentran los
                    permisos que han sido solicitados por la hermana el presente año.
                    <br>
                    <br>
                    <div id="permits">
                        @foreach ($data->get('permits') as $permits)
                            <div class="a">
                                <ul style="border: 1px solid black;">
                                    <li style="margin-right: 10px"><strong>Razón del Permiso:
                                        </strong>{!! $permits->reason !!}
                                    </li>
                                    <li style="margin-right: 10px"><strong>Descripción del permiso:
                                        </strong>{!! $permits->description !!} </li>
                                    <li style="margin-right: 10px"><strong>Dirección:
                                        </strong>{!! $permits->address->address !!},
                                        {{ AddressController::showActualAddress($permits->address->political_division_id) }}.
                                    </li>
                                    <li style="margin-right: 10px"><strong>Fecha de Consejo Provincial:
                                        </strong>{{ date('y-m-d', strtotime($permits->date_province)) }}
                                    </li>
                                    <li style="margin-right: 10px"><strong>Fecha de Consejo General:
                                        </strong>{{ date('y-m-d', strtotime($permits->date_general)) }}
                                    </li>
                                    <li style="margin-right: 10px"><strong>Fecha de Salida:
                                        </strong>{{ date('y-m-d', strtotime($permits->date_out)) }}
                                    </li>
                                    <li style="margin-right: 10px"><strong>Fecha de Regreso:
                                        </strong>{{ date('y-m-d', strtotime($permits->date_in)) }}
                                    </li>
                                </ul>
                            </div>
                        @endforeach
                    </div>
                    <hr>
                @endif
            @endif
            {{-- End Permits --}}

            {{-- Transfer --}}
            @if (null !== $data->get('transfer'))
                <strong style="margin-bottom: 10px;">Cambio Vigente: </strong> En la presente ficha se encuentra
                el último cambio que realizó la hermana; en dicho apartado se encuentran la comunidad de destino y los
                datos
                correspondientes al cambio.
                <br>
                <br>
                <div class="a">
                    <ul>
                        <li style="margin-right: 10px"><strong>Razón del cambio:
                            </strong> {{ $data->get('transfer')->transfer_reason }}.
                        </li>
                        <li style="margin-right: 10px"><strong>Fecha de admisión:
                            </strong>{{ date('y-m-d', strtotime($data->get('transfer')->transfer_date_adission)) }}.
                        </li>
                        <li style="margin-right: 10px"><strong>Comunidad de Destino:
                            </strong> {{ $data->get('transfer')->community->comm_name }}
                        </li>
                        <li style="margin-right: 10px"><strong>Observaciones:
                            </strong> {!! $data->get('transfer')->transfer_observation !!}
                        </li>
                    </ul>
                </div>
                <hr>
                {{-- End Profile --}}
            @endif
            {{-- End Transfer --}}

            {{-- Appointments --}}
            @if (null !== $data->get('appointments'))
                @if (count($data->get('appointments')) != 0)
                    <strong style="margin-bottom: 10px;">Nombramientos: </strong> En la presente lista se
                    encuentran todos los registros relacionados a los nombramientos de la transferencia actual de la
                    hermana,
                    tenga en
                    cuenta que en esta lista solamente serán mostrados los registros de la transferencia vigente.
                    <br>
                    <br>
                    <div id="appointments">
                        @foreach ($data->get('appointments') as $appointments)
                            <div class="a">
                                <ul style="border: 1px solid black;">
                                    <li style="margin-right: 10px"><strong>Nombramiento:
                                        </strong>
                                        {{ $appointments->appointment_level->name }}
                                    </li>
                                    <li style="margin-right: 10px"><strong>Estado:
                                        </strong>
                                        @if ($appointments->status == 1)
                                            Activo
                                        @elseif ($appointments->status == 0)
                                            Culminado
                                        @endif
                                    </li>
                                    <li style="margin-right: 10px"><strong>Comunidad de Destino:
                                        </strong> {{ $appointments->community->comm_name }}
                                    </li>
                                    <li style="margin-right: 10px"><strong>Fecha Inicio:
                                        </strong>{{ date('y-m-d', strtotime($appointments->date_appointment)) }}
                                    </li>
                                    @if ($appointments->date_end_appointment != null)
                                        <li style="margin-right: 10px"><strong>Fecha Culminación:
                                            </strong>{{ date('y-m-d', strtotime($appointments->date_end_appointment)) }}
                                        </li>
                                    @endif
                                    <li style="margin-right: 10px"><strong>Descripción:
                                        </strong>{!! $appointments->description !!}
                                    </li>
                                </ul>
                            </div>
                        @endforeach
                    </div>
                    <hr>
                @endif
            @endif
            {{-- End Appointments --}}


            {{-- Individual Appointments --}}
            @if (null !== $data->get('individualappointments'))
                @if (count($data->get('individualappointments')) != 0)
                    <strong style="margin-bottom: 10px;">Nombramientos Individuales: </strong> En la presente lista se
                    encuentran todos los registros relacionados a los nombramientos individuales de la
                    hermana,
                    tenga en
                    cuenta que en dichos nombramientos no estan relacionados a ninguna transferencia.
                    <br>
                    <br>
                    <div id="individualappointments">
                        @foreach ($data->get('individualappointments') as $appointments)
                            <div class="a">
                                <ul style="border: 1px solid black;">
                                    <li style="margin-right: 10px"><strong>Nombramiento:
                                        </strong>
                                        {{ $appointments->appointment_level->name }}
                                    </li>
                                    <li style="margin-right: 10px"><strong>Estado:
                                        </strong>
                                        @if ($appointments->status == 1)
                                            Activo
                                        @elseif ($appointments->status == 0)
                                            Culminado
                                        @endif
                                    </li>
                                    {{-- <li style="margin-right: 10px"><strong>Comunidad de Destino:
                                        </strong> {{ $appointments->community->comm_name }}
                                    </li> --}}
                                    <li style="margin-right: 10px"><strong>Fecha Inicio:
                                        </strong>{{ date('y-m-d', strtotime($appointments->date_appointment)) }}
                                    </li>
                                    @if ($appointments->date_end_appointment != null)
                                        <li style="margin-right: 10px"><strong>Fecha Culminación:
                                            </strong>{{ date('y-m-d', strtotime($appointments->date_end_appointment)) }}
                                        </li>
                                    @endif
                                    <li style="margin-right: 10px"><strong>Descripción:
                                        </strong>{!! $appointments->description !!}
                                    </li>
                                </ul>
                            </div>
                        @endforeach
                    </div>
                    <hr>
                @endif
            @endif
            {{-- Individual Appointments --}}

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
