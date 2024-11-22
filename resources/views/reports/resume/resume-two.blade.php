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
                margin: 2.0cm 2cm 2cm;
                font-family: Arial, sans-serif;
            }

            header {
                position: fixed;
                top: 0cm;
                left: 0cm;
                right: 0cm;
                height: 1.5cm;
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
                padding-left: 4px;
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
    <?php
    $counter = 1;
    ?>
    <main>
        <table border="1" cellspacing="0" cellpadding="0">
            <tr>
                <th width="3.00%">Nº</th>
                <th width="20.00%">APELLIDOS</th>
                <th width="20.00%">Nombre de Comunidad</th>
                <th width="11.00%">Fecha de Nacimiento</th>
                <th width="11.00%">Fecha de Vocación</th>
                <th width="11.00%">Oficio</th>
                <th width="11.00%">Fecha de llegada a la Casa</th>
                <th width="10.00%">Mes del retiro</th>
            </tr>

            @foreach ($actualTransfers as $element)
                {}
                <tr>
                    <td style="text-align: center">
                        {{ $counter++ }}
                    </td>
                    <td>
                        {{ $element['lastname'] }}
                    </td>
                    <td>
                        {{ $element['fullnamecomm'] }}
                    </td>
                    <td style="text-align: center">
                        {{ $element['datebirth'] }}
                    </td>
                    <td style="text-align: center">
                        {{ $element['datevocation'] }}
                    </td>
                    <td style="text-align: center">
                        {{ $element['office'] }}
                    </td>
                    <td style="text-align: center">
                        {{ $element['dateinsert'] }}
                    </td>
                    <td style="text-align: center">
                        {{ $element['retirement'] }}
                    </td>
                </tr>
            @endforeach
        </table>
    </main>

    <footer>
    </footer>

</body>

</html>
