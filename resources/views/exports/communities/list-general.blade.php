<table>
    <tr>
        <th>Nro</th>
        <th>Nombre</th>
        <th>Pastoral</th>
        <th>Fechas Actividad</th>
        {{-- <th>Fecha de Nacimiento</th> --}}
    </tr>
    <?php $count = 1; ?>
    @foreach ($data as $community)
        <tr>
            <td>{{ $count++ }}</td>
            <td>{{ $community->comm_name }}</td>
            <td>{{ $community->pastoral->name }}</td>
            <td>
                @if ($community->comm_status == 1)
                    Abierta <br>
                    ({{ date('Y-m-d', strtotime($community->date_fndt_comm)) }})
                    - Presente
                @else
                    Cerrada <br>
                    ({{ date('Y-m-d', strtotime($community->date_fndt_comm)) }}) hasta
                    ({{ date('Y-m-d', strtotime($community->date_close)) }})
                @endif
            </td>
            {{-- <td>Pendiente</td> --}}
        </tr>

        {{-- Hermanas --}}
    @endforeach

</table>
