<!DOCTYPE html>
<html lang="en">

<head>

    <head>
        <meta charset="UTF-8">
        <title>Reportes de Usuarios</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
            integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <style>
            @page {
                margin: 0cm 0cm;
                font-size: 1em;
            }

            body {
                margin: 3cm 2cm 2cm;
            }

            header {
                position: fixed;
                top: 0cm;
                left: 0cm;
                right: 0cm;
                height: 4.3cm;
                background-color: #111631;
                color: white;
                text-align: center;
                line-height: 30px;
            }

            footer {
                position: fixed;
                bottom: 0cm;
                left: 0cm;
                right: 0cm;
                height: 2.0cm;
                background-color: #343D8D;
                color: white;
                text-align: center;
                line-height: 35px;
            }

        </style>
    </head>
</head>

<body>
    <header>
        <br>
        <h3> <img src="https://www.cos.io/hubfs/Cos_2020/Images/cos_logo.png" height="33" width="33">
            Compania de  las Hijas de la Caridad Provincia Ecuador <img src="https://img.icons8.com/clouds/500/github.png" height="45" width="45">
        </h3>
        <p><strong>Reporte de Usuarios.</strong></p>
        <p>Impreso por: {{ auth()->user()->name }}, {{ auth()->user()->title }}.</p>

        <br>
    </header>

    <main>
        <br><br><br>
        <div class="card">
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>

                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Título</th>

                            <th>Roles</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>

                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->name }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{-- <div class="card-footer">
                {{ $courses->links('vendor.pagination.bootstrap-4') }}
            </div> --}}
        </div>

    </main>

    <footer>
        <p><strong>Fecha Impresión: {{ date('m-d-Y h:i:s a', time()) }}. Pichincha, Ecuador.</strong></p>
        <h6>Este documento fue generado en la plataforma Integration Laravel & GitHub. Esta es una copia parcial del
            contenido, por favor sea discreto con la presente información.</h6>
    </footer>

</body>

</html>
