<table>
    <tr>
        <th>Nro</th>
        <th>Apellidos</th>
        <th>Nombres</th>
        <th>Correo</th>
        <th>Cédula</th>
        <th>Fecha de Nacimiento</th>
        <th>Fecha de Vocación</th>
        @if ($type == 2)
            <th>Fecha de Envío</th>
        @elseif ($type == 3)
            <th>Fecha de Envío</th>
            <th>Fecha de Votos</th>
        @endif
    </tr>
    {{ $count = 1 }}
    @foreach ($data as $daughter)
        <tr>
            <td>{{ $count++ }}</td>
            <td>{{ $daughter->lastname }}</td>
            <td>{{ $daughter->name }}</td>
            <td>{{ $daughter->email }}</td>
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
                @if ($type == 2)
                    <td>
                        {{ date('Y-m-d', strtotime($daughter->profile->date_send)) }}
                    </td>
                @elseif ($type == 3)
                    <td>
                        {{ date('Y-m-d', strtotime($daughter->profile->date_send)) }}
                    </td>
                    <td>
                        {{ date('Y-m-d', strtotime($daughter->profile->date_vote)) }}
                    </td>
                @endif
            @else
                <td>Pendiente</td>
                <td>Pendiente</td>
            @endif
        </tr>
    @endforeach

</table>
