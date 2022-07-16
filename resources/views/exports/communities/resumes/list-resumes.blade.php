<table>
    <tr>
        <th>Nro</th>
        <th>Nombre Resumen</th>
        <th>Anexos y Observaciones</th>
        <th>Fecha Resumen</th>
        <th>Comunidad</th>
    </tr>
    {{ $count = 1 }}
    @foreach ($data as $resume)
        <tr>
            <td>{{ $count++ }}</td>
            <td>
                {{ $resume->comm_name_resume }}<br>
            </td>
            <td>
                Anexos: {{ $resume->comm_annexed_resume }}<br><br>
                Observaciones: {!! $resume->comm_observation_resume !!}<br>
            </td>
            <td>{{ date('Y-m-d', strtotime($resume->comm_date_resume)) }}</td>

            <td>
                @if ($resume->community)
                    {{ $resume->community->comm_name }}
                @endif
            </td>
        </tr>
    @endforeach

</table>
