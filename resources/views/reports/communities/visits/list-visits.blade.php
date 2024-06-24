<!DOCTYPE html>
<html lang="en">

<head>

    <head>
        <meta charset="UTF-8">
        <title>Reporte Visitas</title>
        {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
            integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> --}}


        <style>
            @page {
                margin: 0cm 0cm;
                font-size: 0.1em;
            }

            body {
                margin: 2.5cm 2cm 1.5cm;
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
                text-align: center;
                font-size: 0.3cm;
            }

            table {
                border-collapse: collapse;
                width: 100%;
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
                    <p style="font-size:0.6cm; margin-top:0.5cm;">
                        PROVINCIA DEL ECUADOR
                    </p>
                    <p style="font-size:0.6cm; margin-top:-0.4cm;">
                        Visitas Regulares
                    </p>
                </div>

            </div>
        </div>
    </header>

    <main>
        {{-- Address --}}
        <div style="font-size: small;">

            <div style="margin-bottom:5px;">

            </div>
            <table>
                <tr>
                    <th>Comunidades Por Orden Alfabético</th>
                    @foreach ($listYears as $year)
                        <th>{{ $year }}</th>
                    @endforeach
                    <th>Última Visita Pastoral</th>
                </tr>
                {{ $count = 1 }}
                @foreach ($data as $visit)
                    <tr>
                        <td width="12%">
                            @if ($visit->community)
                                {{ $visit->community->comm_name }}
                            @endif
                        </td>
                        @foreach ($visit->dataVisitPerYear as $pivoteA)
                            @if (count($pivoteA) > 0)
                                <td width="8%">
                                    @foreach ($pivoteA as $visitInside)
                                        Del {{ date('d', strtotime($visitInside->comm_date_init_visit)) }} al
                                        {{ date('d', strtotime($visitInside->comm_date_end_visit)) }} de
                                        {{ date('m', strtotime($visitInside->comm_date_init_visit)) }}
                                        {{-- {{ \Carbon\Carbon::parse($visitInside->comm_date_init_visit)->locale('es')->isoFormat('MMMM') }} --}}
                                        {!! $visitInside->comm_reason_visit !!} -
                                        {{ date('Y', strtotime($visitInside->comm_date_init_visit)) }}
                                    @endforeach
                                </td>
                            @else
                                <td width="8%"></td>
                            @endif
                        @endforeach
                        <td width="8%">
                            @if ($visit->lastPastoralVisit)
                                Del {{ date('d', strtotime($visit->lastPastoralVisit->comm_date_init_visit)) }} al
                                {{ date('d', strtotime($visit->lastPastoralVisit->comm_date_end_visit)) }} de
                                {{ date('m', strtotime($visit->lastPastoralVisit->comm_date_init_visit)) }}
                                {{-- {{ \Carbon\Carbon::parse($visitInside->comm_date_init_visit)->locale('es')->isoFormat('MMMM') }} --}}
                                {!! $visit->lastPastoralVisit->comm_reason_visit !!} -
                                {{ date('Y', strtotime($visit->lastPastoralVisit->comm_date_init_visit)) }}
                            @endif
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </main>


</body>

</html>
