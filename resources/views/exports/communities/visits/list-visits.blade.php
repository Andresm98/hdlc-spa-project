<table>
    <tr>
        <th>Nro</th>
        <th>Razón y Descripción Visita</th>
        <th>Tipo</th>
        <th>Fecha Inicio y Fin</th>
        <th>Comunidad</th>
    </tr>
    {{ $count = 1 }}
    @foreach ($data as $visit)
        <tr>
            <td>{{ $count++ }}</td>
            <td>
                Razón: {{ $visit->comm_reason_visit }}<br><br>
                Descripción: {!! $visit->comm_description_visit !!}
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
                Inicio: {{ date('Y-m-d', strtotime($visit->comm_date_init_visit)) }} <br>
                Fin: {{ date('Y-m-d', strtotime($visit->comm_date_end_visit)) }}
            </td>
            <td>
                @if ($visit->community)
                    {{ $visit->community->comm_name }}
                @endif
            </td>
        </tr>
    @endforeach

</table>
