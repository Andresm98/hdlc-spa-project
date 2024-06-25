<!DOCTYPE html>
<html lang="en">

<head>

    <head>
        <meta charset="UTF-8">
        <title>Permiso</title>
        <style>
            @page {
                margin: 0cm 0cm;
                font-size: 1.1em;
                line-height: 13pt;
            }

            body {
                margin-top: 20px;
                margin-bottom: 2px;
                margin-right: 80px;
                margin-left: 90px;
                font-family: Georgia, serif;
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
                margin-left: 40px;
                justify-content: center;
            }

            /*  */
            div {
                width: 660px;
                position: relative;
            }

            table {
                width: 660px;
            }

            td {
                border: 1px solid rgb(37, 50, 122);
            }

            span {
                position: absolute;
                padding-right: 10px;
                padding-left: 10px;
                padding-top: 0;
                padding-bottom: 5px;
                z-index: 99;
            }

            em {
                font-size: 1em;
                line-height: 1pt;
            }
        </style>
    </head>
</head>

<body>
    <img width="555" height="84" class="center" style="margin-top:4px; margin-bottom: -5px;"
        src="https://files-hdlc-frontend.s3.amazonaws.com/header_doc_three.png">
    <div>
        <span>
            {!! $data->content !!}
        </span>
        <table style="padding-top: 5px">
            <tr>
                <td height="33px" width="50%"></td>
                <td height="33px" style="border-style: hidden;"></td>
            </tr>
        </table>
        <table style="border-collapse: collapse; margin-left: 2px; margin-top:4px">
            <tr>
                <td height="33px" width="20%"></td>
                <td height="33px"></td>
            </tr>
        </table>
        <table style="border-collapse: collapse; margin-left: 2px; margin-top:4px">
            <tr>
                <td height="35px" width="20%"></td>
                <td height="35px"></td>
            </tr>
            <tr>
                <td height="35px" width="20%"></td>
                <td height="35px"></td>
            </tr>
            <tr>
                <td height="35px" width="20%"></td>
                <td height="35px"></td>
            </tr>
            <tr>
                <td style="padding-bottom: 10px" colspan="2" width="20%" height="120px"></td>
            </tr>
        </table>
    </div>
</body>

</html>
