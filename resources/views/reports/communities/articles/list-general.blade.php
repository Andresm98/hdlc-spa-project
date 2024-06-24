<!DOCTYPE html>
<html lang="en">

<head>

    <head>
        <meta charset="UTF-8">
        <title>Reporte Artículos</title>
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
            td,
            th {
                border: 1px solid black;
                padding-left: 15px;
                text-align: left;
                font-size: x-small;
            }

            table {
                border-collapse: collapse;
                width: 100%;
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
                    <p>Reporte Artículos de la comunidad
                        @if ($dataInventoryCommunity)
                            {{ $dataInventoryCommunity->get('community')->comm_name }}
                        @endif

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
        {{-- Address --}}
        <div style="font-size: small;">

            {{-- Info Family --}}

            <small>
                <div style="margin-bottom:5px;">
                    Nro. de artículos
                    @if ($status)
                        en estado
                        <strong>
                            @if ($status == 1)
                                Malo
                            @elseif ($status == 2)
                                Regular
                            @elseif ($status == 3)
                                Bueno
                            @elseif ($status == 4)
                                Muy bueno
                            @elseif ($status == 5)
                                Excelente
                            @endif
                        </strong>
                    @endif
                    @if ($from && $to)
                        ({{ date('Y-m-d', strtotime($from)) }} -
                        {{ date('Y-m-d', strtotime($to)) }})
                    @endif
                    encontrados: {{ count($data) }}.
                    <br>
                </div>
            </small>
            <table>
                <tr>
                    <th>Nro</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Estado</th>
                    <th>Material</th>
                    <th>Marca</th>
                    <th>Color</th>
                    <th>Precio</th>
                    <th>Medidas</th>
                    <th>Creado en</th>
                    {{-- <th>Fecha de Nacimiento</th> --}}
                </tr>
                {{ $count = 1 }}
                @foreach ($data as $article)
                    <tr>
                        <td width="4%">{{ $count++ }}</td>
                        <td style="text-align: justify;" width="10%">
                            {{ $article->name }}

                        </td>
                        <td style="text-align: justify;" width="15%">
                            {!! $article->description !!}
                        </td>
                        <td>
                            @if ($article->status == 1)
                                Malo
                            @elseif ($article->status == 2)
                                Regular
                            @elseif ($article->status == 3)
                                Bueno
                            @elseif ($article->status == 4)
                                Muy bueno
                            @elseif ($article->status == 5)
                                Excelente
                            @endif
                        </td>
                        <td>
                            @if ($article->material == 1)
                                Madera
                            @elseif ($article->material == 2)
                                Tela
                            @elseif ($article->material == 3)
                                Plástico
                            @elseif ($article->material == 4)
                                Metal
                            @elseif ($article->material == 5)
                                Yeso
                            @endif
                        </td>
                        <td>
                            {{ $article->brand }}
                        </td>
                        <td>
                            {{ $article->color }}
                        </td>
                        <td>
                            {{ $article->price }}
                        </td>
                        <td>
                            {{ $article->size }}
                        </td>
                        <td width="10%">
                            {{ date('Y-m-d', strtotime($article->created_at)) }} </td>
                        {{-- <td>Pendiente</td> --}}
                    </tr>

                    {{-- Hermanas --}}
                @endforeach

            </table>

        </div>
    </main>

    <footer>

    </footer>

</body>

</html>
