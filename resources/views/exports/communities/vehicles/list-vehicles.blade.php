<table>
    <tr>
        <th>Nro</th>
        <th>Comunidad</th>
        <th>Marca</th>
        <th>Tipo</th>
        <th>Color</th>
        <th>Placa</th>
        <th>Año</th>
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
                {{ $visit->brand }}
            </td>
            <td>
                {{ $visit->type }}
            </td>
            <td>
                {{ $visit->color }}
            </td>
            <td>
                {{ $visit->plaque }}
            </td>
            <td>
                @if ($visit->year)
                    {{ date('Y-m-d', strtotime($visit->year)) }}
                @endif
            </td>

        </tr>
    @endforeach

</table>
