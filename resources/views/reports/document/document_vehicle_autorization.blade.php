<!DOCTYPE html>
<html lang="en">

<head>

    <head>
        <meta charset="UTF-8">
        <title>Vehiculo Autorización</title>
        <style>
            @page {
                margin: 0cm 0cm;
                font-size: 1.1em;
                line-height: 22pt;
            }

            body {
                margin-top: 26px;
                margin-bottom: 5px;
                margin-right: 5px;
                margin-left: 30px;
                font-family: Georgia, serif;
            }

            * {
                box-sizing: border-box;
            }

            .column {
                float: left;
                padding: 12px;
                height: auto;
            }

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

            p {
                margin-top: 22px;
            }

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

            .center {
                justify-content: center;
            }

            /*  */
            div {
                width: 680px;
                position: relative;
            }

            table {
                width: 100px;
            }

            td {
                border: 1px solid rgb(46, 62, 151);
            }

            span {
                position: absolute;
                padding-right: 10px;
                padding-left: 90px;
                padding-top: 5px;
                padding-bottom: 5px;
                z-index: 99;
            }

            p {
                margin: -1px;
            }
        </style>
    </head>
</head>

<body>
    <div>
        <span>
            <img width="610" height="105" class="center" style="padding-top: 20px"
                src="https://files-hdlc-frontend.s3.amazonaws.com/header_doc_three.png">

            {!! $data->content !!}

            <img width="580" height="40" class="center" style="padding-top: 20px"
                src="https://files-hdlc-frontend.s3.amazonaws.com/reports/footer_doc_vehicle.png">
        </span>

        <table style="padding-top: 5px">
            <tr>
                <td width="545" height="790"></td>
            </tr>
        </table>
    </div>


</body>

</html>
