<table>
    <tr>
        <th>Nro</th>
        <th>Hermana</th>
        <th>Nombres</th>
        <th>Apellidos</th>
        <th>Cédula</th>
        <th>Fecha de Nacimiento</th>
        <th>Fecha de Jubilación</th>
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
                    {{ $daughter->profile->identity_card }}
                </td>
                <td>
                    {{ date('Y-m-d', strtotime($daughter->profile->date_birth)) }}
                </td>
                <td>
                    @if ($daughter->profile->date_retirement)
                        {{ date('Y-m-d', strtotime($daughter->profile->date_retirement)) }}
                    @endif
                </td>
                <td>
                    @if (count($daughter->profile->transfers) > 0)
                        <?php
                        $list;
                        $list = $daughter->profile
                            ->transfers()
                            ->whereDate('transfer_date_adission', '<', now())
                            ->orderBy('transfer_date_adission', 'desc')
                            ->get();
                        ?>
                        {{ $list->first()->community->comm_name }}
                    @endif
                </td>
            @else
                <td>Pendiente</td>
                <td>Pendiente</td>
                <td>Pendiente</td>
            @endif
        </tr>
    @endforeach

</table>
