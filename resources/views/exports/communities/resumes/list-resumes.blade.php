<table>
    <tr>
        <th>Nro</th>
        <th>Comunidad</th>
        <th>Nombre Resumen</th>
        <th>Anexos</th>
        <th>Observaciones</th>
        <th>Fecha Resumen</th>
    </tr>
    {{ $count = 1 }}
    @foreach ($data as $resume)
        <tr>
            <td>{{ $count++ }}</td>
            <td>
                @if ($resume->community)
                    {{ $resume->community->comm_name }}
                @endif
            </td>
            <td>
                {{ $resume->comm_name_resume }}<br>
            </td>
            <td>
                {{ $resume->comm_annexed_resume }}
            </td>
            <td>
                {!! $resume->comm_observation_resume !!}

            </td>
            <td>{{ date('Y-m-d', strtotime($resume->comm_date_resume)) }}</td>


        </tr>
    @endforeach

</table>
