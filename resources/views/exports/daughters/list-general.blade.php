<table>
    <tr>
        <th>Nro</th>
        <th>Hermana</th>
        <th>Nombres</th>
        <th>Apellidos</th>
        <th>Fecha de Nacimiento</th>
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
            @else
                <td>Pendiente</td>
            @endif
        </tr>
    @endforeach

</table>
