<table>
    <tr>
        <th>Nro</th>
        <th>Hermana</th>
        <th>Nombres</th>
        <th>Apellidos</th>
        <th>Cédula</th>
        <th>Fecha de Nacimiento</th>
        <th>Fecha de Vocación</th>
    </tr>
    {{ $count = 1 }}
    @foreach ($data as $daughter)
        <tr>
            <td>{{ $count++ }}</td>
            <td>{{ $daughter->fullnamecomm }}</td>
            <td>{{ $daughter->name }}</td>
            <td>{{ $daughter->lastname }}</td>
            @if ($daughter->profile)
                <td>
                    {{ $daughter->profile->identity_card }}
                </td>
                <td>
                    {{ date('Y-m-d', strtotime($daughter->profile->date_birth)) }}
                </td>
                <td>
                    @if ($daughter->profile->date_vocation)
                        {{ date('Y-m-d', strtotime($daughter->profile->date_vocation)) }}
                    @endif
                </td>
            @else
                <td>Pendiente</td>
            @endif
        </tr>
    @endforeach

</table>
