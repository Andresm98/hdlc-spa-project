<!DOCTYPE html>
<html lang="en">

<head>

    <head>
        <meta charset="UTF-8">

        <title>Resumen Anual Comunidad {{ $community->comm_name }}</title>

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
                font-size: 12px;
                padding-left: 15px;
            }

            ,
            th {
                height: 20px;
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


    </header>

    <main>
        <table class="border: none" cellspacing="0" cellpadding="0">
            <tr class="border: none">
                <td class="border: none" width="67.00%" class="first" style="font-weight: bold">PROVINCIA: ECUADOR</td>
                <td class="border: none" width="33.00%" class="first" style="font-weight: bold">Fecha:
                    {{ date('d.m.Y', strtotime($resume->comm_date_resume)) }}</td>
            </tr>
            <tr class="border: none">
                <td class="border: none" class="second" colspan="2"><strong> NOMBRE DE LA COMUNIDAD: </strong>
                    {{ $community->comm_name }}</td>
            </tr>
            <tr>
                <td class="border: none" width="50.00%" class="second"><strong>Dirección Completa:</strong>
                    {{ $community->address->address }}
                </td>
                <td class="border: none" width="50.00%" class="first"><strong>Email:</strong>
                    {{ $community->comm_email }}</td>
            </tr>
        </table>
        <br>
        <br>
        <table border="1" cellspacing="0" cellpadding="0">
            <tr>
                <th width="60.00%">ACTIVIDADES DETALLADAS DE LA CASA</th>
                <th width="15.00%">Nº de Hermanas</th>
                <th width="15.00%">Nº de beneficiarios</th>
                <th width="15.00%">Nº de colaboradores laicos</th>
            </tr>

            @foreach ($activities as $activity)
                {}
                <tr>
                    <td>
                        {{ $activity->comm_name_activity }}
                    </td>
                    <td>
                        {{ $activity->comm_nr_daughters }}
                    </td>
                    <td>
                        {{ $activity->comm_nr_beneficiaries }}
                    </td>
                    <td>
                        {{ $activity->comm_nr_collaborators }}
                    </td>
                </tr>
            @endforeach
        </table>
        <br>
        <br>
        <table class="text-align: left" border="1">
            <tr class="text-align: left">
                <td class="text-align: left" width="60.00%">
                    <p style="text-align: justify; margin-right:0.40cm;">
                        <strong>
                            En caso de tener un anexo que dependa de esta Comunidad,
                            indicar dirección:
                        </strong>
                        <br>
                        {{ $resume->comm_annexed_resume }}
                    </p>
                </td>
            </tr>
            <tr class="text-align: left">
                <td class="text-align: left" width="60.00%">
                    <p style="text-align: justify; margin-right:0.40cm;">
                        <strong>
                            Observaciones (obras abiertas o cerradas) - Dificultades
                            particulares que se han presentado durante este año,etc.
                        </strong>
                        {!! $resume->comm_observation_resume !!}
                    </p>
                </td>
            </tr>
        </table>
        <br>
        <br>
        <table border="0.1" cellspacing="0" cellpadding="0">
            <tr class="text-align: left">
                <td class="text-align: left">
                    <p style="text-align: center; margin-right:0.40cm;">
                        <strong>
                            Nombre de las Hermanas que han salido de la Comunidad local durante el año
                        </strong>
                    </p>
                </td>
            </tr>
        </table>
        <table border="1" cellspacing="0" cellpadding="0">
            <tr>
                <th width="35.00%">Apellidos y Nombres</th>
                <th width="11.00%">Fecha de Nacimiento</th>
                <th width="11.00%">Fecha de Vocación</th>
                <th width="11.00%">Fecha del Cambio</th>
                <th width="20.00%">Destino (Casa y Cuidad)</th>
            </tr>

            @foreach ($exitTransfers as $exit)
                {}
                <tr>
                    <td>
                        {{ $exit->profile->user->lastname }}
                        {{ $exit->profile->user->name }}
                    </td>
                    <td>
                        {{ date('d.m.Y', strtotime($exit->profile->date_birth)) }}
                    </td>
                    <td>
                        {{ date('d.m.Y', strtotime($exit->profile->date_vocation)) }}
                    </td>
                    <td>
                        @if ($exit->profile->actual)
                            {{ date('d.m.Y', strtotime($exit->profile->actual->transfer_date_adission)) }}
                        @else
                            PENDIENTE
                        @endif
                    </td>
                    <td>
                        @if ($exit->profile->actual)
                            @if ($exit->profile->actual->community)
                                {{ $exit->profile->actual->community->comm_name }}
                            @else
                                PENDIENTE
                            @endif
                        @else
                            PENDIENTE
                        @endif
                    </td>
                </tr>
            @endforeach
        </table>


        {{-- @if (count($academicClose) > 0)
            <h4 style="text-align: center;">HERMANAS GRADUADAS AÑO
                {{ date('Y', strtotime($resume->comm_date_resume)) }}
            </h4>
            <h5 class="border: none" width="67.00%" class="second">NOMBRE DE LA CASA:
                {{ $community->comm_name }}</h5>
            <br>

            <table border="1" cellspacing="0" cellpadding="0">
                <tr>
                    <th width="50.00%">NOMBRE DE LA HERMANA</th>
                    <th width="15.00%">UNIVERSIDAD INSTITUCIÓN</th>
                    <th width="15.00%">ESPECIALIZACIÓN</th>
                    <th width="15.00%">LUGAR FECHA</th>
                </tr>
                @foreach ($academicClose as $close)
                    {}
                    <tr>
                        <td>
                            {{ $close->profile->user->name }} {{ $close->profile->user->lastname }}
                        </td>
                        <td>
                            {{ $close->institution }}
                        </td>
                        <td>
                            {{ $close->name_title }}
                        </td>
                        <td>
                            {{ date('Y-m-d', strtotime($close->date_title)) }}
                        </td>
                    </tr>
                @endforeach
            </table>

            <br>

        @endif --}}


        {{-- @if (count($academicActual) > 0)
            <h4 style="text-align: center;">HERMANAS QUE ESTUDIAN </h4>
            <table border="1" cellspacing="0" cellpadding="0">
                <tr>
                    <th width="50.00%">NOMBRE DE LA HERMANA</th>
                    <th width="15.00%">UNIVERSIDAD</th>
                    <th width="15.00%">ESPECIALIZACIÓN</th>
                    <th width="15.00%">NIVEL</th>
                </tr>

                @foreach ($academicActual as $actual)
                    {}
                    <tr>
                        <td>
                            {{ $actual->profile->user->name }} {{ $actual->profile->user->lastname }}
                        </td>
                        <td>
                            {{ $actual->institution }}
                        </td>
                        <td>
                            {{ $actual->name_title }}
                        </td>
                        <td>
                            {{ $actual->date_title }}
                        </td>
                    </tr>
                @endforeach
            </table>
        @endif --}}


    </main>
    <footer>
    </footer>

</body>

</html>
