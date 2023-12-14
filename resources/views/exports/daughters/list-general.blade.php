<table>
    <tr>
        <th>Nro</th>
        <th>Apellidos</th>
        <th>Nombres</th>
        <th>Correo</th>
        <th>Cédula</th>
        <th>Fecha de Nacimiento</th>
        <th>Fecha de Vocación</th>
    </tr>
    {{ $count = 1 }}
    @foreach ($data as $daughter)
        <tr>
            <td>{{ $count++ }}</td>
            <td>{{ $daughter->lastname }}</td>
            <td>{{ $daughter->name }}</td>
            <td>{{ $daughter->email }}</td>
            @if ($daughter->profile)
                <td>{{ $daughter->profile->identity_card }}</td>
                <td>
                    @if ($daughter->profile->date_birth)
                        {{ date('Y-m-d', strtotime($daughter->profile->date_birth)) }}
                    @endif
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
