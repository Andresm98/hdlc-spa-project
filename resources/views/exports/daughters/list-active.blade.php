<table>
    <tr>
        <th>Nro</th>
        <th>Hermana</th>
        <th>Nombres</th>
        <th>Apellidos</th>
        <th>Fecha de Nacimiento</th>
        <th>Fecha de Admisión</th>
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
            <td>{{ $daughter->fullnamecomm }}</td>
            <td>{{ $daughter->name }}</td>
            <td>{{ $daughter->lastname }}</td>
            @if ($daughter->profile)
                <td>
                    {{ date('Y-m-d', strtotime($daughter->profile->date_birth)) }}
                </td>
                <td>
                    {{ date('Y-m-d', strtotime($daughter->profile->date_admission)) }}
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