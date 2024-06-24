<!DOCTYPE html>
<html lang="en">

<head>

    <head>
        <meta charset="UTF-8">
        <title>Documenxxxxto</title>
        <style>
            @page {
                margin: 0cm 0cm;
                font-size: 1.1em;
                line-height: 12pt;
            }

            body {
                margin: 1.2cm 2.0cm 1.2cm;
                font-family: Georgia, serif;
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

            /* h1 */
            h1.ql-align-right {
                text-align: center;
            }

            h1.ql-align-left {
                text-align: left;
            }

            h1.ql-align-right {
                text-align: right;
            }

            h1.ql-align-center {
                text-align: center;
            }

            /* h2 */
            h2.ql-align-right {
                text-align: center;
            }

            h2.ql-align-left {
                text-align: left;
            }

            h2.ql-align-right {
                text-align: right;
            }

            h2.ql-align-center {
                text-align: center;
            }

            /* h3 */
            h3.ql-align-right {
                text-align: center;
            }

            h3.ql-align-left {
                text-align: left;
            }

            h3.ql-align-right {
                text-align: right;
            }

            h3.ql-align-center {
                text-align: center;
            }

            /*  */
            h4.ql-align-right {
                text-align: center;
            }

            h4.ql-align-left {
                text-align: left;
            }

            h4.ql-align-right {
                text-align: right;
            }

            h4.ql-align-center {
                text-align: center;
            }

            /*  */

            p.ql-align-right {
                text-align: center;
            }

            p.ql-align-left {
                text-align: left;
            }

            p.ql-align-right {
                text-align: right;
            }

            p.ql-align-justify {
                text-align: justify;
            }

            p.ql-align-center {
                text-align: center;
            }

            p {
                margin: 6px;
            }
        </style>
    </head>
</head>

<body>
    @if ((int) $data->type == 13)
        <img class="" src="https://files-hdlc-frontend.s3.amazonaws.com/header_doc_two.png">
    @endif
    <main>
        {!! $data->content !!}
    </main>
</body>

</html>
