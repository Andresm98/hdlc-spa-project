<!DOCTYPE html>
<html lang="en">

<head>

    <head>
        <meta charset="UTF-8">
        <title>Reporte Comunidad {{ $data->get('community')->comm_name }}</title>
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
                height: 2.4cm;
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
                <div style="float: left;width: 90%; height: 30px;">
                    <p style="font-size:medium; margin-top:0.5cm;">
                        Compañía Hijas de la Caridad de San Vicente de Paúl
                    <p>Reporte de Comunidad</p>
                    </p>
                </div>
                <div style="float: left;width: 10%; height: 30px;">
                    <p style="font-size:medium; margin-right:2.5cm; margin-bottom:2.0cm;">
                        <img height="60px" width="100px"
                            src="https://files-hdlc-frontend.s3.amazonaws.com/icon_hdlc.png" />
                    </p>
                </div>
            </div>
        </div>
    </header>

    <main>
        {{-- Profile --}}
        <div class="">

            <ul>
                {{-- User --}}
                <li style="margin-top:10px; font-size: small;"><strong>Nombre Comunidad:</strong>
                    {{ $data->get('community')->comm_name }} </li>

                {{-- Profile --}}
                <li style="font-size: small;"><strong>RUC Representante:</strong>
                    {{ $data->get('community')->comm_identity_card }}</li>
                <li style="font-size: small;"><strong>Fecha de Fundación: </strong>
                    {{ date('Y-m-d', strtotime($data->get('community')->date_fndt_comm)) }}</li>
                @if ($data->get('community')->date_fndt_work)
                    <li style="font-size: small;"><strong>Fecha de la Obra: </strong>
                        {{ date('Y-m-d', strtotime($data->get('community')->date_fndt_work)) }}</li>
                @endif
                @if ($data->get('community')->date_close != null)
                    <li style="font-size: small;"><strong>Fecha de Cierre: </strong>
                        {{ date('Y-m-d', strtotime($data->get('community')->date_close)) }}</li>
                @endif
                @if ($data->get('community')->zone != null)
                    <li style="font-size: small;"><strong>Zona: </strong>
                        {{ $data->get('community')->zone->name }}</li>
                @endif
                @if ($data->get('community')->pastoral != null)
                    <li style="font-size: small;"><strong>Pastoral: </strong>
                        {{ $data->get('community')->pastoral->name }}</li>
                @endif
                @if ($data->get('community')->comm_phone != null)
                    <li style="font-size: small;"><strong>Teléfono:
                        </strong>{{ $data->get('community')->comm_phone }}
                    </li>
                @endif
                <li style="font-size: small;"><strong>Celular: </strong>{{ $data->get('community')->comm_cellphone }}
                </li>
                <li style="font-size: small;"><strong>Nro. de Colaboradores:</strong>
                    {{ $data->get('community')->rn_collaborators }}</li>
                <li style="font-size: small;">
                    <strong>Dirección: </strong>
                    {{ $data->get('community')->address->address }}.
                    ({{ $data->get('address')['data_province'] }} -
                    {{ $data->get('address')['data_canton'] }},
                    {{ $data->get('address')['data_parish'] }}).
                </li>
                <li style="font-size: small;"><strong>Correo electrónico: </strong>
                    {{ $data->get('community')->comm_email }}
                </li>
            </ul>
        </div>
        <hr>
        <div style="font-size: small;">
            @if (null !== $data->get('daughters'))
                @if (count($data->get('daughters')) != 0)
                    <strong>Hermanas ({{ count($data->get('daughters')) }}): </strong> En la presente lista se
                    encuentran
                    todas las hermanas que están en la comunidad. Tenga en cuenta que se muestran los detalles de cada
                    hermana y el cargo que ocupa.<br><br>
                    <table>
                        <tr>
                            <th>Nro</th>
                            <th>Hermana</th>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>Ocupación</th>
                        </tr>
                        {{ $count = 1 }}
                        @foreach ($data->get('daughters') as $daughter)
                            <tr>
                                <td>{{ $count++ }}</td>
                                <td> {{ $daughter->profile->user->fullnamecomm }} </td>
                                <td> {{ $daughter->profile->user->name }} </td>
                                <td> {{ $daughter->profile->user->lastname }} </td>
                                @if ($daughter->appointments != null)
                                    <td>
                                        @foreach ($daughter->appointments as $appointment)
                                            {{ $appointment->appointment_level->name }}
                                        @endforeach
                                    </td>
                                @else
                                    <td>Vacío</td>
                                @endif
                            </tr>
                        @endforeach
                    </table>
                    <hr>
                @endif
            @endif


            @if (null !== $data->get('activities'))
                @if (count($data->get('activities')) != 0)
                    <strong style="margin-bottom: 10px;">Actividades: </strong> En la presente lista se encuentran
                    todas las actividades que se han realizado en la comunidad en el presente año.
                    <br>
                    <br>
                    <div id="activities">
                        @foreach ($data->get('activities') as $activity)
                            <div class="a">
                                <ul style="border:1px solid black;">
                                    <li style="margin-right: 10px"><strong>Nombre de Actividad:
                                        </strong>{!! $activity->comm_name_activity !!} </li>
                                    <li style="margin-right: 10px"><strong>Hermanas - Beneficiarios - Colaboradores:
                                        </strong>({{ $activity->comm_nr_daughters }}) -
                                        ({{ $activity->comm_nr_beneficiaries }})
                                        -
                                        ({{ $activity->comm_nr_collaborators }}).
                                    </li>
                                    <li style="margin-right: 10px"><strong>Fecha Actividad:
                                        </strong>{{ date('y-m-d', strtotime($activity->comm_date_activity)) }}
                                    </li>
                                    <li style="margin-right: 10px"><strong>Observaciones:
                                        </strong>{!! $activity->comm_description_activity !!}
                                    </li>
                                </ul>
                            </div>
                        @endforeach
                    </div>
                    <hr>
                @endif
            @endif

            @if (null !== $data->get('resumes'))
                @if (count($data->get('resumes')) != 0)
                    <strong style="margin-bottom: 10px;">Resumen Anual: </strong> En el presente registro se encuentra
                    el resumen anual de todo aquello que se ha realizado en la comunidad a lo largo del presente año.
                    <br>
                    <br>
                    <div id="resumes">
                        @foreach ($data->get('resumes') as $resume)
                            <div class="a">
                                <ul style="border:1px solid black;">
                                    <li style="margin-right: 10px"><strong>Nombre del Resumen:
                                        </strong>{!! $resume->comm_name_resume !!} </li>
                                    <li style="margin-right: 10px"><strong>Anexos:
                                        </strong>{{ $resume->comm_annexed_resume }}.
                                    </li>
                                    <li style="margin-right: 10px"><strong>Fecha Resumen:
                                        </strong>{{ date('y-m-d', strtotime($resume->comm_date_resume)) }}
                                    </li>
                                    <li style="margin-right: 10px"><strong>Observaciones:
                                        </strong>{!! $resume->comm_observation_resume !!}
                                    </li>
                                </ul>
                            </div>
                        @endforeach
                    </div>
                    <hr>
                @endif
            @endif

            @if (null !== $data->get('visits'))
                @if (count($data->get('visits')) != 0)
                    <strong style="margin-bottom: 10px;">Visitas Anuales: </strong> En el presente registro se encuentra
                    la lista de las visitas que se han realizado a la comunidad a lo largo del año.
                    <br>
                    <br>
                    <div id="visits">
                        @foreach ($data->get('visits') as $visit)
                            <div class="a">
                                <ul style="border:1px solid black;">
                                    <li style="margin-right: 10px"><strong>Razón de la Visita:
                                        </strong>{{ $visit->comm_reason_visit }} </li>
                                    <li style="margin-right: 10px"><strong>Tipo de Visita:
                                        </strong>
                                        @if ($visit->comm_type_visit == 1)
                                            Fraterna
                                        @elseif($visit->comm_type_visit == 2)
                                            Regular
                                        @elseif($visit->comm_type_visit == 3)
                                            Pastoral
                                        @endif
                                    </li>
                                    <li style="margin-right: 10px"><strong>Fecha Inicio:
                                        </strong>{{ date('y-m-d', strtotime($visit->comm_date_init_visit)) }}
                                    </li>
                                    <li style="margin-right: 10px"><strong>Fecha Fin:</strong>
                                        {{ date('y-m-d', strtotime($visit->comm_date_end_visit)) }}
                                    </li>
                                    <li style="margin-right: 10px"><strong>Observaciones:
                                        </strong>{!! $visit->comm_description_visit !!}
                                    </li>
                                </ul>
                            </div>
                        @endforeach
                    </div>
                    <hr>
                @endif
            @endif
            <?php
            use App\Http\Controllers\Secretary\Community\CommunityDaughterController;
            ?>
            @if (null !== $data->get('works'))
                @if (count($data->get('works')) != 0)
                    <strong style="margin-bottom: 10px;">Obras: </strong> En la presente lista se encuentra los
                    registros de todas aquellas obras que pertenecen a la comunidad. Tenga en cuenta que en la presente
                    lista solamente se muestran las obras abiertas.
                    <br>
                    <br>

                    <div id="works">
                        @foreach ($data->get('works') as $work)
                            <div class="a">
                                <ul>
                                    {{-- User --}}
                                    <li style="margin-top:10px; font-size: small;"><strong>Nombre Obra:</strong>
                                        {{ $work->comm_name }} </li>


                                    <li style="font-size: small;"><strong>RUC Representante:</strong>
                                        {{ $work->comm_identity_card }}</li>
                                    <li style="font-size: small;"><strong>Fecha de Fundación: </strong>
                                        {{ date('Y-m-d', strtotime($work->date_fndt_comm)) }}</li>
                                    @if ($work->date_fndt_work)
                                        <li style="font-size: small;"><strong>Fecha de la Obra: </strong>
                                            {{ date('Y-m-d', strtotime($work->date_fndt_work)) }}
                                        </li>
                                    @endif
                                    @if ($work->date_close != null)
                                        <li style="font-size: small;"><strong>Fecha de Cierre: </strong>
                                            {{ date('Y-m-d', strtotime($work->date_close)) }}</li>
                                    @endif
                                    @if ($work->name_pastoral != null)
                                        <li style="font-size: small;"><strong>Pastoral: </strong>
                                            {{ $work->name_pastoral }}</li>
                                    @endif
                                    @if ($work->comm_phone != null)
                                        <li style="font-size: small;"><strong>Teléfono:
                                            </strong>{{ $work->comm_phone }}
                                        </li>
                                    @endif
                                    <li style="font-size: small;"><strong>Celular:
                                        </strong>{{ $work->comm_cellphone }}
                                    </li>
                                    <li style="font-size: small;"><strong>Nro. de Colaboradores:</strong>
                                        {{ $work->rn_collaborators }}</li>
                                    {{-- <li style="font-size: small;">
                                        <strong>Dirección: </strong>
                                        {{ $work->address->address }}.
                                        ({{ $data->get('address')['data_province'] }} -
                                        {{ $data->get('address')['data_canton'] }},
                                        {{ $data->get('address')['data_parish'] }})
                                        .
                                    </li> --}}
                                    <li style="font-size: small;"><strong>Correo electrónico: </strong>
                                        {{ $data->get('community')->comm_email }}
                                    </li>
                                    <?php
                                    $listDaughters = CommunityDaughterController::indexStatic($work->id);
                                    ?>
                                    @if (count($listDaughters) != 0)
                                        <li>
                                            <strong>Hermanas ({{ count($listDaughters) }}):</strong> En la presente
                                            lista se encuentran todas las hermanas que están en la obra. Tenga en cuenta
                                            que se muestran los detalles de cada hermana y el cargo que ocupa.<br><br>
                                            <table>
                                                <tr>
                                                    <th>Nro</th>
                                                    <th>Hermana</th>
                                                    <th>Nombres</th>
                                                    <th>Apellidos</th>
                                                    <th>Ocupación</th>
                                                </tr>
                                                {{ $count = 1 }}
                                                @foreach ($listDaughters as $daughter)
                                                    <tr>
                                                        <td>{{ $count++ }}</td>
                                                        <td> {{ $daughter->profile->user->fullnamecomm }} </td>
                                                        <td> {{ $daughter->profile->user->name }} </td>
                                                        <td> {{ $daughter->profile->user->lastname }} </td>
                                                        @if ($daughter->appointments != null)
                                                            <td>
                                                                @foreach ($daughter->appointments as $appointment)
                                                                    @if ($appointment->status == 1)
                                                                        {{ $appointment->appointment_level->name }}
                                                                    @endif
                                                                @endforeach
                                                            </td>
                                                        @else
                                                            <td>Vacío</td>
                                                        @endif
                                                    </tr>
                                                @endforeach
                                            </table>
                                        </li>
                                        <br>
                                    @endif
                                </ul>
                            </div>
                        @endforeach
                    </div>
                    <hr>
                @endif
            @endif

            @if (null !== $data->get('inventory'))
                <strong style="margin-bottom: 10px;">Inventario: </strong>
                <ul>
                    <li style="margin-top:10px; font-size: small;"><strong>Nombre Inventario:</strong>
                        {{ $data->get('inventory')->name }} </li>
                    <li style="font-size: small;"><strong>Descripción:</strong>
                        {!! $data->get('inventory')->description !!}</li>
                </ul>
                @if (null !== $data->get('sections'))
                    @if (count($data->get('sections')) != 0)
                        <strong style="margin-bottom: 10px;">Secciones: </strong> En el presente registro se
                        encuentra la lista de secciones pertenecientes al inventario de la comunidad.
                        <br>
                        <br>
                        <div id="sections">

                            <table>
                                <tr>
                                    <th>Nro</th>
                                    <th>Nombre Sección</th>
                                    <th>Número de Artículos</th>
                                </tr>
                                {{ $count = 1 }}
                                @foreach ($data->get('sections') as $section)
                                    <tr>
                                        <td>{{ $count++ }}</td>
                                        <td> {{ $section->name }} </td>
                                        <td>{{ count($section->articles) }} </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                        <hr>
                    @endif
                @endif
            @endif
        </div>

    </main>

    <footer>

    </footer>

</body>

</html>
