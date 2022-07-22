<table>
    <tr>
        <th>Nro</th>
        <th>Comunidad</th>

        <th>Razón</th>
        <th> Descripción </th>
        <th>Tipo</th>
        <th>Fecha Inicio</th>
        <th>Fecha Fin</th>
    </tr>
    {{ $count = 1 }}
    @foreach ($data as $visit)
        <tr>
            <td>{{ $count++ }}</td>
            <td>
                @if ($visit->community)
                    {{ $visit->community->comm_name }}
                @endif
            </td>
            <td>
                {{ $visit->comm_reason_visit }}
            </td>
            <td>
                {!! $visit->comm_description_visit !!}
            </td>
            <td>
                @if ($visit->comm_type_visit == 1)
                    Fraterna
                @elseif($visit->comm_type_visit == 2)
                    Regular
                @elseif($visit->comm_type_visit == 3)
                    Pastoral
                @endif
            </td>
            <td>
                {{ date('Y-m-d', strtotime($visit->comm_date_init_visit)) }}
            </td>
            <td>
                {{ date('Y-m-d', strtotime($visit->comm_date_end_visit)) }}
            </td>

        </tr>
    @endforeach

</table>
