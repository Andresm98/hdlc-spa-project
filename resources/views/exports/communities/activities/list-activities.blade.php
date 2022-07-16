<table>
    <tr>
        <th>Nro</th>
        <th>Nombre Actividad</th>
        <th>Descripción Actividad</th>
        <th>Fecha Actividad</th>
        <th>Comunidad</th>
    </tr>
    {{ $count = 1 }}
    @foreach ($data as $activity)
        <tr>
            <td>{{ $count++ }}</td>
            <td>
                {{ $activity->comm_name_activity }}<br>
            </td>
            <td>{!! $activity->comm_description_activity !!}</td>
            <td>{{ date('Y-m-d', strtotime($activity->comm_date_activity)) }}</td>

            <td>
                @if ($activity->community)
                    {{ $activity->community->comm_name }}
                @endif
                <br> <br>
                Nro. Hermanas: {{ $activity->comm_nr_daughters }}<br>
                Nro. Beneficiarios: {{ $activity->comm_nr_beneficiaries }}<br>
                Nro. Colaboradores: {{ $activity->comm_nr_collaborators }}<br>
            </td>
        </tr>
    @endforeach

</table>
