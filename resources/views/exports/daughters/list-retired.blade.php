<table>
    <tr>
        <th>Nro</th>
        <th>Hermana</th>
        <th>Nombres</th>
        <th>Apellidos</th>
        <th>Fecha de Nacimiento</th>
        <th>Fecha de Retiro</th>
        <th>Comunidad (Última lugar en la Compañía)</th>
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
                    {{ date('Y-m-d', strtotime($daughter->profile->date_exit)) }}
                </td>
                <td>
                    {{ $daughter->profile->transfers->first()->community->comm_name }}
                </td>
            @else
                <td>Pendiente</td>
                <td>Pendiente</td>
                <td>Pendiente</td>
            @endif
        </tr>
    @endforeach
</table>
