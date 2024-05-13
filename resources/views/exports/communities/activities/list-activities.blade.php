<table>
    <tr>
        <th>Nro</th>
        <th>Comunidad</th>
        <th>Nombre Actividad</th>
        <th>Descripción Actividad</th>
        <th>Nro. Hermanas.</th>
        <th>Nro. Beneficiarios</th>
        <th>Nro. Colaboradores</th>
        <th>Fecha Actividad</th>

    </tr>
    {{ $count = 1 }}
    @foreach ($data as $activity)
        <tr>
            <td>{{ $count++ }}</td>
            <td>
                @if ($activity->community)
                    {{ $activity->community->comm_name }}
                @endif
            </td>
            <td>
                {{ $activity->comm_name_activity }}
            </td>
            <td>{!! $activity->comm_description_activity !!}</td>
            <td>
                {{ $activity->comm_nr_daughters }}
            </td>
            <td>
                {{ $activity->comm_nr_beneficiaries }}
            </td>
            <td>
                {{ $activity->comm_nr_collaborators }}
            </td>
            <td>{{ date('Y-m-d', strtotime($activity->comm_date_activity)) }}</td>

        </tr>
    @endforeach

</table>
