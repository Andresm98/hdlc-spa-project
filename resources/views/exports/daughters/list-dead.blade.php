<table>
    <tr>
        <th>Nro</th>
        <th>Apellidos</th>
        <th>Nombres</th>
        <th>Cédula</th>
        <th>Fecha de Nacimiento</th>
        <th>Fecha de Vocación</th>
        <th>Fecha de Fallecimiento</th>
        <th>Comunidad (Lugar de fallecimiento)</th>
    </tr>
    {{ $count = 1 }}
    @foreach ($data as $daughter)
        <tr>
            <td>{{ $count++ }}</td>
            <td>{{ $daughter->lastname }}</td>
            <td>{{ $daughter->name }}</td>
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
                <td>
                    {{ date('Y-m-d', strtotime($daughter->profile->date_death)) }}
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
