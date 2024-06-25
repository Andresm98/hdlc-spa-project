<!DOCTYPE html>
<html lang="en">

<head>

    <head>
        <meta charset="UTF-8">
        <title>Nueva Implantación</title>
        <style>
            @page {
                margin: 0cm 0cm;
                font-size: 1.1em;
                line-height: 18pt;
            }

            body {
                margin: 2.0cm 2.5cm 2.5cm;
                font-family: Georgia, serif;
            }

            .bodycontent {
                margin: 2.0cm 2.5cm 2.5cm;
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
                margin: 10px;
            }

            /*  */

            div {
                position: relative;
            }

            table {
                width: 700px;
            }

            td {
                border: 1px solid rgb(0, 0, 0);
            }

            span {
                position: absolute;
                width: 100%;
                padding-right: 10px;
                padding-left: 10px;
                padding-top: 0;
                padding-bottom: 5px;
                z-index: 99;
            }

            em {
                margin-left: 6.2cm;
            }

            /*  */
        </style>
    </head>
</head>

<body>
    <img class="" src="https://files-hdlc-frontend.s3.amazonaws.com/header_doc.png" style="margin-bottom: 40px">
    <div>
        <span>
            {!! $data->content !!}
        </span>
        <table style="padding-top: 80px">
            <tr>
                <td height="180px" width="35%"></td>
                <td height="140px" style="border-style: hidden;"></td>
            </tr>
        </table>
    </div>
</body>

</html>
